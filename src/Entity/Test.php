<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastAccessed ;

    /**
     * @return mixed
     */
    public function getLastAccessed()
    {
        return $this->lastAccessed;
    }

    /**
     * @param mixed $lastAccessed
     * @return Test
     */
    public function setLastAccessed($lastAccessed)
    {
        $this->lastAccessed = $lastAccessed;
        return $this;
    }





    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestName(): ?string
    {
        return $this->testName;
    }

    public function setTestName(string $testName): self
    {
        $this->testName = $testName;

        return $this;
    }
}
