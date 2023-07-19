<?php
require 'functions/functions.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/views/<?= $linkcss; ?>">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="node_modules/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.Default.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,700;1,800&family=Poppins:wght@200;300;400;500;600&family=Roboto:ital,wght@0,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="icon" href="assets/logo/cilegon.png">
    <title><?= $nama_halaman; ?> | CILEGON GIS</title>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins:wght@200;300;400;500;600&family=Roboto&display=swap");

    .breadcrumb {
        font-family: "Poppins", sans-serif !important;
        font-weight: 400 !important;
        font-size: 14px !important;
    }

    @media screen and (max-width: 600px) {
        .breadcrumb {
            font-size: 12px !important;
        }
    }

    .bread-actived {
        font-weight: 500;
        background-image: linear-gradient(to right,
                orange,
                orange 50%,
                rgb(98, 98, 98) 50%);
        background-size: 200% 100%;
        background-position: -100%;
        display: inline-block;
        position: relative;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.6s ease-in-out;
    }

    .bread-actived:before {
        content: "";
        background: orange;
        display: block;
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 3px;
        transition: all 0.4s ease-in-out;
    }

    .bread-actived:hover {
        background-position: 0;
    }

    .bread-actived:hover::before {
        width: 100%;
    }

    .custom-toggler {
        font-size: 25px !important;
        margin-right: 10px !important;
    }

    .custom-toggler .navbar-toggler-icon {
        background-image: none;
        transition: transform 0.4s ease-in-out;
    }

    .custom-toggler .navbar-toggler-icon.bars {
        transform: rotate(0deg);
    }

    .custom-toggler .navbar-toggler-icon.times {
        transform: rotate(45deg);
    }

    .nav-toggler {
        border: none;
        outline: none;
        background-color: transparent;
        padding: 0;
        width: 30px;
        height: 30px;
        position: relative;
        cursor: pointer;
        overflow: hidden !important;
    }

    .nav-toggler span {
        display: block;
        position: absolute;
        height: 2px;
        width: 100%;
        background-color: #fff;
        border-radius: 2px;
        opacity: 1;
        left: 0;
        transform: rotate(0);
        transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out;
    }

    .nav-toggler span:nth-child(1) {
        top: 0;
    }

    .nav-toggler span:nth-child(2),
    .nav-toggler span:nth-child(3) {
        top: 8px;
    }

    .nav-toggler span:nth-child(4) {
        top: 16px;
    }

    .nav-toggler.open span:nth-child(1) {
        top: 8px;
        transform: rotate(45deg);
    }

    .nav-toggler.open span:nth-child(2) {
        opacity: 0;
    }

    .nav-toggler.open span:nth-child(3) {
        top: 8px;
        transform: rotate(-45deg);
    }

    .nav-toggler.open span:nth-child(4) {
        top: 8px;
        transform: rotate(45deg);
    }

    .nav-link {
        font-weight: 500;
        background-image: linear-gradient(to right,
                orange,
                orange 50%,
                rgb(98, 98, 98) 50%);
        background-size: 200% 100%;
        background-position: -100%;
        display: inline-block;
        padding: 5px 0;
        position: relative;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.6s ease-in-out;
    }

    .nav-link:before {
        content: "";
        background: orange;
        display: block;
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 3px;
        transition: all 0.6s ease-in-out;
    }

    .nav-link:hover {
        background-position: 0;
    }

    .nav-link:hover::before {
        width: 100%;
    }

    .navbar-nav {
        margin-right: 110px !important;
    }

    /* DROPDOWN */
    @media screen and (max-width: 900px) {
        .dropdown-menu {
            background-color: transparent;
            border: none;
        }

        .dropdown {
            width: 35%;
        }
    }

    .dropdown-menu {
        background-color: white !important;
        padding: 0;
    }

    .dropdown-item {
        box-shadow: inset 0 0 0 0 rgb(203, 203, 203);
        color: rgb(203, 203, 203);
        transition: color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .dropdown-item:hover {
        color: #3b3b3b;
        box-shadow: inset 200px 0 0 0 rgb(203, 203, 203);
    }

    /* Presentational styles */
    .dropdown-item {
        color: rgb(98, 98, 98);
        font-family: "Poppins", sans-serif;
    }

    .geser:hover {
        margin-right: 20px !important;
    }

    /* Footer */

    .footer {
        /* background-color: lavenderblush !important; */
        color: #fff;
        padding: 30px 0;
        width: 100%;
    }

    .footer .row {
        margin-bottom: 20px;
    }

    .footer .col-lg-3 {
        margin-bottom: 20px;
    }

    .footer h5 {
        color: #fff;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .footer p {
        font-size: 14px;
    }

    .footer .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: #fff;
        color: #333;
        text-align: center;
        margin-right: 10px;
    }

    .list-link li a {
        color: white !important;
        font-weight: 500;
        background-image: linear-gradient(to right,
                orange,
                orange 50%,
                white 50%);
        background-size: 200% 100%;
        background-position: -100%;
        display: inline-block;
        position: relative;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.6s ease-in-out;
    }

    .list-link li a:before {
        content: "";
        background: orange;
        display: block;
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 3px;
        transition: all 0.4s ease-in-out;
    }

    .list-link li a:hover {
        background-position: 0;
    }

    .list-link li a:hover::before {
        width: 100%;
    }

    .orange {
        color: orange !important;
    }

    .instagram,
    .twitter,
    .facebook,
    .youtube {
        background-color: transparent !important;
        color: white !important;
        outline: 2px solid white;
    }

    .instagram:hover,
    .twitter:hover,
    .facebook:hover,
    .youtube:hover {
        outline: 2px solid orange;

    }

    .instagram:hover {
        background: linear-gradient(to right, #833AB4, #E1306C);
        animation: shake 0.5s infinite;
    }

    .youtube:hover {
        /* background: linear-gradient(to right, #FF0000); */
        background-color: #FF0000 !important;
        animation: shake 0.5s infinite;
    }

    .twitter:hover {
        background: linear-gradient(to right, #1DA1F2, #1DA1F2);
        animation: shake 0.5s infinite;
    }

    .facebook:hover {
        background: linear-gradient(to right, #4267B2, #1DA1F2);
        animation: shake 0.5s infinite;
    }

    /* Offcanvas / Spasial */
    .btn-close-canvas {
        transition: all .3s;
    }

    .btn-close-canvas:hover {
        animation: shake 0.5s infinite !important;
        color: red !important;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-2px);
        }

        50% {
            transform: translateX(2px);
        }

        75% {
            transform: translateX(-2px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .social-icons a {
        transition: all 0.2s ease-in-out;
        position: relative;
    }

    .footer {
        background-image: url(assets/index/footer2.jpg);
    }

    .bg-orange {
        background-color: orange !important;
    }
    </style>
</head>

<body>