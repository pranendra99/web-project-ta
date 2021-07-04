<?php namespace App\Controllers;

class Lampu extends BaseController
{
	public function index()
	{
		return view('dashboard');
    }

	public function datalaporan()
	{
		return view('datalaporan');
	}
    
}