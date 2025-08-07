<?php
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pipedrive Panel</title>
</head>
<body>
  <div style="font-family: sans-serif; padding: 20px;">
    <h2 id="status">Loading in Panel...</h2>
  </div>

  <!-- ✅ Include SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0/dist/index.umd.js"></script>
  
  <!-- ✅ Wait for DOM + Initialize SDK -->
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const sdk = await new AppExtensionsSDK().initialize();
        document.getElementById('status').textContent = '✅ Panel Loaded Inside Pipedrive!';
        sdk.execute({ type: 'resize', height: 200 });
        console.log('✅ SDK initialized successfully.');
      } catch (error) {
        document.getElementById('status').textContent = '❌ SDK init failed: ' + error;
        console.error('❌ SDK init failed:', error);
      }
    });
  </script>
</body>
</html>
