<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields={"mail"}, message="Il existe déjà un utilisateur avec cet email")
 */
class Utilisateur implements UserInterface, \Serializable
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

    public function eraseCredentials()
    {

    }

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="email obligatoire")
     */
    private $mail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     *
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

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $role = 'ROLE_USER';

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", length=5)
     * @Assert\Length(max="5", maxMessage="Le code postal ne doit pas dépasser 5 chiffres")
     *
     */
    private $cp;

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

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     * @return Utilisateur
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
        return $this;
    }

    /**
     * Transforme un objet User en chaîne de caractère
     * @return string
     */
    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->nom,
            $this->prenom,
            $this->civilite,
            $this->dateNaissance,
            $this->mail,
            $this->adresse,
            $this->commentaire,
            $this->password
        ]);
    }

    /**
     * Transforme une chaîne générée par serialize en objet user
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->nom,
            $this->prenom,
            $this->civilite,
            $this->dateNaissance,
            $this->mail,
            $this->adresse,
            $this->commentaire,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * Rôle sous forme d'un array
     * @return array
     */
    public function getRoles()
    {
        return [$this->role];
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * quel attribut va servir d'identifiant
     * @return string
     */
    public function getUsername()
    {
        return $this->mail;
    }


    public function __toString()
    {
        return $this->nom . ' ' . $this->prenom;
    }
}
