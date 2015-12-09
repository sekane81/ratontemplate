<?php
require_once('../../../wp-load.php');

$admin_email = get_bloginfo('admin_email');
define("WEBMASTER_EMAIL", $admin_email);

//define("WEBMASTER_EMAIL", 'your@domain.com'); // Enter yor e-mail
 
error_reporting (E_ALL); 
 
if(!empty($_POST))
{
$_POST = array_map('trim', $_POST); 
$name = htmlspecialchars($_POST['name']);
$email = $_POST['email'];
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);
 
$error = array();
 
 
if(empty($name))
{
$error[] = 'Please enter your name';
}
 
 
if(empty($email))
{
$error[] = 'Please enter your e-mail';
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
{ 
$error[] = 'e-mail is incorrect';
}
 
 
if(empty($message) || empty($message{15})) 
{
$error[] = "Please enter message more than 15 characters";
}
 
if(empty($error))
{ 
$message = 'Name: ' . $name . '
Email: ' . $email . '
Subject: ' . $subject . '
Message: ' . $message;
$mail = mail(WEBMASTER_EMAIL, 'Message from Rule WordPress Theme', $message,
     "From: ".$name." \r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());
 
if($mail)
{
echo 'OK';
}
 
}
else
{
echo '<div class="alert alert-error fade in animate"><button type="button" class="close" data-dismiss="alert">&times;</button>'.implode('<br />', $error).'</div>';
}
}