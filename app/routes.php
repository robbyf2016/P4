<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Paste\Pre;

/*Route::get('/', function()
{
	return View::make('hello');
});*/


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});


Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});


Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo print_r($results);

});

/********************************************************
    Application Final Project Routes
********************************************************/

Route::get('/', function()
{
	return View::make('CSC_index_page');
});

Route::get('/user', function()
{
	return View::make('CSC_create_user_form');
});

Route::post('/user',
    array(
        'before' => 'csrf',
        function() {

/********************************************************
Create validation rules for authentication input
*********************************************************/

    $rules = array(
        'username' => 'alpha_num|min:5|unique:users,username|required', /*Username not used check*/
        'password' => 'required|min:7',
        'email' => 'email|required'
        );

/*******************************************************
Create validator based on above created rules
********************************************************/

    	$validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){

                return Redirect::to('/user')->with('flash_message', 'Sign up failed; see errors and please try again.')
                    ->withInput()
                    ->withErrors($validator);

            }

/******************************************************
Create user based on validated input
*******************************************************/

    $user = new Toddish\Verify\Models\User;
    $user->username         = Input::get('username');
    $user->password         = Input::get('password');
    $user->email            = Input::get('email');
    $user->verified         = 1;

    try{
        $user->save();
    }

    catch(Exception $e){
        return Redirect::to('/user')->with('flash_message', 'Sign up failed; please try again.')
        ->withInput();
    }

    $user->roles()->sync(array(1));

    Auth::attempt(array('identifier'=>$user->username, 'password'=>Input::get('password'), $remember = false));

	return Redirect::to('/enter')->with('flash_message', 'Successfully created ID - Welcome to CSC'); 
}));

Route::get('/enter', array(
	'before'=> 'auth.basic',
	function()
{
	
    return View::make('CSC_landing');
}
));

Route::get('/read-order',array(
    'before'=> 'auth.basic',
    function()
    {
        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee', 'CSC_client')))
        {
            $client_options = Client::lists('client_name', 'id');

            return View::make('CSC_read_order')
            //->with('service_options',$service_options)
            ->with('client_options',$client_options);
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));

Route::post('/read-order', array(
    'before'=> 'auth.basic',
    function()

    {
       /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee', 'CSC_client')))
        {

        /*****************************************************************************************
        This section gets the input from the form post and passes back the standard client list 
        and creates an Eloquent ORM query to get the selected parameter data from the orders 
        table and corresponding services table based on the pivot table and input selection and
        returns results of query.
        *****************************************************************************************/
            $client = Input::get('Client');
            $client_options = Client::lists('client_name', 'id');
            $client_info = Client::where('id', '=', $client)->get();

            /*Eager load the query*/
            $selection = Order::with('services')->where('client_id', '=', $client)->get();

            return View::make('CSC_read_order')
            ->with('selection',$selection)
            ->with('client_info',$client_info)
            ->with('client_options',$client_options);

        }
        else
        {
            return Redirect::to('/read-order')->with('flash_message', 'User Role is not permitted to access this page');
        }

    }
));


Route::get('/create-order', array(
    'before'=> 'auth.basic',
    function()

    {
        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {
            $service_options = Service::lists('service_name', 'id');
            $client_options = Client::lists('client_name', 'id');

            return View::make('CSC_create_order')
            ->with('service_options',$service_options)
            ->with('client_options',$client_options);
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));

Route::post('/create-order', array(
    'before'=> 'auth.basic',
    function()

    {
       /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {        

            /**********************************************************************
            Adds new order to orders table.
            ***********************************************************************/

            $order = new Order;
            $dt = new DateTime();
            //$a = Input::get('Client');
            //$b = Input::get('Service');
            //return (array($a,$b));

            $client = Client::find(Input::get('Client'));
            $service = Service::find(Input::get('Service'));

            /*Associate client input selection to clients table*/
            $order->client()->associate($client);
            $order->order_created_date  = $dt;  /* Could just use timestamp in table.  For future release consideration.*/
            $order->save();

            /*Attach service to update service_order_assignment table*/
            $order->services()->attach($service);

            return Redirect::to('/create-order')->with('flash_message', 'Order created and added to the orders table');
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));


Route::get('/create-client', array(
    'before'=> 'auth.basic',
    function()

    {
        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {
            return View::make('CSC_create_client');
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));

Route::post('/create-client', array(
    'before'=> 'auth.basic',
    function()

    {
       /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create orders based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {
            /*************************************************************************
            Rules array to set specific parameters for data input validation.
            **************************************************************************/
            $rules = array(
                'client' => 'unique:clients,client_name|required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required|alpha|min:2|max:2',
                'zip' => 'required|digits:5'  /* Future development use regex for zip + 4 */
            );

            /***********************************************************************
            Validates data input based on rules and either enters data into table or
            sends user back to main page with specific error conditions.
            ************************************************************************/

        $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){

                return Redirect::to('/create-client')->with('flash_message', 'Invalid input entered.  Please try again.')
                    ->withInput()
                    ->withErrors($validator);

            }

            /**********************************************************************
            Adds new client to clients table.
            ***********************************************************************/

            $client = new Client;
            $client->client_name    = Input::get('client');
            $client->address        = Input::get('address');
            $client->city           = Input::get('city');
            $client->state          = Input::get('state');
            $client->zip_code       = Input::get('zip');
            $client->save();

            return Redirect::to('/create-client')->with('flash_message', 'Client created and added to clients table');
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));

Route::get('/read-service', array(
    'before'=> 'auth.basic',
    function()

    {
        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admins can perform create services based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_client', 'CSC_Employee')))
        {
            $services = Service::all();
            return View::make('CSC_read_service')->with('services',$services);
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));


Route::get('/create-service', array(
    'before'=> 'auth.basic',
    function()

    {
        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admins can perform create services based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin')))
        {
            return View::make('CSC_create_service');
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));


Route::post('/create-service',array(
    'before'=> 'auth.basic',
    function(){

        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admins can perform create services based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin')))
        {
            /*************************************************************************
            Rules array to set specific parameters for data input validation.
            **************************************************************************/
            $rules = array(
                'service_name' => 'unique:services,service_name|required',
                'service_desc' => 'required',
                'service_price' => 'required|numeric'
            );

            /***********************************************************************
            Validates data input based on rules and either enters data into table or
            sends user back to main page with specific error conditions.
            ************************************************************************/

        $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){

                return Redirect::to('/create-service')->with('flash_message', 'Invalid input entered.  Please try again.')
                    ->withInput()
                    ->withErrors($validator);

            }

            /**********************************************************************
            Adds new service to services table.
            ***********************************************************************/

            $service = new Service;
            $service->service_name    = Input::get('service_name');
            $service->service_desc    = Input::get('service_desc');
            $service->service_price   = Input::get('service_price');
            $service->save();

            return Redirect::to('/create-service')->with('flash_message', 'Service created and added to services table');
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
}));

Route::get('/update-service',array(
    'before'=>'auth.basic',
    function(){

        /*****************************************************************************************
        Authorize that the CSC Admin logged in user exists for validating that the update service
        functionality can be performed.
        *****************************************************************************************/

        if (Auth::user()->is(array('CSC_Admin')))
        {

        /*****************************************************************************************
        This section gets the input from the form post and passes back the standard services list 
        for the user to select a service to update.  only can update existing services.
        *****************************************************************************************/
        $service_options = Service::lists('service_name', 'id');
              
        return View::make('CSC_update_service')
            ->with('service_options',$service_options);

        }
        else
        {
            return Redirect::to('/read-order')->with('flash_message', 'User Role is not permitted to access this page');
        }
}));

Route::post('/update-service', array(
    'before'=> 'auth.basic',
    function()

    {
       /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform update services based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin')))
        {        

            /**********************************************************************
            If hidden value update is 0 do this else do other
            ***********************************************************************/
            if (Input::get('update') == "0"){  //Using update flag for DRY principle.  Keeps all code in one blade.
            $service_selected = Service::find(Input::get('Service'));

            return View::make('CSC_update_service')
                ->with('service_selected',$service_selected);
            }
            else
            {

                # First get a service to update by using hidden inout value from previous selection from user
                $service = Service::where('service_name', '=', Input::get('service_selected'))->first();


                if($_POST['button'] == 'Update') {

                    # If the service is located, update it
                    if($service) {

                        # Update the service
                        $service->service_name = Input::get('service_name');
                        $service->service_desc = Input::get('service_desc');
                        $service->service_price = Input::get('service_price');
                        $service->save();

                        return Redirect::to('/update-service')->with('flash_message', 'Update completed');
                    }
                    else {
                        return Redirect::to('/update-service')->with('flash_message', 'Service not found, cannot update.');
                    }
                }
                elseif($_POST['button'] == 'Delete'){

                    if($service){

                        $service->delete();

                        return Redirect::to('/update-service')->with('flash_message', 'Service DELETED!');
                    }
                    else{

                        return Redirect::to('/update-service')->with('flash_message', 'Service not found, cannot delete.');

                    }

                }
                else{

                    return Redirect::to('/update-service');

                }
            }

        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

));


Route::get('/logout', 
    array(
        'after' => 'invalidate-browser-cache',
        function()
{
    Auth::logout();
    Session::flush();

    return Redirect::to('/');
}));

/*---------------------------------------------------------
    Debug
----------------------------------------------------------*/

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});