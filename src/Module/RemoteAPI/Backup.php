<?php

namespace App\Module\RemoteAPI;

class Backup extends BaseCommand
{
    protected $module = 'backup';
    protected $controller = 'backup';

    public function download()
    {
        $this->command = 'download';

        return $this->get([], false);
    }
}