<?php
namespace phpmailer;
use phpmailer\Phpmailer;
use phpmailer\Smtp;

class Email
{
	public function send($email, $name, $title, $content)
	{
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server  
		$mail->Host = config('email.Host'); //SMTP服务器: smtp.126.com
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 25;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$mail->Username = config('email.Username');  //SMTP邮箱
		//Password to use for SMTP authentication 
		$mail->Password = config('email.Password');  //授权密码
		//Set who the message is to be sent from
		$mail->setFrom(config('email.setFrom_email'), config('email.setFrom_name'));	//发送者
		//Set an alternative reply-to address
		//$mail->addReplyTo('replyto@example.com', 'First Last');
		//Set who the message is to be sent to
		$mail->addAddress($email, $name);  //收件者
		//Set the subject line
		$mail->Subject = $title;	//标题
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($content);	//内容
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');

		//send the message, check for errors
		if (!$mail->send()) {
			return ['code'=>0, 'msg'=>$mail->ErrorInfo];
		} else {
			return ['code'=>1, 'msg'=>'Message sent success!'];
		}
		
	}
}