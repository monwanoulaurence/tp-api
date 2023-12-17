
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carte</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Feuille CSS Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"> 
  <!-- Bibliothèque JS Leaflet -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <?php
  // Vérifier si une ville est soumise dans le formulaire
  if(isset($_GET['ville']) && $_GET['ville'] != '') {

    // Récupérer le nom de la ville 
    $ville = $_GET['ville'];
    
    // Appel API GeoApi pour récupérer les infos 
    $api_url = "https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/consommation-electriques-detaillees-des-sites-des-mef-sept2017-sept2018/records?where='".$ville."'";
    if(file_get_contents($api_url)) {
      $data = file_get_contents($api_url);
      $donnees = json_decode($data,true);
    }else{
      $message = "Ville non trouvée ou n'appartient pas à la france";
    }

  }
  ?>
</head>

<body class="bg-gray-500">
  <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        </ul>
      </div>
    </div>
  </nav>

  
  <!-- Div pour contenir la carte -->
  <div id="carte" class="h-[700px]"></div>
  
  <script>
  // Initialiser la carte centrée sur la France
  var carte = L.map('carte').setView([48.8566, 2.3522], 6); 
  var iconeRouge;
  
  // Ajouter la couche OpenStreetMap  
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - Rendering © <a href="//openstreetmap.org">OSM</a>'
  }).addTo(carte);
  
  //Se positionner sur la ville en question grâce à ses données geographique et affichage du marqueur
  <?php if(isset($donnees) && !empty($donnees["results"])) { 
   foreach ($donnees["results"] as $value) {
        $lat = $value["geocodage"]['lat'];
        $lon = $value["geocodage"]['lon'];
    ?>
    iconeRouge = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
    });

    L.marker([<?php echo floatval($lat); ?>, <?php echo floatval($lon); ?>],{ icon: iconeRouge })
        .addTo(carte)
        .bindPopup(
                "<div><strong><span class='text-[13px] font-bold'>Désignation du ministère </span></strong><br><span><?=$value["designation_du_ministere"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Nom du Site</span></strong><br><span><?=$value["nom_du_site"]?></span></div><div><strong><span class='text-[13px] font-bold'>Ville</span></strong><br><span><?=$value["ville"]?></span></div><div><strong><span class='text-[13px] font-bold'>Code Postal</span></strong><br><span><?=$value["code_postal"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Ref PDL</span></strong><br><span><?=$value["ref_pdl"]?></span></div> <div><strong><span class='text-[13px] font-bold'>GRD</span></strong><br><span><?=$value["grd"]?></span></div>"
        );
  
    <?php
    }
    
    //Definition de l'icon
    } 
  
  //Faire une alerte pour afficher le message et rediriger vars la page de recherche
    if(isset($message)) : ?>
    alert("<?=$message?>");
    window.location.href = "/";
  <?php endif; ?>
  
  </script>
</body>
</html>
