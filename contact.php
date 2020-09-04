<?php



if(!$_POST) exit;



function tommus_email_validate($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); }


$name = $_POST['name']; $email = $_POST['email']; $phone = $_POST['phone']; $comments = $_POST['comments'];



if(trim($name) == '') {

	exit('<div class="error_message">Entrez votre nom svp.</div>');

} else if(trim($name) == 'Nom') {

	exit('<div class="error_message">Entrez votre nom svp.</div>');

} else if(trim($email) == '') {

	exit('<div class="error_message">Entrez votre e-mail svp.</div>');

} else if(!tommus_email_validate($email)) {

	exit('<div class="error_message">Entrez un e-mail valide svp.</div>');

} else if(trim($comments) == 'Message...') {

	exit('<div class="error_message">Entrez votre message svp.</div>');

} else if(trim($comments) == '') {

	exit('<div class="error_message">Entrez votre message svp.</div>');
	
} else if( strpos($comments, 'href') !== false ) {

	exit('<div class="error_message">Please leave links as plain text.</div>');
	
} else if( strpos($comments, '[url') !== false ) {

	exit('<div class="error_message">Svp laissez les liens en mode texte.</div>');

} if(get_magic_quotes_gpc()) { $comments = stripslashes($comments); }



$address = 'mkaram@videotron.ca';



$e_subject = 'MK.NET: ' . $name . '.';

$e_body = "Message:" . "\r\n" . "\r\n";

$e_content = "\"$comments\"" . "\r\n" . "\r\n";

$e_reply = "Contact $name au : $email";



$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );



$headers = "From: $email" . "\r\n";

$headers .= "Reply-To: $email" . "\r\n";

$headers .= "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type: text/plain; charset=utf-8" . "\r\n";

$headers .= "Content-Transfer-Encoding: quoted-printable" . "\r\n";



if(mail($address, $e_subject, $msg, $headers)) { echo "<fieldset><div id='success_page'><p>Envoyé, merci !</p></div></fieldset>"; }