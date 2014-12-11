<?php
 
class ClientTableSeeder extends Seeder {
 
  public function run()
  {
  		$client = new Client();

    	$client->client_name = 'Federal Reserve Bank of Boston';
    	$client->address = '600 Atlantic Ave #100';
    	$client->city = 'Boston';
    	$client->state = 'MA';
    	$client->zip_code = '02210';
    	$client->save();

    	$client = new Client();

    	$client->client_name = 'MIT Coop';
    	$client->address = '3 Cambridge Center';
    	$client->city = 'Cambridge';
    	$client->state = 'MA';
    	$client->zip_code = '02139';
    	$client->save();

    	$client = new Client();

    	$client->client_name = 'Bond No9 NYC';
    	$client->address = '9 Bond Street';
    	$client->city = 'New York';
    	$client->state = 'NY';
    	$client->zip_code = '22182';
    	$client->save();

    }
}
