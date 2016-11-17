$(document).ready(function () {

    if ($.cookie('cookiebar') === undefined) {
        $("body").append('<div class="cookie" id="cookie">En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour vous proposer pour réaliser des statistiques de visites anonymes. <a href="#">En savoir plus</a> <div class="cookie_btn" id="cookie_btn">Ok</div> </div>');
        $('#cookie_btn').click(function(e){
            e.preventDefault();
            $('#cookie').fadeOut();
            $.cookie('cookiebar', "viewed" , { expires: 30 });
        });
    }

});