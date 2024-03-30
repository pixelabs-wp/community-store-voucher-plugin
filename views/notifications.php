<?php
$notifications = CSVP_Notification::get();
foreach ($notifications as $notification) {
    echo "<script>toastr." . $notification['type'] . "('" . $notification['message'] . "');</script>";
} ?>
<script src="<?php echo CSVP_PLUGIN_URL; ?>assets/dist/js/export.js"></script>
<script>
    function outToExcel(data) {
        const exporter = new ExportToCSV(data);
        exporter.processData();
    }
</script>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Select all elements with the class "reset" and add a click event listener to each
    document.querySelectorAll(".reset").forEach(function(element) {
      element.addEventListener("click", function() {
        // Reload the page
        location.reload();
      });
    });
  });




jQuery(document).ready(function () {
		// Attach click event to the SVG element
		jQuery("#date-range-popup-svg").click(function (event) {
			event.stopPropagation(); // Prevent the click event from propagating to the document
			jQuery("#date-range-popup").css("z-index", function (index, value) {
				return value == 3 ? -1 : 3;
			});
			// Toggle slide-down or slide-up animation
		});

		// Click event for the document
		jQuery(document).click(function (event) {
			// Check if the clicked element is not within #date-range-popup
			if (!jQuery(event.target).closest('#date-range-popup').length) {
				// Change the z-index back to -1
				jQuery("#date-range-popup").css("z-index", -1);
			}
		});
	});


  jQuery(document).ready(function () {
    // Attach click event to the SVG element
    jQuery("#filter-stores-popup-svg").click(function (event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document
        jQuery("#filter-stores-popup").css("z-index", function (index, value) {
            return value == 3 ? -1 : 3;
        });
        // Toggle slide-down or slide-up animation
    });

    // Click event for the document
    jQuery(document).click(function (event) {
        // Check if the clicked element is not within #filter-stores-popup
        if (!jQuery(event.target).closest('#filter-stores-popup').length) {
            // Change the z-index back to -1
            jQuery("#filter-stores-popup").css("z-index", -1);
        }
    });
});



jQuery(document).ready(function () {
    // Attach click event to the SVG element
    jQuery("#filter-guys-popup-svg").click(function (event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document
        jQuery("#filter-guys-popup").css("z-index", function (index, value) {
            return value == 3 ? -1 : 3;
        });
        // Toggle slide-down or slide-up animation
    });

    // Click event for the document
    jQuery(document).click(function (event) {
        // Check if the clicked element is not within #filter-stores-popup
        if (!jQuery(event.target).closest('#filter-guys-popup').length) {
            // Change the z-index back to -1
            jQuery("#filter-guys-popup").css("z-index", -1);
        }
    });
});


jQuery(document).ready(function () {
    // Attach click event to the SVG element
    jQuery("#filter-products-popup-svg").click(function (event) {
        event.stopPropagation(); // Prevent the click event from propagating to the document
        jQuery("#filter-products-popup").css("z-index", function (index, value) {
            return value == 3 ? -1 : 3;
        });
        // Toggle slide-down or slide-up animation
    });

    // Click event for the document
    jQuery(document).click(function (event) {
        // Check if the clicked element is not within #filter-stores-popup
        if (!jQuery(event.target).closest('#filter-products-popup').length) {
            // Change the z-index back to -1
            jQuery("#filter-products-popup").css("z-index", -1);
        }
    });
});




  
</script>