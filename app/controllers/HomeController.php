<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected $layout = "layouts.base";

	public function showHome()
	{
		return View::make('contents.content_main');
	}

	public function showLogin()
	{

		if (Auth::check())
		{
			// Redirect to homepage
			return Redirect::to('')->with('success', 'Anda sudah Login');
		}

		// Show the login page
		return View::make('layouts.login');
	}

	public function doLogin()
	{
		// Get all the inputs
		// id is used for login, username is used for validation to return correct error-strings
		$userdata = array(
			'username' => Input::get('username'),
			'sess' => Input::get('username'),
			'password' => Input::get('password')
		);
	
		// Declare the rules for the form validation.
		$rules = array(
			'username'  => 'Required',
			'password'	=> 'Required'
		);

		// Validate the inputs.
		$validator = Validator::make($userdata, $rules);

		// Check if the form validates with success.
		if ($validator->passes())
		{
			// remove username, because it was just used for validation
			unset($userdata['sess']);

			// Try to log the user in.
			if (Auth::attempt($userdata))
			{
				// Redirect to homepage
				return Redirect::to('')->with('success', 'anda telah masuk !');
			}
			else
			{
				// Redirect to the login page.
				return Redirect::to('')->with('fail','Nama Akun atau Kata Sandi tidak cocok');
			}
		}
	}

	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to(''); // redirect the user to the login screen
	}

}