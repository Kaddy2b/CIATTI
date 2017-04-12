<?php //CIATTI

require_once File::build_path(array('Model', 'model.php'));

class ModelEtape extends Model {

    protected static $object = "Etape";
    protected static $primary = "idEtape";
    private $idEtape;
    private $idFleche;
    private $titreEtape;
    private $textEtape;
    private $dateEtape;    

    //getters
    public function getIdEtape() {
        return $this->idEtape;
    }
    public function getIdFlecheEtape() {
        return $this->idFleche;
    }
    public function getTitreEtape() {
        return $this->titreEtape;
    }
    public function getTextEtape() {
        return $this->textEtape;
    }
    public function getDateEtape() {
        return $this->dateEtape;
    }

    //constructeur
    public function __construct($ie = NULL, $if = NULL, $T = NULL, $t = NULL, $d = NULL) {
        if (!is_null($ie) && !is_null($if) && !is_null($T) && !is_null($t) && !is_null($d)) {
            $this->idEtape = $ie;
            $this->idFleche = $if;
            $this->titreEtape = $T;
            $this->textEtape = $t;
            $this->dateEtape = $d;
        }
    }
}
?>