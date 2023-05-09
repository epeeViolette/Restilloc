
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


?>




<div class="modal" id="newVehicule" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered dialog modal-md" role="document">
    <div class="modal-content">
        <!--
        <div class="modal-header">
            <h5 class="modal-title">Ajouter un Véhicule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        -->
        <div class="modal-body p-0">
            <form class="form-newVehicule row"  method="post" action = "index.php?page=traitements">

                <div class="col-12  p-1">
                    <fieldset class="vehicule">
                        <legend>Véhicule</legend> <!-- Titre du fieldset --> 

                        <div class="form-group row">
                            <div class="col p-0" >
                            <label for="client" class="lbl_client">Client Locataire</label>
                            </div>
                            <div class="col-8 p-0 "> 
                                <select class="selectpicker select_client" id="select_client"  name="select_client" >
                                    <?php  
                                        echo remplir_select_client(); 
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col p-0" >
                            <label for="immatriculation" class="lbl_immatriculation">Immatriculation</label>
                            <label for="vin" class="lbl_motorisation">Motorisation</label>
                            </div>
                            <div class="col-8 p-0 ">
                            <input type="text" class="form-control  input_immatriculation" name="immatriculation" placeholder="Immatriculation">
                            <select class="selectpicker select_motorisation" id="select_motorisation" name="select_motorisation" >
                                <option >choisir une motorisation</option>
                                <option value="Diesel" >Diesel</option>
                                <option value="Essence" >Essence</option>
                                <option value="Hybride" >Hybride</option>
                                <option value="Electrique" >Electrique</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col p-0" >
                            <label for="marque" class="lbl_marque">Marque</label>
                            <label for="model" class="lbl_modele">Modèle</label>
                            </div>
                            <div class="col-8 p-0 ">
                                <select class="selectpicker select_marque" id="select_marque" name="select_marque" onchange="mettre_a_jour_le_liste_des_modeles();">
                                    <?php  echo remplir_select_marque() ?>
                                </select>
                                <select class="selectpicker select_modele" id="select_modele" name="select_modele">
                                    <?php   echo remplir_select_modele() ?>    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col p-0" >
                            <label for="date_mise_en_circulation" class="lbl_date_mise_en_circulation">Date de mise en circulation</label>
                            </div>
                            <div class="col-8 p-2    ">
                            <input type="date" class="form-control  input_date_mise_en_circulation" name="date_mise_en_circulation" placeholder="Choisir une date">
                            </div>
                        </div>
                    </fieldset>


                </div>

                <div class="form-group p-1" style="text-align: center;width: 100%;">
                    
                    <button type="submit" value="add_vehicule" name="traitement" class="btn btn-primary btn-sm">Enregistrer le véhicule</button>
                    <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Annuler</button>
                    
                </div>
            </form>
        </div>
        <!--
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        </div>
        -->
    </div>
</div>
</div>