<?php

require_once File::build_path(array('Model', 'modelFleche.php'));

class ControllerFleche {

    /*************
    **** CRUD ****
    *************/

    public static function created() {
        //tab des données créées.
        $data = array("typeFleche" => $_POST["typeFleche"],
                      "nomFleche" => $_POST["nomFleche"],
                      "dateFleche" => $_POST["dateFleche"],
                      "textFleche" => $_POST["textFleche"],
                      "mailFleche" => $_POST["mailFleche"] );
        //Sauvegarde de la fleche.
        $r = ModelFleche::save($data);
        if ($r == false) {
            echo"Impossible de créer l'etape.";
        } else {
            //echo "Création réussie";
        }
        self::refresh();
    }

    public static function read($idFleche) {
        $id = $idFleche;
        $r = ModelFleche::select($id);
        return $r;
    }

	public static function readAll() {
        $page_title = "CIATTI";
        $tab_fleche = ModelFleche::selectAll();
        $tab_etape = ModelEtape::selectAll();
        $view = "listFleche";
        require File::build_path(array('View', 'view.php'));
	}

    public static function updated() {
        // tab des nouvelles données.
        $data = array(
            "idFleche" => $_GET["idFleche"],
            "typeFleche" => $_POST["typeFleche"],
            "nomFleche" => $_POST["nomFleche"],
            "dateFleche" => $_POST["dateFleche"],
            "textFleche" => $_POST["textFleche"],
            "mailFleche" => $_POST["mailFleche"]
        );
        $up = ModelFleche::update($data);
        if ($up == false) {
            echo"Echec de mise à jour...";
        } else {
            //echo "Modification prise en compte.";
        }
        self::refresh();
    }

    public static function deleted() {
        $idFleche = $_GET['idFleche'];
        $r = ModelFleche::delete($idFleche);
        if ($r == false) {
            echo "Impossible de supprimer la fléche.";
        } else {
            //echo "Suppression réussie";
        }
        self::refresh();
    }

    /******************
    **** FUNCTIONS ****
    ******************/

    //Afficher seulement les fleches d'un type donné.
    public static function readByType() {
        //On recupere la valeur de l'affichage.
        //(Acheteurs ou Fournisseurs)
        if (isset($_GET['categorie'])) {
            $categorie = ucfirst($_GET['categorie']);
            $page_title = $categorie;
        } else {
            $page_title = "Error";
            echo "impossible de selectionner le type";
        }
        //On recupere toutes les fleches du type voulu.
        $tab_fleche = ModelFleche::selectByCategorie($categorie);
        $tab_etape = ModelEtape::selectAll();
        //view
        $view = "listFleche";
        require File::build_path(array('View', 'view.php'));
    }

    //Redirige la page apres une action
    //pour éviter de répéter cette action
    //au rafraichissement(F5) de la page.
    public static function refresh($id) {
        //Pour rediriger vers une étape crée
        //avec created de Etape.
        if (isset($id)) {
            $ancre = '#ancre' . $id; 
        }
        //Pour rediriger vers la page
        //correspondante apres une action.
        //(Acheteurs ou Fournisseurs)
        if (isset($_GET['categorie'])) {
            $page_title = ucfirst($_GET['categorie']);
        } else { 
            $page_title = "CIATTI";
        }
        //view
        $view = "refresh";
        require File::build_path(array('View', 'view.php'));
    }

    //Affiche le panel.
    public static function readAllPanel() {
        $tab = ModelFleche::SelectAll();
        //view
        $page_title = "Panel - All";
        $view = "panel";
        require File::build_path(array('View', 'view.php'));
    }

    public static function readByTypePanel() {
        //On recupere la valeur de l'affichage.
        //(Acheteurs ou Fournisseurs)
        if (isset($_GET['categorie'])) {
            $categorie = ucfirst($_GET['categorie']);
            $page_title = "Panel - " . $categorie;
        } else {
            $page_title = "Error";
            echo "impossible de selectionner le type";
        }
        //On recupere toutes les fleches du type voulu.
        $tab = ModelFleche::selectByCategorie($categorie);
        //view
        $view = "panel";
        require File::build_path(array('View', 'view.php'));
    }

    //Rechercher des OPP via leur texte.
    public static function search() {
        //Récuperer la recherche de l'user.
        $value = $_POST["research"];
        $tab = ModelFleche::selectByResearch($value);
        //view
        $page_title = "Panel";
        $view = "panel";
        require File::build_path(array('View', 'view.php'));
    }

    public static function matching() {
        $match = array();

        //On cherche une similitude entre l'offre
        //d'un fournisseurs et la demande d'un client.
        $tab_ach = ModelFleche::selectByCategorie("Acheteurs");
        $tab_fns = ModelFleche::selectByCategorie("Fournisseurs");
        foreach ($tab_ach as $key_ach => $value_ach) {
            $v_idFleche_ach = htmlspecialchars($value_ach->getIdFleche());
            $v_textFleche_ach = htmlspecialchars($value_ach->getTextFleche());
            foreach ($tab_fns as $key_fns => $value_fns) {
                $v_idFleche_fns = htmlspecialchars($value_fns->getIdFleche());
                $v_textFleche_fns = htmlspecialchars($value_fns->getTextFleche());
                $r = ModelFleche::selectMatch($v_textFleche_ach, $v_textFleche_fns);
                if ($r != null) {
                    array_push($match, self::read($v_idFleche_ach));
                    array_push($match, self::read($v_idFleche_fns));
                }
            }
        }
        //view
        $tab = $match;
        $page_title = "Panel - Matching !";
        $view = "panel";
        require File::build_path(array('View', 'view.php'));
    }
}
?>