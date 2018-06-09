$(document).ready(function(){
	setupSearchForm();
});



/**
 * Setup form to search twitter API on submit
 */
function setupSearchForm(){

	$('#parking_searchForm').on('submit', function(e){

		e.preventDefault();

		//get data needed to search twitter
		var parking_spaceSize = $("#parking_spaceSize").val();

		if(parking_spaceSize){

			//set default response
			var requestURL  = '/pl/fw/index.php';
			var requestData = {
								"spaceSize"      : parking_spaceSize, 
								"path"           : "Home",
								"controller"     : "Home",
								"action"         : "searchParking"
								};
			$.getJSON(requestURL, requestData, function(data){
				if(data.STATUS == "OK"){
					if(data.MSG && data.MSG.levelName){
						displaySuccess("Successfully added the vehicle to level "+data.MSG.levelName);
					}else{
						displayError("Could not add the vehicle to the parking lot. There are no available spaces that fit that size.");
					}
				}else{
					displayError(data.MSG);
				}
			}).fail(function(){
				displayError("Failed to send request, no network connection or the server is unavailable at this time.");
			});
		}

		return false;
	});
}



/**
 * Display the error message to the screen
 */
function displayError(errorMsg){

	//generate error div
	var alert = '<div class="alert alert-danger" role="alert">'+errorMsg+'</div>';

	$("#parking_errorContainer").html(alert).show().delay(3000).fadeOut();
}



/**
 * Display the error message to the screen
 */
function displaySuccess(errorMsg){

	//generate error div
	var alert = '<div class="alert alert-success" role="alert">'+errorMsg+'</div>';

	$("#parking_errorContainer").html(alert).show().delay(3000).fadeOut();
}






