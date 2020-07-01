<?php

namespace App\Entity;

use App\Repository\ClientApiUrlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientApiUrlRepository::class)
 */
class ClientApiUrl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $URLName;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientApiUrls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $IpAddressList;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getURLName(): ?string
    {
        return $this->URLName;
    }

    public function setURLName(string $URLName): self
    {
        $this->URLName = $URLName;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getIpAddressList(): ?string
    {
        return $this->IpAddressList;
    }

    public function setIpAddressList(?string $IpAddressList): self
    {
        $this->IpAddressList = $IpAddressList;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->Notes;
    }

    public function setNotes(?string $Notes): self
    {
        $this->Notes = $Notes;

        return $this;
    }
}
