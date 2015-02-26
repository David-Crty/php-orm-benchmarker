<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 25/02/2015
 * Time: 21:18
 */

namespace TestDoctrine\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="articles")
 **/
class Article {
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Column(type="text")
     */
    private $contenu;

    /**
     * @OneToOne(targetEntity="Image")
     * @JoinColumn(name="image_id", referencedColumnName="id")
     **/
    private $image;

    /**
     * @ManyToOne(targetEntity="Utilisateur", inversedBy="articles")
     * @JoinColumn(name="auteur_id", referencedColumnName="id")
     **/
    private $auteur;

    /**
     * @OneToMany(targetEntity="Commentaire", mappedBy="article")
     **/
    private $commentaires;

    /**
     * @ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @JoinTable(name="articles_tags")
     **/
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
        $tag->addArticle($this);
        $this->tags[] = $tag;
    }


}