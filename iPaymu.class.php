<?php 
	namespace App\Http\Utilities;
	class iPaymu
	{
		public $apiKey;
		public $redirectURL;
		public $sessionID;

		function __construct($apiKey='')
		{
			$this->setApiKey($apiKey);
			$this->checkBalance();
			$this->checkStatus();
		}

		public function getRedirectURL()
		{
			return $this->redirectURL;
		}

		public function getSessionID()
		{
			return $this->sessionID;
		}

		public function setApiKey($apiKey=null)
		{
			if ($apiKey!=null) {
				$this->apiKey = $apiKey;
				$this->apiValid();
			}
		}

		public function apiValid()
		{
			$result = file_get_contents("https://my.ipaymu.com/api/CekSaldo.php?key=".$this->apiKey."&format=json");
			if (isset($result->Status)) {
				if ($result->Status=="-1001") {
					throw new \Exception($result->Keterangan, $result->status);
				}
				else
				{
					return true;
				}
			}

			return true;
		}

		
		public function setTransaction($params=array())
		{
			$params['key'] 	= $this->apiKey;
			$params['format'] 	= "json";

			$url = 'https://my.ipaymu.com/payment.htm';
			$params_string = http_build_query($params);
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, count($params));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			 
			$request = curl_exec($ch);
			 
			if ( $request === false ) {
			    echo 'Curl Error: ' . curl_error($ch);
			} else {
			    $result = json_decode($request);

			    if( isset($result->url) )
			    	$this->redirectURL = $result->url;
			    	$this->sessionID = $result->sessionID;
			        return true;
				}

				return false;
			
			curl_close($ch);
		}

		public static function transaction($params=array(), $apiKey)
		{	
			$instance 	=	new static($apiKey);

			$params['key'] 	= $apiKey;
			$params['format'] 	= "json";

			$url = 'https://my.ipaymu.com/payment.htm';
			$params_string = http_build_query($params);
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, count($params));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			 
			$request = curl_exec($ch);
			 
			if ( $request === false ) {
			    echo 'Curl Error: ' . curl_error($ch);
			} else {
			    $result = json_decode($request);

			    if( isset($result->url) )
			    	$instance->redirectURL = $result->url;
			    	$instance->sessionID = $result->sessionID;
			        return $instance;
				}

				return false;
			
			curl_close($ch);
		}

		public function checkTransaction($id)
		{
			return json_decode(file_get_contents("https://my.ipaymu.com/api/CekTransaksi.php?key=".$this->apiKey."&id=$id&format=json"));
		}

		public function checkBalance()
		{
			$balance = json_decode(file_get_contents("https://my.ipaymu.com/api/CekSaldo.php?key=".$this->apiKey."&format=json"));
			return $balance->Saldo;
		}

		public function checkStatus()
		{
			$balance = json_decode(file_get_contents("https://my.ipaymu.com/api/CekStatus.php?key=".$this->apiKey."&format=json"));
			return $balance->StatusUser;
		}
	}
?>
