<?php

class UserController extends BaseController {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    # This is an action...
    public function getIndex() {

    	return View::make('CSC_index_page');
    }

    public function getUser() {

    	return View::make('CSC_create_user_form');
    }


    public function postUser() {

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



    		$user->roles()->sync(array('3'));

    		Auth::attempt(array('username'=>$user->username, 'password'=>Input::get('password')));

			return Redirect::to('/enter')->with('flash_message', 'Successfully created ID - Welcome to CSC'); 
    }



}