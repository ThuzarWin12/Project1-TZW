<!DOCTYPE html>
<?php if(isset($_POST['send'])){ 
$from = $_POST['femail']; 
$phoneno = $_POST['phoneno']; 
$message = $_POST['message']; 
$carrier = $_POST['carrier']; 
if(empty($from)){ 
echo("enter the email");
 exit(); 
}else if(empty($phoneno)){ 
echo("enter the phone no"); 
exit(); 
} elseif(empty($carrier)){
echo("enter the specific carrier"); 
exit(); 
} elseif(empty($message)){ 
echo("enter the message"); 
exit(); }else{ 
$message = wordwrap($message, 70); 
$header = $from; 
$subject = 'from submission'; 
$to = $phoneno.'@'.$carrier; 
$result = mail($to, $subject, $message, $header); 
echo(" ".$message ."  message sent to  ".$to ); 
} 
} 
?>
<html>
<head>
<meta charset="utf-8">
<title>SMS </title>
</head>
<body>
<form action="textmessage.php" method="post">
<table align="center">
<tr>
<td>From:</td>
<td><input type="email" name="femail" placeholder="thuzar.win@live.com"></td>
</tr>
<tr>
<td>Phone Number:</td>
<td><input type="text" name="phoneno" placeholder="enter 10 digit phone no"></td>
</tr>
<tr>
<td>carrier:</td>
<td>
<input list="carriers" name="carrier" placeholder="select the phone carrier. ">
<datalist id="carriers">
    <option value="vtext.com">
    <option value="txt.att.net">
    <option value="sms.myboostmobile.com">
    <option value="tmomail.net">
    <option value="email.uscc.net">
	<option value="messaging.sprintpcs.com">
	<option value="vmobl.com">
  </datalist>
 </input>

</td>
<td>
</td>

</tr>
<tr>
<td>Message:</td>
<td><textarea rows="6" cols="50" name="message"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="send" name="send"</td>
</tr>
</table>
</form>
</body>
</html>