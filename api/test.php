<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("muneeburrehman103@gmail.com","Testemail from topchef.pk",$msg);
echo "email sent";
?>