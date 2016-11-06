<?php

/**
 * Created by IntelliJ IDEA.
 * User: ydahar
 * Date: 06/11/2016
 * Time: 08:29
 */
class Service
{



    private $id ;
    private $nom ;
    private $description ;
    private $prix;
    private $unite ;
    private $tel ;
    private $image ;
    private $datePublication ;
    private $dateEvent ;
    private $type ;
    private $isSignaled ;
    private $isValid ;
    private $adresse;
    private $personne;
    private $domaine;

    /**
     * Service constructor.
     * @param $id
     * @param $nom
     * @param $description
     * @param $prix
     * @param $unite
     * @param $tel
     * @param $image
     * @param $datePublication
     * @param $dateEvent
     * @param $type
     * @param $isSignaled
     * @param $isValid
     * @param $adresse
     * @param $personne
     * @param $domaine
     */
    public function __construct($id, $nom, $description, $prix, $unite, $tel, $image, $datePublication, $dateEvent, $type, $isSignaled, $isValid, $adresse, $personne, $domaine)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->unite = $unite;
        $this->tel = $tel;
        $this->image = $image;
        $this->datePublication = $datePublication;
        $this->dateEvent = $dateEvent;
        $this->type = $type;
        $this->isSignaled = $isSignaled;
        $this->isValid = $isValid;
        $this->adresse = $adresse;
        $this->personne = $personne;
        $this->domaine = $domaine;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * @param mixed $unite
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param mixed $datePublication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }

    /**
     * @return mixed
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * @param mixed $dateEvent
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getIsSignaled()
    {
        return $this->isSignaled;
    }

    /**
     * @param mixed $isSignaled
     */
    public function setIsSignaled($isSignaled)
    {
        $this->isSignaled = $isSignaled;
    }

    /**
     * @return mixed
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param mixed $personne
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
    }

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param mixed $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }





}

