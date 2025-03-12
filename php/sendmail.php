<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Configuration du mail
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contact@tedxsocimat.com'; // Adresse e-mail
        $mail->Password = 'VOTRE_MOT_DE_PASSE'; // Mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('contact@tedxsocimat.com', 'TEDxSocimat');
        $mail->addAddress('contact@tedxsocimat.com'); // Destinataire

        $mail->Subject = $subject;
        $mail->Body = "Nom : $name\nEmail : $email\nMessage :\n$message";

        $mail->send();
        echo "Votre message a été envoyé avec succès.";
    } catch (Exception $e) {
        echo "Erreur : {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
