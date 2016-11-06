<?php

/**
 * Created by IntelliJ IDEA.
 * User: ydahar
 * Date: 06/11/2016
 * Time: 08:29
 */
class Personne
{


    private $id ;
    private $nom ;

    /**
     * Personne constructor.
     * @param $id
     * @param $nom
     */
    public function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
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




}

