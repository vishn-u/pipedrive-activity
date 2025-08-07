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
    <div id="log" style="font-size: 12px; margin-top: 10px; color: #666;"></div>
  </div>

  <!-- ✅ Load SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@pipedrive/app-extensions-sdk@0.11.0/dist/index.umd.js"></script>

  <!-- ✅ Confirm SDK Loaded -->
  <script>
    const statusEl = document.getElementById("status");
    const logEl = document.getElementById("log");

    function log(message) {
      console.log(message);
      logEl.innerHTML += message + "<br>";
    }

    document.addEventListener("DOMContentLoaded", async () => {
      log("✅ DOM Loaded");

      if (typeof AppExtensionsSDK === 'undefined') {
        statusEl.textContent = "❌ AppExtensionsSDK not loaded!";
        log("❌ SDK script not loaded");
        return;
      }

      log("✅ SDK script loaded");

      try {
        const sdk = await new AppExtensionsSDK().initialize();
        log("✅ SDK initialized");
        statusEl.textContent = "✅ Panel Loaded Inside Pipedrive!";
        sdk.execute({ type: "resize", height: 200 });
      } catch (err) {
        log("❌ SDK init error: " + err.message);
        statusEl.textContent = "❌ SDK init failed: " + err.message;
      }
    });
  </script>
</body>
</html>
