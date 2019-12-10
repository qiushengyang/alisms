<?php
/**
 * Created by PhpStorm.
 * User: shenyang.qiu
 * Date: 2019/12/10
 * Time: 15:23
 */
namespace AliSms\Request;

class QueryDetailRequest extends Request {
    public $phoneNumber;
    public $sendDate;
    public $currentPage = 1;
    public $pageSize = 10;
    public $bizId = '';

    public function setPhoneNumber(string $PhoneNumber) {
        $this->phoneNumber = $PhoneNumber;
    }

    public function getPhoneNumber() :string
    {
        return $this->phoneNumber;
    }

    public function setSendDate(string $SendDate)
    {
        $this->sendDate = $SendDate;
    }

    public function getSendDate()
    {
        return $this->sendDate;
    }

    public function setCurrentPage(int $CurrentPage)
    {
        $this->currentPage = $CurrentPage;
    }

    public function getCurrentPage() :int
    {
        return $this->currentPage;
    }

    public function setPageSize(int $PageSize)
    {
        $this->pageSize = $PageSize;
    }

    public function getPageSize() :int
    {
        return $this->pageSize;
    }

    public function setBizId(string $BizId)
    {
        return $this->bizId = $BizId;
    }

    public function getBizId() :string
    {
        return $this->bizId;
    }
}