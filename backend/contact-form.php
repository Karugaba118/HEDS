<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mailgun\Mailgun;

header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed.';
    exit;
}

$firstName = htmlspecialchars(trim($_POST['firstname'] ?? ''), ENT_QUOTES, 'UTF-8');
$lastName  = htmlspecialchars(trim($_POST['lastname']  ?? ''), ENT_QUOTES, 'UTF-8');
$email     = filter_var(trim($_POST['email']    ?? ''), FILTER_VALIDATE_EMAIL);
$inquiry   = htmlspecialchars(trim($_POST['inquery']   ?? ''), ENT_QUOTES, 'UTF-8');
$message   = htmlspecialchars(trim($_POST['subject']   ?? ''), ENT_QUOTES, 'UTF-8');

if (!$firstName || !$email || !$message) {
    http_response_code(400);
    echo 'Please fill in all required fields.';
    exit;
}

$apiKey    = getenv('MAILGUN_API_KEY');
$domain    = getenv('MAILGUN_DOMAIN');
$recipient = getenv('MAIL_RECIPIENT') ?: 'info@heds.com';

if (!$apiKey || !$domain) {
    http_response_code(500);
    echo 'Mail service is not configured. Please contact us directly.';
    exit;
}

try {
    $mg = Mailgun::create($apiKey);
    $mg->messages()->send($domain, [
        'from'     => "HEDS Contact Form <mailgun@{$domain}>",
        'to'       => $recipient,
        'subject'  => "New Inquiry: {$inquiry}",
        'text'     => "Name: {$firstName} {$lastName}\nEmail: {$email}\nTopic: {$inquiry}\n\nMessage:\n{$message}",
        'reply-to' => $email,
    ]);
    echo 'Your message has been sent successfully. We will get back to you soon!';
} catch (Exception $e) {
    error_log('contact-form: ' . $e->getMessage());
    http_response_code(500);
    echo 'Failed to send your message. Please try again later.';
}
