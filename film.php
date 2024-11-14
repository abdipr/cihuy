<?php
// Ambil ID film dari URL
$film_id = $_GET['id'];
$api_url = "https://api-abdi.glitch.me/api/lk21/detail.php?id=$film_id";

// Fetch data film menggunakan cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);

if ($data['status'] != 200) {
    echo "<h1>Film tidak ditemukan.</h1>";
    exit;
}

$film = $data['data'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($film['judul']); ?> - Cihuy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Onest', sans-serif; margin: 0; padding: 0; background-color: #f4f4f9; color: #333; }
        .header { position: sticky; top: 0; background: #222; color: #fff; padding: 10px 20px; text-align: center; font-weight: bold; font-size: 1.2em; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .film-title { font-size: 1.8em; font-weight: 600; margin: 10px 0; }
        .film-img { width: 100%; height: auto; border-radius: 8px; margin-bottom: 20px; }
        .film-meta { font-size: 0.9em; color: #666; }
        .film-meta span { margin-right: 10px; }
        .film-description { margin: 15px 0; line-height: 1.6; }
        .film-iframe { width: 100%; height: 400px; border: none; border-radius: 8px; }
        .btn-trailer { display: inline-block; padding: 10px 20px; margin-top: 15px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<div class="header">Cihuy</div>

<div class="container">
    <img src="<?php echo htmlspecialchars($film['image']); ?>" alt="<?php echo htmlspecialchars($film['judul']); ?>" class="film-img">
    <h1 class="film-title"><?php echo htmlspecialchars($film['judul']); ?></h1>
    
    <div class="film-meta">
        <span><strong>IMDB:</strong> <?php echo htmlspecialchars($film['rating_imdb']); ?></span>
        <span><strong>Durasi:</strong> <?php echo htmlspecialchars($film['durasi']); ?></span>
        <span><strong>Rilis:</strong> <?php echo htmlspecialchars($film['rilis']); ?></span>
    </div>
    
    <div class="film-meta">
        <span><strong>Kualitas:</strong> <?php echo htmlspecialchars($film['kualitas']); ?></span>
        <span><strong>Negara:</strong> <?php echo htmlspecialchars($film['negara']); ?></span>
        <span><strong>Genre:</strong> <?php echo implode(", ", $film['genre']); ?></span>
    </div>

    <div class="film-meta">
        <span><strong>Sutradara:</strong> <?php echo htmlspecialchars($film['sutradara']); ?></span>
        <span><strong>Pemeran:</strong> <?php echo implode(", ", $film['pemeran']); ?></span>
    </div>

    <p class="film-description"><?php echo htmlspecialchars($film['sinopsis']); ?></p>

    <iframe src="<?php echo htmlspecialchars($film['iframe']); ?>" class="film-iframe" allowfullscreen></iframe>
    
    <?php if (!empty($film['trailer'])): ?>
        <a href="<?php echo htmlspecialchars($film['trailer']); ?>" target="_blank" class="btn-trailer">Lihat Trailer</a>
    <?php endif; ?>
</div>

</body>
</html>
