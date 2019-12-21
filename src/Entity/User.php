<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     "email",
 *     message="cet email est déjà utilisé"
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Assert\NotNull(
     *     message= "Vous devez renseigner un prénom"
     *  )
     *  @Assert\NotBlank(
     *     message= "Vous devez renseigner un prénom"
     *  )
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Le prénom ne peut pas excéder {{ limit }} caractères",
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Assert\NotNull(
     *     message= "Vous devez renseigner un nom"
     *  )
     *  @Assert\NotBlank(
     *     message= "Vous devez renseigner un nom"
     *  )
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Le nom ne peut pas excéder {{ limit }} caractères",
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(
     *     message= "Vous devez renseigner une adresse email"
     *  )
     * @Assert\NotBlank(
     *     message= "Vous devez renseigner une adresse email"
     *  )
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne peut pas excéder {{ limit }} caractères"
     * )
     * @Assert\Email(
     *     message = "L'email {{ value }} n'est pas valide.",
     * )
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreationDate()
    {
        $this->setCreatedAt(new \Datetime());
    }
}
