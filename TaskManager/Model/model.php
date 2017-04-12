<?php //CIATTI

require_once File::build_path(array('Config', 'conf.php'));

class Model {

    static public $pdo;
    static private $hostname;
    static private $database_name;
    static private $login;
    static private $password;

    static public function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
    }

    public static function select($primary_value) {
        // Préparation de la requête
        $table_name = static::$object;
        $class_name = "Model" . ucfirst(static::$object);
        $primary_key = static::$primary;
        $sql = "SELECT * FROM $table_name WHERE $primary_key=:id_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("id_tag" => $primary_value);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        if (empty($tab)) {
            return false;
        }
        return $tab[0];
    }

    public static function selectAll() {
        try {
            $table_name = static::$object;
            $class_name = "Model" . ucfirst($table_name);
            $sql = "SELECT * FROM $table_name";
            //Organiser les etapes dans l'ordre chronologique.
            if ($table_name == "Etape") {
                $sql = $sql . " ORDER BY dateEtape";
            }
            $req_prep = Model::$pdo->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            return $tab;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function selectByCategorie($categorie) {
        try {
            $table_name = static::$object;
            $class_name = "Model" . ucfirst($table_name);
            $cat = ucfirst($categorie);
            $param = "typeFleche";
            //On trie les fleches par catégorie (type).
            $sql = "SELECT * FROM $table_name WHERE $param = :val_cat";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array('val_cat' => $cat);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            return $tab;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function selectByResearch($value) {
        try {
            $table_name = static::$object;
            $class_name = "Model" . ucfirst($table_name);

            $sql = "SELECT * FROM $table_name WHERE textFleche LIKE :val OR nomFleche LIKE :val";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array('val' => '%'.$value.'%');
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            return $tab;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function selectMatch($val1, $val2) {
        try {
            $table_name = static::$object;
            $class_name = "Model" . ucfirst($table_name);

            $sql = "SELECT * FROM $table_name WHERE textFleche LIKE :val1 AND textFleche LIKE :val2";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                'val1' => '%'.$val1.'%',
                'val2' => '%'.$val2.'%'
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            return $tab;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function update($data) {
        try {
            $primary_key = static::$primary;
            $table_name = static::$object;
            $sql = "UPDATE $table_name SET ";
            foreach ($data as $clef => $valeur) {
               $sql = $sql . $clef . "=:$clef,";
            }
            $sql = rtrim($sql, ',');
            $sql = $sql . " WHERE $primary_key=:$primary_key;";
            //var_dump($sql);
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);  
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function save($data) {
        try {
            $table_name = static::$object;
            $class_name = "Model" . ucfirst($table_name);
            $sql = "INSERT INTO $table_name (";
            foreach ($data as $cle => $valeur) {
                $sql = $sql . $cle . ",";
            }
            $sql = rtrim($sql, ',');
            $sql = $sql . ") VALUES(";
            foreach ($data as $cle => $valeur) {
                $sql = $sql . ":" . $cle . ",";
            }
            $sql = rtrim($sql, ',');
            $sql = $sql . ");";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }//jusque la ok

    public static function delete($primary_value) {
        try{
            $primary_key = static::$primary;
            $table_name = static::$object;
            $sql = "DELETE FROM $table_name WHERE $primary_key = :id";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array("id" => $primary_value);
            $req_prep->execute($values);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

Model::Init();
?>
