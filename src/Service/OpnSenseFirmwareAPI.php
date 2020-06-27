<?php

namespace App\Service;

class OpnSenseFirmwareAPI
{
    private $firmware;
    private $diagnosticsActivity;
    private $diagnosticsDns;
    private $diagnosticsFirewall;
    private $diagnosticsSystemHealth;
    private $cronSettings;
    private $cronService;
    private $proxyService;
    private $firewallAlias;
    private $backup;
    private $key;
    private $secret;
    private $host;
    private $port;
    private $prefix;

    public function __construct(
        \App\Module\RemoteAPI\Firmware $firmware,
        \App\Module\RemoteAPI\DiagnosticsActivity $diagnosticsActivity,
        \App\Module\RemoteAPI\DiagnosticsDns $diagnosticsDns,
        \App\Module\RemoteAPI\DiagnosticsFirewall $diagnosticsFirewall,
        \App\Module\RemoteAPI\DiagnosticsSystemHealth $diagnosticsSystemHealth,
        \App\Module\RemoteAPI\CronSettings $cronSettings,
        \App\Module\RemoteAPI\CronService $cronService,
        \App\Module\RemoteAPI\ProxyService $proxyService,
        \App\Module\RemoteAPI\FirewallAlias $firewallAlias,
        \App\Module\RemoteAPI\Backup $backup
    )
    {
        $this->firmware = $firmware;
        $this->diagnosticsActivity = $diagnosticsActivity;
        $this->diagnosticsDns = $diagnosticsDns;
        $this->diagnosticsFirewall = $diagnosticsFirewall;
        $this->diagnosticsSystemHealth = $diagnosticsSystemHealth;
        $this->cronSettings = $cronSettings;
        $this->cronService = $cronService;
        $this->proxyService = $proxyService;
        $this->firewallAlias = $firewallAlias;
        $this->backup = $backup;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @param string $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    public function firmware(): \App\Module\RemoteAPI\Firmware
    {
        $this->configure($this->firmware);
        return $this->firmware;
    }

    public function diagnosticsActivity(): \App\Module\RemoteAPI\DiagnosticsActivity
    {
        $this->configure($this->diagnosticsActivity);
        return $this->diagnosticsActivity;
    }

    public function diagnosticsDns(): \App\Module\RemoteAPI\DiagnosticsDns
    {
        $this->configure($this->diagnosticsDns);
        return $this->diagnosticsDns;
    }

    public function diagnosticsFirewall(): \App\Module\RemoteAPI\DiagnosticsFirewall
    {
        $this->configure($this->diagnosticsFirewall);
        return $this->diagnosticsFirewall;
    }

    public function diagnosticsSystemHealth(): \App\Module\RemoteAPI\DiagnosticsSystemHealth
    {
        $this->configure($this->diagnosticsSystemHealth);
        return $this->diagnosticsSystemHealth;
    }

    public function cronSettings(): \App\Module\RemoteAPI\CronSettings
    {
        $this->configure($this->cronSettings);
        return $this->cronSettings;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port): void
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix): void
    {
        $this->prefix = $prefix;
    }

    public function cronService(): \App\Module\RemoteAPI\CronService
    {
        $this->configure($this->cronService);
        return $this->cronService;
    }

    public function proxyService(): \App\Module\RemoteAPI\ProxyService
    {
        $this->configure($this->proxyService);
        return $this->proxyService;
    }

    public function firewallAlias(): \App\Module\RemoteAPI\FirewallAlias
    {
        $this->configure($this->firewallAlias);
        return $this->firewallAlias;
    }

    public function backup(): \App\Module\RemoteAPI\Backup
    {
        $this->configure($this->backup);
        return $this->backup;
    }

    private function configure(\App\Module\RemoteAPI\BaseCommand $baseCommand)
    {
        $baseCommand->setHost($this->host);
        $baseCommand->setKey($this->key);
        $baseCommand->setSecret($this->secret);
        $baseCommand->setPort($this->port);
        $baseCommand->setPrefix($this->prefix);
    }

}