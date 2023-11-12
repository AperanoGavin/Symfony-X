<?php


namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['customer:item', 'customer:list']],
    denormalizationContext: ['groups' => ['customer:item', 'customer:write']]
)]
class Customer 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['customer:item', 'customer:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:item', 'customer:write'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:item', 'customer:write'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:item', 'customer:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer:item', 'customer:write'])]
    private ?string $password = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
}
