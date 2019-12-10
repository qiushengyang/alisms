<?php
/**
 * Created by PhpStorm.
 * User: shenyang.qiu
 * Date: 2019/12/10
 * Time: 14:05
 */
namespace Sms;

use EasySwoole\HttpClient\HttpClient;
use AliSms\Request\QueryDetailRequest;
use AliSms\Request\SendSmsRequest;

class Sms {
    private $errCode;
    private $errMsg;
    private $smsRequest;
    private $url = 'http://dysmsapi.aliyuncs.com/?';
    private $accessKeyId;
    private $accessSecret;

    public function __construct(string $accessKeyId, string $accessSecret)
    {
        $this->accessKeyId = $accessKeyId;
        $this->accessSecret = $accessSecret;
    }

    public function sendSms(SendSmsRequest $sendSmsRequest) :bool
    {
        $this->smsRequest = $sendSmsRequest;
        $this->smsRequest->setAction('sendSms');
        $ret = $this->getResult();
        if ($ret['Code'] === "OK") {
            return true;
        } else {
            $this->errMsg = $ret['Message'];
            $this->errCode= $ret['Code'];
            return false;
        }
    }

    public function QuerySendDetails(QueryDetailRequest $queryDetailRequest)
    {
        $this->smsRequest = $queryDetailRequest;
        $this->smsRequest->setAction('QuerySendDetails');
        $ret = $this->getResult();
        if ($ret['Code'] === "OK") {
            return $ret['SmsSendDetailDTOs']['SmsSendDetailDTO'];
        } else {
            $this->errMsg = $ret['Message'];
            $this->errCode= $ret['Code'];
            return false;
        }
    }


    public function getResult()
    {
        $this->paramValidate();
        $signature = new Signature($this->smsRequest, $this->accessKeyId, $this->accessSecret);
        $resutString = $signature->getRequestString();
        $url = $this->url.$resutString;
        $ret = $this->request($url);
        if (!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    private function request($url)
    {
        try {
            $client = $this->getClient();
            $client->setUrl($url);
            $client->setTimeout(3);
            return $client->get()->getBody();
        } catch (\Throwable $throwable) {
            $this->errCode = $throwable->getCode();
            $this->errMsg = $throwable->getMessage();
            return false;
        }

    }

    private function getClient() :HttpClient
    {
        $client = new HttpClient();
        return $client;
    }

    private function paramValidate()
    {
        if ($this->smsRequest instanceof SendSmsRequest) {
            if (!$this->smsRequest->getPhoneNumbers()) {
                throw  new \Exception('PhoneNumbers Is Required');
            }
            if (!$this->smsRequest->getSignName()) {
                throw  new \Exception('SignName Is Required');
            }
            if (!$this->smsRequest->getTemplateCode()) {
                throw  new \Exception('TemplateCode Is Required');
            }
            if (!$this->smsRequest->getOutId()) {
                $this->smsRequest->setOutId('');
            }
            if (!$this->smsRequest->getSmsUpExtendCode()) {
                $this->smsRequest->setSmsUpExtendCode('');
            }
            if (!$this->smsRequest->getTemplateParam()) {
                $this->smsRequest->setTemplateParam('');
            }
        } elseif ($this->smsRequest instanceof QueryDetailRequest) {
            if (!$this->smsRequest->getPhoneNumber()) {
                throw  new \Exception('PhoneNumber Is Required');
            }
            if (!$this->smsRequest->getSendDate()) {
                throw  new \Exception('SendDate Is Required');
            }
        }
    }
}