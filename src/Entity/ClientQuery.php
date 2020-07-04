<?php

namespace App\Entity;

use App\Entity\ClientApiUrl;
use App\Repository\ClientQueryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientQueryRepository::class)
 */
class ClientQuery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $IPAddress;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeQueried;

    /**
     * @ORM\ManyToOne(targetEntity=ClientApiUrl::class, inversedBy="clientQueries")
     */
    private $clientApiUrl;

    public function getId()
    {
        return $this->id;
    }

    public function getIPAddress(): ?string
    {
        return $this->IPAddress;
    }

    public function setIPAddress(string $IPAddress): self
    {
        $this->IPAddress = $IPAddress;

        return $this;
    }

    public function getTimeQueried(): ?\DateTimeInterface
    {
        return $this->timeQueried;
    }

    public function setTimeQueried(\DateTimeInterface $timeQueried): self
    {
        $this->timeQueried = $timeQueried;

        return $this;
    }

    public function getClientApiUrl(): ?ClientApiUrl
    {
        return $this->clientApiUrl;
    }

    public function setClientApiUrl(?ClientApiUrl $clientApiUrl): self
    {
        $this->clientApiUrl = $clientApiUrl;

        return $this;
    }
}
