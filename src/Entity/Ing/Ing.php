<?php

namespace App\Entity\Ing;


use Doctrine\ORM\Mapping as ORM;
class Ing{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private
    $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Ing
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastAccessed()
    {
        return $this->lastAccessed;
    }

    /**
     * @param mixed $lastAccessed
     * @return Ing
     */
    public function setLastAccessed($lastAccessed)
    {
        $this->lastAccessed = $lastAccessed;
        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private
    $lastAccessed;
}