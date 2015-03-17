<?php

require_once "config.php";

class SQL_Helper {
    /*
    *   Constructor
    *   @params: mysqli - $conn
    *   @return: none
    */
	public function __construct() {
        $this->conn = connectDB();
	}
