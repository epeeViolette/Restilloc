
<?php


    //  $_POST['login'] = 'dylan98';
    //  $_POST['password'] = '123456';


    if(isset($_POST['login']) && isset($_POST['password'])){


        include('../connection.php');
        $link_db = connect_to_db();
         
        
        
        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $login = $_POST['login']; 
        $mdp = $_POST['password'];
    
    if($login !== "" && $mdp !== "")
    {
    
        

        $requete = "SELECT count(*) FROM experts where login_exp= '".$_POST['login']."' and password_exp= '".$_POST['password']."'";
        $requete_connect = mysqli_query($link_db,$requete) or die("Erreur dans requette count connexion : <br>".$requete );
        // $rows = $requete_connect->fetch_array($requete_connect,MYSQLI_BOTH);

        // foreach($rows as $enregistresement){
        //     $count=$enregistresement['count(*)'];
        // }

        while ($enregistresement = mysqli_fetch_assoc($requete_connect)) {
            $count=$enregistresement['count(*)'];
        }

        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
            $requete ="SELECT * FROM experts where login_exp= '".$_POST['login']."' and password_exp= '".$_POST['password']."'";  
            $requete_connect = mysqli_query($link_db,$requete) or die("Erreur dans requette connexion  : <br>".$requete );
            // $rows = $requete_connect->fetch_array($requete_connect,MYSQLI_BOTH);
            
            $a =array(); 

            while ($enregistresement = mysqli_fetch_assoc($requete_connect)) {
                $a['id_exp'] = $enregistresement['id_exp'];
            $a['nom_exp'] =  $enregistresement['nom_exp'];
            $a['prenom_exp'] =  $enregistresement['prenom_exp'];
            $a['portable_exp'] = $enregistresement['portable_exp'];
            $a['login_exp'] = $enregistresement['login_exp'];
            $a['password_exp'] = $enregistresement['password_exp'];
            }
        // foreach($rows as $enregistresement){
        //     $a['id_exp'] = $enregistresement['id_exp'];
        //     $a['nom_exp'] =  $enregistresement['nom_exp'];
        //     $a['prenom_exp'] =  $enregistresement['prenom_exp'];
        //     $a['portable_exp'] = $enregistresement['portable_exp'];
        //     $a['login_exp'] = $enregistresement['login_exp'];
        //     $a['passeword_exp'] = $enregistresement['passeword_exp'];
        // }

        echo "SUCCESS%".json_encode($a);
        }
        else
        {
        echo "ECHEC% Identifiants incorrects";  // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
    echo "ECHEC% Tous les champs sont requis" ; // utilisateur ou mot de passe vide
    }
}
else
{
    echo "ECHEC% Echec de connexion à la base de données";
}







?>
