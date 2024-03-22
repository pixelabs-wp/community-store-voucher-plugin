<?php
$notifications = CSVP_Notification::get();
foreach ($notifications as $notification) {
    echo "<script>toastr." . $notification['type'] . "('" . $notification['message'] . "');</script>";
} ?>
<script src="<?php echo CSVP_PLUGIN_PATH;  ?>assets/dist/js/export.js"></script>:
