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

Route::get('/truncate', function() {

    # Clear the tables to a blank slate
    DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
    DB::statement('TRUNCATE books');
    DB::statement('TRUNCATE authors');
    DB::statement('TRUNCATE tags');
    DB::statement('TRUNCATE book_tag');
});

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

    $rules = array(
        'username' => 'alpha_num|min:5|unique:users,username|required',
        'password' => 'required|min:7',
        'email' => 'email|required'
        );

    	$validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()){

                return Redirect::to('/user')->with('flash_message', 'Sign up failed; see errors and please try again.')
                    ->withInput()
                    ->withErrors($validator);

            }

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

    Auth::attempt(array('identifier'=>$user->username, 'password'=>Input::get('password')));

	return Redirect::to('/enter')->with('flash_message', 'Successfully created ID - Welcome to CSC'); 
}));

Route::get('/enter', array(
	'before'=> 'auth.basic',
	function()
{
	
    return View::make('CSC_landing');
}
));

Route::get('/create-order', array(
    'before'=> 'auth.basic',
    function()

    {
        return View::make('CSC_create_order');
    }

));

Route::get('/create-client', array(
    'before'=> 'auth.basic',
    function()

    {
        return View::make('CSC_create_client');
    }

));

Route::get('/create-service',array(
    'before'=> 'auth.basic',
    function(){

    $service = new Service();

    $service->service_name = 'Vulnerability Assessment';
    $service->service_desc = 'Vulnerability assessment involves scanning the devices within 
    a system to determine possible vulnerabilities with the additional assessment of false 
    positives';
    $service->service_price = '800';

    $service->save();

    return 'A new service was added!';

}));

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