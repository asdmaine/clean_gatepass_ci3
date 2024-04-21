<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Ganti dengan alamat SMTP server Anda
    $mail->SMTPAuth = true;
    $mail->Username = 'shdsulthon11@gmail.com'; // Ganti dengan email Anda
    $mail->Password = 'kkqe dgiu xdfd wgtu '; // Ganti dengan kata sandi email Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Port SMTP Gmail

    // Set PHPMailer untuk menggunakan mail() bawaan PHP
    // $mail->isMail();

    // Pengaturan email
    $mail->setFrom('shdsulthon11@gmail.com', 'Gatepass System'); // Ganti dengan alamat email dan nama Anda
    $mail->addAddress('sulthon.sdn@gmail.com', 'To '); // Ganti dengan alamat email penerima
    $mail->Subject = '<mail subject>';
    $mail->isHTML(true);
    $mail->Body = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <h2>HTML Email</h2>
        <p>This email contains HTML Tags!</p>
        <table>
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                </tr>
            </tbody>
        </table>
    </div>
    <button>button</button>
</body>
</html>
    ';

    $mail->send();
    echo 'Email has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>