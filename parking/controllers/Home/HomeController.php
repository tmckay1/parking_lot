<?php
namespace Parking\Controllers\Home;

use \Parking\Models\Parking\ParkingLotSpaceSize;
use \Parking\Models\Parking\ParkingLotSpace;
use \Parking\Service\Parking\ParkingLot;

use \Parking\Views\Image\Carousel;
use \Parking\Views\Header\JumboTron;
use \Parking\Views\Form\Form;
use \Parking\Views\SingularContentView;

use \Parking\Controllers\BaseController;



/**
 * @class HomeController
 *
 * Controller used to display the home page
 */
class HomeController extends BaseController {



	/**
	 * Get the contents of the home page
	 *
	 * @return string Controller contents
	 */
	public function getContents(){

		global $debugger;

		//get background
		$background = "<img src='".IMGROOT."/parking-lot.png' style='width:100%;height:100%'>";

		//set gray backdrop
		$grayHtml = "<div class='blur-container'>
				        <img src='".IMGROOT."/solid-gray.png' style='width:100%;height:100%'>
					</div>";

		//get welcome screen
		$jumboAttrs = array(
							"title"    => "Welcome!",
							"subtitle" => "This is the Parking Lot Manager Application",
							"text"     => "Search available parking spots below",
						);
		$jumbotron = new JumboTron("welcomeScreen", $jumboAttrs);
		$jumboView = $jumbotron->getView();
		$jumboHtml = "<div class='row bottom-padding'>
						<div class='col-1'></div>
						<div class='col'>$jumboView</div>
						<div class='col-1'></div>
					</div>";

		//write out form to search parking lots
		$spaceSize   = new ParkingLotSpaceSize();
		$spaceArr    = $spaceSize->getSpacesWithName();
		$formInputs  = array(
							array(//first row - div to hold any error messages
								array(
										"type"    => "div",
										"options" => array(
															"attributes" => array("id" => "parking_errorContainer"),
															"content"    => ""
														)
									),
								),
							array(//second row
								array(
										"type"    => "select",
										"label"   => "What type of vehicle do you have?",
										"options" => array(
															"attributes" => array("id" => "parking_spaceSize", "class" => "form-control"),
															"options"    => $spaceArr,
															"content"    => ""
														)
									),
								),
							array(//third row
								array(
										"type"    => "button",
										"options" => array(
															"attributes" => array("type" => "submit", "class" => "btn btn-primary", "id" => "parking_submitButton"),
															"content"    => "Find Available Space and Book Spot"
														)
									),
								),
						);
		$formOptions = array(
							"attributes" => array(),
							"content"    => "",
							"inputs"     => $formInputs
						);
		$searchForm  = new Form("parking_searchForm", $formOptions);
		$searchView  = $searchForm->getView();
		$searchHtml  = "<div class='row bottom-padding'>
							<div class='col'>
								<div class='card' style='width:100%'>
									<div class='card-body'>
										<div class='card-title'>Parking Lot Search</div>
										<div class='card-text'>$searchView</div>
									</div>
								</div>
							</div>
						</div>";

		//write out the available parking div
		$parkingLot    = new ParkingLot();
		$parkingInfo   = $parkingLot->getParkingLotInfo(PARKING_LOT_ID);

		$parkingHtml = "";
		foreach($parkingInfo as $levelId => $levelInfo){

			$totalSpaces     = count($levelInfo);
			$spacesAvailable = 0;
			$levelName       = "";

			foreach($levelInfo as $spaceId => $spaceInfo){
				$levelName = $spaceInfo["pll_name"];
				if($spaceInfo["pls_available"] == 1) { $spacesAvailable++;}
			}

			$parkingHtml .= "<div class='row bottom-padding'>
								<div class='col'>
									<div class='card' style='width:100%'>
										<div class='card-body'>
											<div class='card-title'>$levelName</div>
											<div class='card-text'>AvailableSpaces: $spacesAvailable/$totalSpaces</div>
										</div>
									</div>
								</div>
							</div>";
		}
		$resultsHtml = "<div class='row bottom-padding'>
							<div class='col'>
								<div class='card' style='width:100%'>
									<div class='card-body'>
										<div class='card-title'>Parking Lot Levels</div>
										<div class='card-text'>$parkingHtml</div>
									</div>
								</div>
							</div>
						</div>";


		//write html
		return  $grayHtml.$jumboHtml.$searchHtml.$resultsHtml;
	}



	/**
	 * Search parking for available spot and add it using GET paramters
	 *
	 * $_GET parameters:
	 *  spaceSize - The requested size of the space
	 *
	 * @return array JSON response
	 */
	public function searchParking(){

		$sizeId = isset($_GET['spaceSize']) ? $_GET['spaceSize'] : 0;

		//see if we have a space
		$parkingLot    = new ParkingLot();
		$space         = $parkingLot->findFirstAvailableSpace(PARKING_LOT_ID, $sizeId);
		if(!$space){ return array();}

		//fill in space
		$lotSpace = new ParkingLotSpace();
		$lotSpace->fillInSpace($space['pls_uid']);

		return array("levelName" => $space['pll_name']);
	}

}
