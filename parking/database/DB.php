<?php
namespace Parking\Database;

// require_once("/pl/inc/include.php");



/**
 * @class DB
 *
 * This class represents a database connection and should be used to query the DB. This should be a singleton, 
 * and reuse a connection if already initiated
 */
class DB {



	/**
	 * @var $connection The connection initiated with the database
	 */
	private $connection;



	/**
	 * Default constructor
	 *
	 * Initialize connection object
	 */
	private function __construct(){
		$this->connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB);
		if (!$this->connection){ throw new Exception("Unable to connect to MySQL: " . mysqli_error());}
	}



	/**
	 * Close out connection on destruction
	 */
    function __destruct() {
		mysqli_close($this->connection);
    }



	/**
	 * Get an instance of this class
	 *
	 * @return object $db DB instance
	 */
	public static function instance(){

        static $db = null;

        if ($db === null) {
            $db = new DB();
        }

        return $db;
	}



	/**
	 * Execute the given query
	 */
	public function executeQuery($query){

		//attempt to get result
		$result = mysqli_query($this->connection, $query);
		if(!$result){ throw new Exception("Database access failed: " . mysql_error());}

		//format result into an array
		$resultArray = array();
		while($obj = $result->fetch_array()) { $resultArray[] = $obj;}

		return $resultArray;
	}



	/**
	 * Execute the given query
	 */
	public function update($query){

		//attempt to get result
		$result = mysqli_query($this->connection, $query);

		return $result;
	}



	/**
	 * Clean the input data so it can safely go into the DB
	 *
	 * @param string $data Input data
	 *
	 * @return string Data that can be inserted into the DB
	 */
	public function cleanData($data){
		return $this->connection->escape_string($data);
	}
}








