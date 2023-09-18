<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMAiler\Exception;

    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\handler\StreamHandler;

    require_once __DIR__ . ('\vendor/autoload.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="name"><br>
        <input type="email" name="email" placeholder="email"><br>
        <input type="textarea" name="Message" placeholder="what is your issue?"><br>
        <input type="submit">
    </form>
</body>
</html>
<?php
error_reporting(0);
$mail = new PHPMailer();
$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['Message'];

$log = new Logger('info');
$log->pushHandler(new StreamHandler('src/info.log', Level::Warning));


try {
    //recipient
    $mail->setFrom('ven.dylanvander@gmail.com', 'Dylan');
    $mail->addAddress($email, $name);
    $mail->addCC('acegamer722@gmail.com');
    //content
    $mail->Subject = 'Uw klacht is in behandeling';
    $mail->Body = $text;
    $mail->send();
    echo 'message has been sent';
} catch (Exception $e) {
    echo "jammer, het bericht is niet verstuurd" . $mail->ErrorInfo;
}
$log->warning('name: ' . $name . ", " . 'email: ' . $email . ", " . 'message: ' . $text);

?>