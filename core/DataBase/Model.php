<?php

namespace core\DataBase;

use Exception;
use PDO;
use PDOException;

abstract class Model {

    protected $conn;
    protected $sql;
    protected $table;
//* https://www.php.net/manual/en/book.pdo.php

    public function __construct() {
        {
            global $configApp;
            $servername  =  $configApp['database']['host'];
            $username    =  $configApp['database']['username'];
            $password    =  $configApp['database']['password'];
            $db          =  $configApp['database']['database'];
    
            try {
            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            return $this->conn=$conn;
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function all()
    {
        try{
            $this->sql='SELECT * FROM '.$this->table;

            $stmt = $this->conn->query($this->sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            echo '</br> SQL : '.$this->sql;
        }
    }

    public function where(array $execute)
    {
        $this->sql='SELECT * FROM '.$this->table.' WHERE ';

        foreach ($execute as $key => $value) {
            $this->sql.=$key.'=\''.$value.'\'';
        }

        try{
            $stmt = $this->conn->query($this->sql);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            echo '</br> SQL : '.$this->sql;
        }
    }

    public function insert(array $data)
    {
        // $this->sql='SELECT * FROM users WHERE email = :email AND status=:status';
        $col="";
        $val="";
        foreach ($data as $key => $value) {
            $col.=",`".$key."`";
            $val.=",'".$value."'";
        }

        $this->sql="INSERT INTO ".$this->table." (`id` ".$col.") VALUES (null ".$val.")";

        try{
            $this->conn->query($this->sql);

            return $this;
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            echo '</br> SQL : '.$this->sql;
        }
    }

    public function update(array $where,$key,$value)
    {
        $col="";
        $val="";
        $col.="`".$key."`";
        $val.="'".$value."'";

        $this->sql="UPDATE `".$this->table."` SET  $col=$val WHERE ".$where[0]."='".$where[1]."'";
        // return $this->sql;
        try{
            $this->conn->query($this->sql);

            return $this;
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            echo '</br> SQL : '.$this->sql;
        }
    }

    public function delete($key,$value)
    {

        $this->sql="DELETE FROM ".$this->table." WHERE $key='$value'";
        // return $this->sql;
        try{
            $this->conn->query($this->sql);

            return $this;
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            echo '</br> SQL : '.$this->sql;
        }
    }
    
    // $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND status=:status');
    // $stmt->execute(['email' => $email, 'status' => $status]);
    // $user = $stmt->fetch();
}