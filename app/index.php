<?php
use Memory\Entity\Game;
$entityManager  = require '../bootstrap.php';

require_once '..' . DIRECTORY_SEPARATOR . 'config.php';

include 'header.php';

// On récupère notre liste de games afin de pouvoir afficher les meilleurs scores
$gameRepo       = $entityManager->getRepository(Game::class);
$gamesToDisplay = $gameRepo->findBy([], ['time' => 'ASC'], NB_PLAYERS_DISPLAY);
?>

<div id="leaderboard">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <?php if (empty($gamesToDisplay)) : ?>
                    <p class="text-center">Aucun joueur enregistré actuellement <br /> Sois le premier !</p>
                <?php else: ?>
                <table class="table table-responsive w-auto">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Joueur</th>
                            <th scope="col">Temps</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $gameCount = 1;

                        foreach ($gamesToDisplay as $game) { ?>
                        <tr>
                            <th scope="row"><?php echo $gameCount; ?></th>
                            <td><?php echo $game->getPlayer(); ?></td>
                            <td><?php echo date('i:s', $game->getTime()); ?></td>
                            <!-- Ici, il pourrait être intéressant de définir un timezone dynamiquement selon l'endroit ou se trouve l'utilisateur -->
                            <td><?php echo $game->getCreatedAt()->setTimezone(new DateTimeZone('Europe/Paris'))->format('Y-m-d H:i'); ?></td>
                        </tr>
                        <?php
                            $gameCount++;
                        } ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="game.php" id="start" class="btn btn-primary">Commencer</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>