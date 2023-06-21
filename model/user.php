<?php
class User{

    //objet servant à la connexion à la base de donné
    private $pdo;

    //connexion à la base de donné

    public function __construct(){
        $config = parse_ini_file("config.ini");
        try{
            $this->pdo= new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
        }catch(Exception $e){
            echo "<h1>Erreur de connexion à la base de données :</h1>";
            //echo $e->getMessage();
        }
    }

    public function getPseudo($id){
        $sql="SELECT pseudo FROM user WHERE id = :id ";
        $req = $this->pdo->prepare($sql);
        $req->bindPARAM(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $ligne = $req->fetch();
        return $ligne['pseudo'];
    }

    public function getProfil($id){
        $sql="SELECT profil FROM user WHERE id = :id ";
        $req = $this->pdo->prepare($sql);
        $req->bindPARAM(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $ligne = $req->fetch();
    
            if(is_null($ligne['profil'])){
                return false;
            }else{
                return $ligne['profil'];
            }
    }
    public function getProfilDiscusion($id){
        $sql="SELECT profil FROM user WHERE id = :id ";
        $req = $this->pdo->prepare($sql);
        $req->bindPARAM(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $ligne = $req->fetch();
    
            if(is_null($ligne['profil'])){
                return false;
            }else{
                return $ligne['profil'];
            }
    }


    public function getAllUser($id){
        $sql="SELECT * FROM user WHERE id <> :id";
        $req = $this->pdo->prepare($sql);
        $req->bindPARAM(':id', $id, PDO::PARAM_INT);
		$req->execute();
		return $req->fetchAll();

    }

    public function connexion($mail, $mdp){
        $sql="SELECT id, pseudo, mail, `password` FROM user WHERE mail = :mail";
        $req=$this->pdo->prepare($sql);
        $req->bindPARAM(':mail', $mail, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch();
    
        //si l'utilisateur existe
        if($result == true){
            //on verifie si le hassage du mot de passe correspond
            if(sha1($mdp) == $result["password"]){
                //on créer une session
                $_SESSION['connexion'] = $result['id'];
                $_SESSION['pseudo'] = $result['pseudo'];
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function dejasInscrit($mail){
        $sql="SELECT COUNT(*) AS nbUser FROM user WHERE mail = :mail";
        $req=$this->pdo->prepare($sql);
        $req->bindParam(':mail', $mail, PDO::PARAM_STR);
        $req->execute();
        $ligne = $req->fetch();
        

        if($ligne["nbUser"] == 0){
            //pas encore inscrit
            return false;
        }else{
            //dejas inscrit
            return true ;
        }
       
    }

    //inscription utilisateur
    public function inscription($nom, $prenom, $mail, $pseudo, $mdp){

        $sql="INSERT INTO user(nom, prenom, mail, pseudo, password) VALUES (:nom, :prenom, :mail, :pseudo, :mdp);";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindParam(':mail', $mail, PDO::PARAM_STR);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR).
        $req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $req->execute();
    }

    public function updatePwd($password, $mail){
        $sql="UPDATE user SET `password`=:mdp WHERE mail=:mail";

        $req=$this->pdo->prepare($sql);
        $req->bindParam(':mdp', $password, PDO::PARAM_STR);
        $req->bindParam(':mail', $mail, PDO::PARAM_STR);
        $req->execute();
    }

    public function editionProfil($profil, $id){
        $sql="UPDATE user SET profil=:profil WHERE id=:id";

        $req=$this->pdo->prepare($sql);
        $req->bindParam(':profil', $profil, PDO::PARAM_STR);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}

?>