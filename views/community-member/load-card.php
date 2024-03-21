<?php include CSVP_PLUGIN_PATH . "views/community-member/header.php" ?>
<div class="container containers py-5">
    <style>
        .containers {
            /* width: 1109px; */
            height: fit-content;
            border-radius: 10px;
            background-color: #01051D;
        }

        .header-textss {
            width: 50%;
        }

        .main-title {
            color: white;
            font-size: 25px;
            font-weight: 300;
            line-height: 34px;
            letter-spacing: 0em;
            text-align: center;

        }

        .box {
            width: 470px;
            height: 188px;
            margin-top: 20px;
            border-radius: 10px;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box-detailss {
            margin-top: 30px;
            display: flex;
            position: relative;
            justify-content: space-between;
            width: 62%;
        }

        .left-span {
            font-size: 28px;
        }

        .right-span {
            margin-right: 58px;
            font-size: 28px;

        }

        .line {
            position: absolute;
            margin-top: 41px;
            border-bottom: 1.5px solid black;
            width: 100%;
        }

        .box-sub {

            padding: 40px;
            /* top: 104px; */
            /* left: 37px; */
            border-radius: 10px;
            background-color: #01051D;
            margin-left: 51px;
            margin-top: 20px;
        }

        .box-sub h1 {
            color: white;
            font-size: 19px;
            margin-left: 62px;
            /* text-align: center; */
            display: inline-flex;
            margin-top: 17px;
            font-weight: 600;
        }

        .box-date {
            width: 100%;
            margin-top: 7px;
            padding: 11px 8px 11px 116px;
            border-radius: 10px;
            background-color: #ffffff;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .date-details {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 12px;
            width: 100%;
            justify-content: space-between;
        }

        .box-date h3 {
            font-size: 20px;
            margin: 0;
            font-weight: 600;
        }

        .box-dates {
            width: 20%;
            margin-top: 27px;
            font-size: 20px;
            font-weight: 700;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: right;
            background-color: white;
            padding: 11px 8px 11px 116px;
            border-radius: 10px;

        }


        .date-detailss {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 12px;
            width: 100%;
            justify-content: space-between;
            margin-left: 34px;
        }


        .box-dates h3 {
            font-size: 16px;
            margin: 0;
        }

        input::placeholder {
            font-size: 18px;
            font-weight: 700;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: right;
        }



        input:focus {
            border: none;
        }


        input:active {
            border: none;
        }



        @media screen and (min-width: 979px) {

            .box-sub {
                width: 362px;
                height: 64px;
                /* top: 104px; */
                /* left: 37px; */
                border-radius: 10px;
                background-color: #01051D;
                margin-left: 51px;
                margin-top: 20px;
            }

            .box-sub h1 {
                color: white;
                font-size: 18px;
                margin-left: 62px;
                text-align: center;
                display: inline-flex;
                margin-top: 17px;
            }

            .date-details {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 12px;
                /* width: 100%; */
                justify-content: space-between;
            }

            .box-date h3 {
                font-size: 12px;
                margin: 0;
            }
        }



        @media screen and (min-width: 500px) {
            .box-sub {
                width: 362px;
                height: 34px;

                margin-top: 20px;
            }

            .box-sub h1 {
                color: white;
                margin-top: 8px;
                font-size: 18px;
            }

            .date-details {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 12px;
                /* width: 100%; */
                justify-content: space-between;
            }

            .box-date h3 {
                font-size: 12px;
                margin: 0;
            }
        }

        @media screen and (max-width: 480px) {
            .header-textss {
                width: 75%;
            }


            .box-date {
                width: 100%;
                margin-top: 27px;
                padding: 11px 8px 11px 11px;
                border-radius: 10px;
                background-color: #ffffff;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .box-sub {
                width: 362px;
                height: 34px;
                margin-top: 20px;
            }

            .box-sub h1 {
                color: white;
                margin-top: 8px;
                font-size: 15px;
            }

            .date-details {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 12px;
                /* width: 100%; */
                justify-content: space-between;
            }

            .box-date h3 {
                font-size: 10px;
                margin: 0;
            }
        }

        @media screen and (min-width: 360px) {


            .main-title {
                font-size: 25px;
            }

            .date-details {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 12px;
                /* width: 100%; */
                justify-content: space-between;
            }

            .box-date h3 {
                font-size: 12px;
                margin: 0;
            }

            .left-span {
                font-size: 25px;
            }

            .right-span {
                margin-right: 58px;
                font-size: 22px;

            }


        }

        .date-details h3 {
            font-size: 20px;
            font-weight: 600;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: right;
        }


        .btn-history {
            font-size: 20px;
            font-weight: 700;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: right;
        }
    </style>
    <!-- title -->
    <div class="d-flex flex-column justify-content-around align-items-center m-auto header-textss">
        <h2 class="main-title mt-4 text-xl">
            שלום <?php echo $pageData["member"]->full_name; ?>, בעמוד זה תוכל להטעין את כרטיס
            <span style="color: #BC9B63; font-weight: 900;">הת”תכארד </span>האישי שלך,הכל סכום שתבחר ולממש אותו
            במגוון החנויות בהסדר.
        </h2>

        <div class="box mt-6">
            <div class="box-detailss">
                <span class="left-span">₪</span>
                <input type="text" style="direction: rtl; border: none; width: 80%;" id="loadAmount" placeholder="הזן את הסכום הרצוי">
                <div class="line"></div>
            </div>


            <button onclick="loadCardModal()" style="font-family: Noto Sans Hebrew;
                                    font-size: 20px;
                                    font-weight: 500;
                                    line-height: 27px;
                                    letter-spacing: 0em;
                                    text-align: right;
                                    " class="btn btn-dark mt-4 p-4">
                ← לטעינת הסכום ומעבר לתשלום

            </button>
        </div>

    </div>
    <div class=" mt-4">
        <?php foreach ($pageData["transactions"] as $transaction) {


        ?>
            <div class="box-date">
                <div class="d-flex date-details">
                    <h3><?php echo date('d/m/Y', strtotime($transaction->created_at)); ?> <span class="bold-text">:תאריך </span></h3>
                    <h3>₪ <?php echo $transaction->balance_amount; ?> <span class="bold-text">:סכום</span></h3>
                    <h3>ערך צבור <span class="bold-text">: סוג העסקה</span></h3>
                </div>
            </div>
        <?php
        } ?>



    </div>


    <!-- <div class="box-dates">
            <div class="d-flex date-detailss">
                <h3>להסטוריית הטעינות לחץ כאן ←</h3>
            </div>
        </div> -->

    <a href="/member/loading-history" class="btn bg-white mt-4 btn-history"> ← להסטוריית הטעינות לחץ כאן
    </a>

</div>

</div>
</div>

<script>
    function loadCardModal() {
        // Open the modal
        jQuery('#community-member-load-card').modal('show');

        let amount = document.querySelector('#loadAmount').value ? document.querySelector('#loadAmount').value : 0;

        let mosadId = '<?php echo $pageData["community"]->payment_link ?>';
        let apiValid = '<?php echo $pageData["community"]->api_valid ?>';
        let fullName = '<?php echo $pageData["member"]->full_name ?>';
        let phone = '<?php echo $pageData["member"]->phone_number ?>';
        let email = '<?php echo $pageData["member"]->email_address ?>';


        PostNedarim({
            "Mosad": mosadId,
            "ApiValid": apiValid,
            "FirstName": fullName,
            "Phone": phone,
            "email_address": email,
            "Amount": amount,
            "Tashlumim": 1
            // Add other transaction details here
        });

        if (window.addEventListener) {
            window.addEventListener("message", ReadPostMessage, false);
        } else {
            window.attachEvent("onmessage", ReadPostMessage);
        }
        document.getElementById('NedarimFrame').onload = function() {
            console.log('StartNedarim');
            PostNedarim({
                'Name': 'GetHeight'
            })
        }
        document.getElementById('NedarimFrame').src = "https://matara.pro/nedarimplus/iframe";
    }

    function PayBtClick() {
        document.getElementById('Result').innerHTML = ''
        document.getElementById('PayBtDiv').style.display = 'none';
        document.getElementById('OkDiv').style.display = 'none';
        document.getElementById('WaitPay').style.display = 'block';
        document.getElementById('ErrorDiv').innerHTML = '';

        let amount = document.querySelector('#loadAmount').value ? document.querySelector('#loadAmount').value : 0;

        let mosadId = '<?php echo $pageData["community"]->payment_link ?>';
        let apiValid = '<?php echo $pageData["community"]->api_valid ?>';
        let Groupe = '<?php echo $pageData["community"]->community_name ?>';
        let fullName = '<?php echo $pageData["member"]->full_name ?>';
        let phone = '<?php echo $pageData["member"]->phone_number ?>';
        let email = '<?php echo $pageData["member"]->email_address ?>';
        let id_number = '<?php echo $pageData["member"]->id_number ?>';


        PostNedarim({
            'Name': 'FinishTransaction2',
            'Value': {
                'Mosad': mosadId,
                'ApiValid': apiValid,
                'PaymentType': 'Ragil',
                'Currency': '1',

                'Zeout': id_number,
                'FirstName': fullName,
                'LastName': '',
                'Street': '',
                'City': '',
                'Phone': phone,
                'Mail': email,

                'Amount': amount,
                'Tashlumim': '1',

                'Groupe': Groupe,
                'Comment': '',

                'Param1': '',
                'Param2': '',
                'ForceUpdateMatching': '1', //מיועד לקמפיין אם מעוניינים שהמידע יידחף ליעד, למרות שזה לא נהוג באייפרם

                'CallBack': '<?php echo get_site_url() . "/member/callback" ?>', //מיועד לקבלת WEBHOOK לאחר כל עסקה / סירוב
                'CallBackMailError': '', //מיועד לקבלת התראה על תקלת בשליחת קאלבק למייל של המפתח במקום למייל של אנשי הקשר של המוסד

                'Tokef': '' //אם אתם מנהלים את התוקף בדף שלכם (מיועד למי שרוצה להפריד בין חודש לשנה ורוצה לעצב מותאם אישית)

            }
        });
    }

    function ReadPostMessage(event) {
        console.log(event.data);
        switch (event.data.Name) {
            case 'Height':
                //Here you get the height of iframe | event.data.Value
                document.getElementById('NedarimFrame').style.height = (parseInt(event.data.Value) + 15) + "px";
                document.getElementById('WaitNedarimFrame').style.display = 'none';
                break;

            case 'TransactionResponse':
                document.getElementById('Result').innerHTML = '<b>TransactionResponse:<br/>' + JSON.stringify(event.data.Value) + '</b><br/>see full data in console';
                console.log(event.data.Value)
                if (event.data.Value.Status == 'Error') {
                    document.getElementById('ErrorDiv').innerHTML = event.data.Value.Message
                    document.getElementById('WaitPay').style.display = 'none';
                    document.getElementById('PayBtDiv').style.display = 'block';

                    let amount = document.querySelector('#loadAmount').value ? document.querySelector('#loadAmount').value : 0;

                    jQuery.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        type: 'POST',
                        data: {
                            action: 'csvp_ajax', // Action hook
                            csvp_request: 'CSVP_CommunityMember', // Action hook
                            csvp_handler: 'add_balance', // Action hook
                            data: {
                                member_id: <?php echo $pageData["member"]->id ?>,
                                new_balance: amount
                            }
                        },
                        success: function(response) {
                            // Handle success response
                            if (response) {

                                console.log(response);

                            };
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                            console.error("Unexpected response format:", xhr.responseText);
                        }
                    });
                } else {
                    document.getElementById('WaitPay').style.display = 'none';
                    document.getElementById('OkDiv').style.display = 'block';



                }
        }
    }

    // window.onerror = function(msg, url, line, col, error) {
    //     alert("שגיאת תוכנה. פנה לתמיכה טכנית", "שגיאה: " + msg, 30000, true)
    // }
    // window.onload = function() {
    //     setTimeout(function() {
    //         document.getElementById('NedarimFrame').src = "https://matara.pro/nedarimplus/iframe?language=en";
    //     }, 500)
    // }
    // if (window.addEventListener) {
    //     window.addEventListener("message", ReadPostMessage, false);
    // } else {
    //     window.attachEvent("onmessage", ReadPostMessage);
    // }




    // function ReadPostMessage(event) {
    //     switch (event.data.Name) {
    //         case 'Height':
    //             //Here you get the height of iframe | event.data.Value
    //             document.getElementById('NedarimFrame').style.height = (parseInt(event.data.Value) + 15) + "px";
    //             document.getElementById('WaitNedarimFrame').style.display = 'none';
    //             break;
    //         case 'ValidateFields':
    //             // if field are validates, event.data.Value == 'OK'
    //             // else event.data.ErrorType show (Empty or Wrong) and event.data.Field tell you the id of element
    //             if (event.data.Value == 'OK') {
    //                 // CREATE TRANSACTION WITH DEBITIFRAME AND CONTINUE

    //                 iframeWin.postMessage({
    //                     'Name': 'FinishTransaction',
    //                     'Value': 156
    //                 }, "*");
    //             } else {
    //                 document.getElementById('ErrorDiv').innerHTML = event.data.Field + ' is ' + event.data.ErrorType
    //                 document.getElementById('WaitPay').style.display = 'none';
    //                 document.getElementById('PayBtDiv').style.display = 'block';
    //             }
    //             break;
    //         case 'TransactionResponse':
    //             document.getElementById('Result').innerHTML = '<b>TransactionResponse:<br/>' + JSON.stringify(event.data.Value) + '</b><br/>see full data in console';
    //             console.log(event.data.Value)
    //             if (event.data.Value.Status == 'Error') {
    //                 document.getElementById('ErrorDiv').innerHTML = event.data.Value.Message
    //                 document.getElementById('WaitPay').style.display = 'none';
    //                 document.getElementById('PayBtDiv').style.display = 'block';
    //             } else {
    //                 document.getElementById('WaitPay').style.display = 'none';
    //                 alert('Transaction Done')
    //             }
    //     }
    // }

    // function PayBtClick() {
    //     document.getElementById('Result').innerHTML = ''
    //     document.getElementById('PayBtDiv').style.display = 'none';
    //     document.getElementById('WaitPay').style.display = 'block';
    //     document.getElementById('ErrorDiv').innerHTML = '';

    //     iframeWin.postMessage({
    //         'Name': 'ValidateFields'
    //     }, "*");
    // }
</script>
</body>

</html>