<?php

namespace TestDoctrine\Entity;

/**
 * @Entity @Table(name="user")
 **/
class User {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @Column(name="brith_date", type="date")
     */
    private $birthDate;

    /**
     * @Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @Column(name="favorite_number", type="integer")
     */
    private $favoriteNumber;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getFavoriteNumber()
    {
        return $this->favoriteNumber;
    }

    /**
     * @param mixed $favoriteNumber
     */
    public function setFavoriteNumber($favoriteNumber)
    {
        $this->favoriteNumber = $favoriteNumber;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}