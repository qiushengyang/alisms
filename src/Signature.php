<?php
/**
 * Created by PhpStorm.
 * User: shenyang.qiu
 * Date: 2019/12/10
 * Time: 11:03
 */
namespace Sms;

use function AlibabaCloud\Client\value;
use Sms\Request\Request;
use Sms\Request\SendSmsRequest;

class Signature {
    public $request;
    public $sortQueryString = '';
    public function __construct(Request $request, $accessKeyId, $accessSecret)
    {
        $this->request = $request;
        $this->request->setAccessKeyId($accessKeyId);
        $this->request->setAccessSecret($accessSecret);
    }

    public function getRequestString()
    {
        $Signature = $this->getSignature();
        return 'Signature='.$Signature.'&'.$this->sortQueryString;
    }

    public function getSignature() :string
    {
        $this->paramValidate();
        $param = json_decode(json_encode($this->request), true);
        unset($param['accessSecret']);
        unset($param['signature']);
        ksort($param);
        $sortQueryString = '';
        foreach ($param as $key=> $row) {
            $key = ucfirst($key);
            $sortQueryString.='&'.$this->specialUrlEncode($key).'='.$this->specialUrlEncode($row);
        }
        $this->sortQueryString = $sortQueryString;
        $sortQueryString = substr($sortQueryString,1);
        $sortQueryString = 'GET&'.$this->specialUrlEncode('/').'&'.$this->specialUrlEncode($sortQueryString);
        $sign = hash_hmac('sha1', $sortQueryString,$this->request->getAccessSecret().'&',true);
        $sign = base64_encode($sign);
        $Signature = $this->specialUrlEncode($sign);
        return $Signature;
    }

    private function paramValidate()
    {
        if (!$this->request->getAccessKeyId()) {
            throw new \Exception('AccessKeyId is Required');
        }
        if (!$this->request->getAccessSecret()) {
            throw new \Exception('AccessSecret is Required');
        }
        if (!$this->request->getAction()) {
            throw new \Exception('Action is Required');
        }
        if (!$this->request->getFormat()) {
            $this->request->setFormat('json');
        } else {
            $format = $this->request->getFormat();
            $format = strtolower($format);
            if (!($format === 'json' || $format === 'xml')) {
                throw new \Exception('Format Must In json or xml');
            }
        }
        if (!$this->request->getAction()) {
            throw new \Exception('Action is Required');
        }
        if (!$this->request->getRegionId()) {
            $this->request->setRegionId('cn-hangzhou');
        }
        if (!$this->request->getSignatureMethod()) {
            $this->request->setSignatureMethod('HMAC-SHA1');
        } elseif ($this->request->getSignatureMethod() !== 'HMAC-SHA1') {
            throw new \Exception('SignatureMethod Is Must HMAC-SHA1');
        }
        if (!$this->request->getSignatureNonce()) {
            throw new \Exception('SignatureNonce is Required');
        }
        if (!$this->request->getSignatureVersion()) {
            $this->request->setSignatureVersion('1.0');
        }
        if (!$this->request->getTimestamp()) {
            $this->request->setTimestamp($this->getTimeStamp());
        }
        if (!$this->request->getVersion()) {
            $this->request->setVersion('2017-05-25');
        }
    }

    public function specialUrlEncode($value) :string
    {
        if (!$value) $value = '';
        $str = urlencode($value);
        $str = str_replace('+','%20',$str);
        $str = str_replace('*','%2A',$str);
        $str = str_replace('%7E','~',$str);
        return $str;
    }

    public function getTimeStamp()
    {
        $timeZone = date_default_timezone_get();
        date_default_timezone_set('Etc/GMT');
        $timeStamp = str_replace('+00:00', 'Z', gmdate('c')) ;
        date_default_timezone_set($timeZone);
        return $timeStamp;
    }
}