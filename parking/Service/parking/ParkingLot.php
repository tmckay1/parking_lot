<?php
namespace Parking\Service\Parking;

use \Parking\Database\DB;
use \Parking\Models\Parking\ParkingLotSpaceSize;


/**
 * @class ParkingLot
 *
 * Class representing a service to query multiple models relating to parking lots
 */
class ParkingLot {



	/**
	 * Get the parking lot info for a given id 
	 *
	 * @param $parkingLotId The id of the parking lot
	 *
	 * @return array Parking lot info
	 */
	public function getParkingLotInfo($parkingLotId){

		$db = DB::instance();

		//get raw data
		$id    = $db->cleanData($parkingLotId);
		$query = "SELECT * FROM parking_lots AS pl
					INNER JOIN parking_lot_levels AS pll on pl.pl_uid=pll.pll_parking_lot_id
					INNER JOIN parking_lot_spaces AS pls on pll.pll_uid=pls.pls_level_id
					WHERE pl.pl_uid=$id
					ORDER BY pll_order ASC";
		$res   = $db->executeQuery($query);

		//format raw data
		$result = array();
		foreach($res as $row){ $result[$row["pll_uid"]][$row["pls_uid"]] = $row;}

		return $result;
	}



	/**
	 * Book a parking lot space if available
	 *
	 * @param $parkingLotId The id of the parking lot
	 * @param $spaceSizeId  The id of the parking space size
	 *
	 * @return array Parking lot space info (empty if not available)
	 */
	public function findFirstAvailableSpace($parkingLotId, $spaceSizeId){

		$db = DB::instance();

		//get numberic size for this size id
		$sizeId    = $db->cleanData($spaceSizeId);
		$spaceSize = new ParkingLotSpaceSize();
		$sSizeInfo = $spaceSize->find($sizeId);
		if(empty($sSizeInfo)){ return array();}
		$size      = $sSizeInfo["plss_size"];

		//find available spots 
		$id     = $db->cleanData($parkingLotId);
		$query  = "SELECT * FROM parking_lots AS pl
					INNER JOIN parking_lot_levels      AS pll  on pl.pl_uid=pll.pll_parking_lot_id
					INNER JOIN parking_lot_spaces      AS pls  on pll.pll_uid=pls.pls_level_id
					INNER JOIN parking_lot_space_sizes AS plss on pls.pls_size_id=plss.plss_uid
					WHERE pl.pl_uid=$id
					AND   plss.plss_size >= $size
					AND   pls.pls_available=0
					ORDER BY pll_order ASC";
		$res   = $db->executeQuery($query);

		return empty($res) ? $res : $res[0];
	}
}







