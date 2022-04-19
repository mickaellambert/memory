<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test technique - O'Clock</title>

        <link rel="icon" href="../assets/images/favicon.ico" />

        <link href="../assets/style/main.css" rel="stylesheet">
        <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

        <script src="../vendor/components/jquery/jquery.js"></script>
        <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    </head>
    <body>
        <h1 class="m-4 text-center">Memory</h1>

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
        var choices = [];
        var guessing = false;
        var memory = $('#memory');

        $('#memory .memory-card.verso').on('click', function() {
            var $this = $(this);
            if (memory.attr('data-active') === '1') {
                if (guessing) {
                    $this.removeClass('verso');
                    $this.addClass('recto');
                    choices.push(parseInt($this.attr('data-num-card')));

                    memory.attr('data-active', '0');

                    setTimeout(
                        function()
                        {
                            if (check_similar()) {
                                alert('WAH');
                                $('#memory .memory-card.recto').attr('data-resolved', '1');
                            }
                            else {
                                $('#memory .memory-card.recto[data-resolved="0"]').removeClass('recto').addClass('verso');
                            }

                            memory.attr('data-active', '1');
                            choices = [];
                        }, 1000);

                    guessing = false;
                }
                else {
                    $this.removeClass('verso');
                    $this.addClass('recto');
                    choices.push(parseInt($this.attr('data-num-card')));

                    guessing = true;
                }
            }
        });
    });
</script>