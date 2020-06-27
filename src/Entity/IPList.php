<?php

namespace App\Entity;

use App\Repository\IPListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IPListRepository::class)
 */
class IPList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $listType;

    /**
     * @ORM\Column(type="text", length=65535)
     */
    private $IPlist;

    /**
     * @return mixed
     */
    public function getIPlist()
    {
        return $this->IPlist;
    }

    /**
     * @param mixed $IPlist
     * @return IPList
     */
    public function setIPlist($IPlist)
    {
        $this->IPlist = $IPlist;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="iPLists")
     */
    private $client;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListType(): ?string
    {
        return $this->listType;
    }

    public function setListType(string $listType): self
    {
        $this->listType = $listType;

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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
