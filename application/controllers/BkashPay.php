<?php /**
 * 
 */
class BkashPay extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function getToken()
	{
		$credentials_arr = $this->config->item('credentials');
		$post_token = array(
        'app_key' => $credentials_arr['app_key'],
        'app_secret' => $credentials_arr['app_secret']
	    );
	    $url = curl_init($credentials_arr['base_url']."/checkout/token/grant");
	    $post_token = json_encode($post_token);
	    $header = array(
	        'Content-Type:application/json',
	        "password:". $credentials_arr['password'],
	        "username:". $credentials_arr['username']
	    );
	    
	    curl_setopt($url, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,FALSE);
	    curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
	    curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
	    $result_data = curl_exec($url);
	    curl_close($url);
	        
	    $response = json_decode($result_data, true);

	    $this->session->set_userdata("token",$response['id_token']);

	    return $response['id_token'];
	}

	public function create()
    { 
    	$credentials_arr = $this->config->item('credentials');
        $this->getToken();
        //global $credentials_arr;
        $post_token = array(
            'mode' => '0011',
            'amount' => $_POST['amount'] ? $_POST['amount'] : 1,
            'payerReference' => " ",
            'callbackURL' => base_url('Callback'), // Your callback URL
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => 'INV'.rand()
        );

        $url = curl_init($credentials_arr['base_url']."/checkout/create");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'Authorization:'. $this->session->userdata("token"),
            'X-APP-Key:'. $credentials_arr['app_key']
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $result_data = curl_exec($url);
        curl_close($url);

        $response = json_decode($result_data, true);
        return redirect($response['bkashURL']);

        //header("Location: ".$response['bkashURL']); 
        exit;
    }   
}