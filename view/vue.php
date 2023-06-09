<?php
class vue{

    public function erreur404(){
        echo"Oup un erreur est survenue";

    }

    public function debutNavTop(){



       echo" 
        <div class='nav-top'>

                    <div class='location'>
                        <img src='./images/left-chevron.svg' alt='image' />
                        <p>Back</p>
                    </div>

                    <div class='utilisateur'>
                        <p>John Doe</p>
                        <p>Active now</p>
                    </div>

                    <div class='logos-call'>

                        <svg xmlns='http://www.w3.org/2000/svg' height='48' viewBox='0 -960 960 960' width='48'>
                        <path d='M795-120q-122 0-242.5-60T336-336q-96-96-156-216.5T120-795q0-19.286 12.857-32.143T165-840h140q13.611 0 24.306 9.5Q340-821 343-805l27 126q2 14-.5 25.5T359-634L259-533q56 93 125.5 162T542-254l95-98q10-11 23-15.5t26-1.5l119 26q15.312 3.375 25.156 15.188Q840-316 840-300v135q0 19.286-12.857 32.143T795-120ZM229-588l81-82-23-110H180q0 39 12 85.5T229-588Zm369 363q41 19 89 31t93 14v-107l-103-21-79 83ZM229-588Zm369 363Z'/>
                        </svg>

                        <svg xmlns='http://www.w3.org/2000/svg' height='48' viewBox='0 -960 960 960' width='48'>
                        <path d='M140-160q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h520q24 0 42 18t18 42v215l160-160v410L720-435v215q0 24-18 42t-42 18H140Zm0-60h520v-520H140v520Zm0 0v-520 520Z'/>
                        </svg>
                        
                    </div>

                </div>";

    }

    public function finNavTop(){
        
    }

    public function debutChatGlobal(){
      
    }

    public function finChatGlobal(){

    }

    private function entete(){
        echo "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='stylesheet' href='./css/style.css'/>
                <title>Messenger</title>
            </head>
            <body>
        ";
    }
    private function fin(){
        echo "
			</body>
			</html>
		";
    }

    public function recupererMessage($lesMessage){
		$this->entete();

      /*  echo "<form method='post' action=''>";
        echo "
        <h1>Liste des message :</h1>
            <table class=\"table table-striped\">
                <tr>
                    <th>Pseudo</th>
                </tr>
        ";*/
        $this->debutNavTop();

        echo"
        <div class='chat-global'>

            <div class='conversation'>";

                foreach($lesMessage as $ligne){
                    if($ligne['idDestinataire'] == $_SESSION['connexion'] ){

                        echo"
                            <div class='talk-left'>
                                <img src='./images/profil.jpg' alt='profil'/>
                                <p> auteur".$ligne['message']."</p>
                            </div>";
                    }elseif($ligne['idDestinataire'] == $_GET['id'] ){
                        echo"
                            <div class='talk-right'>
                                <img src='./images/profil.jpg' alt='profil'/>
                                <p> destinataire".$ligne['message']."</p>
                            </div>";
                    }
                }
        echo"
            </div>
        </div>";


      /*  if(isset($message)){
            echo $message;
        }
        
        foreach($lesMessage as $ligne)
        {
            echo "
                <tr>
                    <td>".$ligne['message']."</td>
                </tr>
            ";
        }*/
      /*  echo "</table>";

        echo "</form>";*/
        $this->fin();
    }



    public function ajoutMessage($lesMessage, $message=null){

        $this->entete();

        if(isset($message)){
            echo"<h4>".$message."</h4>";
        }

        echo"
        <div class='chat-global'>

            <div class='conversation'>";

                foreach($lesMessage as $ligne){
                    if($ligne['idDestinataire'] == $_SESSION['connexion'] ){

                        echo"
                            <div class='talk-left'>
                                <img src='./images/profil.jpg' alt='profil'/>
                                <p>".$ligne['message']."</p>
                            </div>";
                    }elseif($ligne['idDestinataire'] == $_GET['id'] ){
                        echo"
                            <div class='talk-right'>
                                <img src='./images/profil.jpg' alt='profil'/>
                                <p>".$ligne['message']."</p>
                            </div>";
                    }
                }
        echo"
            </div>
        </div>";

        echo "<form method='post' action=''>
            <div>
                <textarea id='message' name='message' value=''></textarea>
            </div>
                <input type='submit' name='Envoyer' id='Envoyer' value='Envoyer' />
            </div>
        </form>
        ";
        $this->fin();
    }




    public function getAllUser($lesUtilisateurs){
		$this->entete();

        
        echo "<form method='post' action='index.php?action=ajoutMessage'>";
        echo "
        <h1>Liste des utilisateurs :</h1>
            <table class=\"table table-striped\">
                <tr>
                    <th>Pseudo</th>
                </tr>
        ";
        if(isset($message)){
            echo $message;
        }
        
        foreach($lesUtilisateurs as $ligne)
        {
            echo "
                <tr>
                    <td><a href='index.php?id=".$ligne['id']."'>".$ligne['pseudo']."</a></td>
                </tr>
            ";
        }
        echo "</table>";

        echo "</form>";
            $this->fin();
    }


    public function accueil() {
		$this->entete();

		echo "
			<h1>Messenger!</h1>
		";
		$this->fin();
	}

    public function verifChamp($message=null){
        $this->entete();
        if(isset($message)){
            echo"<h4>".$message."</h4>";
        }
        $this->fin();
    }

    public function dejasIncrit($message=null){
        $this->entete();
        if(isset($message)){
            echo"<h4>".$message."</h4>";
            echo "<a href='index.php?action=connexion'>Se Connecté</a>";
        }
        $this->fin();
    }

    public function inscription($message = null){
        $this->entete();

        echo "
        <form method='post' action='index.php?action=inscription'>
        <h2>Veuillez vous inscrire!</h2>
        </br>";

        if(isset($message))
        {
            echo "<h2>".$message."</h2>";
            echo "<a href='index.php?action=connexion'>Se connecter</a>";
        }

        echo"
            <div class='input'>
                <label for='name'>Votre Nom</label>
                <input type='text' name='nom' id='nom' value=''/>
            </div>
            <div class='input'>
                <label for='prenom'>Votre Prenom</label>
                <input type='text' name='prenom' id='prenom' value='' />
            </div>
            <div class='input'>
                <label for=''>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div class='input'>
                <label for='' >Votre pseudo</label>
                <input type='text' name='pseudo' id='pseudo' value=''/>
            </div>
            <div class='input'>
                <label for='mdp' >Votre mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div>
            <div class='input'>
                <label for='cmdp' >Confirmation mot de passe</label>
                <input type='password' name='cmdp' id='cmdp' value='' />
            </div>
            <div class='btn'>
                <input type='submit' name='inscrire' id='inscrire' value='inscrire' />
            </div>
        </form>
        ";
        $this->fin();
    }

    public function connexion($message = null){
        $this->entete();

        echo "
        <form method='post' action='index.php?action=connexion'>
        <h2>Veuillez vous connectez sur votre compte!</h2>
        </br>";

        if(isset($message))
        {
            echo "<h2>".$message."</h2>";
        }

        echo"
            <div class='input'>
                <label for=''>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div class='input'>
                <label for='mdp'>Votre mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div class='btn' >
                <input type='submit' name='connexion' id='connexion' value='connexion' />
            </div>
            <p class='annonce'>
                <a href='index.php?action=inscription'>Créez un compte!</a>
                <a href='index.php?action=modifmotdepasse'>Mot de passe ouliez!</a>
            </p>
        </form>
        ";
        $this->fin();
    }

}
?>