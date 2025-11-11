<?php
$participants = [
    [
        'name' => 'User 1',
        'video' => 'https://www.youtube.com/embed/PGIalZd9WPs?autoplay=1&mute=1' // YouTube embed
    ],
    [
        'name' => 'User 2',
        'video' => 'https://www.facebook.com/live/producer/685814970944377/'
    ],
    [
        'name' => 'User 3',
        'video' => 'https://www.w3schools.com/html/mov_bbb.mp4'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Video Chat</title>
<style>
    body { font-family: Arial; background: #f4f4f4; display: flex; justify-content: center; padding: 50px; }
    .video-container { display: flex; gap: 20px; flex-wrap: wrap; }
    .participant-card { background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 250px; overflow: hidden; display: flex; flex-direction: column; align-items: center; padding: 10px; }
    .participant-name { font-size: 16px; font-weight: bold; margin: 10px 0; }
    video, iframe { width: 100%; border-radius: 8px; background: black; height: 150px; }
</style>
</head>
<body>
<div class="video-container">
    <?php foreach($participants as $participant): ?>
        <div class="participant-card">
            <?php if (strpos($participant['video'], 'youtube.com') !== false): ?>
                <iframe src="<?php echo $participant['video']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            <?php else: ?>
                <video src="<?php echo $participant['video']; ?>" controls autoplay muted></video>
            <?php endif; ?>
            <div class="participant-name"><?php echo $participant['name']; ?></div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
