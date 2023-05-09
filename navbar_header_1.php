<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">RESTILLOC</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >Dossiers clients</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newClient">Nouveau client</a></li> 
            <li><hr class="dropdown-divider"></li> 
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newVehicule">Nouveau véhicule</a></li> 
            <li><hr class="dropdown-divider"></li> 
            <li><a class="dropdown-item" href="index.php?page=liste_dossiers">Liste des clients / véhicules</a></li> 
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >Dossiers de restitution</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newRdv">Programmer un RDV de restitution</a></li> 
            <li><hr class="dropdown-divider"></li> 
            <!-- <li><a class="dropdown-item" href="index.php?page=">Afficher le dossier de restitution</a></li>  -->
            <li><hr class="dropdown-divider"></li> 
            <li><a class="dropdown-item" href="index.php?page=liste_rdv">Liste des dossiers de restitution</a></li> 
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >Experts</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newExpert">Ajouter un Expert</a></li> 
            <li><hr class="dropdown-divider"></li> 
      
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newCabinetExpertise">Ajouter un cabinet d'expertise</a></li> 
            <li><hr class="dropdown-divider"></li> 
      
            <li><a class="dropdown-item" href="index.php?page=liste_experts">Liste des experts</a></li> 
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >Garages</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#newGarage">Ajouter un garage</a></li> 
      
            <li><hr class="dropdown-divider"></li> 
            <li><a class="dropdown-item" href="index.php?page=liste_garages">Liste des garages</a></li> 
          </ul>
        </li>
        

        

      </ul>

      

    </div>

    
          <div class="search-container">
            <form action="./index.php?page=traitements" method="POST" class="form_navbar">
              <input type="text" placeholder="Saisir Nom client" name="client"> 
              <button class="btn btn-info btn-sm" name="traitement" value="openDossier" type="submit">Ouvrir</button>
            </form>
          </div>
        

  </div>
</nav>