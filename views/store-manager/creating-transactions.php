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

</style>

<div class="container-fluid">
    <div class="container creating-transaction-guy-data w-75  bg-white  p-5 rounded-3">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <h3>elyau malka</h3>
            <h3>1254545216</h3>
            <h3>Total: 450₪ </h3>
        </div>
        <hr class="m-0 mt-2">
    </div>



    <div class="container bg-dark mt-5 w-100 p-5 rounded-3">
        <h1 class="text-white text-center">Accumulated value debit</h1>

        <div class="mt-4 d-flex flex-row align-items-center justify-content-center">
            <h1 class="text-white me-2">₪</h1>
            <input style="width: 42%;" type="text" class="px-4 py-2 outline-0 bg-transparent border-0 text-white"
                name="" id="">
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <hr class="w-50 text-center text-white m-0 mt-2" style="border-width: 3px;">
            <button class="bg-white px-3 py-2 mt-3 rounded-3" style="font-size: 20px;">Accumulated value amount
                debit</button>
        </div>
    </div>


    <div class="container bg-white mt-5 p-5 rounded-3" style="direction: rtl;">
        <h1 class="text-black text-right">Accumulated value debit</h1>
        <div class="col-12 p-5 card-wrapper">

            <div class="card">
                <!-- Photo -->
                <div class="img-responsive img-responsive-21x9 card-img-top"
                    style="background-image: url(http://rsvp.local/wp-content/uploads/2024/03/Coupon-image.jpg);height: 250px;">
                </div>
                <div class="card-body bg-white text-center">
                    <h3 class="card-title">חליפה 70% צמר </h3>
                    <h3 class="text-secondary"> 680₪ במקום 990₪</h3>
                    <button class="btn bg-black text-white">Voucher charge</button>
                </div>
            </div>
        </div>


    </div>
</div>