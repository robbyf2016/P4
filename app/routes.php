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

/*********************************************************
Log into application route
**********************************************************/
Route::get('/enter', array(
	'before'=> 'auth.basic',
	function()
{
	
    return View::make('CSC_landing');
}
));
/*********************************************************
Read / get call to user controller
**********************************************************/
Route::get('/', 'UserController@getIndex');
/*********************************************************
Read /user get call to user controller
**********************************************************/
Route::get('/user', 'UserController@getUser');
/*********************************************************
Read /user post call to user controller
**********************************************************/
Route::post('/user', 'UserController@postUser');
/*********************************************************
Read order get call to order controller
**********************************************************/
Route::get('/read-order',array(
    'before'=> 'auth.basic',
    'uses'=> 'OrderController@getReadOrder')
);
/*********************************************************
Read order post call to order controller
**********************************************************/
Route::post('/read-order', array(
    'before'=> 'auth.basic',
    'uses'=> 'OrderController@postReadOrder')
);
/*********************************************************
Create order get call to order controller
**********************************************************/
Route::get('/create-order', array(
    'before'=> 'auth.basic',
    'uses'=> 'OrderController@getCreateOrder')
);
/*********************************************************
Create order post call to order controller
**********************************************************/
Route::post('/create-order', array(
    'before'=> 'auth.basic',
    'uses'=> 'OrderController@postCreateOrder')
);
/*********************************************************
Read client get call to client controller
**********************************************************/
Route::get('/read-client', array(
    'before'=> 'auth.basic',
    'uses'=> 'ClientController@getReadClient')
);
/*********************************************************
Create client get call to client controller
**********************************************************/
Route::get('/create-client', array(
    'before'=> 'auth.basic',
    'uses' => 'ClientController@getCreateClient')
);
/*********************************************************
Create client post call to client controller
**********************************************************/
Route::post('/create-client', array(
    'before'=> 'auth.basic',
    'uses' => 'ClientController@postCreateClient')
);
/*********************************************************
Read service get call to service controller
**********************************************************/
Route::get('/read-service', array(
    'before'=> 'auth.basic',
    'uses' => 'ServiceController@getReadService')
);
/*********************************************************
Create service get call to service controller
**********************************************************/
Route::get('/create-service', array(
    'before'=> 'auth.basic',
    'uses' => 'ServiceController@getCreateService')
);
/*********************************************************
Create service post call to service controller
**********************************************************/
Route::post('/create-service',array(
    'before'=> 'auth.basic',
    'uses' => 'ServiceController@postCreateService')
);
/*********************************************************
Update/delete service get call to service controller
**********************************************************/
Route::get('/update-service',array(
    'before'=>'auth.basic',
    'uses' => 'ServiceController@getUpdateService')
);
/*********************************************************
Update/delete service post call to service controller
**********************************************************/
Route::post('/update-service', array(
    'before'=> 'auth.basic',
    'uses' => 'ServiceController@postUpdateService')
);
/*********************************************************
Logout of application route
**********************************************************/
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