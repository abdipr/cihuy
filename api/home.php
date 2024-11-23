<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cihuy</title>
    <link rel="icon" type="image/png" href="https://raw.githubusercontent.com/abdipr/cihuy/refs/heads/main/assets/cihuy-icon.png">
    <link rel="apple-touch-icon" href="https://raw.githubusercontent.com/abdipr/cihuy/refs/heads/main/assets/cihuy-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-1: #F4D24F;
            --color-2: #EAB124;
            --light-bg: #f4f4f9;
            --dark-bg: #161617;
            --light-text: #333;
            --dark-text: #fff;
        }

        body {
            font-family: 'Onest', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
            color: var(--light-text);
            transition: background-color 0.3s ease, color 0.3s ease;
            scroll-behavior: smooth; /* Smooth scroll */
        }
        h2 {
            color: var(--color-2);
        }

        .header {
            position: sticky;
            top: 0;
            background: #222;
            color: #fff;
            padding: 10px 10px;
            font-weight: bold;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
        }

        .container {
            align-items: center;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .content-wrapper img {
            max-width: 30%;
            height: auto;
        }

        .content-wrapper h1 {
            font-size: 2em;
            margin: 0;
        }

        .content-wrapper .btn {
            margin-top: 10px;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        body.dark-mode .container {
            background: #333;
        }

        /* Media query untuk mobile */
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
                text-align: center;
            }

            .content-wrapper img {
                max-width: 80%;
                margin-top: 20px;
            }
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--color-1);
            color: #222;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: var(--color-2);
        }

        .toggle-btn {
            cursor: pointer;
            background: none;
            border: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .toggle-btn svg {
            width: 20px;
            height: 20px;
            fill: var(--color-1);
        }
    </style>
</head>
<body>

<?php include "header.php";?>

<div class="container" style="height:calc(100vh-5px);">
    <div class="content-wrapper">
        <div>
            <h1>This is Cihuy Team</h1>
            <a href="#about" class="btn">Cihuy</a>
        </div>
        <img src="https://raw.githubusercontent.com/abdipr/cihuy/refs/heads/main/assets/cihuy.png" alt="Cihuy">
    </div>
</div>

<div class="container" id="about">
    <h2>Siapakah kami?</h2>
    <p>Kami adalah Cihuy Team, sebuah tim yang dibentuk untuk menyelesaikan tugas sekolah. Namun, kami berencana untuk terus berkembang dan berkontribusi di dunia luar setelahnya. Kami memiliki semangat untuk terus belajar dan menerapkan ilmu yang kami dapatkan.</p>
</div>
<div class="container" id="skill">
    <h2>Apa yang Kami Buat?</h2>
    <p>Kami telah membuat berbagai proyek yang berkaitan dengan bidang Teknik Komputer dan Jaringan (TKJ) serta pengembangan keterampilan di bidang teknologi informasi. Berikut adalah beberapa keterampilan yang kami kuasai:</p>
    
    <ul>
        <li>Microsoft Office Suite (Excel, Word, PowerPoint)</li>
        <li>Instalasi Sistem Operasi (Windows, Linux)</li>
        <li>Manajemen Pengguna & Grup</li>
        <li>Konfigurasi Server DHCP</li>
        <li>Pengaturan Server FTP</li>
        <li>Konfigurasi Server DNS</li>
        <li>Pengaturan SSH untuk Akses Jarak Jauh</li>
        <li>Pengaturan RDP untuk Remote Desktop</li>
        <li>Konfigurasi Web Server</li>
        <li>Konfigurasi Mikrotik (Setup Dasar, Alamat IP, DHCP, Firewall)</li>
    </ul>
</div>


<script src="api/script.js"></script>

</body>
</html>
