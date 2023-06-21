<?php
class vue{

    public function erreur404(){
        echo"Oup un erreur est survenue";

    }

    public function navTopDiscusion($lesphotos, $pseudo){
        
        $photo='';    
          if($lesphotos == false){
              $photo = 'profilDefaut.png';
          }else if($lesphotos == true){
              $photo = $lesphotos ;
          }
     echo"
    <div class='nav-top'>
        <div class='location'>
          <a href='index.php?action=recupererUser'><img src='images/retour.jpeg' alt='image'/></a>
        </div>

        <div class='utilisateur'>
            <p> <img  widht='20' height='30' src='images/".$photo."' alt='photo de profil'/></p>
            <p>".$pseudo."</p>
        </div>

        <div class='logos-call'>
            <a href='index.php?action=deconnexion'>Deconnexion</a>
        </div>
    </div>";

  }

    public function navTop($lesphotos){
        
          $photo='';
            if($lesphotos == false){
                $photo = 'profilDefaut.png';
            }else if($lesphotos == true){
                $photo = $lesphotos ;
            }
       echo"
        <div class='nav-top'>

            <div class='location'>
            <a href='index.php?action=connexion'><img src='images/retour.jpeg' alt='image' /></a>
            </div>

            <div class='utilisateur'>
                <p>
                    <a href='index.php?action=profil'>
                        <img  widht='20' height='30' src='images/".$photo."' alt='photo de profil'/>
                    </a>
                </p>
            </div>

            <div class='logos-call'>
                <a href='index.php?action=deconnexion'>Deconnexion</a>
            </div>

        </div>";
    }


    private function entete(){
        echo "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='stylesheet' href='./css/style.css'/>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
                <script src='js/app.js' defer></script>
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

    public function recupererMessage($lesMessage, $lesphoto, $pseudo){
		$this->entete();

            $this->navTopDiscusion($lesphoto, $pseudo);

            if($lesphoto == false){
                $lesphoto = 'profilDefaut.png';
            }
            echo "<div class='conversation'>";
                foreach($lesMessage as $ligne){
                    if($ligne['idDestinataire'] == $_SESSION['connexion'] ){
                        echo"
                            <div class='talk left'>
                                <img src='images/".$lesphoto."' alt=''/>
                                <p>".$ligne['message']."</p>
                            </div>";
                    }elseif($ligne['idDestinataire'] == $_GET['id'] ){
                        echo"
                            <div class='talk right'>
                                <p>".$ligne['message']."</p>
                            </div>";
                    }
                }
            echo'</div>';

        $this->fin();
    }

    public function refresh(){
        $this->entete();

        echo "<div id='rafrechir'></div>";
        $this->fin();
    }


    public function ajoutMessage($lesMessage, $lesphoto, $pseudo, $message=null){
       
        $this->entete();
       /* if(isset($message)){
            echo"<h4>".$message."</h4>";
        }*/
        echo"
        <div class='chat-global'>";

           $this->navTopDiscusion($lesphoto, $pseudo);
        if($lesphoto == false){
                $lesphoto = 'profilDefaut.png';
        }
        $this->recupererMessage($lesMessage, $lesphoto, $pseudo);
   
            echo "<form method='post' action='' name='chat-form' class='chat-form'>
                <div class='container-input-stuffs'>

                    <div class='files-logo-cont'>
                        <img src='' alt='' />
                    </div>

                    <div class='group-inp'>
                        <textarea id='message' name='message' value='' minlength='1' maxlength='1500'></textarea>
                    </div>
                        <button name='Envoyer' id='Envoyer' value='Envoyer' class='submit-msg-btn'> 
                            <img src='images/send.png' weidth='20' height='30'/>
                        </button>
                    </div>
                    <div id='res'> </div>
                </div>
            </form>
        </div>
    </div>";
    $this->fin();
    }




    public function getAllUser($lesUtilisateurs, $lesphoto){
		$this->entete();

    echo" <div class='chat-global'> ";
   
        $this->navTop($lesphoto);
        echo "
        <h1>Liste d'amis:</h1>";

        echo "<form method='post' action='index.php?action=ajoutMessage'>";

        if(isset($message)){
            echo $message;
        }
        echo "<div class='conversation'>";
        foreach($lesUtilisateurs as $ligne)
        {
            if(is_null($ligne['profil'])){
                $photo = 'profilDefaut.png';
            }else{
                $photo = $ligne['profil'];
            }
            echo "
                <div class='talk user'>
                    <a href='index.php?id=".$ligne['id']."'>
                        <img  src='images/".$photo."' alt='photo' />
                    </a>
                    <p>
                        <a href='index.php?id=".$ligne['id']."'>".$ligne['pseudo']."</a>
                    </p>
                </div>";
        }
        echo "
        </div>
        </form>
        </div>";
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
        <form method='post' action='index.php?action=inscription' class='authentification'>
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

    public function editionProfil($retour = null, $message = null){
        $this->entete();
        echo "
        <form method='post' action='index.php?action=profil' enctype='multipart/form-data' class='authentification'>
        <h2>Mettre à jour votre photo de profil</h2>
        </br>";

        if(isset($message))
        {
            echo "<h2 class='alert'>".$message."</h2>";
        }

        echo"
            <div class='input'>
                <label for=''>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div class='input'>
                <label for='mdp'>Votre mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div>
            <div class='input'>
                <input type='file' name='photo'/>
                <p>Choisir une photo de profil</p>
            </div>
            <div class='btn'>
                <input type='submit' name='profil' id='profil' value='M à J Profil'/>
            </div> 
            <p class='annonce'>
                <a href='index.php?action=recupererUser'>Revenir à ma liste d'amie!</a>
            </p>
        </form>
        ";
        $this->fin();
    }

    public function connexion($message = null){
        $this->entete();

        echo "
        <form method='post' action='index.php?action=connexion' class='authentification' >
        <h2>Veuillez vous connectez sur votre compte!</h2>
        </br>";

        if(isset($message))
        {
            echo "<h2 class='alert'>".$message."</h2>";
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
                <input type='submit' name='connexion' id='connexion' value='connexion' /> <a href='index.php?action=updatePwd'>Mot de passe ouliez?</a>
            </div>
            <p class='annonce'>
                <a href='index.php?action=inscription'>Créez un compte!</a>
            </p>
        </form>
        ";
        $this->fin();
    }
    public function retourConnexion(){
        $this->entete();

        echo '<a href="index.php?action=connexion">Se connecter</a>';

        $this->fin();
    }

    public function updatePwd($connexion = null, $message = null){
        $this->entete();

        echo "
        <form method='post' action='index.php?action=updatePwd' class='authentification'>
        <h2>Mettre à jour votre mot de passe !</h2>
        </br>";

        if(isset($message))
        {
            echo "<h2 class='alert'>".$message."</h2>";
        }

        echo"
            <div class='input'>
                <label for=''>Votre Mail</label>
                <input type='mail' name='mail' id='mail' value=''/>
            </div>
            <div class='input'>
                <label for='mdp'>Nouveau mot de passe</label>
                <input type='password' name='mdp' id='mdp' value=''/>
            </div>
            <div class='input'>
                <label for='cmdp'>Confirmer votre mot de passe</label>
                <input type='password' name='cmdp' id='cmdp' value=''/>
            </div>
            <div class='btn'>
                <input type='submit' name='update' id='update' value='Metttre à jour'/>
            </div> <p class='annonce'>";
            
            if(isset($connexion))
            {
                echo '<a href="index.php?action=connexion">'.$connexion.'</a>';
            }
        echo" </p> </form>
        ";
        $this->fin();
    }

}
?>