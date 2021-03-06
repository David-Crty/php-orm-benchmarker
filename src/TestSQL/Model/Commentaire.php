<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 26/02/2015
 * Time: 01:11
 */

namespace TestSQL\Model;

/**
 * @Entity @Table(name="commentaires")
 **/
class Commentaire {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @ManyToOne(targetEntity="Article", inversedBy="commentaires")
     * @JoinColumn(name="article_id", referencedColumnName="id")
     **/
    private $article;

    /**
     * @Column(type="text")
     */
    private $message;

    /**
     * @ManyToOne(targetEntity="Utilisateur", inversedBy="commentaires", cascade={"persist"})
     * @JoinColumn(name="utilisateur_id", referencedColumnName="id")
     **/
    private $utilisateur;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     */
    public function setUtilisateur(Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }


}