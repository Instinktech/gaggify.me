<?php
use Orm\Model;

class Model_Gag extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'img_original',
		'img_100x100',
        'img_250x250',
        'img_640x800',
        'mime',
        'likes',
        'dislikes',
        'user_id',
        'uploaded_on',
        'host_ip'
	);

    protected static $_table_name = 'gags';


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');

		return $val;
	}

}
