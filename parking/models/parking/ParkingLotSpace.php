<?php 
namespace Parking\Models\Parking;

use \Parking\Models\BaseModel;



/**
 * @class ParkingLotSpace
 *
 * Class representing a parking lot Space
 */
class ParkingLotSpace extends BaseModel{



	/**
	 * Get the table name
	 *
	 * @return string Table name
	 */
	public function getTable(){
		return "parking_lot_spaces";
	}



	/**
	 * Get the primary table id
	 *
	 * @return string Primary table id
	 */
	public function getTableId(){
		return "pls_uid";
	}



	/**
	 * Fill in the given space
	 *
	 * @param $spaceId
	 */
	public function fillInSpace($spaceId){

		//clean id and update
		$query = "UPDATE ".$this->getTable()." SET pls_available=1 WHERE ".$this->getTableId()."=$spaceId";
		$res   = $this->db->update($query);
	}
}