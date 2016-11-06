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
        
        private function isPathExist($path) {
            if($stmt = mysqli_prepare($this->conn, "SELECT id FROM path WHERE path = ?")) {
                mysqli_stmt_bind_param($stmt, 's', $path);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $count = mysqli_stmt_num_rows($stmt);
                mysqli_stmt_close($stmt);
                if($count > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return "isPathExist Error";
            }
        }

        private function getPriority($path) {
            if($stmt = mysqli_prepare($this->conn, "SELECT priority FROM path WHERE path = ?")){
                mysqli_stmt_bind_param($stmt, 's', $path);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $priority);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            } else {
                return "getPriority Error";
            }

            return $priority;
        }

        private function getPath($level) {
            if($this->checkPathAvail($level)) {
                $maxPriority = $this->getMaxPriority($level);
                if($stmt = mysqli_prepare($this->conn, "SELECT path FROM path WHERE priority = ? AND level = ?")) {
                    $newLevel = $level+1;
                    mysqli_stmt_bind_param($stmt, 'ii', $maxPriority, $newLevel);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $nextPath);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);

                    $reducedPriority = $maxPriority-1;
                    if($stmt = mysqli_prepare($this->conn, "UPDATE path SET priority = ? WHERE path = ?")){
                        mysqli_stmt_bind_param($stmt, 'is', $reducedPriority, $nextPath);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    return "getPath Error";
                }

                return $nextPath;
            } else {
                return "nopath";
            }
        }

        private function getMaxPriority($level) {
            if($stmt = mysqli_prepare($this->conn, "SELECT max(priority) as max FROM path WHERE level = ?")) {
                $newLevel = $level+1;
                mysqli_stmt_bind_param($stmt, 'i', $newLevel);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $max);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            } else {
                return "Path Avail Error";
            }

            return $max;
        }

        private function checkPathAvail($level) {
            if($stmt = mysqli_prepare($this->conn, "SELECT max(priority) as max FROM path WHERE level = ?")) {
                $newLevel = $level+1;
                mysqli_stmt_bind_param($stmt, 'i', $newLevel);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $max);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            } else {
                return "Path Avail Error";
            }

            if($max >= 0) {
                return true;
            } else {
                return false;
            }
        }
        
        public function updatePath($level, $path, $status) {
            if($this->isPathExist($path)) {
                if($stmt = mysqli_prepare($this->conn, "UPDATE path SET priority = ? WHERE path = ?")){
                    if($status == '1')
                        $newPriority = $this->getPriority($path)-1;
                    else 
                        $newPriority = $this->getPriority($path)+1;
                    mysqli_stmt_bind_param($stmt, 'is', $newPriority, $path);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    return $this->getPath($level);
                }
                
            } else {
                if($stmt = mysqli_prepare($this->conn, "INSERT INTO path (level, path) VALUES (?, ?)")) {
                    mysqli_stmt_bind_param($stmt, 'is', $level, $path);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                if($status == '1'){
                    $newPriority = $this->getPriority($path)-1;
                    if($stmt = mysqli_prepare($this->conn, "UPDATE path SET priority = ? WHERE path = ?")){
                        mysqli_stmt_bind_param($stmt, 'is', $newPriority, $path);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                    return $this->getPath($level);
                } elseif ($status == '-1') {
                    $newPriority = $this->getPriority($path)+1;
                    if($stmt = mysqli_prepare($this->conn, "UPDATE path SET priority = ? WHERE path = ?")){
                        mysqli_stmt_bind_param($stmt, 'is', $newPriority, $path);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                    return $this->getPath($level);
                } 
            }
        }

        public function updateOfflinePath($level, $path, $priority) {
            if($this->isPathExist($path)) {
                if($stmt = mysqli_prepare($this->conn, "UPDATE path SET priority = ? WHERE path = ?")){
                    mysqli_stmt_bind_param($stmt, 'is', $priority, $path);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    return $this->getPath($level);
                } else {
                    return "updateOfflinePath Error";
                }
                
            } else {
                if($stmt = mysqli_prepare($this->conn, "INSERT INTO path (level, path, priority) VALUES (?, ?, ?)")) {
                    mysqli_stmt_bind_param($stmt, 'isi', $level, $path, $priority);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    return "insertOfflinePath Error";
                }
            }

            return "success";
        }

    }
?>