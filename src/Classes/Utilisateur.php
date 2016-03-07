<?php

namespace Nostromo\Classes;

/**
 * Est un utilisateur du site.
 *
 * Class Utilisateur
 */
class Utilisateur
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $adresse;
    /**
     * @var int
     */
    private $cp;
    /**
     * @var string
     */
    private $ville;
    /**
     * @var string
     */
    private $mdp;
    /**
     * @var string
     */
    private $mail;
    /**
     * @var int
     */
    private $points;

    /**
     * Utilisateur constructor.
     * @param int       $id
     * @param string    $nom
     * @param string    $prenom
     * @param string    $adresse
     * @param int       $cp
     * @param string    $ville
     * @param string    $mdp
     * @param string    $mail
     * @param int       $points
     */
    public function __construct(
        $id = null,
        $nom = null,
        $prenom = null,
        $adresse = null,
        $cp = null,
        $ville = null,
        $mdp = null,
        $mail = null,
        $points = null
    ) {

        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->mdp = $mdp;
        $this->mail = $mail;
        $this->points = $points;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return Utilisateur
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }
    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get prénom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set prénom.
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set adresse.
     *
     * @param string $adresse
     *
     * @return Utilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get cp.
     *
     * @return int
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set cp.
     *
     * @param int $cp
     *
     * @return Utilisateur
     */
    public function setCp($cp)
    {
        $this->cp = (int) $cp;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = strtoupper($ville);

        return $this;
    }

    /**
     * Get mdp.
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set mdp.
     *
     * @param string $mdp
     *
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mail.
     *
     * @param string $mail
     *
     * @return Utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get points.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points.
     *
     * @param int $points
     *
     * @return Utilisateur
     */
    public function setPoints($points)
    {
        $this->points = (int) $points;

        return $this;
    }
}
