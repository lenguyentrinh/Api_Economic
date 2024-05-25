
<?php
include "connect.php";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $email =$_POST['email'];
  $query = 'SELECT * FROM `user` WHERE `email` = "'.$email.'"';
  $data = mysqli_query($conn, $query);
  $result = array();
  while ($row = mysqli_fetch_assoc($data)) {
    // code...
    $result[] = ($row);
  }
    
    if(empty($result)){
      $arr = [
        'success'=> false,
        'message'=> "Gmail account has not been registered",
        'result' => $result
      ];
    }else{
      //send mail
        $email=($result[0]["email"]);
        $pass=($result[0]["pass"]);
    $link="<a href='http://192.168.1.5/banhang/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";

    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "aromaticbag.business@gmail.com";
    // GMAIL password
    $mail->Password = "aealugohwduwzwad";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From="aromaticbag.business@gmail.com";
    $mail->FromName='App banhang';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body = '
    <html>
    <head>
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
            }
            .container {
                max-width: 600px;
                margin: auto;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 1px 3px 6px #64b5f6;
                border: 1px solid #64b5f6;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
                background:linear-gradient(90deg,#64b5f6 0%,#81d4fa 100%);
                border-radius: 10px 10px 0 0;
                padding: 20px;
            }
            .header h1 {
                color: #ffffff;
                margin: 0;
            }
            .body-content {
                padding: 20px;
                text-align: center;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                color: #ffffff;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
            }
            .button:hover {
                background-color: #0056b3;
            }
            .footer {
                text-align: center;
                margin-top: 5px;
                font-size: 0.9em;
                color: #888;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Reset Your Password</h1>
            </div>
            <div class="body-content">
                <p>Click on the link below to reset your password:</p>
             '.$link.'
            </div>
            <div class="footer">
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Thank you,<br>The App Banhang Team</p>
                <p>&copy; 2024 App Banhang. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
    if($mail->Send())
    {
        $arr =[
            'success'=> true,
            'message'=> "Send email is successfully! Please check your email to reset password."
        ];
    }
    else
    {
        $arr =[
            'success'=> false,
            'message'=> "Send email is unsuccessfully"
        ];
    }
 
    }
   print_r(json_encode($arr));

?>

