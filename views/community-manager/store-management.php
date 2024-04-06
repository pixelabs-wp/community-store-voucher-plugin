<?php include CSVP_PLUGIN_PATH . "views/community-manager/header.php" ?>
<?php
global $community;
$community_id = $community->get_current_community_id();

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



    /* Store Details modal style starts here */


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
        /* Add padding for inner content */
    }

    .tran {
        margin: 7px;
        width: 100%;
        height: 87px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        align-items: center;
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
        color: rgba(0, 0, 0, 1);
        margin: 0;
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
    }

    .header-data-wrapper {
        flex-direction: row;
    }

    .cards {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        /* border: 1px solid rgba(0, 0, 0, .125); */
        border-radius: 0.25rem;
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

    @media screen and (max-width: 839px) {
        .main {
            background-color: #01051D;
            flex-direction: column;
            align-items: center;
        }

        .balance {
            background-color: #FFFFFF;
        }

        .address-title {
            font-size: 12px;
            font-weight: 200;
        }

        .address {
            display: flow-root;
        }

        .buttonss {
            font-size: 15px;
            font-weight: 300;
        }
    }

    @media screen and (max-width: 605px) {
        .main {
            background-color: #01051D;
            flex-direction: column;
            align-items: center;
        }

        .balance {
            background-color: #FFFFFF;
        }

        .address-title {
            font-size: 12px;
            font-weight: 200;
        }

        /* svg{
               width: 98%; 
            } */
        .buttonss {
            font-size: 13px;
            font-weight: 300;
        }
    }

    @media screen and (max-width: 700px) {
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

    }

    @media screen and (max-width: 873px) {
        .buttons {
            font-weight: 400;
            font-size: 12px;
        }

        .titl {
            font-size: 16px;
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
            font-size: 14px;
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

    .btn-customs:hover,
    .btn-custom:hover {

        color: black;
    }


    #store-details .titl,
    #store-details .card-footer,
    #store-details .address-title {
        direction: rtl;
    }

    /* Store Details modal style ends here */






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

    @media screen and (max-width: 1200px) {
        .store-management-modal-header {
            flex-direction: column-reverse;
        }
    }

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


    .styled-element span {
        direction: rtl;
    }

    /* Add new order modal style ends here */
</style>

<div class="modal fade" id="community-manager-add-new-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content p-4">
            <div class="background-box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-center mt-2">
                        <h1 class="">בקשת הזמנה</h1>
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
                            <input class="custom-file-input" type="file" name="order_info_file" id="formFileMultiple" multiple>
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
                        <span>סה"כ שווי הזמנה: ₪ <span class="total-cost"></span></span>
                        <span>סה”כ פריטים: <span class="total-added-items"></span> פריטים</span>
                    </div>
                    <div class="btngroup">
                        <input type="hidden" id="order_request_store_id" name="store_id" value="">
                        <input type="hidden" name="csvp_request" value="add_order_request">
                        <button class="button button-primary">אישור</button>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="button button-secondary">ביטול</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  Add new Order modal ends here -->

<!-- Return Request modal Starts here -->

<div class="modal fade" id="community-manager-return-request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content p-4">
            <div class="background-box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-center mt-2">
                        <h1 class="">בקשת החזרה</h1>
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
                            <tbody id="return_items">
                            </tbody>

                        </table>
                    </div>
                    <div class="flex">
                        <div class="mb-3">
                            <input class="custom-file-input" type="file" id="formFileMultiple" multiple>
                        </div>
                        <div class="mb-3">
                            <label class="labell">הוספת שורה</label>
                            <svg onclick="addReturnRow()" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <input type="hidden" id="order__return_request_store_id" name="store_id" value="">
                        <input type="hidden" name="csvp_request" value="add_return_request">
                        <button class="button button-primary">אישור</button>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="button button-secondary">ביטול</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Return Request modal Starts here -->

<!-- Store details modal Starts here -->
<div class="modal fade" id="store-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style=" overflow: auto; ">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="main">
                <div class="credit-container">
                    <div class="balance">
                        <h4>תקרת אשראי</h4>
                        <span> ₪ <span id="credit_limit"></span> </span>
                        <h4>יתרת אשראי</h4>
                        <span> ₪ <span id="credit_balance"></span> </span>
                    </div>
                </div>
                <div class="d-flex store-management-modal-header align-items-center gap-3 header-data-wrapper">
                    <div class="address d-flex flex-column align-items-end gap-3 p-4">
                        <h1 id="name_of_store">ת”ת אור התורה </h1>
                        <div>
                            <h2 class="address-title"> משה מנהל חנות:<span id="store_manager_no">054-6268012</span>
                                <span id="store_manager_address">
                                    רבי עקיבא 84 בני ברק</span> :כתובת
                            </h2>
                            <h3 class="address-title"></h3>
                        </div>

                        <div class="d-flex sw-buttons" style="direction: rtl;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#community-manager-add-new-order" class="btn btn-customs" id="community-manager-add-new-order_btn">בקשת הזמנה
                                חדשה +</button>
                            <button type=" button" data-bs-toggle="modal" data-bs-target="#community-manager-return-request" class="btn btn-custom">הוספת החזרה
                                חדשה +</button>
                        </div>
                    </div>
                    <div class="svggroup">
                        <div class="svvg">
                        </div>
                        <img src="" id="store_logo" alt="" width="207" height="194">
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
                <div class="d-flex flex-column align-items-end cont" id="parentOrderReturn">
                    <h3 class="buttons">הסטוריית החזרות </h3>

                </div>
                <!-- 4st one -->
                <div class="d-flex flex-column align-items-end cont" id="parentOrderPending">
                    <h3 class="title">בקשות הזמנה ממתינות לאישור </h3>

                </div>
                <div>
                    <div class="d-flex flex-column align-items-end cont">
                        <h3 class="title">פרטי הסדרים והטבות לת”ת</h3>
                        <div class="d-flex gap-4 flex-wrap" style="direction: rtl;" id="voucherElementId">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Store details modal ends here -->
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

<div class="container m-auto row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M41.7966 39.2038L31.392 28.7992C33.733 25.8775 35.0059 22.2439 35 18.5C35 9.38742 27.613 2 18.5 2C9.38742 2 2 9.38742 2 18.5C2 27.6126 9.38742 35 18.5 35C22.3958 35 25.9763 33.6498 28.7992 31.3915L39.2038 41.7962C39.3739 41.9667 39.5759 42.1019 39.7983 42.1941C40.0208 42.2863 40.2592 42.3336 40.5 42.3333C40.8626 42.3334 41.217 42.2258 41.5185 42.0244C41.82 41.823 42.055 41.5367 42.1938 41.2017C42.3326 40.8668 42.3689 40.4982 42.2982 40.1426C42.2275 39.7869 42.053 39.4603 41.7966 39.2038ZM18.5 31.3333C11.4123 31.3333 5.66667 25.5877 5.66667 18.5C5.66667 11.4123 11.4123 5.66667 18.5 5.66667C25.5881 5.66667 31.3333 11.4123 31.3333 18.5C31.3333 25.5877 25.5881 31.3333 18.5 31.3333Z" fill="#01051D" />
                            </svg>

                        </span>

                        <?php
                        if (isset($_POST["store_name"])) {
                        ?>
                            <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                            <span class="current_filter">
                                <?php
                                echo $_POST["store_name"];
                                ?>
                            </span>
                        <?php
                        } ?>


                    </div>
                    <div class="col">
                        <form action="" method="post">
                            <input type="text" id="store-search" name="store_name" list="stores" value="<?php echo isset($_POST["store_name"]) ? $_POST["store_name"] : ""; ?>" placeholder="חיפוש חנות ">
                            <input type="hidden" name="csvp_filter" value="filter_by_name">
                            <datalist id="stores">
                                <?php foreach ($store->get_all_stores() as $key => $storeData) {
                                    echo '<option value="' . $storeData['store_name'] . '">' . $storeData['store_name'] . '</option>';
                                }; ?>

                            </datalist>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col" style=" display: flex;  justify-content: center; align-items: center; ">
                        <form action="" method="post" class="m-0">
                            <input type="hidden" name="csvp_filter" value="filter_by_not_joined">
                            <button class="font-weight-medium ts-text btn border-0 text-right w-20"> חנויות שלא
                                בהסדר</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col" style=" display: flex; justify-content: center; align-items: center; ">
                        <form action="" method="post" class="m-0">
                            <input type="hidden" name="csvp_filter" value="filter_by_joined">
                            <button type="submit" class="font-weight-medium ts-text btn border-0 text-right w-20">תת”ים
                                בהסדר</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-4 d-flex flex-wrap" style="row-gap: 2rem; column-gap: 5rem;">
    <?php if (isset($pageData["joined_store"])) {
        foreach ($pageData["joined_store"] as $store) {

            $store_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $store['store_data']->store_logo;

            $order_count = 0;
            $total_order_amount = 0;
            if (isset($store['order_data']->order_count)) {
                $order_count = $store['order_data']->order_count;
            }
            if (isset($store['order_data']->total_order_amount)) {
                $total_order_amount = $store['order_data']->total_order_amount;
            } ?>
            <div class="store-management-card card col-xl-4 rounded-3 p-0">
                <!-- Photo -->
                <div class="card-body d-flex p-0">

                    <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                        <div class="store-management-information rounded-3">
                            <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                                <table>
                                    <tr class="d-flex flex-column gap-2 text-center">
                                        <td><strong>שם החנות: </strong>
                                            <?php echo $store['store_data']->store_name; ?>
                                        </td>
                                        <td><strong>כמות הזמנות: </strong>
                                            <?php echo $order_count; ?>
                                        </td>
                                        <td><strong>סך הזמנות: </strong>
                                            <?php echo $total_order_amount; ?> ₪
                                        </td>
                                        <td><button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#store-details" data-id="<?php echo $store['store_id']; ?>">Open Popup</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $store_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                </div>
            </div>
    <?php }
    } ?>
    <?php if (isset($pageData["requested_stores"])) {
        foreach ($pageData["requested_stores"] as $store) {
            $store_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $store['store_data']->store_logo;

            $order_count = 0;
            $total_order_amount = 0;
            if (isset($store['order_data']->order_count)) {
                $order_count = $store['order_data']->order_count;
            }
            if (isset($store['order_data']->total_order_amount)) {
                $total_order_amount = $store['order_data']->total_order_amount;
            } ?>
            <div class="store-management-card card col-xl-4 rounded-3 p-0">
                <div class="card-body d-flex p-0">
                    <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                        <div class="store-management-information rounded-3">
                            <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                                <table>
                                    <tr class="d-flex flex-column gap-2 text-center">
                                        <td><strong>שם החנות: </strong>
                                            <?php echo $store['store_data']->store_name; ?>
                                        </td>
                                        <td><strong>כמות הזמנות: </strong>
                                            <?php echo $order_count; ?>
                                        </td>
                                        <td><strong>סך הזמנות: </strong>
                                            <?php echo $total_order_amount; ?> ₪
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <label class="text-secondary "><b>בקשה בהמתנה</b></label>
                    </div>
                    <div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $store_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                </div>
            </div>
    <?php }
    } ?>
    <?php if (isset($pageData["not_requested_stores"])) {
        foreach ($pageData["not_requested_stores"] as $store) {
            $store_logo = esc_url(get_site_url() . '/wp-content/uploads/') . $store['store_data']->store_logo;
            $order_count = 0;
            $total_order_amount = 0;
            if (isset($store['order_data']->order_count)) {
                $order_count = $store['order_data']->order_count;
            }
            if (isset($store['order_data']->total_order_amount)) {
                $total_order_amount = $store['order_data']->total_order_amount;
            } ?>
            <div class="store-management-card card col-xl-4 rounded-3 p-0">
                <!-- Photo -->
                <div class="card-body d-flex p-0">

                    <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                        <div class="store-management-information rounded-3">
                            <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                                <table>
                                    <tr class="d-flex flex-column gap-2 text-center">
                                        <td><strong>שם החנות: </strong>
                                            <?php echo $store['store_data']->store_name; ?>
                                        </td>
                                        <td><strong>כמות הזמנות: </strong>
                                            <?php echo $order_count; ?>
                                        </td>
                                        <td><strong>סך הזמנות: </strong>
                                            <?php echo $total_order_amount; ?> ₪
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <form method="POST" action="" style="direction: rtl;">
                            <input type="hidden" id="benifit_store_id" name="store_id" value="<?php echo $store['store_data']->id; ?>">
                            <input type="hidden" name="csvp_request" value="joining_request">
                            <button class="btn btn-dark">לצירוף הת”ת ←</button>
                        </form>
                    </div>
                    <div class="w-35 " style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(<?php echo $store_logo; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
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
    var parentOrderHistory = document.getElementById("parentOrderHistory");
    var parentOrderPending = document.getElementById("parentOrderPending");
    var parentOrderReturn = document.getElementById("parentOrderReturn");
    var voucherElement = document.getElementById("voucherElementId");

    function addSection(id, imageSrc, title, price, discountPrice) {
        var imageUrl = "<?php echo esc_url(get_site_url() . '/wp-content/uploads/'); ?>" + imageSrc;
        var section = `
        <div class="d-flex gap-3">
            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                <div class="cards">
                    <div class="card-text">
                        <img class="second-img" src="${imageUrl}" width="286px" height="220px">
                    </div>
                </div>
                <div class="card-footer text-center bg-transparent ">
                    ${title}
                    <div class="text-center bg-transparent ">${discountPrice}₪  במקום  <del>${price}</del>₪</div>
                </div>
            </div>
        </div>

    `;

        voucherElement.innerHTML += section; // Use innerHTML to append HTML content
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

    function addOrderHistory(item) {
        console.log("order item", item);
        var section = ``;
        var approvalSection = ``;
        var returnSection = ``;

        var date = new Date(item.created_at);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var formattedDay = (day < 10) ? '0' + day : day;
        var formattedMonth = (month < 10) ? '0' + month : month;
        var newDate = formattedDay + '/' + formattedMonth + '/' + year;

        if (item.order_status == '<?php echo ORDER_STATUS_PAID; ?>') {
            section = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color: #01051D; color: white;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">שולם</span>&nbsp;
                </div>
                <div class="d-flex gap-3">
                    <div>
                        <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'> לפרטי ההזמנה</button>					
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">הזמנה: ${item.id}</h3>
                </div>
            </div>`;
        } else if (item.order_status == '<?php echo ORDER_STATUS_COMPLETED; ?>') {
            section = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color:  #01051D3D;; color: white;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">לא שולם</span>&nbsp;
                </div>
                <div class="d-flex gap-3">
                    <div>
                        <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'> לפרטי ההזמנה</button>				
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">הזמנה: ${item.id}</h3>
                </div>
            </div>`;
        } else if (item.order_status == '<?php echo ORDER_STATUS_PROCESSING; ?>') {
            section = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color:   #BC9B63; color: white;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">ממתין לתשלום</span>&nbsp;
                </div>
                <div class="d-flex gap-3">
                    <div>
                        <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'> לפרטי ההזמנה</button>
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">הזמנה: ${item.id}</h3>
                </div>
            </div>`;
        } else if (item.order_status == '<?php echo ORDER_STATUS_PENDING; ?>') {
            approvalSection = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color: #F9F8C7; color: black;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">ממתין לאישור</span>&nbsp;
                </div>
                <div class="d-flex gap-3">
                    <div>
                        <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'>לפרטי ההזמנה</button>
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">הזמנה: ${item.id}</h3>
                </div>
            </div>`;
        } else if (item.order_status == '<?php echo ORDER_STATUS_RETURNED; ?>') {
            returnSection = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color: #F9F8C7; color: black;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">ממתין לזיכוי </span>&nbsp;
                </div> 
                <div class="d-flex gap-3">
                    <div>
                    <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'>לפרטי החזרה</button>
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">החזרה: ${item.id}</h3>
                </div>
            </div>`;
        } else if (item.order_status == '<?php echo ORDER_STATUS_RETURNED_PAID; ?>') {
            returnSection = section + `
            <div class="d-flex justify-content-between tran">
                <div>
                    <span class="buttons" style="background-color: #01051D; color: white;  font-size: 16px; padding: 5px 20px; border-radius: 5px;">זוכה</span>&nbsp;
                </div> 
                <div class="d-flex gap-3">
                    <div>
                    <button class="buttonss"  style="background-color: #9D0000;"  data-bs-toggle="modal"  data-bs-target="#order_details"  onclick="populateOrderDetailModalFunction(this)" data-order-details='${JSON.stringify(item)}'>לפרטי החזרה</button>
                    </div>
                    <h3 class="titl">תאריך הזמנה: ${newDate}</h3>
                    <h3 class="titl">סכום: ${item.order_total} ₪ </h3>
                    <h3 class="titl">החזרה: ${item.id}</h3>
                </div>
            </div>`;
        }

        parentOrderHistory.insertAdjacentHTML('beforeend', section);
        parentOrderPending.insertAdjacentHTML('beforeend', approvalSection);
        parentOrderReturn.insertAdjacentHTML('beforeend', returnSection);


    }




    jQuery('#store-details').on('show.bs.modal', function(event) {
        var button = jQuery(event.relatedTarget);
        var id = button.data('id');
        var store_id = button.data('id');
        var community_id = <?php echo $community_id; ?>;
        // jQuery('#benifit_community_id').val(id);
        // jQuery('#credit_limit_community_id').val(id);
        jQuery('#order_request_store_id').val(id);
        jQuery('#order__return_request_store_id').val(id);

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: 'csvp_ajax', // Action hook
                csvp_request: 'CSVP_Store', // Action hook
                csvp_handler: 'get_store_data_for_community_popup', // Action hook
                data: {
                    store_id: id
                }
            },
            success: function(response) {
                console.log(response);
                // Handle success response
                document.getElementById('credit_limit').innerHTML = response[0]["credit_limit"];
                document.getElementById('credit_balance').innerHTML = response[0]["creditbalance"];

                if (response[0]["creditbalance"] >= response[0]["credit_limit"]) {
                    document.querySelector("#community-manager-add-new-order_btn").disabled = true;
                }

                document.getElementById('name_of_store').innerHTML = response[0]["store_name"];
                document.getElementById('store_manager_no').innerHTML = response[0]["store_cashier_phone"];
                document.getElementById('store_manager_address').innerHTML = response[0]["store_address"];
                document.getElementById('store_logo').src = "<?php echo esc_url(get_site_url() . '/wp-content/uploads/'); ?>" + response[0]["store_logo"];

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
                    type: "community"
                }
            },
            success: function(response) {
                // Handle success response
                if (response.length > 0) {
                    var voucherElementId = document.getElementById("voucherElementId");
                    voucherElementId.innerHTML = "";
                    response.forEach(function(item) {
                        addSection(item.id, item.product_image, item.product_name, item.normal_price, item.voucher_price);
                    });
                } else {
                    var voucherElementId = document.getElementById("voucherElementId");
                    voucherElementId.innerHTML = "<label>No Vouchers Found</label>"; // Use innerHTML to append HTML content
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
                    type: 'community'
                }
            },
            success: function(response) {
                // Handle success response
                if (response) {
                    parentOrderHistory.innerHTML = "";
                    parentOrderHistory.innerHTML = "<h3 class='title'>הסטוריית הזמנות </h3>";
                    parentOrderPending.innerHTML = "";
                    parentOrderPending.innerHTML = '<h3 class="title">בקשות הזמנה ממתינות לאישור </h3>"';
                    parentOrderReturn.innerHTML = "";
                    parentOrderReturn.innerHTML = '<h3 class="buttons">הסטוריית החזרות </h3>';
                    response.forEach(function(item) {
                        addOrderHistory(item);
                    });
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
                                <button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" >לא שולם</button>
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
                            <div><button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" >לא שולם</button></div>
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
                            <div><button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);" >לא שולם</button></div>
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
                                <button class="buttons" style="background-color:  #BC9B63;" >שליחת דרישת תשלום+</button>
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
                            <div><button class="buttons" style="background-color: #BC9B63;" >שליחת דרישת תשלום+</button></div>
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
                            <div><button class="buttons" style="background-color:  #BC9B63;" >שליחת דרישת תשלום+</button></div>
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
</script>

<script>
    function addRow() {
        var table = document.querySelector('.table tbody');
        var newRow = table.insertRow();
        newRow.innerHTML = `
        <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" readonly id="total-cost" class="total-input" name="total_cost[]" placeholder="סך הכל" ></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="cost-per-item" class="cost-input" name="cost_per_item[]" placeholder="עלות לפריט"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="total-item" class="amount-input" name="total_item[]" placeholder="כמות"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="name-input" name="product_name[]" placeholder="שם המוצר"></th>`;
    }

    function addReturnRow() {
        var table = document.getElementById('return_items');
        var newRow = table.insertRow();
        newRow.innerHTML = `
        <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" readonly id="total-cost" class="total-input" name="total_cost[]" placeholder="סך הכל" ></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="cost-per-item" class="cost-input" name="cost_per_item[]" placeholder="עלות לפריט"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="number" id="total-item" class="amount-input" name="total_item[]" placeholder="כמות"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="name-input" name="product_name[]" placeholder="שם המוצר"></th>`;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal1 = document.getElementById('community-manager-add-new-order');
        const modal2 = document.getElementById('community-manager-return-request');
        const modal1Table = modal1.querySelector('table');
        const modal2Table = modal2.querySelector('table');

        function updateTotalItems(table) {
            const totalItemInputs = table.querySelectorAll('.amount-input');
            let total = 0;
            for (const input of totalItemInputs) {
                const value = parseFloat(input.value) || 0;
                total += value;
            }
            const totalSpan = table.closest('.modal-content').querySelector('.total-added-items');
            totalSpan.textContent = total;
        }

        function updateCost(table) {
            const totalItemInputs = table.querySelectorAll('.total-input');
            let total = 0;
            for (const input of totalItemInputs) {
                const value = parseFloat(input.value) || 0;
                total += value;
            }
            const totalSpan = table.closest('.modal-content').querySelector('.total-cost');
            totalSpan.textContent = total;
        }

        function calculateTotal(table) {
            table.addEventListener('input', (event) => {
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

                    updateTotalItems(table);
                    updateCost(table);
                }
            });
        }

        function resetValues(modal) {
            const inputs = modal.querySelectorAll('input[type="number"]');
            const inputss = modal.querySelectorAll('input[type="text"]');
            for (const input of inputs) {
                input.value = ''; // Reset input values
            }
            for (const inputsss of inputss) {
                inputsss.value = ''; // Reset input values
            }
            updateTotalItems(modal.querySelector('table'));
            updateCost(modal.querySelector('table'));
        }

        modal1.addEventListener('hidden.bs.modal', function() {
            resetValues(modal1);
        });

        modal2.addEventListener('hidden.bs.modal', function() {
            resetValues(modal2);
        });

        calculateTotal(modal1Table);
        calculateTotal(modal2Table);
    });
</script>