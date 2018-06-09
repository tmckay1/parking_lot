<?php
require_once("./inc/include.php");

//initialize home page
$page = new \Parking\Pages\Home\HomePage();
$debugger->debug($page);

$parkingLot = new \Parking\Models\Parking\ParkingLot();
$p = $parkingLot->find(1);
$debugger->debug($p);

//draw home page
$page->drawContents();

