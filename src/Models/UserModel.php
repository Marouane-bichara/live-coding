<?php
namespace App\Models;

use App\Classes\Role;
use App\Classes\User;
use App\Config\Database;
use PDO;

class UserModel{
    private $conn;

    public function __construct() {
            $db = new Database();
            $this->conn = $db->connection();
    }

    public function findUserByEmailAndPassword($email, $password){

        session_start();
        $query = "SELECT users.id , users.email , users.password , role.id as role_id , role.title as `role`
        FROM users join role on role.id = users.role_id where users.email = :email and users.password = :password";        
   
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         if(!$row){
         return null;
         }
         else{
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];

            $role = new Role($row["role_id"], $row["role"]);
            return new User($row['id'],$row["email"],$role,$row["password"]);
         }
    }
}