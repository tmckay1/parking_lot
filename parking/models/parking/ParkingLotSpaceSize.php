<?php 
namespace Parking\Models\Parking;

use \Parking\Models\BaseModel;



/**
 * @class ParkingLotSpaceSize
 *
 * Class representing a parking lot space size
 */
class ParkingLotSpaceSize extends BaseModel{



	/**
	 * Get the table name
	 *
	 * @return string Table name
	 */
	public function getTable(){
		return "parking_lot_space_sizes";
	}



	/**
	 * Get the primary table id
	 *
	 * @return string Primary table id
	 */
	public function getTableId(){
		return "plss_uid";
	}



	/**
	 * Get the key value array for all the spaces pointing space id to space name
	 *
	 * @return array Space array
	 */
	public function getSpacesWithName(){
		return $this->getKeyToValueArray("plss_uid", "plss_name");
	}
}