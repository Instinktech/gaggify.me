<?php
use Orm\Model;

class Model_Profile extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'first_name',
        'last_name',
        'birthday',
        'location',
        'website',
        'gender',
        'created_on'
	);

    protected static $_table_name = 'user_profile';
}
