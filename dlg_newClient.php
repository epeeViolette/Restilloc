
<div class="modal" id="newClient" tabindex="-1" role="dialog">
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
            <form class="form-newClient row" method="post" action = "index.php?page=traitements">
                <div class="col-12 p-1">
                    <fieldset class="client">
                        <legend>Dossier client</legend> <!-- Titre du fieldset --> 

                        <div class="form-group row">
                            <div class="col-12" >
                            <input type="radio" name="civilite" value="Mr" id="civ_Mr" /> <label for="civ_Mr" class="lbl_civilite">M.</label>
                            <input type="radio" name="civilite" value="Mme" id="civ_Mme" /> <label for="civ_Mme" class="lbl_civilite">Mme</label>
                            <input type="radio" name="civilite" value="Mle" id="civ_Mle" /> <label for="civ_Mle" class="lbl_civilite">Mle</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2 p-0" >
                            <label for="nom" class="lbl_nom">Nom</label>
                            <label for="prenom" class="lbl_prenom">Prenom</label>
                            </div>
                            <div class="col-10 p-0 ">
                            <input type="text" class="form-control input_nom" name="nom_cli" placeholder="Nom">
                            <input type="text" class="form-control  input_nom" name="prenom_cli" placeholder="Prénom">
                            </div>
                        </div>
                        
                        

                        <div class="form-group row">
                            <div class="col-2 p-0" >
                            <label for="adresse" class="lbl_adresse">Adresse</label>
                            </div>
                            <div class="col-10 p-0 ">
                            <input type="text" class="form-control  input_adresse" name="adresse_cli" placeholder="N° et Rue" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2 p-0" >
                            <label for="cp" class="lbl_cp">CP</label>
                            <label for="ville" class="lbl_ville">Ville</label>
                            </div>
                            <div class="col-10 p-0 ">
                            <input type="text" class="form-control  input_cp" name="cp_cli" placeholder="CP" size="10">
                            <input type="text" class="form-control  input_ville" name="ville_cli" placeholder="Ville">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 p-0" >
                            <label for="telephone" class="lbl_telephone">Télephone</label>
                            <label for="portable" class="lbl_portable">Portable</label>
                            <label for="email" class="lbl_email">Email</label>
                            </div>
                            <div class="col-9 p-0 ">
                            <input type="text" class="form-control  input_telephone" name="telephone_cli" placeholder="Télephone">
                            <input type="text" class="form-control  input_portable" name="portable_cli" placeholder="Portable" >
                            <input type="email" class="form-control  input_email" name="email_cli" placeholder="Email">
                            </div>
                        </div>

                    </fieldset>
                </div>

                

                <div class="form-group p-1" style="text-align: center;width: 100%;">
                    
                        <button type="submit" value="add_client" name="traitement" class="btn btn-primary btn-sm">Enregistrer le client</button>
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