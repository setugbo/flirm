<?php
require_once __DIR__ . '/functions.php';

function getMailer() {
    $settings = Database::getInstance()->fetchOne("SELECT * FROM site_settings WHERE id = 1");

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    $mail->Host       = $settings['smtp_host'] ?? 'mail.flirm.com.ng';
    $mail->Port       = $settings['smtp_port'] ?? 465;
    $mail->Username   = $settings['smtp_username'] ?? 'info@flirm.com.ng';
    $mail->Password   = $settings['smtp_password'] ?? '';
    $mail->CharSet    = 'UTF-8';

    $fromEmail = $settings['smtp_from_email'] ?: $settings['smtp_username'];
    $fromName  = $settings['smtp_from_name'] ?: 'FLIRM SOLICITORS';
    $mail->setFrom($fromEmail, $fromName);

    return $mail;
}

function sendContactNotification($name, $email, $phone, $subject, $message) {
    $mail = getMailer();
    $mail->addAddress('info@flirm.com.ng', 'FLIRM SOLICITORS');
    $mail->addReplyTo($email, $name);
    $mail->isHTML(true);

    $body = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>
body{font-family:Georgia,serif;color:#222;line-height:1.6;margin:0;padding:0}
.wrap{max-width:600px;margin:0 auto;padding:30px}
h1{font-size:1.2rem;text-transform:uppercase;letter-spacing:2px;border-bottom:2px solid #000;padding-bottom:10px;margin-bottom:24px;color:#000}
.field{margin-bottom:16px}
.label{font-size:.75rem;text-transform:uppercase;letter-spacing:1px;color:#888;margin-bottom:2px}
.value{font-size:1rem;color:#000}
.footer{margin-top:30px;padding-top:16px;border-top:1px solid #ddd;font-size:.8rem;color:#888}
</style></head>
<body><div class="wrap">
<h1>New Contact Message</h1>
<div class="field"><div class="label">Name</div><div class="value">{$name}</div></div>
<div class="field"><div class="label">Email</div><div class="value">{$email}</div></div>
<div class="field"><div class="label">Phone</div><div class="value">{$phone}</div></div>
<div class="field"><div class="label">Subject</div><div class="value">{$subject}</div></div>
<div class="field"><div class="label">Message</div><div class="value">{$message}</div></div>
<div class="footer">Sent via FLIRM SOLICITORS contact form</div>
</div></body></html>
HTML;

    $mail->Subject = 'New Contact Message: ' . ($subject ?: 'No Subject');
    $mail->Body    = $body;
    $mail->AltBody = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\nMessage: {$message}";

    return $mail->send();
}

function sendAutoReply($name, $email) {
    $mail = getMailer();
    $mail->addAddress($email, $name);
    $mail->isHTML(true);

    $body = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>
body{font-family:Georgia,serif;color:#222;line-height:1.6;margin:0;padding:0}
.wrap{max-width:600px;margin:0 auto;padding:30px}
h1{font-size:1.4rem;color:#000;margin-bottom:8px}
p{color:#444;margin-bottom:16px}
.signature{margin-top:30px;padding-top:16px;border-top:1px solid #ddd;font-size:.85rem;color:#000}
.signature strong{display:block}
</style></head>
<body><div class="wrap">
<h1>Thank You, {$name}</h1>
<p>We have received your message and will get back to you within 24 hours.</p>
<p>For urgent matters, please call us directly.</p>
<div class="signature">
<strong>FLIRM SOLICITORS</strong>
Lagos, Nigeria
info@flirm.com.ng
</div>
</div></body></html>
HTML;

    $mail->Subject = 'Thank You for Contacting FLIRM SOLICITORS';
    $mail->Body    = $body;
    $mail->AltBody = "Thank you, {$name}.\n\nWe have received your message and will get back to you within 24 hours.\n\nFLIRM SOLICITORS\nLagos, Nigeria";

    return $mail->send();
}
