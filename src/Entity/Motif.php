<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotifRepository")
 * @UniqueEntity(fields={"acte"}, message="Il existe déjà un acte avec ce nom")
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
     *
     * @ORM\Column(type="string", length=100)
     */
    private $acte;

    /**
     * @ORM\Column(type="float")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="Rdv", mappedBy="motif")
     */
    private $rdv;


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

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRdv() :Collection
    {
        return $this->rdv;
    }

    /**
     * @param Collection $rdv
     * @return Motif
     */
    public function setRdv(Collection $rdv): Motif
    {
        $this->rdv = $rdv;
        return $this;
    }



    public function __toString()
    {
        return $this->acte;
    }
}
