<?php
include $_SERVER['DOCUMENT_ROOT'] . '/.env.php';

/**
 * @package DBConnection
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 */

// Database Connection
class DBConnection {
    private $_dbHostname = DB_SERVER;
    private $_dbName = DB_NAME;
    private $_dbUsername = DB_USERNAME;
    private $_dbPassword = DB_PASSWORD;
    private $_con;

    public function __construct() {
    	try {
        	$this->_con = new PDO("mysql:host=$this->_dbHostname;dbname=$this->_dbName", $this->_dbUsername, $this->_dbPassword);
        	$this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}

    }
    // return Connection
    public function returnConnection() {
        return $this->_con;
    }
}
?>
