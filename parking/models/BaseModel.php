<?php
namespace Parking\Models;

use \Parking\Database\DB;



/**
 * @class BaseModel
 *
 * This class represents a base model from our database
 */
abstract class BaseModel {



	/**
	 * @var string $table The name of the table for this model
	 */
	private $table;

	/**
	 * @var object $db DB object to query
	 */
	protected $db;



	/**
	 * Default constructor
	 */
	function __construct(){
		$this->table = $this->getTable();
		$this->db    = DB::instance();
	}



	/**
	 * Override with the table name
	 *
	 * @return string Table name
	 */
	abstract public function getTable();



	/**
	 * Override with the primary table id
	 *
	 * @return string Primary table id
	 */
	abstract public function getTableId();



	/**
	 * Find the model with the given Id
	 *
	 * @param string $id Id of the record to find
	 */
	public function find($id){

		$id    = $this->db->cleanData($id);
		$query = "SELECT * FROM ".$this->getTable()." WHERE ".$this->getTableId()."=$id LIMIT 1";
		$res   = $this->db->executeQuery($query);

		return !empty($res) ? $res[0] : $res;
	}



	/**
	 * Get an array pointing one column value to another column value
	 *
	 * @param string $keyColumn   The name of the column to act as the key
	 * @param string $valueColumn The name of the column to act as the value
	 * @param array  $options     Additional options to be implemented later
	 */
	protected final function getKeyToValueArray($keyColumn, $valueColumn, $options = array()){

		//for right now just get every one
		$query = "SELECT $keyColumn, $valueColumn FROM ".$this->getTable()."";
		$res   = $this->db->executeQuery($query);

		//create key value array
		$returnArray = array();
		foreach($res as $row){

			$key   = isset($row[$keyColumn])   ? $row[$keyColumn]   : "";
			$value = isset($row[$valueColumn]) ? $row[$valueColumn] : "";

			$returnArray[$key] = $value;
		}

		return $returnArray;
	}
}










