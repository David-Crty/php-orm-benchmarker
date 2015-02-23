<?php
require_once "vendor/autoload.php";

$test = new TestRunner();
echo $test->execDoctrineTest();


/*
    require_once "bootstrap.php";
$nb = (int) $argv[1];
$start = microtime(true);
for ($i = 1; $i < $nb; $i++) {
    $product = new \Entity\Product();
    $product->setName("Product#".$i);
    $entityManager->persist($product);
}
$entityManager->flush();
$time_elapsed_us = microtime(true) - $start;
echo $i." entity created in ".round($time_elapsed_us, 5)."s\r\n";
    */