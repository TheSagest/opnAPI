<?php

namespace App\Module\RemoteAPI;

use App\Module\APIObject\FirmwareStatusResponse;

class Firmware extends BaseCommand
{
    protected $module = 'core';
    protected $controller = 'firmware';

       public function reboot()
    {
        $this->command = 'reboot';

        return $this->post();
    }

    public function status(): FirmwareStatusResponse
    {
        $this->command = 'status';

        $response = $this->get();
        return new \App\Module\APIObject\FirmwareStatusResponse($response);
    }

    public function upgrade()
    {
        $this->command = 'upgrade';

        return $this->post();
    }

    public function audit()
    {
        $this->command = 'audit';

        return $this->post();
    }

    public function poweroff()
    {
        $this->command = 'poweroff';

        return $this->post();
    }

    public function running()
    {
        $this->command = 'running';

        return $this->get();
    }

    public function getFirmwareConfig()
    {
        $this->command = 'getFirmwareConfig';

        return $this->get();
    }

    public function getFirmwareOptions()
    {
        $this->command = 'getFirmwareOptions';

        return $this->get();
    }

    public function setFirmwareConfig()
    {
        $this->command = 'setFirmwareConfig';

        return $this->post();
    }

    public function info()
    {
        $this->command = 'info';

        return $this->get();
    }
    public function upgradestatus()
    {
        $this->command = 'upgradestatus';

        return $this->get();
    }

    public function changelog(string $version)
    {
        $this->command = 'changelog';

        return $this->post([
            $version
        ]);
    }

    public function install(string $packageName)
    {
        $this->command = 'install';

        return $this->post([
            $packageName
        ]);
    }

    public function reinstall(string $packageName)
    {
        $this->command = 'reinstall';

        return $this->post([
            $packageName
        ]);
    }

    public function remove(string $packageName)
    {
        $this->command = 'remove';

        return $this->post([
            $packageName
        ]);
    }

    public function lock(string $packageName)
    {
        $this->command = 'lock';

        return $this->post([
            $packageName
        ]);
    }

    public function unlock(string $packageName)
    {
        $this->command = 'unlock';

        return $this->post([
            $packageName
        ]);
    }

    public function details(string $packageName)
    {
        $this->command = 'details';

        return $this->post([
            $packageName
        ]);
    }

    public function license(string $packageName)
    {
        $this->command = 'license';

        return $this->post([
            $packageName
        ]);
    }
}