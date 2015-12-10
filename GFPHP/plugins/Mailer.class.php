<?PHP

class Mailer{
    public function init(){
        $mailerPath =  __ROOT__ . Config::config('core_dir').'/plugins/PHPMailer/PHPMailerAutoload.php';
        include($mailerPath);
        $mail = new PHPMailer();
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = Config::email('server');                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = Config::email('username');            // SMTP username
        $mail->Password = Config::email('password');            // SMTP password
   //     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = Config::email('port');                    // TCP port to connect to
        $mail->setFrom(Config::email('from'));                  // 
        return $mail;
    }
}