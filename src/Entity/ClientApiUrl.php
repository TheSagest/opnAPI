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
     * @ORM\OneToMany(targetEntity=ClientQuery::class, mappedBy="clientApiUrl")
     */
    private $clientQueries;

    public function __construct()
    {
        $this->clientQueries = new ArrayCollection();
    }

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

    /**
     * @return Collection|ClientQuery[]
     */
    public function getClientQueries(): Collection
    {
        return $this->clientQueries;
    }

    public function addClientQuery(ClientQuery $clientQuery): self
    {
        if (!$this->clientQueries->contains($clientQuery)) {
            $this->clientQueries[] = $clientQuery;
            $clientQuery->setClientApiUrl($this);
        }

        return $this;
    }

    public function removeClientQuery(ClientQuery $clientQuery): self
    {
        if ($this->clientQueries->contains($clientQuery)) {
            $this->clientQueries->removeElement($clientQuery);
            // set the owning side to null (unless already changed)
            if ($clientQuery->getClientApiUrl() === $this) {
                $clientQuery->setClientApiUrl(null);
            }
        }

        return $this;
    }
}
