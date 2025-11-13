<?php 
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
?>
<h3 style="text-align: center;">Night Shift Users Monitor</h3>
<h3 style="text-align: center;">Date: <?php echo $date; ?></h3>
<h2 class="fw-bold mt-3" style="text-align: center; font-family: 'Courier New', monospace;">
  <span id="liveTime2" class="text-primary"></span>
</h2>

<div id="onlineUsersTable">
    <?php include 'monitor_nightshift.php'; ?>
</div>

<script>
// Refresh table every 5 seconds
setInterval(function() {
    fetch('monitor_nightshift.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('onlineUsersTable').innerHTML = html;
        });
}, 5000); // 5000ms = 5 seconds
</script>



<script>
  function updateLiveTime() {
    const timeElement = document.getElementById("liveTime2");
    if (!timeElement) return; // prevent errors if element isn't found

    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // 24-hour format
    };

    timeElement.textContent = now.toLocaleTimeString([], options);
  }

  // Initialize immediately
  updateLiveTime();

  // Update every second
  setInterval(updateLiveTime, 1000);
</script>