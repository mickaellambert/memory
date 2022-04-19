<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>

        <link href="../assets/style/main.css" rel="stylesheet">
        <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

        <script src="../vendor/components/jquery/jquery.js"></script>
        <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    </head>
    <body>
        <h1> Bonjour Mickaël Lambert ! </h1>

        <div id="memory">
            <div class="container">
                <?php
                    $card_num = 1;
                    for($lines = 1; $lines <= LINES; $lines++) { ?>
                        <div class="row">
                            <?php for ($columns = 1; $columns <= COLUMNS; $columns++) { ?>
                                <div class="col d-flex justify-content-center">
                                    <div class="memory-card memory-card-<?php echo $card_num; ?> recto"></div>
                                </div>
                            <?php
                                $card_num++;
                                }
                            ?>
                        </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function() {
        console.log('mon js');
    });
</script>