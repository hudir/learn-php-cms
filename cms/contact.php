<?php
use PHPMailer\PHPMailer\PHPMailer;
require './vendor/autoload.php';
require './classes/Config.php';
include "includes/db.php";
include "includes/header.php";
?>

<?php
$showMsg = '';

// this part not working, must config the SMTP infos
if (isset($_POST['SendMsg'])) {
    $from = escape($_POST['email']);
    $subject = wordwrap(escape($_POST['subject']), 70);
    $msg = escape($_POST['msg']);
    $to = 'hudirybw@gmail.com';
    $header = "From: " . $from;

    if (!empty($from) && !empty($subject) && !empty($msg)) {
        $mail = new PHPMailer();
//        echo get_class($mail); to check is connected
        try {
            //Server settings
            $mail->isSMTP();                                            //Send
            $mail->Host = Config::SMTP_host;                     //Set
            $mail->Username = Config::SMTP_user;                     //SMTP
            $mail->Password = Config::SMTP_pass;                      //SMTP
            $mail->Port = Config::SMTP_port;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->isHTML(true);
//            $mail->CharSet('UTF-8');

            //Recipients
            $mail->setFrom("info@phpcms.com", 'Hudir');
            $mail->addAddress($from);

            //Content
            $mail->Subject = $subject;
            $mail->Body = $msg;
            $mail->AltBody = $msg;

            if ($mail->send()) {
                $showMsg = "<h5 class='text-success text-center'>Your Message has been Send</h5>";
            } else {
                $showMsg = "<h5 class='text-success text-center'>Your Message has not been Send</h5>";
            }
        } catch (Exception $e) {
            $showMsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
//        mail($to, $subject, $msg, $header);
    } else {
        $showMsg = "<h5 class='text-danger text-center'>Fields cannot be empty</h5>";
    }
}

?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Contact Me</h1>

                        <br/>
                        <?php echo $showMsg; ?>
                        <form role="form" action="" method="post" id="contact-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Your Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="YourEmail@example.com">
                            </div>

                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                            </div>
                            <div class="form-group">
                                <label for="msg" class="sr-only"></label>
                                <textarea name="msg" id="msg" class="form-control" placeholder="Enter your message" rows="20"></textarea>
                            </div>

                            <input type="submit" name="SendMsg" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

    <?php include "includes/footer.php"; ?>
