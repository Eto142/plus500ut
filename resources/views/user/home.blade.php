@include('user.layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Light mode styling */
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Orientation overlay for phone view only */
        #orientation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            color: #333;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            z-index: 9999;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        /* Dashboard styling */
        #dashboard-content {
            flex: 1;
            display: block;
            padding-bottom: 70px; /* Space for footer */
        }

        /* Logo styling */
        #logo-container img {
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        /* Custom header styling */
        .custom-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 15px 0;
            border-radius: 0 0 10px 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .balance-display {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        /* Sub-header styling */
        .sub-header {
            background-color: #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            background-color: white;
        }

        /* Scroll menu styling */
        .scrollmenu {
            background-color: #f1f3f4;
            overflow: auto;
            white-space: nowrap;
            padding: 10px 0;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .scrollmenu a {
            display: inline-block;
            color: #495057;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 20px;
            margin: 0 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .scrollmenu a:hover {
            background-color: #e2e6ea;
            color: #007bff;
        }

        /* Trading list styling */
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: white;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease;
        }

        .list-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.07);
        }

        .list-item .details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .list-item .instrument-name {
            font-weight: 600;
            font-size: 16px;
            color: #212529;
        }

        .list-item .price-change {
            font-size: 14px;
            font-weight: 500;
        }

        .list-item .actions {
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            min-width: 100px;
        }

        .sell {
            background: linear-gradient(to right, #ff6b6b, #ff5252);
            color: white;
        }

        .sell:hover {
            background: linear-gradient(to right, #ff5252, #ff3838);
            box-shadow: 0 4px 8px rgba(255, 82, 82, 0.3);
        }

        .buy {
            background: linear-gradient(to right, #51cf66, #40c057);
            color: white;
        }

        .buy:hover {
            background: linear-gradient(to right, #40c057, #2f9e44);
            box-shadow: 0 4px 8px rgba(64, 192, 87, 0.3);
        }

        .positive {
            color: #40c057;
        }

        .negative {
            color: #ff6b6b;
        }

        /* Footer styling */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 12px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.08);
            z-index: 100;
        }

        .footer a {
            text-decoration: none;
            color: #6c757d;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            transition: color 0.3s ease;
        }

        .footer a.active {
            color: #007bff;
        }

        .footer a:hover {
            color: #007bff;
        }

        /* Loading indicator */
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .list-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .list-item .actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .button {
                width: 48%;
            }
            
            .custom-header .d-flex {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Loading indicator -->
    <div id="loading">
        <div class="spinner"></div>
        <div>Loading Trading Dashboard...</div>
    </div>

    <!-- Orientation Warning Overlay -->
    <div id="orientation-overlay">
        <div id="logo-container">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjUwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iNTAiIGZpbGw9IiMwMDdiZmYiLz48dGV4dCB4PSI3NSIgeT0iMjUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIwLjNlbSI+VHJhZGluZyBBcHA8L3RleHQ+PC9zdmc+" alt="Trading App">
        </div>
        <p>Please turn your device to landscape mode for the best experience.</p>
    </div>

    <!-- Dashboard Content -->
    <!--<div id="dashboard-content" style="display:none;">-->
        <!-- Custom header matching your original design -->
    <!--    <div class="custom-header">-->
    <!--        <div class="container-fluid">-->
    <!--            <div class="d-flex justify-content-between align-items-center">-->
    <!--                <div class="d-flex align-items-center">-->
    <!--                    <h4 class="mb-0">Trading Dashboard</h4>-->
    <!--                </div>-->
    <!--                <div class="balance-display">-->
    <!--                    Balance: $10,250.75-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

        <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12 align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><b> Hey {{Auth::user()->name}}! Welcome to your Portfolio</b></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <!-- Scroll menu -->
                                <!--<div class="scrollmenu">-->
                                <!--    <a href="#forex">Forex</a>-->
                                <!--    <a href="#crypto">Cryptocurrencies</a>-->
                                <!--    <a href="#commodities">Commodities</a>-->
                                <!--    <a href="#indices">Indices</a>-->
                                <!--    <a href="#stocks">Stocks</a>-->
                                <!--    <a href="#metals">Metals</a>-->
                                <!--    <a href="#energies">Energies</a>-->
                                <!--</div>-->
                                
                                
                                
                                     <!-- Personal Trading Chart -->
                <div class="pt-1 col-12">
                    <h3 class="section-heading">Personal Trading Chart</h3>
                    <div class="tradingview-widget-container" style="margin: 30px 0;">
                        <div id="tradingview_f933e"></div>
                        <div class="tradingview-widget-copyright">
                            <a href="#" rel="noopener" target="_blank">
                                <span class="blue-text">Trading chart</span>
                            </a>
                        </div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            new TradingView.widget({
                                "width": "100%",
                                "height": "550",
                                "symbol": "COINBASE:BTCUSD",
                                "interval": "1",
                                "timezone": "Etc/UTC",
                                "theme": 'light',
                                "style": "9",
                                "locale": "en",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "hide_side_toolbar": false,
                                "allow_symbol_change": true,
                                "calendar": false,
                                "studies": ["BB@tv-basicstudies"],
                                "container_id": "tradingview_f933e"
                            });
                        </script>
                    </div>
                </div>

                                <!-- Trading instruments header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Popular Instruments</h5>
                                    <div class="text-muted">Live Prices</div>
                                </div>

                                <!-- Trading instruments list -->
                                <div class="list" id="list">
                                    <!-- Items will be dynamically added here -->
                                    <div class="text-center py-4">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mt-2">Loading market data...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer Navigation -->
    <!--<div class="footer">-->
    <!--    <a href="#" class="active">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
    <!--            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>-->
    <!--            <polyline points="9 22 9 12 15 12 15 22"></polyline>-->
    <!--        </svg>-->
    <!--        <span>Home</span>-->
    <!--    </a>-->
    <!--    <a href="#">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
    <!--            <line x1="12" y1="1" x2="12" y2="23"></line>-->
    <!--            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>-->
    <!--        </svg>-->
    <!--        <span>Trade</span>-->
    <!--    </a>-->
    <!--    <a href="#">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
    <!--            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>-->
    <!--            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>-->
    <!--            <line x1="12" y1="22.08" x2="12" y2="12"></line>-->
    <!--        </svg>-->
    <!--        <span>Portfolio</span>-->
    <!--    </a>-->
    <!--    <a href="#">-->
    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
    <!--            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>-->
    <!--            <circle cx="12" cy="7" r="4"></circle>-->
    <!--        </svg>-->
    <!--        <span>Account</span>-->
    <!--    </a>-->
    <!--</div>-->

    <script>
        // Show content when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Hide loading screen after a short delay to ensure everything is ready
            setTimeout(function() {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('dashboard-content').style.display = 'block';
                
                // Check orientation
                checkOrientation();
                
                // Load trading data
                updateData();
            }, 500);
        });

        // Function to toggle orientation overlay based on device orientation and screen width
        function checkOrientation() {
            const overlay = document.getElementById('orientation-overlay');
            const dashboardContent = document.getElementById('dashboard-content');
            const isPortrait = window.innerHeight > window.innerWidth;
            const isPhoneView = window.innerWidth <= 768; // Adjust width threshold for phone view if needed

            // Show overlay only in portrait mode and on phone view
            if (isPortrait && isPhoneView) {
                overlay.style.display = 'flex';
                dashboardContent.style.display = 'none';
            } else {
                overlay.style.display = 'none';
                dashboardContent.style.display = 'block';
            }
        }

        // Check orientation on resize
        window.addEventListener('resize', checkOrientation);

        // Trading data functionality
        const apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd';

        // Fetch live data for BTC & ETH
        async function fetchData() {
            try {
                const response = await fetch(apiUrl);
                const data = await response.json();
                return {
                    bitcoin: data.bitcoin.usd,
                    ethereum: data.ethereum.usd
                };
            } catch (error) {
                console.error("Error fetching data:", error);
                return { bitcoin: 45000, ethereum: 3000 }; // Fallback values
            }
        }

        // Render the instruments list
        function renderData(data) {
            const list = document.getElementById('list');
            list.innerHTML = '';

            const instruments = [
                { name: 'XAUUSD', base: 2616.35 },
                { name: 'BTCUSD', base: data.bitcoin },
                { name: 'EURUSD', base: 1.03915 },
                { name: 'GBPUSD', base: 1.25341 },
                { name: 'USDJPY', base: 157.136 },
                { name: 'ETHUSD', base: data.ethereum },
                { name: 'AUDUSD', base: 0.6854 },
                { name: 'USDCAD', base: 1.3467 },
                { name: 'NZDUSD', base: 0.5915 },
                { name: 'EURGBP', base: 0.8283 },
                { name: 'USDCHF', base: 0.9023 }
            ];

            instruments.forEach(instrument => {
                // Simulate fluctuation around base price
                const changePercent = (Math.random() - 0.5) / 100;
                const sell = instrument.base * (1 + changePercent);
                const buy = sell * 1.0005;
                const change = (changePercent * 100).toFixed(2) + '%';
                const isPositive = changePercent >= 0;

                const item = document.createElement('div');
                item.className = 'list-item';
                item.innerHTML = `
                    <div class="details">
                        <div class="instrument-name">${instrument.name}</div>
                        <div class="price-change ${isPositive ? 'positive' : 'negative'}">
                            ${isPositive ? '+' : ''}${change}
                        </div>
                    </div>
                    <div class="actions">
                        <a href="https://plus500ut.com/user/withdrawals/create" class="button sell">
                            Sell ${sell.toFixed(5)}
                        </a>
                        <a href="https://plus500ut.com/user/deposit" class="button buy">
                            Buy ${buy.toFixed(5)}
                        </a>
                    </div>
                `;

                list.appendChild(item);
            });
        }

        // Fetch and update continuously
        async function updateData() {
            const data = await fetchData();
            renderData(data);
        }

        setInterval(updateData, 10000); // update every 10s
    </script>
</body>
</html>
@include('user.layouts.footer')