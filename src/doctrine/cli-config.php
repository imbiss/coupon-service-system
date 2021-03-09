<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-5-1
 * Time: обнГ10:12
 */
// cli-config.php doctrine
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);