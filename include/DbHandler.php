<?php

    /**
     * Class to handle all db operations
     * This class will have CRUD methods for database tables
     *
     * @author Ved Patel
     */
    class DbHandler {

        private $conn;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            // opening db connection
            $db = new DbConnect();
            $this->conn = $db->connect();
        }

    }
    
?>