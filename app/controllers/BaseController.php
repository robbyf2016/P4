<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/*Ensure all controller function calls to post have valid CSRF token */
	public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

}
