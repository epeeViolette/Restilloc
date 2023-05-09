
<script>
function mettre_a_jour_la_liste_des_vehicules(){
    id_client = $("#select_cli").val();
    client_selected_index=$("#select_client option:selected").index();
    alert(id_client);

    $('#select_vehicule optgroup[value="'+id_client+'"]').show();
    /*
    //si l'option "seléctionner le client" est selectionnée afficher tous les véhicules
    if(client_selected_index == 0){
        $("#select_vehicule optgroup").show();
    }
    else{
        //si un client est selectionnée cacher tous les groupes d'options dans le select des modèles
        $("#select_vehicule optgroup").hide();
        //puis afficher le groupe d'options correspondant à l'Id du client sélectionné
        $("#select_vehicule optgroup#"+id_client).show();
    }
    */
}



</script>

<?php




?>


<div class="modal" id="newRdv" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered dialog modal-md" role="document">
    <div class="modal-content">
        <!--
        <div class="modal-header">
            <h5 class="modal-title">Ajouter un cabinet d'expertise</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        -->
        <div class="modal-body p-0">
            <form class="form-newRdv row"  method="post" action = "index.php?page=traitements">
                
                <div class="col-12  p-1">
                   
                    <fieldset class="rdv" style="visibility : visible">
                        <legend>Rendez-vous de restitution</legend> <!-- Titre du fieldset --> 
                        <div class="form-group row">
                            <div class="col-4 p-0" >
                            <label for="client" class="lbl_client">Client</label>
                            <label for="vehicules" class="lbl_vehicule">Véhicule</label>
                            <label for="expert" class="lbl_expert">Expert</label>
                            <label for="garage" class="lbl_garage">Lieu de RDV</label>
                            <label for="date_rdv" class="lbl_date_rdv">Date et heure</label>
                            </div>
                            <div class="col-8 p-0 ">
                                <select class="selectpicker select_client" id="select_cli"  name="select_client" onchange="mettre_a_jour_la_liste_des_vehicules();">
                                    <?php  
                                        echo remplir_select_client(); 
                                    ?>
                                </select>
                                <select class="selectpicker select_vehicule" id="select_vehicule"  name="select_vehicule" >
                                    <?php  
                                        echo remplir_select_vehicule();
                                    ?>
                                </select>
                                <select class="selectpicker select_expert" id="select_expert"  name="select_expert" >
                                    <?php  
                                        echo  remplir_select_expert() ;
                                    ?>
                                </select>

                                <select class="selectpicker select_garage" id="select_garage"  name="select_garage" >
                                    <?php  
                                        echo  remplir_select_garage() ;
                                    ?>
                                </select>
                            <input type="datetime-local" class="form-control  input_date_rdv" name="date_rdv" placeholder="Choisir une date">
                            </div>
                        </div>
                    </fiedset>

                </div>

                <div class="form-group p-1" style="text-align: center;width: 100%;">
                    
                    <button type="submit" value="add_rdv" name="traitement" class="btn btn-primary btn-sm">Enregistrer le rendez-vous</button>
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