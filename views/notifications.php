<?php
$notifications = CSVP_Notification::get();
foreach ($notifications as $notification) {
    echo "<script>toastr." . $notification['type'] . "('" . $notification['message'] . "');</script>";
} ?>
<script src="<?php echo CSVP_PLUGIN_URL;  ?>assets/dist/js/export.js"></script>:
<script>
    function outToExcel(data) {
        const exporter = new ExportToCSV(data);
        exporter.processData();
    }
</script>