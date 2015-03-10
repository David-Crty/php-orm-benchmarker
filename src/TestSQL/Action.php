<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 10/03/2015
 * Time: 11:16
 */

namespace TestSQL;

use Nelmio\Alice\Loader\Yaml;
use TestSQL\Model\Commentaire;
use TestSQL\Model\Article;
use TestSQL\Model\Image;
use TestSQL\Model\Tag;
use TestSQL\Model\Utilisateur;

class Action {
    private $pdo;

    public function __construct(){
        $this->pdo = $this->getPdo();
    }

    /**
     * @return \PDO
     */
    private function getPdo(){
        return new \PDO('mysql:host=localhost;dbname=sql', 'sqluser', '8R9pPn7x');
    }

    /**
     * @return array
     */
    private function getFixtures()
    {
        $loader = new Yaml();
        return $loader->load(__DIR__.'/sql_fixtures.yml');
    }

    private function insertImage(Image $image)
    {
        $statement = $this->pdo->prepare("INSERT INTO image(url) VALUES(:url)");
        $statement->execute(array(
            "url" => $image->getUrl()
        ));
        $image->setId($this->pdo->lastInsertId());
    }

    private function insertUtilisateur(Utilisateur $utilisateur){
        $statement = $this->pdo->prepare("INSERT INTO utilisateur(pseudo, email) VALUES(:pseudo, :email)");
        $statement->execute(array(
            "pseudo" => $utilisateur->getPseudo(),
            "email" => $utilisateur->getEmail()
        ));
        $utilisateur->setId($this->pdo->lastInsertId());
    }

    private function insertArticle(Article $article){
        $statement = $this->pdo->prepare("INSERT INTO article(titre, contenu, image_id, author_id) VALUES(:titre, :contenu, :image_id, :author_id)");
        $statement->execute(array(
            "titre" => $article->getTitre(),
            "contenu" => $article->getContenu(),
            "image_id" => $article->getImage()->getId(),
            "author_id" => $article->getAuteur()->getId()
        ));
        $article->setId($this->pdo->lastInsertId());
    }

    private function insertCommentaire(Commentaire $commentaire){
        $utilisateur = $commentaire->getUtilisateur();
        $this->insertUtilisateur($utilisateur);
        $statement = $this->pdo->prepare("INSERT INTO commentaire(message, utilisateur_id, article_id) VALUES(:message, :utilisateur_id, :article_id)");
        $statement->execute(array(
            "message" => $commentaire->getMessage(),
            "utilisateur_id" => $commentaire->getUtilisateur()->getId(),
            "article_id" => $commentaire->getArticle()->getId()
        ));
        $commentaire->setId($this->pdo->lastInsertId());
    }

    private function insertTagArticle(Tag $tag, Article $article)
    {
        $statement = $this->pdo->prepare("INSERT INTO tag(nom) VALUES(:nom)");
        $statement->execute(array(
            "nom" => $tag->getNom()
        ));
        $tag->setId($this->pdo->lastInsertId());
        $statement = $this->pdo->prepare("INSERT INTO article_tag(article_id, tag_id) VALUES(:article_id, :tag_id)");
        $statement->execute(array(
            "article_id" => $article->getId(),
            "tag_id" => $tag->getId()
        ));
    }

    public function insert(){
        $fixtures = $this->getFixtures();
        foreach($fixtures as $article){
            if($article instanceof Article){
                $this->insertImage($article->getImage());
                $this->insertUtilisateur($article->getAuteur());
                $this->insertArticle($article);
                foreach($article->getCommentaires() as $commenaire){
                    $this->insertCommentaire($commenaire);
                }
                foreach($article->getTags() as $tag){
                    $this->insertTagArticle($tag, $article);
                }
            }
        }
    }


}