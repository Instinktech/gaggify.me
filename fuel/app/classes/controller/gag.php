<?php
class Controller_Gag extends Controller_Template 
{

	public function action_index()
	{
		$data['gags'] = Model_Gag::find('all');
		$this->template->title = "Gags";
		$this->template->content = View::forge('gag/index', $data);

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
				$gag = Model_Gag::forge(array(
					'name' => Input::post('name'),
				));

				if ($gag and $gag->save())
				{
					Session::set_flash('success', 'Added gag #'.$gag->id.'.');

					Response::redirect('gag');
				}

				else
				{
					Session::set_flash('error', 'Could not save gag.');
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