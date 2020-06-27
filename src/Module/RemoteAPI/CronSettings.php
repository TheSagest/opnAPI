<?php

namespace App\Module\RemoteAPI;

class CronSettings extends BaseCommand
{
    protected $module = 'cron';
    protected $controller = 'settings';

    public function addjob()
    {
        $this->command = 'addjob';

        return $this->post();
    }

    public function deljob(string $uuid)
    {
        $this->command = 'deljob';

        return $this->post([$uuid]);
    }

    public function getjob(string $uuid)
    {
        $this->command = 'getjob';

        return $this->get([$uuid]);
    }

    public function searchjobs()
    {
        $this->command = 'searchjobs';

        return $this->get();
    }

    public function setjob(string $uuid)
    {
        $this->command = 'deljob';

        return $this->post([$uuid]);
    }

    public function togglejob(string $uuid, bool $enabled)
    {
        $this->command = 'togglejob';

        return $this->post([
            $uuid,
            $enabled
        ]);
    }
}