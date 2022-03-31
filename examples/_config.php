<?php
use Dipnot\PttAkilliEsnaf\Config;

require_once("./../vendor/autoload.php");

// We may need to see the errors
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(-1);

// @see https://akilliesnaf.ptt.gov.tr/developer/#ortam-ve-test-kart-bilgileri
$config = new Config(true);
$config->setClientId("1000000032");
$config->setApiUser("Entegrasyon_01");
$config->setApiPass("gkk4l2*TY112");
return $config;