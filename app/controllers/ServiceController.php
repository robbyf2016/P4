<?php

class ServiceController extends BaseController {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    # This is an action...
    public function getReadService() {
    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, all can perform read services based on the role based
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


    public function getCreateService() {

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


    public function postCreateService() {

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
    }

    public function getUpdateService() {

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
    }


    public function postUpdateService() {

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


}
