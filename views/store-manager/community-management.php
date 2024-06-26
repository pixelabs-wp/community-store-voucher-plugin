<?php include CSVP_PLUGIN_PATH . "views/store-manager/header.php" ?>

<?php
global $store;
$store_id = $store->get_store_id();
?>

<style>
	.filter-text {
		font-size: 20px;
		font-weight: 600;
		line-height: 27px;
		letter-spacing: 0em;
	}

	.filter-text svg {
		margin-right: 14px;
	}

	.btn {
		font-size: 16px;
		font-weight: 600;
		line-height: 22px;
		letter-spacing: 0em;
		text-align: right;

	}

	.btn-custom:hover {
		color: black;
	}

	.product-information tr td {
		font-size: 16px;
		font-weight: 300;
		line-height: 22px;
		letter-spacing: 0em;
		text-align: right;
	}

	.store-management-information tr td {
		font-size: 20px;
		font-weight: 300;
		line-height: 27px;
		letter-spacing: 0em;
		text-align: right;
	}

	.store-management-card {
		width: 45%;
	}

	@media screen and (max-width: 480px) {
		.card {
			width: 100%;
		}

		.product-information tr td {
			font-size: 13px;
		}

		.store-management-card {
			width: 100%;
		}

	}


	@media screen and (max-width: 1050px) {
		.store-management-card {
			width: 100%;
		}
	}

	#store-search {
		direction: rtl;
		width: 100%;
		border: none;
	}

	#store-search:focus,
	#store-search:active,
	#store-search: {

		border: none !important;
	}


	#store-search::placeholder {
		font-size: 20px;
		font-weight: 600;
		text-align: right;

	}

	.ts-text {
		font-size: 20px;
		font-weight: 600;
		text-align: center;
		direction: rtl;
	}

	.store-management-information table td {
		direction: rtl;
	}








	/* Modal Styling Starts here */


	.main {
		background-color: #01051D;
		display: flex;
		justify-content: space-between;
		align-items: center;
		/* Center align the credit container */
	}


	.balance {
		padding: 3px 16px;
		background-color: #FFFFFF;
		border-radius: 10px;
		/* Apply border radius */
		margin-top: 12px;
		margin-bottom: 20px;
		margin-left: 25px;
	}

	.credit-container h4 {
		margin-bottom: 5px;
		justify-content: right;
	}

	.svvg {
		color: #FFFFFF;
	}

	.address {
		color: white;
		/* /* margin-right: 16rem; */
		display: flex;
	}

	.address-title {
		font-size: 20px;
		font-weight: 400;
		gap: 3px;
	}

	.svggroup {
		justify-content: center;
	}

	.address h2,
	.address h3 {
		text-align: right;
	}

	.btn-custom {
		width: 222px;
		margin-right: 10p
			/* Optional: Adjust the margin between buttons */
	}

	.btn-customs {
		width: 222px;
		background-color: #E4E4E4;

	}

	.btn-custom {
		width: 222px;
		background-color: #F9F8C7;

	}

	.container {
		display: flex;
		background-color: #E4E4E4;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	.left-section {
		flex: 1;
		background-color: #BC9B63;
		color: white;
		padding: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.left-section button {
		padding: 10px 20px;
		background-color: #5A4222;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.right-section {
		flex: 2;
		padding: 20px;
	}

	.right-section h3 {
		color: #5A4222;
	}

	.right-section p {
		margin-bottom: 10px;
	}

	.cont {
		width: 100%;
		margin-top: 28px;
		border-radius: 10px;
		background-color: #E4E4E4;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		padding: 20px;
	}

	.tran {
		margin: 7px;
		width: 100%;
		height: 87px;
		background-color: #ffffff;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	}

	.tran>div {
		flex-direction: initial;
	}

	.tran button {
		padding: 5px 20px;
		background-color: #5A4222;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		white-space: nowrap;
		font-size: 16px;
	}

	.tran h3 {
		color: black;
	}

	.title {
		font-size: 27px;
		font-weight: bold;
	}

	.buttons {
		font-weight: 700;
		font-size: 25px;
	}

	.buttonss {
		font-size: 27px;
		font-weight: 500;
	}

	.sw-buttons {
		flex-direction: row;
		gap: 10px;
		flex-wrap: wrap;
		margin-bottom: 40px;
		justify-content: flex-end;
	}

	.header-data-wrapper {
		flex-direction: row;
	}

	.card-text {
		position: relative;
	}

	.first-svg {
		position: absolute;
		top: 0;
		left: 0;
		z-index: 1;
	}




	@media screen and (max-width: 965px) {
		.main {
			background-color: #01051D;
			flex-direction: column;
			align-items: center;
		}

		.balance {
			background-color: #FFFFFF;
			margin-top: 12px;
			margin-right: 25px;
		}

		.address-title {
			font-size: 12px;
			font-weight: 200;
		}

		.svvg {
			margin-top: 12px;

			color: #FFFFFF;
			text-align: center;
		}

		/* table css */
		.tran {
			margin: 7px;
			width: 100%;
			height: 160px;
			background-color: #ffffff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			flex-direction: column-reverse !important;
		}

		.buttonss {
			font-size: 18px;
			font-weight: 300;
		}


	}


	@media screen and (max-width: 979px) {
		.buttons {
			font-weight: 400;
			font-size: 12px;
		}

		.titl {
			font-size: 16px;
		}
	}

	@media screen and (max-width: 691px) {
		.buttons {
			font-weight: 300;
			font-size: 10px;
		}

		.buttonss {
			background-color: #9D0000;
			font-size: 10px;
			padding: 7px;
		}

		.titl {
			margin-top: 4px;
			font-size: 16px;
		}

		.buttonss {
			font-size: 10px;
			font-weight: 300;
		}
	}


	@media screen and (max-width: 691px) {
		.buttons {
			font-weight: 200;
			font-size: 8px;
		}

		.buttonss {
			background-color: #9D0000;
			font-size: 8px;
			padding: 7px;
		}

		.titl {
			margin-top: 4px;
			font-size: 14px;
		}

		.buttonss {
			font-size: 8px;
			font-weight: 200;
			padding: 12px;
		}
	}

	@media screen and (max-width: 555px) {
		.main {
			background-color: #01051D;
			flex-direction: column;
			/* justify-content: space-between; */
			align-items: center;
			/* Center align the credit container */
		}

		.balance {
			background-color: #FFFFFF;
		}

		.address-title {
			font-size: 12px;
			font-weight: 200;
		}

		.svvg {
			color: #FFFFFF;
			text-align: center;
		}

		.buttonss {
			font-size: 10px;
			font-weight: 200;
		}

		.buttons {
			font-weight: 200;
			font-size: 8px;
		}

		.buttonss {
			background-color: #9D0000;
			font-size: 8px;
			padding: 7px;
		}

		.titl {
			margin-top: 4px;
			font-size: 14px;
		}

		.buttonss {
			font-size: 8px;
			font-weight: 200;
			padding: 12px;
		}

		.sw-buttons {
			flex-direction: column;
			gap: 10px;
		}

		.header-data-wrapper {
			flex-direction: column;

		}

		.address {
			align-items: center !important;
		}

		.address-title {
			text-align: center !important;
		}
	}

	.modal-dialog-scrollable .modal-content {
		overflow: auto;
	}

	/* Modal Styling Ends Here */



	/* Add new order modal style starts here */

	/* <!-- Adding a file css --> */
	.background-box {
		margin: auto;
		width: 90%;
		height: 85%;
		/* position: absolute; */
		top: 315px;
		/* Adjust the top position as needed */
		left: 628px;
		/* Adjust the left position as needed */
		background-color: #f0f0f0;
		/* Choose your desired background color */
		padding: 20px;
		/* Adjust the padding as needed */
		border-radius: 30px;
		/* Adjust the border radius for rounded corners */
	}

	tr {
		text-align: center;
	}


	.flex {
		display: flex;
		justify-content: space-between;
		/* width: 568px; */
		position: relative;

		/* Adjust the gap between file inputs */
	}

	.custom-file-input {
		color: black;
		position: relative;

	}

	.custom-file-input::-webkit-file-upload-button {
		visibility: hidden;
	}

	.custom-file-input::before {
		content: 'הוספת קובץ';
		display: inline-block;
		background: #E4E4E4;
		color: black;
		border: none;
		padding: 8px 20px;
		outline: none;
		white-space: nowrap;
		cursor: pointer;
		border-radius: 5px;
		font-weight: bold;
	}

	.custom-file-input:hover::before {
		background: #E4E4E4;
	}

	.custom-file-input:active::before {
		background: #E4E4E4;
	}

	.custom-file-input:focus::before {
		box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
	}

	.styled-element {
		/* width: 568px; */
		border-radius: 10px;
		background-color: #01051D;
		position: relative;
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 10px;
		font-size: 18px;
	}

	.styled-element span:nth-child(1) {
		color: #FFFFFF;
		font-weight: bold;
		text-align: right;
		/* Align text to the right */
	}

	.styled-element span:nth-child(2) {
		color: #FFFFFF;
		font-weight: bold;
		text-align: left;
		/* Align text to the left */
	}

	.labell {
		font-weight: bold;
	}

	.btngroup {
		/* width: 568px; */
		margin-top: 12px;
		display: flex;
		justify-content: space-between;
	}

	.button {
		padding: 10px 20px;
		border-radius: 8px;
		font-size: 16px;
		cursor: pointer;
		transition: background-color 0.3s ease;
		text-transform: uppercase;
		font-weight: bold;
	}

	.button-primary {
		color: #fff;
		background-color: #01051D;
		border: 2px solid black;
	}

	/* .button-primary:hover {
	background-color: #45a049;
  } */

	.button-secondary {
		color: #fff;
		background-color: #9D0000;
		border: 2px solid black;
	}

	/* .button-secondary:hover {
	background-color: #e2e6ea;
  } */


	@media screen and (max-width: 768px) {
		h1 {
			font-size: 20px;
		}

		.input-field,
		.labell {
			font-size: 14px;
		}

		.styled-element {
			font-size: 14px;
		}

		.button {
			font-size: 8px;
		}


	}


	@media screen and (max-width: 546px) {
		table {
			font-size: 12px;
		}

		h1 {
			font-size: 20px;
		}

		.custom-file-input {
			color: black;
			font-size: 10px;
		}

		svg {
			width: 40%;
			height: 35%;

		}

		.input-field,
		.labell {
			font-size: 10px;
		}

		.styled-element {
			font-size: 12px;
		}

		.button {
			font-size: 10px;
		}

		.background-box {
			margin: auto;
			width: 555px;
			overflow-x: scroll;
			height: 85%;
			top: 315px;
			left: 628px;
			background-color: #f0f0f0;
			padding: 20px;
			border-radius: 30px;
		}
	}

	.titl {
		direction: rtl;
	}


	/* Add new order modal style ends here */
</style>


<!-- Community details modal Starts here -->


<div class="modal fade" id="community-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="main">
				<div class="credit-container">
					<div class="balance">
						<h4>תקרת אשראי</h4>
						<span> ₪ <span id="credit_limit"></span> </span>
						<h4>יתרת אשראי</h4>
						<span> ₪ <span id="used_credit"></span> </span>
					</div>
				</div>
				<div class="d-flex  align-items-center gap-3 header-data-wrapper">
					<div class="address d-flex flex-column align-items-end gap-3">
						<h1 id="name_of_community">-</h1>
						<div>
							<h2 class="address-title">אליהו מנהל ת”ת: <span id="community_manager_no">000-0000000
								</span> <span id="community_manager_address"> - </span> :כתובת</h2>
							<h3 class="address-title"></h3>
						</div>
						<div class="d-flex sw-buttons">
							<button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#store-manager-add-new-order">+ הוספת הזמנה חדשה </button>
							<button type="button" data-bs-toggle="modal" data-bs-target="#store-manager-add-new-benefit" class="btn btn-custom">+ הוספת הטבה חדשה </button>
							<button type="button" data-bs-toggle="modal" data-bs-target="#store-manager-credit-limit-update" class="btn btn-custom">עדכון תקרת
								אשראי</button>
						</div>
					</div>
					<div class="svggroup">
						<div class="svvg">
						</div>
						<img src="" id="community_logo" alt="" width="207" height="194">
					</div>
				</div>
			</div>
			<!-- 1st one -->
			<div style="margin: 10px 10px 10px 10px;">
				<div class="d-flex flex-column cont">
					<h3 class="title" style="text-align: right;">הסטוריית עסקאות</h3>
					<div id="parentUnpaidTransactionHistory" class="d-flex flex-column align-items-end ">

					</div>
					<div id="parentRequestedTransactionHistory" class="d-flex flex-column align-items-end ">

					</div>
					<div id="parentPaidTransactionHistory" class="d-flex flex-column align-items-end ">

					</div>

				</div>
				<!-- 2st one -->
				<div class="d-flex flex-column align-items-end cont" id="parentOrderHistory">
					<h3 class="title">הסטוריית הזמנות </h3>
				</div>
				<!-- 3st one -->
				<div>
					<div class="d-flex flex-column align-items-end cont">
						<h3 class="title">פרטי הסדרים והטבות לת”ת</h3>
						<div class="d-flex gap-4 flex-wrap " style=" direction: rtl; " id="voucherElementId">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Community details modal ends here -->





<!-- Add New Benefit modal Starts here -->


<div class="modal fade" id="store-manager-add-new-benefit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4">
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
			</button>

			<style>
				.add-new-benefit-form h3,
				.add-new-benefit-form input,
				.add-new-benefit-buttons {
					direction: rtl;
				}
			</style>
			<div class="add-new-benefit-form">
				<form action="" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
					<h3>הוספת הטבה חדשה </h3>
					<input class="form-control" type="text" name="product_name" id="" placeholder="שם המוצר">
					<input class="form-control" type="number" name="voucher_price" id="" placeholder="מחיר מבצע">
					<input class="form-control" type="number" name="normal_price" id="" placeholder="מחיר רגיל">
					<input class="form-control" type="file" name="product_image" id="" placeholder="העלאת תמונת מוצר">
					<div class="add-new-benefit-buttons">
						<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
						<button type="button" onclick="closeModal('store-manager-add-new-benefit')" class="btn btn-danger w-25">ביטול</button>
						<input type="hidden" id="benifit_community_id" name="community_id" value="">
						<input type="hidden" name="csvp_request" value="add_new_benifit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--  Add new Benefit modal ends here -->

<!--  Edit Benefit modal starts here -->

<div class="modal fade" id="store-manager-edit-benefit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4">
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
			</button>

			<style>
				.add-new-benefit-form h3,
				.add-new-benefit-form input,
				.add-new-benefit-buttons {
					direction: rtl;
				}
			</style>
			<div class="add-new-benefit-form">
				<form action="" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
					<h3>ערוך הטבה קיימת</h3>
					<input class="form-control" type="text" name="product_name" id="" placeholder="שם המוצר" value="">
					<input class="form-control" type="number" name="voucher_price" id="" placeholder="מחיר מבצע" value="">
					<input class="form-control" type="number" name="normal_price" id="" placeholder="מחיר רגיל" value="">
					<input class="form-control" type="file" name="product_image" id="" placeholder="העלאת תמונת מוצר" value="">
					<div class="add-new-benefit-buttons">
						<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
						<button type="button" onclick="closeModal('store-manager-edit-benefit')" class="btn btn-danger w-25">ביטול</button>
						<input type="hidden" id="benifit_voucher_id" name="voucher_id" value="">
						<input type="hidden" name="old_image" value="">
						<input type="hidden" name="csvp_request" value="edit_benifit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--  Edit Benefit modal Ends here -->





<!-- Add New Order modal Starts here -->


<div class="modal fade" id="store-manager-add-new-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4">
			<div class="background-box">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="text-center mt-2">
						<h1 class="fs-3">בקשת הזמנה</h1>
					</div>
					<div class="bg-[#FFFFFF] mt-4 " style=" overflow: auto;  ">
						<table class="table table-bordered table-hover">
							<thead class="table-hover">
								<tr>
									<th scope="col text-center">סך הכל</th>
									<th scope="col text-center">עלות לפריט</th>
									<th scope="col text-center">כמות</th>
									<th scope="col text-center">שם המוצר</th>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
					</div>
					<div class="flex">
						<div class="mb-3">
							<input class="custom-file-input" type="file" name="order_info_file" id="formFileMultiple">
						</div>
						<div class="mb-3">
							<label class="labell">הוספת שורה</label>
							<svg onclick="addRow()" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="42" height="42" rx="10" fill="#01051D" />
								<path d="M18.605 25.8711H10.541V21.0591H18.605V12.9512H23.417V21.0591H31.459V25.8711H23.417V33.8691H18.605V25.8711Z" fill="white" />
							</svg>
						</div>
					</div>
					<div class="styled-element">
						<span>סה”כ שווי החזרה: ₪ <span class="total-cost"></span></span>
						<span>סה”כ פריטים: <span class="total-added-items"></span> פריטים</span>
					</div>
					<div class="btngroup">
						<input type="hidden" id="order_request_community_id" name="community_id" value="">
						<input type="hidden" name="csvp_request" value="add_order_request">
						<button type="submit" class="button button-primary">אישור</button>
						<button type="button" onclick="closeModal('store-manager-add-new-order')" class="button button-secondary">ביטול</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	const table = document.querySelector('table');

	table.addEventListener('change', (event) => {
		const target = event.target;

		if (target.classList.contains('amount-input') || target.classList.contains('cost-input')) {
			const currentRow = target.closest('tr');
			const amountInput = currentRow.querySelector('.amount-input');
			const costInput = currentRow.querySelector('.cost-input');
			const totalInput = currentRow.querySelector('.total-input');
			const amount = parseFloat(amountInput.value) || 0;
			const cost = parseFloat(costInput.value) || 0;
			const totalCost = amount * cost;
			totalInput.value = totalCost;
		}
	});

	function closeModal(modalId) {
		// Use jQuery to select the modal and call the Bootstrap modal method to hide it
		jQuery('#' + modalId).modal('hide');
	}


	function updateTotalItems() {
		const totalItemInputs = document.querySelectorAll('.amount-input');
		let total = 0;
		for (const input of totalItemInputs) {
			const value = parseFloat(input.value) || 0;
			total += value;
		}
		const totalSpan = document.querySelector('.total-added-items');
		totalSpan.textContent = total;
	}

	document.querySelector('table').addEventListener('change', (event) => {
		updateTotalItems();
	});

	updateTotalItems();

	function updateCost() {
		const totalItemInputs = document.querySelectorAll('.total-input');
		let total = 0;
		for (const input of totalItemInputs) {
			const value = parseFloat(input.value) || 0;
			total += value;
		}
		const totalSpan = document.querySelector('.total-cost');
		totalSpan.textContent = total;
	}

	document.querySelector('table').addEventListener('change', (event) => {
		updateCost();
	});

	updateCost();


	// 	document.addEventListener('DOMContentLoaded', function () {
	//     const table = document.querySelector('table');

	//     function updateTotalItems() {
	//         const totalItemInputs = document.querySelectorAll('.amount-input');
	//         let total = 0;
	//         for (const input of totalItemInputs) {
	//             const value = parseFloat(input.value) || 0;
	//             total += value;
	//         }
	//         const totalSpan = document.querySelector('.total-added-items');
	//         totalSpan.textContent = total;
	//     }

	//     function updateCost() {
	//         const totalItemInputs = document.querySelectorAll('.total-input');
	//         let total = 0;
	//         for (const input of totalItemInputs) {
	//             const value = parseFloat(input.value) || 0;
	//             total += value;
	//         }
	//         const totalSpan = document.querySelector('.total-cost');
	//         totalSpan.textContent = total;
	//     }

	//     function calculateTotal() {
	//         table.addEventListener('input', (event) => {
	//             const target = event.target;

	//             if (target.classList.contains('amount-input') || target.classList.contains('cost-input')) {
	//                 const currentRow = target.closest('tr');
	//                 const amountInput = currentRow.querySelector('.amount-input');
	//                 const costInput = currentRow.querySelector('.cost-input');
	//                 const totalInput = currentRow.querySelector('.total-input');
	//                 const amount = parseFloat(amountInput.value) || 0;
	//                 const cost = parseFloat(costInput.value) || 0;
	//                 const totalCost = amount * cost;
	//                 totalInput.value = totalCost;

	//                 updateTotalItems();
	//                 updateCost();
	//             }
	//         });
	//     }

	//     calculateTotal();
	// });
</script>


<!--  Add new Order modal ends here -->


<div class="modal fade" id="order_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4">
			<div class="background-box">
				<div class="text-center mt-2">
					<h1 class="fs-3">מידע על ההזמנה</h1>
				</div>
				<div class="bg-[#FFFFFF] mt-4 " style=" overflow: auto;  ">
					<table class="table table-bordered table-hover">
						<thead class="table-hover">
							<tr>
								<th scope="col text-center">סך הכל</th>
								<th scope="col text-center">עלות לפריט</th>
								<th scope="col text-center">כמות</th>
								<th scope="col text-center">שם המוצר</th>
							</tr>
						</thead>
						<tbody id="order_details_rows">

						</tbody>
					</table>
				</div>
				<div id="info_box">

				</div>
			</div>
		</div>
	</div>
</div>



<!-- Credit limit update modal Starts here -->

<div class="modal fade" id="store-manager-credit-limit-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4" style="direction: rtl">
			<h3>עדכון תקרת אשראי</h3>
			<style>
				/* prepare wrapper element */
				.credit-limit-input-wrapper {
					position: relative;
					direction: rtl;
				}

				/* position the unit to the right of the wrapper */
				.credit-limit-input-wrapper::after {
					position: absolute;
					top: 2px;
					left: .5em;
					transition: all .05s ease-in-out;
				}

				/* handle Firefox (arrows always shown) */
				@supports (-moz-appearance:none) {
					div::after {
						left: 1.5em;
					}
				}

				/* set the unit abbreviation for each unit class */

				.credit-limit-input-wrapper::after {
					content: '₪';
				}
			</style>
			<form action="" method="POST">

				<div class="credit-limit-input-wrapper bg-black p-5 rounded">
					<input type="number" class="form-control" id="decibel" name="credit_limit" placeholder="אנא הזן את הסכום" />
				</div>

				<div class="add-new-benefit-buttons mt-4">
					<input type="hidden" id="credit_limit_community_id" name="community_id" value="">
					<input type="hidden" name="csvp_request" value="set_credit_limit">
					<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
					<button type="button" onclick="closeModal('store-manager-credit-limit-update')" class="btn btn-danger w-25">ביטול</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--  Credit limit update modal ends here -->

<!-- Transaction Successful Notification modal Starts here -->

<script>
	function populateModal(orderid) {
		document.getElementById('aprove_payment_order_id').value = orderid;
		document.getElementById('aprove_payment_order_id_2').value = orderid;
	}

	function populatenewModal(month, year, community_id, store_id) {
		document.getElementById('month_tran').value = month;
		document.getElementById('year_tran').value = year;
		document.getElementById('store_id_tran').value = store_id;
		document.getElementById('community_id_tran').value = community_id;

		document.getElementById('month_tran_2').value = month;
		document.getElementById('year_tran_2').value = year;
		document.getElementById('store_id_tran_2').value = store_id;
		document.getElementById('community_id_tran_2').value = community_id;
	}
</script>


<div class="modal fade" id="store-manager-transaction-success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4" style="direction: rtl">
			<h3>האם העסקה שולמה בהצלחה?</h3>
			<form action="" method="POST">
				<input type="hidden" id="aprove_payment_order_id" name="order_id" value="">
				<input type="hidden" name="csvp_request" value="request_payment">
				<button class="btn btn-secondary">שלח בקשת תשלום</button>
			</form>

			<div class="add-new-benefit-buttons mt-4">
				<form action="" method="POST" class="d-inline">
					<input type="hidden" id="aprove_payment_order_id_2" name="order_id" value="">
					<input type="hidden" name="csvp_request" value="aprrove_payment">
					<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
				</form>
				<button type="submit" class="btn btn-danger w-25" onclick="closeModal('store-manager-transaction-success')">ביטול</button>
				<div>

				</div>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="store-manager-community-transaction-success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4" style="direction: rtl">
			<h3>האם העסקה שולמה בהצלחה?</h3>
			<form action="" method="POST">
				<input type="hidden" id="month_tran" name="month_tran" value="">
				<input type="hidden" id="year_tran" name="year_tran" value="">
				<input type="hidden" id="store_id_tran" name="store_id_tran" value="">
				<input type="hidden" id="community_id_tran" name="community_id_tran" value="">
				<input type="hidden" name="csvp_request" value="request_trasanction">
				<button class="btn btn-secondary" style="background: #BC9B63;">שלח בקשת תשלום</button>
			</form>
			<div class="add-new-benefit-buttons mt-4">
				<form action="" method="POST" class="d-inline">
					<input type="hidden" id="month_tran_2" name="month_tran" value="">
					<input type="hidden" id="year_tran_2" name="year_tran" value="">
					<input type="hidden" id="store_id_tran_2" name="store_id_tran" value="">
					<input type="hidden" id="community_id_tran_2" name="community_id_tran" value="">
					<input type="hidden" name="csvp_request" value="aprrove_trasanction">
					<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
				</form>
				<button type="button" class="btn btn-danger w-25" onclick="closeModal('store-manager-community-transaction-success')">ביטול</button>
			</div>
		</div>
	</div>
</div>

<!--   Transaction Successful Notification modal ends here -->

<!-- Voucher Delete Notification modal Starts here -->

<div class="modal fade" id="store-manager-voucher-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content p-4" style="direction: rtl">
			<h3>האם למחוק את השובר?</h3>

			<div class="add-new-benefit-buttons mt-4">
				<form method="POST" action="">
					<input type="hidden" name="id" id="voucher_id">
					<input type="hidden" name="csvp_request" value="delete_voucher">
					<input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
					<button type="button" onclick="closeModal('store-manager-voucher-delete')" class="btn btn-danger w-25">ביטול</button>
				</form>
			</div>

		</div>
	</div>
</div>

<!--   Voucher Delete Notification modal ends here -->

<div class="container m-auto row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">
	<div class="col-sm-5 col-lg-4 m-0">
		<div class="card card-sm">
			<div class="card-body-rounded p-2">
				<div class="row align-items-center">
					<div class="col-auto">
						<span><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
							<svg width="26" height="25" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M41.7966 39.2038L31.392 28.7992C33.733 25.8775 35.0059 22.2439 35 18.5C35 9.38742 27.613 2 18.5 2C9.38742 2 2 9.38742 2 18.5C2 27.6126 9.38742 35 18.5 35C22.3958 35 25.9763 33.6498 28.7992 31.3915L39.2038 41.7962C39.3739 41.9667 39.5759 42.1019 39.7983 42.1941C40.0208 42.2863 40.2592 42.3336 40.5 42.3333C40.8626 42.3334 41.217 42.2258 41.5185 42.0244C41.82 41.823 42.055 41.5367 42.1938 41.2017C42.3326 40.8668 42.3689 40.4982 42.2982 40.1426C42.2275 39.7869 42.053 39.4603 41.7966 39.2038ZM18.5 31.3333C11.4123 31.3333 5.66667 25.5877 5.66667 18.5C5.66667 11.4123 11.4123 5.66667 18.5 5.66667C25.5881 5.66667 31.3333 11.4123 31.3333 18.5C31.3333 25.5877 25.5881 31.3333 18.5 31.3333Z" fill="#01051D" />
							</svg>

						</span>
					</div>
					<div class="col">
						<form action="" method="post">
							<div class="" style="direction: rtl;">
								<input type="text" id="store-search" class="form-control" placeholder="חיפוש ת”ת" name="community_name" value="<?php echo isset($_POST["community_name"]) ? $_POST["community_name"] : ""; ?>">
								<input type="hidden" name="csvp_filter" value="filter_communities_by_name">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php
	// echo json_encode($_POST);
	?>

	<div class="col-sm-5 col-lg-4 m-0">
		<form action="" method="POST">
			<button class="card card-sm w-100 d-flex align-items-center">
				<div>
					<div class="card-body-rounded p-1 m-1">
						<div class="row align-items-center">
							<div class="col">
								<input type="hidden" name="non_agreed_store_filter" id="">
								<div class="font-weight-medium text-center ts-text">תת”ים שלא בהסדר</div>
							</div>
						</div>
					</div>
				</div>
			</button>
		</form>
	</div>


	<div class="col-sm-5 col-lg-4 m-0">
		<form action="" method="POST">
			<button class="card card-sm w-100 d-flex align-items-center">
				<div>
					<div class="card-body-rounded p-1 m-1">
						<div class="row align-items-center">
							<div class="col">
								<input type="hidden" name="agreed_store_filter" id="">
								<div class="font-weight-medium text-center ts-text">תת”ים בהסדר</div>
							</div>
						</div>
					</div>
				</div>
			</button>
		</form>
	</div>

</div>

<div class="container mt-4 d-flex flex-wrap" style="row-gap: 2rem; column-gap: 5rem;">
	<?php

	if (isset($pageData["joined_communities"])) {
		foreach ($pageData["joined_communities"] as $community) {
			$community_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $community['community_data']->community_logo;

	?>
			<div class="store-management-card card col-xl-4 rounded-3 p-0 " data-bs-toggle="modal" data-bs-target="#community-details" data-id="<?php echo $community['community_data']->id; ?>">
				<!-- Photo -->
				<div class="card-body d-flex p-0">
					<div class="d-flex flex-column px-5 py-4" style="width: 65%;">
						<div class="store-management-information rounded-3">
							<div class="row-1 p-2 d-flex align-items-center justify-content-end">
								<table>
									<tr class="d-flex flex-column gap-2 text-center">
										<td><strong>שם הת”ת: </strong>
											<?php echo $community['community_data']->community_name; ?>
										</td>
										<td><strong>כמות בחורים: </strong>
											<?php echo isset($community['community_member_data']->member_count) ? $community['community_member_data']->member_count : 0; ?>
										</td>
										<td><strong>סך הזמנות:</strong>
											<?php echo isset($community['order_data']->total_order_amount) ? $community['order_data']->total_order_amount : 0; ?>
											₪
										</td>

										<td><button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#community-details" data-id="<?php echo $community['community_data']->id; ?>">Open Popup</button>
										</td>

									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $community_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
					</div>
				</div>
			</div>
	<?php }
	} ?>
	<?php
	if (isset($pageData["requested_communities"])) {
		foreach ($pageData["requested_communities"] as $community) {

			$community_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $community['community_data']->community_logo;
	?>
			<div class="store-management-card card col-xl-4 rounded-3 p-0 ">
				<!-- Photo -->
				<div class="card-body d-flex p-0">
					<div class="d-flex flex-column px-5 py-4" style="width: 65%;">
						<div class="store-management-information rounded-3">
							<div class="row-1 p-2 d-flex align-items-center justify-content-end">
								<table>
									<tr class="d-flex flex-column gap-2 text-center">
										<td><strong>שם החנות: </strong>
											<?php echo $community['community_data']->community_name; ?>
										</td>
										<td><strong>כמות הזמנות: </strong>
											<?php echo isset($community['community_member_data']->member_count) ? $community['community_member_data']->member_count : 0; ?>
										</td>
										<td><strong>סך הזמנות: </strong>
											<?php echo isset($community['order_data']->total_order_amount) ? $community['order_data']->total_order_amount : 0; ?>
											₪
										</td>
									</tr>
								</table>
							</div>
						</div>
						<label class="text-secondary "><b>בקשה בהמתנה</b></label>
					</div>
					<div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $community_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
					</div>
				</div>
			</div>
	<?php }
	} ?>
	<?php
	if (isset($pageData["not_requested_communities"])) {
		foreach ($pageData["not_requested_communities"] as $community) {
			$community_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $community['community_data']->community_logo;

	?>

			<div class="store-management-card card col-xl-4 rounded-3 p-0 ">
				<!-- Photo -->
				<div class="card-body d-flex p-0">
					<div class="d-flex flex-column px-5 py-4" style="width: 65%;">
						<div class="store-management-information rounded-3">
							<div class="row-1 p-2 d-flex align-items-center justify-content-end">
								<table>
									<tr class="d-flex flex-column gap-2 text-center">
										<td><strong>שם החנות: </strong>
											<?php echo $community['community_data']->community_name; ?>
										</td>
										<td><strong>כמות הזמנות: </strong>
											<?php echo isset($community['community_member_data']->member_count) ? $community['community_member_data']->member_count : 0; ?>
										</td>
										<td><strong>סך הזמנות: </strong>
											<?php echo isset($community['order_data']->total_order_amount) ? $community['order_data']->total_order_amount : 0; ?>
											₪
										</td>
									</tr>
								</table>
							</div>
						</div>
						<form method="POST" action="" style="direction: rtl;">
							<input type="hidden" id="benifit_community_id" name="community_id" value="<?php echo $community['community_data']->id; ?>">
							<input type="hidden" name="csvp_request" value="joining_request">
							<button class="btn btn-dark">לצירוף הת”ת ←</button>
						</form>

					</div>
					<div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $community_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
					</div>
				</div>
			</div>
	<?php }
	} ?>
</div>

</div>
</div>
</div>
</body>


<script>
	var voucherElementId = document.getElementById("voucherElementId");


	function addRow() {
		var table = document.querySelector('.table tbody');
		var newRow = table.insertRow();
		newRow.innerHTML = `
		<th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="total-cost" class="total-input" name="total_cost[]" placeholder="סך הכל" ></th>
	  <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="cost-per-item" class="cost-input" name="cost_per_item[]" placeholder="עלות לפריט"></th>
	  <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="total-item" class="amount-input" name="total_item[]" placeholder="כמות"></th>
	  <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="name-input" name="product_name[]" placeholder="שם המוצר"></th>`;
	}

	function addSection(id, imageSrc, title, price, discountPrice) {
		var imageUrl = "<?php echo esc_url(get_site_url() . '/wp-content/uploads/'); ?>" + imageSrc;
		var section = `
		<div class="d-flex gap-3">
			<div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
				<div class="cards">
					<div class="card-text">
						<svg class="first-svg" width="61" height="57" viewBox="0 0 61 57" fill="none" data-bs-toggle="modal" data-bs-target="#store-manager-voucher-delete" data-id="${id}"
							xmlns="http://www.w3.org/2000/svg">
							<rect width="61" height="57" fill="#9D0000" />
							<path
								d="M42 42H35.9502L30.1396 32.5493L24.3291 42H18.6553L26.9438 29.1143L19.1851 17.0146H25.0298L30.4131 26.0039L35.6938 17.0146H41.4019L33.5576 29.4048L42 42Z"
								fill="white" />
						</svg>
						<img class="second-img" src="${imageUrl}" width="286px" height="220px">
					</div>
				</div>
				<div class="card-footer text-center bg-transparent ">
					${title}
					<div class="text-center bg-transparent ">${discountPrice}₪  במקום  <del>${price}</del>₪</div>
					<button type="button" class="btn" style="color: white; background-color: #01051D;" data-bs-toggle="modal" data-bs-target="#store-manager-edit-benefit" onclick="openEditModal('${title}', ${price}, ${discountPrice}, '${imageSrc}', ${id})">עריכת השובר</button>

				</div>
			</div>
		</div>

	`;

		voucherElementId.innerHTML += section; // Use innerHTML to append HTML content
	}

	function openEditModal(title, price, discountPrice, imageSrc, id) {
		// Populate input elements in the modal with the provided data
		document.querySelector('#store-manager-edit-benefit input[name="product_name"]').value = title;
		document.querySelector('#store-manager-edit-benefit input[name="voucher_price"]').value = discountPrice;
		document.querySelector('#store-manager-edit-benefit input[name="normal_price"]').value = price;
		document.querySelector('#store-manager-edit-benefit input[name="voucher_id"]').value = id;
		document.querySelector('#store-manager-edit-benefit input[name="old_image"]').value = imageSrc;

	}

	function populateOrderDetailModalFunction(button) {
		var orderDetails = JSON.parse(button.getAttribute('data-order-details'));

		var id = orderDetails.id;
		var isActive = orderDetails.is_active;
		var createdAt = orderDetails.created_at;
		var updatedAt = orderDetails.updated_at;
		var wpUser = orderDetails.wp_user;
		var communityId = orderDetails.community_id;
		var storeId = orderDetails.store_id;
		var orderStatus = orderDetails.order_status;
		var orderTotal = orderDetails.order_total;
		var orderDate = orderDetails.order_date;
		var orderInfoFile = orderDetails.order_info_file;
		var orderData = orderDetails.order_data;

		var section = `
		`;
		var total_items = 0;
		orderData.forEach(function(item) {
			section = section + `
		<tr>
		<td>${item.total_cost}</td>
		<td>${item.cost_per_item}</td>
		<td>${item.total_items}</td>
		<td>${item.product_name}</td>
		</tr>`
			total_items = total_items + parseInt(item.total_items);
		});

		var parentTableElement = document.getElementById("order_details_rows");
		parentTableElement.innerHTML = "";
		parentTableElement.innerHTML += section;
		var section_under = `<div class="styled-element">
						<span>סה”כ שווי החזרה: ₪${orderTotal}</span>
						<span>סה”כ פריטים: ${total_items} פריטים</span>
					</div>`;
		document.getElementById('info_box').innerHTML = "";
		document.getElementById('info_box').insertAdjacentHTML('beforeend', section_under);
	}

	var parentOrderHistory = document.getElementById("parentOrderHistory");
	var parentUnpaidTransactionHistory = document.getElementById("parentUnpaidTransactionHistory");
	var parentRequestedTransactionHistory = document.getElementById("parentRequestedTransactionHistory");
	var parentPaidTransactionHistory = document.getElementById("parentPaidTransactionHistory");

	function addOrderHistory(item) {
		var section = ``;

		if (item.order_status == '<?php echo ORDER_STATUS_PAID; ?>') {
			var date = new Date(item.created_at);
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			var formattedDay = (day < 10) ? '0' + day : day;
			var formattedMonth = (month < 10) ? '0' + month : month;
			var newDate = formattedDay + '/' + formattedMonth + '/' + year;

			section = section + `
			<div class="d-flex justify-content-between tran">
				<div>
					<button class="buttons" >שולם</button>
				</div>
				<div class="d-flex gap-3">
					<div>
					<button class="buttonss" 
		style="background-color: #9D0000;" 
		data-bs-toggle="modal" 
		data-bs-target="#order_details" 
		onclick="populateOrderDetailModalFunction(this)"
		data-order-details='${JSON.stringify(item)}'>
	לפרטי ההזמנה
</button>					</div>
					<h3 class="titl">תאריך הזמנה: ${newDate}</h3>
					<h3 class="titl">סכום: ${item.order_total} ₪ </h3>
					<h3 class="titl">הזמנה: ${item.id}</h3>
				</div>
			</div>`;
		} else if (item.order_status == '<?php echo ORDER_STATUS_COMPLETED; ?>') {
			var date = new Date(item.created_at);
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			var formattedDay = (day < 10) ? '0' + day : day;
			var formattedMonth = (month < 10) ? '0' + month : month;
			var newDate = formattedDay + '/' + formattedMonth + '/' + year;

			section = section + `
		<div class="d-flex justify-content-between tran">
			<div>
				<button class="buttons" style="background-color: #BC9B63;" data-bs-toggle="modal" data-bs-target="#store-manager-transaction-success" onclick="populateModal('${item.id}')">+ שליחת דרישת תשלום</button>
			</div>
			<div class="d-flex gap-3">
				<div>
				<button class="buttonss" 
		style="background-color: #9D0000;" 
		data-bs-toggle="modal" 
		data-bs-target="#order_details" 
		onclick="populateOrderDetailModalFunction(this)"
		data-order-details='${JSON.stringify(item)}'>
	לפרטי ההזמנה
</button>				</div>
				<h3 class="titl">תאריך הזמנה: ${newDate}</h3>
				<h3 class="titl">סכום: ${item.order_total} ₪ </h3>
				<h3 class="titl">הזמנה: ${item.id}</h3>
			</div>
		</div>`;
		} else if (item.order_status == '<?php echo ORDER_STATUS_PROCESSING; ?>') {
			var date = new Date(item.created_at);
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			var formattedDay = (day < 10) ? '0' + day : day;
			var formattedMonth = (month < 10) ? '0' + month : month;
			var newDate = formattedDay + '/' + formattedMonth + '/' + year;
			console.log(item);

			section = section + `
		<div class="d-flex justify-content-between tran">
			<div>
				<button class="buttons" style="background-color: rgba(1, 5, 29, 0.24);" data-bs-toggle="modal" data-bs-target="#store-manager-transaction-success" onclick="populateModal('${item.id}')">ממתין לתשלום</button>
			</div>
			<div class="d-flex gap-3">
				<div>
				<button class="buttonss" 
		style="background-color: #9D0000;" 
		data-bs-toggle="modal" 
		data-bs-target="#order_details" 
		onclick="populateOrderDetailModalFunction(this)"
		data-order-details='${JSON.stringify(item)}'>
	לפרטי ההזמנה
</button>
				</div>
				<h3 class="titl">תאריך הזמנה: ${newDate}</h3>
				<h3 class="titl">סכום: ${item.order_total} ₪ </h3>
				<h3 class="titl">הזמנה: ${item.id}</h3>
			</div>
		</div>`;
		}
		parentOrderHistory.insertAdjacentHTML('beforeend', section);
		// Append content to the end of parentOrderHistory
	}


	// When modal is about to be shown
	jQuery('#community-details').on('show.bs.modal', function(event) {
		// Extract data from data attributes of the button
		var button = jQuery(event.relatedTarget);
		var id = button.data('id');
		var community_id = button.data('id');

		var store_id = <?php echo $store_id; ?>;
		jQuery('#benifit_community_id').val(id);
		jQuery('#credit_limit_community_id').val(id);
		jQuery('#order_request_community_id').val(id);
		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Community', // Action hook
				csvp_handler: 'get_community_data_for_store_popup', // Action hook
				data: {
					community_id: id
				}
			},
			success: function(response) {
				// Handle success response
				document.getElementById('credit_limit').innerHTML = response[0]["credit_limit"];
				document.getElementById('used_credit').innerHTML = response[0]["creditbalance"];
				document.getElementById('name_of_community').innerHTML = response[0]["community_name"];
				document.getElementById('community_manager_no').innerHTML = response[0]["community_manager_phone"];
				document.getElementById('community_manager_address').innerHTML = response[0]["community_address"];
				document.getElementById('community_logo').src = "<?php echo esc_url(get_site_url() . '/wp-content/uploads/'); ?>" + response[0]["community_logo"];
			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
			}
		});

		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Voucher', // Action hook
				csvp_handler: 'get_all_vouchers_by_store_id_and_community_id', // Action hook
				data: {
					id: id,
					type: "store"
				}
			},
			success: function(response) {

				// Handle success response
				if (response.length > 0) {
					var parentElement = document.getElementById("voucherElementId");
					parentElement.innerHTML = "";
					response.forEach(function(item) {
						addSection(item.id, item.product_image, item.product_name, item.normal_price, item.voucher_price);
					});
				} else {
					var parentElement = document.getElementById("voucherElementId");
					parentElement.innerHTML = "<label>No Vouchers Found</label>"; // Use innerHTML to append HTML content
				}

			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
				console.error("Unexpected response format:", xhr.responseText);
			}
		});
		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Order', // Action hook
				csvp_handler: 'get_orders_data_using_store_and_community', // Action hook
				data: {
					id: id,
					suffix: '_store',
					type: 'store'
				}
			},
			success: function(response) {
				// Handle success response
				if (response) {
					parentOrderHistory.innerHTML = "";
					parentOrderHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3>";
					response.forEach(function(item) {
						addOrderHistory(item);
					});
				} else {
					parentOrderHistory.innerHTML = "";
					parentOrderHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3> <label>No Orders Found</label>";
				}

			},
			error: function(xhr, status, error) {
				// Handle error response
				console.error(xhr.responseText);
				console.error("Unexpected response format:", xhr.responseText);
			}
		});

		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Transaction', // Action hook
				csvp_handler: 'get_unpaid_transactions_monthly_data_by_community_id', // Action hook
				data: {
					store_id: store_id,
					community_id: community_id
				}
			},
			success: function(response) {
				// Handle success response
				if (response) {
					parentUnpaidTransactionHistory.innerHTML = "";
					var community_id = response.community_id;
					var store_id = response.store_id;
					var current_month = response.current_month;
					var previous_month_1 = response.previous_month_1;
					var previous_month_2 = response.previous_month_2;
					var total_amount_current = parseFloat(response.transaction.current_month.total_amount || 0) + parseFloat(response.voucher_transaction.current_month.total_amount || 0);
					var total_amount_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_1.total_amount || 0);
					var total_amount_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_2.total_amount || 0);
					if (total_amount_current != 0) {
						var total_transactions_current = parseFloat(response.transaction.current_month.total_transactions) + parseFloat(response.voucher_transaction.current_month.total_transactions);
						let modifiedDate_current = current_month.split('-').join('/');
						let parts_current = current_month.split('-');
						let month_current = parts_current[0];
						let year_current = parts_current[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div>
								<button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_current}', '${year_current}' , '${community_id}' , '${store_id}')">לא שולם</button>
							</div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_current + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_current + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_current + `</h3>
							</div>
						</div>`;
						parentUnpaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_1 != 0) {
						var total_transactions_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_transactions) + parseFloat(response.voucher_transaction.previous_month_1.total_transactions);
						let modifiedDate_previous_month_1 = previous_month_1.split('-').join('/');
						let parts_previous_month_1 = previous_month_1.split('-');
						let month_previous_month_1 = parts_previous_month_1[0];
						let year_previous_month_1 = parts_previous_month_1[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_previous_month_1}', '${year_previous_month_1}' , '${community_id}' , '${store_id}')">לא שולם</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_1 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_1 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_1 + `</h3>
							</div>
						</div>`;
						parentUnpaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_2 != 0) {
						var total_transactions_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_transactions) + parseFloat(response.voucher_transaction.previous_month_2.total_transactions);
						let modifiedDate_previous_month_2 = previous_month_2.split('-').join('/');
						let parts_previous_month_2 = previous_month_2.split('-');
						let month_previous_month_2 = parts_previous_month_2[0];
						let year_previous_month_2 = parts_previous_month_2[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_previous_month_2}', '${year_previous_month_2}' , '${community_id}' , '${store_id}')">לא שולם</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_2 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_2 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_2 + `</h3>
							</div>
						</div>`;
						parentUnpaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					// response.forEach(function (item) {
					// 	addOrderHistory(item);
					// });
				} else {
					parentUnpaidTransactionHistory.innerHTML = "";
					parentUnpaidTransactionHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3> <label>No Unpaid Transactions Data Found</label>";
				}

			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
				console.error("Unexpected response format:", xhr.responseText);

			}
		});

		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Transaction', // Action hook
				csvp_handler: 'get_requested_transactions_monthly_data_by_community_id', // Action hook
				data: {
					store_id: store_id,
					community_id: community_id
				}
			},
			success: function(response) {
				// Handle success response
				if (response) {
					parentRequestedTransactionHistory.innerHTML = "";
					var community_id = response.community_id;
					var store_id = response.store_id;
					var current_month = response.current_month;
					var previous_month_1 = response.previous_month_1;
					var previous_month_2 = response.previous_month_2;
					var total_amount_current = parseFloat(response.transaction.current_month.total_amount || 0) + parseFloat(response.voucher_transaction.current_month.total_amount || 0);
					var total_amount_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_1.total_amount || 0);
					var total_amount_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_2.total_amount || 0);
					if (total_amount_current != 0) {
						var total_transactions_current = parseFloat(response.transaction.current_month.total_transactions) + parseFloat(response.voucher_transaction.current_month.total_transactions);
						let modifiedDate_current = current_month.split('-').join('/');
						let parts_current = current_month.split('-');
						let month_current = parts_current[0];
						let year_current = parts_current[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div>
								<button class="buttons" style="background-color:  #BC9B63;" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_current}', '${year_current}' , '${community_id}' , '${store_id}')">שליחת דרישת תשלום+</button>
							</div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_current + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_current + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_current + `</h3>
							</div>
						</div>`;
						parentRequestedTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_1 != 0) {
						var total_transactions_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_transactions) + parseFloat(response.voucher_transaction.previous_month_1.total_transactions);
						let modifiedDate_previous_month_1 = previous_month_1.split('-').join('/');
						let parts_previous_month_1 = previous_month_1.split('-');
						let month_previous_month_1 = parts_previous_month_1[0];
						let year_previous_month_1 = parts_previous_month_1[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color: #BC9B63;" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_previous_month_1}', '${year_previous_month_1}' , '${community_id}' , '${store_id}')">שליחת דרישת תשלום+</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_1 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_1 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_1 + `</h3>
							</div>
						</div>`;
						parentRequestedTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_2 != 0) {
						var total_transactions_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_transactions) + parseFloat(response.voucher_transaction.previous_month_2.total_transactions);
						let modifiedDate_previous_month_2 = previous_month_2.split('-').join('/');
						let parts_previous_month_2 = previous_month_2.split('-');
						let month_previous_month_2 = parts_previous_month_2[0];
						let year_previous_month_2 = parts_previous_month_2[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color:  #BC9B63;" data-bs-toggle="modal" data-bs-target="#store-manager-community-transaction-success" onclick="populatenewModal('${month_previous_month_2}', '${year_previous_month_2}' , '${community_id}' , '${store_id}')">שליחת דרישת תשלום+</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_2 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_2 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_2 + `</h3>
							</div>
						</div>`;
						parentRequestedTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					// response.forEach(function (item) {
					// 	addOrderHistory(item);
					// });
				} else {
					parentRequestedTransactionHistory.innerHTML = "";
					parentRequestedTransactionHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3> <label>No Requested Transactions Data Found</label>";
				}

			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
				console.error("Unexpected response format:", xhr.responseText);

			}
		});

		jQuery.ajax({
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			type: 'POST',
			data: {
				action: 'csvp_ajax', // Action hook
				csvp_request: 'CSVP_Transaction', // Action hook
				csvp_handler: 'get_paid_transactions_monthly_data_by_community_id', // Action hook
				data: {
					store_id: store_id,
					community_id: community_id
				}
			},
			success: function(response) {
				// Handle success response
				if (response) {
					parentPaidTransactionHistory.innerHTML = "";
					var community_id = response.community_id;
					var store_id = response.store_id;
					var current_month = response.current_month;
					var previous_month_1 = response.previous_month_1;
					var previous_month_2 = response.previous_month_2;
					var total_amount_current = parseFloat(response.transaction.current_month.total_amount || 0) + parseFloat(response.voucher_transaction.current_month.total_amount || 0);
					var total_amount_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_1.total_amount || 0);
					var total_amount_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_amount || 0) + parseFloat(response.voucher_transaction.previous_month_2.total_amount || 0);
					if (total_amount_current != 0) {
						var total_transactions_current = parseFloat(response.transaction.current_month.total_transactions) + parseFloat(response.voucher_transaction.current_month.total_transactions);
						let modifiedDate_current = current_month.split('-').join('/');
						let parts_current = current_month.split('-');
						let month_current = parts_current[0];
						let year_current = parts_current[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div>
								<button class="buttons" style="background-color:  #01051D;">שולם</button>
							</div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_current + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_current + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_current + `</h3>
							</div>
						</div>`;
						parentPaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_1 != 0) {
						var total_transactions_previous_month_1 = parseFloat(response.transaction.previous_month_1.total_transactions) + parseFloat(response.voucher_transaction.previous_month_1.total_transactions);
						let modifiedDate_previous_month_1 = previous_month_1.split('-').join('/');
						let parts_previous_month_1 = previous_month_1.split('-');
						let month_previous_month_1 = parts_previous_month_1[0];
						let year_previous_month_1 = parts_previous_month_1[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color:  #01051D;" >שולם</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_1 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_1 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_1 + `</h3>
							</div>
						</div>`;
						parentPaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					if (total_amount_previous_month_2 != 0) {
						var total_transactions_previous_month_2 = parseFloat(response.transaction.previous_month_2.total_transactions) + parseFloat(response.voucher_transaction.previous_month_2.total_transactions);
						let modifiedDate_previous_month_2 = previous_month_2.split('-').join('/');
						let parts_previous_month_2 = previous_month_2.split('-');
						let month_previous_month_2 = parts_previous_month_2[0];
						let year_previous_month_2 = parts_previous_month_2[1];

						var section = `<div class="d-flex justify-content-between tran">
							<div><button class="buttons" style="background-color: #01051D;">שולם</button></div>
							<div class="d-flex gap-3">
								<h3 class="titl">סה”כ: ₪ ` + total_amount_previous_month_2 + `</h3>
								<h3 class="titl">כמות עסקאות: ` + total_transactions_previous_month_2 + ` </h3>
								<h3 class="titl">חודש: ` + modifiedDate_previous_month_2 + `</h3>
							</div>
						</div>`;
						parentPaidTransactionHistory.insertAdjacentHTML('beforeend', section);
					}
					// response.forEach(function (item) {
					// 	addOrderHistory(item);
					// });
				} else {
					parentPaidTransactionHistory.innerHTML = "";
					parentPaidTransactionHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3> <label>No Paid Transactions Data Found</label>";
				}

			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
				console.error("Unexpected response format:", xhr.responseText);

			}
		});

	});

	jQuery('#store-manager-voucher-delete').on('show.bs.modal', function(event) {
		var button = jQuery(event.relatedTarget);
		var id = button.data('id');
		jQuery('#voucher_id').val(id);
	});
</script>