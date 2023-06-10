<?php
// echo "<pre>";
// print_r($dossierClient);
// echo "</pre>";

?>

<div id="dossierClient">
    <div class="client row">
        <div class="col-5">
            
            <div class="row p-1">
                <div class="col-12 titre_client">
                    Client
                </div> 
                <div class="col-3 labels_client" >
                    Nom : <br>
                    Prénom : <br>
                    Adresse : <br>
                    CP : <br>
                    Ville : <br>
                    Télephone : <br>
                    Portable : <br>
                    Email : <br>
                </div>
                <div class="col-9 valeurs_client" >
                    <?php echo $dossierClient['nom_cli']."<br>"; ?>
                    <?php echo $dossierClient['prenom_cli']."<br>"; ?>
                    <?php echo $dossierClient['adresse_cli']."<br>"; ?>
                    <?php //echo $dossierClient['rue_cli']."<br>"; ?>
                    <?php echo $dossierClient['cp_cli']."<br>"; ?>
                    <?php echo $dossierClient['ville_cli']."<br>"; ?>
                    <?php echo $dossierClient['telephone_cli']."<br>"; ?>
                    <?php echo $dossierClient['portable_cli']."<br>"; ?>
                    <?php echo $dossierClient['email_cli']."<br>"; ?>
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
                    <?php echo $dossierClient['immatriculation']."<br>"; ?>
                    <?php echo $dossierClient['nom_marque']."<br>"; ?>
                    <?php echo $dossierClient['nom_modele']."<br>"; ?>
                    <?php echo $dossierClient['motorisation']."<br>"; ?>
                    <?php echo $dossierClient['dateMEC']."<br>"; ?>
                    
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
                    de la société : <br>
                    lieu de RDV : <br>

                </div>
                <div class="col-9 valeurs_rdv" >
                    <?php echo $dossierClient['dateRDV']."<br>"; ?>
                    <?php echo $dossierClient['nom_exp']."  ".$dossierClient['prenom_exp']."<br>"; ?>
                    <?php echo $dossierClient['nom_cab']."<br>"; ?>
                    <?php echo $dossierClient['nom_gar']."<br>"; ?>
                    <?php echo $dossierClient['adresse_gar']."<br>"; ?>
                    <?php echo $dossierClient['cp_gar']."  ".$dossierClient['ville_gar']."<br>"; ?>
                    
                </div>
            </div>
        </div>
    </div>   
</div>
        <?php   
                $link_db = connect_to_db();
                $dossierClient = get_DossierClient_by_id($link_db, $id_client, $immatriculation) ;
                close_db($link_db); 
        ?>

        <!-- <div class="search-container" style="text-align: center;margin-top:200px;">
            <a class="btn btn-danger btn-sm" href="./index.php?page=modifyDossierClient&id_client=<?php //echo $dossierClient['id_cli'] ;?>&immatriculation=<?php //echo $dossierClient['immatriculation']; ?>" name="traitement" value="modifierDossier" type="submit">Modifier</a>
        </div> -->