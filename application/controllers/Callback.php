<?php /**
 * 
 */
class Callback extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (isset($_GET['status'])){
		    if ($_GET['status'] == 'success'){
		        $result_data = $this->execute($_GET['paymentID']);
		        $response = json_decode($result_data, true);
		        
		        if(isset($response['statusCode']) && $response['statusCode'] != '0000'){
		            // Error case
		            echo $response['statusMessage'];
		            
		            exit;
		        }else{
		            // db insert operation strore $response data
		            echo "<pre>";
		        	print_r($response);
		            
		        //header("Location: success.php?trxID=".$response['trxID']); 
		        exit;
		        }
		    }else{
		    	echo "Payment Failed";
		        exit;
		    }
		}
	}

	public function execute($paymentID) 
	{
		$credentials_arr = $this->config->item('credentials');
	    //global $credentials_arr;

	    $post_token = array(
	        'paymentID' => $paymentID
	    );
	    
	    $url = curl_init($credentials_arr['base_url']."/checkout/execute");
	    $post_token = json_encode($post_token);
	    $header = array(
	        'Content-Type:application/json',
	        'Authorization:'. $_SESSION["token"],
	        'X-APP-Key:'.$credentials_arr['app_key']
	    );
	    
	    curl_setopt($url, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,FALSE);
	    curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
	    curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
	    $result_data = curl_exec($url);
	    curl_close($url);
	    
	    return $result_data;
	} 
}