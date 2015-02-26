<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 26/02/2015
 * Time: 01:25
 */

namespace TestDoctrine\Entity;
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

    /**
     * @ManyToMany(targetEntity="Article", mappedBy="tags")
     **/
    private $articles;

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
     * @return Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param Article $article
     */
    public function addArticle(Article $article)
    {
        $this->articles = $article;
    }

}