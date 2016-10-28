mapDpt = document.getElementById('mapDpt');

  document.addEventListener('DOMContentLoaded', function(){
  	initInteractiveMap();
    // $('[data-toggle="tooltip"]').tooltip();
    checkTopSearch();
  });


  window.addEventListener('scroll', function() {
    (window.scrollY>0)?$('body').addClass('minimised'):$('body').removeClass('minimised');
  });


if ($('#choosePerimeter')) {
  $('#choosePerimeter').slider({
    tooltip: 'always',
    formatter: function(value) {
      switch (value) {
        case 0:
          return ('Ville uniquement');
          break;
        case 1:
          return ('Villes voisines');
          break;
        case 2:
          return ('Département');
          break;
        case 3:
          return ('Départements voisins');
          break;
      }
    }
  });

  $('#choosePerimeter').on("slideStop",function(slideEvt) {
    //console.log(slide);
    refreshResult();
  });

}



function updateResultOrder(el) {
  
  if (!$("#"+el).hasClass('active')) {
    $("[id^="+ el.split('-')[0] +"]").removeClass('active');
    $("#"+el).addClass('active');
    refreshResult();
  }
}

function refreshResult() {
  myUrl   =   window.location.pathname
          +   "?mode=ajax"
          +   "&perimetre=" + $('#choosePerimeter').val()
          +   "&orderName=" + readAdvParam("order01-up")
          +   "&orderPlace=" + readAdvParam("order02-up")
          +   "&orderDispo=" + readAdvParam("order0-up")
          ;
  window.alert("AJAX: " + myUrl);
  /*
    bref, ici, appel ajax, 
    intégration du résultat
    dans le div #resultList
  */
}

function readAdvParam(el) {
  return ($("#"+el).hasClass('active') ? 'up' : 'down');
}


// formulaire du haut

function checkTopSearch(hilight) {
  if (!hilight) {hilight=false; }
  var canSearch = true;
  if (!$('#topSearchJob').val()) {
    canSearch = false;
  }

  if ($('#topSearchPlace').val() == "") {
    canSearch = false;
    if (hilight) {
      $('#topSearchPlace').addClass('has-error');
    }
  } else {
    $('#topSearchPlace').removeClass('has-error');
  }

  if (!canSearch) {
    $('#topSearchGo').addClass('disabled');
  } else {
    $('#topSearchGo').removeClass('disabled');
  }
  return canSearch;
}

function launchTopSearch() {
  if (checkTopSearch()) {
    var url =   '/annuaire/' 
                + $('#topSearchJob').val() 
                + '?lieu='
                + encodeURI($('#topSearchPlace').val())
                ;
    alert(url);
    // window.location = url;
  }
}


// interactivité des cartes

  function initInteractiveMap() {
  	map = document.getElementsByClassName('interactiveMap');

  	for (var i = 0; i < map.length; i++) {

  		myMap = map[i];
  		paths = myMap.getElementsByTagName('path');

  		for (var j = 0; j < paths.length; j++) {

        // on récupère le titre dans un attribut séparé, le title étant détruit par le tooltip.
        paths[j].setAttribute('data-title',paths[j].getAttribute('title'));

        // on remet un id si il n'est pas là
        if (!paths[j].getAttribute('id')) {
          paths[j].setAttribute('id','dpt-' + paths[j].getAttribute('data-num'));
        }

        // on ajoute un comportement de clic.
  		  paths[j].addEventListener("click", function(e){
          if (e.target.getAttribute('action') == "chooseRgn") {
            mapDpt.setAttribute("viewBox", e.target.getAttribute('maptarget'));
            $('#mapRgnCont').removeClass('mapContainerActive');
            $('#mapDptCont').addClass('mapContainerActive');
            $('#mapDptCont path').removeClass('selected');
            $('#mapDptCont path').addClass('disabled');
            var highlightDpt = e.target.getAttribute('dpt-target').split(".");
            for (var k = 0; k < highlightDpt.length; k++) {
              $('#dpt-'+highlightDpt[k]).removeClass('disabled');
            }
            //$(#searchMapText).val(e.target.getAttribute('dpt-target'));
            $("#searchMapText").html(e.target.getAttribute('data-title'));
            $("#searchMapText").attr("realvalue",convertToUrl(e.target.getAttribute('data-title')));
            updateRgnresults();

          } else {
            // $(e.target).setAttribute('id',e.target.getAttribute('data-num'));
            if (!$(e.target).hasClass('disabled')) {
              $('path').removeClass('selected');
              $(e.target).addClass('selected');



              var locUrl = $("#searchMapText").attr("realvalue").split("/")[0];
              locUrl += "/" + convertToUrl(e.target.getAttribute('data-num') + "-" + e.target.getAttribute('data-title'));
              $("#searchMapText").html(e.target.getAttribute('data-title'));
              $("#searchMapText").attr("realvalue",locUrl);
              updateRgnresults();
              chooseCity();
            }
          }

  		  })
  		}
  	}
  }

function chooseCity() {
  $("#chooseCity").addClass('active').focus();
  $("#searchMapText").addClass('cityMode');
}

function removeCity() {
  $("#chooseCity").removeClass('active').val("");
  $("#searchMapText").removeClass('cityMode');
}


function goMap(pro) {
    destination=$("#searchMapText").attr("realvalue");
    if (destination!='') {
      url="annuaire/"+pro+"/"+destination;
      window.alert(url);
    } else {
      return false;
    }
}


  function updateRgnresults() {
    /*
      appel ajax
      que l'on remplace ici par du hasard
    */

    fact = 70-(($("#searchMapText").attr("realvalue")).length);
    (fact==70)?fact=0:fact*=fact;
    // console.log(fact);

    if (fact==0) {
      $("#choosePro1Result").html("---");
      $("#choosePro2Result").html("---");
      $("#choosePro3Result").html("---");
      $(".choosePro").removeClass('enabled');
    } else {
      $("#choosePro1Result").html(fact*2);
      $("#choosePro2Result").html((fact+37)*3);
      $("#choosePro3Result").html((fact+150)*5);
      $(".choosePro").addClass('enabled');
    }


    /* fin de simulation */

  }


  function showDetails(idx) {
    $('#displayInfo').modal();
  }


  function chooseRgn() {
    $('#mapDptCont').removeClass('mapContainerActive');
    $('#mapRgnCont').addClass('mapContainerActive');
    $("#searchMapText").html($("#searchMapText").attr("backValue"));
    $("#searchMapText").attr("realvalue","");
    updateRgnresults();
    removeCity();
  }



function showSearch() {
  $(document.body).removeClass('minimised')
}


  function convertToUrl(name) {

    return  name
          .toLowerCase()
          .replace(/[éèêë]/g,"e")
          .replace(/[ùûúü]/g,"u")
          .replace(/[áàã]/g,"a")
          .replace(/[îïí]/g,"i")
          .replace(/[ôóò]/g,"o")
          .replace(/[ç]/g,"c")
          .replace(/[ñ]/g,"n")
          .replace(/^\s+|\s+$/g, "-") 
          .replace(/[_|\s]+/g, "-")
          .replace(/[^a-z0-9-]+/g, "-")
          .replace(/[-]+/g, "-")
          .replace(/^-+|-+$/g, "-")
          ; 

  }
  
  


/*
mapDpt
map = document.getElementById('mapDpt'); map.setAttribute("viewBox", "50 50 248 270"); 
"0 0 492 543"
*/