<?php
 
class ServiceTableSeeder extends Seeder {
 
  public function run()
  {
  		$service = new Service();

    	$service->service_name = 'Database Security Assessment';
    	$service->service_desc = 'A database security assessment involves examining database structure and implementation from a security
    	perspective in order to prevent accidental release of sensitive information.  The price is dependent on the number of 
    	tables and size to be analyzed.';
    	$service->service_price = '1100';

    	$service->save();

    	$service = new Service();

    	$service->service_name = 'Secure Code Assssment';
    	$service->service_desc = 'CSC provides the assessment of specific application code like Java, JavaScript, C, C++, PHP, HTML, and Fortran.
    	The price is dependent on the number of lines of code to be analyzed.';
    	$service->service_price = '750';

    	$service->save();

    	$service = new Service();

    	$service->service_name = 'Network Security Assessment';
    	$service->service_desc = 'CSC provides network based security assessments that analyzes the security posture of various networked 
    	components from a network level perspective.  The assessment can be either credentialed or non-credentialed.  The price is based on
    	the number of network components to be assessed';
    	$service->service_price = '1000';

    	$service->save();
  }
 
}