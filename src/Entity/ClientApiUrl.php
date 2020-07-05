<?php

namespace App\Entity;

use App\Repository\ClientApiUrlRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $client;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $IpAddressList;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Notes;

        /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $queryFromIPaddress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateQueried;

    public function getId(): ?string
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
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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





    public function getQueryFromIPaddress(): ?string
    {
        return $this->queryFromIPaddress;
    }

    public function setQueryFromIPaddress(string $queryFromIPaddress): self
    {
        $this->queryFromIPaddress = $queryFromIPaddress;

        return $this;
    }

    public function getDateQueried(): ?\DateTimeInterface
    {
        return $this->dateQueried;
    }

    public function setDateQueried(\DateTimeInterface $dateQueried): self
    {
        $this->dateQueried = $dateQueried;

        return $this;
    }
}
