<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/<?= $linkcss; ?>">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/MarkerCluster.Default.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,700;1,800&family=Poppins:wght@200;300;400;500;600&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="icon" href="../assets/logo/cilegon.png">
    <title><?= $nama_halaman; ?> | CILEGON GIS</title>
    <style>
        .bg-orange {
            background-color: orange !important;
        }

        .bg-orange:hover {
            background-color: grey !important;
        }

        .btn-search {
            padding: 8px 12px 8px 12px !important;
        }

        .btn-search:hover {
            background-color: orange !important;
        }

        .input-search {
            padding: 10px !important;
        }

        .searching {
            width: 35% !important;
        }

        @media screen and (max-width: 900px) {
            .searching {
                width: 50% !important;
                margin-top: 40px !important;
                margin-bottom: 50px !important;
            }
        }

        @media screen and (max-width: 550px) {
            .searching {
                width: 75% !important;
                display: flex !important;
                margin: auto !important;
                margin-top: 30px !important;
                margin-bottom: 40px !important;
            }
        }

        .sidebar {
            padding: 20px !important;
            height: 100% !important;
        }
    </style>
</head>

<body>