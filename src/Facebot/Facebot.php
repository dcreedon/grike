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
	 * @var string
	 */
	protected $hub_verify_token;
	
	/**
	 * @var string
	 */
	protected $challenge;


	/**
	 * @param string             $name       The logging channel
	 * @param HandlerInterface[] $handlers   Optional stack of handlers, the first one in the array is called first, etc.
	 */
	
	public function __construct($access_token, $verify_token)
	{
		$this->access_token = $access_token;
		$this->verify_token = $verify_token;
		$this->hub_verify_token = null;
		$this->challenge = null;
		
	}
	
	public function requestType($query){
		
		//$query = $request->getQueryParams();
		
		$requestType = $query['hub_mode'];
				
		return $requestType;
	}
	
	public function parseRequest($request){
		
		$query = $request->getQueryParams();
		
		//Subscription Request from FB
		if (requestType($query) === 'subscribe' ){

			setChallenge($query['hub_challenge']);
			setHubVerifyToken($query['hub_verify_token']);		
			$newResponse = $this->subscriptionResponse();			
		}
		
		return $newResponse;
		
	}
	
	
	public function checkToken($hub_verify_token){

		if ($hub_verify_token === $this->$verify_token) {
			$result = true;
		}else{
			$result = false;
		}

		return $result;
	}
		
	public function subscriptionResponse(){
		
		if (checkToken(getHubVerifyToken())) {
		
			$this->logger->addInfo("Challenge: $challenge");
			$body = $response->getBody();
			$body->write($challenge);
			$newResponse = $response->withBody($body);
		
			$newResponse = $response->withStatus(200);
		}else{
			$newResponse = $response->withStatus(500);
		}
		
		
		return $newResponse;
	}
	
	
	public function setHubVerifyToken($hub_verify_token){
		$this->hub_verify_token = $hub_verify_token;
		return $this;
	}
	
	public function getHubVerifyToken(){
		return $this->hub_verify_token;
	}
	
	public function setChallenge($challenge){
		$this->challenge = $challenge;
		return $this;
	}

}



