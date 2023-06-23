<?php
include "Productos.php";
include "Login.php";
include "app/config/configDB.php";
include "Pedidos.php";


/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $consulta    = null;
    private $consultaPorId = null;
    private $consultaPorCategory = null;
    
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
      //º  $this->consulta = $this->dbh->prepare("SELECT * FROM productos");
        //Ver detalles
        $this->consultaPorId = $this->dbh->prepare("SELECT * FROM productos where id = :id LIMIT 1");
        $this->consultaPorCategory = $this->dbh->prepare("SELECT * FROM productos where category = :category");


    
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
    public function getProductos($categoria): array {
        // Parámetro de categoría
        $condiciones = array();
    
        if (!empty($categoria)) {
            $condiciones[] = "category = :categoria";
        }
    
        // Construir la consulta SQL
        $query = "SELECT * FROM productos";
    
        if (!empty($condiciones)) {
            $query .= " WHERE " . implode(" AND ", $condiciones);
        }
    
        $this->consulta = $this->dbh->prepare($query);
    
        // Vincular parámetros si es necesario
        if (!empty($categoria)) {
            $this->consulta->bindParam(':categoria', $categoria);
        }
    
        // Resto del código sin cambios
        $tablaP = [];
        $this->consulta->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        if ($this->consulta->execute()) {
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

    public function getProductoPorCategory(string $category) {
        $tablaP = [];
        $this->consultaPorCategory->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        $this->consultaPorCategory->bindParam(':category', $category);

        if ( $this->consultaPorCategory->execute())
        {
            $tablaP = $this->consultaPorCategory->fetchAll();
        }


       return $tablaP;
    }




     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
