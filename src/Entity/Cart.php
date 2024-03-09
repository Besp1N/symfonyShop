<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $total = null;

    #[ORM\OneToOne(inversedBy: 'cart', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Products::class, mappedBy: 'cart')]
    private Collection $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Products $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->setCart($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): static
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCart() === $this) {
                $product->setCart(null);
            }
        }

        return $this;
    }
}
