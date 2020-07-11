<?php
include  "newsletter/phpmailer/src/PHPMailer.php";
include  "newsletter/phpmailer/src/Exception.php";
include  "newsletter/phpmailer/src/OAuth.php";
include  "newsletter/phpmailer/src/POP3.php";
include  "newsletter/phpmailer/src/SMTP.php";
require('newsletter/connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);    
$mail->IsSMTP();
// $mail->SMTPDebug = 2;
$mail->CharSet = "utf-8";
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "huy.tu.k17.bk@gmail.com";
$mail->Password = "ilovegunny";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom($_POST["userEmail"], $_POST["userName"]);
$mail->AddReplyTo($_POST["userEmail"], $_POST["userName"]);
// $mail->AddAddress("trantuananh100119999@gmail.com");	
$mail->Subject = $_POST["subject"];
// $mail->WordWrap   = 80;
$mail->MsgHTML($_POST["content"]);
// $mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// );

foreach ($_FILES["attachment"]["name"] as $k => $v) {
	$mail->AddAttachment( $_FILES["attachment"]["tmp_name"][$k], $_FILES["attachment"]["name"][$k] );
}

$sql = "SELECT * FROM users";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row){
	// var_dump($row['EMAIL']);
	$mail->AddAddress($row['Email']);
}



$mail->IsHTML(true);
// $mail->send();

if(!$mail->Send()) {
echo "<script>
   alert('Thông báo không thể gửi! Vui lòng kiểm tra lại. ');
   window.location.href='newsletter.php';
   </script>";
} else {
echo "<script>
    alert('Gửi thành công!');
    window.location.href='newsletter.php';
    </script>";
    
}	
?>