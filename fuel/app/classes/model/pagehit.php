<?php
use Orm\Model;

class Model_Pagehit extends \Orm\Model
{
	protected static $_properties = array(
        'gag_id',
        'user_id',
        'referer',
        'utm_src',
        'utm_cookie',
        'utm_inat',
        'utm_outat',
        'utm_addr',
        'utm_agent',
        'hit_on'
	);

    protected static $_table_name = 'analy_pagehits';
}
