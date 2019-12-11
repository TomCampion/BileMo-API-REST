<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({"App\Doctrine\UserSetCustomerListener"})
 * @UniqueEntity(
 *     "email",
 *     message="cet email est déjà utilisé"
 * )
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource( itemOperations={"get"={"security"="is_granted('ROLE_USER') and object.getCustomer() == user", "security_message"="Sorry, but you are not related to this user."},
 *                               "delete"={"security"="is_granted('ROLE_USER') and object.getCustomer() == user", "security_message"="Sorry, but you are not related to this user."} },
 *               collectionOperations={"get"={ "openapi_context" = {"summary" = "Retrieves the collection of User resources related to to the current connected Customer."} },
 *                                     "post"={"denormalization_context"={"groups"={"post"}} } },
 *               normalizationContext={"groups"={"get"}}
 * )
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
     * user's first name
     *
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
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="First name name cannot contain a number"
     * )
     * @Groups("post")
     * @Groups("get")
     */
    private $firstname;

    /**
     * user's last name
     *
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
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Last name cannot contain a number"
     * )
     * @Groups("post")
     * @Groups("get")
     */
    private $lastname;

    /**
     * user's e-mail
     *
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
     * @Groups("post")
     * @Groups("get")
     */
    private $email;

    /**
     * customer who added the user
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * creation date of the user
     *
     * @ORM\Column(type="date")
     * @Groups("get")
     */
    private $createdAt;

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
        return $this->createdAt;
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreationDate()
    {
        $this->createdAt = new \DateTime();
    }
}
