<?php include CSVP_PLUGIN_PATH . "views/community-manager/header.php" ?>

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

<!-- <div class="container">
        <div class="bg-dark p-3 rounded-3">

            <div class="row">
                <div class="bg-white col-sm-3 filter-text rounded-3 p-3">
                    <svg width="45" height="43" viewBox="0 0 45 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.6052 3.74621H26.0818V0.979358C26.0817 0.840731 26.0504 0.703905 25.9901 0.579055C25.9299 0.454206 25.8422 0.344544 25.7338 0.258225C25.6253 0.171907 25.4988 0.111152 25.3636 0.0804777C25.2284 0.0498039 25.088 0.0500007 24.9529 0.0810533L0.973505 5.61476C0.770203 5.66149 0.588746 5.77576 0.458759 5.93891C0.328773 6.10206 0.257935 6.30446 0.257812 6.51307V37.8707C0.257896 38.091 0.336798 38.3039 0.480247 38.4711C0.623695 38.6382 0.822219 38.7485 1.03991 38.782L25.0193 42.4711C25.1508 42.4916 25.2851 42.4834 25.413 42.447C25.541 42.4107 25.6596 42.347 25.7606 42.2604C25.8615 42.1738 25.9426 42.0663 25.998 41.9454C26.0535 41.8244 26.082 41.6929 26.0818 41.5599V38.793H43.6052C43.8498 38.793 44.0844 38.6959 44.2573 38.5229C44.4303 38.3499 44.5275 38.1154 44.5275 37.8707V4.6685C44.5275 4.42389 44.4303 4.18931 44.2573 4.01634C44.0844 3.84338 43.8498 3.74621 43.6052 3.74621ZM26.0818 16.6582H31.6155V20.3473H26.0818V16.6582ZM7.77628 28.1591L11.7771 21.7584C11.8694 21.6121 11.9183 21.4426 11.9183 21.2696C11.9183 21.0966 11.8694 20.9272 11.7771 20.7808L7.77812 14.3802C7.7079 14.2776 7.65915 14.1619 7.63478 14.04C7.61042 13.9181 7.61095 13.7925 7.63634 13.6708C7.66173 13.5491 7.71146 13.4338 7.78254 13.3318C7.85361 13.2299 7.94457 13.1433 8.04995 13.0774C8.15533 13.0114 8.27295 12.9675 8.39575 12.9481C8.51855 12.9288 8.64398 12.9345 8.76453 12.9649C8.88507 12.9952 8.99823 13.0497 9.0972 13.1249C9.19617 13.2001 9.27892 13.2945 9.34047 13.4025L12.3877 18.2777C12.7253 18.8163 13.6143 18.8163 13.9519 18.2777L16.9991 13.4025C17.063 13.2995 17.1466 13.2101 17.2451 13.1394C17.3436 13.0688 17.4552 13.0183 17.5733 12.9909C17.6913 12.9635 17.8137 12.9596 17.9333 12.9796C18.0528 12.9996 18.1673 13.043 18.27 13.1074C18.3729 13.1714 18.4621 13.2551 18.5326 13.3537C18.6031 13.4522 18.6535 13.5637 18.6809 13.6817C18.7083 13.7997 18.7122 13.922 18.6924 14.0415C18.6725 14.1611 18.6293 14.2755 18.5652 14.3783L14.5643 20.779C14.4721 20.9253 14.4231 21.0948 14.4231 21.2678C14.4231 21.4408 14.4721 21.6102 14.5643 21.7566L18.5633 28.1572C18.6275 28.2599 18.6708 28.3743 18.6908 28.4937C18.7108 28.6132 18.7071 28.7354 18.6799 28.8534C18.6527 28.9715 18.6024 29.0829 18.5321 29.1816C18.4618 29.2802 18.3727 29.364 18.27 29.4282C18.0608 29.5515 17.8122 29.5896 17.5756 29.5346C17.339 29.4797 17.1326 29.3359 16.9991 29.133L13.9519 24.2578C13.8682 24.1261 13.7526 24.0177 13.6157 23.9426C13.4789 23.8676 13.3253 23.8283 13.1693 23.8285C13.0132 23.8287 12.8598 23.8683 12.7231 23.9437C12.5865 24.0191 12.4711 24.1278 12.3877 24.2597L9.34047 29.1349C9.20668 29.3374 9.0003 29.4809 8.76386 29.5358C8.52741 29.5907 8.27892 29.5528 8.06956 29.43C7.96686 29.3658 7.8778 29.282 7.80748 29.1834C7.73715 29.0848 7.68694 28.9733 7.65971 28.8553C7.63247 28.7373 7.62875 28.615 7.64875 28.4956C7.66875 28.3761 7.71209 28.2618 7.77628 28.1591ZM26.0818 22.1919H31.6155V25.881H26.0818V22.1919ZM33.4601 22.1919H42.6829V25.881H33.4601V22.1919ZM33.4601 20.3473V16.6582H42.6829V20.3473H33.4601ZM33.4601 14.8136V11.1245H42.6829V14.8136H33.4601ZM31.6155 14.8136H26.0818V11.1245H31.6155V14.8136ZM26.0818 27.7256H31.6155V31.4148H26.0818V27.7256ZM33.4601 27.7256H42.6829V31.4148H33.4601V27.7256ZM42.6829 9.27992H33.4601V5.59078H42.6829V9.27992ZM31.6155 5.59078V9.27992H26.0818V5.59078H31.6155ZM26.0818 33.2593H31.6155V36.9485H26.0818V33.2593ZM33.4601 36.9485V33.2593H42.6829V36.9485H33.4601Z"
                            fill="#01051D" />
                    </svg>
                    יצא לאקסל

                </div>

                <div class="bg-white col-sm-3 filter-text rounded-3 p-3">
                    <svg width="45" height="43" viewBox="0 0 45 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.6052 3.74621H26.0818V0.979358C26.0817 0.840731 26.0504 0.703905 25.9901 0.579055C25.9299 0.454206 25.8422 0.344544 25.7338 0.258225C25.6253 0.171907 25.4988 0.111152 25.3636 0.0804777C25.2284 0.0498039 25.088 0.0500007 24.9529 0.0810533L0.973505 5.61476C0.770203 5.66149 0.588746 5.77576 0.458759 5.93891C0.328773 6.10206 0.257935 6.30446 0.257812 6.51307V37.8707C0.257896 38.091 0.336798 38.3039 0.480247 38.4711C0.623695 38.6382 0.822219 38.7485 1.03991 38.782L25.0193 42.4711C25.1508 42.4916 25.2851 42.4834 25.413 42.447C25.541 42.4107 25.6596 42.347 25.7606 42.2604C25.8615 42.1738 25.9426 42.0663 25.998 41.9454C26.0535 41.8244 26.082 41.6929 26.0818 41.5599V38.793H43.6052C43.8498 38.793 44.0844 38.6959 44.2573 38.5229C44.4303 38.3499 44.5275 38.1154 44.5275 37.8707V4.6685C44.5275 4.42389 44.4303 4.18931 44.2573 4.01634C44.0844 3.84338 43.8498 3.74621 43.6052 3.74621ZM26.0818 16.6582H31.6155V20.3473H26.0818V16.6582ZM7.77628 28.1591L11.7771 21.7584C11.8694 21.6121 11.9183 21.4426 11.9183 21.2696C11.9183 21.0966 11.8694 20.9272 11.7771 20.7808L7.77812 14.3802C7.7079 14.2776 7.65915 14.1619 7.63478 14.04C7.61042 13.9181 7.61095 13.7925 7.63634 13.6708C7.66173 13.5491 7.71146 13.4338 7.78254 13.3318C7.85361 13.2299 7.94457 13.1433 8.04995 13.0774C8.15533 13.0114 8.27295 12.9675 8.39575 12.9481C8.51855 12.9288 8.64398 12.9345 8.76453 12.9649C8.88507 12.9952 8.99823 13.0497 9.0972 13.1249C9.19617 13.2001 9.27892 13.2945 9.34047 13.4025L12.3877 18.2777C12.7253 18.8163 13.6143 18.8163 13.9519 18.2777L16.9991 13.4025C17.063 13.2995 17.1466 13.2101 17.2451 13.1394C17.3436 13.0688 17.4552 13.0183 17.5733 12.9909C17.6913 12.9635 17.8137 12.9596 17.9333 12.9796C18.0528 12.9996 18.1673 13.043 18.27 13.1074C18.3729 13.1714 18.4621 13.2551 18.5326 13.3537C18.6031 13.4522 18.6535 13.5637 18.6809 13.6817C18.7083 13.7997 18.7122 13.922 18.6924 14.0415C18.6725 14.1611 18.6293 14.2755 18.5652 14.3783L14.5643 20.779C14.4721 20.9253 14.4231 21.0948 14.4231 21.2678C14.4231 21.4408 14.4721 21.6102 14.5643 21.7566L18.5633 28.1572C18.6275 28.2599 18.6708 28.3743 18.6908 28.4937C18.7108 28.6132 18.7071 28.7354 18.6799 28.8534C18.6527 28.9715 18.6024 29.0829 18.5321 29.1816C18.4618 29.2802 18.3727 29.364 18.27 29.4282C18.0608 29.5515 17.8122 29.5896 17.5756 29.5346C17.339 29.4797 17.1326 29.3359 16.9991 29.133L13.9519 24.2578C13.8682 24.1261 13.7526 24.0177 13.6157 23.9426C13.4789 23.8676 13.3253 23.8283 13.1693 23.8285C13.0132 23.8287 12.8598 23.8683 12.7231 23.9437C12.5865 24.0191 12.4711 24.1278 12.3877 24.2597L9.34047 29.1349C9.20668 29.3374 9.0003 29.4809 8.76386 29.5358C8.52741 29.5907 8.27892 29.5528 8.06956 29.43C7.96686 29.3658 7.8778 29.282 7.80748 29.1834C7.73715 29.0848 7.68694 28.9733 7.65971 28.8553C7.63247 28.7373 7.62875 28.615 7.64875 28.4956C7.66875 28.3761 7.71209 28.2618 7.77628 28.1591ZM26.0818 22.1919H31.6155V25.881H26.0818V22.1919ZM33.4601 22.1919H42.6829V25.881H33.4601V22.1919ZM33.4601 20.3473V16.6582H42.6829V20.3473H33.4601ZM33.4601 14.8136V11.1245H42.6829V14.8136H33.4601ZM31.6155 14.8136H26.0818V11.1245H31.6155V14.8136ZM26.0818 27.7256H31.6155V31.4148H26.0818V27.7256ZM33.4601 27.7256H42.6829V31.4148H33.4601V27.7256ZM42.6829 9.27992H33.4601V5.59078H42.6829V9.27992ZM31.6155 5.59078V9.27992H26.0818V5.59078H31.6155ZM26.0818 33.2593H31.6155V36.9485H26.0818V33.2593ZM33.4601 36.9485V33.2593H42.6829V36.9485H33.4601Z"
                            fill="#01051D" />
                    </svg>
                    יצא לאקסל
                </div>

                <div class="bg-white col-sm-3 filter-text rounded-3 p-3">
                    <svg width="45" height="43" viewBox="0 0 45 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.6052 3.74621H26.0818V0.979358C26.0817 0.840731 26.0504 0.703905 25.9901 0.579055C25.9299 0.454206 25.8422 0.344544 25.7338 0.258225C25.6253 0.171907 25.4988 0.111152 25.3636 0.0804777C25.2284 0.0498039 25.088 0.0500007 24.9529 0.0810533L0.973505 5.61476C0.770203 5.66149 0.588746 5.77576 0.458759 5.93891C0.328773 6.10206 0.257935 6.30446 0.257812 6.51307V37.8707C0.257896 38.091 0.336798 38.3039 0.480247 38.4711C0.623695 38.6382 0.822219 38.7485 1.03991 38.782L25.0193 42.4711C25.1508 42.4916 25.2851 42.4834 25.413 42.447C25.541 42.4107 25.6596 42.347 25.7606 42.2604C25.8615 42.1738 25.9426 42.0663 25.998 41.9454C26.0535 41.8244 26.082 41.6929 26.0818 41.5599V38.793H43.6052C43.8498 38.793 44.0844 38.6959 44.2573 38.5229C44.4303 38.3499 44.5275 38.1154 44.5275 37.8707V4.6685C44.5275 4.42389 44.4303 4.18931 44.2573 4.01634C44.0844 3.84338 43.8498 3.74621 43.6052 3.74621ZM26.0818 16.6582H31.6155V20.3473H26.0818V16.6582ZM7.77628 28.1591L11.7771 21.7584C11.8694 21.6121 11.9183 21.4426 11.9183 21.2696C11.9183 21.0966 11.8694 20.9272 11.7771 20.7808L7.77812 14.3802C7.7079 14.2776 7.65915 14.1619 7.63478 14.04C7.61042 13.9181 7.61095 13.7925 7.63634 13.6708C7.66173 13.5491 7.71146 13.4338 7.78254 13.3318C7.85361 13.2299 7.94457 13.1433 8.04995 13.0774C8.15533 13.0114 8.27295 12.9675 8.39575 12.9481C8.51855 12.9288 8.64398 12.9345 8.76453 12.9649C8.88507 12.9952 8.99823 13.0497 9.0972 13.1249C9.19617 13.2001 9.27892 13.2945 9.34047 13.4025L12.3877 18.2777C12.7253 18.8163 13.6143 18.8163 13.9519 18.2777L16.9991 13.4025C17.063 13.2995 17.1466 13.2101 17.2451 13.1394C17.3436 13.0688 17.4552 13.0183 17.5733 12.9909C17.6913 12.9635 17.8137 12.9596 17.9333 12.9796C18.0528 12.9996 18.1673 13.043 18.27 13.1074C18.3729 13.1714 18.4621 13.2551 18.5326 13.3537C18.6031 13.4522 18.6535 13.5637 18.6809 13.6817C18.7083 13.7997 18.7122 13.922 18.6924 14.0415C18.6725 14.1611 18.6293 14.2755 18.5652 14.3783L14.5643 20.779C14.4721 20.9253 14.4231 21.0948 14.4231 21.2678C14.4231 21.4408 14.4721 21.6102 14.5643 21.7566L18.5633 28.1572C18.6275 28.2599 18.6708 28.3743 18.6908 28.4937C18.7108 28.6132 18.7071 28.7354 18.6799 28.8534C18.6527 28.9715 18.6024 29.0829 18.5321 29.1816C18.4618 29.2802 18.3727 29.364 18.27 29.4282C18.0608 29.5515 17.8122 29.5896 17.5756 29.5346C17.339 29.4797 17.1326 29.3359 16.9991 29.133L13.9519 24.2578C13.8682 24.1261 13.7526 24.0177 13.6157 23.9426C13.4789 23.8676 13.3253 23.8283 13.1693 23.8285C13.0132 23.8287 12.8598 23.8683 12.7231 23.9437C12.5865 24.0191 12.4711 24.1278 12.3877 24.2597L9.34047 29.1349C9.20668 29.3374 9.0003 29.4809 8.76386 29.5358C8.52741 29.5907 8.27892 29.5528 8.06956 29.43C7.96686 29.3658 7.8778 29.282 7.80748 29.1834C7.73715 29.0848 7.68694 28.9733 7.65971 28.8553C7.63247 28.7373 7.62875 28.615 7.64875 28.4956C7.66875 28.3761 7.71209 28.2618 7.77628 28.1591ZM26.0818 22.1919H31.6155V25.881H26.0818V22.1919ZM33.4601 22.1919H42.6829V25.881H33.4601V22.1919ZM33.4601 20.3473V16.6582H42.6829V20.3473H33.4601ZM33.4601 14.8136V11.1245H42.6829V14.8136H33.4601ZM31.6155 14.8136H26.0818V11.1245H31.6155V14.8136ZM26.0818 27.7256H31.6155V31.4148H26.0818V27.7256ZM33.4601 27.7256H42.6829V31.4148H33.4601V27.7256ZM42.6829 9.27992H33.4601V5.59078H42.6829V9.27992ZM31.6155 5.59078V9.27992H26.0818V5.59078H31.6155ZM26.0818 33.2593H31.6155V36.9485H26.0818V33.2593ZM33.4601 36.9485V33.2593H42.6829V36.9485H33.4601Z"
                            fill="#01051D" />
                    </svg>
                    יצא לאקסל
                </div>

                <div class="bg-white col-sm-3 filter-text rounded-3 p-3">
                    <svg width="45" height="43" viewBox="0 0 45 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.6052 3.74621H26.0818V0.979358C26.0817 0.840731 26.0504 0.703905 25.9901 0.579055C25.9299 0.454206 25.8422 0.344544 25.7338 0.258225C25.6253 0.171907 25.4988 0.111152 25.3636 0.0804777C25.2284 0.0498039 25.088 0.0500007 24.9529 0.0810533L0.973505 5.61476C0.770203 5.66149 0.588746 5.77576 0.458759 5.93891C0.328773 6.10206 0.257935 6.30446 0.257812 6.51307V37.8707C0.257896 38.091 0.336798 38.3039 0.480247 38.4711C0.623695 38.6382 0.822219 38.7485 1.03991 38.782L25.0193 42.4711C25.1508 42.4916 25.2851 42.4834 25.413 42.447C25.541 42.4107 25.6596 42.347 25.7606 42.2604C25.8615 42.1738 25.9426 42.0663 25.998 41.9454C26.0535 41.8244 26.082 41.6929 26.0818 41.5599V38.793H43.6052C43.8498 38.793 44.0844 38.6959 44.2573 38.5229C44.4303 38.3499 44.5275 38.1154 44.5275 37.8707V4.6685C44.5275 4.42389 44.4303 4.18931 44.2573 4.01634C44.0844 3.84338 43.8498 3.74621 43.6052 3.74621ZM26.0818 16.6582H31.6155V20.3473H26.0818V16.6582ZM7.77628 28.1591L11.7771 21.7584C11.8694 21.6121 11.9183 21.4426 11.9183 21.2696C11.9183 21.0966 11.8694 20.9272 11.7771 20.7808L7.77812 14.3802C7.7079 14.2776 7.65915 14.1619 7.63478 14.04C7.61042 13.9181 7.61095 13.7925 7.63634 13.6708C7.66173 13.5491 7.71146 13.4338 7.78254 13.3318C7.85361 13.2299 7.94457 13.1433 8.04995 13.0774C8.15533 13.0114 8.27295 12.9675 8.39575 12.9481C8.51855 12.9288 8.64398 12.9345 8.76453 12.9649C8.88507 12.9952 8.99823 13.0497 9.0972 13.1249C9.19617 13.2001 9.27892 13.2945 9.34047 13.4025L12.3877 18.2777C12.7253 18.8163 13.6143 18.8163 13.9519 18.2777L16.9991 13.4025C17.063 13.2995 17.1466 13.2101 17.2451 13.1394C17.3436 13.0688 17.4552 13.0183 17.5733 12.9909C17.6913 12.9635 17.8137 12.9596 17.9333 12.9796C18.0528 12.9996 18.1673 13.043 18.27 13.1074C18.3729 13.1714 18.4621 13.2551 18.5326 13.3537C18.6031 13.4522 18.6535 13.5637 18.6809 13.6817C18.7083 13.7997 18.7122 13.922 18.6924 14.0415C18.6725 14.1611 18.6293 14.2755 18.5652 14.3783L14.5643 20.779C14.4721 20.9253 14.4231 21.0948 14.4231 21.2678C14.4231 21.4408 14.4721 21.6102 14.5643 21.7566L18.5633 28.1572C18.6275 28.2599 18.6708 28.3743 18.6908 28.4937C18.7108 28.6132 18.7071 28.7354 18.6799 28.8534C18.6527 28.9715 18.6024 29.0829 18.5321 29.1816C18.4618 29.2802 18.3727 29.364 18.27 29.4282C18.0608 29.5515 17.8122 29.5896 17.5756 29.5346C17.339 29.4797 17.1326 29.3359 16.9991 29.133L13.9519 24.2578C13.8682 24.1261 13.7526 24.0177 13.6157 23.9426C13.4789 23.8676 13.3253 23.8283 13.1693 23.8285C13.0132 23.8287 12.8598 23.8683 12.7231 23.9437C12.5865 24.0191 12.4711 24.1278 12.3877 24.2597L9.34047 29.1349C9.20668 29.3374 9.0003 29.4809 8.76386 29.5358C8.52741 29.5907 8.27892 29.5528 8.06956 29.43C7.96686 29.3658 7.8778 29.282 7.80748 29.1834C7.73715 29.0848 7.68694 28.9733 7.65971 28.8553C7.63247 28.7373 7.62875 28.615 7.64875 28.4956C7.66875 28.3761 7.71209 28.2618 7.77628 28.1591ZM26.0818 22.1919H31.6155V25.881H26.0818V22.1919ZM33.4601 22.1919H42.6829V25.881H33.4601V22.1919ZM33.4601 20.3473V16.6582H42.6829V20.3473H33.4601ZM33.4601 14.8136V11.1245H42.6829V14.8136H33.4601ZM31.6155 14.8136H26.0818V11.1245H31.6155V14.8136ZM26.0818 27.7256H31.6155V31.4148H26.0818V27.7256ZM33.4601 27.7256H42.6829V31.4148H33.4601V27.7256ZM42.6829 9.27992H33.4601V5.59078H42.6829V9.27992ZM31.6155 5.59078V9.27992H26.0818V5.59078H31.6155ZM26.0818 33.2593H31.6155V36.9485H26.0818V33.2593ZM33.4601 36.9485V33.2593H42.6829V36.9485H33.4601Z"
                            fill="#01051D" />
                    </svg>
                    יצא לאקסל
                </div>

            </div>

        </div>
    </div> -->



<!-- Add New Order modal Starts here -->


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
                        <span>סה”כ שווי החזרה: ₪ <span class="total-cost"></span></span>
                        <span>סה”כ פריטים: <span class="total-added-items"></span> פריטים</span>
                    </div>
                    <div class="btngroup">
                        <input type="hidden" id="order_request_store_id" name="store_id" value="">
                        <input type="hidden" name="csvp_request" value="add_order_request">
                        <button class="button button-primary">אישור</button>
                        <button class="button button-secondary">ביטול</button>
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
                        <button class="button button-secondary">ביטול</button>
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
                        <span> ₪ 2,500 </span>
                    </div>
                </div>
                <div class="d-flex store-management-modal-header align-items-center gap-3 header-data-wrapper">
                    <div class="address d-flex flex-column align-items-end gap-3 p-4">
                        <h1 id="name_of_store">ת”ת אור התורה </h1>
                        <div>
                            <h2 class="address-title"> משה מנהל חנות:<span id="store_manager_no">054-6268012</span> <span id="store_manager_address">
                                    רבי עקיבא 84 בני ברק</span> :כתובת</h2>
                            <h3 class="address-title"></h3>
                        </div>

                        <div class="d-flex sw-buttons" style="direction: rtl;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#community-manager-add-new-order" class="btn  btn-customs">בקשת הזמנה
                                חדשה +</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#community-manager-return-request" class="btn btn-custom">הוספת החזרה
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
            <div class="d-flex flex-column align-items-end cont">
                <h3 class="title">הסטוריית עסקאות</h3>
                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #01051D; ">שולם</button></div>
                    <div class="d-flex gap-3 titl">
                        <h3 class="titl">סה”כ: ₪ 6,500 </h3>
                        <h3 class="titl">כמות עסקאות: 15 </h3>
                        <h3 class="titl">חודש: 02/2023</h3>
                    </div>

                </div>
                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #BC9B63;">ממתין לתשלום</button>
                    </div>
                    <div class="d-flex gap-3">
                        <h3 class="titl">סה”כ: ₪ 1,000 </h3>
                        <h3 class="titl">כמות עסקאות: 12 </h3>
                        <h3 class="titl">חודש: 03/2023</h3>
                    </div>

                </div>


                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color:  rgba(1, 5, 29, 0.24);">לא
                            שולם</button></div>
                    <div class="d-flex gap-3">
                        <h3 class="titl">סה”כ: ₪ 500</h3>
                        <h3 class="titl">כמות עסקאות: 6 </h3>
                        <h3 class="titl">חודש: 04/2023</h3>
                    </div>

                </div>
            </div>
            <!-- 2st one -->
            <div class="d-flex flex-column align-items-end cont" id="parentOrderHistory">
                <h3 class="title">הסטוריית הזמנות </h3>
            </div>
            <!-- 3st one -->
            <div class="d-flex flex-column align-items-end cont" id="parentOrderReturn">
                <h3 class="buttons">הסטוריית החזרות </h3>
                <!-- <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #01051D;">זוכה </button></div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;"> לממתין לזיכו</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/03/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #F9F8C7;color: black;">ממתין לזיכוי
                        </button></div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;"> לפרטי החזרה</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #01051D;">זוכה</button></div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000; "> לפרטי החזרה</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div> -->
            </div>
            <!-- 4st one -->
            <div class="d-flex flex-column align-items-end cont" id="parentOrderPending">
                <h3 class="title">בקשות הזמנה ממתינות לאישור </h3>
                <!-- <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #F9F8C7; color:black;">ממתין לאישור </button>
                    </div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;"> לממתין לזיכו</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/03/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #F9F8C7; color: black;">ממתין לאישור</button>
                    </div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;"> לפרטי החזרה</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #F9F8C7; color:black;">ממתין לאישור</button>
                    </div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;"> לפרטי החזרה</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div> -->
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
                    </div>
                    <div class="col">
                        <input type="text" id="store-search" placeholder="חיפוש חנות ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="font-weight-medium ts-text"> חנויות שלא בהסדר</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="font-weight-medium ts-text">חנויות בהסדר</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-4 d-flex flex-wrap" style="row-gap: 2rem; column-gap: 5rem;">
    <?php if (isset($pageData["joined_store"])) {
        foreach ($pageData["joined_store"] as $store) {
            $order_count = 0;
            $total_order_amount = 0;
            if (isset($store['order_data']->order_count)) {
                $order_count = $store['order_data']->order_count;
            }
            if (isset($store['order_data']->total_order_amount)) {
                $total_order_amount = $store['order_data']->total_order_amount;
            } ?>
            <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal" data-bs-target="#store-details" data-id="<?php echo $store['store_id']; ?>">
                <!-- Photo -->
                <div class="card-body d-flex p-0">

                    <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                        <div class="store-management-information rounded-3">
                            <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                                <table>
                                    <tr class="d-flex flex-column gap-2 text-center">
                                        <td><strong>שם החנות: </strong><?php echo $store['store_data']->store_name; ?></td>
                                        <td><strong>כמות הזמנות: </strong><?php echo $order_count; ?></td>
                                        <td><strong>סך הזמנות: </strong> <?php echo $total_order_amount; ?> ₪</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                </div>
            </div>
    <?php }
    } ?>
    <?php if (isset($pageData["requested_stores"])) {
        foreach ($pageData["requested_stores"] as $store) {
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
                                        <td><strong>שם החנות: </strong><?php echo $store['store_data']->store_name; ?></td>
                                        <td><strong>כמות הזמנות: </strong><?php echo $order_count; ?></td>
                                        <td><strong>סך הזמנות: </strong> <?php echo $total_order_amount; ?> ₪</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <label class="text-secondary "><b>בקשה בהמתנה</b></label>
                    </div>
                    <div class="w-35" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                </div>
            </div>
    <?php }
    } ?>
    <?php if (isset($pageData["not_requested_stores"])) {
        foreach ($pageData["not_requested_stores"] as $store) {
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
                                        <td><strong>שם החנות: </strong><?php echo $store['store_data']->store_name; ?></td>
                                        <td><strong>כמות הזמנות: </strong><?php echo $order_count; ?></td>
                                        <td><strong>סך הזמנות: </strong> <?php echo $total_order_amount; ?> ₪</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <form method="POST" action="">
                            <input type="hidden" id="benifit_store_id" name="store_id" value="<?php echo $store['store_data']->id; ?>">
                            <input type="hidden" name="csvp_request" value="joining_request">
                            <button class="btn btn-dark">לצירוף הת”ת ←</button>
                        </form>
                    </div>
                    <div class="w-35 " style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
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
        console.log(item);
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
			success: function (response) {
                console.log(response);
				// Handle success response
				document.getElementById('credit_limit').innerHTML = response[0]["credit_limit"];
                document.getElementById('name_of_store').innerHTML = response[0]["store_name"];
                document.getElementById('store_manager_no').innerHTML = response[0]["store_cashier_phone"];
                document.getElementById('store_manager_address').innerHTML = response[0]["store_address"];
                document.getElementById('store_logo').src = "<?php echo esc_url(get_site_url() . '/wp-content/uploads/'); ?>" + response[0]["store_logo"];

			},
			error: function (xhr, status, error) {
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
			success: function (response) {
				// Handle success response
				if (response.length > 0) {
					var voucherElementId = document.getElementById("voucherElementId");
					voucherElementId.innerHTML = "";
					response.forEach(function (item) {
						addSection(item.id, item.product_image, item.product_name, item.normal_price, item.voucher_price);
					});
				} else {
					var voucherElementId = document.getElementById("voucherElementId");
					voucherElementId.innerHTML = "<label>No Vouchers Found</label>"; // Use innerHTML to append HTML content
				}

			},
			error: function (xhr, status, error) {
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
document.addEventListener('DOMContentLoaded', function () {
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

    modal1.addEventListener('hidden.bs.modal', function () {
        resetValues(modal1);
    });

    modal2.addEventListener('hidden.bs.modal', function () {
        resetValues(modal2);
    });

    calculateTotal(modal1Table);
    calculateTotal(modal2Table);
});

</script>