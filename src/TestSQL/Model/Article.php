<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 25/02/2015
 * Time: 21:18
 */

namespace TestSQL\Model;
use Doctrine\Common\Collections\ArrayCollection;

class Article {

    protected $id;

    private $titre;

    private $contenu;

    private $image;

    private $auteur;

    private $commentaires;

    private $tags;

    public function __construct(){
        $this->commentaires = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

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
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return Utilisateur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur(Utilisateur $auteur)
    {
        $auteur->addArticle($this);
        $this->auteur = $auteur;
    }

    /**
     * @return Commentaire[]
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param Commentaire $commentaire
     */
    public function addCommentaire(Commentaire $commentaire)
    {
        $commentaire->setArticle($this);
        $this->commentaires[] = $commentaire;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }


}