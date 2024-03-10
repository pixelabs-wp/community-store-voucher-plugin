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
        color: #5A4222;
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


<div class="modal fade" id="community-manager-add-new-order" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content p-4">
            <div class="background-box">
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
                            <tr>
                                <th scope="row">7,500 ₪</th>
                                <th> ₪ 499</th>
                                <th>15</th>
                                <th>חליפות</th>
                            </tr>
                            <tr>
                                <th scope="row">0 ₪</th>
                                <th>84.9</th>
                                <th>0</th>
                                <th>חולצות</th>
                            </tr>
                            <tr>
                                <th scope="row">4,650 ₪ </th>
                                <th>99 ₪</th>
                                <th>47</th>
                                <th>חפתים</th>
                            </tr>
                            <tr>
                                <th scope="row">0 ₪</th>
                                <th>99 ₪</th>
                                <th>10</th>
                                <th>גרביים</th>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="flex">
                    <div class="mb-3">
                        <input class="custom-file-input" type="file" id="formFileMultiple" multiple>
                    </div>
                    <div class="mb-3">
                        <label class="labell">הוספת שורה</label>
                        <svg onclick="addRow()" width="42" height="42" viewBox="0 0 42 42" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="42" height="42" rx="10" fill="#01051D" />
                            <path
                                d="M18.605 25.8711H10.541V21.0591H18.605V12.9512H23.417V21.0591H31.459V25.8711H23.417V33.8691H18.605V25.8711Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="styled-element">
                    <span>סה”כ שווי עסקה: 12,150 ₪</span>
                    <span>סה”כ פריטים: 32 פריטים</span>
                </div>
                <div class="btngroup">
                    <button class="button button-primary">אישור</button>
                    <button class="button button-secondary">ביטול</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!--  Add new Order modal ends here -->





<!-- Return Request modal Starts here -->


<div class="modal fade" id="community-manager-return-request" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content p-4">
            <div class="background-box">
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
                        <tbody>
                            <tr>
                                <th scope="row">7,500 ₪</th>
                                <th> ₪ 499</th>
                                <th>15</th>
                                <th>חליפות</th>
                            </tr>
                            <tr>
                                <th scope="row">0 ₪</th>
                                <th>84.9</th>
                                <th>0</th>
                                <th>חולצות</th>
                            </tr>
                            <tr>
                                <th scope="row">4,650 ₪ </th>
                                <th>99 ₪</th>
                                <th>47</th>
                                <th>חפתים</th>
                            </tr>
                            <tr>
                                <th scope="row">0 ₪</th>
                                <th>99 ₪</th>
                                <th>10</th>
                                <th>גרביים</th>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="flex">
                    <div class="mb-3">
                        <input class="custom-file-input" type="file" id="formFileMultiple" multiple>
                    </div>
                    <div class="mb-3">
                        <label class="labell">הוספת שורה</label>
                        <svg onclick="addRow()" width="42" height="42" viewBox="0 0 42 42" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="42" height="42" rx="10" fill="#01051D" />
                            <path
                                d="M18.605 25.8711H10.541V21.0591H18.605V12.9512H23.417V21.0591H31.459V25.8711H23.417V33.8691H18.605V25.8711Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="styled-element">
                    <span>סה”כ שווי החזרה: ₪12,150</span>
                    <span>סה”כ פריטים: 32 פריטים</span>
                </div>
                <div class="btngroup">
                    <button class="button button-primary">אישור</button>
                    <button class="button button-secondary">ביטול</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Return Request modal Starts here -->




<!-- Store details modal Starts here -->


<div class="modal fade" id="store-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style=" overflow: auto; ">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
            </button>


            <div class="main">
                <div class="credit-container">
                    <div class="balance">
                        <h4>Credit Limit</h4>
                        <span>NIS 10,000</span>
                        <h4>Credit Balance</h4>
                        <span>NIS 2,500</span>
                    </div>
                </div>

                <div class="d-flex store-management-modal-header align-items-center gap-3 header-data-wrapper">
                    <div class="address d-flex flex-column align-items-end gap-3 p-4">
                        <svg width="75" height="26" viewBox="0 0 75 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.9551 25H0.56543V0.0146484H14.9551V4.35547H5.86328V9.84131H14.3228V14.1821H5.86328V20.625H14.9551V25ZM23.688 15.2417L17.5356 5.89355H23.4487L27.1572 11.9775L30.8999 5.89355H36.813L30.5923 15.2417L37.1035 25H31.1733L27.1572 18.4546L23.124 25H17.2109L23.688 15.2417ZM43.8198 15.4126C43.8198 17.3039 44.1274 18.7337 44.7427 19.7021C45.3693 20.6706 46.3833 21.1548 47.7847 21.1548C49.1746 21.1548 50.1715 20.6763 50.7754 19.7192C51.3906 18.7508 51.6982 17.3153 51.6982 15.4126C51.6982 13.5213 51.3906 12.1029 50.7754 11.1572C50.1602 10.2116 49.1519 9.73877 47.7505 9.73877C46.3605 9.73877 45.3579 10.2116 44.7427 11.1572C44.1274 12.0915 43.8198 13.5099 43.8198 15.4126ZM57.0303 15.4126C57.0303 18.5229 56.21 20.9554 54.5693 22.71C52.9287 24.4645 50.6444 25.3418 47.7163 25.3418C45.882 25.3418 44.2642 24.943 42.8628 24.1455C41.4614 23.3366 40.3848 22.1802 39.6328 20.6763C38.8809 19.1724 38.5049 17.4178 38.5049 15.4126C38.5049 12.2909 39.3195 9.8641 40.9487 8.13232C42.578 6.40055 44.868 5.53467 47.8188 5.53467C49.6532 5.53467 51.271 5.93343 52.6724 6.73096C54.0737 7.52848 55.1504 8.6735 55.9023 10.166C56.6543 11.6585 57.0303 13.4074 57.0303 15.4126ZM74.667 19.3262C74.667 21.2858 73.9834 22.7783 72.6162 23.8037C71.2604 24.8291 69.2267 25.3418 66.5151 25.3418C65.1252 25.3418 63.9403 25.245 62.9604 25.0513C61.9806 24.869 61.0635 24.5955 60.209 24.231V19.9243C61.1774 20.38 62.2655 20.7617 63.4731 21.0693C64.6922 21.377 65.7632 21.5308 66.686 21.5308C68.5773 21.5308 69.5229 20.9839 69.5229 19.8901C69.5229 19.48 69.3976 19.1496 69.147 18.8989C68.8963 18.6369 68.4634 18.3464 67.8481 18.0273C67.2329 17.6969 66.4126 17.3153 65.3872 16.8823C63.9175 16.2671 62.8351 15.6974 62.1401 15.1733C61.4565 14.6493 60.9552 14.0511 60.6362 13.3789C60.3286 12.6953 60.1748 11.8579 60.1748 10.8667C60.1748 9.16911 60.8299 7.85889 62.1401 6.93604C63.4618 6.00179 65.3302 5.53467 67.7456 5.53467C70.047 5.53467 72.2858 6.03597 74.4619 7.03857L72.8896 10.7983C71.9326 10.3882 71.0382 10.0521 70.2065 9.79004C69.3748 9.52799 68.526 9.39697 67.6602 9.39697C66.1221 9.39697 65.353 9.81283 65.353 10.6445C65.353 11.1117 65.598 11.5161 66.0879 11.8579C66.5892 12.1997 67.6772 12.7067 69.3521 13.3789C70.8446 13.9827 71.9383 14.5467 72.6333 15.0708C73.3283 15.5949 73.841 16.1987 74.1714 16.8823C74.5018 17.5659 74.667 18.3805 74.667 19.3262Z"
                                fill="white" />
                        </svg>
                        <div>
                            <h2 class="address-title">Address: Rabbi Akiva 84 Bnei Brak Moshe store manager: 054-6268012
                            </h2>
                            <h3 class="address-title"></h3>
                        </div>

                        <div class="d-flex sw-buttons" style="direction: rtl;">
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#community-manager-add-new-order" class="btn  btn-customs">בקשת הזמנה
                                חדשה +</button>
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#community-manager-return-request" class="btn btn-custom">הוספת החזרה
                                חדשה +</button>
                        </div>


                    </div>

                    <div class="svggroup">
                        <div class="svvg">


                        </div>
                        <svg width="207" height="194" viewBox="0 0 207 194" fill="none"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="207" height="194" rx="10" fill="url(#pattern0)" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_13_1711"
                                        transform="matrix(0.00289017 0 0 0.00308384 0 0.274879)" />
                                </pattern>
                                <image id="image0_13_1711" width="346" height="146"
                                    xlink:href="data:image/jpeg;base64,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" />
                            </defs>
                        </svg>

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
            <div class="d-flex flex-column align-items-end cont">
                <h3 class="title">הסטוריית הזמנות </h3>
                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons">שולם</button></div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000; ">לפרטי ההזמנה</button></div>
                        <h3 class="titl">תאריך הזמנה: 27/03/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: #BC9B63;">ממתין לתשלום</button>
                    </div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;">לפרטי ההזמנה</button></div>
                        <h3 class="titl">תאריך הזמנה: 28/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>

                <div class="d-flex justify-content-between tran">
                    <div><button class="buttons" style="background-color: rgba(1, 5, 29, 0.24);">ממתין
                            לתשלום</button></div>
                    <div class="d-flex gap-3">
                        <div><button class="buttonss" style="background-color: #9D0000;">לפרטי ההזמנה</button></div>
                        <h3 class="titl">תאריך הזמנה: 28/04/2023</h3>
                        <h3 class="titl">סכום: 5,400 ₪ </h3>
                        <h3 class="titl">הזמנה: 51426</h3>
                    </div>

                </div>
            </div>
            <!-- 3st one -->
            <div class="d-flex flex-column align-items-end cont">
                <h3 class="buttons">הסטוריית החזרות </h3>
                <div class="d-flex justify-content-between tran">
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

                </div>
            </div>
            <!-- 4st one -->
            <div class="d-flex flex-column align-items-end cont">
                <h3 class="title">בקשות הזמנה ממתינות לאישור </h3>
                <div class="d-flex justify-content-between tran">
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

                </div>
            </div>
            <div>
                <div class="d-flex flex-column align-items-end cont">
                    <h3 class="title">פרטי הסדרים והטבות לת”ת</h3>
                    <div class="d-flex gap-4 flex-wrap" style="direction: rtl;
">
                        <div class="d-flex  gap-3">
                            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                                <div class="cards">
                                    <p class="card-text"><img
                                            style="display: block; margin: auto;cursor: zoom-out;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"
                                            src="https://s3-alpha-sig.figma.com/img/978c/a64a/1b605dcecb4368dfeff5a1868325b2e0?Expires=1710115200&amp;Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&amp;Signature=aFa9NVpfdpOtE-ayJt4hp6C5j9JSFYnBhoQbWsRcyKMCZyDxu14igxyfmRoDD7BXZi8zgj9B~u1TjnovA1o1XHjUnLGFR4lB-LONR4gl4WYdBPf~BYffbywtUOSH~am7KgYywHU1gjLW7GYGmF7rgPYUAcfpSCXntF6NL1HO4izoGD2rZ9MGG8ow9I4XFi~kw6oLuXPAu5O6J1QEPpW5ZSWu0MgIPwvCJ3oM4nqZ265wdKgwftOVMimZrKKfnF2V9a0OnOnq-cu-84DbdNUgPNwVW2AeGZ8SUdTQRK~gRMaMnHzUf4x~dOlRMjEWM3xoahRxxL5C2xhrgvCy3DYIQQ__"
                                            width="286px" height="220px"></p>
                                </div>
                                <div class="card-footer text-center bg-transparent ">
                                    חליפה 70% צמר
                                    <div class="text-center bg-transparent "> 680₪ במקום 990₪</div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                                <div class="cards">
                                    <p class="card-text"><img
                                            style="display: block; margin: auto;cursor: zoom-out;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"
                                            src="https://s3-alpha-sig.figma.com/img/978c/a64a/1b605dcecb4368dfeff5a1868325b2e0?Expires=1710115200&amp;Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&amp;Signature=aFa9NVpfdpOtE-ayJt4hp6C5j9JSFYnBhoQbWsRcyKMCZyDxu14igxyfmRoDD7BXZi8zgj9B~u1TjnovA1o1XHjUnLGFR4lB-LONR4gl4WYdBPf~BYffbywtUOSH~am7KgYywHU1gjLW7GYGmF7rgPYUAcfpSCXntF6NL1HO4izoGD2rZ9MGG8ow9I4XFi~kw6oLuXPAu5O6J1QEPpW5ZSWu0MgIPwvCJ3oM4nqZ265wdKgwftOVMimZrKKfnF2V9a0OnOnq-cu-84DbdNUgPNwVW2AeGZ8SUdTQRK~gRMaMnHzUf4x~dOlRMjEWM3xoahRxxL5C2xhrgvCy3DYIQQ__"
                                            width="286px" height="220px"></p>
                                </div>
                                <div class="card-footer text-center bg-transparent ">
                                    חליפה 70% צמר
                                    <div class="text-center bg-transparent "> 680₪ במקום 990₪</div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                                <div class="cards">
                                    <p class="card-text"><img
                                            style="display: block; margin: auto;cursor: zoom-out;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"
                                            src="https://s3-alpha-sig.figma.com/img/978c/a64a/1b605dcecb4368dfeff5a1868325b2e0?Expires=1710115200&amp;Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&amp;Signature=aFa9NVpfdpOtE-ayJt4hp6C5j9JSFYnBhoQbWsRcyKMCZyDxu14igxyfmRoDD7BXZi8zgj9B~u1TjnovA1o1XHjUnLGFR4lB-LONR4gl4WYdBPf~BYffbywtUOSH~am7KgYywHU1gjLW7GYGmF7rgPYUAcfpSCXntF6NL1HO4izoGD2rZ9MGG8ow9I4XFi~kw6oLuXPAu5O6J1QEPpW5ZSWu0MgIPwvCJ3oM4nqZ265wdKgwftOVMimZrKKfnF2V9a0OnOnq-cu-84DbdNUgPNwVW2AeGZ8SUdTQRK~gRMaMnHzUf4x~dOlRMjEWM3xoahRxxL5C2xhrgvCy3DYIQQ__"
                                            width="286px" height="220px"></p>
                                </div>
                                <div class="card-footer text-center bg-transparent ">
                                    חליפה 70% צמר
                                    <div class="text-center bg-transparent "> 680₪ במקום 990₪</div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                                <div class="cards">
                                    <p class="card-text"><img
                                            style="display: block; margin: auto;cursor: zoom-out;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"
                                            src="https://s3-alpha-sig.figma.com/img/978c/a64a/1b605dcecb4368dfeff5a1868325b2e0?Expires=1710115200&amp;Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&amp;Signature=aFa9NVpfdpOtE-ayJt4hp6C5j9JSFYnBhoQbWsRcyKMCZyDxu14igxyfmRoDD7BXZi8zgj9B~u1TjnovA1o1XHjUnLGFR4lB-LONR4gl4WYdBPf~BYffbywtUOSH~am7KgYywHU1gjLW7GYGmF7rgPYUAcfpSCXntF6NL1HO4izoGD2rZ9MGG8ow9I4XFi~kw6oLuXPAu5O6J1QEPpW5ZSWu0MgIPwvCJ3oM4nqZ265wdKgwftOVMimZrKKfnF2V9a0OnOnq-cu-84DbdNUgPNwVW2AeGZ8SUdTQRK~gRMaMnHzUf4x~dOlRMjEWM3xoahRxxL5C2xhrgvCy3DYIQQ__"
                                            width="286px" height="220px"></p>
                                </div>
                                <div class="card-footer text-center bg-transparent ">
                                    חליפה 70% צמר
                                    <div class="text-center bg-transparent "> 680₪ במקום 990₪</div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="card border-white rounded-1 mb-3" style="max-width: 18rem;">
                                <div class="cards">
                                    <p class="card-text"><img
                                            style="display: block; margin: auto;cursor: zoom-out;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;"
                                            src="https://s3-alpha-sig.figma.com/img/978c/a64a/1b605dcecb4368dfeff5a1868325b2e0?Expires=1710115200&amp;Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&amp;Signature=aFa9NVpfdpOtE-ayJt4hp6C5j9JSFYnBhoQbWsRcyKMCZyDxu14igxyfmRoDD7BXZi8zgj9B~u1TjnovA1o1XHjUnLGFR4lB-LONR4gl4WYdBPf~BYffbywtUOSH~am7KgYywHU1gjLW7GYGmF7rgPYUAcfpSCXntF6NL1HO4izoGD2rZ9MGG8ow9I4XFi~kw6oLuXPAu5O6J1QEPpW5ZSWu0MgIPwvCJ3oM4nqZ265wdKgwftOVMimZrKKfnF2V9a0OnOnq-cu-84DbdNUgPNwVW2AeGZ8SUdTQRK~gRMaMnHzUf4x~dOlRMjEWM3xoahRxxL5C2xhrgvCy3DYIQQ__"
                                            width="286px" height="220px"></p>
                                </div>
                                <div class="card-footer text-center bg-transparent ">
                                    חליפה 70% צמר
                                    <div class="text-center bg-transparent "> 680₪ במקום 990₪</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Store details modal ends here -->




<div
    class="container m-auto row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">
    <div class="col-sm-5 col-lg-4 m-0">
        <div class="card card-sm">
            <div class="card-body-rounded p-1 m-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M41.7966 39.2038L31.392 28.7992C33.733 25.8775 35.0059 22.2439 35 18.5C35 9.38742 27.613 2 18.5 2C9.38742 2 2 9.38742 2 18.5C2 27.6126 9.38742 35 18.5 35C22.3958 35 25.9763 33.6498 28.7992 31.3915L39.2038 41.7962C39.3739 41.9667 39.5759 42.1019 39.7983 42.1941C40.0208 42.2863 40.2592 42.3336 40.5 42.3333C40.8626 42.3334 41.217 42.2258 41.5185 42.0244C41.82 41.823 42.055 41.5367 42.1938 41.2017C42.3326 40.8668 42.3689 40.4982 42.2982 40.1426C42.2275 39.7869 42.053 39.4603 41.7966 39.2038ZM18.5 31.3333C11.4123 31.3333 5.66667 25.5877 5.66667 18.5C5.66667 11.4123 11.4123 5.66667 18.5 5.66667C25.5881 5.66667 31.3333 11.4123 31.3333 18.5C31.3333 25.5877 25.5881 31.3333 18.5 31.3333Z"
                                    fill="#01051D" />
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

    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35"
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>

    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35"
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>


    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35 "
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>


    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35 "
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>

    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35 "
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>

    <div class="store-management-card card col-xl-4 rounded-3 p-0" data-bs-toggle="modal"
        data-bs-target="#store-details">
        <!-- Photo -->
        <div class="card-body d-flex p-0">

            <div class="d-flex flex-column px-5 py-4" style="width: 65%;">
                <div class="store-management-information rounded-3">
                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                        <table>

                            <tr class="d-flex flex-column gap-2 text-center">

                                <td><strong>שם החנות: </strong>בגיר</td>
                                <td><strong>כמות הזמנות: </strong>15</td>
                                <td><strong>סך הזמנות: </strong> 45,454 ₪</td>

                            </tr>

                        </table>
                    </div>

                </div>
                <a href="" class="btn btn-dark">← להסדרים וחובות</a>
            </div>

            <div class="w-35 "
                style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; width: 35%; background-image: url(media/inviting-logo.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>

        </div>

    </div>
</div>

</div>
</div>
</div>
</body>


<script>
    function addRow() {
        var table = document.querySelector('.table tbody');
        var newRow = table.insertRow();
        newRow.innerHTML = `
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="total-input" placeholder="סך הכל"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="cost-input" placeholder="עלות לפריט"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="amount-input" placeholder="כמות"></th>
      <th><input style="border: none; background-color: #f0f0f0; text-align: center; font-weight:bold;" type="text" class="name-input" placeholder="שם המוצר"></th>`;
    }

</script>