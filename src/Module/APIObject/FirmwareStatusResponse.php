<?php


namespace App\Module\APIObject;


class FirmwareStatusResponse
{
    private $connection;
    private $downgrade_packages;
    private $download_size;
    private $last_check;
    private $new_packages;
    private $os_version;
    private $product_name;
    private $product_version;
    private $reinstall_packages;
    private $remove_packages;
    private $repository;
    private $updates;
    private $upgrade_major_message;
    private $upgrade_major_version;
    private $upgrade_needs_reboot;
    private $upgrade_packages;
    private $all_packages;
    private $status_upgrade_action;
    private $status_msg;
    private $status;

    public function __construct(\stdClass $obj)
    {

        $this->connection =  $obj->connection;
        $this->downgrade_packages =$obj->downgrade_packages; // This is an Array
        $this->download_size = $obj->download_size;
        $this->last_check = $obj->last_check;
        $this->new_packages = $obj->new_packages; // This is an Array
        $this->os_version = $obj->os_version;
        $this->product_name = $obj->product_name;
        $this->product_version = $obj->product_version;
        $this->reinstall_packages = $obj->reinstall_packages; // This is an Array
        $this->remove_packages = $obj->remove_packages;   // This is an Array
        $this->repository = $obj->repository;
        $this->updates = $obj->updates;
        $this->upgrade_major_message = $obj->upgrade_major_message;
        $this->upgrade_major_version = $obj->upgrade_major_version;
        $this->upgrade_needs_reboot = $obj->upgrade_needs_reboot;
        $this->upgrade_packages = $obj->upgrade_packages; // This is an Array
        $this->all_packages = $obj->all_packages; // This is an Array

        if(property_exists($obj,'status_upgrade_action' )){
            $this->status_upgrade_action = $obj->status_upgrade_action;
        }
        else{
            $this->status_upgrade_action = "n/a";
        }

        $this->status_msg = $obj->status_msg;
        $this->status = $obj->status;

    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getStatusUpgradeAction()
    {
        return $this->status_upgrade_action;
    }

    /**
     * @return mixed
     */
    public function getDowngradePackages()
    {
        return $this->downgrade_packages;
    }

    /**
     * @return mixed
     */
    public function getDownloadSize()
    {
        return $this->download_size;
    }

    /**
     * @return mixed
     */
    public function getLastCheck()
    {
        return $this->last_check;
    }

    /**
     * @return mixed
     */
    public function getNewPackages()
    {
        return $this->new_packages;
    }

    /**
     * @return mixed
     */
    public function getOsVersion()
    {
        return $this->os_version;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @return mixed
     */
    public function getProductVersion()
    {
        return $this->product_version;
    }

    /**
     * @return mixed
     */
    public function getReinstallPackages()
    {
        return $this->reinstall_packages;
    }

    /**
     * @return mixed
     */
    public function getRemovePackages()
    {
        return $this->remove_packages;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return mixed
     */
    public function getUpdates()
    {
        return $this->updates;
    }

    /**
     * @return mixed
     */
    public function getUpgradeMajorMessage()
    {
        return $this->upgrade_major_message;
    }

    /**
     * @return mixed
     */
    public function getUpgradeMajorVersion()
    {
        return $this->upgrade_major_version;
    }

    /**
     * @return mixed
     */
    public function getUpgradeNeedsReboot()
    {
        return $this->upgrade_needs_reboot;
    }

    /**
     * @return mixed
     */
    public function getUpgradePackages()
    {
        return $this->upgrade_packages;
    }

    /**
     * @return mixed
     */
    public function getAllPackages()
    {
        return $this->all_packages;
    }

    /**
     * @return mixed
     */
    public function getStatusMsg()
    {
        return $this->status_msg;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
}