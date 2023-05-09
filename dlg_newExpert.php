
<?php



?>



<div class="modal" id="newExpert" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered dialog modal-md" role="document">
    <div class="modal-content">
      <!--
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un ...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      -->
      <div class="modal-body p-0">
        <form class="form-newExpert"  method="post" action = "index.php?page=traitements">
            <fieldset >
              <legend>Expert</legend> <!-- Titre du fieldset --> 
              <div class="form-group row">
                <div class="col-2 p-0" >
                    <label for="cabinet" class="lbl_cabinet">Societé</label>
                </div>
                <div class="col-10 p-0 ">
                    <select class="selectpicker select_cabinet" name="select_cabinet">
                        <?php echo remplir_select_cabinet_d_experts() ;?>
                    </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-2 p-0" >
                    <label for="nom" class="lbl_nom">Nom</label>
                    <label for="prenom" class="lbl_prenom">Prenom</label>    
                </div>
                <div class="col-10 p-0 ">
                    <input type="text" class="form-control input_nom" name="nom_exp" placeholder="Nom">
                    <input type="text" class="form-control  input_nom" name="prenom_exp" placeholder="Prénom">
                </div>
              </div>
            
              <div class="form-group row">
                <div class="col-2 p-0" >
                  <label for="telephone" class="lbl_telephone">Télephone</label>
                  <label for="email" class="lbl_email">Email</label>
                </div>
                <div class="col-10 p-0 ">
                  <input type="text" class="form-control  input_telephone" name="telephone_exp" placeholder="Télephone">
                  <input type="email" class="form-control  input_email" name="email_exp" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-3" ></div>
                <div class="col-6 p-1" >
                <button type="submit" value="add_expert" name="traitement" class="btn btn-primary btn-sm">Enregistrer Expert</button>
                  <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Annuler</button>
                </div>
                <div class="col-3" ></div>
            </div>
            </fieldset>
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

