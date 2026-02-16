<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>Plus500 | User Dashboard</title>
    <link rel="shortcut icon" href="{{asset('dist/images/favicon.jpg')}}" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="{{ asset('dist/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="{{ asset('dist/vendors/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/weather-icons/css/pe-icon-set-weather.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/starrr/starrr.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendors/cryptofont/cryptofont.css') }}">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
    <!-- END: Custom CSS-->

    <script>
        jQuery(document).ready(function($) {
            $(".toggle").click(function() {
                $(".toggle").toggleClass("active");
                $("body").toggleClass("night");
                $.cookie("toggle", $(".toggle").hasClass('active'));
            });

            if ($.cookie("toggle") == "true") {
                $(".toggle").addClass("active");
                $("body").addClass("night");
            }
        });
    </script>
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->
<!-- START: Body-->
<!-- START: Body-->

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
  
  /* Dark mode styles */
  body.night {
    background-color: #121212;
    color: #e0e0e0;
  }
  
  body.night .card {
    background-color: #1e1e1e;
    color: #e0e0e0;
    border-color: #333;
  }
  
  body.night .sub-header {
    background-color: #1e1e1e;
    color: #e0e0e0;
  }
  
  body.night .sidebar {
    background-color: #1a1a1a;
  }
  
  body.night .sidebar-menu a {
    color: #e0e0e0;
  }
  
  body.night .header {
    background-color: #1e1e1e;
    border-bottom-color: #333;
  }
  
  body.night .dropdown-menu {
    background-color: #1e1e1e;
    color: #e0e0e0;
    border-color: #333;
  }
  
  body.night .dropdown-item {
    color: #e0e0e0;
  }
  
  body.night .dropdown-item:hover {
    background-color: #333;
  }
  
  body.night .breadcrumb-item a {
    color: #bb86fc;
  }
  
  body.night .site-footer {
    background-color: #1e1e1e;
    border-top-color: #333;
  }
</style>
</head>
<body>

<!-- Orientation Warning Overlay (for phone portrait view only) -->
<div id="orientation-overlay">
  <div id="logo-container">
    <a href="{{route('user.home.page')}}">
    <img src="{{asset('/logo.png')}}" alt="Your Logo">
    </a>
  </div>
  <p>Please turn your device to landscape mode for the best experience.</p>
</div>

<script>
  // Function to toggle orientation overlay based on device orientation and screen width
  function checkOrientation() {
    const overlay = document.getElementById('orientation-overlay');
    const dashboardContent = document.getElementById('dashboard-content');
    const isPortrait = window.innerHeight > window.innerWidth;
    const isPhoneView = window.innerWidth <= 768;

    if (isPortrait && isPhoneView) {
      overlay.style.display = 'flex';
      dashboardContent.style.display = 'none';
    } else {
      overlay.style.display = 'none';
      dashboardContent.style.display = 'flex';
    }
  }

  window.addEventListener('load', checkOrientation);
  window.addEventListener('resize', checkOrientation);
</script>

<body id="main-container" class="default night">
    <!-- START: Pre Loader-->
<div class="se-pre-con">
    <div class="sk-folding-cube sk-folding-cube-orange">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
    </div>
</div>

<style>body {
    overflow: hidden;
}

.se-pre-con {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: #121212; /* Dark background */
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.sk-folding-cube {
    width: 80px;
    height: 80px;
    position: relative;
    transform: rotateZ(45deg);
    animation: spin 2s linear infinite;
}

.sk-folding-cube-orange .sk-cube {
    width: 50%;
    height: 50%;
    position: absolute;
    background-color: #ffab40; /* Orange color */
    clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
    transform-origin: 100% 100%;
    animation: sk-folding-cube 1.5s infinite ease-in-out;
}

.sk-cube1 { transform: rotateZ(0deg); animation-delay: 0s; }
.sk-cube2 { transform: rotateZ(90deg); animation-delay: 0.3s; }
.sk-cube3 { transform: rotateZ(180deg); animation-delay: 0.6s; }
.sk-cube4 { transform: rotateZ(270deg); animation-delay: 0.9s; }

@keyframes sk-folding-cube {
    0%, 10% {
        transform: perspective(140px) rotateX(-180deg);
        opacity: 0;
    }
    25%, 75% {
        transform: perspective(140px) rotateX(0deg);
        opacity: 1;
    }
    90%, 100% {
        transform: perspective(140px) rotateY(180deg);
        opacity: 0;
    }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
    window.onload = function() {
        document.querySelector('.se-pre-con').style.display = 'none';
        document.body.style.overflow = 'auto';
    };
</script>

    <form id="logout-form" action="" method="POST" style="display: none;">
        <input type="hidden" name="_token" value="5QLTsaPXiXFK5BRq0rSxK79tYG7jPVD8j79YF40y">
    </form>
    
    <!-- Header -->
    <div id="header-fix" class="header fixed-top">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header h4 mb-0 align-self-center d-flex">
                <a class="horizontal-logo align-self-center d-flex d-lg-none">
                    <span class="h5 align-self-center mb-0 ">iPONGDEV</span>
                </a>
                <a href="#" class="sidebarCollapse ml-2" id="collapse"><i class="icon-menu body-color"></i></a>
            </div>
            <div class="d-inline-block position-relative">
                <!-- Placeholder for future content -->
            </div>

            <div class="navbar-right ml-auto">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                    <li class="mr-1 d-inline-block my-auto" style="position: relative;">
                        <div style="display: flex; align-items: center;">
                            <a href="javascript:void(0)" onclick="openDepositModal()" 
                                style="background-color: green; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;">
                                Deposit
                            </a>
                            <a href="{{route('user.withdrawals.create')}}"
                                style="background-color: red; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;">
                                Withdraw
                            </a>
                            <h6 style="margin: 0; flex-grow: 1;">
                                <span id="account-type">REAL ACCOUNT</span><br>
                                <span id="account-balance" style="font-size: 1.2em;">{{ number_format($usd_sum, 2) }} {{ Auth::user()->currency }}</span><br>
                                <span style="font-size: 0.8em;">Estimate Account</span>
                            </h6>
                            <span onclick="toggleDropdown()" style="cursor: pointer; margin-left: auto;">
                                &#9662;
                            </span>
                        </div>

                        <div id="account-dropdown"
                            style="display: none; position: absolute; background: #1e1e1e; border: 1px solid #333; margin-top: 5px; padding: 20px; z-index: 1000; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 350px;">
                            <h6 style="margin: 0; font-size: 1.2em; font-weight: bold; color: #e0e0e0;">Account List</h6>

                            <div
                                style="padding: 10px; border-bottom: 1px solid #333; display: flex; justify-content: space-between; align-items: center;">
                                <div onclick="changeAccount('practice', 10000)"
                                    style="cursor: pointer; flex-grow: 1; color: #e0e0e0;">
                                    <strong>Practice Account</strong><br>
                                    <span style="font-size: 1.2em;">10,000 $</span><br>
                                    <span style="font-size: 0.9em; color: #bbbbbb;">Estimate Balance</span>
                                </div>
                                <button onclick="creditPracticeAccount()"
                                    style="background-color: green; color: white; border: none; padding: 8px 12px; border-radius: 5px; font-weight: bold; cursor: pointer; margin-left: 10px;">
                                    Credit
                                </button>
                            </div>

                            <div style="padding: 10px; border-bottom: 1px solid #333; display: flex; justify-content: space-between; align-items: center;">
                                <div onclick="changeAccount('real', {{ number_format($usd_sum, 2) }} {{ Auth::user()->currency }})" style="cursor: pointer; flex-grow: 1; color: #e0e0e0;">
                                    <strong>Real Account</strong><br>
                                    <span style="font-size: 1.2em;">{{ number_format($usd_sum, 2) }} {{ Auth::user()->currency }}</span><br>
                                    <span style="font-size: 0.9em; color: #bbbbbb;">Estimate Balance</span>
                                </div>
                                <button onclick="openDepositModal()"
                                    style="background-color: blue; color: white; border: none; padding: 8px 12px; border-radius: 5px; font-weight: bold; cursor: pointer; margin-left: 10px;">
                                    Deposit
                                </button>
                            </div>
                            
                            <div onclick="withdrawAll()"
                                style="cursor: pointer; padding: 10px; text-align: center; border-top: 1px solid #333; margin-top: 10px; color: #e0e0e0;">
                                <strong>Withdraw All</strong>
                            </div>
                        </div>

                        <div id="depositModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 1000;">
                            <div style="background: #1e1e1e; padding: 20px; border-radius: 5px; width: 300px; text-align: center; color: #e0e0e0;">
                                <h2>Deposit Funds</h2>
                                <p>Are you sure you want to proceed to deposit?</p>
                                <button onclick="window.location.href='{{route('user.deposit.page')}}'" style="background-color: green; color: white; border: none; padding: 8px 12px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                    Proceed to Deposit
                                </button>
                                <button onclick="closeModal()" style="background-color: red; color: white; border: none; padding: 8px 12px; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px;">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                        </i>
                        </a>
                    </li>

                    <li class="dropdown align-self-center mr-1 d-inline-block">
                        <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i
                                class="icon-bell h4"></i>
                            <span class="badge badge-default"> <span class="ring">
                                </span><span class="ring-point">
                                </span> </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right border py-0" style="background-color: #1e1e1e; border-color: #333;">
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                                    href="#" style="color: #e0e0e0;">
                                    <div class="media">
                                        <img src="/images/logo.jpg" alt=""
                                            class="d-flex mr-3 img-fluid rounded-circle w-50">
                                        <div class="media-body">
                                            <h6 style="color: #e0e0e0;">Welcome Back {{ Auth::user()->name }}!</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown user-profile d-inline-block py-1 mr-2">
                        <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <div class="media-body align-self-center d-none d-sm-block mr-2">
                                    <p class="mb-0 text-uppercase line-height-1"><b>
                                        </b><br /><span>
                                        </span></p>
                                </div>
                                <img src="{{asset('dist/images/profilep.png')}}" alt=""
                                    class="d-flex img-fluid rounded-circle" width="45">
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right p-0" style="background-color: #1e1e1e; border-color: #333;">
                            <a href="{{route('user.profile.page')}}" class="dropdown-item px-2 align-self-center d-flex" style="color: #e0e0e0;">
                                <span class="icon-user mr-2 h6 mb-0"></span> Profile</a>
                            <a href="{{route('user.withdraw.wallet')}}"
                                class="dropdown-item px-2 align-self-center d-flex" style="color: #e0e0e0;">
                                <span class="icon-user mr-2 h6 mb-0"></span> Withdrawal/Wallets</a>

                            <div class="dropdown-divider" style="border-color: #333;"></div>
                            <div class="dropdown-divider" style="border-color: #333;"></div>

                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <span class="icon-logout mr-2 h6 mb-0"> <button style="background: none; border: none; color: #e0e0e0; cursor: pointer;">logout</button></span>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <a href="#"
            class="sidebarCollapse float-right h6 dropdown-menu-right mr-2 mt-2 position-absolute d-block d-lg-none">
            <i class="icon-close"></i>
        </a>
        <a href="{{route('user.home.page')}}" class="sidebar-logo d-flex">
            <img src="{{asset('dist/images/logo.jpg')}}" alt=""
                class=" align-self-center mb-0 d-flex mr-3 img-fluid  w-100">
        </a>

        <div id="sidebar-container">
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active"><a href="{{route('user.home.page')}}"><i class="fas fa-home"></i> BOARD</a></li>
        <li class="dropdown"><a href="{{route('user.market.page')}}"><i class="fas fa-shopping-basket"></i> MARKET</a></li>
        <li class="dropdown"><a href="{{route('user.tradehistory.page')}}"><i class="fas fa-th"></i> HISTORY</a></li>
        <li class="dropdown"><a href="{{route('user.news.page')}}"><i class="fas fa-newspaper"></i> NEWS</a></li>
                <li class="dropdown">
                    <form action="{{ route('user.logout') }}" method="POST" style="margin: 0; padding: 0; display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="icon-logout"></i> LOGOUT
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <style>
            .logout-btn {
                display: flex;
                align-items: center;
                background-color: transparent;
                border: none;
                color: #e0e0e0;
                font-size: 11px;
                cursor: pointer;
                padding: 5px;
                transition: color 0.3s;
            }

            .logout-btn i {
                margin-right: 5px;
                font-size: 12px;
            }

            .logout-btn:hover {
                color: #ff4c4c;
            }

            .logout-btn:focus {
                outline: none;
            }

            #sidebar-container {
                height: 100vh;
                overflow-y: auto;
            }

            #side-menu {
                max-height: 100%;
                overflow-y: auto;
                padding-right: 5px;
            }

            #side-menu::-webkit-scrollbar {
                width: 6px;
            }

            #side-menu::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 3px;
            }

            #side-menu::-webkit-scrollbar-thumb:hover {
                background-color: #555;
            }
        </style>
    </div>

    <!-- Main Content -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><b> Hey {{Auth::user()->name}}! Welcome to your Portfolio</b></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#" style="color: #bb86fc;">Home</a></li>
                            <li class="breadcrumb-item active" style="color: #e0e0e0;">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-12  col-lg-12 col-xl-12 mt-3">
                <div class="card" style="background-color: #1e1e1e; border-color: #333;">
                    <!-- TradingView Widget for Gold/USD -->
                    <div class="tradingview-widget-container">
                        <div id="tradingview_gold" style="height: 600px;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            new TradingView.widget({
                                "autosize": true,
                                "symbol": "TVC:GOLD",
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "dark",
                                "style": "1",
                                "locale": "en",
                                "toolbar_bg": "#1e1e1e",
                                "enable_publishing": false,
                                "hide_top_toolbar": false,
                                "hide_side_toolbar": false,
                                "allow_symbol_change": true,
                                "container_id": "tradingview_gold",
                                "studies": [
                                    "BB@tv-basicstudies",
                                    "MACD@tv-basicstudies"
                                ],
                                "details": true
                            });
                        </script>
                    </div>

                    <!-- TradingView Stock Screener -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                            {
                                "width": "100%",
                                "height": 490,
                                "defaultColumn": "overview",
                                "screener_type": "stocks",
                                "displayCurrency": "USD",
                                "colorTheme": "dark",
                                "locale": "en",
                                "isTransparent": false
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('user.layouts.footer')

    <script>
        function openDepositModal() {
            document.getElementById('depositModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('depositModal').style.display = 'none';
        }

        function toggleDropdown() {
            var dropdown = document.getElementById('account-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        
        function changeAccount(accountType, balance) {
            const accountLabel = document.getElementById('account-type');
            const balanceLabel = document.getElementById('account-balance');

            if (accountType === 'practice') {
                accountLabel.innerHTML = 'PRACTICE ACCOUNT';
            } else if (accountType === 'real') {
                accountLabel.innerHTML = 'REAL ACCOUNT';
            }

            updateBalance(balance);
            toggleDropdown();
        }

        function updateBalance(newBalance) {
            const balanceLabel = document.getElementById('account-balance');
            const currentBalance = parseFloat(balanceLabel.innerText.replace(/[^0-9.]/g, ''));
            const increment = (newBalance - currentBalance) / 100;
            let count = 0;
            
            const interval = setInterval(() => {
                count += increment;
                balanceLabel.innerText = (currentBalance + count).toFixed(2) + ' {{ Auth::user()->currency }}';
                
                if (Math.abs(count) >= Math.abs(newBalance - currentBalance)) {
                    balanceLabel.innerText = newBalance.toFixed(2) + ' {{ Auth::user()->currency }}';
                    clearInterval(interval);
                }
            }, 10);
        }

        function withdrawAll() {
            alert('Withdraw All clicked!');
        }
        
        function creditPracticeAccount() {
            updateBalance(10000);
            document.getElementById('account-type').innerHTML = 'PRACTICE ACCOUNT';
            toggleDropdown();
            alert('Practice account credited with $10,000');
        }
    </script>
</body>
</html>
<!--End of Tawk.to Script-->
@include('user.layouts.footer')