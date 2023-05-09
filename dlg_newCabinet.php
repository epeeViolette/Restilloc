<div class="modal" id="newCabinetExpertise" tabindex="-1" role="dialog">
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
        <form class="form-newCabinet"  method="post" action = "index.php?page=traitements">
            <fieldset >
              <legend>Cabinet d'expertise</legend> <!-- Titre du fieldset --> 

              <div class="form-group row">
                <div class="col-2 col-12-md p-0" >
                  <label for="nom" class="lbl_nom">Societé</label>     
                </div>
                <div class="col-10 p-0 ">
                  <input type="text" class="form-control input_nom" name="nom_cab" placeholder="Nom"> 
                </div>
              </div>
            
              <div class="form-group row ">
                <div class="col-2 p-0" >
                  <label for="adresse" class="lbl_adresse">Adresse</label>
                  <label for="cp" class="lbl_cp">CP</label>
                  <label for="ville" class="lbl_ville">Ville</label>
                </div>
                <div class="col-10 p-0 ">
                  <input type="text" class="form-control  input_adresse" name="adresse_cab" placeholder="Adresse">
                  <input type="text" class="form-control  input_cp" name="cp_cab" placeholder="CP" size="10">
                  <input type="text" class="form-control  input_ville" name="ville_cab" placeholder="Ville">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-2 p-0" >
                  <label for="telephone" class="lbl_telephone">Télephone</label>
                  <label for="email" class="lbl_site_web">Site web</label>
                </div>
                <div class="col-10 p-0 ">
                  <input type="text" class="form-control  input_telephone" name="telephone_cab" placeholder="Télephone">
                  <input type="text" class="form-control  input_site_web" name="site_web_cab" placeholder="Site Web">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-2" ></div>
                <div class="col-8 p-1" >
                <button type="submit" value="add_cabinet" name="traitement" class="btn btn-primary btn-sm">Enregistrer le cabinet d'experts</button>
                  <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Annuler</button>
                </div>
                <div class="col-2" ></div>
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