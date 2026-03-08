<?php
/**
 * PHP built-in server router – used by the Render deployment.
 *
 * Run with:
 *   php -S 0.0.0.0:$PORT router.php
 *
 * Routing rules:
 *   /                           → frontend/index.php  (Angular SPA)
 *   /home.php, /about.php …     → frontend/<file>.php (AngularJS template requests)
 *   /backend/contact-form.php   → backend/contact-form.php  (API endpoint)
 *   /assets/*, /css/*, /img/…   → served as-is (static files)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Block direct access to the .env file
if ($uri === '/.env' || $uri === '.env') {
    http_response_code(403);
    exit;
}

// Serve existing static files (images, CSS, JS, fonts, etc.) directly
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    // Let the built-in server handle it
    return false;
}

// Route bare root to the Angular SPA
if ($uri === '/') {
    require __DIR__ . '/frontend/index.php';
    return;
}

// Route bare PHP filenames (AngularJS template requests) to frontend/
// e.g. /home.php  →  frontend/home.php
// The regex only allows alphanumeric filenames with no path separators or
// leading dots, so directory traversal and access to sensitive files (e.g.
// .env) are not possible.  An additional file_exists() guard ensures only
// files that are actually present in frontend/ are served.
if (preg_match('/^\/([a-zA-Z0-9][a-zA-Z0-9_-]*\.php)$/', $uri, $m)) {
    $frontendFile = __DIR__ . '/frontend/' . $m[1];
    if (file_exists($frontendFile)) {
        require $frontendFile;
        return;
    }
}

// Fall back to the SPA for any unmatched path
require __DIR__ . '/frontend/index.php';
