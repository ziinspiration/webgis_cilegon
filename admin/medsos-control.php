<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require_once 'functions/functions.php';

$conn = koneksi();

$getinstagram = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'instagram'");
$getyoutube = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'youtube'");
$gettwitter = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'twitter'");
$getfacebook = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'facebook'");
$getmarquee = query("SELECT * FROM informasi_bappeda WHERE jenis_informasi ='marquee'");

$nama_halaman = 'Media sosial control';
$linkcss = 'medsos-control.css';
require 'views/medsos-control.view.php';
