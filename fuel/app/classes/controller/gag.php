<?php

use \Fuel\Core\Session as Session;
use \Fuel\Core\Input as Input;

class Controller_Gag extends \Instinktech\InktController
{

    private $_fileExtension = '.jpeg';

    private $_session = null;

    public function __construct() {
        $this->_session = Session::instance();
    }

	public function action_index()
	{
		$data['gags'] = Model_Gag::find('all');
		$this->template->title = "Gags";
		$this->template->content = View::forge('gag/index', $data);

	}

    public function action_all() {
        // Apply Filters too.
        $gags = \Format::forge(Model_Gag::find('all'))->to_array();
        header("Content-Type: application/json");
        echo json_encode($gags); exit;
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('Gag');

		if ( ! $data['gag'] = Model_Gag::find($id))
		{
			Session::set_flash('error', 'Could not find gag #'.$id);
			Response::redirect('Gag');
		}

		$this->template->title = "Gag";
		$this->template->content = View::forge('gag/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Gag::validate('create');
			if ($val->run())
			{
                $md5 = md5_file(Input::post('img'));
                $b64 = Input::post('img');
                //$b64 = preg_replace('#^data:image/[^;]+;base64,#', '', Input::post('img'));
                $dir = substr($md5,-2);
                $fileName = $md5.$this->_fileExtension;
                $path = BUCKET_PATH.DS.'original'.DS.$dir.DS.$fileName;
                file_put_contents($path,$b64);
                $me = $this->_session->get('me', array());
				$gag = Model_Gag::forge(array(
					'title' => Input::post('title'),
                    'img_original'  => $fileName,
                    'mime'  => 'image/jpeg', //For now
                    'likes' => 0,
                    'dislikes'  => 0,
                    'user_id'   => $me['id'],
                    'uploaded_on'   => time(),
                    'host_ip'   => $_SERVER['REMOTE_ADDR']
				));

				if ($gag and $gag->save())
				{
					Session::set_flash('success', 'Your Gag has been uploaded successfully!');
					Response::redirect('gag/view/'.$gag->id);
				} else {
					Session::set_flash('error', 'Could not save your gag right now!.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Gags";
		$this->template->content = View::forge('gag/create');
	}

    private function _makeFileFromBase64($stream) {
        //return file_put_contents('')
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Gag');

		if ( ! $gag = Model_Gag::find($id))
		{
			Session::set_flash('error', 'Could not find gag #'.$id);
			Response::redirect('Gag');
		}

		$val = Model_Gag::validate('edit');

		if ($val->run())
		{
			$gag->name = Input::post('name');

			if ($gag->save())
			{
				Session::set_flash('success', 'Updated gag #' . $id);

				Response::redirect('gag');
			}

			else
			{
				Session::set_flash('error', 'Could not update gag #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$gag->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('gag', $gag, false);
		}

		$this->template->title = "Gags";
		$this->template->content = View::forge('gag/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('Gag');

		if ($gag = Model_Gag::find($id))
		{
			$gag->delete();

			Session::set_flash('success', 'Deleted gag #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete gag #'.$id);
		}

		Response::redirect('gag');

	}


}