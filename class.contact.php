<?php

    class Contact {
        private $host = "localhost";
        private $dbName = "test";
        private $dbUser = "root";
        private $dbPass = "";
        public $dbh;
    
        public function __construct() {
            $this->dbh=$this->initDb();
        }

        public function initDb(){
            try{  
                $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
                $this->bd = new PDO($dsn, 'root', ''.$this->dbPass);
                $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->bd;
                 }
                 catch(PDOException $e)
                  {
                    return 0;
                 }  
        }
    
        public function getContacts() {
            $stmt = $this->dbh->prepare("SELECT * FROM contact");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function addContact($prenom, $nom,$telephone,$id_categorie) {
            $stmt = $this->dbh->prepare("INSERT INTO contact (prenom,nom,telephone, id_categorie) VALUES (:prenom,:nom,:telephone,:id_categorie)");
           
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':id_categorie', $id_categorie);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        }
    
        public function updateContact($id, $prenom,$nom,$telephone,$id_categorie) {
            $stmt = $this->dbh->prepare("UPDATE contact SET prenom = ?, nom = ?, telephone=?,id_categorie=? WHERE id = ?");
            $stmt->execute([$id, $prenom,$nom,$telephone,$id_categorie]);
        }

        public function getCategories() {
            $stmt = $this->dbh->prepare("SELECT * FROM categorie");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategorById($id) {
            $stmt = $this->dbh->query("SELECT libelle FROM categorie where id_categorie=$id");
            return $stmt->fetch();
        }
    }
    
?>