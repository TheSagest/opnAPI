<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    public function __toString() {
        return $this->getClientName();
    }

    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $clientName;


    /**
     * @ORM\OneToMany(targetEntity=IPList::class, mappedBy="client")
     */
    private $iPLists;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ipAddress;

    /**
     * @return string
     */
    public function getFirewallOn(): string
    {
        return $this->firewallOn;
    }

    /**
     * @param string $firewallOn
     */
    public function setFirewallOn(string $firewallOn): void
    {
        $this->firewallOn = $firewallOn;
    }

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $firewallOn = 'n/a';

    /**
     * @ORM\Column(type="integer")
     */
    private $port = 443;

    /**
     * @ORM\Column(type="boolean")
     */
    private $https = 'true';

    /**
     * @ORM\Column(type="boolean")
     */
    private $scanForUp = 'true';

    /**
     * @return string
     */
    public function getScanForUp(): bool
    {
        return $this->scanForUp;
    }

    /**
     * @param string $scanForUp
     */
    public function setScanForUp(bool $scanForUp): void
    {
        $this->scanForUp = $scanForUp;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apiKey;

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ipAddress
     */
    public function setIpAddress($ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getHttps(): ?bool
    {
        return $this->https;
    }

    /**
     * @param string $https
     */
    public function setHttps(bool $https): void
    {
        $this->https = $https;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return mixed
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * @param mixed $apiSecret
     */
    public function setApiSecret($apiSecret): void
    {
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return mixed
     */
    public function getProductVersion()
    {
        return $this->productVersion;
    }

    /**
     * @param mixed $productVersion
     */
    public function setProductVersion($productVersion): void
    {
        $this->productVersion = $productVersion;
    }

    /**
     * @return mixed
     */
    public function getLocalNetworkAliasName()
    {
        return $this->localNetworkAliasName;
    }

    /**
     * @param mixed $localNetworkAliasName
     */
    public function setLocalNetworkAliasName($localNetworkAliasName): void
    {
        $this->localNetworkAliasName = $localNetworkAliasName;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apiSecret;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $productVersion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $localNetworkAliasName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Firmware::class, mappedBy="client")
     */
    private $firmware;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $localIP;



    public function __construct()
    {
        $this->iPLists = new ArrayCollection();
        $this->firmware = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * @return Collection|IPList[]
     */
    public function getIPLists(): Collection
    {
        return $this->iPLists;
    }

    public function addIPList(IPList $iPList): self
    {
        if (!$this->iPLists->contains($iPList)) {
            $this->iPLists[] = $iPList;
            $iPList->setClient($this);
        }

        return $this;
    }

    public function removeIPList(IPList $iPList): self
    {
        if ($this->iPLists->contains($iPList)) {
            $this->iPLists->removeElement($iPList);
            // set the owning side to null (unless already changed)
            if ($iPList->getClient() === $this) {
                $iPList->setClient(null);
            }
        }

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return Collection|Firmware[]
     */
    public function getFirmware(): Collection
    {
        return $this->firmware;
    }

    public function addFirmware(Firmware $firmware): self
    {
        if (!$this->firmware->contains($firmware)) {
            $this->firmware[] = $firmware;
            $firmware->setClient($this);
        }

        return $this;
    }

    public function removeFirmware(Firmware $firmware): self
    {
        if ($this->firmware->contains($firmware)) {
            $this->firmware->removeElement($firmware);
            // set the owning side to null (unless already changed)
            if ($firmware->getClient() === $this) {
                $firmware->setClient(null);
            }
        }

        return $this;
    }

    public function getLocalIP(): ?string
    {
        return $this->localIP;
    }

    public function setLocalIP(string $localIP): self
    {
        $this->localIP = $localIP;

        return $this;
    }

}