<?php
// Sample data for cards
$cards = [
    [
        'title' => 'Card 1',
        'description' => 'This is the first card.',
        'image' => 'https://via.placeholder.com/150'
    ],
    [
        'title' => 'Card 2',
        'description' => 'This is the second card.',
        'image' => 'https://via.placeholder.com/150'
    ],
    [
        'title' => 'Card 3',
        'description' => 'This is the third card.',
        'image' => 'https://via.placeholder.com/150'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Card Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 50px;
        }
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 250px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-description {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <?php foreach($cards as $card): ?>
            <div class="card">
                <img src="<?php echo $card['image']; ?>" alt="<?php echo $card['title']; ?>">
                <div class="card-body">
                    <div class="card-title"><?php echo $card['title']; ?></div>
                    <div class="card-description"><?php echo $card['description']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>