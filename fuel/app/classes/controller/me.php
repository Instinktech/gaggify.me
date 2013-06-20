<?php

use \Fuel\Core\Arr;
use \Fuel\Core\Response;
use \Fuel\Core\DB as DB;
use \Fuel\Core\Session as Session;

class Controller_Me extends \Instinktech\InktController
{

    private $_mUser = null;

    public function __construct() {
        $this->_mUser = new Model_Users();
    }


	public function action_index()
	{
		$this->setTitle('Dashboard - Profile');
		$this->setView('me/index');
	}


	public function action_login()
	{
            $facebook = \Social\Facebook::instance();
            $get = $_GET;

            if ( Arr::get($get, 'via',false) == 'facebook') {

                if ( !$facebook->check_login()) {
                    Response::redirect($facebook->getLoginUrl());
                }
                // /me has all data. Persist it and start session!
                $me = $facebook->api('/me');
                //$this->dump($me); exit;
                $counted = Model_Users::query()->where('fb_id', $me['id'])->count();
                //echo $counted; exit;
                if ( $counted == 0) {
                    // User doesn't exist. Register him.
                    try {
                        DB::start_transaction();
                        // User
                        $this->_mUser->fb_id = $me['id'];
                        $this->_mUser->username = Arr::get($me,'username');
                        $this->_mUser->is_verified  = Arr::get($me,'verified');
                        $this->_mUser->email = Arr::get($me,'email');
                        $this->_mUser->locale = Arr::get($me,'locale');
                        $this->_mUser->created_on = time();
                        $this->_mUser->host_ip = $_SERVER['REMOTE_ADDR'];
                        $this->_mUser->save();


                        // Profile
                        $profile = new Model_Profile();
                        $profile->id = $this->_mUser->id;
                        $profile->first_name = Arr::get($me,'first_name');
                        $profile->last_name = Arr::get($me,'last_name');
                        $profile->birthday = Arr::get($me,'birthday');
                        $profile->location = is_array(Arr::get($me,'location')) ? $me['location']['name'] : null;
                        $profile->gender = Arr::get($me,'gender', null);
                        $profile->website = Arr::get($me,'website',null);
                        $profile->created_on = time();
                        $profile->save();
                        DB::commit_transaction();
                        $this->_mUser->reset();
                        Response::redirect('/');
                    } catch (\Exception $ex) {
                        $this->dump($ex);
                        DB::rollback_transaction();
                    }

                } else {
                    $me = $this->_mUser->loadWithFacebookId($me['id']);
                    Session::instance()->set('me',$me);
                    Response::redirect('/');
                }
            }
	}

    public function action_stickies() {
        $this->setTitle("My Stickies - Gaggify.me");
        $this->setView('me/stickes');
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
