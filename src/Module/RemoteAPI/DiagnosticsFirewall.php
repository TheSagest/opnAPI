<?php

namespace App\Module\RemoteAPI;

class DiagnosticsFirewall extends BaseCommand
{
    protected $module = 'diagnostics';
    protected $controller = 'firewall';

    public function log()
    {
        $this->command = 'log';

        return $this->get();
    }
}