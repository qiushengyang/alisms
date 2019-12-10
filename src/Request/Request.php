<?php
/**
 * Created by PhpStorm.
 * User: shenyang.qiu
 * Date: 2019/12/10
 * Time: 11:17
 */
namespace AliSms\Request;


class Request {
    public $accessKeyId;
    public $accessSecret;
    public $action;
    public $format;
    public $regionId;
    public $signatureMethod;
    public $signatureNonce;
    public $signatureVersion;
    public $timestamp;
    public $version;
    public $signature;

    public function setAccessKeyId(string $AccessKeyId)
    {
        $this->accessKeyId = $AccessKeyId;
    }
    
    public function getAccessKeyId() :?string
    {
        return $this->accessKeyId;
    }

    public function setAccessSecret(string $AccessSecret)
    {
        $this->accessSecret = $AccessSecret;
    }

    public function getAccessSecret() :?string
    {
        return $this->accessSecret;
    }
    
    public function setAction(string $Action)
    {
        $this->action = $Action;
    }
    
    public function getAction() :?string
    {
        return $this->action;
    }

    public function setFormat(string $Format)
    {
        $this->format = $Format;
    }

    public function getFormat() :?string
    {
        return $this->format;
    }

    public function setRegionId(string $RegionId)
    {
        $this->regionId = $RegionId;
    }

    public function getRegionId() :?string
    {
        return $this->regionId;
    }

    public function setSignatureMethod(string $SignatureMethod)
    {
        $this->signatureMethod = $SignatureMethod;
    }

    public function getSignatureMethod() :?string
    {
        return $this->signatureMethod;
    }

    public function setSignatureNonce(string $SignatureNonce)
    {
        $this->signatureNonce = $SignatureNonce;
    }

    public function getSignatureNonce() :?string
    {
        return $this->signatureNonce;
    }

    public function setSignatureVersion(string $SignatureVersion)
    {
        $this->signatureVersion = $SignatureVersion;
    }

    public function getSignatureVersion() :?string
    {
        return $this->signatureVersion;
    }

    public function setTimestamp(string $Timestamp)
    {
        $this->timestamp = $Timestamp;
    }

    public function getTimestamp() :?string
    {
        return $this->timestamp;
    }

    public function setVersion(string $Version)
    {
        $this->version = $Version;
    }

    public function getVersion() :?string
    {
        return $this->version;
    }

    public function setSignature(string $Signature)
    {
        $this->signature = $Signature;
    }

    public function getSignature() :?string
    {
        return $this->signature;
    }
}