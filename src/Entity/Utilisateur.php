<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 * @UniqueEntity(fields={"mail"}, message="Il existe déjà un utilisateur avec cet email")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * mot de passe en clair pour interagir avec le formulaire
     * @var string
     * @Assert\NotBlank(message="mdp obligatoire")
     */
    private $plainpassword;

    /**
     * @var Rdv
     * @ORM\OneToMany(targetEntity="Rdv", mappedBy="utilisateur")
     */
    private $rdv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(int $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param mixed $civilite
     * @return Utilisateur
     */
    public function setCivilite($civilite): self
    {
        if (!in_array($civilite, self::getCivilite())) {
        // -- classe d'exception en cas de valeur non prise en charge par l'application
        throw new UnexpectedValueException(
            "'$civilite' n'est pas une civilité reconnue"
        );
    }
        $this->civilite = $civilite;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return Utilisateur
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainpassword(): ?string
    {
        return $this->plainpassword;
    }

    /**
     * @param string $plainpassword
     * @return Utilisateur
     */
    public function setPlainpassword(string $plainpassword): Utilisateur
    {
        $this->plainpassword = $plainpassword;
        return $this;
    }

    /**
     * @return Rdv
     */
    public function getRdv(): Rdv
    {
        return $this->rdv;
    }

    /**
     * @param Rdv $rdv
     * @return Utilisateur
     */
    public function setRdv(Rdv $rdv): Utilisateur
    {
        $this->rdv = $rdv;
        return $this;
    }


}
