<?php
class Error
{
	//define ERROR code
	public $error = array(
		'0'=>'Success',
		'1'=>'NotFind',
		'400'=>'BadRequest',
		'401'=>'Unauthorized',
	
		'5009'=>'UserNotExists',
		'5008'=>'UserBaned',
		'5007'=>'UserLogoff',	
		'5000'=>'NotInWhiteList',
	
		'8000'=>'Spam',
		'8001'=>'MessageTooLong',
		'8002'=>'MessageIsDelte',
		
	);
	/**
	 * return error info by error code
	 * 
	 * @param int $code
	 */
	public static function  error($code)
	{
		return self::$error[$code];	
	}
}
	