<?php

namespace App\Module\RemoteAPI;

class FirewallAlias extends BaseCommand
{
    protected $module = 'firewall';
    protected $controller = 'alias';

    public function searchItem()
    {
        $this->command = 'searchItem';

        return $this->post();
    }

    public function setItem($uuid)
    {
        $this->command = 'setItem';

        return $this->post($uuid);
    }

    public function addItem()
    {
        $this->command = 'addItem';

        return $this->post();
    }

    public function getItem(string $uuid = null)
    {
        $this->command = 'getItem';

        return $this->post( $uuid);
    }

    public function getAliasUUID($name){

        $this->command = 'getAliasUUID';

        return $this->post($name);
    }

    public function aliasEnabled ( $name){

        $uuid = $this->getAliasUUID($name);

        $enabled = 'unknown';

        if ($uuid) {
            $result = $this->getItem($uuid->uuid);
            $enabled = $result->alias->enabled;

            if ($enabled == '1'){
                $enabled = "On";
            } else {
                $enabled = 'Off';
            }
        }
        return $enabled;
    }

    public function toggleItem($uuid)
    {
        $this->command = 'toggleItem';

        return $this->post($uuid);
    }



    public function listCountries()
    {
        $this->command = 'listCountries';

        return $this->post();
    }

    public function reconfigure()
    {
        $this->command = 'reconfigure';

        return $this->post('');
    }

    public function delItem($uuid)
{
    $this->command = 'delItem';

    return $this->post([$uuid]);
}
}