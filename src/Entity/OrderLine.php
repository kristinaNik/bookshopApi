<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderLineRepository;
use App\Traits\Timestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *
 *)
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine
{
    use Timestamps;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orderLines")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $totalPrice;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return  $this;
    }


}
