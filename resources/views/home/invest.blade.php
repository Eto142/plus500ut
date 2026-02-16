<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Investment Platform - Select Market</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



<style>
  /* Basic styling for the dashboard */
  #dashboard-content {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
    font-family: Arial, sans-serif;
  }

  /* Logo styling */
  #logo-container img {
    max-width: 150px;
    height: auto;
  }

  /* Orientation overlay for phone view only */
  #orientation-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    color: #ffffff;
    display: none; /* Default to hidden */
    align-items: center;
    justify-content: center;
    flex-direction: column;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    z-index: 9999;
  }
</style>
</head>
<body>

<!-- Dashboard Content -->


<!-- Orientation Warning Overlay (for phone portrait view only) -->
<div id="orientation-overlay">
  <div id="logo-container">
    <img src="logo.png" alt="Your Logo"> <!-- Replace 'logo.png' with your logo path -->
  </div>
  <p>Please turn your device to landscape mode for the best experience.</p>
</div>

<script>
  // Function to toggle orientation overlay based on device orientation and screen width
  function checkOrientation() {
    const overlay = document.getElementById('orientation-overlay');
    const dashboardContent = document.getElementById('dashboard-content');
    const isPortrait = window.innerHeight > window.innerWidth;
    const isPhoneView = window.innerWidth <= 768; // Adjust width threshold for phone view if needed

    // Show overlay only in portrait mode and on phone view
    if (isPortrait && isPhoneView) {
      overlay.style.display = 'flex';
      dashboardContent.style.display = 'none'; // Hide the main dashboard content
    } else {
      overlay.style.display = 'none';
      dashboardContent.style.display = 'flex'; // Show the main dashboard content in landscape mode
    }
  }

  // Check orientation on load and on resize
  window.addEventListener('load', checkOrientation);
  window.addEventListener('resize', checkOrientation);
</script>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Investment Options</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Segoe UI', sans-serif;
    }
    .page-header {
      padding: 60px 20px 40px;
      text-align: center;
      background-color: #1e1e1e;
      border-radius: 12px;
      margin-bottom: 30px;
    }
    .page-header h1 {
      font-size: 2.7rem;
      font-weight: 700;
      color: #ffffff;
    }
    .page-header p {
      font-size: 1.1rem;
      color: #a0a0a0;
      max-width: 700px;
      margin: 0 auto;
    }
    .investment-card {
      border: 1px solid #333;
      border-radius: 16px;
      background-color: #1e1e1e;
      padding: 35px 30px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    .investment-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
    .card-icon {
      font-size: 3rem;
      margin-bottom: 20px;
    }
    .investment-card h3 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #ffffff;
      margin-bottom: 15px;
    }
    .investment-card p {
      font-size: 1rem;
      color: #b0b0b0;
      margin-bottom: 25px;
    }
    .btn-invest {
      font-weight: 600;
      border-radius: 8px;
      padding: 10px 24px;
      text-decoration: none;
      border: none;
    }
    
    /* Crypto Card Specific Styles */
    .crypto-card {
      border-left: 4px solid #0d6efd;
    }
    .crypto-card .card-icon {
      color: #0d6efd;
    }
    .crypto-card .btn-invest {
      background-color: #0d6efd;
      color: white;
    }
    .crypto-card .btn-invest:hover {
      background-color: #0b5ed7;
    }
    
    /* Stocks Card Specific Styles */
    .stocks-card {
      border-left: 4px solid #ffc107;
    }
    .stocks-card .card-icon {
      color: #ffc107;
    }
    .stocks-card .btn-invest {
      background-color: #ffc107;
      color: #121212;
    }
    .stocks-card .btn-invest:hover {
      background-color: #e0a800;
    }
    
    /* Signal Indicators */
    .signal-indicator {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      align-items: center;
      font-size: 0.9rem;
      font-weight: 600;
    }
    .signal-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin-right: 6px;
      animation: pulse 2s infinite;
    }
    .crypto-signal {
      color: #0d6efd;
    }
    .crypto-dot {
      background-color: #0d6efd;
      box-shadow: 0 0 10px #0d6efd;
    }
    .stocks-signal {
      color: #ffc107;
    }
    .stocks-dot {
      background-color: #ffc107;
      box-shadow: 0 0 10px #ffc107;
    }
    
    /* Signal Status Text */
    .signal-status {
      font-size: 0.8rem;
      margin-top: 5px;
      font-style: italic;
    }
    .crypto-status {
      color: #0d6efd;
    }
    .stocks-status {
      color: #ffc107;
    }
    
    /* Trading Chart Styles */
    .trading-chart {
      width: 100%;
      height: 150px;
      background-color: #121212;
      border-radius: 8px;
      margin: 20px 0;
      position: relative;
      overflow: hidden;
    }
    .chart-line {
      position: absolute;
      height: 2px;
      background-color: rgba(255, 255, 255, 0.1);
      width: 100%;
    }
    .chart-line:nth-child(1) { top: 25%; }
    .chart-line:nth-child(2) { top: 50%; }
    .chart-line:nth-child(3) { top: 75%; }
    
    .crypto-chart {
      border: 1px solid #0d6efd;
    }
    .stocks-chart {
      border: 1px solid #ffc107;
    }
    
    .chart-path {
      fill: none;
      stroke-width: 2;
      stroke-linejoin: round;
    }
    .crypto-path {
      stroke: #0d6efd;
    }
    .stocks-path {
      stroke: #ffc107;
    }
    
    @keyframes pulse {
      0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
      }
      70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
      }
      100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
      }
    }
    
    @media (max-width: 576px) {
      .page-header h1 {
        font-size: 2rem;
      }
      .investment-card {
        padding: 25px 20px;
      }
      .card-icon {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header Section -->
    <div class="page-header">
      <h1>Select Your Preferred Investment Market</h1>
      <p>Decide where your money works best: dive into fast-moving crypto or opt for steady, long-term growth in gold and global stocks.</p>
    </div>

    <!-- Investment Options (Side-by-Side on ALL Devices) -->
    <div class="row">
      <!-- Cryptocurrency Option -->
      <div class="col-6 mb-4">
        <div class="investment-card text-center crypto-card">
          <div class="signal-indicator">
            <div class="signal-dot crypto-dot"></div>
            <span class="crypto-signal">Active Market</span>
          </div>
          <div class="card-icon">
            <i class="bi bi-currency-bitcoin"></i>
          </div>
          <h3>Cryptocurrency Trading</h3>
          <p>Enter the world of digital assets. Trade Bitcoin, Ethereum, and altcoins with real-time insights and global market access.</p>
          <p class="signal-status crypto-status">High volatility - 24/7 trading</p>
          
          <!-- Crypto Trading Chart -->
          <div class="trading-chart crypto-chart">
            <div class="chart-line"></div>
            <div class="chart-line"></div>
            <div class="chart-line"></div>
            <svg viewBox="0 0 300 100" preserveAspectRatio="none">
              <path class="chart-path crypto-path" d="M0,80 C30,60 60,90 90,40 C120,10 150,70 180,50 C210,30 240,80 270,20 C300,40 300,40 300,40" />
            </svg>
          </div>
          
          <a href="/crypto-dashboard" class="btn btn-invest">Go to Crypto Market</a>
        </div>
      </div>

      <!-- Gold/Stock Market Option -->
      <div class="col-6 mb-4">
        <div class="investment-card text-center stocks-card">
          <div class="signal-indicator">
            <div class="signal-dot stocks-dot"></div>
            <span class="stocks-signal">Stable Market</span>
          </div>
          <div class="card-icon">
            <i class="bi bi-bar-chart-line-fill"></i>
          </div>
          <h3>Gold & Stock Market</h3>
          <p>Invest in precious metals, top-performing stocks, and ETFs. Build a solid portfolio backed by expert analysis.</p>
          <p class="signal-status stocks-status">Low volatility - Market hours</p>
          
          <!-- Stocks Trading Chart -->
          <div class="trading-chart stocks-chart">
            <div class="chart-line"></div>
            <div class="chart-line"></div>
            <div class="chart-line"></div>
            <svg viewBox="0 0 300 100" preserveAspectRatio="none">
              <path class="chart-path stocks-path" d="M0,60 C30,50 60,70 90,60 C120,50 150,30 180,40 C210,50 240,70 270,60 C300,50 300,50 300,50" />
            </svg>
          </div>
          
          <a href="/stocks-dashboard" class="btn btn-invest">Enter Stock Market</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>