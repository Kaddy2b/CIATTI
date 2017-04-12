<?php

require_once File::build_path(array('Model', 'model.php'));

class ModelFleche extends Model {

    protected static $object = "Fleche";
    protected static $primary = "idFleche";
    private $idFleche;
    private $typeFleche;
    private $nomFleche;
    private $dateFleche;
    private $mailFleche;
    private $textFleche;    

    //getters
    public function getIdFleche() {
        return $this->idFleche;
    }
    public function getTypeFleche() {
        return $this->typeFleche;
    }
    public function getNomFleche() {
        return $this->nomFleche;
    }
    public function getDateFleche() {
        return $this->dateFleche;
    }
    public function getMailFleche() {
        return $this->mailFleche;
    }
    public function getTextFleche() {
        return $this->textFleche;
    }

    //constructeur
    public function __construct($i = NULL, $T = NULL, $n = NULL, $d = NULL, $m = NULL, $t = NULL) {
        if (!is_null($i) && !is_null($T) && !is_null($n) && !is_null($d) && !is_null($m) && !is_null($t)) {
            $this->idFleche = $i;
            $this->typeFleche = $T;
            $this->nomFleche = $n;
            $this->dateFleche = $d;
            $this->mailFleche = $m;
            $this->textFleche = $t;
        }
    }
}
?>