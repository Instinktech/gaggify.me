<?php

class Controller_Me extends \Instinktech\InktController
{

	public function action_index()
	{
		$this->setTitle('Dashboard - Profile');
		$this->setView('me/index');
	}

	public function action_login()
	{
            $facebook = \Social\Facebook::instance();
            $this->dump($facebook);
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
