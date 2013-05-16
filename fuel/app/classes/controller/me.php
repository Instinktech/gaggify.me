<?php

class Controller_Me extends Controller_Template
{

	public function action_index()
	{
		$this->template->title = 'Me &raquo; Index';
		$this->template->content = View::forge('me/index');
	}

	public function action_login()
	{
		$this->template->title = 'Me &raquo; Login';
		$this->template->content = View::forge('me/login');
	}

	public function action_join()
	{
		$this->template->title = 'Me &raquo; Join';
		$this->template->content = View::forge('me/join');
	}

	public function action_forget()
	{
		$this->template->title = 'Me &raquo; Forget';
		$this->template->content = View::forge('me/forget');
	}

	public function action_confirm()
	{
		$this->template->title = 'Me &raquo; Confirm';
		$this->template->content = View::forge('me/confirm');
	}

}
