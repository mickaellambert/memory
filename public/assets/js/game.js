var num_cards_chosen = [];
var guessing         = false;
var memory           = $('#memory');
var progressbar      = $('#progressbar');

$(document).ready(function() {
    // Ici, on peut voir que le choix du plugin de barre de progression n'est pas terrible
    // (décalage d'1 seconde incompréhensible,pas d'accès direct à la valeure actuelle de la barre de progression)
    // N'étant pas fan des autres librairies disponibles, notamment jquery-ui, il aurait peut être été malin de développer
    // sa propre progress bar réutilisable dans tous nos futurs projets.

    var count_seconds = setInterval(function() {
        countdown++;
    }, 1000);

    progressbar.progressBarTimer({
        timeLimit: game_time,
        autoStart: true,
        smooth: true,
        completeStyle: 'timer-fail',
        onFinish  : function () {
            // Ici, on est obligé d'ajouter une seconde au déclenchement de l'alert annoncant la défaite afin de compléter l'animation
            // En effet, je n'ai pas trouvé pourquoi il y avait un décalage d'1 seconde au démarrage.
            setTimeout(function() {
                alert('Aie aie aie, on dira que c\'est la manette ou les ligaments croisés tkt');
                document.location.href= 'index.php';
            }, 1000);
        }
    });

    // $('#memory .memory-card.verso').on('click', function() { [...] })
    // On préfère déléguer l'event handler à un ancêtre commun à tous nos éléments.
    // Permet d'éviter la confusion des déclenchements d'évènements sur des classes mises à jour par le script
    $(document).on('click', '#memory .memory-card.verso', function() {
        var $this = $(this);

        // On vérifie que notre jeu est actuellement actif / jouable
        // Attention à l'utilisation de attr a la place de data ici
        if (memory.attr('data-active') === '1') {
            // Premier choix de carte
            if (!guessing) {
                $this.removeClass('verso').addClass('recto');
                num_cards_chosen.push(parseInt($this.attr('data-num-card')));

                guessing = true;
            }
            // Second choix de carte
            else {
                $this.removeClass('verso').addClass('recto');
                num_cards_chosen.push(parseInt($this.attr('data-num-card')));

                memory.attr('data-active', '0');

                // On ajoute un timeout de 0.5s afin de rendre la vérification plus "réelle", moins instantanée
                setTimeout(function() {
                    if (check_similar()) {
                        $('#memory .memory-card.recto').attr('data-resolved', '1');

                        if (check_win()) {
                            clearInterval(count_seconds);

                            var minutes = Math.floor(countdown / 60);
                            var seconds = countdown % 60;

                            progressbar.progressBarTimer().stop();
                            progressbar.html('<p class="game-success">SCORE : ' + minutes.toString().padStart(2, '0') + 'm ' + seconds.toString().padStart(2, '0') + 's</p>');

                            // Ici, nous préférons créer notre formulaire de victoire dynamiquement plutôt que de le cacher et de l'afficher
                            // afin que l'utilisateur ne puisse pas y accéder dans le DOM et "contourner" les règles
                            var row_win_html =
                                '<div class="row footer">\n' +
                                '     <div class="col d-flex justify-content-center">\n' +
                                '          <form action="create_game.php" method="post" class="form-win text-center">\n' +
                                '               <span> Félicitations, vous avez gagné </span> <br /><br />\n' +
                                '               <input type="hidden" name="time" id="time" value="' + countdown + '" />\n' +
                                '               <div class="form-group">\n' +
                                '                    <input type="text" name="player" id="player" maxlength="30" placeholder="Votre blaz">\n' +
                                '                    <button type="submit" class="btn btn-primary">Valider</button>\n' +
                                '                </div>\n' +
                                '          </form>\n' +
                                '     </div>\n' +
                                '</div>';

                            $('#memory .container').append(row_win_html);
                            alert('Bravo, tu as gagné !! (Malheureusement, la princesse est dans un autre château Mario)');
                        }
                        else {
                            alert('Quel génie !');
                        }
                    }
                    else {
                        $('#memory .memory-card.recto[data-resolved="0"]').removeClass('recto').addClass('verso');
                    }

                    memory.attr('data-active', '1');
                    num_cards_chosen = [];
                }, 500);

                guessing = false;
            }
        }
    });
});

/*
Fonction permettant de vérifier que deux cartes sont similaires
 */
function check_similar()
{
    num_cards_chosen.sort(function(a, b) { return a - b });
    return num_cards_chosen[1] - num_cards_chosen[0] === nb_cards;
}

/*
Fonction permettant de vérifier la victoire d'un joueur
 */
function check_win()
{
    return $('#memory .memory-card[data-resolved="1"]').length === nb_cards * 2;
}

/*
Cette fonction pourrait être utile si nous voulions passer la création d'une game en mode dynamique.
Ici, les spécifications nous poussent à une redirection vers la home page
afin d'afficher la liste des meilleurs joueurs lors de la victoire

function add_game()
{
    $.ajax({
        url : 'create_game.php',
        type : 'POST',
        data : {
            'player' : 'ThePlayer',
            'time' : TheTime
        },
        dataType:'json',
        success: function(game) {
            console.log(game);
        }
    });
}
*/
