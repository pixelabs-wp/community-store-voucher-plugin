<?php include CSVP_PLUGIN_PATH . "views/store-manager/header.php" ?>

<style>
    h3,
    input,
    h1 {
        direction: rtl;
        margin: 0;
    }

    .card-wrapper {
        gap: 10px;
        display: flex;
        overflow: auto;
        flex-wrap: wrap;
    }

    .card-wrapper .card {
        width: 32.5%;
        direction: rtl;
        border-radius: 20px;
    }

    .card-wrapper .card .card-body h3 {
        font-size: 16px;
        font-weight: 400;
    }

    .card-wrapper .card .img-responsive {
        border-radius: 14px 14px 0 0;
    }

    .card-wrapper .card .card-body {
        border-radius: 0 0 14px 14px;

    }

    .card-wrapper .card .card-body button {
        font-size: 20px;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 20px;
        margin-top: 10px;
    }


    @media screen and (max-width: 900px) {
        .card-wrapper .card {
            width: 48%;
        }
    }

    @media screen and (max-width: 767px) {
        .creating-transaction-guy-data {
            width: 100% !important;
        }
    }

    @media screen and (max-width: 580px) {
        .card-wrapper .card {
            width: 100%;
        }
    }

    .hide-card {
        display: none;
    }
</style>

<div class="container-fluid">

    <div class="container creating-transaction-guy-data w-75  bg-white  p-5 rounded-3">
        <div class="d-flex flex-row align-items-center justify-content-between gap-2" id="data-search-bar">

            <div class="form-group col-8 mx-auto">
                <input type="text" class="form-control text-center" placeholder="magnetic card number" list="members" id="memberInput">
                <datalist id="members">
                    <?php foreach ($pageData["members"] as $key => $member) {
                        echo '<option value="' . $member['magnetic_card_number_association'] . '">' . $member['full_name'] . '</option>';
                    }; ?>

                </datalist>

            </div>

        </div>
        <br>

        <div class="d-flex flex-row align-items-center justify-content-between" id="data-name-bar">
            <h3 id="data-name">Please Scan or select user</h3>
            <h3 id="data-card_number">0</h3>
            <h3>Total: <span id="data-card_balance">0</span> ₪ </h3>
        </div>

        <hr class="m-0 mt-2">
    </div>

    <script>
        // Get the input element
        const memberInput = document.getElementById('memberInput');

        // Add event listener for change event
        memberInput.addEventListener('change', function() {
            const selectedValue = this.value;

            // Find matching member data
            const members = <?php echo json_encode($pageData["members"]); ?>; // Assuming $pageData is accessible in JS
            let matchingMember;
            for (const member of members) {
                if (member.magnetic_card_number_association === selectedValue) {
                    matchingMember = member;
                    break;
                }
            }



            // Update display if member found
            if (matchingMember) {
                document.querySelector("#data-name-bar").style.display = "flex";
                document.querySelector("#data-search-bar").style.display = "none";
                const nameElement = document.querySelector('.container #data-name');
                nameElement.textContent = matchingMember.full_name;

                const idElement = document.querySelector('.container #data-card_number');
                idElement.textContent = matchingMember.magnetic_card_number_association;

                const balanceElement = document.querySelector('.container #data-card_balance');
                balanceElement.textContent = matchingMember.card_balance;
                const memberVouchers = document.querySelector('#member-vouchers');
                const cmi = document.querySelector('#debit-community_member_id');
                cmi.value = matchingMember.id;
                jQuery.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'POST',
                    data: {
                        action: 'csvp_ajax', // Action hook
                        csvp_request: 'CSVP_VoucherTransaction', // Action hook
                        csvp_handler: 'get_vouchers_by_member_id_and_store_id', // Action hook
                        data: {
                            store_id: <?php echo $store->get_store_id(); ?>,
                            member_id: matchingMember.id,
                            status: '<?php echo VOUCHER_STATUS_PENDING; ?>'

                        }
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(memberVouchers);

                        let vouchers = response.map((voucher) => {
                            let stringedVoucher = JSON.stringify(voucher.voucher_data[0]);
                            return `<div class="card">
                <!-- Photo -->
                <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(<?php echo home_url() . '/wp-content/uploads'; ?>${voucher.voucher_data[0].product_image});height: 250px;">
                </div>
                <div class="card-body bg-white text-center">
                    <h3 class="card-title">${voucher.voucher_data[0].product_name}</h3>
                    <h3 class="text-secondary"> ${voucher.voucher_data[0].voucher_price}₪ במקום ${voucher.voucher_data[0].normal_price}₪</h3>
                    <button class="btn bg-black text-white" onclick='chargeVoucher(${stringedVoucher}, ${voucher.community_member_id}, ${voucher.id})'>Voucher charge</button>
                </div>
            </div>`
                        }).join('');
                        memberVouchers.innerHTML = vouchers;

                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        console.error("Unexpected response format:", xhr.responseText);
                    }
                });

                document.querySelectorAll('.hide-card').forEach((item) => {
                    item.classList.remove('hide-card')
                })
            }
        });
    </script>



    <div class="modal fade" id="store-manager-voucher-charge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content p-4" style="direction: rtl">
                <h3>Do you wish to charge <span id="voucher_name"></span> for <span id="voucher_price"></span></h3>

                <div class="add-new-benefit-buttons mt-4">
                    <form method="POST" action="">
                        <input type="hidden" name="voucher_id" id="voucher_id">
                        <input type="hidden" name="csvp_request" value="charge_voucher">
                        <input type="hidden" name="community_member_id" id="community_member_id">
                        <input type="hidden" name="transaction_amount" id="transaction_amount">
                        <input type="hidden" name="voucher_transaction_id" id="voucher_transaction_id">
                        <input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
                        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal" aria-label="Close">ביטול</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="store-manager-card-charge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content p-4" style="direction: rtl">
                <h3>Do you wish to charge <span id="acu_value"></span></h3>

                <div class="add-new-benefit-buttons mt-4">
                    <form method="POST" action="">
                        <input type="hidden" name="csvp_request" value="charge_card">
                        <input type="hidden" name="community_member_id" id="debit-community_member_id">
                        <input type="hidden" name="transaction_amount" id="transaction_amount">
                        <input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
                        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal" aria-label="Close">ביטול</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container bg-dark mt-5 w-100 p-5 rounded-3 hide-card">
        <h1 class="text-white text-center">Accumulated value debit</h1>

        <div class="mt-4 d-flex flex-row align-items-center justify-content-center">
            <h1 class="text-white me-2">₪</h1>
            <input style="width: 42%;" type="text" class="px-4 py-2 outline-0 bg-transparent border-0 text-white" name="" id="debit-value">
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <hr class="w-50 text-center text-white m-0 mt-2" style="border-width: 3px;">
            <button class="bg-white px-3 py-2 mt-3 rounded-3" style="font-size: 20px;" onclick="chargeCard()">Accumulated value amount
                debit</button>
        </div>
    </div>


    <div class="container bg-white mt-5 p-5 rounded-3 hide-card" style="direction: rtl;">
        <h1 class="text-black text-right">Accumulated value debit</h1>
        <div class="col-12 p-5 card-wrapper" id="member-vouchers">


        </div>


    </div>
</div>

<script>
    function chargeVoucher(voucher, member_id, voucher_transaction_id) {
        console.log(voucher)
        // voucher = JSON.parse(voucher)
        jQuery('#store-manager-voucher-charge').modal('show');

        let modal = document.querySelector('#store-manager-voucher-charge');
        modal.querySelector('#voucher_name').innerHTML = voucher.product_name;
        modal.querySelector('#voucher_id').value = voucher.id;
        modal.querySelector('#voucher_name').innerHTML = voucher.product_name;
        modal.querySelector('#voucher_price').innerHTML = voucher.voucher_price;
        modal.querySelector('#transaction_amount').value = voucher.voucher_price;
        modal.querySelector('#voucher_transaction_id').value = voucher_transaction_id;
        modal.querySelector('#community_member_id').value = member_id;
    }

    function chargeCard() {
        // voucher = JSON.parse(voucher)
        jQuery('#store-manager-card-charge').modal('show');
        let modal = document.querySelector('#store-manager-card-charge');
        let amount = document.querySelector('#debit-value').value;

        modal.querySelector('#transaction_amount').value = amount;
        document.querySelector('#acu_value').innerHTML = amount;
    }
</script>