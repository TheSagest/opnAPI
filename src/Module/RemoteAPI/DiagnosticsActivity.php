<?php

namespace App\Module\RemoteAPI;

class DiagnosticsActivity extends BaseCommand
{
    protected $module = 'diagnostics';
    protected $controller = 'activity';

    public function getActivity()
    {
        $this->command = 'getActivity';

        return $this->post();
    }
}