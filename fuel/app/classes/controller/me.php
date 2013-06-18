<?php

use \Fuel\Core\Arr;
use \Fuel\Core\Response;
use \Fuel\Core\DB as DB;

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
            $get = $_GET;
            if ( Arr::get($get, 'via',false) == 'facebook') {
                if ( !$facebook->check_login()) {
                    Response::redirect($facebook->getLoginUrl());
                }
                // /me has all data. Persist it and start session!
                $me = $facebook->api('/me');
                //$this->dump($me); exit;
                $counted = Model_Users::query()->where('fb_id', $me['id'])->count();
                if ( $counted == 0) {
                    // User doesn't exist. Register him.
                    try {
                        DB::start_transaction();
                        // User
                        $user = new Model_Users();
                        $user->fb_id = $me['id'];
                        $user->username = Arr::get($me,'username');
                        $user->is_verified  = Arr::get($me,'verified');
                        $user->email = Arr::get($me,'email');
                        $user->locale = Arr::get($me,'locale');
                        $user->created_on = time();
                        $user->host_ip = $_SERVER['REMOTE_ADDR'];
                        $user->save();

                        // Profile
                        $profile = new Model_Profile();
                        $profile->id = $user->id;
                        $profile->first_name = Arr::get($me,'first_name');
                        $profile->last_name = Arr::get($me,'last_name');
                        $profile->birthday = Arr::get($me,'birthday');
                        $profile->location = is_array(Arr::get($me,'location')) ? $me['location']['name'] : null;
                        $profile->gender = Arr::get($me,'gender', null);
                        $profile->website = Arr::get($me,'website',null);
                        $profile->created_on = time();
                        $profile->save();
                        DB::commit_transaction();
                        Response::redirect('/me');
                    } catch (\Exception $ex) {
                        $this->dump($ex);
                        DB::rollback_transaction();
                    }

                }
                //echo $counted; exit;
                //$this->dump($facebook->api('/me'));
            }
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
