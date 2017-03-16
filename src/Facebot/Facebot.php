<?php

namespace Facebot;


class Facebot



{
	
	/**
	 * @var string
	 */
	protected $access_token;
	
	/**
	 * @var string
	 */
	protected $verify_token;


	/**
	 * @param string             $name       The logging channel
	 * @param HandlerInterface[] $handlers   Optional stack of handlers, the first one in the array is called first, etc.
	 */
	
	public function __construct($access_token, $verify_token)
	{
		$this->access_token = $access_token;
		$this->verify_token = $verify_token;
		
	}

}


