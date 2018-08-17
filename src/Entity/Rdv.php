<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RdvRepository")
 */
class Rdv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textelibre;

    /**
     * @var Motif
     * @ORM\ManyToOne(targetEntity="Motif")
     */
    private $motif;

    /**
     * @var Utilisateur
     * @ORM\ManyToOne(targetEntity="utilisateur", inversedBy="rdv")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getTextelibre(): ?string
    {
        return $this->textelibre;
    }

    public function setTextelibre(?string $textelibre): self
    {
        $this->textelibre = $textelibre;

        return $this;
    }
    /**
     * @return Motif
     */
    public function getMotif(): Motif
    {
        return $this->motif;
    }/**
     * @param Motif $motif
     * @return Rdv
     */
    public function setMotif(Motif $motif): Rdv
    {
        $this->motif = $motif;
        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     * @return Rdv
     */
    public function setUtilisateur(Utilisateur $utilisateur): Rdv
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }




}
