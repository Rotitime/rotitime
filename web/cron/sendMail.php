<?php
$servername = "localhost";
$username = "mirzasaf_rotitim";
$password = "rotiTime20200727";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mirzasaf_rotitime", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $numOfRows = "Connected successfully";
  } catch(PDOException $e) {
    $numOfRows =  "Connection failed: " . $e->getMessage();
  }

  $stmt = $conn->prepare("SELECT *  
  FROM 
	  rt_restaurant_orders 
  WHERE
	  ordered_at < DATE_SUB(NOW(), INTERVAL '2' HOUR)
	  && is_request_for_review_email_sent = 'N'");
  $stmt->execute();
  // set the resulting array to associative
  $resultStmt= $stmt->fetchAll();
  
  foreach($resultStmt as $res) {
    
    $user_id = $res['ordered_by']; 
    $fetchQuery = $conn->prepare("SELECT * FROM rt_users WHERE user_id  = ".$user_id);
    $fetchQuery->execute();
    $userDetails = $fetchQuery->fetch();
    
    $toEmail = $userDetails['user_email'];
    $userName = $userDetails['user_name'];

    
		$from = 'info@rotitime.com';
		
		 // To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Cc: anriys.info@gmail.com' . "\r\n";
		
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$secretToken = "secretToken=".base64_encode($res['order_id']."###".$res['ordered_restaurant_id']);
		$mailLink = "https://zefasa.com/rotitime/site/order-review?".$secretToken;
        $Message = '
		<!doctype html>
		<html lang="en">
		  <head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
			<title>Review</title>
		  </head>
		  <body>
		
		
			<table style="width:375px;background-color:rgb(250,250,250);border-collapse:collapse!important;text-align:left"> 
				<tbody>
				 <tr> 
				  <td style="padding-left:17px;padding-right:18px;padding-top:23px;padding-bottom:21px;border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href=""> 
					<table style="margin-bottom:20px;width:100%;min-width:338px;border-collapse:collapse!important;text-align:left"> 
					 <tbody>
					  <tr> 
					   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif" align="center"> 
						 <img src="http://zefasa.com/rotitime/web/img/logo1.png" alt="www.amazon.in" title="www.amazon.in" style="width:211px" class="CToWUd" width="211" border="0"> 
						 </td> 
					  </tr> 
					 </tbody>   
					</table> </a> 
				   <table style="background-color:rgb(255,255,255);border-left:1px solid rgb(214,214,214);border-right:1px solid rgb(214,214,214);border-bottom:1px solid rgb(214,214,214);border-top:2px solid rgb(206,206,206);border-collapse:collapse!important;text-align:left"> 
					<tbody>
					 <tr> 
					  <td style="padding-left:23px;padding-right:23px;padding-top:25px;padding-bottom:33px;border-collapse:collapse!important;font-family:Arial,sans-serif"> 
					   <table style="font-size:20px;line-height:24px;color:rgb(0,46,54);margin-bottom:18px;border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr> 
						  <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"><span>Hi '.$userName.',</span> </td> 
						 </tr> 
						</tbody>
					   </table> 
						
						
					   <table style="font-size:18px;line-height:24px;color:rgb(0,46,54);border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr> 
						  <td style="padding-bottom:18px;border-collapse:collapse!important;font-family:Arial,sans-serif"><span>Your package has been delivered!</span> </td> 
						 </tr> 
						</tbody>
					   </table> 
						
						
						
					   <table style="font-size:18px;line-height:24px;color:rgb(0,46,54);border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr> 
						  <td style="padding-bottom:2px;border-collapse:collapse!important;font-family:Arial,sans-serif"><span>Please rate your delivery experience.</span> </td> 
						 </tr> 
						</tbody>
					   </table> 
						
						
						
					   <table style="border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr>
						  <td style="padding-top:10px!important;border-collapse:collapse!important;font-family:Arial,sans-serif"></td>
						 </tr> 
						 <tr> 
						  <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'"> 
							<table style="height:45px!important;width:397px!important;max-width:397px!important;display:block;border-collapse:collapse!important;text-align:left"> 
							 <tbody>
							  <tr width="400" style="line-height:18px;color:rgb(17,17,17);font-size:16px;text-decoration:none;vertical-align:middle" valign="middle" height="50" bgcolor="ffa723" align="center"> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif" width="90"></td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'"> <img  src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd" align="middle"> </a> </td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd" align="middle"> </a> </td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img  src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd" align="middle"> </a> </td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'" style="color:rgb(0,46,54);text-decoration:none" target="_blank" > <img  src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd" align="middle"> </a> </td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"> <a href="'.$mailLink.'" style="color:rgb(0,46,54);text-decoration:none" target="_blank"> <img src="https://ci3.googleusercontent.com/proxy/TbFGNKIrU4P4jrefYJ8xnk1kpkxXTbgDZQlGUlHgT9MCPI8ExA3M2SSmpnoJQcHoa8WZoOqrCHVPQQn7sfAgZljm_ZsKupHOWN9vyFUOi_pTvYrvQhpToWskrr7Nh__oa4M=s0-d-e1-ft#http://g-ecx.images-amazon.com/images/G/31/A2I/star_unfilled._CB531035208_.png/" class="CToWUd" align="middle"> </a> </td> 
							   <td style="border-collapse:collapse!important;font-family:Arial,sans-serif" width="90"></td> 
							  </tr> 
							 </tbody>
							</table> </a> </td> 
						 </tr> 
						 <tr>
						  <td style="padding-top:30px!important;border-collapse:collapse!important;font-family:Arial,sans-serif"></td>
						 </tr> 
						</tbody>
					   </table> 
						
		
						
		 
						
					   <table style="border-left:0;border-right:0;border-top:0;border-bottom:0;border-collapse:collapse!important;text-align:left" width="100%" cellspacing="0" cellpadding="0" border="0"> 
						<tbody>
						 <tr> 
						  <td style="width:5px;font-size:1px;border-collapse:collapse!important;font-family:Arial,sans-serif"> &nbsp; </td> 
						  <td style="width:284px;min-width:284px;background:none;border-top:0px;border-right:0px;border-left:0px;border-bottom:1px solid rgb(135,149,150);height:1px;margin:0px 0px 0px 0px;font-size:1px;border-collapse:collapse!important;font-family:Arial,sans-serif"> &nbsp; </td> 
						  <td style="width:5px;font-size:1px;border-collapse:collapse!important;font-family:Arial,sans-serif"> &nbsp; </td> 
						 </tr> 
						</tbody>
					   </table> 
					   <div style="font-size:18px">
						&nbsp;
					   </div> 
					   <table style="border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr> 
						  <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"><span style="font-size:9px;line-height:15px;color:rgb(134,134,134)"><a style="text-decoration:none;font-size:9px;line-height:15px;color:rgb(134,134,134);display:inline-block" href="#">Thankyou</a>.</span> </td> 
						 </tr> 
						</tbody>
					   </table> 
					   <table style="font-size:9px;line-height:15px;color:rgb(134,134,134);border-collapse:collapse!important;text-align:left"> 
						<tbody>
						 <tr> 
						  <td style="border-collapse:collapse!important;font-family:Arial,sans-serif"><span style="font-size:9px;line-height:15px;color:rgb(134,134,134)">This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.</span> </td> 
						 </tr> 
						</tbody>
					   </table> </td> 
					 </tr> 
					</tbody>
				   </table> </td> 
				 </tr> 
				</tbody>
			   </table> 
		  </body>
		</html>
		';

		$ToEmailId = $toEmail.',mirzasafdar@gmail.com';
		$Subject = 'Review your RotiTime Order';
        $emailSent = mail($ToEmailId, $Subject, $Message, $headers);

        $fetchQuery = $conn->prepare("UPDATE rt_restaurant_orders SET is_request_for_review_email_sent = 'Y', request_for_review_email_sent_at = NOW() WHERE order_id  = ".$res['order_id']);
        $fetchQuery->execute();
		
  }
  
		
		
		/*$RtScheduledMethods = new RtScheduledMethods();
        $RtScheduledMethods->fnRequestReviewEmailSent();*/
		
		
?>