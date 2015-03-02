<?php

use Nelmio\Alice\Loader\Yaml;
use TestDoctrine\DoctrineEntityManager;
use TestDoctrine\Entity\Article;

class TestRunner {

    private $numberOfEntity;
    private $chrono;

    public function __construct(){
        $this->setNumberOfEntity(1);
    }

    /**
     * @return int
     */
    public function getNumberOfEntity()
    {
        return $this->numberOfEntity;
    }

    /**
     * @param int $numberOfEntity
     */
    public function setNumberOfEntity($numberOfEntity)
    {
        $this->numberOfEntity = $numberOfEntity;
    }

    /**
     * @return TestDoctrine\Entity\Article[]
     */
    public function getArticles() {
        $entityManager = (new DoctrineEntityManager())->getEntityManager();
        $dql = "SELECT a, i, u FROM TestDoctrine\Entity\Article a JOIN a.image i JOIN a.auteur u ORDER BY a.id DESC";
        $this->startChrono();
        $query = $entityManager->createQuery($dql);
        $results = $query->getResult();
        $this->stopChrono();
        return $results;

    }

    /**
     * @return TestDoctrine\Entity\User[]
     */
    public function getDoctrineFixtures()
    {
        $loader = new Yaml();
        return $loader->load(__DIR__.'/../config/doctrine_fixtures.yml');
    }

    public function getPropelFixtures()
    {
        $loader = new Yaml();
        return $loader->load(__DIR__.'/../config/propel_fixtures.yml');
    }

    public function execDoctrineTest()
    {
        $entityManager = (new DoctrineEntityManager())->getEntityManager();
        $fixtures = $this->getDoctrineFixtures();
        //var_dump($fixtures);

        $this->startChrono();
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
        $fixtures = $this->getPropelFixtures();

        $this->startChrono();
        foreach($fixtures as $article){
            if($article instanceof \TestPropel\Article){
                $article->save();

            }
        }
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