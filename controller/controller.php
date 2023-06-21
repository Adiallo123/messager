<?php
class controller{

    
    function accueil(){
        (new vue)->accueil();
    }

    public function erreur404(){
        (new vue)->erreur404();
    }
    public function refresh(){
        (new vue)->refresh();
    }

    public function getPseudo(){
        if(isset($_SESSION['connexion'])){
            $user = (new User)->getPseudo($_GET['id']);
            (new vue)->navTopDiscusion($user);
        }
    }

    public function getProfilDiscusion(){
        //$user = (new User);
         if(isset($_SESSION['connexion'])){
             $user = (new User)->getProfilDiscusion($_GET['id']);
             $pseudo = (new User)->getPseudo($_GET['id']);
             (new vue)->navTopDiscusion($user, $pseudo);
        }
     }

    public function getProfil(){
        //$user = (new User);
         if(isset($_SESSION['connexion'])){
             $user = (new User)->getProfil($_SESSION['connexion']);
             (new vue)->navTop($user);
         }
     }

    public function editionProfil($message = null){
        
        if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])){
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['photo']['size'] <= $tailleMax){
                $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides)){
                    $chemin = "images/".$_SESSION['connexion'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                    if($resultat){
                        $profil = $_SESSION['connexion'].".".$extensionUpload;
                        $editProfil = (new User)->editionProfil($profil, $_SESSION['connexion']);
                        (new vue)->editionProfil($editProfil, "importation de photo avec succée!");
                    }else{
                        (new vue)->editionProfil("Erreur lors de l'importation de votre photo de profil");
                    }
                }else{
                    (new vue)->editionProfil("votre photo de profil dois être au format jpg, jpeg, gif ou png");
                }

            }else{
                (new vue)->editionProfil("votre photo de dois pas dépasser 2Mo");
            }
        }else{
            (new vue)->editionProfil();
        }
    }

    public function recupererMessage(){
        $mess=(new Message);
        $destinataire = $_GET['id'];
        if(isset($_SESSION['connexion'])){
            $mess->recupererMessage($_SESSION['connexion'], $destinataire);
            $profil = (new User)->getProfilDiscusion($_GET['id']);
            $pseudo = (new User)->getPseudo($_GET['id']);
            (new vue)->recupererMessage($mess, $profil, $pseudo);
           header('Refresh:10');
            //(new vue)->ajoutMessage($mess);
            //$lesphoto = (new vue)->navTop();
        }
    }

    public function ajoutMessage($message = null){
        $mes = (new message);
        $profil = (new User)->getProfilDiscusion($_GET['id']);
        $pseudo = (new User)->getPseudo($_GET['id']);
        $destinataire = $_GET['id'];
        if(isset($_SESSION['connexion'])){
            if(isset($_POST['Envoyer'])){
                $mes->ajoutMessage($_POST['message'], $_SESSION['connexion'], $destinataire);
                $mess=(new Message)->recupererMessage($_SESSION['connexion'], $destinataire);
                (new vue)->ajoutMessage($mess, $profil, $pseudo, "envoie avec succée");
                //$lesphoto = (new vue)->navTop();
            }else{
                $mess=(new Message)->recupererMessage($_SESSION['connexion'], $destinataire);
                (new vue)->ajoutMessage($mess, $profil, $pseudo);
               // $lesphoto = (new vue)->navTop();
            }
          //header('Refresh:10');
        }else{
            (new vue)->ajoutMessage("pas encore connecter");
        }

    }

    public function recupererUser(){
       //$user = (new User);
        if(isset($_SESSION['connexion'])){
            $profil = (new User)->getProfil($_SESSION['connexion']);
            $user = (new User)->getAllUser($_SESSION['connexion']);
            //$lesphoto = (new vue)->navTop($profil);
            (new vue)->getAllUser($user, $profil);
        }else{
          (new vue)->getAllUser("Veuillez vous connectez");
        }
    }

    public function inscription($message = null){
        $user = (new User);
        if(isset($_POST['inscrire'])){
            if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['mail']) and !empty($_POST['pseudo']) and !empty($_POST['mdp']) and !empty($_POST['cmdp'])){
                if($user->dejasInscrit($_POST['mail']))
                {
                    (new vue)->dejasIncrit("Vous avez déjas un compte, veuillez vous connectez!");
                }else{
                    
                    if($_POST['mdp']==$_POST['cmdp']){
                        $user->inscription($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pseudo'], sha1($_POST['mdp']));
                        (new vue)->inscription("inscription avec succés");
                    }else{
                        (new vue)->inscription("Les deux mots de passe de sont pas identiques");
                    }
                   
                }
            }else{
                (new vue)->connexion("Tout les champs doivent etre remplies!");

            }
        }else{
            (new vue)->inscription();
        }
    }

    public function connexion($message = null){
        $user = (new User);
        if(isset($_POST["connexion"])){
            if(!empty($_POST['mail']) and !empty($_POST['mdp'])){
                if($user->connexion($_POST['mail'], $_POST['mdp'])){
                    (new vue)->connexion("connexion avec succée");
                    header('Location: index.php?action=recupererUser');
                }else{
                    (new vue)->connexion("login ou mot de passe incorrect!");
                }
            }else{
                (new vue)->connexion("Tout les champs doivent etre remplies!");
            }
        }else{
            (new vue)->connexion();
        }
    }
    public function updatePwd($connexion=null, $message = null){
        $update = (new User);
        if(isset($_POST['update'])){
            if(!empty($_POST['mail']) and !empty($_POST['mdp'])){
                if($_POST['mdp'] == $_POST['cmdp']){
                    $update->updatePwd(sha1($_POST['mdp']), $_POST['mail']);
                    (new vue)->updatePwd("Se Connecter", "Mise à jour avec succée");
                   
                }else{
                    (new vue)->updatePwd("les deux mots de passes ne sont pas identiques");
                }
            }else{
                (new vue)->updatePwd("Tous les champs doivent être remplis");
            }
        }else{
            (new vue)->updatePwd();
        }
    }

    public function deconnexion(){
        if(isset($_SESSION["connexion"])) {
            unset($_SESSION["connexion"]);
        }
        $this->connexion();
    }


}




?>