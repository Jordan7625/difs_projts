<?php

class DataJoueurs {

    private $bdd = NULL;

    public function __construct(){
    }

    private function connexionBDD(){
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=plotslumineux', 'adminplots', 'Azerty*123');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getJoueur($id) {
        $reponse = array('statut' => 1, 'message' => 'ok');
    
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
    
        try {
            $sql = 'SELECT * FROM joueurs WHERE id = :id';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT);
            $s->execute();
    
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucun joueur trouvé pour cet ID';
                return $reponse;
            }
    
            $donnees = $s->fetch(PDO::FETCH_ASSOC);
            $reponse['joueur'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
    
        return $reponse;
    }

    public function createJoueur($identifiant, $password, $email) {
        $reponse = array('statut' => 1, 'message' => 'ok');

        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }

        $sql_check = 'SELECT COUNT(*) AS count FROM joueurs WHERE identifiant = :identifiant';
        $stmt_check = $this->bdd->prepare($sql_check);
        $stmt_check->execute(array(':identifiant' => $identifiant));
        $row = $stmt_check->fetch();

        if ($row['count'] > 0) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Identifiant déjà utilisé';
            return $reponse;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO joueurs (identifiant, password, email) VALUES (:identifiant, :password, :email)';
        $stmt = $this->bdd->prepare($sql);

        $res = $stmt->execute(array(':identifiant' => $identifiant, ':password' => $hashed_password, ':email' => $email));

        if ($res === false) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Requête erronée';
            return $reponse;
        } else if ($stmt->rowCount() === 0) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Non ajouté';
            return $reponse;
        }

        $reponse['id'] = intval($this->bdd->lastInsertId());

        return $reponse;
    }

    public function connexionJoueur($identifiant, $password) {
        $reponse = array('statut' => 1, 'message' => 'ok');

        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }

        try {
            $sql = 'SELECT * FROM joueurs WHERE identifiant = :identifiant';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
            $s->execute();

            $donnees = $s->fetch(PDO::FETCH_ASSOC);

            if ($donnees && password_verify($password, $donnees['password'])) {
                unset($donnees['password']);
                $reponse['joueur'] = $donnees;
            } else {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Identifiant ou mot de passe incorrect';
            }
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }

        return $reponse;
    }

    public function identifiantExiste($identifiant) {
        $reponse = array('statut' => 1, 'message' => 'ok');

        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }

        try {
            $sql = 'SELECT COUNT(*) AS count FROM joueurs WHERE identifiant = :identifiant';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
            $s->execute();

            $resultat = $s->fetch(PDO::FETCH_ASSOC);

            if ($resultat['count'] > 0) {
                $reponse['statut'] = 1;
                $reponse['message'] = 'L\'identifiant existe déjà';
            } else {
                $reponse['statut'] = 0;
                $reponse['message'] = 'L\'identifiant n\'existe pas';
            }
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }

        return $reponse;
    }

    public function getStatistiques() {
        $reponse = array('statut' => 1, 'message' => 'ok', 'statistiques' => array());

        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }

        try {
            $sql = 'SELECT * FROM partie';
            $s = $this->bdd->prepare($sql);
            $s->execute();

            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucune statistique disponible';
                return $reponse;
            }

            $donnees = $s->fetchAll(PDO::FETCH_ASSOC);
            $reponse['statistiques'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' .
        }








    public function getStatistiquesUnjoueur($identifiant) {
        // Initialisation de la réponse
        $reponse = array('statut' => 1, 'message' => 'ok', 'statistiques' => array());
        
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
        
        try {
            // Préparation de la requête pour obtenir les statistiques
            $sql = 'SELECT * FROM partie WHERE identifiant = :identifiant';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
            
            // Exécution de la requête
            $s->execute();
        
            // Vérification de l'exécution de la requête
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucune statistique disponible';
                return $reponse;
            }
        
            // Extraction des données
            $donnees = $s->fetchAll(PDO::FETCH_ASSOC);
        
            // Attribution des données à la réponse
            $reponse['statistiques'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
        
        return $reponse;
    }















    public function getUnTour($id) {
        $reponse = array('statut' => 1, 'message' => 'ok');
    
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
    
        try {
            // Préparation de la requête
            $sql = 'SELECT * FROM tour WHERE id = :id';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Exécution de la requête
            $s->execute();
    
            // Vérification de l'exécution de la requête
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucun joueur trouvé pour cet ID';
                return $reponse;
            }
    
            // Extraction des données
            $donnees = $s->fetch(PDO::FETCH_ASSOC);
    
            // Attribution des données à la réponse
            $reponse['tour'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
    
        return $reponse;
    }






    public function getUnePartie($idPartie) {
        $reponse = array('statut' => 1, 'message' => 'ok');
    
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
    
        try {
            // Préparation de la requête
            $sql = 'SELECT * FROM partie WHERE idPartie = :idPartie';
            $s = $this->bdd->prepare($sql);
            $s->bindParam(':idPartie', $idPartie, PDO::PARAM_INT);
            
            // Exécution de la requête
            $s->execute();
    
            // Vérification de l'exécution de la requête
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucun partie trouvé pour cet ID';
                return $reponse;
            }
    
            // Extraction des données
            $donnees = $s->fetch(PDO::FETCH_ASSOC);
    
            // Attribution des données à la réponse
            $reponse['joueur'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
    
        return $reponse;
    }












    public function getTours() {
        // Initialisation de la réponse
        $reponse = array('statut' => 1, 'message' => 'ok', 'statistiques' => array());
        
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
        
        try {
            // Préparation de la requête pour obtenir les statistiques
            $sql = 'SELECT * FROM tour';
            $s = $this->bdd->prepare($sql);
            
            // Exécution de la requête
            $s->execute();
        
            // Vérification de l'exécution de la requête
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucune statistique disponible';
                return $reponse;
            }
        
            // Extraction des données
            $donnees = $s->fetchAll(PDO::FETCH_ASSOC);
        
            // Attribution des données à la réponse
            $reponse['statistiques'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
        
        return $reponse;
    }












    public function getDate() {
        // Initialisation de la réponse
        $reponse = array('statut' => 1, 'message' => 'ok', 'statistiques' => array());
        
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
        
        try {
            // Préparation de la requête pour obtenir les statistiques
            $sql = 'SELECT date FROM partie';
            $s = $this->bdd->prepare($sql);
            
            // Exécution de la requête
            $s->execute();
        
            // Vérification de l'exécution de la requête
            if ($s->rowCount() == 0) {
                $reponse['statut'] = 0;
                $reponse['message'] = 'Aucune date disponible';
                return $reponse;
            }
        
            // Extraction des données
            $donnees = $s->fetchAll(PDO::FETCH_ASSOC);
        
            // Attribution des données à la réponse
            $reponse['statistiques'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
        
        return $reponse;
    }
    














    public function getJoueurs() {
        $reponse = array('statut' => 1, 'message' => 'ok');
    
        // Connexion à la base de données
        if (!$this->connexionBDD()) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'connexion bdd impossible';
            return $reponse;
        }
    
        try {
            // Préparation de la requête
            $sql = 'SELECT * FROM joueurs';
            $s = $this->bdd->prepare($sql);
    
            // Exécution de la requête
            $s->execute();
    
            // Extraction des données
            $donnees = $s->fetchAll(PDO::FETCH_ASSOC);
    
            // Attribution des données à la réponse
            $reponse['joueurs'] = $donnees;
        } catch (PDOException $e) {
            $reponse['statut'] = 0;
            $reponse['message'] = 'Erreur PDO : ' . $e->getMessage();
        }
    
        return $reponse;
    }
    
}





    
    


