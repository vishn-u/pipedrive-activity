<?php
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pipedrive Panel Test</title>
</head>
<body>
  <div style="padding:20px;font-family:Arial,sans-serif;">
    <h2>Loading in Panel...</h2>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0/dist/index.umd.js"></script>
  <script>
    (async () => {
      const sdk = await new AppExtensionsSDK().initialize();
      document.querySelector('h2').textContent = '✅ Panel Loaded Inside Pipedrive!';
      sdk.execute({ type: 'resize', height: 200 });
    })();
  </script>
</body>
</html>
