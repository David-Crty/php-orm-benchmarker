<?php

use Nelmio\Alice\Loader\Yaml;
use TestDoctrine\DoctrineEntityManager;

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
     * @return TestDoctrine\Entity\User[]
     */
    public function getFixtures()
    {
        $loader = new Yaml();
        return $loader->load(__DIR__.'/../config/doctrine_fixtures.yml');
    }

    public function execDoctrineTest()
    {
        $entityManager = (new DoctrineEntityManager())->getEntityManager();
        $users = $this->getFixtures();
        $this->startChrono();
        foreach($users as $user){
            $entityManager->persist($user);
        }
        $entityManager->flush();
        return $this->stopChrono();
    }

    private function startChrono(){
        $this->chrono = microtime(true);
    }

    private function stopChrono(){
        return microtime(true) - $this->chrono;
    }
}