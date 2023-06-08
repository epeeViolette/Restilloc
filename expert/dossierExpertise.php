


<?php
    $_POST['immatriculation']="JJ-123-ML";

    if(isset($_POST['immatriculation'])){

        
        include('../connection.php');
        $link_db = connect_to_db();
         
       
        


        $sql = "SELECT * FROM dossiersderestitution WHERE immatriculation = '".$_POST['immatriculation']."' ";
        $req_result = mysqli_query($link_db, $sql) or die('ERREUR sql dossierderestitution depuis immatriculation'.$sql);
    
        $dossierExpertise=array();
	
    if($req = mysqli_query($link_db, $sql) or die('fonctions.php - get_DossierClient_by_id($link_db, $id_client, $immatriculation) <br>'.$sql))
	{		
		while($data = mysqli_fetch_assoc($req)) 
		{ 
			$dossierExpertise['ref_dossier']=$data['ref_dossier'];
			$dossierExpertise['dateCreation']=$data['dateCreation'];
			//$dossierExpertise['folder']=$data['folder'];
            $dossierExpertise['immatriculation']=$data['immatriculation'];
		} 
		
	}

    $sql = "SELECT * FROM dossiersderestitution WHERE immatriculation = '".$_POST['immatriculation']."' ";
    $req_result = mysqli_query($link_db, $sql) or die('ERREUR sql dossierderestitution depuis immatriculation'.$sql);

    $dossierExpertise=array();

if($req = mysqli_query($link_db, $sql) or die('fonctions.php - get_DossierClient_by_id($link_db, $id_client, $immatriculation) <br>'.$sql))
{		
    while($data = mysqli_fetch_assoc($req)) 
    { 
        $dossierExpertise['ref_dossier']=$data['ref_dossier'];
        $dossierExpertise['dateCreation']=$data['dateCreation'];
        //$dossierExpertise['folder']=$data['folder'];
        $dossierExpertise['immatriculation']=$data['immatriculation'];
    } 
    
}

        
    echo "SUCCESS%".json_encode($dossierExpertise);
    // ."%".json_encode($rapportExpertise);

    }
    else{
        echo "ECHEC% Accès dossier impossible !!";  // Accès dossier impossible
    }


?>