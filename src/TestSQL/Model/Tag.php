<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 26/02/2015
 * Time: 01:25
 */

namespace TestSQL\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="tags")
 **/
class Tag {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @Column(type="string", length=255)
     */
    protected $nom;


    public function __construct(){
        $this->articles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setid($id)
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