<?php

namespace TestDoctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Parser;

class DoctrineEntityManager {

    private $em;

    public function __construct(){
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entity"), $isDevMode);
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents(__DIR__."/../../config/doctrine.yml"));
        $dbParams = $value['database'];

        $this->em = $entityManager = EntityManager::create($dbParams, $config);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(){
        return $this->em;
    }

}