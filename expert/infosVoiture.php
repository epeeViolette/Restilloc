

<?php


    //$_POST['immatriculation'] = 'U23568QXYuu';
    // $_POST['login'] = 'dylan98';
    // $_POST['password'] = '123456';


    if(isset($_POST['immatriculation'])){


        include('../connection.php');
        $link_db = connect_to_db();
         
       
        
        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $req = "SELECT id_cli FROM vehicules WHERE immatriculation = '".$_POST['immatriculation']."'";
        $req_result = mysqli_query($link_db, $req) or die('ERREUR sql id_cli depuis immatriculation'.$req);
        while ($enregistresement = mysqli_fetch_assoc($req_result)) {
            $id_client=$enregistresement['id_cli'];
        }


        $sql = "SELECT * FROM clients AS Client 
				LEFT JOIN vehicules AS Vehicule ON  Vehicule.id_cli = Client.id_cli 
				LEFT JOIN marquesvehicules AS Marque ON Vehicule.id_marque = Marque.id_marque
				LEFT JOIN modelesvehicules AS Modele ON Vehicule.id_modele = Modele.id_modele
				LEFT JOIN avoirrendezvous AS Rdv ON Rdv.id_cli = Client.id_cli

			WHERE Client.id_cli = ".$id_client." ";

    $dossierClient=array();
	
    if($req = mysqli_query($link_db, $sql) or die('fonctions.php - get_DossierClient_by_id($link_db, $id_client, $immatriculation) <br>'.$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$dossierClient['nom_cli']=$data['nom_cli'];
			$dossierClient['prenom_cli']=$data['prenom_cli'];
			$dossierClient['adresse_cli']=$data['adresse_cli'];
			$dossierClient['cp_cli']=$data['cp_cli'];
			$dossierClient['ville_cli']=$data['ville_cli'];
			//$dossierClient['telephone_cli']=$data['telephone_cli']; 
			$dossierClient['portable_cli']=$data['portable_cli']; 
			//$dossierClient['email_cli']=$data['email_cli']; 
            $dossierClient['immatriculation']=$data['immatriculation']; 
			$dossierClient['dateMEC']=$data['dateMEC']; 
            $dossierClient['nom_marque']=$data['nom_marque']; 
			$dossierClient['nom_modele']=$data['nom_modele'];
			
            //$dossierClient['id_cli']=$data['id_cli'];
			
		} 
		
	}
	//echo "<pre>";
	//print_r($dossierClient);
	//echo "</pre>";
	
    
    echo "SUCCESS%".json_encode($dossierClient);

    }
    else{
        echo "ECHEC% Identifiants incorrects";  // utilisateur ou mot de passe incorrect
    }