<?php

require_once File::build_path(array('Model', 'modelEtape.php'));

class ControllerEtape {

    public static function read($idEtape) {
        $id = $idEtape;
        $r = ModelEtape::select($id);
        return $r;
    }

    public static function updated() {
    	// tab des nouvelles données.
    	$data = array(
        	"idEtape" => $_GET["idEtape"],
    		"idFleche" => $_GET["idFleche"],
            "titreEtape" => $_POST["titreEtape"],
            "textEtape" => $_POST["textEtape"],
            "dateEtape" => $_POST["dateEtape"]
        );
        $up = ModelEtape::update($data);
        if ($up == false) {
            echo"Echec de mise à jour...";
        } else {
            //echo "Modification prise en compte.";
        }
        ControllerFleche::refresh();
    }

    public static function created() {
        $today = date("Y-m-d");
        $data = array('idFleche' => $_GET["idFleche"],
                      'dateEtape' => $today );
        $r = ModelEtape::save($data);
        if ($r == false) {
            echo"Impossible de créer l'étape.";
        } else {
            //echo "Création réussie";
        }
        ControllerFleche::refresh($_GET["idFleche"]);
    }

    public static function deleted() {
        $idEtape = $_GET['idEtape'];
        $r = ModelEtape::delete($idEtape);
        if ($r == false) {
            echo "Impossible de supprimer l'étape.";
        } else {
            //echo "Suppression réussie";
        }
        ControllerFleche::refresh(null);
    }

    public static function mailEtape() {
        $etape = self::read($_GET['idEtape']);
        $to = "gabriel@yopmail.com";
        $subject = $etape->getTitreEtape();
        $txt = $etape->getTextEtape();
        $headers = "From: CIATTI" . "\r\n";
        mail($to,$subject,$txt,$headers);
        ControllerFleche::refresh();
    }
}
?>