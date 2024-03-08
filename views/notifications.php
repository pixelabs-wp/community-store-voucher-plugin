<?php
$notifications = CSVP_Notification::get();
foreach ($notifications as $notification) {
    echo "<script>toastr." . $notification['type'] . "('" . $notification['message'] . "');</script>";
}