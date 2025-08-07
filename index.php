<?php
// Send required headers
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Simple Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    .box {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>✅ Custom Panel Loaded!</h2>
    <p>This is a working iframe loaded from Render inside Pipedrive.</p>
  </div>
</body>
</html>
