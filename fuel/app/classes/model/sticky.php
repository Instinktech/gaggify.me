<?php
use Orm\Model;

class Model_Sticky extends \Orm\Model
{
	protected static $_properties = array(
        'sticky_id',
        'gag_id',
        'user_id',
        'sticked_on'
	);

    protected static $_table_name = 'stickies';
}
