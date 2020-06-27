<?php

namespace App\Module\RemoteAPI;

class DiagnosticsSystemHealth extends BaseCommand
{
    protected $module = 'diagnostics';
    protected $controller = 'systemhealth';

    public function getSystemHealth()
    {
        $this->command = 'getSystemHealth';

        return $this->get();
    }
}