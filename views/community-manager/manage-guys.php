<?php include CSVP_PLUGIN_PATH . "views/community-manager/header.php" ?>

<style>
  .card-x {
    background-color: transparent;
    box-shadow: none;
    border: none;
  }

  tbody {
    gap: 10px;
  }

  tr {
    border-radius: 0.5rem;
    background-color: white;
  }

  td {
    width: 110px;
  }

  .ts-price {
    width: 20%;
  }

  .ts-date {
    width: 19%;
  }

  .ts-product {
    width: 22%;
  }

  .ts-store-name {
    width: 16%;
  }

  .ts-guy-name {
    width: 20%;
  }

  .ts-text {
    text-align: right;
    font-size: 20px;
    font-weight: 600;
  }

  .ts-text-color {
    color: #F9F8C7;
  }


  .managing-guys-table {
    direction: rtl;
  }

  .managing-guys-table tr {
    display: flex;
    flex-direction: row-reverse;
  }


  .ts-guy-name::after {
    content: "";
  }

  .ts-edit {
    float: right;
  }


  /* popup form css */

  #edit-guy-form .form-label {
    font-size: 25px;
    font-weight: 600;
    line-height: 34px;
    text-align: right;
  }

  #edit-guy-form .form-control {
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

  #edit-guy-form .wrapped-input {
    width: 100%;
    border-radius: 20px;
    text-align: right;
    background-color: #E4E4E4;
  }

  #edit-guy-form kbd {
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

  #edit-guy-form .btn {
    height: 89px;
    top: 643px;
    left: 66px;
    padding: 27px, 357px, 28px, 218px;
    border-radius: 20px;
    font-size: 25px;
    font-weight: 900;
    text-align: right;
  }

  #edit-guy-form .form-control:focus {
    box-shadow: none;
    background-color: #E4E4E4;
    border: none;
    /* Set the desired border color when focused */
  }




  #add-guy-form .form-label {
    font-size: 25px;
    font-weight: 600;
    line-height: 34px;
    text-align: right;
  }

  #add-guy-form .form-control {
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

  #add-guy-form .wrapped-input {
    width: 100%;
    border-radius: 20px;
    text-align: right;
    background-color: #E4E4E4;
  }

  #add-guy-form kbd {
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

  #add-guy-form .btn {
    height: 89px;
    top: 643px;
    left: 66px;
    padding: 27px, 357px, 28px, 218px;
    border-radius: 20px;
    font-size: 25px;
    font-weight: 900;
    text-align: right;
  }

  #add-guy-form .form-control:focus {
    box-shadow: none;
    background-color: #E4E4E4;
    border: none;
    /* Set the desired border color when focused */
  }


  @media screen and (max-width: 1200px) {
    .ts-price {
      width: 280px;
    }

    .ts-date {
      width: 360px;
    }

    .ts-product {
      width: 290px;
    }

    .ts-store-name {
      width: 210px;
    }

    .ts-guy-name {
      width: 215px;
    }

    tr {
      width: 1000px;
    }

    #add-guy-form kbd {
      font-size: 16px;
      width: 250px;
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




  .guy-loading-history-data tbody {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .guy-loading-history-data {
    width: 100%;
  }

  .guy-loading-history-data tr {
    width: 100%;
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    gap: 20px;
    padding: 20px;
    border-radius: 10px;
    background-color: rgba(239, 239, 239, 1);
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
    font-size: 20px;
    font-weight: 400;
  }

  .card-wrapper .card .img-responsive {
    border-radius: 14px 14px 0 0;
  }

  .card-wrapper .card .card-body {
    border-radius: 0 0 14px 14px;

  }

  .card-wrapper .card .card-body button {
    font-size: 25px;
    font-weight: 600;
    border-radius: 10px;
    padding: 20px;
  }


  @media screen and (max-width: 900px) {
    .card-wrapper .card {
      width: 48%;
    }
  }

  @media screen and (max-width: 580px) {
    .card-wrapper .card {
      width: 100%;
    }
  }
</style>


<!-- edit guy modal -->
<div class="modal fade" id="edit-guy-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="bg-dark pt-5 pb-5">
        <h1 class="text-white text-center" style="font-size: 50px; font-weight: 900;">+ הוספת בחור חדש </h1>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="container-fluid">
            <div class="container mt-5 d-flex flex-column gap-5">

              <div class="row">
                <div class="mb-3 col-xl-4">
                  <label class="form-label">כתובת מייל </label>
                  <input type="text" class="form-control" name="email_address" id="email_address_edit" readonly disabled required>
                </div>
                <div class="mb-3 col-xl-4">
                  <label class="form-label">מספר טלפון</label>
                  <input type="number" class="form-control" name="phone_number" id="phone_number_edit">
                </div>
                <div class="mb-3 col-xl-4">
                  <label class="form-label">שם פרטי ומשפחה</label>
                  <input type="text" class="form-control" name="full_name" id="full_name_edit" required>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-xl-4">
                  <label class="form-label">כתובת </label>
                  <input type="text" class="form-control" name="address" id="address_edit">
                </div>
                <div class="mb-3 col-xl-4">
                  <label class="form-label">מספר תעודת זהות </label>
                  <input type="text" class="form-control" name="id_number" id="id_number_edit">
                </div>
                <div class="mb-3 col-xl-4">
                  <label class="form-label">שיעור</label>
                  <input type="text" class="form-control" name="lesson" id="lesson_edit">
                </div>
              </div>
              <div class="row">
                <label class="form-label">שיוך מספר כרטיס מגנטי</label>

                <div class="wrapped-input mb-3 row align-items-center">
                  <div class="col-auto">
                    <kbd>לחץ להעברת כרטיס מגנטי לשיוך</kbd>
                  </div>
                  <div class="col">
                  <input type="text" class="form-control" style="border: none;" name="magnetic_card_number_association" id="magnetic_card_number_association_edit">
                  </div>
                </div>
              </div>

              <div class="row d-flex align-items-center">
                
                <div class="mb-3 col-xl-6">
                  <input type="hidden" name="user_id" id="user_id_edit" value="">
                  <input type="hidden" name="community_member_id" id="community_member_id_edit" value="">
                  <input type="hidden" name="csvp_request" value="edit_guy">
                  <input type="submit" class="btn btn-dark " value="← לעדכון פרטי הבחור לחץ כאןן">
                </div>
                </form>
                <div class="mb-3 col-xl-6">
                  <form action="" method="post">
                  <input type="hidden" name="community_member_id" id="community_member_id_delete" value="">
                  <input type="hidden" name="csvp_request" value="delete_guy">
                  <input type="submit" class="btn btn-danger " value="← מחיקת הבחור מהמערכת">
                  </form>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </div>
  </div>

</div>



<!-- add guy modal -->

<div class="modal fade" id="add-guy-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content pb-4">
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="bg-dark pt-5 pb-5">
        <h1 class="text-white text-center" style="font-size: 50px; font-weight: 900;">+ הוספת בחור חדש </h1>
      </div>
      <div class="container-fluid " style="overflow: auto;">
        <form action="" method="post">
          <div class="container mt-5 d-flex flex-column gap-5">
            <div class="row">
              <div class="mb-3 col-xl-4">
                <label class="form-label">כתובת מייל </label>
                <input type="email" class="form-control" name="email_address" required>
              </div>
              <div class="mb-3 col-xl-4">
                <label class="form-label">מספר טלפון</label>
                <input type="number" class="form-control" name="phone_number">
              </div>
              <div class="mb-3 col-xl-4">
                <label class="form-label">שם פרטי ומשפחה</label>
                <input type="text" class="form-control" name="full_name" required>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-xl-4">
                <label class="form-label">כתובת </label>
                <input type="text" class="form-control" name="address">
              </div>
              <div class="mb-3 col-xl-4">
                <label class="form-label">מספר תעודת זהות </label>
                <input type="text" class="form-control" name="id_number">
              </div>
              <div class="mb-3 col-xl-4">
                <label class="form-label">שיעור</label>
                <input type="text" class="form-control" name="lesson">
              </div>
            </div>
            <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="row">
              <label class="form-label">שיוך מספר כרטיס מגנטי</label>

              <div class="wrapped-input mb-3 row align-items-center">
                <div class="col-auto">
                  <kbd>לחץ להעברת כרטיס מגנטי לשיוך</kbd>
                </div>
                <div class="col">
                  <input type="text" class="form-control" style="border: none;" name="magnetic_card_number_association_add">
                </div>
              </div>
            </div>
            <input type="hidden" name="csvp_request" value="add_guy">
            <input type="submit" class="btn btn-dark " value="← להוספת הבחור למערכת לחץ כאן">

          </div>
      </div>
      </form>
    </div>
  </div>

</div>


    <!-- Import From Excel Modal -->

    <div class="modal fade" id="excel-import-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content p-4" style="direction: rtl;">
                <form method="POST" action="" enctype="multipart/form-data">
                  <div class="col-12">
                      <div class="form-label">Import From Excel</div>
                      <input type="file" name="community_members_csv" accept=".csv" class="form-control">

                      <div class="row gap-3 mt-3">
                          <input type="submit" class="col-4 btn btn-dark">
                              Import
                          </button>

                          <a href="<?php echo plugins_url("/assets/import_templates/community_members_template.xlsx"); ?>" class="col-4 btn btn-dark" download>
                              Download Sample
                          </a>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Import From Excel Modal End -->



<!-- Guy Details modal Starts here -->

<div class="modal fade" id="community-member-guy-full-detail" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
    <div class="modal-content " style="overflow: auto;">

      <div class="main-container">
        <div
          class="guys-full-details-header w-100 d-flex flex-row bg-dark justify-content-between align-items-center p-4"
          style="direction: rtl;">
          <h2 class="text-white m-0" style="font-family: Noto Sans Hebrew; font-size: 36px; font-weight: 900;">משה
            וענונו
          </h2>
          <button class="btn bg-white rounded "
            style="font-family: Noto Sans Hebrew; font-size: 24px; font-weight: 800;" data-bs-dismiss="modal" aria-label="Close">חזרה לתפריט
            הראשי</button>
        </div>
        <div class="guys-full-details-body d-flex flex-row justify-content-center row" style="direction: rtl;">

          <div class="col-lg-4 p-4 bg-gray rounded-3 my-5 mx-2" style="background: rgba(228, 228, 228, 1);">
            <h2><strong>פרטי הבחור:</strong></h2>
            <h2><strong>שם הבחור:</strong><span id="guy_name"></span></h2>
            <h2><strong>מס’ טלפון:</strong> <span id="guy_no"></span></h2>
            <h2><strong>כתובת מייל:</strong> <span id="guy_email"></span></h2>
            <h2><strong>מס’ תעודת זהות:</strong> <span id="guy_id_no"></span></h2>
            <h2><strong>מס’ כרטיס מגנטי:</strong> <span id="guy_magnetic_card_no"></span></h2>
          </div>

          <div class="col-lg-7 p-4 bg-white rounded-3 my-5 mx-2"
            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); direction: rtl;">
            <h1>הסטוריית טעינות</h1>
            <div style="  height: 200px; overflow: auto;">
              <table class="guy-loading-history-data">
                <tbody id="guy-transaction-history">

                </tbody>

              </table>
            </div>
          </div>

          <h2 style="font-size: 25px; padding-right: 40px; padding-top: 50px; font-weight: 800;"
            class="col-12 card-wrapper">שוברים להטענה</h2>

          <!-- <?php echo json_encode($pageData["vouchers"]); ?> -->
          <div class="col-12 p-5 card-wrapper" id="guy-voucher-data">


            <?php foreach ($pageData["vouchers"] as $key => $voucherData) {
              ?>
              <div class="card">
                <!-- Photo -->
                <div class="img-responsive img-responsive-21x9 card-img-top"
                  style="background-image: url(<?php echo home_url() . '/wp-content/uploads' . $voucherData['product_image']; ?>);height: 250px;">
                </div>
                <div class="card-body bg-white text-center">
                  <h3 class="card-title">
                    <?php echo $voucherData["product_name"]; ?>
                  </h3>
                  <h3 class="text-secondary">
                    <?php echo $voucherData["voucher_price"]; ?>₪ במקום
                    <?php echo $voucherData["normal_price"] ?>₪
                  </h3>
                  <input type="hidden" id="member_id">
                  <button class="btn bg-black text-white"
                    onclick='buyVoucher(JSON.stringify(<?php echo json_encode($voucherData); ?>))'>הטענת השובר</button>
                </div>
              </div>
            <?php } ?>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Guy Details modal Ends here -->





<div class="modal fade" id="store-manager-voucher-purchase" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
    <div class="modal-content p-4" style="direction: rtl" style="overflow: auto;">
      <h3>Do you wish to load <span id="voucher_name"></span></h3>

      <div class="add-new-benefit-buttons mt-4">
        <form method="POST" action="">
          <input type="hidden" name="voucher_id" id="voucher_id">
          <input type="hidden" name="csvp_request" value="load_voucher">
          <input type="hidden" name="community_member_id" id="community_member_id">
          <input type="hidden" name="transaction_amount" id="transaction_amount">
          <input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
          <button type="button" class="btn btn-danger w-25" data-bs-dismiss=" modal" aria-label="Close">ביטול</button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- page content -->

<div class="container p-0">

  <div class="container col-12 mt-5">
    <div class="mb-4" style="">
      <button data-bs-toggle="modal" data-bs-target="#add-guy-form"
        class="bg-black text-white px-5 py-3 rounded-3 border-0"
        style="font-size: 20px; font-weight: 400; direction: rtl;">הוספת
        בחור חדש +</button>


      <button data-bs-toggle="modal" data-bs-target="#excel-import-modal" class="bg-black text-white px-5 py-3 rounded-3 border-0"
        style="font-size: 20px; font-weight: 400; direction: rtl;">
        ייבוא מאקסאל
        <svg style="margin-right: 10px;" width="28" height="28" viewBox="0 0 44 44" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_0_2738)">
            <path
              d="M43.0833 4.58312H25.6667V1.83312C25.6666 1.69534 25.6354 1.55934 25.5756 1.43525C25.5157 1.31116 25.4286 1.20217 25.3208 1.11638C25.213 1.03059 25.0872 0.9702 24.9528 0.939713C24.8185 0.909227 24.6789 0.909422 24.5447 0.940286L0.711333 6.44029C0.509269 6.48673 0.328917 6.6003 0.199723 6.76246C0.0705279 6.92462 0.000122157 7.12579 0 7.33312L0 38.4998C8.32958e-05 38.7187 0.0785044 38.9303 0.221079 39.0965C0.363654 39.2626 0.560968 39.3722 0.777333 39.4055L24.6107 43.0721C24.7413 43.0925 24.8748 43.0844 25.002 43.0482C25.1292 43.0121 25.247 42.9487 25.3474 42.8627C25.4478 42.7766 25.5283 42.6698 25.5834 42.5496C25.6385 42.4294 25.6669 42.2987 25.6667 42.1665V39.4165H43.0833C43.3265 39.4165 43.5596 39.3199 43.7315 39.148C43.9034 38.9761 44 38.7429 44 38.4998V5.49979C44 5.25667 43.9034 5.02351 43.7315 4.8516C43.5596 4.6797 43.3265 4.58312 43.0833 4.58312ZM25.6667 17.4165H31.1667V21.0831H25.6667V17.4165ZM7.47267 28.8473L11.4492 22.4856C11.5408 22.3402 11.5895 22.1717 11.5895 21.9998C11.5895 21.8278 11.5408 21.6594 11.4492 21.514L7.4745 15.1523C7.40471 15.0503 7.35625 14.9353 7.33204 14.8142C7.30782 14.693 7.30834 14.5682 7.33358 14.4473C7.35882 14.3263 7.40824 14.2117 7.47889 14.1104C7.54953 14.009 7.63994 13.923 7.74468 13.8574C7.84941 13.7919 7.96632 13.7482 8.08837 13.729C8.21042 13.7098 8.33509 13.7154 8.4549 13.7456C8.5747 13.7758 8.68717 13.8299 8.78554 13.9047C8.88391 13.9794 8.96616 14.0733 9.02733 14.1806L12.056 19.0261C12.3915 19.5615 13.2752 19.5615 13.6107 19.0261L16.6393 14.1806C16.7028 14.0782 16.7859 13.9893 16.8838 13.9191C16.9818 13.8489 17.0926 13.7987 17.21 13.7715C17.3273 13.7442 17.4489 13.7404 17.5678 13.7603C17.6866 13.7802 17.8004 13.8233 17.9025 13.8873C18.0047 13.9509 18.0934 14.0341 18.1635 14.1321C18.2336 14.23 18.2837 14.3408 18.3109 14.4581C18.3381 14.5754 18.342 14.6969 18.3223 14.8157C18.3025 14.9345 18.2596 15.0483 18.1958 15.1505L14.2193 21.5121C14.1277 21.6576 14.079 21.826 14.079 21.998C14.079 22.1699 14.1277 22.3383 14.2193 22.4838L18.194 28.8455C18.2578 28.9475 18.3009 29.0612 18.3208 29.1799C18.3406 29.2986 18.3369 29.4201 18.3099 29.5374C18.2828 29.6547 18.2329 29.7655 18.163 29.8635C18.0931 29.9615 18.0046 30.0448 17.9025 30.1086C17.6945 30.2312 17.4474 30.2691 17.2123 30.2145C16.9771 30.1599 16.772 30.0169 16.6393 29.8153L13.6107 24.9698C13.5275 24.8389 13.4125 24.7311 13.2766 24.6565C13.1406 24.5819 12.9879 24.5429 12.8328 24.5431C12.6777 24.5433 12.5252 24.5826 12.3894 24.6576C12.2536 24.7325 12.1389 24.8405 12.056 24.9716L9.02733 29.8171C8.89435 30.0184 8.68923 30.161 8.45423 30.2156C8.21923 30.2702 7.97225 30.2325 7.76417 30.1105C7.66209 30.0467 7.57357 29.9634 7.50368 29.8654C7.43378 29.7674 7.38387 29.6565 7.35681 29.5392C7.32974 29.4219 7.32604 29.3005 7.34592 29.1817C7.3658 29.063 7.40887 28.9494 7.47267 28.8473ZM25.6667 22.9165H31.1667V26.5831H25.6667V22.9165ZM33 22.9165H42.1667V26.5831H33V22.9165ZM33 21.0831V17.4165H42.1667V21.0831H33ZM33 15.5831V11.9165H42.1667V15.5831H33ZM31.1667 15.5831H25.6667V11.9165H31.1667V15.5831ZM25.6667 28.4165H31.1667V32.0831H25.6667V28.4165ZM33 28.4165H42.1667V32.0831H33V28.4165ZM42.1667 10.0831H33V6.41645H42.1667V10.0831ZM31.1667 6.41645V10.0831H25.6667V6.41645H31.1667ZM25.6667 33.9165H31.1667V37.5831H25.6667V33.9165ZM33 37.5831V33.9165H42.1667V37.5831H33Z"
              fill="white" />
          </g>
          <defs>
            <clipPath id="clip0_0_2738">
              <rect width="44" height="44" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </button>

    </div>




    <!-- Filter Bar -->
    <div
      class="row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">


      <!-- CSV Download Filter  -->
      <div class="col-sm-5 col-lg-3 m-0" style="cursor: pointer;"
        onclick='outToExcel( <?php echo isset($pageData["members"]) ? json_encode($pageData["members"]) : "[]"; ?>)'>
        <div class="card card-sm p-relative">
          <div class="card-body-rounded p-1 m-1 filter-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <span id="csv-upload-popup-svg"
                  class="bg-black text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M43.0833 4.58336H25.6667V1.83336C25.6666 1.69558 25.6354 1.55959 25.5756 1.4355C25.5157 1.31141 25.4286 1.20242 25.3208 1.11662C25.213 1.03083 25.0872 0.970445 24.9528 0.939958C24.8185 0.909471 24.6789 0.909666 24.5447 0.94053L0.711333 6.44053C0.509269 6.48697 0.328917 6.60054 0.199723 6.7627C0.0705279 6.92486 0.000122157 7.12603 0 7.33336L0 38.5C8.32958e-05 38.7189 0.0785044 38.9306 0.221079 39.0967C0.363654 39.2628 0.560968 39.3724 0.777333 39.4057L24.6107 43.0724C24.7413 43.0928 24.8748 43.0846 25.002 43.0485C25.1292 43.0123 25.247 42.949 25.3474 42.8629C25.4478 42.7768 25.5283 42.67 25.5834 42.5498C25.6385 42.4296 25.6669 42.2989 25.6667 42.1667V39.4167H43.0833C43.3265 39.4167 43.5596 39.3201 43.7315 39.1482C43.9034 38.9763 44 38.7431 44 38.5V5.50003C44 5.25691 43.9034 5.02376 43.7315 4.85185C43.5596 4.67994 43.3265 4.58336 43.0833 4.58336ZM25.6667 17.4167H31.1667V21.0834H25.6667V17.4167ZM7.47267 28.8475L11.4492 22.4859C11.5408 22.3404 11.5895 22.172 11.5895 22C11.5895 21.8281 11.5408 21.6597 11.4492 21.5142L7.4745 15.1525C7.40471 15.0506 7.35625 14.9356 7.33204 14.8144C7.30782 14.6933 7.30834 14.5685 7.33358 14.4475C7.35882 14.3266 7.40824 14.212 7.47889 14.1106C7.54953 14.0092 7.63994 13.9232 7.74468 13.8577C7.84941 13.7921 7.96632 13.7484 8.08837 13.7292C8.21042 13.71 8.33509 13.7157 8.4549 13.7459C8.5747 13.776 8.68717 13.8301 8.78554 13.9049C8.88391 13.9797 8.96616 14.0735 9.02733 14.1809L12.056 19.0264C12.3915 19.5617 13.2752 19.5617 13.6107 19.0264L16.6393 14.1809C16.7028 14.0784 16.7859 13.9896 16.8838 13.9194C16.9818 13.8492 17.0926 13.799 17.21 13.7717C17.3273 13.7445 17.4489 13.7407 17.5678 13.7605C17.6866 13.7804 17.8004 13.8236 17.9025 13.8875C18.0047 13.9512 18.0934 14.0344 18.1635 14.1323C18.2336 14.2302 18.2837 14.341 18.3109 14.4583C18.3381 14.5756 18.342 14.6972 18.3223 14.816C18.3025 14.9348 18.2596 15.0485 18.1958 15.1507L14.2193 21.5124C14.1277 21.6578 14.079 21.8263 14.079 21.9982C14.079 22.1701 14.1277 22.3386 14.2193 22.484L18.194 28.8457C18.2578 28.9478 18.3009 29.0614 18.3208 29.1802C18.3406 29.2989 18.3369 29.4204 18.3099 29.5377C18.2828 29.6549 18.2329 29.7658 18.163 29.8638C18.0931 29.9618 18.0046 30.0451 17.9025 30.1089C17.6945 30.2314 17.4474 30.2693 17.2123 30.2147C16.9771 30.1601 16.772 30.0172 16.6393 29.8155L13.6107 24.97C13.5275 24.8391 13.4125 24.7314 13.2766 24.6568C13.1406 24.5822 12.9879 24.5431 12.8328 24.5433C12.6777 24.5435 12.5252 24.5829 12.3894 24.6578C12.2536 24.7327 12.1389 24.8408 12.056 24.9719L9.02733 29.8174C8.89435 30.0187 8.68923 30.1613 8.45423 30.2159C8.21923 30.2704 7.97225 30.2328 7.76417 30.1107C7.66209 30.0469 7.57357 29.9636 7.50368 29.8656C7.43378 29.7676 7.38387 29.6568 7.35681 29.5395C7.32974 29.4222 7.32604 29.3007 7.34592 29.182C7.3658 29.0633 7.40887 28.9496 7.47267 28.8475ZM25.6667 22.9167H31.1667V26.5834H25.6667V22.9167ZM33 22.9167H42.1667V26.5834H33V22.9167ZM33 21.0834V17.4167H42.1667V21.0834H33ZM33 15.5834V11.9167H42.1667V15.5834H33ZM31.1667 15.5834H25.6667V11.9167H31.1667V15.5834ZM25.6667 28.4167H31.1667V32.0834H25.6667V28.4167ZM33 28.4167H42.1667V32.0834H33V28.4167ZM42.1667 10.0834H33V6.4167H42.1667V10.0834ZM31.1667 6.4167V10.0834H25.6667V6.4167H31.1667ZM25.6667 33.9167H31.1667V37.5834H25.6667V33.9167ZM33 37.5834V33.9167H42.1667V37.5834H33Z"
                      fill="#FFFFFF" />
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium ts-text">יצא לאקסל</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Search by card Filter   -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">
          <div class="filter-popup" id="date-range-popup" style="z-index: -1; direction: rtl;">
            <div class="mb-3">
              <form action="" method="POST">

                <label class="form-label">סינון לפי מספר כרטיס</label>

                <div class="input-icon mb-2">
                  <input class="form-control" name="magnetic_card_number_association" type="text"
                    placeholder="Search Card" />
                </div>
                <input type="hidden" name="magnetic_card_filter">
                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>

              </form>
            </div>
          </div>
          <div class="card-body-rounded p-1 m-1 filter-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <span id="date-range-popup-svg"
                  class="bg-white text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                  <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                      fill="black" />
                  </svg>
                </span>

                <?php
                if (isset($_POST["magnetic_card_number_association"])) {
                  ?>
                  <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                  <span class="current_filter">
                    <?php
                    echo $_POST["magnetic_card_number_association"];
                    ?>
                  </span>
                  <?php
                } ?>
              </div>
              <div class="col">
                <div class="font-weight-medium ts-text">סינון לפי מספר כרטיס</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Class Filter  -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">

          <div class="filter-popup" id="filter-stores-popup" style="z-index: -1;">
            <div class="" style="direction: rtl;">

              <form action="" method="POST">
                <label class="form-label">סינון שיעורים </label>

                <select name="lesson_array[]" type="text" class="form-select" placeholder="Select tags"
                  id="stores-select-tags" value="" multiple>

                  <?php
                  foreach ($pageData["members"] as $data) {

                    $lesson = $data['lesson'];
                    ?>
                    <option value="<?php echo $lesson; ?>">
                      <?php echo $lesson; ?>
                    </option>
                    <?php

                  }

                  ?>
                </select>
                <input type="hidden" name="lesson_filter" id="">
                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>

              </form>

            </div>

          </div>

          <div class="card-body-rounded p-1 m-1 filter-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <span id="filter-stores-popup-svg"
                  class="bg-white text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                  <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                      fill="black" />
                  </svg>
                </span>

                <?php
                if (isset($_POST["lesson_array"])) {
                  ?>
                  <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                  <span class="current_filter">
                    <?php
                    foreach ($_POST["lesson_array"] as $lesson_array) {
                      echo $lesson_array . '<br>';
                    }


                    ?>
                  </span>
                  <?php
                } ?>

              </div>
              <div class="col">
                <div class="font-weight-medium ts-text">סינון שיעורים</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Guy Name Filter -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">
          <div class="filter-popup" id="filter-guys-popup" style="z-index: -1;">
            <div class="" style="direction: rtl;">
              <form action="" method="POST">
                <label class="form-label">סינון בחורים</label>
                <select name="guyname_array[]" type="text" class="form-select" placeholder="Select tags"
                  id="guys-select-tags" value="" multiple>

                  <?php
                  foreach ($pageData["members"] as $data) {

                    $order_id = $data['full_name'];
                    ?>
                    <option value="<?php echo $order_id; ?>">
                      <?php echo $order_id; ?>
                    </option>
                    <?php

                  }

                  ?>

                </select>

                <input type="hidden" name="guy_name_filter">
                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>

              </form>
            </div>

          </div>
          <div class="card-body-rounded p-1 m-1 filter-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-white text-white avatar"
                  id="filter-guys-popup-svg"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                  <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1.75 7.62506H1.94525C2.24537 8.80423 2.92983 9.8498 3.89048 10.5966C4.85114 11.3434 6.03323 11.7488 7.25 11.7488C8.46677 11.7488 9.64886 11.3434 10.6095 10.5966C11.5702 9.8498 12.2546 8.80423 12.5547 7.62506H40.25C40.6147 7.62506 40.9644 7.48019 41.2223 7.22233C41.4801 6.96447 41.625 6.61473 41.625 6.25006C41.625 5.88538 41.4801 5.53565 41.2223 5.27779C40.9644 5.01992 40.6147 4.87506 40.25 4.87506H12.5547C12.2546 3.69588 11.5702 2.65031 10.6095 1.90353C9.64886 1.15676 8.46677 0.751343 7.25 0.751343C6.03323 0.751343 4.85114 1.15676 3.89048 1.90353C2.92983 2.65031 2.24537 3.69588 1.94525 4.87506H1.75C1.38533 4.87506 1.03559 5.01992 0.777728 5.27779C0.519866 5.53565 0.375 5.88538 0.375 6.25006C0.375 6.61473 0.519866 6.96447 0.777728 7.22233C1.03559 7.48019 1.38533 7.62506 1.75 7.62506ZM7.25 3.50006C7.7939 3.50006 8.32558 3.66134 8.77782 3.96352C9.23005 4.26569 9.58253 4.69518 9.79067 5.19768C9.99881 5.70017 10.0533 6.25311 9.94716 6.78655C9.84105 7.32 9.57914 7.81001 9.19454 8.1946C8.80995 8.5792 8.31995 8.84111 7.7865 8.94722C7.25305 9.05333 6.70012 8.99887 6.19762 8.79073C5.69512 8.58258 5.26563 8.23011 4.96346 7.77787C4.66128 7.32564 4.5 6.79396 4.5 6.25006C4.5 5.52071 4.78973 4.82124 5.30546 4.30551C5.82118 3.78979 6.52065 3.50006 7.25 3.50006ZM40.25 18.6251H40.0547C39.7546 17.4459 39.0702 16.4003 38.1095 15.6535C37.1489 14.9068 35.9668 14.5013 34.75 14.5013C33.5332 14.5013 32.3511 14.9068 31.3905 15.6535C30.4298 16.4003 29.7454 17.4459 29.4452 18.6251H1.75C1.38533 18.6251 1.03559 18.7699 0.777728 19.0278C0.519866 19.2856 0.375 19.6354 0.375 20.0001C0.375 20.3647 0.519866 20.7145 0.777728 20.9723C1.03559 21.2302 1.38533 21.3751 1.75 21.3751H29.4452C29.7454 22.5542 30.4298 23.5998 31.3905 24.3466C32.3511 25.0934 33.5332 25.4988 34.75 25.4988C35.9668 25.4988 37.1489 25.0934 38.1095 24.3466C39.0702 23.5998 39.7546 22.5542 40.0547 21.3751H40.25C40.6147 21.3751 40.9644 21.2302 41.2223 20.9723C41.4801 20.7145 41.625 20.3647 41.625 20.0001C41.625 19.6354 41.4801 19.2856 41.2223 19.0278C40.9644 18.7699 40.6147 18.6251 40.25 18.6251ZM34.75 22.7501C34.2061 22.7501 33.6744 22.5888 33.2222 22.2866C32.7699 21.9844 32.4175 21.5549 32.2093 21.0524C32.0012 20.5499 31.9467 19.997 32.0528 19.4636C32.1589 18.9301 32.4209 18.4401 32.8055 18.0555C33.1901 17.6709 33.6801 17.409 34.2135 17.3029C34.7469 17.1968 35.2999 17.2512 35.8024 17.4594C36.3049 17.6675 36.7344 18.02 37.0365 18.4722C37.3387 18.9245 37.5 19.4562 37.5 20.0001C37.5 20.7294 37.2103 21.4289 36.6945 21.9446C36.1788 22.4603 35.4793 22.7501 34.75 22.7501ZM40.25 32.3751H26.3048C26.0046 31.1959 25.3202 30.1503 24.3595 29.4035C23.3989 28.6568 22.2168 28.2513 21 28.2513C19.7832 28.2513 18.6011 28.6568 17.6405 29.4035C16.6798 30.1503 15.9954 31.1959 15.6953 32.3751H1.75C1.38533 32.3751 1.03559 32.5199 0.777728 32.7778C0.519866 33.0356 0.375 33.3854 0.375 33.7501C0.375 34.1147 0.519866 34.4645 0.777728 34.7223C1.03559 34.9802 1.38533 35.1251 1.75 35.1251H15.6953C15.9954 36.3042 16.6798 37.3498 17.6405 38.0966C18.6011 38.8434 19.7832 39.2488 21 39.2488C22.2168 39.2488 23.3989 38.8434 24.3595 38.0966C25.3202 37.3498 26.0046 36.3042 26.3048 35.1251H40.25C40.6147 35.1251 40.9644 34.9802 41.2223 34.7223C41.4801 34.4645 41.625 34.1147 41.625 33.7501C41.625 33.3854 41.4801 33.0356 41.2223 32.7778C40.9644 32.5199 40.6147 32.3751 40.25 32.3751ZM21 36.5001C20.4561 36.5001 19.9244 36.3388 19.4722 36.0366C19.0199 35.7344 18.6675 35.3049 18.4593 34.8024C18.2512 34.2999 18.1967 33.747 18.3028 33.2136C18.4089 32.6801 18.6709 32.1901 19.0555 31.8055C19.4401 31.4209 19.9301 31.159 20.4635 31.0529C20.997 30.9468 21.5499 31.0012 22.0524 31.2094C22.5549 31.4175 22.9844 31.77 23.2865 32.2222C23.5887 32.6745 23.75 33.2062 23.75 33.7501C23.75 34.4794 23.4603 35.1789 22.9445 35.6946C22.4288 36.2103 21.7293 36.5001 21 36.5001Z"
                      fill="black" />
                  </svg>
                </span>

                <?php
                if (isset($_POST["guyname_array"])) {
                  ?>
                  <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                  <span class="current_filter">
                    <?php
                    foreach ($_POST["guyname_array"] as $guyname_array) {
                      echo $guyname_array . '<br>';
                    }

                    ?>
                  </span>
                  <?php
                } ?>


              </div>
              <div class="col" style="z-index:1">
                <div class="font-weight-medium ts-text">סינון בחורים</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-x mt-3">
      <div class="resposive-table managing-guys-table" style="overflow-x: auto">
        <table class="table table-vcenter card-table">
          <tbody class="d-flex flex-column ts-text">
            <?php
            if (!empty($pageData["members"])) {
              $totalvouchers = 0;
              $totalGuys = count($pageData["members"]);
              foreach ($pageData["members"] as $key => $member) {
                $transactions_count = $voucher_transaction->get_voucher_transactions_by_member_id(array("member_id" => $member["id"], "status" => VOUCHER_STATUS_PENDING, "count" => true));
                $totalvouchers =  $totalvouchers+ $transactions_count;
                ?>
                <tr>
                  <td class="ts-date">
                    <div class="card card-sm bg-black ts-round" style="direction: rtl;" data-bs-toggle="modal"
                      data-bs-target="#community-member-guy-full-detail" onclick="populateOrderDetailModalFunction(this)"
                      data-member-details='<?php echo json_encode($member); ?>'
                      data-member-details='<?php echo json_encode($member); ?>'
                      data-voucher-details='<?php echo json_encode($member); ?>'>
                      <div class="card-body p-1 m-1">
                        <div class="row align-items-center">
                          <div class="col-auto">
                          </div>
                          <div class="col">
                            <div class="font-weight-medium ts-text ts-text-color" style="direction: rtl;">
                              לפרטים המלאים
                              ←</div>
                          </div>
                        </div>
                      </div>
                  </td>
                  <td class="text-muted ts-price data-vochers">מס’ שוברים פעילים: <span>
                      <?php echo $transactions_count; ?>
                    </span></td>
                  <td class="text-muted ts-product">
                    <a href="#" class="text-reset data: phone">מס’ טלפון: <span>
                        <?php echo $member["phone_number"]; ?>
                      </span></a>
                  </td>
                  <td class="text-muted ts-store-name data-lesson">שיעור: <span>
                      <?php echo $member["lesson"]; ?>
                    </span></td>
                  <td class="ts-guy-name">שם הבחור: </span>
                    <?php echo $member["full_name"]; ?><span>
                  </td>
                  <td> <svg data-bs-toggle="modal" data-bs-target="#edit-guy-form" width="40" height="40" onclick="populateOrderDetailModalFunction2(this)" data-member-details='<?php echo json_encode($member); ?>'
                      viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_0_2848)">
                        <path
                          d="M5.83334 39.9997H30.8333C32.3828 39.9953 33.8673 39.3763 34.9609 38.2786C36.0545 37.1809 36.668 35.6942 36.6667 34.1447V21.583C36.6667 21.141 36.4911 20.7171 36.1785 20.4045C35.866 20.0919 35.442 19.9163 35 19.9163C34.558 19.9163 34.1341 20.0919 33.8215 20.4045C33.5089 20.7171 33.3333 21.141 33.3333 21.583V34.1447C33.3356 34.8104 33.0736 35.4498 32.6049 35.9226C32.1362 36.3953 31.499 36.6628 30.8333 36.6663H5.83334C5.16762 36.6628 4.53051 36.3953 4.06181 35.9226C3.59311 35.4498 3.33112 34.8104 3.33334 34.1447V9.18801C3.33112 8.52229 3.59311 7.88289 4.06181 7.41013C4.53051 6.93737 5.16762 6.66987 5.83334 6.66634H18.3333C18.7754 6.66634 19.1993 6.49075 19.5118 6.17819C19.8244 5.86562 20 5.4417 20 4.99967C20 4.55765 19.8244 4.13372 19.5118 3.82116C19.1993 3.5086 18.7754 3.33301 18.3333 3.33301H5.83334C4.28384 3.33742 2.79939 3.95639 1.70576 5.05408C0.612136 6.15177 -0.00132849 7.63851 2.16018e-06 9.18801V34.1447C-0.00132849 35.6942 0.612136 37.1809 1.70576 38.2786C2.79939 39.3763 4.28384 39.9953 5.83334 39.9997Z"
                          fill="#01051D" />
                        <path
                          d="M15.7583 17.5733L14.4434 23.5967C14.3838 23.8699 14.394 24.1537 14.4729 24.4219C14.5519 24.6902 14.697 24.9342 14.895 25.1317C15.0957 25.3241 15.3399 25.4654 15.6068 25.5434C15.8738 25.6215 16.1556 25.634 16.4284 25.58L22.4384 24.2617C22.7504 24.1931 23.0362 24.0364 23.2617 23.81L38.4517 8.62C38.9161 8.15569 39.2844 7.60446 39.5358 6.99778C39.7871 6.39109 39.9165 5.74084 39.9165 5.08416C39.9165 4.42748 39.7871 3.77723 39.5358 3.17055C39.2844 2.56387 38.9161 2.01263 38.4517 1.54833C37.4997 0.638557 36.2335 0.130859 34.9167 0.130859C33.5999 0.130859 32.3337 0.638557 31.3817 1.54833L16.215 16.7533C15.9874 16.9773 15.8289 17.2619 15.7583 17.5733ZM33.7384 3.90666C34.0554 3.6029 34.4776 3.43332 34.9167 3.43332C35.3558 3.43332 35.7779 3.6029 36.095 3.90666C36.4033 4.22105 36.5761 4.64382 36.5761 5.08416C36.5761 5.52451 36.4033 5.94728 36.095 6.26166L34.9167 7.44L32.56 5.08333L33.7384 3.90666ZM18.905 18.7633L30.195 7.445L32.5284 9.79L21.2334 21.1117L18.2417 21.7683L18.905 18.7633Z"
                          fill="#01051D" />
                      </g>
                      <defs>
                        <clipPath id="clip0_0_2848">
                          <rect width="40" height="40" fill="white" />
                        </clipPath>
                      </defs>
                    </svg> </td>
              </tr>
                <?php
              } ?>
            <?php } else {
              echo "No Data Found";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-12">
      <div class="container p-0">
        <div class="card-x">
          <div class="card-body my-3 bg-black rounded-3 p-2">
            <ul class="pagination p-1">
              <li class="page-item page-prev disabled">
                <div class="page-item-subtitle text-white mx-4" style="font-size: 20px">
                  סה”כ שוברים: <?php echo $totalvouchers;?>
                </div>
              </li>

              <li class="page-item page-next">
                <div class="page-item-title text-white mx-4" style="font-size: 20px">
                  סה”כ בחורים: <?php echo $totalGuys;?>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </body>




    <script>
      function buyVoucher(voucher) {
        voucher = JSON.parse(voucher)

        console.log(voucher)
        jQuery('#store-manager-voucher-purchase').modal('show');

        let modal = document.querySelector('#store-manager-voucher-purchase');
        let member_id = document.querySelector('#member_id').value;
        modal.querySelector('#voucher_name').innerHTML = voucher.product_name;
        modal.querySelector('#transaction_amount').value = voucher.voucher_price;
        modal.querySelector('#voucher_id').value = voucher.id;
        modal.querySelector('#community_member_id').value = member_id;
      }


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




    <script>

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

      var tableData = document.getElementById('guy-transaction-history');

      function addSection(transaction_type, transaction_amount, transaction_date) {

        const dateObj = new Date(transaction_date);
        const day = dateObj.getDate().toString().padStart(2, '0');
        const month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
        const year = dateObj.getFullYear().toString();
        date = `${day}/${month}/${year}`;
        var section = `
        <tr>
          <td><strong>סוג העסקה: </strong>${transaction_type}</td>
          <td><strong>סכום: </strong>${transaction_amount} ₪</td>
          <td><strong>תאריך: </strong>${date}</td>
        </tr> `;
        tableData.insertAdjacentHTML('beforeend', section);
      }

      function addSection_2(transaction_type, transaction_amount, transaction_date) {

        const dateObj = new Date(transaction_date);
        const day = dateObj.getDate().toString().padStart(2, '0');
        const month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
        const year = dateObj.getFullYear().toString();
        date = `${day}/${month}/${year}`;
        var section = `
                        <tr>
                            <td><strong>סוג העסקה: </strong>${transaction_type}</td>
                            <td><strong>שובר : </strong>${transaction_amount} ₪</td>
                            <td><strong>תאריך: </strong>${date}</td>
                          </tr>`;
        tableData.insertAdjacentHTML('beforeend', section);
      }

      function populateOrderDetailModalFunction(button) {

        var orderDetails = button.getAttribute('data-member-details');
        var parsedDetails = JSON.parse(orderDetails);

        var id = parsedDetails.id;
        var is_active = parsedDetails.is_active;
        var created_at = parsedDetails.created_at;
        var updated_at = parsedDetails.updated_at;
        var wp_user = parsedDetails.wp_user;
        var community_id = parsedDetails.community_id;
        var full_name = parsedDetails.full_name;
        var phone_number = parsedDetails.phone_number;
        var email_address = parsedDetails.email_address;
        var lesson = parsedDetails.lesson;
        var id_number = parsedDetails.id_number;
        var wp_user_id = parsedDetails.wp_user_id;
        var address = parsedDetails.address;
        var magnetic_card_number_association = parsedDetails.magnetic_card_number_association;
        var card_balance = parsedDetails.card_balance;

        document.getElementById("guy_name").innerHTML = full_name;
        document.getElementById("guy_no").innerHTML = phone_number;
        document.getElementById("guy_email").innerHTML = email_address;
        document.getElementById("guy_id_no").innerHTML = id_number;
        document.getElementById("guy_magnetic_card_no").innerHTML = magnetic_card_number_association;
        tableData.innerHTML = "";

        var memberVouchers = document.getElementById("guy-voucher-data")

        memberVouchers.querySelector('#member_id').value = id;

        jQuery.ajax({
          url: "<?php echo admin_url('admin-ajax.php'); ?>",
          type: 'POST',
          data: {
            action: 'csvp_ajax', // Action hook
            csvp_request: 'CSVP_Transaction', // Action hook
            csvp_handler: 'get_transactions_by_community_member_id', // Action hook
            data: {
              id: id
            }
          },
          success: function (response) {
            // Handle success response
            console.log(response);
            response.forEach(function (item) {
              addSection(item.transaction_type, item.transaction_amount, item.transaction_date);
            });
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
            csvp_request: 'CSVP_VoucherTransaction', // Action hook
            csvp_handler: 'get_voucher_transactions_by_member_id', // Action hook
            data: {
              member_id: id
            }
          },
          success: function (response) {
            // Handle success response
            console.log(response);
            response.forEach(function (item) {
              addSection_2(item.transaction_type, item.transaction_amount, item.transaction_date);
            });
          },
          error: function (xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
          }
        });




      }


      function populateOrderDetailModalFunction2(button) {

          var orderDetails = button.getAttribute('data-member-details');
          var parsedDetails = JSON.parse(orderDetails);

          var id = parsedDetails.id;
          var is_active = parsedDetails.is_active;
          var created_at = parsedDetails.created_at;
          var updated_at = parsedDetails.updated_at;
          var wp_user = parsedDetails.wp_user;
          var community_id = parsedDetails.community_id;
          var full_name = parsedDetails.full_name;
          var phone_number = parsedDetails.phone_number;
          var email_address = parsedDetails.email_address;
          var lesson = parsedDetails.lesson;
          var id_number = parsedDetails.id_number;
          var wp_user_id = parsedDetails.wp_user_id;
          var address = parsedDetails.address;
          var magnetic_card_number_association = parsedDetails.magnetic_card_number_association;
          var card_balance = parsedDetails.card_balance;

          document.getElementById("email_address_edit").value = email_address;
          document.getElementById("phone_number_edit").value = phone_number;
          document.getElementById("full_name_edit").value = full_name;
          document.getElementById("address_edit").value = address;
          document.getElementById("id_number_edit").value = id_number;
          document.getElementById("lesson_edit").value = lesson;
          document.getElementById("magnetic_card_number_association_edit").value = magnetic_card_number_association;
          document.getElementById("community_member_id_edit").value = id;
          document.getElementById("community_member_id_delete").value = id;
          document.getElementById("user_id_edit").value = wp_user_id;
      }
    </script>