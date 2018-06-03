<?php

//get the form fields, remove html tags, and white space.
$name = strip_tags(trim($_POST['name']));
$name = str_replace(array('\r', '\n'),array(' ', ' '), $name);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$message = trim($_POST['message']);

//check data
if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header('Location: http://.../omnifood/index.php?success=-1#form');
	exit;
}

// my email to send to
$recipient = 'analyticrye@gmail.com';

// set email subject
$subject = 'New contact from $name';

//build the email content
$email_content = 'Name: $name\n';
$email_content .= 'Email: $email\m\n';
$email_content .= 'Message:\n$message\n';

//build the email headers
$email_headers = 'From $name <$email>';

//send email
mail($recipient, $subject, $email_content, $email_headers);
	//redirect to the index.html page with success code
	header('Location: http://.../omnifood/index.php?success=1#form');

?>