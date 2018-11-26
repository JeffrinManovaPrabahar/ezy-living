<?php
	require_once "PHPMailer/PHPMailerAutoload.php";
	session_start();
	if (empty($_SESSION['code']) || strtolower(trim($_REQUEST['verification'])) != $_SESSION['code']) {
		echo '{"success": false,"msg": "Invalid Captcha"}';
	} else {
		$to = 'ashok@ezyliving.in';
 		$subject = "User quotes for Ezy Living";
		$message = '
		<html>
		<head><title>HTML email</title></head>
		<body>
		 <table border="0" cellpadding="1" cellspacing="2" width="500" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
  		<tr><td style="height:40px;background-color:#FFDFDF;font-weight:bold;" align="center" colspan="2">Enquiry Details</td></tr>
	  <tr>
		<td style="height:30px;width:150px; background-color:#C1FFC1;padding-right:10px;font-weight:bold;" align="right">Name</td>
		<td style="height:30px;width:300px; background-color:#C1FFC1;padding-left:10px;">'.$_POST['name'].'</td>
	  </tr>
	  <tr>
		<td style="height:30px;width:150px; background-color:#C1FFC1;padding-right:10px;font-weight:bold;" align="right">Mobile No</td>
		<td style="height:30px;width:300px; background-color:#C1FFC1;padding-left:10px;">'.$_POST['mobileno'].'</td>
	  </tr>
	  <tr>
		<td style="height:30px;width:150px; background-color:#C1FFC1; padding-right:10px;font-weight:bold;" align="right">Email</td>
		<td style="height:30px;width:300px; background-color:#C1FFC1;padding-left:10px;">'.$_POST['email'].'</td>
	  </tr>
	  <tr>
		<td style="height:30px;width:150px; background-color:#C1FFC1;padding-right:10px;font-weight:bold;" align="right">Message</td>
		<td style="height:30px;width:300px; background-color:#C1FFC1;padding:3px 10px;">'.$_POST['message'].'</td>
	  </tr>
	</table></body></html>';
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		
		$mail->Host = "cp-in-15.webhostbox.net";
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = "hello@ezyliving.in";
		$mail->Password = "april@1978";
		$mail->SetFrom("hello@ezyliving.in");
		$mail->AddAddress($to);
		$mail->AddCC("ashokg25@gmail.com");
		$mail->Priority = 1;
		$mail->AddCustomHeader("X-MSMail-Priority: High");
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body   = $message;
		if(!$mail->Send()) {
			echo '{"success": false,"msg": "Some error"}';
		} else {
			echo '{"success": true}';
		}
		$mail->ClearAddresses();
		unset($_SESSION['captcha']);
	}
	
	
?>