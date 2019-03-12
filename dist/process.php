<? 

header("Access-Control-Allow-Origin: *");
session_start(); 

class GenericCurl {

    private $host = 'http://demo.infiny.cloud'; 
    public $headers = false; 
    public $url;
    
    public function post($data)
    {
        $endpoint = $data['endpoint']; 
        $this->url = $this->host.$endpoint; 

        $postfields = $data['postfields']; 

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        if($this->headers)
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers); 
        }

        

        $result = curl_exec($ch);

        if(curl_errno($ch))
        {
            return curl_error($ch);
        }
        return $result;
    }

    public function get($data){

        $endpoint = $data['endpoint']; 
        $this->url = $this->host.$endpoint; 

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if($this->headers)
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers); 
        }

        

        $result = curl_exec($ch);

        if(curl_errno($ch))
        {
            return curl_error($ch);
        }

        return $result;
    }

    public function setHeaders($headersArray)
    {
        foreach($headersArray as $headers)
        {
            $this->headers[] = $headers; 
        }
    }
}

class Infiny {

    private $client_id = 'C2lSiitXDHufsOvyWrDs0Otnwpu9wuab11yCRlxD';
    private $client_secret = 'Okbal1wXMvn34Tr9aKyRKDedrgQ2a4DorVFmg4ZI';

    public $access_token; 
    public $refresh_token; 


    function __construct(){

        /* We've not authenticated, so do this first */ 
        if( !isset($_SESSION['access_token']) || ($_SESSION['access_token'] === NULL)){
        	
            $this->authenticate(); 
        }
        /* we have authenticated, but token has expired */ 
        else if($this->needsRefresh())
        {

        }

    }

    public function decode_response($data)
    {
        return json_decode($data); 
    }   

    public function authenticate(){
        $req = new GenericCurl; 

        $request_array = array (
            'endpoint' => '/api/oauth2/access-token',
            'postfields' => array(
                'grant_type' => 'client_credentials',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret
            )
        ); 

        $req->setHeaders( array(
            'Accept: application/vnd.cloudlx.v1+json'
        )); 

        $result = $req->post($request_array); 
        $result = $this->decode_response($result); 

        if($result->access_token)
        {
            $_SESSION['access_token'] = $result->access_token;
            $_SESSION['expires_in'] = $result->expires_in;
            $_SESSION['refresh_token'] = $result->refresh_token; 

            $this->access_token = $_SESSION['access_token'];
            $this->refresh_token = $_SESSION['refresh_token']; 


            return true; 
        }

    }

    /* set an expiry date for the token so we can check if it has expires */ 
    public function setExpires($expiry)
    {

    }

    /* check to determine whether the access token has expired */ 
    /* return false for testing as token hasn't expired */
    public function needsRefresh(){
        return false; 
    }

    public function getData($data)
    {
    	
        $request_array = array(
            'endpoint' => $data['endpoint'],
        ); 

        $headers = array(
            'Accept: application/vnd.cloudlx.v1+json',
            'Authorization: Bearer '.$_SESSION['access_token'].'' 
        ); 

        $req = new GenericCurl; 
        $req->setHeaders($headers); 

        

        $res = $req->get($request_array); 

        return $res; 
    }

}


if(isset($_GET['endpoint']))
{


	$endpoint = $_GET['endpoint']; 

	$data = array(
		'endpoint'=> $endpoint
	); 

	$infiny = new Infiny; 
	$result = $infiny->getData($data); 

	echo $result; 


	/* Test Data */
	/**
	*
	if($_GET['endpoint'] == '/api/services')
	{
		echo file_get_contents('test-data.json');
	}
	else if($_GET['endpoint'] == '/api/services/2017/graph/bandwidth'){
		echo file_get_contents('test-graph.json');
	}
	else {
		echo file_get_contents('test-service.json');
	}
	*/
}