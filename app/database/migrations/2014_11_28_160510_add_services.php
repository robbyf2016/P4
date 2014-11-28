<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		$service = new Service();

    	$service->service_name = 'Security Audit';
    	$service->service_desc = 'A security audit is used to provide assurance of compliance to a particular standard
    	such as NIST, HIPPA, or SOX';
    	$service->service_price = '1500';

    	$service->save();

    	$service = new Service();

    	$service->service_name = 'Virus Removal';
    	$service->service_desc = 'CSC provides virus removal services that eradicates known viruses, trojans, and 
    	malware.';
    	$service->service_price = '500';

    	$service->save();

    	$service = new Service();

    	$service->service_name = 'Security Training';
    	$service->service_desc = 'CSC provides various one week security training on various security topics
    	such as WiFi Security, Network Security, and Code Security.';
    	$service->service_price = '3000';

    	$service->save();


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
