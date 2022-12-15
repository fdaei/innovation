<?php

namespace common\components;

use lubosdz\captchaExtended\CaptchaExtendedAction;
use yii\base\Exception;
use Yii;

/**
 * @author SADi <sadshafiei.01@gmail.com>
 */
class CaptchaHelper extends CaptchaExtendedAction
{
    const CODE_VALID_TIME = 240; // 4 Minutes

    private $code;

    /**
     * CaptchaHelper constructor.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct()
    {
        $this->init();
        $this->mode = self::MODE_MATH;
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function generateImage(): array
    {
        $generatedCode = $this->generateCode();
        $cacheKey = microtime(true);
        $base64 = "data:image/png;base64," . base64_encode($this->renderImage($generatedCode['code']));
        Yii::$app->redis->setex($this->generateSessionKey($generatedCode['result'], $cacheKey), self::CODE_VALID_TIME, $generatedCode['result']);
        return [
            'image' => $base64,
            'expireTime' => time() + self::CODE_VALID_TIME,
            'key' => $cacheKey
        ];
    }

    /**
     * @return array
     */
    public function generateCode(): array
    {
        if ($this->code) {
            return $this->code;
        }

        return $this->code = $this->generateVerifyCode();
    }

    /**
     * @param string $code
     * @param float $cacheKey
     * @return bool
     * @throws Exception
     */
    public function verify($code, $cacheKey): bool
    {
        $verify = Yii::$app->redis->get($this->generateSessionKey($code, (float)$cacheKey)) === $code;
        $this->invalidate($code, $cacheKey);

        return $verify;
    }

    /**
     * @param string $code
     * @param float $cacheKey
     * @return bool
     * @throws Exception
     */
    public function invalidate($code, $cacheKey): bool
    {
        return Yii::$app->redis->del($this->generateSessionKey($code, (float)$cacheKey));
    }

    /**
     * @return string
     */
    private function generateSessionKey($code, $cacheKey): string
    {
        return base64_encode(Yii::$app->request->getRemoteIP() . Yii::$app->request->getUserAgent() . $cacheKey . $code);
    }
}