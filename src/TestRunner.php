<?php

use TestDoctrine\Action;
use TestDoctrine\Entity\Article;

class TestRunner {
    private $chrono;


    /**
     * @return TestDoctrine\Entity\Article[]
     */
    public function getDoctrineArticles() {
        $entityManager = Action::getEntityManager();
        $dql = "SELECT a, i, u FROM TestDoctrine\Entity\Article a JOIN a.image i JOIN a.auteur u ORDER BY a.id DESC";
        $this->startChrono();
        $query = $entityManager->createQuery($dql);
        $results = $query->getResult();
        $this->stopChrono();
        return $results;

    }

    /**
     * @return \TestPropel\Article[]
     */
    public function getPropelArticles(){
        require_once 'TestPropel/generated-conf/config.php';
        $this->startChrono();
        $articles =  \TestPropel\ArticleQuery::create()
            ->joinImage()
            ->joinAuteur()
            ->orderById()
            ->find();
        $this->stopChrono();
        return $articles;
    }


    public function execDoctrineTest()
    {
        $action = new TestDoctrine\Action();
        $entityManager = $action->getEntityManager();
        $this->startChrono();
        $fixtures = $action->getDoctrineFixtures();
        //var_dump($fixtures);


        foreach($fixtures as $article){
            if($article instanceof Article){
                $entityManager->persist($article);
            }
        }
        $entityManager->flush();
        return $this->stopChrono();
    }

    public function execPropelTest()
    {
        require_once 'TestPropel/generated-conf/config.php';
        $action = new TestPropel\Action();
        $this->startChrono();
        $action->insert();
        return $this->stopChrono();

    }


    public function execSqlTest(){
        $action = new TestSQL\Action();
        $this->startChrono();
        $action->insert();
        return $this->stopChrono();
    }

    private function startChrono(){
        $this->chrono = microtime(true);
    }

    private function stopChrono(){
        $this->chrono = microtime(true) - $this->chrono;
        return $this->chrono;
    }

    public function getChrono(){
        return $this->chrono;
    }
}