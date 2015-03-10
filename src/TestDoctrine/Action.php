<?php

namespace TestDoctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Parser;
use Nelmio\Alice\Loader\Yaml;

class Action {

    /**
     * @return EntityManager
     */
    public static function getEntityManager(){

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entity"), $isDevMode);
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents(__DIR__."/../../config/doctrine.yml"));
        $dbParams = $value['database'];
        return EntityManager::create($dbParams, $config);
    }

    /**
     * @return \TestDoctrine\Entity\User[]
     */
    public function getDoctrineFixtures()
    {
        $loader = new Yaml();
        return $loader->load(__DIR__.'/../../config/doctrine_fixtures.yml');
    }
}