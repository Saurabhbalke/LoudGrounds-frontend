<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email']) ){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $purpose = $_POST['purpose'];

    require_once "mailer/PHPMailer.php";
    require_once "mailer/SMTP.php";
    require_once "mailer/Exception.php";

    $mail = new PHPMailer();

    // smptp settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 2;
  
    $mail->Host = "smtp.hostinger.com";
    $mail->SMTPAuth = true;
    $mail->Username = "info@loudgrounds.com";
    $mail->Password = "Loudgrounds@12";
    $mail->Port = "465";
    $mail->SMTPSecure = "ssl";

    // email settings
    $mail->isHTML(true);
    $mail->setFrom("info@loudgrounds.com", "Loudgrounds");
    $mail->addAddress("info@loudgrounds.com");
    $mail->Subject = ("Loudground New Enquiry");
    // $mail->Body = '<br><b>Name &nbsp;:&nbsp;</b>'.$name.'<br><b>Email &nbsp;:&nbsp;</b>'.$email.'<br><b>Phone Number &nbsp;:&nbsp;</b>+'.$phone.'<br><b>I m from &nbsp;:&nbsp;</b>'.$imfrom.'<br><b>I m looking for &nbsp;:&nbsp;</b>'.$imlookingfor.'<br><b>Message :&nbsp;</b>'.$message;
    $mail->Body = '<html><body>';
    $mail->Body .= '<table border="1">';
    $mail->Body .= '<tr><td>Purpose</td><td>' . $purpose . '</td></tr>';
    $mail->Body .= '<tr><td>Name</td><td>' . $name . '</td></tr>';
    $mail->Body .= '<tr><td>Email</td><td>' . $email . '</td></tr>';
    $mail->Body .= '</table>';
    $mail->Body .= '</body></html>';


    if($mail->send()){
        $status = "success";
        $response = "Email sent successfully";
    }
    else
    {
        $status = "Failed";
        $response = "Something went wrong".$mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response"=> $response)));
}
?>