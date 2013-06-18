<?php
use Orm\Model;

class Model_Users extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'fb_id',
        'username',
        'is_verified',
        'email',
        'locale',
        'created_on',
        'host_ip'
	);

    protected static $_table_name = 'users';
}
