<?php

namespace App\Module\RemoteAPI;

class DiagnosticsDns extends BaseCommand
{
    protected $module = 'diagnostics';
    protected $controller = 'dns';

    public function reverseLookup()
    {
        $this->command = 'reverse_lookup';

        return $this->get();
    }
}