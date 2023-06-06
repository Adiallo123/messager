<?php
class controller{

    
    function accueil(){
        (new vue)->accueil();
    }

    public function erreur404(){
        (new vue)->erreur404();
    }

    public function recupererMessage(){
        $mess=(new Message);
        $destinataire = $_GET['id'];
        if(isset($_SESSION['connexion'])){
            $mess->recupererMessage($_SESSION['connexion'], $destinataire);
           // (new vue)->recupererMessage($mess);
            (new vue)->ajoutMessage($mess);

        }
    }

    public function ajoutMessage($message = null){
        $mes = (new message);
        $destinataire = $_GET['id'];
        if(isset($_SESSION['connexion'])){
            if(isset($_POST['Envoyer'])){
                $mes->ajoutMessage($_POST['message'], $_SESSION['connexion'], $destinataire);
                $mess=(new Message)->recupererMessage($_SESSION['connexion'], $destinataire);
                (new vue)->ajoutMessage($mess, "envoie avec succée");               
            }else{
                $mess=(new Message)->recupererMessage($_SESSION['connexion'], $destinataire);
                (new vue)->ajoutMessage($mess);
            }
        }else{
            (new vue)->ajoutMessage("pas encore connecter");
        }

    }

    public function recupererUser(){
       //$user = (new User);
        if(isset($_SESSION['connexion'])){
            $user = (new User)->getAllUser($_SESSION['connexion']);
            (new vue)->getAllUser($user);
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
                (new vue)->verifChamp("Tout les champs doivent etre remplies!");

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
                (new vue)->verifChamp("Tout les champs doivent etre remplies!");
            }
        }else{
            (new vue)->connexion();
        }
    }
}



?>