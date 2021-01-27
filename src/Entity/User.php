<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int|null
     * 
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var User|null
     * 
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="subordinates")
     */
    private $manager;

    /**
     * @var Collection<int, User>
     * 
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="manager")
     */
    private $subordinates;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=false)
     */
    private $username;

    /**
     * @var string|null
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    public function __construct(string $username)
    {
        $this->username = $username;

        $this->subordinates = new ArrayCollection();
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): void
    {
        $this->manager = $manager;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSubordinates()
    {
        return $this->subordinates;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function eraseCredentials(): void
    {
    }
}