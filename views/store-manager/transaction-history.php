<?php include CSVP_PLUGIN_PATH . "views/store-manager/header.php" ?>

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
    width: 300px;
  }

  .ts-price {
    width: 15%;
  }

  .ts-date {
    width: 20%;
  }

  .ts-product {
    width: 20%;
  }

  .ts-store-name {
    width: 25%;
  }

  .ts-guy-name {
    width: 24%;
  }

  .ts-text {
    text-align: right;
    font-size: 20px;
    font-weight: 600;
  }

  .ts-text-normal {
    text-align: right;
    font-size: 20px;
    font-weight: normal;
  }

  .store-manager-transaction-history-table tr {
    display: flex;
    flex-direction: row-reverse;

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

  @media screen and (max-width: 775px) {
    .ts-price {
      width: 110px;
    }

    .ts-date {
      width: 240px;
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
      width: 875px;
    }
  }
</style>
<div class="container p-0">

  <div class="container col-12 mt-5">

    <!-- Filter Bar -->
    <div
      class="row row-cards justify-content-sm-around gap-sm-3 gap-3 gap-lg-0 justify-content-lg-center bg-black px-2 py-3 m-0 rounded-3">



      <!-- CSV Download Filter  -->
      <div class="col-sm-5 col-lg-3 m-0" style="cursor: pointer;"
        onclick='outToExcel( <?php echo isset($pageData["transactions"]) ? json_encode($pageData["transactions"]) : "[]"; ?>)'>
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

      <!-- Date Range Filter   -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">
          <div class="filter-popup" id="date-range-popup" style="z-index: -1; direction: rtl;">
            <div class="mb-3">
              <form action="" method="post">
                <label class="form-label">Select Date</label>

                <input type="hidden" name="order_range_filter">

                <div class="input-icon mb-2">
                  <input class="form-control " placeholder="Select first date" id="first-datepicker-icon"
                    name="first_date" value="" />

                  <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                      <path d="M16 3v4" />
                      <path d="M8 3v4" />
                      <path d="M4 11h16" />
                      <path d="M11 15h1" />
                      <path d="M12 15v3" />
                    </svg>
                  </span>
                </div>


                <div class="input-icon mb-2">
                  <input class="form-control " placeholder="Select second date" id="second-datepicker-icon"
                    name="second_date" value="" />

                  <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                      <path d="M16 3v4" />
                      <path d="M8 3v4" />
                      <path d="M4 11h16" />
                      <path d="M11 15h1" />
                      <path d="M12 15v3" />
                    </svg>
                  </span>
                </div>


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
                if (isset($_POST["first_date"])) {
                  ?>
                  <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                  <span class="current_filter">
                    <?php
                    echo $_POST["first_date"] . '<br>';
                    echo $_POST["second_date"];

                    ?>
                  </span>
                  <?php
                } ?>


              </div>
              <div class="col">
                <div class="font-weight-medium ts-text">טווח תאריכים</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Community Filter  -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">

          <div class="filter-popup" id="filter-stores-popup" style="z-index: -1;">


            <form action="" method="POST">
              <div class="" style="direction: rtl;">
                <label class="form-label">סינון תת”ים</label>
                <select name="community_array[]" type="text" class="form-select" placeholder="Select tags"
                  id="stores-select-tags" value="" multiple>

                  <?php
                  foreach ($pageData["transactions"] as $data) {

                    $community_name = $data['community_data']->community_name;
                    ?>
                    <option value="<?php echo $community_name; ?>">
                      <?php echo $community_name; ?>
                    </option>
                    <?php

                  }
                  ?>

                </select>
                <input type="hidden" name="filter_by_community">
                <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>
              </div>
            </form>


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
                if (isset($_POST["community_array"])) {
                  ?>
                  <span id="reloadButton" class="reset badge bg-red text-red-fg">reset</span>
                  <span class="current_filter">
                    <?php
                    foreach ($_POST["community_array"] as $community_array) {
                      echo $community_array . '<br>';
                    }

                    ?>
                  </span>
                  <?php
                } ?>



              </div>
              <div class="col">
                <div class="font-weight-medium ts-text">סינון תת”ים</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Guy Filter -->
      <div class="col-sm-5 col-lg-3 m-0">
        <div class="card card-sm p-relative" style="position: relative;">
          <div class="filter-popup" id="filter-guys-popup" style="z-index: -1;">
            <div class="" style="direction: rtl;">
              <label class="form-label">סינון לקוחות</label>
              <select type="text" class="form-select" placeholder="Select tags" id="guys-select-tags" value="" multiple>
                <option value="HTML">HTML</option>
                <option value="JavaScript">JavaScript</option>
                <option value="CSS">CSS</option>
                <option value="jQuery">jQuery</option>
                <option value="Bootstrap">Bootstrap</option>
                <option value="Ruby">Ruby</option>
                <option value="Python">Python</option>
              </select>
              <button type="submit" class="btn btn-primary bg-black mt-3">Filter</button>
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
              </div>
              <div class="col" style="z-index:1">
                <div class="font-weight-medium ts-text">סינון לקוחות</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Content -->
    <div class="card-x mt-3 store-manager-transaction-history-table">
      <div style="overflow-x: auto; direction: rtl;">
        <table class="table table-vcenter card-table">
          <tbody class="d-flex flex-column ts-text">
            <?php
            $order_count = 0;
            $order_total = 0;
            if (isset($pageData["transactions"])) {

              foreach ($pageData["transactions"] as $transaction) {
                if (isset($transaction["voucher_data"])) {


                  $date = new DateTime($transaction['created_at']);
                  // Format the date according to the desired format
                  $formattedDate = $date->format('d/m/Y');
                  $order_count = $order_count + 1;
                  $order_total = $order_total + $transaction['transaction_amount'];
                  ?>
                  <tr>
                    <td class="ts-date">תאריך:
                      <?php echo $formattedDate; ?>
                    </td>
                    <td class="text-muted ts-price">
                      <?php echo $transaction['transaction_amount']; ?> ₪
                    </td>
                    <td class="text-muted ts-product">
                      מוצר:
                      <?php echo $transaction["voucher_data"]->product_name; ?>
                    </td>
                    <td class="text-muted ts-store-name">שם הת”ת: <span class="ts-text-normal">
                        <?php echo $transaction["community_data"]->community_name; ?>
                      </span> </td>
                    <td class="ts-guy-name ">שם הלקוח:<span class="ts-text-normal">
                        <?php echo $transaction["member_data"]->full_name; ?>
                      </span></td>
                  </tr>
                  <?php
                } else {

                  $date = new DateTime($transaction['created_at']);
                  // Format the date according to the desired format
                  $formattedDate = $date->format('d/m/Y');
                  $order_count = $order_count + 1;
                  $order_total = $order_total + $transaction['transaction_amount'];
                  ?>
                  <tr>
                    <td class="ts-date">תאריך:
                      <?php echo $formattedDate; ?>
                    </td>
                    <td class="text-muted ts-price">
                      <?php echo $transaction['transaction_amount']; ?> ₪
                    </td>
                    <td class="text-muted ts-product">
                      מוצר:
                      <?php echo 'Walk Order'; ?>
                    </td>
                    <td class="text-muted ts-store-name">שם הת”ת: <span class="ts-text-normal">
                        <?php echo $transaction["community_data"]->community_name; ?>
                      </span> </td>
                    <td class="ts-guy-name ">שם הלקוח:<span class="ts-text-normal">
                        <?php echo $transaction["member_data"]->full_name; ?>
                      </span></td>
                  </tr>

                <?php }
              }
            } ?>

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
                <a aria-disabled="true">
                  <div class="page-item-subtitle text-white mx-4" style="font-size: 20px">
                    סה”כ הזמנות:
                    <?php echo $order_count; ?>
                  </div>
                </a>
              </li>

              <li class="page-item page-next disabled">
                <a tabindex="-1" aria-disabled="true">
                  <div class="page-item-title text-white mx-4" style="font-size: 20px">
                    סה”כ שווי הזמנות:
                    <?php echo $order_total; ?>₪
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
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
      element: document.getElementById('first-datepicker-icon'),
      buttonText: {
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
    }));
  });
  // @formatter:on


  // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
    window.Litepicker && (new Litepicker({
      element: document.getElementById('second-datepicker-icon'),
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