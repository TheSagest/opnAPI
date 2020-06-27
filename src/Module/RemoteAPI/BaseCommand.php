<?php

namespace App\Module\RemoteAPI;

abstract class BaseCommand
{
    protected $module;
    protected $controller;
    protected $command;
    protected $parameters = [];
    protected $allowedParameters = [];
    private $key;
    private $secret;
    private $host;
    private $prefix;

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
    protected $port;

    private function getClient()
    {
        return new \GuzzleHttp\Client([
            'verify' => false,
            'timeout'  => 25.0
        ]);
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

    /**
     * @param array|null $parameters
     * @param bool $decode
     * @return mixed
     * @throws \Exception
     */
    protected function get(?array $parameters = [], $decode = true)
    {
        $parameters = implode('/', $parameters);
//        $uri = "https://{$this->host}/api/{$this->module}/{$this->controller}/{$this->command}/{$parameters}";
        // Dynamic Port and HTTP or HTTPS
        $uri = "{$this->prefix}{$this->host}:{$this->port}/api/{$this->module}/{$this->controller}/{$this->command}/{$parameters}";



        Try {
            $response = $this->getClient()->get($uri, [
                'auth' => [$this->key, $this->secret]
            ]);

        } catch (\GuzzleHttp\Exception\GuzzleException $e){


        }



        if ($response->getStatusCode() != 200)
        {
            throw new \Exception(sprintf('Sage Error Code: %s. Body: %s ', $response->getStatusCode(), $response->getBody()));
        }

        if ($decode)
        {
            return json_decode($response->getBody());
        }

        return (string)$response->getBody();
    }

    /**
     * @param null $parameters
     * @param bool $decode
     * @return mixed
     * @throws \Exception
     */
    protected function post($parameters, $decode = true)
    {

//        $parameterQuery = implode('/', array_map('json_encode', $parameters));
//        $parameters = json_decode($parameters);



        $uri = "{$this->prefix}{$this->host}:{$this->port}/api/{$this->module}/{$this->controller}/{$this->command}/{$parameters}";

//        dd($uri);

        $response = $this->getClient()->post($uri, [
            'auth' => [$this->key, $this->secret],
            \GuzzleHttp\RequestOptions::JSON => $parameters
        ]);



        if ($response->getStatusCode() != 200)
        {
            throw new \Exception(sprintf('Error Code: %s. Body: %s ', $response->getStatusCode(), $response->getBody()));
        }

        if ($decode)
        {
            return json_decode($response->getBody());
        }

        return (string)$response->getBody();
    }


}