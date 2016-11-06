<?php

/**
 * Created by IntelliJ IDEA.
 * User: ydahar
 * Date: 06/11/2016
 * Time: 08:29
 */
class Personne
{


    private $personne ;
    private $service ;

    /**
     * Personne constructor.
     * @param $personne
     * @param $service
     */
    public function __construct($personne, $service)
    {
        $this->personne = $personne;
        $this->service = $service;
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
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }




}

