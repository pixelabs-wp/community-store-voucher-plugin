<?php include CSVP_PLUGIN_PATH . "views/system-admin/header.php" ?>

<style>
    .store-management-popup {
        display: none;
    }

    .ts-text {
        text-align: right;
        font-size: 20px;
        font-weight: 600;
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

    .store-management-card {
        width: 32%;
    }

    .store-management-information table td {
        font-size: 20px;
        font-weight: 400;
        margin-bottom: 10px;
    }

    .store-management-card .btn {
        font-size: 20px;
        font-weight: 400;

    }


    .no-debt .debt-button {
        display: none;
    }

    @media screen and (max-width: 1250px) {
        .store-management-card {
            width: 48%;
        }
    }


    @media screen and (max-width: 767px) {
        .store-management-card {
            width: 100%;
        }
    }



    #edit-community .form-label,
    #add-a-store .form-label {
        font-size: 25px;
        font-weight: 600;
        line-height: 34px;
        text-align: right;
    }

    #edit-community .form-control,
    #add-a-store .form-control {
        width: 100%;
        height: 89px;
        border-radius: 20px;
        text-align: right;
        background-color: #E4E4E4;

        font-size: 20px;
        font-weight: 900;
        line-height: 27px;
        letter-spacing: 0em;
        text-align: right;
    }

    #edit-community .wrapped-input,
    #add-a-store .wrapped-input {
        width: 100%;
        border-radius: 20px;
        text-align: right;
        background-color: #E4E4E4;
    }

    #edit-community kbd,
    #add-a-store kbd {
        font-family: "Noto Sans Hebrew", sans-serif;
        padding: 1rem 1rem;
        width: 400px;
        height: 54px;
        padding: 10px;
        border-radius: 20px;
        font-size: 25px;
        font-weight: 600;
        line-height: 34px;
        text-align: right;
    }

    #edit-community .btn,
    #add-a-store .btn {
        height: 89px;
        top: 643px;
        left: 66px;
        padding: 27px, 357px, 28px, 218px;
        border-radius: 20px;
        font-size: 25px;
        font-weight: 900;
        text-align: right;
    }

    #edit-community .form-control:focus,
    #add-a-store .form-control:focus {
        box-shadow: none;
        background-color: #E4E4E4;
        border: none;
        /* Set the desired border color when focused */
    }
</style>



<!-- store-full-details modal starts here -->

<div class="modal fade" id="community-full-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-4">

            <div class="datagrid" style="direction: rtl;">
                <div class="datagrid-item">
                    <div class="datagrid-title">שם ראש הת”ת:</div>
                    <div class="datagrid-content">אקסוס</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">טלפון יצירת קשר:</div>
                    <div class="datagrid-content"> רבי עקיבא 84 בני ברק</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">שם הישיבה:</div>
                    <div class="datagrid-content">054-6268012</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">כתובת הישיבה</div>
                    <div class="datagrid-content">450</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">Payment Link</div>
                    <div class="datagrid-content">054-6268012</div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">כתובת מייל</div>
                    <div class="datagrid-content">google@gmail.com</div>
                </div>

            </div>
        </div>
    </div>
</div>





<div class="container p-0">

    <div class="container col-12 mt-5">



        <!-- Filter Bar -->
        <div 
            class="row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">


            <!-- CSV Download Filter  -->
            <div class="col-sm-5 col-lg-4 m-0" style="cursor: pointer;">
                <div class="card card-sm p-relative">
                    <div class="card-body-rounded p-1 m-1 filter-card">
                        <div class="row align-items-center">
                            <div class="col-auto">

                                <span id="csv-upload-popup-svg"
                                    class="bg-black text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M43.0833 4.58336H25.6667V1.83336C25.6666 1.69558 25.6354 1.55959 25.5756 1.4355C25.5157 1.31141 25.4286 1.20242 25.3208 1.11662C25.213 1.03083 25.0872 0.970445 24.9528 0.939958C24.8185 0.909471 24.6789 0.909666 24.5447 0.94053L0.711333 6.44053C0.509269 6.48697 0.328917 6.60054 0.199723 6.7627C0.0705279 6.92486 0.000122157 7.12603 0 7.33336L0 38.5C8.32958e-05 38.7189 0.0785044 38.9306 0.221079 39.0967C0.363654 39.2628 0.560968 39.3724 0.777333 39.4057L24.6107 43.0724C24.7413 43.0928 24.8748 43.0846 25.002 43.0485C25.1292 43.0123 25.247 42.949 25.3474 42.8629C25.4478 42.7768 25.5283 42.67 25.5834 42.5498C25.6385 42.4296 25.6669 42.2989 25.6667 42.1667V39.4167H43.0833C43.3265 39.4167 43.5596 39.3201 43.7315 39.1482C43.9034 38.9763 44 38.7431 44 38.5V5.50003C44 5.25691 43.9034 5.02376 43.7315 4.85185C43.5596 4.67994 43.3265 4.58336 43.0833 4.58336ZM25.6667 17.4167H31.1667V21.0834H25.6667V17.4167ZM7.47267 28.8475L11.4492 22.4859C11.5408 22.3404 11.5895 22.172 11.5895 22C11.5895 21.8281 11.5408 21.6597 11.4492 21.5142L7.4745 15.1525C7.40471 15.0506 7.35625 14.9356 7.33204 14.8144C7.30782 14.6933 7.30834 14.5685 7.33358 14.4475C7.35882 14.3266 7.40824 14.212 7.47889 14.1106C7.54953 14.0092 7.63994 13.9232 7.74468 13.8577C7.84941 13.7921 7.96632 13.7484 8.08837 13.7292C8.21042 13.71 8.33509 13.7157 8.4549 13.7459C8.5747 13.776 8.68717 13.8301 8.78554 13.9049C8.88391 13.9797 8.96616 14.0735 9.02733 14.1809L12.056 19.0264C12.3915 19.5617 13.2752 19.5617 13.6107 19.0264L16.6393 14.1809C16.7028 14.0784 16.7859 13.9896 16.8838 13.9194C16.9818 13.8492 17.0926 13.799 17.21 13.7717C17.3273 13.7445 17.4489 13.7407 17.5678 13.7605C17.6866 13.7804 17.8004 13.8236 17.9025 13.8875C18.0047 13.9512 18.0934 14.0344 18.1635 14.1323C18.2336 14.2302 18.2837 14.341 18.3109 14.4583C18.3381 14.5756 18.342 14.6972 18.3223 14.816C18.3025 14.9348 18.2596 15.0485 18.1958 15.1507L14.2193 21.5124C14.1277 21.6578 14.079 21.8263 14.079 21.9982C14.079 22.1701 14.1277 22.3386 14.2193 22.484L18.194 28.8457C18.2578 28.9478 18.3009 29.0614 18.3208 29.1802C18.3406 29.2989 18.3369 29.4204 18.3099 29.5377C18.2828 29.6549 18.2329 29.7658 18.163 29.8638C18.0931 29.9618 18.0046 30.0451 17.9025 30.1089C17.6945 30.2314 17.4474 30.2693 17.2123 30.2147C16.9771 30.1601 16.772 30.0172 16.6393 29.8155L13.6107 24.97C13.5275 24.8391 13.4125 24.7314 13.2766 24.6568C13.1406 24.5822 12.9879 24.5431 12.8328 24.5433C12.6777 24.5435 12.5252 24.5829 12.3894 24.6578C12.2536 24.7327 12.1389 24.8408 12.056 24.9719L9.02733 29.8174C8.89435 30.0187 8.68923 30.1613 8.45423 30.2159C8.21923 30.2704 7.97225 30.2328 7.76417 30.1107C7.66209 30.0469 7.57357 29.9636 7.50368 29.8656C7.43378 29.7676 7.38387 29.6568 7.35681 29.5395C7.32974 29.4222 7.32604 29.3007 7.34592 29.182C7.3658 29.0633 7.40887 28.9496 7.47267 28.8475ZM25.6667 22.9167H31.1667V26.5834H25.6667V22.9167ZM33 22.9167H42.1667V26.5834H33V22.9167ZM33 21.0834V17.4167H42.1667V21.0834H33ZM33 15.5834V11.9167H42.1667V15.5834H33ZM31.1667 15.5834H25.6667V11.9167H31.1667V15.5834ZM25.6667 28.4167H31.1667V32.0834H25.6667V28.4167ZM33 28.4167H42.1667V32.0834H33V28.4167ZM42.1667 10.0834H33V6.4167H42.1667V10.0834ZM31.1667 6.4167V10.0834H25.6667V6.4167H31.1667ZM25.6667 33.9167H31.1667V37.5834H25.6667V33.9167ZM33 37.5834V33.9167H42.1667V37.5834H33Z"
                                            fill="#FFFFFF" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col row justify-content-right">
                                <button class="font-weight-medium ts-text btn border-0 text-right w-20"
                                    onclick='outToExcel( <?php echo isset($pageData["communities"]) ? json_encode($pageData["communities"]) : "[]"; ?>)'>יצא
                                    לאקסל</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Search by store name Filter  -->
            <!-- Search by store name Filter  -->
            <div class="col-sm-5 col-lg-4 m-0">
                <div class="card card-sm p-relative" style="position: relative;">

                    <div class="filter-popup" id="filter-stores-popup" style="z-index: -1;">
                        <form action="" method="post">
                            <div class="" style="direction: rtl;">
                                <label class="form-label">חיפוש לפי שם</label>
                                <input type="text" class="form-control" placeholder="" name="community_name"
                                    value="<?php echo isset($_POST["community_name"]) ? $_POST["community_name"] : ""; ?>">
                                <input type="hidden" name="csvp_filter" value="filter_communities_by_name">
                                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body-rounded p-1 m-1 filter-card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span id="filter-stores-popup-svg"
                                    class="bg-white text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                    <svg width="42" height="40" viewBox="0 0 42 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                                            fill="black" />
                                    </svg>
                                </span>

                                <?php
                                if (isset($_POST["community_name"])) {
                                    ?>
                                    <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                                    <span class="current_filter">
                                        <?php echo $_POST["community_name"]; ?>
                                    </span>
                                    <?php
                                } ?>

                            </div>
                            <div class="col">
                                <div class="font-weight-medium ts-text"> חיפוש לפי שם</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>


            <!-- Debt exists/no debt exists Filter -->
            <div class="col-sm-5 col-lg-4 m-0">
                <div class="card card-sm p-relative" style="position: relative;">
                    <div class="filter-popup" id="filter-guys-popup" style="z-index: -1;">
                        <form action="" method="post">
                            <div class="d-flex flex-column align-items-start" style="direction: rtl;">
                                <label class="form-label">קיים חוב/לא קיים חוב</label>
                                <div class="form-selectgroup form-selectgroup-pills">
                                    <label class="form-selectgroup-item">
                                        <input type="checkbox" name="commision_pending" value="1"
                                            class="form-selectgroup-input" <?php echo isset($_POST["commision_pending"]) && $_POST["commision_pending"] == 1 ? 'checked = ""' : ""; ?>>
                                        <span class="form-selectgroup-label">קיים חוב</span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="checkbox" name="commision_pending" value="0"
                                            class="form-selectgroup-input" <?php echo isset($_POST["commision_pending"]) && $_POST["commision_pending"] == 0 ? 'checked = ""' : ""; ?>>
                                        <span class="form-selectgroup-label">לא קיים חוב</span>
                                    </label>
                                </div>
                                <input type="hidden" name="csvp_filter" value="filter_communities_by_debt">
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

                                <?php
                                if (isset($_POST["commision_pending"])) {
                                    ?>
                                    <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                                    <span class="current_filter">
                                        <?php 
                                        echo $_POST["commision_pending"];
                                        ?>
                                    </span>
                                    <?php
                                } ?>
                            </div>
                            <div class="col" style="z-index:1">
                                <div class="font-weight-medium ts-text">קיים חוב/לא קיים חוב</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- edit Community modal -->

        <div class="modal fade" id="edit-community" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content pb-4">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="bg-dark pt-5 pb-5">
                        <h1 class="text-white text-center" style="font-size: 50px; font-weight: 900;">Edit Community
                            Details
                        </h1>
                    </div>
                    <div class="container-fluid " style="overflow: auto;">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="container mt-5 d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">טלפון יצירת קשר </label>
                                        <input type="text" class="form-control" id="community_manager_phone_id"
                                            name="community_manager_phone">
                                    </div>
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">שם ראש הת”ת</label>
                                        <input type="text" class="form-control" id="community_manager_name_id"
                                            name="community_manager_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">כתובת הישיבה</label>
                                        <input type="text" class="form-control" id="community_address_id"
                                            name="community_address">
                                    </div>
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">שם הישיבה</label>
                                        <input type="text" class="form-control" id="community_name_id"
                                            name="community_name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">כתובת מייל</label>
                                        <input type="email" class="form-control" id="community_mail_address_id"
                                            name="community_mail_address" readonly disabled>
                                    </div>
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">Mosad</label>
                                        <input type="text" class="form-control" id="payment_link_id"
                                            name="payment_link">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">ApiValid</label>
                                        <input type="text" class="form-control" id="api_valid_id" name="api_valid">
                                    </div>
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">Commission Percentage</label>
                                        <input type="number" class="form-control" id="commision_percentage_id"
                                            name="commision_percentage">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">סיסמת כניסה</label>
                                        <input type="password" class="form-control" id="password_id" name="password">
                                    </div>
                                    <div class="mb-3 col-xl-6">
                                        <label class="form-label">שם משתמש</label>
                                        <input type="text" class="form-control" id="username_id" readonly
                                            name="username">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-xl-12">
                                        <label class="form-label">Community Logo</label>
                                        <input type="file" class="form-control" id="community_logo_id"
                                            name="community_logo">
                                    </div>
                                </div>
                                <input type="hidden" id="community_id_" name="community_id" value="">
                                <input type="hidden" id="user_id_" name="user_id" value="">
                                <input type="hidden" id="oldpath_id" name="oldpath" value="">
                                <input type="hidden" name="csvp_request" value="update_community">
                                <input type="submit" class="btn btn-dark " value="← לעדכון הישיבה במערכת">

                            </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- edit Community modal End -->


        <div class="container mt-4 d-flex flex-wrap" style="row-gap: 1rem; column-gap: 1rem;">

            <?php
            if (isset($pageData["communities"])) {

                foreach ($pageData["communities"] as $key => $community) {
                    $noDebt = ($community['commision_pending'] == 0) ? "no-debt" : "";
                    $imageUrl = esc_url(get_site_url() . '/wp-content/uploads/') . $community["community_logo"];
                    ?>

                    <div class="store-management-card card col-xl-4 rounded-3 p-0 <?php echo $noDebt; ?>" data-bs-toggle="modal"
                        data-bs-target="#store-details">
                        <!-- Photo -->
                        <div class="card-body d-flex flex-column p-0">

                            <div class="w-35"
                                style="border-top-right-radius: 8px; position: relative; border-bottom-right-radius: 8px; height: 150px; background-image: url(<?php echo $imageUrl ? $imageUrl : 'https://placehold.co/600x400'; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
                                <svg data-bs-toggle="modal" data-bs-target="#edit-community"
                                    data-id="<?php echo $community['id']; ?>" style="position: absolute; top: 8px; right: 8px;"
                                    width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_542_250)">
                                        <path
                                            d="M5.83334 40.0006H30.8333C32.3828 39.9962 33.8673 39.3773 34.9609 38.2796C36.0545 37.1819 36.668 35.6951 36.6667 34.1456V21.584C36.6667 21.142 36.4911 20.718 36.1785 20.4055C35.866 20.0929 35.442 19.9173 35 19.9173C34.558 19.9173 34.1341 20.0929 33.8215 20.4055C33.5089 20.718 33.3333 21.142 33.3333 21.584V34.1456C33.3356 34.8114 33.0736 35.4508 32.6049 35.9235C32.1362 36.3963 31.499 36.6638 30.8333 36.6673H5.83334C5.16762 36.6638 4.53051 36.3963 4.06181 35.9235C3.59311 35.4508 3.33112 34.8114 3.33334 34.1456V9.18898C3.33112 8.52327 3.59311 7.88387 4.06181 7.4111C4.53051 6.93834 5.16762 6.67085 5.83334 6.66732H18.3333C18.7754 6.66732 19.1993 6.49172 19.5118 6.17916C19.8244 5.8666 20 5.44268 20 5.00065C20 4.55862 19.8244 4.1347 19.5118 3.82214C19.1993 3.50958 18.7754 3.33398 18.3333 3.33398H5.83334C4.28384 3.3384 2.79939 3.95737 1.70576 5.05506C0.612136 6.15275 -0.00132849 7.63948 2.16018e-06 9.18898V34.1456C-0.00132849 35.6951 0.612136 37.1819 1.70576 38.2796C2.79939 39.3773 4.28384 39.9962 5.83334 40.0006Z"
                                            fill="#01051D" />
                                        <path
                                            d="M15.7575 17.5733L14.4425 23.5967C14.383 23.8699 14.3931 24.1537 14.4721 24.4219C14.551 24.6902 14.6962 24.9342 14.8942 25.1317C15.0949 25.3241 15.3391 25.4654 15.606 25.5434C15.8729 25.6215 16.1547 25.634 16.4275 25.58L22.4375 24.2617C22.7496 24.1931 23.0353 24.0364 23.2608 23.81L38.4508 8.62C38.9152 8.15569 39.2836 7.60446 39.5349 6.99778C39.7862 6.39109 39.9156 5.74084 39.9156 5.08416C39.9156 4.42748 39.7862 3.77723 39.5349 3.17055C39.2836 2.56387 38.9152 2.01263 38.4508 1.54833C37.4988 0.638557 36.2327 0.130859 34.9158 0.130859C33.599 0.130859 32.3329 0.638557 31.3808 1.54833L16.2142 16.7533C15.9865 16.9773 15.828 17.2619 15.7575 17.5733ZM33.7375 3.90666C34.0546 3.6029 34.4767 3.43332 34.9158 3.43332C35.3549 3.43332 35.7771 3.6029 36.0942 3.90666C36.4025 4.22105 36.5752 4.64382 36.5752 5.08416C36.5752 5.52451 36.4025 5.94728 36.0942 6.26166L34.9158 7.44L32.5592 5.08333L33.7375 3.90666ZM18.9042 18.7633L30.1942 7.445L32.5275 9.79L21.2325 21.1117L18.2408 21.7683L18.9042 18.7633Z"
                                            fill="#01051D" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_542_250">
                                            <rect width="40" height="40" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>


                                <svg style="position: absolute; top: 8px; left: 8px;" class="debt-button" width="92" height="47"
                                    viewBox="0 0 92 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="92" height="47" rx="10" fill="#01051D" />
                                    <path
                                        d="M15.5048 31V23.14C15.5048 22.4867 15.3448 22 15.0248 21.68C14.7048 21.3467 14.2382 21.18 13.6248 21.18H9.74484L10.0448 19H13.7648C15.2048 19 16.2915 19.3467 17.0248 20.04C17.7715 20.72 18.1448 21.7333 18.1448 23.08V29.04C18.0648 29.3733 17.9115 29.7067 17.6848 30.04C17.4715 30.3733 17.2448 30.6933 17.0048 31H15.5048ZM9.14484 31V28.82H19.6248L19.3448 31H9.14484ZM22.4278 31V19H25.0678V31H22.4278ZM20.7478 21.18L21.0278 19H24.1678V21.18H20.7478ZM34.3917 19C35.8317 19 36.9184 19.3467 37.6517 20.04C38.3984 20.72 38.7717 21.7333 38.7717 23.08V31H36.1317V23.14C36.1317 22.4867 35.9717 22 35.6517 21.68C35.3317 21.3467 34.8651 21.18 34.2517 21.18H31.2117C31.1451 21.2867 31.0717 21.48 30.9917 21.76C30.9251 22.04 30.8917 22.4933 30.8917 23.12V31H28.2517V23.9C28.2517 23.34 28.3051 22.84 28.4117 22.4C28.5184 21.9467 28.7117 21.56 28.9917 21.24L28.7517 21.1V19H34.3917ZM27.2317 21.18L27.5317 19H32.7317V21.18H27.2317ZM53.6966 19C55.1366 19 56.2232 19.3467 56.9566 20.04C57.7032 20.72 58.0766 21.7333 58.0766 23.08V31H47.4966V22.98C47.4966 22.8067 47.5166 22.6067 47.5566 22.38C47.6099 22.14 47.6966 21.9133 47.8166 21.7C47.9366 21.4733 48.1099 21.3 48.3366 21.18H46.3366L46.6366 19H53.6966ZM55.4366 28.82V23.14C55.4366 22.4867 55.2766 22 54.9566 21.68C54.6366 21.3467 54.1699 21.18 53.5566 21.18H50.2966C50.2299 21.3533 50.1832 21.5467 50.1566 21.76C50.1432 21.96 50.1366 22.1667 50.1366 22.38V28.82H55.4366ZM61.2169 25.88V19H63.8569V25.88H61.2169ZM59.5369 21.18L59.8169 19H62.7169V21.18H59.5369ZM67.6231 25.88V19H70.2631V25.88H67.6231ZM65.9431 21.18L66.2231 19H69.1231V21.18H65.9431ZM78.0294 31L80.9494 21.16H72.6694L72.9494 19H83.9494L83.7694 20.6L80.6694 31H78.0294ZM73.1694 34.74V23.84L75.8094 23.68V34.58L73.1694 34.74Z"
                                        fill="#F9F8C7" />
                                </svg>

                            </div>


                            <div class="d-flex flex-column px-5 py-4" style="">
                                <div class="store-management-information rounded-3">
                                    <div class="row-1 p-2 d-flex align-items-center justify-content-end">
                                        <table>

                                            <tr class="d-flex flex-column gap-2 text-right" style="direction: rtl;">

                                                <td><strong>שם הישיבה:</strong>
                                                    <?php echo $community["community_name"]; ?>
                                                </td>
                                                <td><strong>שם ראש הת”ת: </strong>
                                                    <?php echo $community["community_manager_name"]; ?>
                                                </td>
                                                <td><strong>מספר טלפון:</strong>
                                                    <?php echo $community["community_manager_phone"]; ?>
                                                </td>
                                                <td><strong>כמות בחורים:</strong>
                                                    <?php echo $community["number_of_guys"]; ?>
                                                </td>

                                            </tr>

                                        </table>
                                    </div>

                                </div>
                                <a href="/admin/community-login?community_user_id=<?php echo $community["wp_user_id"]; ?>"
                                    class="btn btn-dark">← לפרטים המלאים</a>
                            </div>



                        </div>

                    </div>

                <?php }
            } ?>
        </div>


        <div class="col-12">
            <div class="container p-0">
                <div class="card-x">
                    <div class="card-body my-3 bg-black rounded-3 p-2">
                        <ul class="pagination p-1">
                            <!-- <li class="page-item page-prev disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <div class="page-item-subtitle text-white mx-4" style="font-size: 20px">
                                        סה”כ עסקאות במערכת: 87 </div>
                                </a>
                            </li> -->

                            <li class="page-item page-next">
                                <div class="page-item-title text-white mx-4" style="font-size: 20px">
                                    סה”כ ישיבות:
                                    <?php echo $pageData["total_communities"]; ?>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>


<script>
    jQuery('#edit-community').on('show.bs.modal', function (event) {
        // Extract data from data attributes of the button
        var button = jQuery(event.relatedTarget);
        var id = button.data('id');
        var community_id = button.data('id');
        var community_user_id = 0;
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: 'csvp_ajax', // Action hook
                csvp_request: 'CSVP_Community', // Action hook
                csvp_handler: 'get_community_data_by_id', // Action hook
                data: {
                    id: community_id
                }
            },
            success: function (response) {
                console.log(response);
                document.getElementById("community_manager_phone_id").value = response.community_manager_phone;
                document.getElementById("community_manager_name_id").value = response.community_manager_name;
                document.getElementById("community_address_id").value = response.community_address;
                document.getElementById("community_name_id").value = response.community_name;
                document.getElementById("community_mail_address_id").value = response.community_mail_address;
                document.getElementById("payment_link_id").value = response.payment_link;
                document.getElementById("api_valid_id").value = response.api_valid;
                document.getElementById("commision_percentage_id").value = response.commision_percentage;
                document.getElementById("community_id_").value = response.id;
                document.getElementById("oldpath_id").value = response.community_logo;
                community_user_id = response.wp_user_id;
                userdata(community_user_id);
                // document.getElementById("password_id").value = ;
                // document.getElementById("username_id").value = ;
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });

    });


  

    function userdata(community_user_id) {
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: 'csvp_ajax', // Action hook
                csvp_request: 'CSVP_Community', // Action hook
                csvp_handler: 'get_community_user_data_by_id', // Action hook
                data: {
                    id: community_user_id
                }
            },
            success: function (response) {
                console.log(response);
                // document.getElementById("password_id").value = response;
                document.getElementById("username_id").value = response.data.user_login;
                document.getElementById("user_id_").value = response.data.ID;
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }
</script>

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



    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('stores-select-tags'), {
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

