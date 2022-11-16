
<?php
// Initializing Error Variables To Null.
$lastnameError ="";
$firstnameError ="";
$emailError ="";
$passwordError ="";
$usernameError="";

// This code block will execute when form is submitted
if(isset($_POST['submit'])){
/*--------------------------------------------------------------
Fetch name value from URL and Sanitize it
--------------------------------------------------------------*/
if($_POST['name'] != ""){
// Sanitizing name value of type string
$_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$nameError = "<span class="valid">"".$_POST['name']."" </span>is Sanitized an Valid name.";
if ($_POST['name'] == ""){
$nameError = "<span class="invalid">Please enter a valid name.</span>";
}
}
else {
$nameError = "<span class="invalid">Please enter your name.</span>";
}
/*------------------------------------------------------------------
Fetch email value from URL, Sanitize and Validate it
--------------------------------------------------------------------*/
if($_POST['email'] != ""){
//sanitizing email
$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//After sanitization Validation is performed
$_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$emailError = "<span class="valid">"".$_POST['email']."" </span>is Sanitized an Valid Email.";
if($_POST['email'] == ""){
$emailError = "<span class="invalid">Please enter a valid email.</span>";
}
}
else {
$emailError = "<span class="invalid">Please enter your email.</span>";
}
/*---------------------------------------------------------------------------
Fetch website value from URL, Sanitize and Validate it
----------------------------------------------------------------------------*/
if($_POST['website'] != ""){
//sanitizing URL
$_POST['website'] = filter_var($_POST['website'], FILTER_SANITIZE_URL);
//After sanitization Validation is performed
$_POST['website'] = filter_var($_POST['website'], FILTER_VALIDATE_URL);
$websiteError = "<span class="valid">"".$_POST['website']."" </span>is Sanitized an Valid Website URL.";
if ($_POST['website'] == ""){
$websiteError = "<span class="invalid">Please enter a valid website start with http:// </span>";
}
}
else {
$websiteError = "<span class="invalid">Please enter your website URL.</span>";
}
}
?>

