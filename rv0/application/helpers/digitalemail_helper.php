<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$d = '';
 
    function CallAPI($url, $data = false,$method='POST')
    {
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // Optional Authentication:
       // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    function isLive()
    {
		     
		//DigitalAPI ADDRESS BASE API ADDRESS / END_POINT 
		$url = "https://www.digitalapi.com/api/v1/isLive";     
		//API DATA ARRAY
		$data = array('apiKey'=> DigitalApiKey );  
		//Now initiate cURL
		$response=  CallAPI($url,$data); //in response you will get jSon data
		//Show the response in a formated array  
		$decoded_data=  json_decode($response);
		if($decoded_data->api_status=='Live')
		{
			return  $response;
		}
		return false;
	}
	
	function creditsLeft($type)
	{
		//DigitalAPI ADDRESS BASE API ADDRESS / END_POINT 
		$url = "https://www.digitalapi.com/api/v1/getCreditStatus";     
		//API DATA ARRAY
		$data = array('apiKey'=> DigitalApiKey );  
		//Now initiate cURL
		$response=  CallAPI($url,$data); //in response you will get jSon data
		//Show the response in a formated array  
		$decoded_data=  json_decode($response);
		$response = array();
		if($decoded_data->response==200)
		{
		    $credits = 0;
			if($type=='email')
			{
			    $credits = $decoded_data->credits->service_credits->sendMail->credits;
		    }else if($type=='sms') 
		    {
				$credits = $decoded_data->credits->service_credits->sendMessage->credits;
		    } 
		    
			 
			if($credits>=1)
			 return true;
			 else
			 return false;
			 
		}else
		return false;
	}
	
	
	function sendMail($maildata)
	{
		
		
		        $to = $maildata['email'];
		        $subject = $maildata['subject'];
		        $message = $maildata['message'];
		        $fromEmail = FROM_EMAIL ;
		        $fromName = FROM_NAME ;
		        
		       
				//DigitalAPI ADDRESS BASE API ADDRESS / END_POINT 
				$url = "https://www.digitalapi.com/api/v1/sendMail";     
				//Your post data / fabricated data
				$parameterarray=array(
								'message'=> $message,
								'subject'=> $subject,
								'to_mail'=> $to,
								'from_mail'=> $fromEmail,
								'reply_to'=> $fromEmail,
								'from_name'=> $fromName,
								'to_name'=> $maildata['first_name'].' '.$maildata['last_name'],
								'type'=>'t',
								/*'attachment'=>'1',
								'attachment_path'=>'https://pbs.twimg.com/profile_images/638751551457103872/KN-NzuRl.png',
								'attachment_name'=>'Googlenewlogo.jpg',
								'attachment_type'=>'image/jpeg',*/
								); 
								   
				//Json encode to prepare data string
				$jsonencoded_data=  json_encode($parameterarray);print_r($jsonencoded_data);exit;
				//API DATA ARRAY
				$data = array('apiKey'=>DigitalApiKey,'data'=>$jsonencoded_data);  
				//Now initiate cURL
				$response=  CallAPI($url,$data); //in response you will get jSon data
				$decoded_data=  json_decode($response); 
		        return $decoded_data;
				 
		    
	}
 
	function sendSms($maildata)
	{
		
		
		        $country = $maildata['country'];
		        $number = $maildata['number'];
		        $message = $maildata['message'];
		        
		        
		       
				//DigitalAPI ADDRESS BASE API ADDRESS / END_POINT 
				$url = "https://www.digitalapi.com/api/v1/sendMessage";     
				//Your post data / fabricated data
				$parameterarray=array(
								'country'=>'91',
								'number'=>$number,
								'message'=>$message, 
								'type'=>'transactional' 
								); 
								   
				//Json encode to prepare data string
				$jsonencoded_data=  json_encode($parameterarray);
				//API DATA ARRAY
				$data = array('apiKey'=>DigitalApiKey,'data'=>$jsonencoded_data);  
				//Now initiate cURL
				$response=  CallAPI($url,$data); //in response you will get jSon data
				$decoded_data=  json_decode($response); 
		        return $decoded_data;
				 
		    
	}
 
