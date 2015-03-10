<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 02/03/2015
 * Time: 20:11
 */

namespace TestPropel;

use Nelmio\Alice\Loader\Yaml;
use \TestPropel\Article;
use \TestPropel\Commentaire;
use \TestPropel\Tag;

class Action {

    private $loader;

    public function __construct(){
        $this->loader = new Yaml();
    }

    /**
     * @return Article[]
     */
    private function getArticles(){
        $fixtures = $this->loader->load(__DIR__.'/fixtures/articles.yml');
        $articles = array();
        foreach($fixtures as $article){
            if($article instanceof Article){
                $articles[] = $article;
            }
        }
        return $articles;
    }

    /**
     * return a random amount of commentaire
     * @return Commentaire[]
     */
    private function getCommentaires(){
        $fixtures = $this->loader->load(__DIR__.'/fixtures/commentaires.yml');
        $commentaires = array();
        $nb_commmentaire = rand(0, 15);
        $i = 0;
        foreach($fixtures as $commentaire){
            if($commentaire instanceof Commentaire){
                if($nb_commmentaire == $i){
                    break;
                }
                $i++;
                $commentaires[] = $commentaire;
            }
        }
        return $commentaires;
    }

    /**
     * @return Tag[]
     */
    private function getTags(){
        return $this->loader->load(__DIR__.'/fixtures/tags.yml');
    }

    public function insert(){
        $articles = $this->getArticles();
        foreach($articles as $article){
            $article->save();
            $commentaires = $this->getCommentaires();
            foreach($commentaires as $commentaire){
                $commentaire->setArticle($article);
                $commentaire->save();
            }
            $tags = $this->getTags();
            foreach($tags as $tag){
                $article_tag = new \TestPropel\ArticleTag();
                $article_tag->setArticle($article);
                $article_tag->setTag($tag);
                $article_tag->save();
            }

        }
    }

}