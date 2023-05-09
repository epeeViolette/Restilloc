//
//Faire un scroll
//
function SetScroll(scrollLeft, scrollTop){
	window.scrollTo (scrollLeft, scrollTop);
} 

function getScrollPos()
{
	var scroll = {'Left':0, 'Top':0};
	if (window.pageXOffset !== undefined) { 
		// All browsers, except IE9 and earlier
		scroll.Left = window.pageXOffset;
		scroll.Top = window.pageYOffset;
	} else { 
		// IE9 and earlier
		scroll.Left = document.documentElement.scrollLeft;
		scroll.Top = document.documentElement.scrollTop;
	}
	return scroll;
}

function getRefreshURL(base, defaultDonneeURL, scroll){
	var baseURL = window.location.protocol + "//" + window.location.host  + window.location.pathname;
	var actuelURL = document.location.href;
	var donneesURL= actuelURL.replace(baseURL,"" );

	//alert("window.location.protocol : " + window.location.protocol + "\nwindow.location.host: " + 
	//window.location.host + "\nwindow.location.pathname : "+window.location.pathname);
	
	//alert("baseURL : " + baseURL + "\nactuelURL: " + actuelURL + "\ndonneesURL : "+donneesURL);
	
	if (donneesURL == '') {
		donneesURL = defaultDonneeURL ;
	} 
	
	buf = donneesURL.split('&');
	
	var page="" ;
	if(buf[0]) {
		page = buf[0].substr(1);
	}
	
	var refreshURL = base;
	if (page!=="") refreshURL += '?'+page;

	if (scroll.Top!==0) refreshURL += '&scrollTop='+scroll.Top;
	if (scroll.Left!==0) refreshURL += '&scrollLeft='+scroll.Left;

	//alert("baseURL : " + baseURL + "\nactuelURL: " + actuelURL + "\ndonneesURL : "+ donneesURL+ "\npage : "+page+ "\nrefreshURL : "+refreshURL);
	//alert(refreshURL);
	return(refreshURL);
}



//Cette fonction utilise AJAX pour envoyer des données au fichier : ./admin/article_SqlTableManager.php
//situé coté serveur afin qu'il execute la requette UPDATE sur la table articles
function updateArticle( id_article, fieldName, data ) { 
	// Construre le tableau de données qui sera envoyé en utilisant AJAX
	// au fichier PHP qui vas executer la requette sur la BDD
	let donnees = new FormData();
	donnees.append("todo", "update");
	donnees.append("id_article", id_article);
	donnees.append("fieldName", fieldName);
	donnees.append("data", data);

	// Utilisation de AJAX
	let request =
	$.ajax({
		type: "POST", 	        //Méthode à employer POST ou GET 
		url: "./admin/article_SqlTableManager.php",  //Cible du script coté serveur (fichier PHP à appeler) 
		data:donnees, //cette propriété sert à stocker les données à envoyer
		cache: false, //ce paramètre permet de spécifier si le navigateur doit mettre en cache les pages demandées
		contentType : false, //permets de préciser le type de contenu à utiliser lors de l'envoi au serveur.
		processData : false, // définit si les données envoyées (via data) doivent être transformées en chaine de requête (ex : ?id=1?login=johnDoe). 
		  
		beforeSend: function () {
			//Code à appeler avant l'appel ajax en lui même
			//alert("before");
		}
	});
	
	request.done(function (output) {
		//Code à jouer en cas d'éxécution sans erreur du script du PHP
		//alert(output);
	});
	request.fail(function (error) {
		//Code à jouer en cas d'éxécution en erreur du script du PHP ou de ressource introuvable
		alert("fail\n"+error);
	});
	request.always(function () {
		//Code à jouer après done OU fail quoi qu'il arrive
		//alert("always");
	});
}


//Cette fonction utilise AJAX pour envoyer des données au fichier : ./admin/article_SqlTableManager.php
//situé coté serveur afin qu'il execute la requette INSERT sur la table articles
function insertArticle(categorie) { 
	//Récuperer les contenus HTML des divs titre, contenu et auteur 			
	var titre = $('#titre_0').html();
	var contenu = $('#contenu_0').html();
	var auteur = $('#auteur_0').html();
	
	// Construre le tableau de données qui sera envoyé en utilisant AJAX
	// au fichier PHP qui vas executer la requette sur la BDD
	let donnees = new FormData();
	donnees.append("todo", "insert");
	donnees.append("categorie", categorie);
	donnees.append("titre", titre);
	donnees.append("contenu", contenu);
	donnees.append("auteur", auteur);
	
	var scroll=getScrollPos();
	var refreshURL = getRefreshURL('./index.php', '?page=accueil', scroll);

	// Utilisation de AJAX
	let request =
		$.ajax({
		type: "POST", 	        //Méthode à employer POST ou GET 
		url: "./admin/article_SqlTableManager.php",  //Cible du script coté serveur (fichier PHP à appeler) 
		data:donnees, //cette propriété sert à stocker les données à envoyer
		cache: false, //ce paramètre permet de spécifier si le navigateur doit mettre en cache les pages demandées
		contentType : false, //permets de préciser le type de contenu à utiliser lors de l'envoi au serveur.
		processData : false, // définit si les données envoyées (via data) doivent être transformées en chaine de requête (ex : ?id=1?login=johnDoe). 
		  
		beforeSend: function () {
			//Code à appeler avant l'appel ajax en lui même
			//alert("before");
		}
	});
	request.done(function (output) {
		//Code à jouer en cas d'éxécution sans erreur du script du PHP
		//alert(output);
		window.location.replace(refreshURL);
	});
	request.fail(function (error) {
		//Code à jouer en cas d'éxécution en erreur du script du PHP ou de ressource introuvable
		alert("fail\n"+error);
	});
	request.always(function () {
		//Code à jouer après done OU fail quoi qu'il arrive
		//alert("always");
	});
		
}

//Cette fonction demande la confirmation de suppression d'un article
function confirmDelete(id){
	$('#dialogConfirmDel').modal('toggle');
	$('#dialogConfirmDel #id').val(id);

	$('#zoneArticle_'+id+' #buttonsBar').hide();
	var article = $('#zoneArticle_'+id).html();
	$('#zoneArticle_'+id+' #buttonsBar').show();

	$('#dialogConfirmDel .articleToDelete').html(article);
}

//Cette fonction demande la suppression d'un article
function deleteArticle(id){
	$('#dialogConfirmDel').modal('toggle');

	// Construre le tableau de données qui sera envoyé en utilisant AJAX
	// au fichier PHP qui vas executer la requette sur la BDD
	let donnees = new FormData();
	donnees.append("todo", "delete");
	donnees.append("id", id);
	
	var scroll=getScrollPos();
	var refreshURL = getRefreshURL('./index.php', '?page=accueil', scroll);
	
	// Utilisation de AJAX
	let request =
		$.ajax({
		type: "POST", 	        //Méthode à employer POST ou GET 
		url: "./admin/article_SqlTableManager.php",  //Cible du script coté serveur (fichier PHP à appeler) 
		data:donnees, //cette propriété sert à stocker les données à envoyer
		cache: false, //ce paramètre permet de spécifier si le navigateur doit mettre en cache les pages demandées
		contentType : false, //permets de préciser le type de contenu à utiliser lors de l'envoi au serveur.
		processData : false, // définit si les données envoyées (via data) doivent être transformées en chaine de requête (ex : ?id=1?login=johnDoe). 
		  
		beforeSend: function () {
			//Code à appeler avant l'appel ajax en lui même
			//alert("before");
		}
	});
	request.done(function (output) {
		//Code à jouer en cas d'éxécution sans erreur du script du PHP
		//alert(output);
		window.location.replace(refreshURL);
	});
	request.fail(function (error) {
		//Code à jouer en cas d'éxécution en erreur du script du PHP ou de ressource introuvable
		alert("fail\n"+error);
	});
	request.always(function () {
		//Code à jouer après done OU fail quoi qu'il arrive
		//alert("always");
	});
		
}


//Cette fonction rend une div  editable elle recoit en arguments : 
// idOfDivToEdit : l'id de la div à rendre éditable
// fieldName : le champ dans la table articles de la BDD qui sera remplacé par contenu de la div
// id : l'id dans la table articles de la BDD de l'enregstrement qui sera édité
function setArticleDivEditable (idOfDivToEdit, fieldName, id){
	// Préparation des barres de boutons qui seront utilisées dans l'éditeur TinyMCE
    switch (fieldName){
      case "titre" :    myToolBar1 = 'undo redo | bold italic underline | backcolor forecolor | removeformat | link unlink '; 
                        myToolBar2 = ''; 
                        myToolBar3 = ''; 
                        break;
      case "contenu" :  myToolBar1 =  'fontselect fontsizeselect | bold italic underline | backcolor forecolor | removeformat ' ;
                        myToolBar2 =  'undo redo | styleselect hr h1 h2 h3 numlist' ;
                        myToolBar3 = 'responsivefilemanager | link unlink anchor | image media ';
                        break;
      case "auteur" :   myToolBar1 = 'undo redo | bold italic underline | backcolor forecolor | removeformat | link unlink '; 
                        myToolBar2 = ''; 
                        myToolBar3 = ''; 
                        break;
    }

	// Initialisation d'une variable qui signalera si le contenu de la Div a été modifié
	dataChanged = false;
    
	//Initialisation de l'éditeur TinyMCE
    tinymce.init({
      // au minimum ces 2 lignes
      inline: true,
      selector: "#"+idOfDivToEdit,
      //Cacher la barre de menu
      menubar: false,
      // personnalisation de la barre d'outils
      toolbar1: myToolBar1 ,
      toolbar2: myToolBar2 ,
      toolbar3: myToolBar3 ,

      //charger le plugin "responsivefilemanager" (il doit être present dans le dossier des plugin de TinyMCE)
      plugins: [ "responsivefilemanager link anchor image"],
      
      //Ajouter le gestionnaire de fichier 
      external_filemanager_path:"/filemanager/",
      filemanager_title:"Responsive Filemanager" ,
      external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
    
      init_instance_callback: function(editor) {
    		editor.on('blur', function(event) {
				// Récupérer le contenu HTML de la Div
				data = tinymce.get(idOfDivToEdit).getContent(); 
				// Mettre à jour la table dans la BDD si le contenu à été modifié
				if(dataChanged && id!=0){
						updateArticle(id, fieldName, data) ;
						dataChanged = false;
					}
    		});

			editor.on('keyup', function(event) {
				if(id ==0){
					//Récuperer le contenu des divs titre, contenu et auteur pour activer ou pas le bouton "Enregistrer"
					var t = jQuery.trim($('#titre_0').text()).length;
					var c = jQuery.trim($('#contenu_0').text()).length;
					var a = jQuery.trim($('#auteur_0').text()).length;

					// Activer ou désactiver le bouton "Enregistrer"
					if (t>0 && c>0 && a>0){
						$("#Btn_Save").removeClass("disabled");
					}
					else {
						$("#Btn_Save").addClass("disabled");
					}
				}
    		});
			
    		editor.on('change', function(event) {
				data = tinymce.get(idOfDivToEdit).getContent(); 
				dataChanged = true;
				//alert("change");
   			 });
      }
    });
}







/*
function setArticleDivEditable (idOfDivToEdit, fieldName, id){
    //...
	//...
	//...
    //Initialisation de l'éditeur TinyMCE
    tinymce.init({
    //...
	//...
	//...

      init_instance_callback: function(editor) {
    		editor.on('blur', function(event) {
				//...
				// Mettre ici le code à executer lorsque la div 
				// identifiée par idOfDivToEdit perd le focus
				//...
    		});

    		editor.on('change', function(event) {
				//...
				// Mettre ici le code à executer lorsque le contenu 
				// de la div identifiée par idOfDivToEdit a changé
				//...
   			 });
      }
      
    });
}
*/

/*
function updateArticle( id_article, fieldName, data ) { 
	// Création du tableau de données à envoyer par Ajax
	let donnees = new FormData();
	
	// Ajouter des éléments au tableau : 
	// donnees.append(clé1, valeur1);
	// donnees.append(clé2, valeur2);
	// ...

	// Appel AJAX
	let request =
		$.ajax({
		type: "POST", 	        //Méthode à employer POST ou GET 
		url: "./admin/article_SqlTableManager.php",  // Page PHP à appeler coté serveur 
		data:donnees, //cette propriété sert à stocker les données à envoyer
		cache: false, //ce paramètre permet de spécifier si le navigateur doit mettre en cache les pages demandées
		contentType : false, //permets de préciser le type de contenu à utiliser lors de l'envoi au serveur.
		processData : false, // définit si les données envoyées (via data) doivent être transformées en chaine de requête (ex : ?id=1?login=johnDoe). 
		  
		beforeSend: function () {
			// Placer ici un éventuel code à exécuter avant l'appel ajax en lui même
			//...
		}
	});
	request.done(function (output) {
		// Placer ici un éventuel code à exécuter si tout s'est bien exécuté coté PHP
		// output : variable qui contient les eventuels affichages générés dans le fichier PHP appelé
		// ...
	});
	request.fail(function (error) {
		// Placer ici un éventuel code à exécuter en cas d'erreur coté PHP
		// error : variable qui contient l'erreur survenue
		// ...
	});
	request.always(function () {
		// Placer ici un éventuel code à exécuter  quoi qu'il arrive
		// ...
	});
}
*/
