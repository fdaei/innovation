<?php

namespace common\components;

use common\models\SettingsAccount;
use common\traits\CoreTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use WebPConvert\WebPConvert;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**@property Client $guzzleClient */
class Cdn extends Component
{
    use CoreTrait;

    public $clientId;
    public $clientSecret;
    public $debug = false;
    public $apiVersion = 'v1';
    private $guzzleClient;

    const API_PATH = "%s://%s/api/web/%s/%s/%s";

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!($this->clientId = trim(SettingsAccount::get('cdnClientID')))) {
            throw new InvalidConfigException('CDN clientID is required!');
        }

        if (!($this->clientSecret = trim(SettingsAccount::get('cdnClientSecret')))) {
            throw new InvalidConfigException('CDN client secret is required!');
        }

        $this->guzzleClient = new \GuzzleHttp\Client();
    }

    protected function get_path($method = "create", $base = "upload", $params = [])
    {
        $cdnUrl = parse_url(Env::get('CDN_WEB'));
        return sprintf(self::API_PATH, ($cdnUrl['scheme'] ?? ''), ($cdnUrl['host'] ?? ''), $this->apiVersion, $base, $method, $params ? ('?' . http_build_query($params)) : '');
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @param string $verb
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute($url, $data = null, $multipart = null, $headers = [], $verb = "POST")
    {
        return $this->normalExecute($url, $data, $multipart, $headers, $verb);
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return mixed
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function normalExecute($url, $data = null, $multipart = null, $headers = [], $verb = "POST")
    {
        $headers = ArrayHelper::merge([
            'Accept' => 'application/json',
            'charset' => 'utf-8'
        ], $headers);

        $postData = $data ? ['form_params' => $data] : ['multipart' => $multipart];

        try {
            $response = $this->guzzleClient->request($verb, $url,
                ArrayHelper::merge([
                    'headers' => $headers,
                ], $postData)
            );
        } catch (ClientException $e) {
            Yii::error($e->getMessage(), 'CDN-Exception');
            Yii::error($e->getResponse()->getBody()->getContents(), 'CDN-Exception-Details');
            return [
                'status' => $e->getCode(),
                'error' => $e->getResponse()->getBody()->getContents(),
            ];
        }

        return [
            'status' => $response->getStatusCode(),
            'body' => json_decode($response->getBody()->getContents()),
        ];
    }

    /**
     * @return string
     */
    public function getAuthenticationString()
    {
        return base64_encode("{$this->clientId}:{$this->clientSecret}");
    }

    /**
     * @param string $source_path
     * @param string $file_name
     * @param string $environment
     * @param string $model_class
     * @param null|integer $model_id
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload($source_path, $file_name, $environment, $model_class, $model_id = null, $convertImageToWebp = true)
    {
        $path = $this->get_path();
        preg_match('/\.\w+$/', $file_name, $matches);
        if ($convertImageToWebp && ArrayHelper::isIn(($matches[0] ?? ''), ['.png', '.jpg', '.jpeg'])) {
            $fileName = str_replace(($matches[0] ?? ''), '.webp', $file_name);
            $destination = $source_path . $fileName;
            WebPConvert::convert(($source_path . $file_name), $destination, []);
            $file_name = $fileName;
        }

        $multipart = [
            [
                'name' => 'environment',
                'contents' => $environment,
            ],
            [
                'name' => 'model_class',
                'contents' => $model_class,
            ],
            [
                'name' => 'model_id',
                'contents' => $model_id,
            ],
            [
                'name' => 'file',
                'contents' => fopen($source_path . $file_name, 'r')
            ]
        ];

        $headers["Authorization"] = sprintf("Basic %s", $this->getAuthenticationString());

        return $this->execute($path, [], $multipart, $headers, "POST");
    }

    /**
     * @param string $file_name
     * @param string $environment
     * @param string $model_class
     * @param null|integer $model_id
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($file_name, $environment, $model_class, $model_id = null)
    {
        $path = $this->get_path('delete');

        $data = [
            'environment' => $environment,
            'model_class' => $model_class,
            'model_id' => $model_id,
            'file' => $file_name
        ];

        $headers["Authorization"] = sprintf("Basic %s", $this->getAuthenticationString());

        return $this->execute($path, $data, [], $headers, "DELETE");
    }

    /**
     * @param string $environment
     * @param string $model_class
     * @param null|integer $model_id
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteDirectory($environment, $model_class, $model_id = null)
    {
        $path = $this->get_path('delete-directory');

        $data = [
            'environment' => $environment,
            'model_class' => $model_class,
            'model_id' => $model_id
        ];

        $headers["Authorization"] = sprintf("Basic %s", $this->getAuthenticationString());

        return $this->execute($path, $data, [], $headers, "DELETE");
    }
}

?>