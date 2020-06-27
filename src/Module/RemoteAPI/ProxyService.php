<?php

namespace App\Module\RemoteAPI;

class ProxyService extends BaseCommand
{
    protected $module = 'proxy';
    protected $controller = 'service';

    public function reconfigure()
    {
        $this->command = 'reconfigure';

        return $this->post();
    }

    public function restart()
    {
        $this->command = 'restart';

        return $this->post();
    }

    public function start()
    {
        $this->command = 'start';

        return $this->post();
    }

    public function status()
    {
        $this->command = 'status';

        return $this->get();
    }

    public function stop()
    {
        $this->command = 'stop';

        return $this->post();
    }
}