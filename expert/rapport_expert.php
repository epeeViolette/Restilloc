<?php
    
    // $_POST['immatriculation']="JJ-123-ML";
    // $_POST['refDossier']="1";
    // $_POST['description']="Bonjour";

    if(isset($_POST['description'])){

        
        include('../connection.php');
        $link_db = connect_to_db();
        
        


        $sql = "INSERT INTO rapportexpertise (ref_dossier,immatriculation,rapport_expert) values('".$_POST['refDossier']."','".$_POST['immatriculation']."','".$_POST['description']."')";
        $req_result = mysqli_query($link_db, $sql) or die('ERREUR sql dossierderestitution depuis immatriculation'.$sql);
        
        $dernierId = mysqli_insert_id($link_db);


        
    echo "SUCCESS% Dossier insérer OK !".$dernierId;
    // ."%".json_encode($rapportExpertise);

    }
    else{
        echo "ECHEC% Accès dossier impossible !!";  // Accès dossier impossible
    }


?>