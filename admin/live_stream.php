<?php
// Default videos and names for 30 users
$default_videos = [];
$default_names = [];
for ($i = 1; $i <= 30; $i++) {
    $default_videos["user_$i"] = '';
    $default_names["user_{$i}_name"] = "User $i";
}

// Get user inputs (fallback to defaults)
$participants = [];
for ($i = 1; $i <= 30; $i++) {
    $video_key = "user_$i";
    $name_key = "user_{$i}_name";

    $video = isset($_POST[$video_key]) && !empty($_POST[$video_key]) ? trim($_POST[$video_key]) : $default_videos[$video_key];
    $name = isset($_POST[$name_key]) && !empty($_POST[$name_key]) ? trim($_POST[$name_key]) : $default_names[$name_key];

    $participants[] = [
        'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
        'video' => htmlspecialchars($video, ENT_QUOTES, 'UTF-8')
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            margin: 20px;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background: #ddd;
            border-radius: 4px 4px 0 0;
            margin-right: 2px;
            user-select: none;
        }

        .tab.active {
            background: #0078d7;
            color: white;
        }

        .tab-content {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 0 4px 4px 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .tab-content.active {
            display: block;
        }

        .row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .col-input {
            flex: 1 1 auto;
        }

        input {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            background: #0078d7;
            color: white;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background: #005ea2;
        }

        .video-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .participant-card {
            background: white;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 ratio */
            height: 0;
            overflow: hidden;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 6px;
            border: none;
        }

        .participant-name {
            margin-top: 8px;
            font-weight: bold;
        }

        .unsupported,
        .teams-card {
            padding: 20px;
            background: #eee;
            border-radius: 6px;
        }

        a {
            color: #0078d7;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h2>Video Chat Embed</h2>

    <div class="tabs">
        <div class="tab active" data-tab="inputs">Inputs</div>
        <div class="tab" data-tab="videos">Video Chat</div>
    </div>

    <div class="tab-content active" id="inputs">
        <form method="POST">
            <button type="submit">Update All</button>
            <?php for ($i = 1; $i <= 30; $i++):
                $video_key = "user_$i";
                $name_key = "user_{$i}_name";
                $video_value = $participants[$i - 1]['video'];
                $name_value = $participants[$i - 1]['name'];
            ?>
                <div class="row">
                    <div class="col-input">
                        <input type="text" name="<?php echo $video_key; ?>" placeholder="Enter video URL (YouTube, Twitch, Facebook, Teams, CameraFTP...)" value="<?php echo $video_value; ?>">
                    </div>
                    <div class="col-input">
                        <input type="text" name="<?php echo $name_key; ?>" placeholder="User <?php echo $i; ?> Name" value="<?php echo $name_value; ?>">
                    </div>
                </div>
            <?php endfor; ?>
        </form>
    </div>

    <div class="tab-content" id="videos">
        <div class="video-container">
            <?php foreach ($participants as $participant): ?>
                <div class="participant-card">
                    <?php
                    $url = trim($participant['video']);
                    $safe_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
                    $embed_url = '';

                    if (!$url) {
                        echo '<div class="unsupported">No video link entered.</div>';
                    } elseif (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                        if (preg_match('/v=([^&]+)/', $url, $m)) $embed_url = "https://www.youtube.com/embed/{$m[1]}?autoplay=1&mute=1";
                        elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $m)) $embed_url = "https://www.youtube.com/embed/{$m[1]}?autoplay=1&mute=1";
                        elseif (strpos($url, '/embed/') !== false) $embed_url = $url;
                        if ($embed_url) echo '<div class="video-wrapper"><iframe src="' . $embed_url . '" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>';
                        else echo '<div class="unsupported">Invalid YouTube URL.<br><a href="' . $safe_url . '" target="_blank">Open on YouTube</a></div>';
                    } elseif (strpos($url, 'twitch.tv') !== false) {
                        if (preg_match('/twitch\.tv\/([^\/]+)/', $url, $matches)) {
                            $channel = $matches[1];
                            $domain = $_SERVER['HTTP_HOST'] ?? 'localhost';
                            $embed = "https://player.twitch.tv/?channel={$channel}&parent={$domain}";
                            echo '<div class="video-wrapper"><iframe src="' . $embed . '" allowfullscreen></iframe></div>';
                        } else echo '<div class="unsupported">Invalid Twitch URL.<br><a href="' . $safe_url . '" target="_blank">Open on Twitch</a></div>';
                    } elseif (strpos($url, 'teams.microsoft.com') !== false) {
                        echo '<div class="teams-card"><strong>Microsoft Teams Meeting</strong><br>
                              <a href="' . $safe_url . '" target="_blank" style="display:inline-block;margin-top:10px;padding:8px 12px;background:#0078d7;color:white;border-radius:4px;">Join Meeting</a></div>';
                    } elseif (strpos($url, 'facebook.com') !== false || strpos($url, 'fb.watch') !== false) {
                        $embed_url = "https://www.facebook.com/plugins/video.php?href=" . urlencode($url) . "&show_text=0&width=320";
                        echo '<div class="video-wrapper"><iframe src="' . $embed_url . '" allowfullscreen></iframe></div>';
                    } elseif (strpos($url, 'cameraftp.com') !== false) {
                        // ✅ CameraFTP Embed Handling
                        if (stripos($url, 'https://') === false) {
                            $url = 'https://' . ltrim($url, '/');
                        }
                        if (strpos($url, 'isEmbedded=true') !== false) {
                            echo '<div class="video-wrapper">
                                    <iframe src="' . $url . '" 
                                        allowfullscreen 
                                        scrolling="no" 
                                        style="border:0;overflow:hidden;" 
                                        loading="lazy">
                                    </iframe>
                                  </div>';
                        } else {
                            echo '<div class="teams-card">
                                    <strong>CameraFTP Link Detected</strong><br>
                                    <p>Please use the "Embed" version of your CameraFTP link (it should include <code>isEmbedded=true</code>).</p>
                                    <a href="' . $safe_url . '" target="_blank" style="display:inline-block;margin-top:10px;padding:8px 12px;background:#0078d7;color:white;border-radius:4px;">Open Camera</a>
                                  </div>';
                        }
                    } else {
                        echo '<div class="unsupported">Cannot embed this source.<br><a href="' . $safe_url . '" target="_blank">Open directly</a></div>';
                    }
                    ?>
                    <div class="participant-name"><?php echo $participant['name']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });

        // Auto-switch to video tab after submission
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            document.querySelector('.tab[data-tab="videos"]').click();
        <?php endif; ?>
    </script>

</body>
</html>
