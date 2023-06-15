<?php
include_once "Productos.php";
include_once "Login.php";
include_once "app/config/configDB.php";


/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_productos    = null;
    private $consultaPorId = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE;
            $this->dbh = new PDO($dsn, DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
       //Muestra todos los productos
        $this->consulta = $this->dbh->prepare("SELECT * FROM productos");
        //Ver detalles
        $this->consultaPorId = $this->dbh->prepare("SELECT * FROM productos where id = :id LIMIT 1");

    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un usuario o null
    public function getProductos ():array {
        $tablaP = [];
        $this->consulta->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        if($this->consulta->execute())
        {
            $tablaP = $this->consulta->fetchAll();
        }

        return $tablaP;

    }

    public function getProductoPorId (int $id) {
       
        $this->consultaPorId->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        $this->consultaPorId->bindParam(':id', $id);
        if ( $this->consultaPorId->execute() ){
            if ( $obj = $this->consultaPorId->fetch()){
               $prod = $obj;
           }
       }
       return $prod;
    }



     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
