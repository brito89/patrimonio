<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Datetime
 *
 * returns current time stamp in mysql format
 *
 * @access	public
 * @return	string	datetime
 */
 
if (! function_exists('datetime'))
{
	function datetime()
	{
		return date('Y-m-d H:i:s');
	}
}