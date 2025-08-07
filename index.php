<?php
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test Panel</title>
</head>
<body>
  <h2>Loading...</h2>

  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0/dist/index.umd.js"></script>
  <script>
    (async function() {
      const sdk = await new AppExtensionsSDK().initialize();
      // Adjust height if needed
      sdk.execute({ type: 'resize', height: 400 });
      console.log('SDK initialized', sdk);
      document.querySelector('h2').textContent = '✅ Panel Loaded!';
    })();
  </script>
</body>
</html>
