<?php

namespace App\Entity;

use App\Repository\ClientQueryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientQueryRepository::class)
 */

class ClientQuery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $IPaddress;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $clientID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IPListName;

    /**
     * @ORM\Column(type="bigint")
     */
    private $timeQueried;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIPaddress(): ?string
    {
        return $this->IPaddress;
    }

    public function setIPaddress(string $IPaddress): self
    {
        $this->IPaddress = $IPaddress;

        return $this;
    }

    public function getClientID(): ?string
    {
        return $this->clientID;
    }

    public function setClientID(string $clientID): self
    {
        $this->clientID = $clientID;

        return $this;
    }

    public function getIPListName(): ?string
    {
        return $this->IPListName;
    }

    public function setIPListName(string $IPListName): self
    {
        $this->IPListName = $IPListName;

        return $this;
    }

    public function getTimeQueried(): ?string
    {
        return $this->timeQueried;
    }

    public function setTimeQueried(int $timeQueried): self
    {
        $this->timeQueried = $timeQueried;

        return $this;
    }
}
