<?php
# Fichier permettant la création d'une game

use Memory\Entity\Game;

require '..' . DIRECTORY_SEPARATOR . 'config.php';
$entityManager = require '../bootstrap.php';

$player = isset($_POST['player']) ? $_POST['player'] : DEFAULT_PLAYER;
$time   = isset($_POST['time']) ? $_POST['time'] : GAME_TIME;

$game = new Game();
$game->setPlayer($player);
$game->setTime($time);

$entityManager->persist($game);
$entityManager->flush();

// Ici, attention au retour si on souhaite utiliser ce script d'ajout dans une fonction ajax.
// En effet, on ne voudra plus rediriger l'utilisateur quelque part, mais retourner des données
// cf json_encode()

header('Location: index.php');