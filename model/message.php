<?php

class Message{

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

    public function AjoutMessage($mes, $auteur, $destinataire){
        $sql="INSERT INTO message(`message`, idAuteur, idDestinataire) VALUES (:mes, :idauteur, :iddestinataire)";

        $req = $this->pdo->prepare($sql);
        $req->bindParam(':mes', $mes, PDO::PARAM_STR);
        $req->bindParam(':idauteur', $auteur, PDO::PARAM_STR);
        $req->bindParam(':iddestinataire', $destinataire, PDO::PARAM_STR);
        $req->execute();

    }

    public function recupererMessage($auteur, $destinataire){
        $sql="SELECT `message` FROM message WHERE (idAuteur=:auteur AND idDestinataire=:destinataire)
         OR (idAuteur=:destinataire AND idDestinataire=:auteur)";

        $req=$this->pdo->prepare($sql);
        $req->bindParam(':auteur', $auteur, PDO::PARAM_INT).
        $req->bindParam(':destinataire', $destinataire, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }



}

?>