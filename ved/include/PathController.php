<?php

    /**
     * Class to handle all db operations
     * This class will have CRUD methods for database tables
     *
     * @author Ved Patel
     */
    class PathController {

        private $conn;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            // opening db connection
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

        public function updatePath($level, $path, $status) {
            if(isPathExist($path)) {
                if($stmt = mysqli_prepare($conn, "UPDATE path SET priority = ?")){
                    if($status == '1')
                        $newPriority = getPriority($path)-1;
                    else 
                        $newPriority = getPriority($path)+1;
                    mysqli_stmt_bind_param($stmt, 'i', $newPriority);
                    mysqli_stmt_execute($stmt);
                }
            } elseif (!isPathExist($path)) {
                if($stmt = mysqli_prepare($conn, "INSERT INTO path (level, path) VALUES (?, ?)")) {
                    mysqli_stmt_bind_param($stmt, 'is', $level, $path);
                    mysqli_stmt_execute($stmt);
                }
                if($status == '1'){
                    $newPriority = getPriority($path)-1;
                    if($stmt = mysqli_prepare($conn, "UPDATE path SET priority = ?")){
                        mysqli_stmt_bind_param($stmt, 'i', $newPriority);
                        mysqli_stmt_execute($stmt);
                    }
                } elseif ($status == '-1') {
                    $newPriority = getPriority($path)+1;
                    if($stmt = mysqli_prepare($conn, "UPDATE path SET priority = ?")){
                        mysqli_stmt_bind_param($stmt, 'i', $newPriority);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }
        }

        private isPathExist($path) {
            if($stmt = mysqli_prepare($conn, "SELECT priority FROM path WHERE path = ?")) {
                mysqli_stmt_bind_param($stmt, 's', $path);
                mysqli_stmt_execute($stmt);
                $count = mysqli_stmt_num_rows($stmt);
                if($count > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return "isPathExist Error";
            }
        }

        private getPriority($path) {
            if($stmt = mysqli_prepare($conn, "SELECT priority FROM path WHERE path = ?")){
                mysqli_stmt_bind_param($stmt, 's', $path);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $priority);
                mysqli_stmt_fetch($stmt);
            } else {
                return "getPriority Error";
            }

            return $priority;
        }

    }
?>