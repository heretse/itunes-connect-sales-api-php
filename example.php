<?php

// Require the iTunes Sales API Class
require_once('class/iTunesSalesApi.php');

// First example, create new object with connection data straight away
$reporter = new iTunesSalesApi("user@example.com","mysecretpassword","myvendorID");

// Second example, step by step
$reporter = new iTunesSalesApi();
$reporter->setLogin("user@example.com")
			->setPassword("mysecretpassword")
			->setVendor("myvendorID")
			->setFolder("/home/web/path/folder/sales")
			->setUseCache(true)
			->setReportModeEarningsOnly();


// Addtionnal options

// [OPTIONAL] 
// If you want to save reports locally
$reporter->setFolder("/path/to/my/folder"); //REPLACE or remove

// [OPTIONAL] 
// When non critical errors are met, this will throw an error and stop (debug option)
$reporter->throwErrors = true; //Default is false

// [OPTIONAL] 
// If you have specified a folder, API will load previous cached files if available
// By setting to false, API will make a new call to iTunes regardless of existing files
$reporter->setUseCache(false); //true by default

// [OPTIONAL] 
// Change report mode
// setReportModeAll will return sales and app downloads
$reporter->setReportModeAll(); //By default
// setReportModeEarningsOnly will only return sales (over 0.0€)
$reporter->setReportModeEarningsOnly(); 

//Get the daily report
try{
	//$data is either an array or false, if false you can get errors by calling getErrorsAsString() or listing $reporter->errors
	if($data = $reporter->getSalesDailyReport("20161122")) {
		//Do something with data your're good to got
		print_r(json_encode($data));
	}
	else{
		echo "Api  Errors : ".$reporter->getErrorsAsString();
	}
}catch (Exception $e){
	echo $e->getMessage();
}

//Get the weekly report
try{
	if($data = $reporter->getSalesWeeklyReport()) { //Will get last week by default
		//Do something with data your're good to got
		print_r(json_encode($data));
	}
	else{
		echo "Api  Errors : ".$reporter->getErrorsAsString();
	}
}catch (Exception $e){
	echo $e->getMessage();
}

//Get the monthly report
try{
	if($data = $reporter->getSalesMonthlyReport()) { //Will get last month by default
		//Do something with data your're good to got
		print_r(json_encode($data));
	}
	else{
		echo "Api  Errors : ".$reporter->getErrorsAsString();
	}
}catch (Exception $e){
	echo $e->getMessage();
}

//Get the yearly report
try{
	if($data = $reporter->getSalesYearlyReport()) { //Will get last year by default
		//Do something with data your're good to got
		print_r(json_encode($data));
	}
	else{
		echo "Api  Errors : ".$reporter->getErrorsAsString();
	}
}catch (Exception $e){
	echo $e->getMessage();
}




