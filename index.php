<?php
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pipedrive Panel</title>
</head>
<body>
  <div style="padding: 20px; font-family: sans-serif;">
    <h2 id="status">Loading in Panel...</h2>
  </div>

  <!-- ✅ Load Pipedrive SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0/dist/index.umd.js"></script>

  <!-- ✅ Initialize SDK -->
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const sdk = await new AppExtensionsSDK().initialize();
        document.getElementById('status').textContent = '✅ Panel Loaded Inside Pipedrive!';
        sdk.execute({ type: 'resize', height: 200 });
        console.log('✅ SDK initialized');
      } catch (err) {
        console.error('❌ SDK init failed:', err);
        document.getElementById('status').textContent = '❌ SDK init failed: ' + err;
      }
    });
  </script>
</body>
</html>
