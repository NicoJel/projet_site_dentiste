<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotifRepository")
 */
class Motif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acte;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActe(): ?string
    {
        return $this->acte;
    }

    public function setActe(string $acte): self
    {
        $this->acte = $acte;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }
}
