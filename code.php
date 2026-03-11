<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token){

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//$mail->SMTPDebug=2;

$mail->isSMTP();                                            
$mail->SMTPAuth = true;     

$mail->Host = 'smtp.gmail.com'; 
$mail->Username   = 'puhanasatyajit@gmail.com';  
$mail->Password="sgddudfjbozunerl";

$mail->SMTPSecure = "tls";            
$mail->Port = 587; 

$mail->setFrom('puhanasatyajit@gmail.com',$name);
$mail->addAddress($email);

$mail->isHTML(true);                                  
$mail->Subject = 'Email verification from Wooble';

$email_template = "
<h2>You have Registered with Wooble</h2>
<h5>Verify your email address to login</h5>
<br><br>
<a href='http://localhost/emailVerification/verify-email.php?token=".$verify_token."'>
Click here to verify
</a>
";

$mail->Body = $email_template;
$mail->AltBody = "Verify your email: http://localhost/emailVerification/verify-email.php?token=".$verify_token;

try {
    $mail->send();
    echo "Email sent successfully ";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}

}

if(isset($_POST['signup_btn']))
    {
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $verify_token = bin2hex(random_bytes(16));

        sendemail_verify("$name","$email","$verify_token");
        echo "<br>";
        echo "sent or not ?";

        //Email Exists or not
        $check_email_query="SELECT email FROM secondusers WHERE email='$email' LIMIT 1";
        $check_email_query_run=mysqli_query($con,$check_email_query);

        if(mysqli_num_rows($check_email_query_run)>0){
            $_SESSION['status']="Email id already Exists";
            header("location: signup.php");
        }
        else{
            //insert User / Registered User Data
            $query="INSERT INTO secondusers (name,phone,email,password,verify_token) VALUES ('$name','$phone','$email','$password','$verify_token')";
            $query_run=mysqli_query($con,$query);

            if($query_run){
                sendemail_verify("$name","$email","$verify_token");

                $_SESSION['status']="Registration Successfull.! Please verify your Email Address.";
                header("location: signup.php");
            }
            else{
                $_SESSION['status']="Registration Failed";
                header("location: signup.php");
            }
        }
    }

?>