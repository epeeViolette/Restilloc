<?php
    if(isset($_POST['btn_maj'])){
        var_dump($_POST);
       //echo $_GET['id_client'];
       $id_client_modif = $_GET['id_client'];
        $link_db = connect_to_db();

        $sql_modif_client = "UPDATE clients SET nom_cli = '".$_POST['nom_client_modif']."',prenom_cli='".$_POST['prenom_client_modif']."',
        adresse_cli='".$_POST['adresse_client_modif']."',cp_cli='".$_POST['cp_client_modif']."',
        ville_cli='".$_POST['ville_client_modif']."',telephone_cli='".$_POST['telephone_client_modif']."',
        portable_cli='".$_POST['portable_client_modif']."',email_cli='".$_POST['email_client_modif']."' 
        WHERE id_cli=".$id_client_modif." ";
        $req_modif = mysqli_query($link_db, $sql_modif_client ) or die("Erreur dans update_modif : <br>".$sql_modif_client ); 


        $sql_select_vehicule = "SELECT id_modele,id_marque FROM modelesvehicules,marquesvehicules WHERE modelesvehicules.nom_modele = '".$_POST['select_modele']."' AND marquesvehicules.nom_marque = '".$_POST['select_marque_modif']."'";
        $req_modif = mysqli_query($link_db, $sql_select_vehicule ) or die("Erreur dans update_modif : <br>".$sql_select_vehicule );
        $rows = mysqli_fetch_all($req_modif, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            $row["id_modele"];
            $row["id_marque"];
        }

        $sql_modif_vehicule = "UPDATE vehicules SET 
        dateMEC = '".$_POST['date_modif']."',motorisation = '".$_POST['select_motorisation']."',
        puissance = '',id_cli = ".$id_client_modif.",id_marque = ".$row["id_marque"].",
        id_modele = ".$row["id_modele"]." 
        WHERE id_cli = ".$id_client_modif."";
        $req_modif = mysqli_query($link_db,$sql_modif_vehicule) or die("Erreur dans update_modif vehicule : <br>".$sql_modif_vehicule );


        close_db($link_db);
        //print_r($sql_modif);
        
    }
?>
<script>
function mettre_a_jour_le_liste_des_modeles(){
    id_marque = $("#select_marque").val();
    marque_selected_index=$("#select_marque option:selected").index();
   
    //si l'option "seléctionner la marque" est selectionnée afficher tous les modèles
    if(marque_selected_index == 0){
        $("#select_modele optgroup").show();
    }
    else{
        //si une marque est selectionnée cacher tous les groupes d'options dans le select des modèles
        $("#select_modele optgroup").hide();
        //puis afficher le groupe d'options correspondant à la marque séléctionnée
        $("#select_modele optgroup#"+id_marque).show();
    }
}

</script>

<?php
// echo "<pre>";
// print_r($dossierClient);
// echo "</pre>";
function remplir_select_marque_modif($dossierClient){
    $link_db = connect_to_db();
    $marques = get_all_marques($link_db);
    close_db($link_db);

    $select_marques = '<option> '.$dossierClient['nom_marque'].'</option>';;
    foreach($marques as $key => $value){
        $select_marques .= '<option value="'.$key.'" >'.$value.'</option>';
    }

    return $select_marques ;
}


function remplir_select_modele_modif($dossierClient){
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
	$select_modele = '<option>'.$dossierClient['nom_modele'].'</option>';

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
?>
<form action="./index.php?page=modifyClient&id_client=<?php echo $dossierClient['id_cli'] ;?>&immatriculation=<?php echo $dossierClient['immatriculation']; ?>" method="post">
<div id="dossierClient">
    <div class="client row">
        <div class="col-5">
            
            <div class="row p-1">
                <div class="col-12 titre_client">
                    Client
                </div> 
                <div class="col-3 labels_client" >
                    Nom : <br>
                    Prénom : <br><br><br>
                    Adresse : <br>
                    CP : <br>
                    Ville : <br><br>
                    Télephone : <br>
                    Portable : <br><br><br>
                    Email : <br>
                </div>
                <div class="col-9 valeurs_client" >
                    <input type="text" name="nom_client_modif" value="<?php echo $dossierClient['nom_cli']; ?>"><br>
                    <input type="text" name="prenom_client_modif" value="<?php echo $dossierClient['prenom_cli']; ?>"><br><br>
                    <?php //echo $dossierClient['num_cli']."<br>"; ?>
                    <input type="text" name="adresse_client_modif" value="<?php echo $dossierClient['adresse_cli']; ?>"><br>
                    <input type="text" name="cp_client_modif" value="<?php echo $dossierClient['cp_cli']; ?>"><br>
                    <input type="text" name="ville_client_modif" value="<?php echo $dossierClient['ville_cli']; ?>"><br><br>    
                    <input type="text" name="telephone_client_modif" value="<?php echo $dossierClient['telephone_cli'] ?>"><br>
                    <input type="text" name="portable_client_modif" value="<?php echo $dossierClient['portable_cli']; ?>"><br><br>
                    <input type="email" name="email_client_modif" value="<?php echo $dossierClient['email_cli']; ?>"><br>
                </div>
            </div>

            <div class="row p-1">
                <div class="col-12 titre_vehicule">
                    Véhicule
                </div> 
                <div class="col-4 labels_vehicule" >
                    Immatriculation : <br>
                    Marque : <br>
                    Modèle : <br>
                    Motorisation : <br>
                    Date MEC : <br>
                </div>
                <div class="col-8 valeurs_vehicule" >
                    <label><?php echo $dossierClient['immatriculation']; ?></label><br>
                    <select class="selectpicker select_marque" id="select_marque" name="select_marque_modif" onchange="mettre_a_jour_le_liste_des_modeles();">
                                    <?php  echo remplir_select_marque_modif($dossierClient) ?>
                    </select><br>
                    <select class="selectpicker select_modele" id="select_modele" name="select_modele">
                                    <?php   echo remplir_select_modele_modif($dossierClient) ?>    
                    </select><br>
                    <select class="selectpicker select_motorisation" id="select_motorisation" name="select_motorisation" >
                                <option ><?php echo $dossierClient['motorisation'];?></option>
                                <option value="Diesel" >Diesel</option>
                                <option value="Essence" >Essence</option>
                                <option value="Hybride" >Hybride</option>
                                <option value="Electrique" >Electrique</option>
                    </select><br>
                    <input type="date" name="date_modif"  value="<?php echo $dossierClient['dateMEC']; ?>"><br>
                    
                </div>
            </div>

            <!-- <div class="col-12 boutons p-1">
                  
                <a type="button" class="btn btn-primary  btn-sm"  href="./index.php?page=modifierClient">Modifier le Client</a> 
                
                
                <a type="button" class="btn btn-primary  btn-sm"  href="./index.php?page=modifierVehicule">Modifier le vihicule</a> 
                
            </div> -->

        </div>

        <div class="col-7">
              
            <div class="row p-1">
                <div class="col-12 titre_rdv">
                Rendez-vous de restitution
                </div> 
                <div class="col-3 labels_rdv" >
                    Planifié pour le : <br>
                    avec l'expert : <br>
                    de la société : <br><br>
                    lieu de RDV : <br>

                </div>
                <div class="col-9 valeurs_rdv" >
                    <input type="datetime-local" name="date_rdv_modif"  value="<?php echo $dossierClient['dateRDV']; ?>"><br>
                    Nom :  <input type="text" name="nom_exp_rdv_modif"  value="<?php echo $dossierClient['nom_exp']; ?>">
                      Prénom :  <input type="text" name="prenom_exp_rdv_modif"  value="<?php echo $dossierClient['prenom_exp']; ?>"><br> 
                    <input type="text" name="nom_cab_rdv_modif"  value="<?php echo $dossierClient['nom_cab']?>"><br><br>
                    <input type="text" name="nom_gar_rdv_modif"  value="<?php echo $dossierClient['nom_gar']?>"><br>
                    <input type="text" name="adresse_gar_rdv_modif"  value="<?php echo $dossierClient['adresse_gar']?>"><br>
                    Code Postal : <input type="text" name="adresse_gar_rdv_modif"  value="<?php echo $dossierClient['cp_gar'] ?>"><br>
                     Ville :  <input type="text" name="adresse_gar_rdv_modif"  value="<?php echo $dossierClient['ville_gar']; ?>">
                    
                </div>
            </div>
        </div>
    </div>   
        <div style="text-align: center;margin-top:200px;">
            <input type="submit" class="btn btn-danger btn-sm" name="btn_maj" value="Mettre à jour">
        </div>
</div>
</form>