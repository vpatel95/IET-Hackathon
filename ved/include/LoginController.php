<?php

    /**
     * Class to handle all db operations
     * This class will have CRUD methods for database tables
     *
     * @author Ved Patel
     */
    class LoginController {

        private $conn;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            // opening db connection
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

        public function login($username, $password) {
            if($stmt = mysqli_prepare($this->conn, "SELECT id FROM user WHERE username=? AND password=?")){
                mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $count = mysqli_stmt_num_rows($stmt);
                mysqli_stmt_close($stmt);
            }

            if($count == 1) {
                return "success";
            } else {
                return $count;
            }
            
        }

        public function signup($username, $password) {
            if($stmt = mysqli_prepare($this->conn, "INSERT INTO user (username, password) VALUES (?,?)")){
                mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if($stmt = mysqli_prepare($this->conn, "INSERT INTO level (username) VALUES (?)")){
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            } else {
                return "signup error";
            }

            return "success";
        }

    }
?>