<?php
function get_clients_by_id($link_db,$id_client)
{


	$sql = "SELECT 	*
			FROM clients 
			WHERE nom_cli = '".$id_client."'"; 
    $i=0;
	$clients = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'clients'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$clients[$i]['id_cli']=$data['id_cli'];
			$clients[$i]['nom_cli']=$data['nom_cli'];
			$clients[$i]['prenom_cli']=$data['prenom_cli'];
            $clients[$i]['adresse_cli']=$data['adresse_cli'];
			$clients[$i]['cp_cli']=$data['cp_cli'];
			$clients[$i]['ville_cli']=$data['ville_cli']; 
			$clients[$i]['telephone_cli']=$data['telephone_cli']; 
			$clients[$i]['portable_cli']=$data['portable_cli']; 
			$clients[$i]['email_cli']=$data['email_cli']; 
			$i++;
			
		} 
	}
	return $clients;
}

//
// Lire tous les clients
//
function get_all_clients($link_db)
{
	$sql = "SELECT 	*
			FROM clients 
			ORDER BY nom_cli, prenom_cli"; 
    $i=0;
	$clients = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'clients'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$clients[$i]['id_cli']=$data['id_cli'];
			$clients[$i]['nom_cli']=$data['nom_cli'];
			$clients[$i]['prenom_cli']=$data['prenom_cli'];
            $clients[$i]['adresse_cli']=$data['adresse_cli'];
			$clients[$i]['cp_cli']=$data['cp_cli'];
			$clients[$i]['ville_cli']=$data['ville_cli']; 
			$clients[$i]['telephone_cli']=$data['telephone_cli']; 
			$clients[$i]['portable_cli']=$data['portable_cli']; 
			$clients[$i]['email_cli']=$data['email_cli']; 
			$i++;
			
		} 
	}
	return $clients;
}

//
// Trouver les  Client concernant un nom client
// Dossier : infos sur le client (nom, ...)  et  ses vehicules (immatriculation, modele et marque)
//
function get_all_Clients_by_name($link_db,$nom_client){;
    $sql = "SELECT * FROM clients AS C
				JOIN vehicules AS V ON C.id_cli = V.id_cli
				JOIN marquesvehicules AS Marque ON V.id_marque = Marque.id_marque
				JOIN modelesvehicules AS Model ON V.id_modele = Model.id_modele
			WHERE C.nom_cli='".$nom_client."' ";

    $dossierClient=array();
	
    $i=0;
    if($req = mysqli_query($link_db, $sql) or die("fonctions.php - get_all_Clients_by_name($link_db,$nom_client) <br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$dossierClient[$i]['id_cli']=$data['id_cli'];
			$dossierClient[$i]['nom_cli']=$data['nom_cli'];
			$dossierClient[$i]['prenom_cli']=$data['prenom_cli'];
			$dossierClient[$i]['adresse_cli']=$data['adresse_cli'];
			$dossierClient[$i]['cp_cli']=$data['cp_cli'];
			$dossierClient[$i]['ville_cli']=$data['ville_cli'];
			$dossierClient[$i]['telephone_cli']=$data['telephone_cli']; 
			$dossierClient[$i]['portable_cli']=$data['portable_cli']; 
			$dossierClient[$i]['email_cli']=$data['email_cli']; 

			$dossierClient[$i]['immatriculation']=$data['immatriculation']; 
			$dossierClient[$i]['dateMEC']=$data['dateMEC']; 
			$dossierClient[$i]['motorisation']=$data['motorisation']; 
			$dossierClient[$i]['puissance']=$data['puissance']; 

			$dossierClient[$i]['nom_marque']=$data['nom_marque']; 
			$dossierClient[$i]['nom_modele']=$data['nom_modele'];

            $i++;
		} 
		
	}
	
	return($dossierClient);
}

function get_vehicules_client($link_db, $id_client){
	$sql = "SELECT * FROM vehicules AS Vehicule 
				LEFT JOIN marquesvehicules AS Marque ON Vehicule.id_marque = Marque.id_marque
				LEFT JOIN modelesvehicules AS Modele ON Vehicule.id_modele = Modele.id_modele
				WHERE  Vehicule.id_cli = $id_client";
	if($req = mysqli_query($link_db, $sql) or die('fonctions.php - get_vehicules_clients($link_db, $id_client) <br>'.$sql))
	{		
		$i=0;
		$vehicules_clients = [];
		while($data = mysqli_fetch_assoc($req)) 
		{
			$vehicules_clients[$i] = [];

			$vehicules_clients[$i]['immatriculation']=$data['immatriculation']; 
			$vehicules_clients[$i]['dateMEC']=$data['dateMEC']; 
			$vehicules_clients[$i]['motorisation']=$data['motorisation']; 
			$vehicules_clients[$i]['puissance']=$data['puissance']; 

			$vehicules_clients[$i]['nom_marque']=$data['nom_marque']; 
			$vehicules_clients[$i]['nom_modele']=$data['nom_modele'];

			$i++ ;
		}
		return $vehicules_clients;
	}


}
//
// Trouver un Dossier Client par l'id du client et l'immatriculation de la voiture
// Dossier : infos sur le client (nom, ...) ,  ses vehicules (immatriculation, modele et marque)
// et ses rendez-vous (avec quel expert, ou et quand)
//
function get_DossierClient_by_id($link_db, $id_client){
	console_log( $id_client );
	//console_log( $immatriculation );

	// $where = "Client.id_cli = '".$id_client."'";


    $sql = "SELECT * FROM clients AS Client 
				LEFT JOIN vehicules AS Vehicule ON  Vehicule.id_cli = Client.id_cli 
				LEFT JOIN marquesvehicules AS Marque ON Vehicule.id_marque = Marque.id_marque
				LEFT JOIN modelesvehicules AS Modele ON Vehicule.id_modele = Modele.id_modele
				LEFT JOIN avoirrendezvous AS Rdv ON Rdv.id_cli = Client.id_cli
				LEFT JOIN experts AS Expert ON Expert.id_exp = Rdv.id_exp
				LEFT JOIN cabinets_expertise AS CabExp ON CabExp.id_cab = Expert.id_cab
				LEFT JOIN garages AS Garage ON Rdv.id_gar = Garage.id_gar

			WHERE Client.id_cli = ".$id_client." ";

    $dossierClient=array();
	
    if($req = mysqli_query($link_db, $sql) or die('fonctions.php - get_DossierClient_by_id($link_db, $id_client, $immatriculation) <br>'.$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$dossierClient['id_cli']=$data['id_cli'];
			$dossierClient['nom_cli']=$data['nom_cli'];
			$dossierClient['prenom_cli']=$data['prenom_cli'];
			$dossierClient['adresse_cli']=$data['adresse_cli'];
			$dossierClient['cp_cli']=$data['cp_cli'];
			$dossierClient['ville_cli']=$data['ville_cli'];
			$dossierClient['telephone_cli']=$data['telephone_cli']; 
			$dossierClient['portable_cli']=$data['portable_cli']; 
			$dossierClient['email_cli']=$data['email_cli']; 

			$dossierClient['immatriculation']=$data['immatriculation']; 
			$dossierClient['dateMEC']=$data['dateMEC']; 
			$dossierClient['motorisation']=$data['motorisation']; 
			$dossierClient['puissance']=$data['puissance']; 

			$dossierClient['nom_marque']=$data['nom_marque']; 
			$dossierClient['nom_modele']=$data['nom_modele'];

			$dossierClient['nom_exp']=$data['nom_exp'];
			$dossierClient['prenom_exp']=$data['prenom_exp'];
			$dossierClient['nom_cab']=$data['nom_cab'];
			
			$dossierClient['nom_gar']=$data['nom_gar'];
			$dossierClient['adresse_gar']=$data['adresse_gar'];
			$dossierClient['cp_gar']=$data['cp_gar'];
			$dossierClient['ville_gar']=$data['ville_gar'];

			$dossierClient['dateRDV']=$data['dateRDV'];

		} 
		
	}
	//echo "<pre>";
	//print_r($dossierClient);
	//echo "</pre>";
	return($dossierClient);
}




//
//
function get_DossierClient_by_name($link_db, $nom_client){


	$where = "Client.nom_cli = '".$nom_client."'";


    $sql = "SELECT * FROM clients AS Client 
				LEFT JOIN vehicules AS Vehicule ON  Vehicule.id_cli = Client.id_cli 
			WHERE $where ";

    $dossiersClient=array();
	$i=0;
	
    if($req = mysqli_query($link_db, $sql) or die("fonctions.php - get_DossierClient_by_name($$link_db, $nom_client) <br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$dossiersClient[$i] = get_DossierClient_by_id($link_db, $data['id_cli'], $data['immatriculation']);
			$i++;
		} 
	}
	//echo "<pre>";
	//print_r($dossierClient);
	//echo "</pre>";
	return($dossiersClient);
}




//
// Lire toutes les marques
//
function get_all_marques($link_db)
{
	$sql = "SELECT 	*
			FROM marquesvehicules 
			ORDER BY nom_marque"; 
   
	$marques = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'marquesvehicules'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
            $id = $data['id_marque'];
			$marques[$id]=$data['nom_marque'];
		} 
	}
	return $marques;
}


//
// Lire tous les modeles
//
function get_all_modeles($link_db)
{
	$sql = "SELECT 	*
			FROM modelesvehicules 
			ORDER BY id_marque"; 
    //$i=0;
	$modeles = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'modelesvehicules'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$id = $data['id_modele'];
			//$modeles[$i]['id_model']=$data['id_model'];
			$modeles[$id]['nom_modele']=$data['nom_modele'];
			$modeles[$id]['id_marque']=$data['id_marque'];
			//$i++;
		} 
	}
	return $modeles;
}


//
// Lire tous les garages
//
function get_all_garages($link_db)
{
	$sql = "SELECT 	*
			FROM garages 
			ORDER BY cp_gar, nom_gar"; 
    $i=0;
	$garages = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'garages'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$garages[$i]['id_gar']=$data['id_gar'];
			$garages[$i]['nom_gar']=$data['nom_gar'];
			$garages[$i]['adresse_gar']=$data['adresse_gar'];
			$garages[$i]['cp_gar']=$data['cp_gar'];
			$garages[$i]['ville_gar']=$data['ville_gar']; 
			$garages[$i]['telephone_gar']=$data['telephone_gar']; 
			$garages[$i]['fax_gar']=$data['fax_gar']; 
			$garages[$i]['site_web_gar']=$data['site_web_gar']; 
			$i++;
			
		} 
	}
	return $garages;
}


//
// Lire tous les experts
//
function get_all_experts($link_db)
{
	$sql = "SELECT 	* 
			FROM experts   
			ORDER BY nom_exp"; 
    $i=0;
	$experts = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'experts'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$experts[$i]['id_exp']=$data['id_exp'];
			$experts[$i]['nom_exp']=$data['nom_exp'];
			$experts[$i]['prenom_exp']=$data['prenom_exp'];
			$experts[$i]['portable_exp']=$data['portable_exp'];
			$experts[$i]['email_exp']=$data['email_exp'];
			$experts[$i]['id_cab']=$data['id_cab']; 
			
			$i++;
			
		} 
	}

	return $experts;
}


//
// Lire tous les véhicules
//
function get_all_vehicules($link_db)
{
	$sql = "SELECT 	* 
			FROM vehicules   
			ORDER BY id_cli"; 
    $i=0;
	$vehicules = array();
    if($req = mysqli_query($link_db, $sql) or die("get_all_vehicules : Erreur d'accès à la table 'vehicules'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$vehicules[$i]['immatriculation']=$data['immatriculation'];
			$vehicules[$i]['dateMEC']=$data['dateMEC'];
			$vehicules[$i]['motorisation']=$data['motorisation'];
			$vehicules[$i]['puissance']=$data['puissance'];
			$vehicules[$i]['id_cli']=$data['id_cli'];
			$vehicules[$i]['id_marque']=$data['id_marque'];
			$vehicules[$i]['id_modele']=$data['id_modele'];
			
			$i++;
			
		} 
	}

	return $vehicules;
}



//
// Lire tous les cabinets d'experts
//
function get_all_cabinets_expertise($link_db)
{

	$sql = "SELECT 	* 
			FROM cabinets_expertise 
			ORDER BY nom_cab"; 
    $i=0;
	$cabinets = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'cabinets_expertise'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$cabinets[$i]['id_cab']=$data['id_cab'];
			$cabinets[$i]['nom_cab']=$data['nom_cab'];
			$cabinets[$i]['adresse_cab']=$data['adresse_cab'];
			$cabinets[$i]['cp_cab']=$data['cp_cab'];
			$cabinets[$i]['ville_cab']=$data['ville_cab']; 
			
			$i++;	
		} 
	}
	
	//print_r($cabinets);
	return $cabinets;
}

function get_all_experts_with_cab($link_db)
{
	$sql = "SELECT 	* 
			FROM experts AS E 
			LEFT JOIN cabinets_expertise AS C ON E.id_cab = C.id_cab 
			ORDER BY E.nom_exp"; 
    $i=0;
	$experts = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'experts'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$experts[$i]['id_exp']=$data['id_exp'];
			$experts[$i]['nom_exp']=$data['nom_exp'];
			$experts[$i]['prenom_exp']=$data['prenom_exp'];
			$experts[$i]['portable_exp']=$data['portable_exp'];
			$experts[$i]['email_exp']=$data['email_exp'];
			$experts[$i]['id_cab']=$data['id_cab']; 
			$experts[$i]['nom_cab']=$data['nom_cab']; 
			$i++;
			
		} 
	}

	return $experts;
}


function get_all_rdv($link_db)
{

	$sql = "SELECT 	* 
			FROM avoirrendezvous
			ORDER BY dateRDV DESC"; 
    $i=0;
	$rdv = array();
    if($req = mysqli_query($link_db, $sql) or die("Erreur d'accès à la table 'avoirrendezvous'<br>".$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$rdv[$i]['id_exp']=$data['id_exp'];
			$rdv[$i]['id_gar']=$data['id_gar'];
			$rdv[$i]['id_cli']=$data['id_cli'];
			$rdv[$i]['immatriculation']=$data['immatriculation'];
			$rdv[$i]['dateRDV']=$data['dateRDV']; 
			
			$i++;
			
		}
	//print_r($cabinets);
	return $rdv;
	}
}

/* ************************************************************************************************************************************** */
function afficherListeClients($listeClients,$link_db){
	/*

	$clients[$i]['id_cli']=$data['id_cli'];
			$clients[$i]['nom_cli']=$data['nom_cli'];
			$clients[$i]['prenom_cli']=$data['prenom_cli'];
            $clients[$i]['adresse_cli']=$data['adresse_cli'];
			$clients[$i]['cp_cli']=$data['cp_cli'];
			$clients[$i]['ville_cli']=$data['ville_cli']; 
			$clients[$i]['telephone_cli']=$data['telephone_cli']; 
			$clients[$i]['portable_cli']=$data['portable_cli']; 
			$clients[$i]['email_cli']=$data['email_cli'];
			*/
    
    $liste  = "<div class='row'>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "  <div class='col-8'>";
    for ($i=0; $i<sizeof($listeClients); $i++){
        
		
        $lien = "./index.php?page=modifyClient&id_client=".$listeClients[$i]['id_cli']."";

        //$liste .= $listeClients[$i]['id_cli']. "  ";
        $liste .= "    <a href='".$lien."'>" ;
		//$liste .= "    <p style='color:blue;'>" ;
        $liste .=        $listeClients[$i]['nom_cli']." ".$listeClients[$i]['prenom_cli'];
		//$liste .= "    </p>  ";
        $liste .= "    </a>  ";
		

		$listeVehicules = get_vehicules_client($link_db,$listeClients[$i]['id_cli']);
		$liste .= "<br>";
		for ($j=0; $j<sizeof($listeVehicules); $j++){
       		$liste .=        $listeVehicules[$j]['immatriculation']."  ";
        	$liste .=        $listeVehicules[$j]['nom_marque']."  ";
        	$liste .=        $listeVehicules[$j]['nom_modele']."  ";
			$liste .= "<br>";
		}

        $liste .= "      <BR>";
    }

    $liste .= "  </div>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "</div>";

    echo $liste;
}

/* ************************************************************************************************************************************** */
function afficherListeExperts($experts,$link_db){

    
    $liste  = "<div class='row'>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "  <div class='col-8'>";
    for ($i=0; $i<sizeof($experts); $i++){
        
		
        $lien = "";//"./index.php?page=dossierClient&id_client=".$listeClients[$i]['id_cli']."&immatriculation=".$listeClients[$i]['immatriculation'];

        //$liste .= $listeClients[$i]['id_cli']. "  ";
        //$liste .= "    <a href='".$lien."' >" ;
		$liste .= "    <p style='color:blue;'>" ;
        $liste .=        $experts[$i]['nom_exp']." ".$experts[$i]['prenom_exp'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $experts[$i]['portable_exp'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $experts[$i]['email_exp'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $experts[$i]['nom_cab'];
		$liste .= "    </p>  ";
        //$liste .= "    </a>  ";
		

        $liste .= "      <BR>";
    }

    $liste .= "  </div>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "</div>";

    echo $liste;
}

/* ************************************************************************************************************************************** */
function afficherListeGarages($garages,$link_db){

    
    $liste  = "<div class='row'>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "  <div class='col-8'>";
    for ($i=0; $i<sizeof($garages); $i++){
        
		
        $lien = "";//"./index.php?page=dossierClient&id_client=".$listeClients[$i]['id_cli']."&immatriculation=".$listeClients[$i]['immatriculation'];

        //$liste .= $listeClients[$i]['id_cli']. "  ";
        //$liste .= "    <a href='".$lien."' >" ;
		$liste .= "    <p style='color:blue;'>" ;
        $liste .=        $garages[$i]['nom_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $garages[$i]['adresse_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $garages[$i]['cp_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $garages[$i]['ville_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $garages[$i]['telephone_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $garages[$i]['fax_gar'];
		$liste .= "    </p>  ";
        //$liste .= "    </a>  ";
		

        $liste .= "      <BR>";
    }

    $liste .= "  </div>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "</div>";

    echo $liste;
}


/* ************************************************************************************************************************************** */
function afficherListeRDV($rdv,$liste_clients,$experts,$garages,$link_db){

    
    $liste  = "<div class='row'>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "  <div class='col-8'>";
    for ($i=0; $i<sizeof($rdv); $i++){
        
		
        $lien = "";//"./index.php?page=dossierClient&id_client=".$listeClients[$i]['id_cli']."&immatriculation=".$listeClients[$i]['immatriculation'];

        //$liste .= $listeClients[$i]['id_cli']. "  ";
        //$liste .= "    <a href='".$lien."' >" ;
		$liste .= "    <p style='color:blue;'>" ;
        $liste .=        $experts[$i]['nom_exp']." ".$experts[$i]['prenom_exp'];
		$liste .= "    </p>";
		$liste .= "    <p>" ;
        $liste .=       $garages[$i]['nom_gar'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $liste_clients[$i]['nom_cli']." ".$liste_clients[$i]['prenom_cli'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $rdv[$i]['immatriculation'];
		$liste .= "    </p>  ";
		$liste .= "    <p>" ;
        $liste .=        $rdv[$i]['dateRDV'];
		$liste .= "    </p>  ";
        //$liste .= "    </a>  ";
		

        $liste .= "      <BR>";
    }

    $liste .= "  </div>";
    $liste .= "  <div class='col-2'>";
    $liste .= "  </div>";
    $liste .= "</div>";

    echo $liste;
}

//
// Cette fonction est utilisée dans dlg_newExpert.php
// Elle créé : <options value = id_du_cabinet> nom du cabinet</option>
// ces options sont celles du <Select> qui permet de choisir le nom du cabinet d'experts
//
function remplir_select_cabinet_d_experts(){
    $link_db = connect_to_db();
    $cabinetsExperts = get_all_cabinets_expertise($link_db);
    close_db($link_db);

    $select_cabinets_experts = '';
    for($i=0; $i < sizeof($cabinetsExperts); $i++){
        $select_cabinets_experts .= '<option value="'.$cabinetsExperts[$i]['id_cab'].'">'.$cabinetsExperts[$i]['nom_cab'].'</option>';
    }

    return $select_cabinets_experts ;
}




//
// Cette fonction est utilisée dans dlg_newVehicule.php
// Elle créé : <options value = id_du_client> nom et prénom du client</option>
// ces options sont celles du <Select> qui permet de choisir le nom du client
//
function remplir_select_client(){
    $link_db = connect_to_db();
    $clients = get_all_clients($link_db);
    close_db($link_db);

    $select_clients = array();

	$select_clients = '<option> Seéléctionner le client</option>';
    for($i=0; $i < sizeof($clients); $i++){
        $select_clients .= '<option value="'.$clients[$i]['id_cli'].'">'.$clients[$i]['nom_cli'].' '.$clients[$i]['prenom_cli'].'</option>';
	}

    return $select_clients ;
}


//
// Cette fonction est utilisée dans dlg_newVehicule.php
// Elle créé : <options value = id_de_la_marque> nom de la marque</option>
// ces options sont celles du <Select> qui permet de choisir la marque du véhicule
//
function remplir_select_marque(){
    $link_db = connect_to_db();
    $marques = get_all_marques($link_db);
    close_db($link_db);

    $select_marques = '<option> Séléctionner la marque</option>';;
    foreach($marques as $key => $value){
        $select_marques .= '<option value="'.$key.'" >'.$value.'</option>';
    }

    return $select_marques ;
}




//
// Cette fonction est utilisée dans dlg_newVehicule.php
// Elle créé : <options value = id_du_modele> nom du model</option>
// ces options sont celles du <Select> qui permet de choisir le modele du véhicule
//
function remplir_select_modele(){
    //Lecture des tables 
	$link_db = connect_to_db();
	$marques = get_all_marques($link_db);
    $modeles = get_all_modeles($link_db);
    close_db($link_db);

	//variable qui va mémoriser l'id de la marque
	$precedent_id_marque= "";
	//booleen qui va indiquer si une balise html <optgroup> est ouverte ou pas
	$balise_optgroup_ouverte = false;

	//Première otion de la balise <select> ... </select>
	$select_modele = '<option> Séléctionner le modèle</option>';

	//Parcourir le tableau $modeles remplit depuis la table modelesdevehicules
	//pour chaque enregistrement (ligne) du tableau $modeles
	//l'index dans le tableau est placé dans $key et le reste des attributs est placé dans un tableau $details
	foreach($modeles as $key => $details){
		//extraction du contenu du tableau $details
		$id_modele = $key;
		$id_marque = $details['id_marque'];
		$nom_modele = $details['nom_modele'];

		//test si la marque du véhicule a changée
		if($id_marque != $precedent_id_marque){
			//si oui : fermer la balise </optgroup> (forcement ouverte avant)
			//memoriser que la balise <optgroup> n'est plus ouverte
			if ($balise_optgroup_ouverte = true) {
				$select_modele .= '</optgroup>';
				$balise_optgroup_ouverte = false;
			}
			//Ouvrir une balise <optgroup> avec comme value le id de la marque (!!! il sera utilisé dans JS pour filtrer la liste)
			//dans le label de <optgroup> mettre le texte qui doit s'afficher : ici le nom de la marque
			$select_modele .= '<optgroup id="'.$id_marque.'"  label="'.$marques[$id_marque].'" >';
			//marquer le id de la marque comme étant le précédent (pour le prochain tour)
			$precedent_id_marque = $id_marque;
			//mémoriser qu'une balise <optgroup> est ouverte
			$balise_optgroup_ouverte = true;
		}
		
		//Ajouter l'option du <select> qui indique le nom du modele et lui attribuer comme value le id du modele
		$select_modele .= '<option value="'.$id_modele.'" >'.$nom_modele.'</option>';
    }


    return $select_modele ;
}




//
// Cette fonction est utilisée dans dlg_newRDV.php
// Elle créé : <optgroup id="$id_cli"  label="$nomDeLaMarque" >
// et : <option value="$immatriculation" >$nomDuModele || $immatriculation</option>
// ces options sont celles du <Select> qui permet de choisir le modele du véhicule
//
function remplir_select_vehicule(){
    $link_db = connect_to_db();
	$vehicules = get_all_vehicules($link_db);
	$marques = get_all_marques($link_db);
    $modeles = get_all_modeles($link_db);

	$clients = get_all_clients($link_db);
    close_db($link_db);

	//variable qui va mémoriser l'id du client (vide pour l'instant)
	$precedent_id_client= "";
	//booleen qui va indiquer si une balise html <optgroup> est ouverte ou pas
	$balise_optgroup_ouverte = false;

	//Première otion de la balise <select> ... </select>
	$select_vehicule = '<option> Séléctionner le véhicule</option>';

	//Parcourir le tableau des véhicules remplit depuis la table vehicules
	//pour chaque élément (ligne) du tableau $vehicules
	//l'index de l'enregistrement est placé dans $key et le reste des attributs est placé dans un tableau $details 
	//et le nom du modele( nom_modele) est placé dans $nom_model_et_id_marque
	foreach($vehicules as $key => $details){
		//extraction du contenu du tableau $details (seuls les ids  et l'immatriculation nous interessent) 
		$id_cli = $details['id_cli'];
		$id_marque = $details['id_marque'];
		$id_modele = $details['id_modele'];
		$immatriculation = $details['immatriculation'];


		//identifier la marque est le modèle d'apres leurs ids respectives dans les tableaux $marques et $modeles
		$nomDeLaMarque = $marques[$id_marque];
		$nomDuModele = $modeles[$id_modele]['nom_modele']; 

		//test si le id du client a changé
		if($id_cli != $precedent_id_client){
			//si oui : fermer la balise </optgroup> (forcement ouverte avant)
			//memoriser que la balise <optgroup> n'est plus ouverte
			if ($balise_optgroup_ouverte = true) {
				$select_vehicule .= '</optgroup>';
				$balise_optgroup_ouverte = false;
			}
			//Ouvrir une balise <optgroup> avec comme value le id du client (!!! il sera utilisé dans JS pour filtrer la liste)
			//dans le label de <optgroup> mettre le texte qui doit s'afficher : ici la marque et le modele du véhicule
			$select_vehicule .= '<optgroup id="'.$id_cli.'"  label="'.$nomDeLaMarque.'" >';
			//marquer le id de la marque comme étant le précédent (pour le prochain tour)
			$precedent_id_client = $id_cli;
			//mémoriser qu'une balise <optgroup> est ouverte
			$balise_optgroup_ouverte = true;
		}
		
		//Ajouter l'option du <select> qui indique l'immatriculation  et lui attribuer comme value le num d'immatriculation
		$select_vehicule .= '<option value="'.$immatriculation.'" >'.$nomDuModele.' || '.$immatriculation.'</option>';

	}


	return $select_vehicule ;

}


//
// Cette fonction est utilisée dans dlg_newRDV.php
// Elle créé : <optgroup   label="$cabinetExperts" >
// et : <option value="$id_expert" >$nomExpert $prenomExpert</option>
// ces options sont celles du <Select> qui permet de choisir le nom de l'expert
//
function remplir_select_expert(){
    //Lecture des tables 
	$link_db = connect_to_db();
	$cabinetsExpertise = get_all_cabinets_expertise($link_db);
    $experts = get_all_experts($link_db);
    close_db($link_db);

	//variable qui va mémoriser l'id du cabinet d'experise
	$precedent_id_cabinet= "";
	//booleen qui va indiquer si une balise html <optgroup> est ouverte ou pas
	$balise_optgroup_ouverte = false;

	//Première otion de la balise <select> ... </select>
	$select_expert = '<option> Séléctionner l\'expert</option>';

	//Parcourir le tableau $experts remplit depuis la table experts
	//pour chaque enregistrement (ligne) du tableau $experts
	//l'index dans le tableau est placé dans $key et le reste des attributs est placé dans un tableau $details
	foreach($experts as $key => $details){
		//extraction du contenu du tableau $details (seul le nom de l'expert, les ids expert et cabinet nous interessent ici  )
		$id_expert = $details['id_exp'];
		$id_cabinet = $details['id_cab'];
		$nom_expert = $details['nom_exp'];
		$prenom_expert = $details['prenom_exp'];

		//parcourir le tableau $cabinetsExpertise à la recherche de l'id (id_cab) correspondant à $id_cab trouvé dans le tableau $experts
		//attention : faire  $nomCabinet = $cabinetsExpertise[$id_cabinet] serait FAUX
		//car dans le tableau l'index dans le tableau $cabinetsExpertise et l'id_cab ne sont pas forcement les même
		//voir la fonction get_all_cabinets_expertise($link_db)
		$nomCabinetExpertise ="";
		foreach ($cabinetsExpertise as $key => $val) {
			if ($val['id_cab'] === $id_cabinet) {
				$nomCabinetExpertise = $val['nom_cab'];
				break;
			}
		}

		//test si le id du cabinet d'expertise a changé
		if($id_cabinet != $precedent_id_cabinet){
			//si oui : fermer la balise </optgroup> (forcement ouverte avant)
			//memoriser que la balise <optgroup> n'est plus ouverte
			if ($balise_optgroup_ouverte = true) {
				$select_expert .= '</optgroup>';
				$balise_optgroup_ouverte = false;
			}
			//Ouvrir une balise <optgroup> : value n'est pas utile car on n'aura pas à filtrer la liste sinon mettre l'id di cabinet par exemple
			//dans le label de <optgroup> mettre le texte qui doit s'afficher : ici le nom du cabinet d'expertise
			$select_expert .= '<optgroup  label="'.$nomCabinetExpertise.'" >';
			//marquer le id de la marque comme étant le précédent (pour le prochain tour)
			$precedent_id_cabinet = $id_cabinet;
			//mémoriser qu'une balise <optgroup> est ouverte
			$balise_optgroup_ouverte = true;
		}
		
		//Ajouter l'option du <select> qui indique le nom et le prenom de l'expert et lui attribuer comme value le id de l'expert
		$select_expert .= '<option value="'.$id_expert.'" >'.$nom_expert.' '.$prenom_expert.'</option>';
    }


    return $select_expert ;
}



//
// Cette fonction est utilisée dans dlg_newRDV.php
// Elle créé : <optgroup   label="$cabinetExperts" >
// et : <option value="$id_expert" >$nomExpert $prenomExpert</option>
// ces options sont celles du <Select> qui permet de choisir le nom de l'expert
//
function remplir_select_garage(){
    //Lecture des tables 
	$link_db = connect_to_db();
	$garages = get_all_garages($link_db);
    close_db($link_db);

	//variable qui va mémoriser le département
	$precedent_departement= "";
	//booleen qui va indiquer si une balise html <optgroup> est ouverte ou pas
	$balise_optgroup_ouverte = false;

	//Première otion de la balise <select> ... </select>
	$select_garages = '<option> Séléctionner le garage</option>';

	//Parcourir le tableau $garages remplit depuis la table garages
	//pour chaque enregistrement (ligne) du tableau $garages
	//l'index dans le tableau est placé dans $key et le reste des attributs est placé dans un tableau $details
	foreach($garages as $key => $details){
		//extraction du contenu du tableau $details (seul l'id et le nom du garage ainsi que son CP et ville nous interessent ici  )
		$cp = $details['cp_gar'];
		$nom_garage = $details['nom_gar'];
		$ville_garage = $details['ville_gar'];
		$id_garage = $details['id_gar'];

		//Recuperer le n° du département à partir du CP
		//on récupère 2 caractères à partir du premier (indice 0)
		$departement = substr($cp, 0, 2);

		//test si le id du cabinet d'expertise a changé
		if($departement != $precedent_departement){
			//si oui : fermer la balise </optgroup> (forcement ouverte avant)
			//memoriser que la balise <optgroup> n'est plus ouverte
			if ($balise_optgroup_ouverte = true) {
				$select_garages .= '</optgroup>';
				$balise_optgroup_ouverte = false;
			}
			//Ouvrir une balise <optgroup> : value n'est pas utile car on n'aura pas à filtrer la liste 
			//dans le label de <optgroup> mettre le texte qui doit s'afficher : ici le n° du département 
			$select_garages .= '<optgroup  label="'.$departement.'" >';
			//marquer le id de la marque comme étant le précédent (pour le prochain tour)
			$precedent_departement = $departement;
			//mémoriser qu'une balise <optgroup> est ouverte
			$balise_optgroup_ouverte = true;
		}
		
		//Ajouter l'option du <select> qui indique le nom et le prenom de l'expert et lui attribuer comme value le id de l'expert
		$select_garages .= '<option value="'.$id_garage.'" >'.$nom_garage.' ('.$ville_garage.')</option>';
    }


    return $select_garages ;
}

/*
echo "<pre>";
$link_db = connect_to_db();
$modeles = get_all_modeles($link_db);
close_db($link_db);
print_r( $modeles);
echo "</pre>";
*/




?>

