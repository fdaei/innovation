<?php

namespace common\components;

use yii\base\Component;
use yii\httpclient\Client;

class MobitApi extends Component
{
    public static function sendSmsLogin($mobileNumber, $otpCode)
    {
        $client = new Client();

        $url = strtr('https://api.mobit.ir/api/web/v10/developer/verify-sms?company_name={company_name}&code={code}&receptor={receptor}',
            [
                '{company_name}' => 'آوینوکس',
                '{code}' => $otpCode,
                '{receptor}' => $mobileNumber
            ]
        );

        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($url)
            ->send();

        if ($response->isOk) {
            return true;
        }

        $responseMessage = json_decode($response->content);

        return $responseMessage->data->message;
    }
}