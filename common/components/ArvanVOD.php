<?php

namespace common\components;

use common\models\SettingsAccount;
use GuzzleHttp\Client;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

/**
 * Class ArvanVOD
 *
 * @property Client $client
 * @property string $apikey
 */
class ArvanVOD extends Component
{
    protected $client;
    private $apiKey;
    public $videoID;

    const BASE_URI = 'https://napi.arvancloud.com/vod/2.0/';

    /**
     *
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->client = new Client(['base_uri' => static::BASE_URI, 'debug' => false]);
        if (!$this->apiKey = SettingsAccount::get('arvan_vod_key')) {
            throw new InvalidConfigException('API key is required!');
        }
        $this->apiKey = trim($this->apiKey);
    }

    public function createChannel($title)
    {
        $response = $this->client->post('channels',
            [
                'headers' => [
                    'Authorization' => $this->apiKey,
                    'Accept-Language' => 'en',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'body' => json_encode([
                    'title' => $title
                ])
            ]);
        return $this->decoder($response);
    }

    public function channelVideos($channel_id)
    {
        try {
            $response = $this->client->get('channels/' . $channel_id . '/videos',
                [
                    'headers' => [
                        'Authorization' => $this->apiKey,
                        'Accept-Language' => 'en',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]);
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'ArvanVODCMPNT/ChannelVideos-Exception');
        }
        return $this->decoder($response);
    }


    /**
     * @param $videoTitle
     * @param $url
     * @param $channel_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function createViaURL($videoTitle, $url, $channel_id)
    {
        $url = $this->validateUrl($url);
        try {
            $response = $this->client->post('channels/' . $channel_id . '/videos',
                [
                    'headers' => [
                        'Authorization' => $this->apiKey,
                        'Accept-Language' => 'en',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'body' => json_encode([
                        "title" => $videoTitle,
                        "video_url" => $url,
                        "convert_mode" => "auto",
                    ])
                ]);
            if ($response->getStatusCode() == 201) {
                $response = $this->decoder($response);
                $this->videoID = $response->data->id;
                return $response;
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }
    }

    public function view($video_id)
    {
        try {
            $response = $this->client->get("videos/{$video_id}",
                [
                    'headers' => [
                        'Authorization' => $this->apiKey,
                        'Accept-Language' => 'en',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]);

            if ($response->getStatusCode() == 200) {
                $response = $this->decoder($response);
                return $this->responseViewFields($response);
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'ArvanVODCMPNT/uplploadViaURL-Exception');
        }
        return false;
    }

    public function delete($video_id)
    {
        try {
            $response = $this->client->delete("videos/{$video_id}",
                [
                    'headers' => [
                        'Authorization' => $this->apiKey,
                        'Accept-Language' => 'en',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]);
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'ArvanVODCMPNT/uplploadViaURL-Exception');
        }
        return $response->getStatusCode();
    }

    private function responseViewFields($response)
    {
        $data = $response->data;
        return [
            'video_id' => $data->id,
            'arvan_video_status' => $data->status,
            'available' => $data->available,
            'mp4_videos' => $data->mp4_videos,
            'video_url' => $data->video_url,
            'embed1' => $data->player_url,
            'thumbnail_url' => $data->thumbnail_url ?? ''
        ];
    }

    private function decoder($response, $assoc = false)
    {
        return json_decode($response->getBody()->getContents(), $assoc);
    }


    private function validateUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) && ($url = preg_replace('/\?.*/', '', $url))) {
            return $url;
        }
        throw new NotFoundHttpException('Bad $url Exception <ArvanVOD>');
    }
}