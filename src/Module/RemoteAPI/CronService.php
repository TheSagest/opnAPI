<?php

namespace App\Module\RemoteAPI;

class CronService extends BaseCommand
{
    protected $module = 'cron';
    protected $controller = 'service';

    public function reconfigure()
    {
        $this->command = 'reconfigure';

        return $this->post();
    }
}