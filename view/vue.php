<?php
class vue{

    public function erreur404(){
        echo"Oup un erreur est survenue";

    }
    private function entete(){
        echo "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
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

        echo "<form method='post' action=''>";
        echo "
        <h1>Liste des message :</h1>
            <table class=\"table table-striped\">
                <tr>
                    <th>Pseudo</th>
                </tr>
        ";
        if(isset($message)){
            echo $message;
        }
        
        foreach($lesMessage as $ligne)
        {
            echo "
                <tr>
                    <td>".$ligne['message']."</td>
                </tr>
            ";
        }
        echo "</table>";

        echo "</form>";
            $this->fin();
    }



    public function ajoutMessage($lesMessage, $message=null){

        $this->entete();
        if(isset($message)){
            echo"<h4>".$message."</h4>";
        }

        foreach($lesMessage as $ligne)
        {
            echo $ligne['message']."</br>";
        }

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
            <div>
                <label for='name'>Votre Nom</label>
                <input type='text' name='nom' id='nom' value=''/>
            </div>
            <div>
                <label for='prenom'>Votre Prenom</label>
                <input type='text' name='prenom' id='prenom' value='' />
            </div>
            <div>
                <label for='prenom'>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div>
                <label for='prenom'>Votre pseudo</label>
                <input type='text' name='pseudo' id='pseudo' value=''/>
            </div>
            <div>
                <label for='mdp'>Votre mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div>
            <div>
                <label for='cmdp'>Confirmation mot de passe</label>
                <input type='password' name='cmdp' id='cmdp' value='' />
            </div>
            <div>
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
            <div>
                <label for='prenom'>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div>
                <label for='mdp'>Votre mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div>
                <input type='submit' name='connexion' id='connexion' value='connexion' />
            </div>
        </form>
        <a href='index.php?action=inscription'>Créez un compte</a>
        <a href='index.php?action=modifmotdepasse'>Mot de passe ouliez!</a>
        ";
        $this->fin();
    }

}
?>