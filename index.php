<?php
// Allow embedding in Pipedrive iframe
header("Content-Security-Policy: frame-ancestors https://*.pipedrive.com");
header_remove("X-Frame-Options");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Stripe Info Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f5f5f5;
    }
    .container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .invoice, .charge {
      margin-bottom: 15px;
      padding: 10px;
      border-left: 4px solid #007bff;
      background-color: #f0f8ff;
    }
    .paid { border-color: green; }
    .failed { border-color: red; }
    .link {
      color: #007bff;
      text-decoration: none;
    }
    h2, h3 { color: #333; }
    #status { margin-bottom: 20px; font-weight: bold; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Stripe Data</h2>
    <div id="status">Loading...</div>
    <div id="invoices"></div>
    <div id="charges"></div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const statusDiv = document.getElementById('status');
      const invoicesDiv = document.getElementById('invoices');
      const chargesDiv = document.getElementById('charges');

      try {
        const email = await getPipedriveContactEmail();
        if (!email) throw new Error("No email found.");

        const url = `https://octopus-app-3hac5.ondigitalocean.app/api/stripe_data?email=${encodeURIComponent(email)}`;
        const response = await fetch(url);

        if (!response.ok) {
          throw new Error(`HTTP Error: ${response.status}`);
        }

        const data = await response.json();
        if (data.error) throw new Error(data.error);

        statusDiv.textContent = `Found ${data.customer_count} customer(s).`;

        renderInvoices(data.invoices || [], invoicesDiv);
        renderCharges(data.charges || [], chargesDiv);
      } catch (error) {
        statusDiv.textContent = `Error: ${error.message}`;
      }
    });

    async function getPipedriveContactEmail() {
      return new Promise((resolve) => {
        const email = 'my_cool_customer@example.com'; // Replace with actual logic
        resolve(email);
      });
    }

    function renderInvoices(invoices, container) {
      container.innerHTML = `<h3>Invoices</h3>`;
      if (!invoices.length) {
        container.innerHTML += "<p>No invoices found.</p>";
        return;
      }

      invoices.forEach(inv => {
        const date = new Date(inv.created * 1000).toLocaleString();
        const amount = (inv.amount_due / 100).toFixed(2);
        const receipt = inv.status === 'paid' && inv.hosted_invoice_url
          ? `<br><a class="link" href="${inv.hosted_invoice_url}" target="_blank">View Receipt</a>` : '';

        container.innerHTML += `
          <div class="invoice ${inv.status}">
            <strong>ID:</strong> ${inv.id}<br>
            <strong>Number:</strong> ${inv.number}<br>
            <strong>Amount:</strong> $${amount}<br>
            <strong>Status:</strong> ${inv.status}<br>
            <strong>Customer:</strong> ${inv.customer}<br>
            <strong>Date:</strong> ${date}
            ${receipt}
          </div>
        `;
      });
    }

    function renderCharges(charges, container) {
      container.innerHTML = `<h3>Charges</h3>`;
      if (!charges.length) {
        container.innerHTML += "<p>No charges found.</p>";
        return;
      }

      charges.forEach(charge => {
        const date = new Date(charge.created * 1000).toLocaleString();
        const amount = (charge.amount / 100).toFixed(2);

        container.innerHTML += `
          <div class="charge ${charge.status}">
            <strong>ID:</strong> ${charge.id}<br>
            <strong>Amount:</strong> $${amount}<br>
            <strong>Status:</strong> ${charge.status}<br>
            <strong>Customer:</strong> ${charge.customer}<br>
            <strong>Date:</strong> ${date}
          </div>
        `;
      });
    }
  </script>
</body>
</html>
