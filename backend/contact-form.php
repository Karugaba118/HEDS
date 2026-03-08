<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mailgun\Mailgun;

// ---------------------------------------------------------------------------
// Load .env file when environment variables have not been injected by the
// hosting platform (e.g. Hostinger shared hosting).
// On Render / Docker the variables are already present via the platform, so
// this block is skipped.
// ---------------------------------------------------------------------------
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip blank lines and comment lines
        $trimmed = ltrim($line);
        if ($trimmed === '' || $trimmed[0] === '#') {
            continue;
        }
        if (strpos($line, '=') === false) {
            continue;
        }
        [$key, $val] = explode('=', $line, 2);
        $key = trim($key);
        $val = trim($val);
        // Strip a matching pair of surrounding quotes, preserving inner content
        if (strlen($val) >= 2) {
            $first = $val[0];
            $last  = $val[strlen($val) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $val = substr($val, 1, -1);
            }
        }
        // Do not overwrite variables already set by the platform
        if ($key !== '' && getenv($key) === false) {
            putenv("{$key}={$val}");
            $_ENV[$key] = $val;
        }
    }
}

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
