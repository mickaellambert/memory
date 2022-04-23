<?php
#Fichier permettant la configuration du client console pour doctrine

$entityManager = require_once __DIR__ . DIRECTORY_SEPARATOR. 'bootstrap.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($entityManager);