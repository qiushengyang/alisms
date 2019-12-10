<?php
/**
 * Created by PhpStorm.
 * User: shenyang.qiu
 * Date: 2019/12/10
 * Time: 11:37
 */
namespace Sms\Request;

class SendSmsRequest extends Request {
    public $phoneNumbers;
    public $signName;
    public $templateCode;
    public $outId = '';
    public $smsUpExtendCode = '';
    public $templateParam = '';

    public function setPhoneNumbers(string $PhoneNumbers)
    {
        $this->phoneNumbers = $PhoneNumbers;
    }

    public function getPhoneNumbers() :string
    {
        return $this->phoneNumbers;
    }

    public function setSignName(string $SignName)
    {
        $this->signName = $SignName;
    }

    public function getSignName() :string
    {
        return $this->signName;
    }

    public function setTemplateCode(string $TemplateCode)
    {
        $this->templateCode = $TemplateCode;
    }

    public function getTemplateCode() :string
    {
        return $this->templateCode;
    }

    public function setOutId(string $OutId)
    {
        $this->outId = $OutId;
    }

    public function getOutId() :string
    {
        return $this->outId;
    }

    public function setSmsUpExtendCode(string $SmsUpExtendCode)
    {
        $this->smsUpExtendCode = $SmsUpExtendCode;
    }

    public function getSmsUpExtendCode() :string
    {
        return $this->smsUpExtendCode;
    }

    public function setTemplateParam(string $TemplateParam)
    {
        $this->templateParam = $TemplateParam;
    }

    public function getTemplateParam() :string
    {
        return $this->templateParam;
    }
}