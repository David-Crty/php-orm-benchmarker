<?php

namespace TestDoctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="utilisateurs")
 **/
class Utilisateur {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @OneToMany(targetEntity="Article", mappedBy="auteur")
     **/
    private $articles;

    /**
     * @OneToMany(targetEntity="Commentaire", mappedBy="utilisateur")
     **/
    private $commentaires;

    public function __construct() {
        $this->articles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function addArticle(Article $article){
        $this->articles[] = $article;
    }

    /**
     * @return Article[]
     */
    public function getArticles(){
        return $this->articles;
    }

    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    public function addCommentaire(Commentaire $commentaire){
        $this->commentaires[] = $commentaire;
    }

    /**
     * @return Commentaire[]
     */
    public function getCommentaires(){
        return $this->commentaires;
    }

    public function removeCommentaire(Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }
}