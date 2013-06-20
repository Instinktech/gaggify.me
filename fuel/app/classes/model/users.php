<?php
use Orm\Model;
use Fuel\Core\DB;

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

    public function loadWithFacebookId($fb_id) {
        $data = DB::select()->from('users')
            ->join('user_profile','LEFT')->on('users.id','=','user_profile.id')
            ->execute()->as_array();

        if ( !empty ($data)) {
            return array_shift($data);
        }

        return array();
    }
}
