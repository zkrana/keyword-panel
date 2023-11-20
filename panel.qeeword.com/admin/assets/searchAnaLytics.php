<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("session.php");

// Define the number of records per page
$records_per_page = 30;

// Fetch last date initially
$queryLastDate = "SELECT DISTINCT DATE(search_time) as last_date FROM search_logs ORDER BY search_time DESC LIMIT 1";
$lastDateResult = mysqli_query($connect, $queryLastDate);
$lastDate = mysqli_fetch_assoc($lastDateResult)['last_date'];

// Get the selected date from the user input or default to the last date
$user_selected_date = isset($_GET['selected_date']) ? $_GET['selected_date'] : $lastDate;

// Calculate the offset for the main query
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;

// Modify the query based on the selected date
if ($user_selected_date) {
    $query = "SELECT id, search_query, user_ip, search_time FROM search_logs WHERE DATE(search_time) = '$user_selected_date' LIMIT $offset, $records_per_page";
    // Modify the total records query similarly to filter by the selected date
    $total_records_query = "SELECT COUNT(DISTINCT search_query) as total FROM search_logs WHERE DATE(search_time) = '$user_selected_date'";
} else {
    $query = "SELECT id, search_query, user_ip, search_time FROM search_logs LIMIT $offset, $records_per_page";
    $total_records_query = "SELECT COUNT(DISTINCT search_query) as total FROM search_logs";
}

// Execute the modified queries
$result = mysqli_query($connect, $query);
$total_records_result = mysqli_query($connect, $total_records_query);

// Fetch total records without pagination
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch data with pagination from the database, including the count of searches for each unique keyword
$countQuery = "SELECT MAX(id) as id, search_query, MAX(user_ip) as user_ip, MAX(search_time) as search_time, COUNT(*) as search_count
               FROM search_logs";
if ($user_selected_date) {
    $countQuery .= " WHERE DATE(search_time) = '$user_selected_date'";
}
$countQuery .= "GROUP BY search_query
                ORDER BY id ASC
                LIMIT $offset, $records_per_page";
$countResult = mysqli_query($connect, $countQuery);

// Check if there are no records for the selected date
$noLogsForDate = mysqli_num_rows($countResult) === 0 && $user_selected_date !== null;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Qeeword Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.svg">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../css/style2.css" rel="stylesheet"/>
    <style>
         @media(max-width:991px){
             .pagination{
             overflow-x: scroll;
             }
         }
         @media (max-width: 575px){
             .mb-card-h{
                 flex-direction: column;
                 gap: 15px;
             }
         }
        canvas {
            max-width: 800px;
            margin: 20px auto;
        }
        .dateFilterForm{
            display: flex;
            gap: 12px;
            align-items:center;
        }
        .dateFilterForm input {
          width: 160px;
        background: #fdb15e;
        color: #131331 !important;
          cursor: pointer;
        }
        .dateFilterForm input:nth-child(2) {
          border: unset;
          height: 40px;
          border-radius: 4px;
          width: 100px;
        }
    </style>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src">
                    <a href="dashboard.php"><img src="../assets/img/logo.png" width="200" height="40"></a>
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="manageuser.php" class="nav-link">
                                <i class="nav-link-icon fas fa-users"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="viewAllEmail.php" class="nav-link">
                                <i class="nav-link-icon fas fa-users"></i>
                                All Emails
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="searchAnaLytics.php" class="nav-link">
                                <i class="nav-link-icon  fa-brands fa-searchengin"></i>
                                Search Analytics
                            </a>
                        </li>
                    </ul>        
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item"><a href="useraccount.php">Profile</a></button>
                                            <button type="button" tabindex="0" class="dropdown-item"><a href="logout.php">Logout</a></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $login_session; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Qeeword <?php echo ucfirst($login_role); ?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                <span class="prfil-img"><img width="40" height="40" src="img/uploads/user_photo/<?php echo $user_photo; ?>" alt=""> </span> 
                                      
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Header
                                                </div>
                                                <div class="widget-subheading">Makes the header top fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Sidebar
                                                </div>
                                                <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Footer
                                                </div>
                                                <div class="widget-subheading">Makes the app footer bottom fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>
                                Header Options
                            </div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Sidebar Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Main Content Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Page Section Tabs
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                Line
                                            </button>
                                            <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                Shadow
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading"> Manage Data </li>

                                <li>
                                    <a href="addkeyword.php">
                                        <i class="fa-solid fa-plus metismenu-icon pe-7s-cash"></i>
                                        Add Keyword 
                                    </a>
                                    
                                </li>
                                 <li>
                                    <a href="dashboard.php">
                                        <i class="fa-solid fa-building-columns metismenu-icon pe-7s-cash"></i>
                                        List Keyword 
                                    </a>
                                    
                                </li>
                                <li  >
                                    <a href="manageuser.php">
                                        <i class="fa-solid fa-user metismenu-icon pe-7s-user"></i>
                                        Manage Users
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="fas fa-users-cog" size="9x"></i>
                                    </div>
                                    <div>Admin Dashboard
                                        <div class="page-title-subheading">Welcome to keyword admin control panel.
                                        </div>
                                    </div>
                                </div>
                                  
                            </div>
                        </div>            
                        
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Search</div>
                                            <div class="widget-subheading">Count till the last search</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <?php
                                            // Fetch total search count
                                            $select_user_data = "SELECT COUNT(*) as total_search FROM search_logs";
                                            $user_count_data = mysqli_query($connect, $select_user_data);
                                            $total_search_count = mysqli_fetch_assoc($user_count_data)['total_search'];
                        
                                            if ($user_count_data) {
                                                ?>
                                                <div class="widget-numbers text-white">
                                                    <span><?php echo $total_search_count; ?></span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Best Searched Keyword</div>
                                            <div class="widget-subheading">Total counted</div>
                                        </div>
                                        <div class="widget-content-right" style="width:auto; text-right;">
                                            <?php
                                            // Fetch the most searched keyword
                                            $best_searched_query = "SELECT search_query, COUNT(*) as keyword_count FROM search_logs GROUP BY BINARY search_query ORDER BY keyword_count DESC LIMIT 1";
                                            $best_searched_result = mysqli_query($connect, $best_searched_query);
                                    
                                            if ($best_searched_result && mysqli_num_rows($best_searched_result) > 0) {
                                                $best_searched_row = mysqli_fetch_assoc($best_searched_result);
                                                $best_keyword_name = $best_searched_row['search_query'];
                                                $best_keyword_count = $best_searched_row['keyword_count'];
                                                ?>
                                                <div class="widget-numbers text-white" style="min-width:200px;font-size:17px; text-align:right;">
                                                    <span><?php echo $best_keyword_name; ?> (<?php echo $best_keyword_count; ?> times)</span>
                                                </div>
                                                <?php
                                            } else {
                                                // Handle case where there are no searches or an error occurred
                                                ?>
                                                <div class="widget-numbers text-white" style="min-width:200px;font-size:17px; text-align:right;">
                                                    <span>No searches yet</span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <a href="dashboard.php"><button class="btn btn-primary user-add"> <i class="fas fa-user-plus"></i>  Go to Dashboard </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 cardmain-card-dashboard overFlow">
                                    <div class="card-header mb-card-h" style="display:flex; justify-content: space-between; align-items:center;">
                                        <span> Analytics Chart </span>
                                    </div>
                                    <?php
                        
                                    // Fetch data for chart
                                    $chartData = [];
                                    $chartLabels = [];
                        
                                    $query = "SELECT DATE(search_time) as search_date, COUNT(*) as search_count FROM search_logs GROUP BY search_date";
                                    $result = $connect->query($query);
                        
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            $chartLabels[] = $row['search_date'];
                                            $chartData[] = $row['search_count'];
                                        }
                                    } else {
                                        // Handle database error
                                        // You might want to log this error for further investigation
                                        die("Error: " . $connect->error);
                                    }
                                    ?>
                        
                                    <div class="table-responsive">
                                        <!-- Chart Container -->
                                        <div style="width: 80%; margin: auto;">
                                            <canvas id="searchChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 cardmain-card-dashboard overFlow">
                                    <div class="card-header mb-card-h" style="display:flex; justify-content: space-between; align-items:center;">
                                        <span> Search Detail's </span>
                                        <form class="dateFilterForm" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="date" name="selected_date" value="<?php echo htmlspecialchars($user_selected_date); ?>">
                                            <input type="submit" value="Filter">
                                            <input type="hidden" name="page" value="<?php echo $page; ?>">
                                        </form>

                                    </div>
                                    <!-- Your existing HTML code for the table -->
                                    <div class="table-responsive">
                                        <table class="table table-sm table-dark">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Keyword Name</th>
                                                    <th scope="col">See Details</th>
                                                    <th scope="col">Search Date</th>
                                                    <th scope="col">Total Search</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <?php
                                                if ($noLogsForDate) {
                                                    echo '<tr><td colspan="5">There are no logs for this date.</td></tr>';
                                                } else {
                                                    $sequentialId = $offset + 1; // Initialize sequential ID based on the offset
                                                    while ($data = mysqli_fetch_assoc($countResult)) {
                                                        // Display data for each row
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $sequentialId++; ?></td>
                                                            <td><?php echo $data['search_query']; ?></td>
                                                            <td>
                                                                <!-- Add a link to open a new page -->
                                                                <a class="see-details-btn" href="user_details.php?search_query=<?php echo urlencode($data['search_query']); ?>">See Details</a>
                                                            </td>
                                                            <td><?php echo isset($data['search_time']) ? date("d M Y", strtotime($data['search_time'])) : 'N/A'; ?></td>
                                                            <td><?php echo $data['search_count']; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pagination mb-3">
                            <ul class="pagination" style="display: flex; margin: 0 auto;">
                                <!-- Pagination links -->
                                <?php
                                if ($page > 1) {
                                    $prev_page = $page - 1;
                                    echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . $prev_page . "&selected_date=" . urlencode($user_selected_date) . "'>Previous</a></li>";
                                }
                                
                                $visible_pages = 3; // Number of visible page links
                                $half_visible_pages = ($visible_pages - 1) / 2;
                                
                                // Calculate the range of pages to display
                                $start_page = max(1, $page - $half_visible_pages);
                                $end_page = min($total_pages, $start_page + $visible_pages - 1);
                                
                                // Show the first page if it's not included in the range
                                if ($start_page > 1) {
                                    echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=1&selected_date=" . urlencode($user_selected_date) . "'>1</a></li>";
                                    echo "<li class='page-item'><span class='page-link'>...</span></li>";
                                }
                                
                                for ($i = $start_page; $i <= $end_page; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . $i . "&selected_date=" . urlencode($user_selected_date) . "'>" . $i . "</a></li>";
                                }
                                
                                if ($end_page < $total_pages) {
                                    echo "<li class='page-item'><span class='page-link'>...</span></li>";
                                    echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . $total_pages . "&selected_date=" . urlencode($user_selected_date) . "'>$total_pages</a></li>";
                                }
                                
                                if ($page < $total_pages) {
                                    $next_page = $page + 1;
                                    echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . $next_page . "&selected_date=" . urlencode($user_selected_date) . "'>Next</a></li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="app-wrapper-footer">
                            <div class="app-footer">
                                <div class="app-footer__inner">
                                    <span>
                                        <a href="javascript:void(0);" class="nav-link">
                                            © All Rights Reserved
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
    
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
    
    <!-- Script to create the chart -->
    <script>
        // Chart Data
        var chartData = {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                label: 'Number of Searches',
                data: <?php echo json_encode($chartData); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
    
        // Chart Configuration
        var chartConfig = {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        };
    
        // Create the chart
        var ctx = document.getElementById('searchChart').getContext('2d');
        var myChart = new Chart(ctx, chartConfig);
    </script>
</body>
</html>
<?php
// Close the database connection
mysqli_close($connect);
?>
