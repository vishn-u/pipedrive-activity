<?php
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
header("Content-Type: text/html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pipedrive Panel Test</title>
</head>
<body>
  <div style="padding: 20px; font-family: sans-serif;">
    <h2 id="status">Loading in Panel...</h2>
  </div>

  <!-- Load Pipedrive SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0.11.0/dist/index.umd.js"></script>

  <!-- Initialize SDK -->
  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      const status = document.getElementById("status");

      try {
        const sdk = await new AppExtensionsSDK().initialize();
        status.textContent = "✅ Panel Loaded Inside Pipedrive!";
        sdk.execute({ type: "resize", height: 200 });
        console.log("✅ SDK initialized");
      } catch (err) {
        console.error("❌ SDK init failed:", err);
        status.textContent = "❌ SDK init failed: " + err.message;
      }
    });
  </script>
</body>
</html>
