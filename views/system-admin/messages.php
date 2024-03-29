<?php include CSVP_PLUGIN_PATH . "views/system-admin/header.php" ?>


<style>
    .community-management-popup,
    .store-management-popup {
        display: none;
    }


    .ts-round {
        border-radius: 1.5rem;
    }

    .button-op-cl {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        direction: rtl;
        flex-direction: row-reverse;
    }

    .button-open {
        color: white;
        margin: 5px;
        border: none;
        background-color: #01051d;
        border-radius: 1.75rem;
        width: fit-content;
    }

    .content {
        margin-bottom: 12px;
        justify-content: center;
    }

    .button-close {
        border-radius: 50%;
        background-color: #9d0000;
        border: none;
        width: 30px;
        height: 30px;
    }

    /* .accordion-body {
        margin: 10px;
        padding: 10px;
      } */

    .ts-text {
        text-align: center;
        font-size: 20px;
        font-weight: 600;
    }

    .accordion-item {

        background-color: transparent;
        border: none;
        margin: 10px;
        border-radius: 1.75rem;
    }

    .accordion-header {
        padding: 5px;
        position: relative;
        border-radius: 1.75rem;
        background-color: #e4e4e4;
        z-index: 100;
    }

    .accordion-collapse {
        margin-top: -30px;
        background-color: #efefef;
        padding-top: 45px;
        border-radius: 0.57rem;
        direction: rtl;
    }

    .page-wrapper {
        background-color: white !important;
    }

    @media screen and (max-width: 990px) {

        .button-op-cl {
            flex-wrap: wrap;
        }

        .content {
            width: 32%;
            justify-content: center;
        }

        .button-close {
            width: 40px;
            height: 40px;

        }

        .button-open {
            width: 32%;
        }

    }


    @media screen and (max-width: 600px) {

        .content {
            text-align: center;
            width: 47%;
        }

        .button-open {
            width: 47%;
        }

        .button-op-cl {
            justify-content: center;
        }

    }




    #filter-guys-popup-svg,
    #filter-stores-popup-svg,
    #date-range-popup-svg,
    #csv-upload-popup-svg {
        cursor: pointer;
    }

    .filter-card {
        z-index: 2;
    }
</style>
<div class="container-xl">
    <div class="container col-12">
        <div class="row row-cards justify-content-sm-end gap-sm-3 gap-3 gap-lg-0 bg-black px-2 py-2 m-0 ts-round">

            <!-- Date Range Filter   -->
            <div class="col-sm-5 col-lg-3 m-0">
                <div class="card card-sm p-relative" style="position: relative;">
                    <div class="filter-popup" id="date-range-popup" style="z-index: -1; direction: rtl;">
                        <div class="mb-3">
                            <form action="" method="post">
                                <label class="form-label">Select Date</label>

                                <div class="input-icon mb-2">
                                    <input class="form-control " placeholder="Select a date" id="datepicker-icon"
                                        value="<?php echo isset ($_POST["message_filter_date"]) ? $_POST["message_filter_date"] : ""; ?>"
                                        name="message_filter_date" />
                                    <span
                                        class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="hidden" name="csvp_filter" value="filter_by_date">
                                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>
                            </form>
                        </div>
                    </div>


                    <div class="card-body-rounded p-1 m-1 filter-card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span id="date-range-popup-svg"
                                    class="bg-white text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                    <svg width="42" height="40" viewBox="0 0 42 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium ts-text">סינון תאריכים</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Guy Filter -->
            <div class="col-sm-5 col-lg-3 m-0">
                <div class="card card-sm p-relative" style="position: relative;">
                    <div class="filter-popup" id="filter-guys-popup" style="z-index: -1;">
                        <form action="" method="post">
                            <div class="" style="direction: rtl;">
                                <label class="form-label">חיפוש לפי שם</label>
                                <input type="text" class="form-control" placeholder="" name="full_name"
                                    value="<?php echo isset ($_POST["full_name"]) ? $_POST["full_name"] : ""; ?>">
                                <input type="hidden" name="csvp_filter" value="filter_by_name">
                                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body-rounded p-1 m-1 filter-card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-white text-white avatar"
                                    id="filter-guys-popup-svg"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                    <svg width="42" height="40" viewBox="0 0 42 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col" style="z-index:1">
                                <div class="font-weight-medium ts-text">סינון חנויות </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="community-message-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
      <div class="modal-content p-4" style="direction: rtl">
        <h3>האם עלי למחוק את ההודעה?</h3>

        <div class="add-new-benefit-buttons mt-4">
          <form method="POST" action="">
            <input type="hidden" name="message_id" id="message_id">
            <input type="hidden" name="csvp_request" value="delete_message">
            <input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
            <button type="button" onclick="closeModal('community-message-delete')" class="btn btn-danger w-25">ביטול</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  
    <div class="accordion" id="accordion-example">
        <div class="card-x">
            <?php
            foreach ($pageData['messages'] as $message) {
                $date = new DateTime($message['created_at']);
                $formattedDate = $date->format('d/m/Y');
                if ($message['message_status'] == MESSAGE_STATUS_UNSEEN) {
                    $seen_status = MESSAGE_STATUS_SEEN;
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-2">
                            <div class="container-xl button-op-cl p-0 m-0">
                                <div id="status-button-<?php echo $message['id']; ?>">
                                    <button class="button-open p-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#unseen-<?php echo $message['id']; ?>" aria-expanded="true"
                                        onclick="statusChange('<?php echo $message['id']; ?>', '<?php echo $seen_status; ?>' , 'status-button-<?php echo $message['id']; ?>', 'unseen-<?php echo $message['id']; ?>')">
                                        ← לחץ לפתיחה
                                    </button>
                                </div>
                                <div class="content">תאריך:
                                    <?php echo $formattedDate; ?>
                                </div>
                                <div class="content">טל:
                                    <?php echo $message['phone_no']; ?>
                                </div>
                                <div class="content">שם החנות:
                                    <?php echo $message['full_name']; ?>
                                </div>
                                <button class="button-close mb-3 mx-2" type="button" aria-expanded="true" data-bs-toggle="modal" data-bs-target="#community-message-delete" data-id="<?php echo $message['id']; ?>">
                                    <svg width="17" height="19" viewBox="0 0 17 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.28471 0.818181L8.28862 7.47656H8.43066L12.4523 0.818181H16.2077L10.6057 9.90909L16.2964 19H12.479L8.43066 12.386H8.28862L4.24032 19H0.440607L6.18457 9.90909L0.51163 0.818181H4.28471Z"
                                            fill="white" />
                                    </svg>
                                </button>
                            </div>
                        </h2>
                        <div id="unseen-<?php echo $message['id']; ?>" class="accordion-collapse collapse"
                            data-bs-parent="#accordion-example">
                            <div class="accordion-body pt-0">
                                <?php echo $message['content']; ?>
                            </div>
                        </div>
                    </div>
                <?php } else if ($message['message_status'] == MESSAGE_STATUS_SEEN) {
                    $archive_status = MESSAGE_STATUS_ARCHIVED;
                    ?>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1">
                                <div class="container-xl button-op-cl p-0 m-0">
                                    <div id="archive-status-button-<?php echo $message['id']; ?>">
                                        <button class="button-open p-2"
                                            style="background-color: #F9F8C7; color: black; font-size: 20px; font-weight: 600;"
                                            id="button-open" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-<?php echo $message['id']; ?>" aria-expanded="true"
                                            onclick="statusChange('<?php echo $message['id']; ?>', '<?php echo $archive_status; ?>' , 'archive-status-button-<?php echo $message['id']; ?>', 'collapse-<?php echo $message['id']; ?>')">
                                            סגור וסמן כנקרא
                                        </button>
                                    </div>
                                    <div class="content">
                                    <?php echo $formattedDate; ?><strong>:תאריך</strong>
                                    </div>
                                    <div class="content">טל:
                                    <?php echo $message['phone_no']; ?>
                                    </div>
                                    <div class="content">שם החנות:
                                    <?php echo $message['full_name']; ?>
                                    </div>
                                    <button class="button-close mb-3 mx-2" type="button" aria-expanded="true" data-bs-toggle="modal" data-bs-target="#community-message-delete" data-id="<?php echo $message['id']; ?>">
                                        <svg width="17" height="19" viewBox="0 0 17 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.28471 0.818181L8.28862 7.47656H8.43066L12.4523 0.818181H16.2077L10.6057 9.90909L16.2964 19H12.479L8.43066 12.386H8.28862L4.24032 19H0.440607L6.18457 9.90909L0.51163 0.818181H4.28471Z"
                                                fill="white" />
                                        </svg>
                                    </button>
                                </div>
                            </h2>
                            <div id="collapse-<?php echo $message['id']; ?>" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-example">
                                <div class="accordion-body pt-0">
                                <?php echo $message['content']; ?>
                                </div>
                            </div>
                        </div>

                <?php } else if ($message['message_status'] == MESSAGE_STATUS_ARCHIVED) {
                    ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-2">
                                    <div class="container-xl button-op-cl p-0 m-0">
                                        <button class="button-open p-2" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#readonly-<?php echo $message['id']; ?>" aria-expanded="true">
                                            ← לחץ לקריאה בלבד
                                        </button>
                                        <div class="content">תאריך:
                                    <?php echo $formattedDate; ?>
                                        </div>
                                        <div class="content">טל:
                                    <?php echo $message['phone_no']; ?>
                                        </div>
                                        <div class="content">שם החנות:
                                    <?php echo $message['full_name']; ?>
                                        </div>
                                        <button class="button-close mb-3 mx-2" type="button" aria-expanded="true" data-bs-toggle="modal" data-bs-target="#community-message-delete" data-id="<?php echo $message['id']; ?>">
                                            <svg width="17" height="19" viewBox="0 0 17 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.28471 0.818181L8.28862 7.47656H8.43066L12.4523 0.818181H16.2077L10.6057 9.90909L16.2964 19H12.479L8.43066 12.386H8.28862L4.24032 19H0.440607L6.18457 9.90909L0.51163 0.818181H4.28471Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                    </div>
                                </h2>
                                <div id="readonly-<?php echo $message['id']; ?>" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-example">
                                    <div class="accordion-body pt-0">
                                <?php echo $message['content']; ?>
                                    </div>
                                </div>
                            </div>
                <?php }
            }
            ?>


        </div>
    </div>

    <script>

function closeModal(modalId) {
    // Use jQuery to select the modal and call the Bootstrap modal method to hide it
    jQuery('#' + modalId).modal('hide');
}

jQuery('#community-message-delete').on('show.bs.modal', function(event) {
		var button = jQuery(event.relatedTarget);
		var id = button.data('id');
		jQuery('#message_id').val(id);
	});

    
        function statusChange(id, status, block, blockId) {
            jQuery.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: 'csvp_ajax', // Action hook
                    csvp_request: 'CSVP_CommunityMessage', // Action hook
                    csvp_handler: 'update_message_status', // Action hook
                    data: {
                        message_id: id,
                        new_status: status
                    }
                },

                success: function (response) {
                    // Handle success response
                    console.log(response);
                    var status_old = status;
                    var status_new_1 = '<?php echo MESSAGE_STATUS_SEEN; ?>';
                    var status_new_2 = '<?php echo MESSAGE_STATUS_ARCHIVED; ?>';
                    if (status_old == status_new_1) {
                        document.getElementById(block).innerHTML = '<button class="button-open p-2" style="background-color: #F9F8C7; color: black; font-size: 20px; font-weight: 600;" id="button-open" type="button" data-bs-toggle="collapse" data-bs-target="' + blockId + '" aria-expanded="true" onclick="statusChange(\'' + id + '\', \'' + status_new_2 + '\' , \'' + block + '\', \'' + blockId + '\')"> סגור וסמן כנקרא </button>';
                    } else if (status_old == status_new_2) {
                        document.getElementById(block).innerHTML = '<button class="button-open p-2" type="button" data-bs-toggle="collapse" data-bs-target="#' + blockId + '" aria-expanded="true" > ← לחץ לקריאה בלבד </button>';
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
</div>
</div>
</div>
</div>
</body>



<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('guys-select-tags'), {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function (data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function (data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });
    // @formatter:on
</script>


<script>
    // Wait for the document to be ready
    jQuery(document).ready(function () {
        // Attach click event to the SVG element
        jQuery("#filter-guys-popup-svg").click(function () {
            jQuery("#filter-guys-popup").css("z-index", function (index, value) {
                return value == 1000 ? -1 : 1000;
            });

            // Toggle slide-down or slide-up animation
        });
    });



    // Wait for the document to be ready
    jQuery(document).ready(function () {
        // Attach click event to the SVG element
        jQuery("#date-range-popup-svg").click(function () {
            jQuery("#date-range-popup").css("z-index", function (index, value) {
                return value == 1000 ? -1 : 1000;
            });

            // Toggle slide-down or slide-up animation
        });
    });



    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker-icon'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });
    // @formatter:on
</script>