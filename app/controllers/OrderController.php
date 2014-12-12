<?php

class OrderController extends BaseController {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    # This is an action...
    public function getReadOrder() {

    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, all can perform read orders based on the role based
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


    public function postReadOrder() {

    	/****************************************************************************************** 
        This tests the authenticated user's role to determine if they can access this page.  In
        this instance, all can perform read orders based on the role based
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


    public function getCreateOrder() {

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


    public function postCreateOrder() {

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


}