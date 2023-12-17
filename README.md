# tp-api: Le projet se trouve sur la branche master
TP API WEB
Laurence MONWANOU

Réalisation d'un site web qui expoote une API de data gouv.fr et qui présente les résulatats sur le fond de carte OpenStreetMap.

API utilisée
https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/consommation-electriques-detaillees-des-sites-des-mef-sept2017-sept2018/records?limit=20

Grâce à cette API j'ai pu afficher l'inventaire des sites du parc des Ministères économiques et financiers avec leurs données de consommation annuelles globales, du 1er septembre 2017 au 30 septembre 2018.

Mon site est s'affiche en deux pages.
 Une page index.php qui affiche un formulaire de recherche dans lequel on saisi le nom de la ville dont on souhaite récuperer les informations.

Une page carte.php qui affiche sur une carte avec des épingles pointant sur la ville dont on verut récurer les informations. En cliquant sur l'epingle on y retrouve les informations qu'on veut récuperer. 


Comme informations j'ai choisi d'afficher
-Désignation du ministère
-Nom du site
-Ville
-Code postale
-Ref EDL
-Gestionnaire de réseau de distribution d'énergie(GRD)

