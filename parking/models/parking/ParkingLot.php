<?php 
namespace Parking\Models\Parking;

use \Parking\Models\BaseModel;



/**
 * @class ParkingLot
 *
 * Class representing a parking lot
 */
class ParkingLot extends BaseModel{



	/**
	 * Get the table name
	 *
	 * @return string Table name
	 */
	public function getTable(){
		return "parking_lots";
	}



	/**
	 * Get the primary table id
	 *
	 * @return string Primary table id
	 */
	public function getTableId(){
		return "pl_uid";
	}
}