<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource(itemOperations={"get"},
 *              collectionOperations={"get"})
 */
class Product
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * product name
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * product weight, in grams
     *
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * storage capacity, in gigabyte
     *
     * @ORM\Column(type="integer")
     */
    private $storage;

    /**
     * short product description
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * product price, integer
     *
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * release date of the product
     *
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): self
    {
        $this->releaseDate = $release_date;

        return $this;
    }
}
