<!DOCTYPE html>
<html lang="en">
<head>
    <title>Success!</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        .card { border: 1px solid #ddd; padding: 20px; display: inline-block; border-radius: 8px; }
        h1 { color: #2ecc71; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Message Sent!</h1>
        <p>Thank you, <?php echo $_GET['name']; ?> We will get back to you shortly.</p>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>