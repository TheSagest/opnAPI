<?php


namespace App\Module\APIObject;


class FirmwareInfoResponse
{
    private $productName;
    private $version;

    public function __construct(\stdClass $obj)
    {
        $this->productName = $obj->product_name;
        $this->version = $obj->product_version;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }


}