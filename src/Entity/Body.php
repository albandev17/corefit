<?php

namespace App\Entity;

use App\Repository\BodyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BodyRepository::class)
 */
class Body
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bodies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poids;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bras;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ventre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuisse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getBras(): ?string
    {
        return $this->bras;
    }

    public function setBras(?string $bras): self
    {
        $this->bras = $bras;

        return $this;
    }

    public function getVentre(): ?string
    {
        return $this->ventre;
    }

    public function setVentre(?string $ventre): self
    {
        $this->ventre = $ventre;

        return $this;
    }

    public function getCuisse(): ?string
    {
        return $this->cuisse;
    }

    public function setCuisse(?string $cuisse): self
    {
        $this->cuisse = $cuisse;

        return $this;
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
}
