<?php
require 'functions/functions.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/views/<?= $linkcss; ?>">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="node_modules/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.Default.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,700;1,800&family=Poppins:wght@200;300;400;500;600&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/logo/cilegon.png">
    <title><?= $nama_halaman; ?> | WEBGIS BAPPEDA CILEGON</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins:wght@200;300;400;500;600&family=Roboto&display=swap");

        hr {
            color: black !important;
            border-top: 1.3px solid orange;
            opacity: 1 !important;
            margin-top: 2px !important;
            margin-bottom: 2px !important;
        }

        /* Breadcrumb */
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

        .navbar-toggler {
            font-size: 30px !important;
            border: none !important;
        }

        .bi-x-circle:hover {
            transition: 0.3s !important;
            color: red !important;
        }

        button.navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }

        /* Navbar */
        .navbar {
            font-family: Poppins !important;
            font-size: 16px !important;
            font-weight: 500;
        }

        .nav-link {
            font-weight: 500;
            background-image: linear-gradient(to right, orange, orange 50%, rgb(98, 98, 98) 50%);
            background-size: 200% 100%;
            background-position: -100%;
            display: inline-block;
            padding: 5px 0;
            position: relative;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.6s ease-in-out;
        }

        .nav-link::before {
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
            background-position: 100%;
            background-image: none;
            background-color: orange;
            animation: fadeInOut 0.8s ease infinite;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        @media screen and (max-width:990px) {
            .navbar-nav {
                margin-top: 15px !important;
                margin-bottom: 15px !important;
            }
        }

        .dropdown-menu {
            margin-top: 10px !important;
            overflow: hidden !important;
            border: 1.3px solid orange;
        }

        @media screen and (max-width:990px) {
            .dropdown-menu {
                width: 35% !important;
                margin-top: 10px !important;
                margin-bottom: 7px !important;
            }

            .nav-item {
                margin-bottom: 5px !important;
            }
        }

        @media screen and (max-width:550px) {
            .dropdown-menu {
                width: 70% !important;
                margin-top: 10px !important;
                margin-bottom: 7px !important;
            }
        }

        @media screen and (max-width:400px) {
            .dropdown-menu {
                width: 85% !important;
                margin-top: 10px !important;
                margin-bottom: 7px !important;
            }
        }

        .dropdown-item {
            background-color: transparent;
            background-image: linear-gradient(to right, transparent 0%, transparent 50%, orange 50%, orange 100%);
            background-size: 200% 100%;
            background-position: 0%;
            transition: background-position 0.5s;
            font-weight: 400;
            color: #4a5159;
            /* margin-top: 2px !important;
        margin-bottom: 2px !important; */
        }

        .dropdown-item:hover {
            background-position: 100%;
            font-weight: 500;
            color: #343a40 !important;
            animation: fadeInOut2 0.8s ease infinite;
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes fadeInOut2 {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .geser:hover {
            margin-right: 20px !important;
        }

        .orange {
            color: orange !important;
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

        .running-text {
            display: flex;
            align-items: center;
            padding: 0;
            height: 30px !important;
            font-family: "Montserrat", sans-serif !important;
        }

        .running-left {
            flex: 1;
            height: 100% !important;
        }

        .running-right {
            flex: 3;
            overflow: hidden;
            height: 100% !important;
        }

        #clock {
            font-size: 21px;
            margin: 0;
        }

        marquee {
            font-size: 18px;
            white-space: nowrap;
        }
    </style>
</head>

<body>