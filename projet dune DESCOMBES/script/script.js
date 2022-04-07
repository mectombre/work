// parrallaxe
$('#ba').parallaxe(.5);
$('#about').parallaxe(.8);
$('#characters').parallaxe(.5);
$('#vidimg').parallaxe(.2);
$('#theatre').parallaxe(.8);



/*apiyoutube*/

  let etatLecteur;

  function lecteurPret(event) {
    // event.target = lecteur
    event.target.setVolume(50);
  }

  function changementLecteur(event) {
    // event.data = état du lecteur
    etatLecteur = event.data;
  }

  let lecteur;

  function onYouTubeIframeAPIReady() {
    lecteur = new YT.Player("video", {
      height: "390",
      width: "640",
      videoId: "POKpTLwdGoo",
      playerVars: {
        color: "white",
        enablejsapi: 1,
        modestbranding: 1,
        rel: 0
      },
      events: {
        onReady: lecteurPret,
        onStateChange: changementLecteur
      }
    });
  }

  // Hauteur de la vidéo
  const hauteurVideo = $("#video").height();
  // Position Y de la vidéo
  const posYVideo = $("#video").offset().top;
  // Valeur declenchant la modification de l'affichage (choix "esthétique")
  const seuil = posYVideo + 0.75 * hauteurVideo;

  // Gestion du défilement
  $(window).scroll(function () {
    // Récupération de la valeur du défilement vertical
    const scroll = $(window).scrollTop();

    // Classe permettant l'exécution du CSS
    $("#video").toggleClass(
      "scroll",
      etatLecteur === YT.PlayerState.PLAYING && scroll > seuil
    );
  });

//api youtube//



//carroussel

  // Variable globale
  let index = 0;

  // Gestion des événements
  $('span').click(function () {
    // Récupération index
    let indexN = $('span').index(this);

    // Renouveller l'image
    $('img').eq(index).fadeOut(1000).end().eq(indexN).fadeIn(1000);
    $('h3').eq(index).fadeOut(1000).end().eq(indexN).fadeIn(1000);
    // Mettre à jour l'index
    index = indexN;
  });

//caroussel //


//maps
  let lat = 0;
  let long = 0;

  // Appelée si récupération des coordonnées réussie
  function positionSucces(position) {
    // Injection du résultat dans du texte
    lat = Math.round(1000 * position.coords.latitude) / 1000;
    long = Math.round(1000 * position.coords.longitude) / 1000;
    //console.log(lat, long);
    //$("h4").text(`Latitude: ${lat}°, Longitude: ${long}°`);
    showcinema()
    carte.setView([lat, long], 13);
    var marker = L.marker([lat, long]).addTo(carte);
    marker.bindPopup("<b>Position actuelle</b>").openPopup();

  }


  // Création de la carte, vide à ce stade
  let carte = L.map('carte', {
    center: [47.2608333, 2.4188888888888886],
    // Centre de la France
    zoom: 5,
    minZoom: 4,
    maxZoom: 19,
  })


  // Ajout des tuiles (ici OpenStreetMap)
  // https://wiki.openstreetmap.org/wiki/Tiles#Servers
  L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
  }).addTo(carte);

  // Ajout de l'échelle
  L.control.scale().addTo(carte);





  // Récupération des coordonnées au clic sur le bouton
  $("button").click(function () {

    // Support de la géolocalisation
    if ("geolocation" in navigator) {
      // Support = exécution du callback selon le résultat
      navigator.geolocation.getCurrentPosition(positionSucces, positionErreur, {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 30000
      });

    } else {
      // Non support = injection de texte
      $("h4").text("La géolocalisation n'est pas supportée par votre navigateur");
    }

  });


  // Appelée si échec de récuparation des coordonnées
  function positionErreur(erreurPosition) {
    // Cas d'usage du switch !
    let natureErreur;
    switch (erreurPosition.code) {
      case erreurPosition.TIMEOUT:
        // Attention, durée par défaut de récupération des coordonnées infini
        natureErreur = "La géolocalisation prends trop de temps...";
        break;
      case erreurPosition.PERMISSION_DENIED:
        natureErreur = "Vous n'avez pas autorisé la géolocalisation.";
        break;
      case erreurPosition.POSITION_UNAVAILABLE:
        natureErreur = "Votre position n'a pu être déterminée.";
        break;
      default:
        natureErreur = "Une erreur inattendue s'est produite.";
    }
    // Injection du texte
    $("h4").text(natureErreur);
  }


  //fonction qui affiche les cinema proche a 0.3 pres en lat et long
  function showcinema() {
    console.log(pcinema["features"]["length"]);
    nbcinema = pcinema["features"]["length"]


    for (i = 0; i < nbcinema; i++) {
      const lonC = pcinema.features[i].geometry.coordinates[0];
      const latC = pcinema.features[i].geometry.coordinates[1];
      const dist = 0.3;
      if (latC < lat + dist && latC > lat - dist) {
        if (lonC < long + dist && lonC > long - dist) {
          var marker = L.marker([latC, lonC]).addTo(carte);
          marker.bindPopup("<b>" + pcinema["features"][i]["properties"]["NOM_ETABLISSEMENT"] + "</b>").openPopup();
        }
      }
    }
  }


  console.log(pcinema);
  console.log(pcinema["features"]["length"]);
  console.log(pcinema["features"][0]["geometry"]["coordinates"][0]);

  //marche si hebergé
  /*let url = "cinema.json";
  $.getJSON (url).done(function (data) {
    console.log(data);
    console.log("data");
  })
*/
