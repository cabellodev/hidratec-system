<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        // Include PHPMailer library files
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer;
        return $mail;
    }

    public function send($email_to,$title,$body){

        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';

        $mail = new PHPMailer;
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'picamaderomuebles@gmail.com';
        $mail->Password = 'Zkb?Wx8.ihxi';
        $mail->SMTPSecure = 'tls';
        $mail->Port  = 587;
        
        $mail->setFrom('picamaderomuebles@gmail.com', 'Picamadero');
        $mail->addReplyTo('picamaderomuebles@gmail.com', 'Picamadero');
        
        // Add a recipient
        $mail->addAddress($email_to);

        // Email subject
        $mail->Subject =$title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mail->Body = $body;
        
        // Send email
        if(!$mail->send()){
            return $mail->ErrorInfo;
        }else{
            return true;
        }
    }
}