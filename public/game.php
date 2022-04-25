<?php
require_once 'config.php';
include 'header.php';
?>

<div id="memory" data-active="1">
    <div class="container">
        <div class="row header">
            <div class="col d-flex justify-content-center">
                <div id="progressbar"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                $num_cards = range(1,(NB_CARDS % 2 == 1 ? NB_CARDS - 1 : NB_CARDS) * 2);
                shuffle($num_cards);

                for($lines = 1; $lines <= LINES; $lines++) { ?>
                    <div class="row">
                        <?php for ($columns = 1; $columns <= COLUMNS; $columns++) { ?>
                            <?php $num_card = array_pop($num_cards); ?>
                            <div class="col d-flex justify-content-center">
                                <div class="memory-card memory-card-<?php echo $num_card; ?> verso" data-num-card="<?php echo $num_card; ?>" data-resolved="0">
                                    <!-- Petit cheat si victoire rapide voulue
                            <span class="text-white"> <?php // echo $num_card <= NB_CARDS ? $num_card : $num_card - NB_CARDS;  ?></span> -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br />
    </div>
</div>

<script>
    var game_time = parseInt('<?php echo min(GAME_TIME, 3600); ?>');
    var nb_cards  = parseInt('<?php echo NB_CARDS % 2 == 1 ? NB_CARDS - 1 : NB_CARDS; ?>');
    var countdown = 0;
</script>

<script src="assets/js/lib/jquery.progressBarTimer.min.js"></script>
<script src="assets/js/game.js"></script>

<?php include 'footer.php'; ?>