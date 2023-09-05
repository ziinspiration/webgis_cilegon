<?php
require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Forbiden';
$linkcss = 'forbiden.css';
require 'views/forbiden.view.php';
