<?php
/**
 * Est un utilisateur du site
 *
 * Class Utilisateur
 */
class Utilisateur
{
    /**
     * @var int
     */
    private $_id;
    /**
     * @var string
     */
    private $_nom;
    /**
     * @var string
     */
    private $_prenom;
    /**
     * @var string
     */
    private $_adresse;
    /**
     * @var int
     */
    private $_cp;
    /**
     * @var string
     */
    private $_ville;
    /**
     * @var string
     */
    private $_mdp;
    /**
     * @var string
     */
    private $_mail;
    /**
     * @var int
     */
    private $_points;

    public function __construct ()
    {
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set id
     *
     * @param int $_id
     * @return Utilisateur
     */
    public function setId($_id)
    {
        $this->_id = (int) $_id;

        return $this;
    }
    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * Set nom
     *
     * @param string $_nom
     * @return Utilisateur
     */
    public function setNom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }

    /**
     * Get prénom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->_prenom;
    }

    /**
     * Set prénom
     *
     * @param string $_prenom
     * @return Utilisateur
     */
    public function setPrenom($_prenom)
    {
        $this->_prenom = $_prenom;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->_adresse;
    }

    /**
     * Set adresse
     *
     * @param string $_adresse
     * @return Utilisateur
     */
    public function setAdresse($_adresse)
    {
        $this->_adresse = $_adresse;

        return $this;
    }

    /**
     * Get cp
     *
     * @return int
     */
    public function getCp()
    {
        return $this->_cp;
    }

    /**
     *
     * Set cp
     * @param int $_cp
     * @return Utilisateur
     */
    public function setCp($_cp)
    {
        $this->_cp = (int) $_cp;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->_ville;
    }

    /**
     * Set ville
     *
     * @param string $_ville
     * @return Utilisateur
     */
    public function setVille($_ville)
    {
        $this->_ville = strtoupper($_ville);

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->_mdp;
    }

    /**
     * Set mdp
     *
     * @param string $_mdp
     * @return Utilisateur
     */
    public function setMdp($_mdp)
    {
        $this->_mdp = $_mdp;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * Set mail
     *
     * @param string $_mail
     * @return Utilisateur
     */
    public function setMail($_mail)
    {
        $this->_mail = $_mail;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->_points;
    }

    /**
     * Set points
     *
     * @param int $_points
     * @return Utilisateur
     */
    public function setPoints($_points)
    {
        $this->_points = (int) $_points;

        return $this;
    }

}
