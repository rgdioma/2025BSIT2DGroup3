<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Global Styles -->
<link rel="stylesheet" href="assets/css/header_footer_styles.css">

<!-- Page-specific Styles -->
<?php
if (isset($additional_css) && is_array($additional_css)) {
    foreach ($additional_css as $css) {
        echo '<link rel="stylesheet" href="'.$css.'">' . "\n";
    }
}
?>

<title><?php echo isset($page_title) ? $page_title : 'HeatGuard - Traffic Enforcer Heat Safety System'; ?></title>
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
<div class="nav-container">
<a href="#home" class="logo">🚦 HeatGuard</a>

<ul class="nav-menu">
<li><a href="#home">Home</a></li>
<li><a href="#features">Features</a></li>
<li><a href="#about">About</a></li>
<li><a href="#contact">Contact</a></li>
</ul>

<div class="nav-icons">
<img src="https://img.icons8.com/material-outlined/24/search.png" alt="Search" class="nav-icon">
<img src="https://img.icons8.com/ios-glyphs/24/appointment-reminders.png" alt="Notifications" class="nav-icon has-notification">
<img src="https://img.icons8.com/ios-glyphs/24/user.png" alt="Profile" class="nav-icon">
</div>

<div class="hamburger">
<span></span>
<span></span>
<span></span>
</div>
</div>
</nav>
