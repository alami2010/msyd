<?php

/**
 * Created by IntelliJ IDEA.
 * User: ADMINIBM
 * Date: 06/11/2016
 * Time: 08:29
 */
class Personne
{


    private $id ;
    private $ville ;
    private $adresse ;
    private $codePostal ;

    /**
     * Personne constructor.
     * @param $id
     * @param $ville
     * @param $adresse
     * @param $codePostal
     */
    public function __construct($id, $ville, $adresse, $codePostal)
    {
        $this->id = $id;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
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
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
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
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }








}

