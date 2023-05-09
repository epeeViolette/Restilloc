<?php session_start();?>
<?php

//header("Last-Modified: " . gmdate("D, d M Y H:i:s" ) . " GMT" );

//date_default_timezone_set('Europe/Paris' );
//phpinfo(); // au 07/10/2017 version 5.3.3

// Afficher les erreurs à l'écran
//ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
//ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
//ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
//error_reporting(E_ALL);

//echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



/* ****************************************************************************** 
Ce petit code vérifie si le paramètre 'page' figure dans l'URL qui a été utilisé 
pour appeler la page index.php
*********************************************************************************/
// Déclaration d'une variable '$page_a_afficher' vide
$page_a_afficher="";
//Test si le paramètre 'page' figure das l'URL
if (isset ($_GET['page'])) {
    //Si oui récupere la valeur de ce paramètre 'page' avec $_GET et on la copie dans '$page_a_afficher'
    $page_a_afficher = $_GET['page'];
}

//Decommenter cette ligne pour afficher le contenu de '$page_a_afficher'
//echo $page_a_afficher;

//Inclure les fichiers connexion et fonctions
include_once "connection.php";
include_once "fonctions.php";

//Afficher ou cacher le panel de Rendez-vous
$etat_panel_rdv = "hidden";
if (isset ($_GET['rdv'])) {
    //Si oui récupere la valeur de ce paramètre 'page' avec $_GET et on la copie dans '$page_a_afficher'
    $etat_panel_rdv = "visible";
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }




?>




<!doctype html>
<!-- ****************************************************************************************************** -->
<!-- PAGE HTML DU SITE : DEBUT                                                                              -->
<!-- ****************************************************************************************************** -->
<html lang="fr">
    <!-- DEBUT DE LA PARTIE HEAD DU SITE -->
    <head>
        <!--Déclaration du jeu de caractère qui sera utilisé dans le site 'UTF-8' -->
        <meta charset="utf-8">
        <!--Ajout d'une icone qui s'affichera à gauche du nom du site dans l'onglet dunavigateur -->
        <link rel="icon" href="images/icone.png">
        
    



        <!-- ****************************************************************************************************** -->
        <!-- Lien vers la bibliotheque de scripts JQuery nécessaire pour Bootstrap                                  -->
        <!-- ****************************************************************************************************** -->
        <!-- Accès au fichier Jquery sur le site JQuery -->
        <!--
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        -->
        <!-- Accès au fichier Jquery Local -->
        <script src="./js/jquery/3.5.1/jquery-3.5.1.min.js"></script>
        



        <!-- ****************************************************************************************************** -->
        <!-- Ces liens sont necessaires pour BootStrap                                                              -->
        <!-- ****************************************************************************************************** -->
        <!-- Lien vers le CSS sur le site Bootsrap-->
        <!--
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        -->
        <!-- Lien vers le CSS Local -->
        <link rel="stylesheet" href="./bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Lien vers le JS sur le site Bootsrap  (bundle inclut tout ce dont on a besoin)-->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        -->
        <script src="./bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        



        <!-- ****************************************************************************************************** -->
        <!-- Ces liens sont necessaires pour fontawesome                                                              -->
        <!-- ****************************************************************************************************** -->
        <link href="./fontawesome/5.15.1-web/css/all.css" rel="stylesheet">


        
        
        <!-- ****************************************************************************************************** -->
        <!-- lien vers mes feuille de styles                               -->  
        <!-- ****************************************************************************************************** -->
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" type="text/css" href="./css/dlg_newCabinet.css" />
        <link rel="stylesheet" type="text/css" href="./css/dlg_newExpert.css" />
        <link rel="stylesheet" type="text/css" href="./css/dlg_newClient.css" />
        <link rel="stylesheet" type="text/css" href="./css/dlg_newVehicule.css" />
        <link rel="stylesheet" type="text/css" href="./css/dlg_newRdv.css" />
        <link rel="stylesheet" type="text/css" href="./css/dlg_newGarage.css" />

        <link rel="stylesheet" type="text/css" href="./css/dossierClient.css" />
        


        
    </head>
    <!-- FIN DE LA PARTIE HEAD DU SITE -->

    <!-- DEBUT DE LA PARTIE BODY DU SITE -->
    <body>
        <!-- Inclusion du fichier 'header.php' qui dessine la partie supérieure de la page -->
        <!-- ce fichier est inclut dans une '<div></div>' dont les proprités sont indiquées par 'id=header' dans 'style.css'--> 
        <div id ="header" class="container-fluid">
            <?php //include("./header.php"); ?>
        </div>
        
        <!-- Inclusion du fichier 'navbar_header_1.php' qui dessine la barre de menus  -->
        <!-- L'écran est divisé en 12 colonnes-->
        <!-- sur les petits écrans : la barre des menu s'étale sur les 12 colonnes -->  
        <!-- sur les écrans lg et supérieurs : la barre des menu s'étale sur 10 colonnes en laissant une colonne vide de chaque côté -->  
        <div id="menu" class="row">
            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-1"></div>
            <div class="col-xs-12 col-md-12 col-lg-10">
               <?php include("./navbar_header_1.php"); ?>
            </div>
            <div class="col-xs-0 col-sm-0 col-md-0 col-lg-1"></div>
        </div>


        <!-- zone située sous la barre des menus dans laquelle s'affichera le contenu du site -->
        <!-- le contenu du site est situé dans plusieurs pages : une page est affichée à la fois -->
        <!-- la page affiché depend du paramètre 'page' récupéré dans l'URL (voir le code tout en haut de cette page) -->
        <!-- la page est affiché dans une '<div></div>' qui s'étale sur les 10 colonnes contrales de l'écran quelque que soit sa taille -->
        <!-- les colones sont sur une ligne 'row' -->
        <!-- la ligne 'row' est dans une '<div></div>' dont les proprietés sont indiquées par 'id=content' dans la feuille de style 'styles.css' -->
        <div id="content">
            <!--ligne-->
            <div class ="row">
                <!--une colonne vide -->
                <div class="col-1"></div>
                <!--10 colonnes pour afficher la page de contenu -->
                <div class="col-10">
                    <?php 
                    /* Ce code inspecte le contenu de la variable '$page_a_afficher' que nous avons initialisé, 
                       dans le code tout en haut de cette page, en fonction du paramètre 'page' recu dans l'URL.
                       en fonction de la valeur de la variable '$page_a_afficher', une page est incluse  */
                
                    switch ($page_a_afficher) {
                    
                        case "traitements" :    include("traitements.php");
                                                break;
                        case "dossierClient" :  $id_client = $_GET['id_client'];
                                                $immatriculation = $_GET['immatriculation'];
                                                $link_db = connect_to_db();
                                                $dossierClient = get_DossierClient_by_id($link_db, $id_client, $immatriculation) ;
                                                close_db($link_db);
                                                include("dossierClient.php");
                                                break;
                        case "modifyDossierClient" :    $id_client = $_GET['id_client'];
                                                        $immatriculation = $_GET['immatriculation'];
                                                        $link_db = connect_to_db();
                                                        $dossierClient = get_DossierClient_by_id($link_db, $id_client, $immatriculation) ;
                                                        close_db($link_db);
                                                        include("modifyDossierClient.php");
                                                        break;
                        case "liste_dossiers": 
                            $link_db = connect_to_db();
                            $liste_clients = get_all_clients($link_db);
                            afficherListeClients($liste_clients,$link_db);
                            close_db($link_db);
                            break;

                        case "liste_experts": 
                            $link_db = connect_to_db();
                            $experts = get_all_experts_with_cab($link_db);
                            afficherListeExperts($experts,$link_db);
                            close_db($link_db);
                            break;

                        case "liste_garages": 
                            $link_db = connect_to_db();
                            $garages = get_all_garages($link_db);
                            afficherListeGarages($garages,$link_db);
                            close_db($link_db);
                            break;

                        case "liste_rdv": 
                            $link_db = connect_to_db();
                            $liste_clients = get_all_clients($link_db);
                            $experts = get_all_experts_with_cab($link_db);
                            $garages = get_all_garages($link_db);
                            $rdv = get_all_rdv($link_db);
                            afficherListeRDV($rdv,$liste_clients,$experts,$garages,$link_db);
                            close_db($link_db);
                            break;
                    
                        
                        default : include("accueil.php");
                    }
                    
                    ?>
                </div>
                <!--une colonne vide -->
                <div class="col-1"></div>
            </div>
            
        </div>
       
      
       <!--
        <div id="footer">
            <div class="gauche">
                Ecran :
                <span class="badge badge-primary d-inline d-sm-none">xs</span> 
                <span class="badge badge-primary d-none d-sm-inline d-md-none">sm</span> 
                <span class="badge badge-primary d-none d-md-inline d-lg-none">md</span> 
                <span class="badge badge-primary d-none d-lg-inline d-xl-none">lg</span> 
                <span class="badge badge-primary d-none d-xl-inline">xl</span> 
            </div>

            <div class="droite">
                <i class="fa fa-copyright" aria-hidden="true"></i> Driss SOUDANI - 2020
            </div>
        </div>
        -->

        
    </body>
    <!-- FIN DE LA PARTIE BODY DU SITE -->                
</html>


<!-- ****************************************************************************************************** -->
<!-- PAGE HTML DU SITE : FIN                                                                                -->
<!-- ****************************************************************************************************** -->

<script >
	
</script>

<?php
include_once "dlg_newCabinet.php";
include_once "dlg_newExpert.php";
include_once "dlg_newClient.php";
include_once "dlg_newVehicule.php";
include_once "dlg_newRdv.php";
include_once "dlg_newGarage.php";
?>
