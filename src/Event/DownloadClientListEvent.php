<?php

namespace App\Event;

class DownloadClientListEvent
{
    /**
     * @var string
     */
    private $client;

    /**
     * @var string
     */
    private $list;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     * @return DownloadClientListEvent
     */
    public function setClient(string $client): DownloadClientListEvent
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /**
     * @param string $list
     * @return DownloadClientListEvent
     */
    public function setList(string $list): DownloadClientListEvent
    {
        $this->list = $list;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     * @return DownloadClientListEvent
     */
    public function setDateTime(\DateTime $dateTime): DownloadClientListEvent
    {
        $this->dateTime = $dateTime;
        return $this;
    }
}