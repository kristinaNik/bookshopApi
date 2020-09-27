<?php

namespace App\Entity;
use Gedmo\Mapping\Annotation as Gedmo;

trait Timestamps
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function createdAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     * @throws \Exception
     */
    public function updatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}
