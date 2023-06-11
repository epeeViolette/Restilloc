<?php

if (isset ($_POST['traitement'])){
    switch ($_POST['traitement']){
        case "add_client" : $client = recupererDonneesClient() ;
                            $link_db = connect_to_db();
                            insert_client($link_db, $client) ;
                            close_db($link_db);
                            echo "Le Client a été inséré dans la base de données";
                            break;

        case "add_vehicule" : $vehicule = recupererDonneesVehicule() ;
                            $link_db = connect_to_db();
                            insert_vehicule($link_db, $vehicule) ;
                            close_db($link_db);
                            echo "Véhicule inséré dans la base de données";
                            break;
        case "add_cabinet" :    $cabinet = recupererDonneesCabinet() ;
                                $link_db = connect_to_db();
                                insert_cabinet($link_db, $cabinet) ;
                                close_db($link_db);
                                echo "Le cabinet d'experts a été inséré dans la base de données";
                                break;
        case "add_expert" :    $expert = recupererDonneesExpert() ;
                                $link_db = connect_to_db();
                                insert_expert($link_db, $expert) ;
                                close_db($link_db);
                                echo "L'experts a été inséré dans la base de données";
                                break;

        case "add_garage" :    $garage = recupererDonneesGarage() ;
                                $link_db = connect_to_db();
                                insert_garage($link_db, $garage) ;
                                close_db($link_db);
                                echo "le garage a été inséré dans la base de données";
                                break;

        case "add_rdv" :    $rdv = recupererDonneesRdv() ;
                            $link_db = connect_to_db();
                            insert_rdv($link_db, $rdv) ;
                            close_db($link_db);
                            echo "le rendez-vous a été ajouté dans la base de données";
                            break;


        case "openDossier": $les_4_premiers_caracteres = substr($_POST['client'], 0,4);
                            if (is_numeric($les_4_premiers_caracteres) ){
                                //ouvrir le dossier d'expertise s'il existe
                            } else {
                                $nom_client = $_POST['client'];
                                $link_db = connect_to_db();
                                $listeDossiersClients = get_DossierClient_by_name($link_db, $nom_client);
                                close_db($link_db);
                                if(sizeof($listeDossiersClients) > 1){
                                    afficherListeDossiersClients($listeDossiersClients);
                                } else {
                                    $url = "./index.php?page=dossierClient&id_client=".$listeDossiersClients[0]['id_cli']."&immatriculation=".$listeDossiersClients[0]['immatriculation'];
                        
                                    echo "<script>";
                                    echo "window.location = '".$url."';";
                                    echo "</script>";
                                    exit;
                                }
                                
                            }
                            break;

                            
                
    }
}

//
//Récupérer les données du client à partir du POST
//
function recupererDonneesClient(){
    $client['nom_cli'] = strtoupper($_POST['nom_cli']) ;
    $client['prenom_cli'] = ucfirst( strtolower($_POST['prenom_cli']) ) ;
    $client['adresse_cli'] = $_POST['adresse_cli'] ;
    $client['cp_cli'] = $_POST['cp_cli'] ;
    $client['ville_cli'] = strtoupper($_POST['ville_cli']) ;
    $client['telephone_cli'] = $_POST['telephone_cli'] ;
    $client['portable_cli'] = $_POST['portable_cli'] ;
    $client['email_cli'] = $_POST['email_cli'] ;
    
    return($client);
}

//
//Récupérer les données du véhicule à partir du POST
//
function recupererDonneesVehicule(){
    $vehicule['immatriculation'] = $_POST['immatriculation'] ;
    $vehicule['dateMEC'] = $_POST['date_mise_en_circulation'] ;
    $vehicule['motorisation'] = $_POST['select_motorisation'] ;
    $vehicule['puissance'] = "" ; //Ajouter ce qu'il faut dans le formulaire pour récuperer la bvaleur de cet attribut
    $vehicule['id_cli'] = $_POST['select_client'] ;
    $vehicule['id_marque'] = $_POST['select_marque'] ;
    $vehicule['id_modele'] = $_POST['select_modele'] ;

    return($vehicule);
}


//
//Récupérer les données du cabinet d'experts à partir du POST
//
function recupererDonneesCabinet(){
    $cabinet['nom_cab'] = addslashes($_POST['nom_cab']) ;
    $cabinet['adresse_cab'] = addslashes($_POST['adresse_cab']) ;
    $cabinet['cp_cab'] = $_POST['cp_cab'] ;
    $cabinet['ville_cab'] = $_POST['ville_cab'] ;
    $cabinet['tel_cab'] = $_POST['telephone_cab'] ;
    $cabinet['site_web_cab'] = $_POST['site_web_cab'] ;

    return($cabinet);
}


//
//Récupérer les données de l'expert à partir du POST
//
function recupererDonneesExpert(){
    $expert['id_cab'] = $_POST['select_cabinet'] ;
    $expert['nom_exp'] = $_POST['nom_exp'] ;
    $expert['prenom_exp'] = $_POST['prenom_exp'] ;
    $expert['portable_exp'] = $_POST['telephone_exp'] ;
    $expert['email_exp'] = $_POST['email_exp'] ;
    

    return($expert);
}


//
//Récupérer les données du garage à partir du POST
//
function recupererDonneesGarage(){
    $garage['nom_gar'] = addslashes($_POST['nom_gar']) ;
    $garage['adresse_gar'] = addslashes($_POST['adresse_gar']) ;
    $garage['cp_gar'] = $_POST['cp_gar'] ;
    $garage['ville_gar'] = $_POST['ville_gar'] ;
    $garage['tel_gar'] = $_POST['telephone_gar'] ;
    $garage['site_web_gar'] = $_POST['site_web_gar'] ;

    return($garage);
}

//
//Récupérer les données du rdv à partir du POST
//
function recupererDonneesRdv(){
    $rdv['immatriculation'] = $_POST['select_vehicule'] ;
    $rdv['id_cli'] = $_POST['select_client'] ;
    $rdv['id_exp'] = $_POST['select_expert'] ;
    $rdv['id_gar'] = $_POST['select_garage'] ;
    $rdv['dateRDV'] = $_POST['date_rdv'] ;
    
    return($rdv);
}


/* ********************************************************************************************************************* */

//
// Inserer un nouveau client dans la table clients
//
function insert_client($link_db, $client)
{
	$sql = "INSERT INTO clients (
                    nom_cli,
                    prenom_cli,
                    adresse_cli,
                    
                    cp_cli,
                    ville_cli,
                    telephone_cli,
                    portable_cli,
                    email_cli
                    )
            VALUES  (".
               "'".$client['nom_cli']."', ".
               "'".$client['prenom_cli']."', ".
               "'".$client['adresse_cli']."', ".
               "'".$client['cp_cli']."', ".
               "'".$client['ville_cli']."', ".
               "'".$client['telephone_cli']."', ".
               "'".$client['portable_cli']."', ".
               "'".$client['email_cli']."' ".
               " );" ;
    
    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_client : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;
}


//
// Inserer un nouveau vehicule dans la table vehicules
//
function insert_vehicule($link_db, $vehicule)
{
    
	$sql = "INSERT INTO vehicules (
                    immatriculation,
                    dateMEC,
                    motorisation,
                    puissance,
                    id_cli,
                    id_marque,
                    id_modele
                    )
            VALUES  (".
               "'".$vehicule['immatriculation']."', ".
               "'".$vehicule['dateMEC']."', ".
               "'".$vehicule['motorisation']."', ".
               "'".$vehicule['puissance']."', ".
               "".$vehicule['id_cli'].", ".
               "".$vehicule['id_marque'].", ".
               "".$vehicule['id_modele']." ".
               " );" ;

    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_vehicule : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;
}


//
// Inserer un nouveau cabinet d'experts dans la table clients
//
function insert_cabinet($link_db, $cabinet)
{
	$sql = "INSERT INTO cabinets_expertise (
                    nom_cab,
                    adresse_cab,
                    cp_cab,
                    ville_cab,
                    telephone_cab,
                    site_web_cab
                    )
            VALUES  (".
               "'".$cabinet['nom_cab']."', ".
               "'".$cabinet['adresse_cab']."', ".
               "'".$cabinet['cp_cab']."', ".
               "'".$cabinet['ville_cab']."', ".
               "'".$cabinet['tel_cab']."', ".
               "'".$cabinet['site_web_cab']."' ".
               " );" ;
    
    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_cabinet : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;
}


//
// Inserer un nouveau expert dans la table clients
//
function insert_expert($link_db, $expert)
{

    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,8);
    echo $pwd;


	$sql = "INSERT INTO experts (
                    nom_exp,
                    prenom_exp,
                    portable_exp,
                    email_exp,
                    id_cab,
                    login_exp,
                    password_exp
                    )
            VALUES  (".
               "'".$expert['nom_exp']."', ".
               "'".$expert['prenom_exp']."', ".
               "'".$expert['portable_exp']."', ".
               "'".$expert['email_exp']."', ".
               "".$expert['id_cab'].", "."'".$expert['nom_exp']."@".$expert['prenom_exp']."',".
               "'".$pwd."'".
               " );" ;
    
    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_expert : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;
}


//
// Inserer un nouveau cabinet d'experts dans la table clients
//
function insert_garage($link_db, $garage)
{
	$sql = "INSERT INTO garages (
                    nom_gar,
                    adresse_gar,
                    cp_gar,
                    ville_gar,
                    telephone_gar,
                    site_web_gar
                    )
            VALUES  (".
               "'".$garage['nom_gar']."', ".
               "'".$garage['adresse_gar']."', ".
               "'".$garage['cp_gar']."', ".
               "'".$garage['ville_gar']."', ".
               "'".$garage['tel_gar']."', ".
               "'".$garage['site_web_gar']."' ".
               " );" ;
    
    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_garage : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;
}

//
// Inserer un nouveau rendez-vous dans la table avoirrendezvous
//  Inserer un nouveau dossier dans la table dossierderestitution
function insert_rdv($link_db, $rdv)
{
	$sql = "INSERT INTO avoirrendezvous (
                    immatriculation,
                    id_cli,
                    id_exp,
                    id_gar,
                    dateRDV
                    )
            VALUES  (".
               "'".$rdv['immatriculation']."', ".
               "".$rdv['id_cli'].", ".
               "".$rdv['id_exp'].", ".
               "".$rdv['id_gar'].", ".
               "'".$rdv['dateRDV']."' ".
               " );" ;
    
    $req = mysqli_query($link_db, $sql) or die("Erreur dans insert_rdv : <br>".$sql); 
    //echo "<br>requette SQL : <br><br>".$sql;

    $sql_restitution = "INSERT INTO dossiersderestitution (immatriculation,dateCreation) values ('".$rdv['immatriculation']."','".$rdv['dateRDV']."')";
    $req_restitution = mysqli_query($link_db, $sql_restitution) or die("Erreur dans insert_rdv : <br>".$sql_restitution); 
}


/* ********************************************************************************************************** */



function afficherListeDossiersClients($listeDossiersClients){
    
    $liste  = "<div class='row'>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "  <div class='col-8'>";
    for ($i=0; $i<sizeof($listeDossiersClients); $i++){
        

        $lien = "./index.php?page=dossierClient&id_client=".$listeDossiersClients[$i]['id_cli']."&immatriculation=".$listeDossiersClients[$i]['immatriculation'];

        $liste .= $listeDossiersClients[$i]['id_cli']. "  ";
        $liste .= "    <a href='".$lien."' >" ;
        $liste .=        $listeDossiersClients[$i]['nom_cli']." ".$listeDossiersClients[$i]['prenom_cli'];
        $liste .= "    </a>  ";
        $liste .=        $listeDossiersClients[$i]['immatriculation']."  ";
        $liste .=        $listeDossiersClients[$i]['nom_marque']."  ";
        $liste .=        $listeDossiersClients[$i]['nom_modele']."  ";

        $liste .= "      <BR>";
    }

    $liste .= "  </div>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "</div>";

    echo $liste;
}

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";



?>