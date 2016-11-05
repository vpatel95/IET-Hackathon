<?php

    /**
     * Class to handle all db operations
     * This class will have CRUD methods for database tables
     *
     * @author Ved Patel
     */
    class LevelController {

        private $conn;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            // opening db connection
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

        public function getLevel($username) {
            if($stmt = mysqli_prepare($conn, "SELECT level FROM level WHERE username=?")) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $level)
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            }else {
                return "Select Level Failed";
            }

            return $level;
        }

        public function updateLevel($username) {
            $level = getLevel($username);
            $level = $level+1;
            if($stmt = mysqli_prepare($conn, "UPDATE level SET level=? WHERE username=?")){
                mysqli_stmt_bind_param($stmt, 'is', $level, $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                return "Level Update Error";
            }
            return "Success";
        }

    }
?>