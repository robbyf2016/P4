<?php

class ClientController extends BaseController {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    # This is an action...
    public function getReadClient() {

    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admins and employees can perform read client based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {
            $clients = Client::all();
            return View::make('CSC_read_client')->with('clients',$clients);
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }

    }

    public function getCreateClient() {

    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create clients based on the role based
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


    public function postCreateClient() {

    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employees can perform create clients based on the role based
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


    public function getUpdateClient() {

        /*****************************************************************************************
        Authorize that the CSC Admin logged in user exists for validating that the update client
        functionality can be performed.
        *****************************************************************************************/

        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {

        /*****************************************************************************************
        This section gets the input from the form post and passes back the standard services list 
        for the user to select a service to update.  only can update existing services.
        *****************************************************************************************/
        $client_options = Client::lists('client_name', 'id');
              
        return View::make('CSC_update_client')
            ->with('client_options',$client_options);

        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }


    public function postUpdateClient() {

        /****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, only admin and employee can perform update clients based on the role based
        matrix 
        ******************************************************************************************/
        if (Auth::user()->is(array('CSC_Admin', 'CSC_Employee')))
        {        

            /**********************************************************************
            If hidden value update is 0 do this else do other
            ***********************************************************************/
            if (Input::get('update') == "0"){  //Using update flag for DRY principle.  Keeps all code in one blade.
            $client_selected = Client::find(Input::get('Client'));

            return View::make('CSC_update_client')
                ->with('client_selected',$client_selected);
            }
            else
            {

                # First get a client to update by using hidden inout value from previous selection from user
                $client = Client::where('client_name', '=', Input::get('client_selected'))->first();


                if($_POST['button'] == 'Update') {

                    # If the client is located, update it
                    if($client) {

                        # Update the client
                        $client->client_name = Input::get('client_name');
                        $client->address = Input::get('address');
                        $client->city = Input::get('city');
                        $client->state = Input::get('state');
                        $client->zip_code = Input::get('zip_code');
                        $client->save();

                        return Redirect::to('/update-client')->with('flash_message', 'Update completed');
                    }
                    else {
                        return Redirect::to('/update-client')->with('flash_message', 'Client not found, cannot update.');
                    }
                }
                else{
                    return Redirect::to('/update-client');
                }
            }
        }
        else
        {
            return Redirect::to('/enter')->with('flash_message', 'User Role is not permitted to access this page');
        }
    }

}