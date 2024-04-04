<?php include CSVP_PLUGIN_PATH . "views/community-member/header.php" ?>
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
    width: 100%;
    height: 55px;
    top: 240px;
    left: 31px;
    padding: 14px, 77px, 14px, 76px;
    border-radius: 10px;
    font-size: 20px;
    font-weight: 600;
    line-height: 27px;
    letter-spacing: 0em;
    text-align: center;

  }

  .btn-brown {
    background-color: #BC9B63;
    border: none;
  }

  .btn-dark {
    background-color: #01051D !important;
    border: none;
  }

  .btn-red {

    border: none;
    background-color: #9D0000 !important;
  }

  .product-information tr td {
    font-size: 16px;
    font-weight: 300;
    line-height: 22px;
    letter-spacing: 0em;
    text-align: right;
  }

  .card-footer-text {
    font-size: 20px;
    font-weight: 400;
    line-height: 27px;
    letter-spacing: 0em;
    text-align: center;
    direction: rtl;
  }

  .order-management-cards {
    width: 32%;
  }


  /* width */
  ::-webkit-scrollbar {
    width: 20px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: red;
    border-radius: 10px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #b30000;
  }

  .btn-gray,
  .btn-gray:hover {
    background-color: #E4E4E4;
    border: none;
  }


  .ts-text {
    text-align: right;
    font-size: 20px;
    font-weight: 600;
  }


  @media screen and (max-width: 1275px) {
    .order-management-cards {
      width: 47%;
    }

  }



  @media screen and (max-width: 767px) {
    .order-management-cards {
      width: 100%;
    }

  }


  @media screen and (max-width: 480px) {
    .order-management-cards {
      width: 100%;
    }

    .product-information tr td {
      font-size: 13px;
    }

  }






  /*Shop Details Modal style Starts here  */


  #community-member-shop-details-popup img {
    width: 100%;
    object-fit: cover;
    height: 300px;
  }

  #community-member-shop-details-popup .inner {
    background: url(/images/Coupon\ image.png);
    height: 203px;
    border-radius: 24px 20px 0 0px;
    border: none;
    width: 100%;
  }

  #community-member-shop-details-popup .inner2 {
    background: url(/images/Coupon\ image\ \(1\).png);
    height: 203px;
    border-radius: 24px 20px 0 0px;
    border: none;
    width: 100%;
  }

  #community-member-shop-details-popup .card-content {
    background-color: white;
    width: 250px;
    height: 350px;
    border-radius: 10px;
  }

  #community-member-shop-details-popup .body2 {
    background-color: #F1F1F1;
    width: 100%;
    overflow-y: scroll;
    height: 600px;
    margin: auto;
    text-align: center;
  }

  #community-member-shop-details-popup .card1 {
    font-weight: 400 !important;
    font-size: 20px !important;
  }

  #community-member-shop-details-popup .card123 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 80%;
    margin: auto;
    font-weight: 600;
    /* padding: 20% auto !important; */
    gap: 30px;
    /* padding: 14x 10 0px 0px; */
    padding-bottom: 30px;
  }

  #community-member-shop-details-popup .card123e {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    width: 80%;
    margin: auto;
    font-weight: 600;
    padding: 20% auto !important;
    gap: 30px;
    padding: 104px 0;
  }

  #community-member-shop-details-popup .card-title {
    font-size: small;
  }

  #community-member-shop-details-popup .imager {
    width: 20%;
    height: 100%;
    left: 0;
    margin-right: 300px;
    border-radius: 10px 0px 0px 10px;
  }

  #community-member-shop-details-popup .black-nav ul {
      display: flex;
    justify-content: space-between;
    list-style-type: none;
    gap: 10px;
    direction: rtl;
    flex-direction: row-reverse;
    flex-wrap: wrap;
    }
  #community-member-shop-details-popup .phone {
    font-family: Noto Sans Hebrew;
    font-size: 20px;
    font-weight: 600;
    line-height: 27px;
    letter-spacing: 0em;
    text-align: right;
    text-align: right;
    margin-top: -35px;
    margin-right: 12px;
    color: #f9f8c7;
  }

  #community-member-shop-details-popup .vf {
    top: 147px;
    left: 29px;
    border-radius: 20px;
  }

  #community-member-shop-details-popup .card-title3 {
    display: inline-flex;
    justify-content: space-between !important;
    gap: 40px !important;
    font-weight: 600;
    font-size: 20;
    font-family: Noto Sans Hebrew;
    line-height: 15px;
  }

  #community-member-shop-details-popup .phone2 {
    font-family: Noto Sans Hebrew;
    font-size: 20px;
    font-weight: 600;
    line-height: 27px;
    letter-spacing: 0em;
    text-align: right;

    text-align: right;
    margin-top: -35px;
    margin-right: 12px;
    color: #000000;
  }

  #community-member-shop-details-popup .card {
    border: none;
  }

  @media only screen and (max-width: 870px) {
    #community-member-shop-details-popup .body2 {
      background-color: #F1F1F1;
      width: 100% !important;
      margin-top: 47px !important;
      left: 29px;
      overflow-y: scroll;
      height: auto;
      margin: auto;
      padding: auto;
    }

    #community-member-shop-details-popup img {
      width: 100%;
      object-fit: cover;
    }

    #community-member-shop-details-popup .card123 {
      grid-template-columns: 1fr 1fr;
      overflow-y: scroll;
      width: 100% !important;
      margin: auto;
      font-weight: 600;
      gap: 20px !important;
    }

    #community-member-shop-details-popup .card123e {
      grid-template-columns: 1fr;
      overflow-y: scroll;
      width: 100%;
      margin: auto 25px;
      font-weight: 600;
      gap: 20px;
    }

    #community-member-shop-details-popup .card-content {
      background-color: white !important;
      width: 360px;
      height: 400px;
      margin: auto;
      border-radius: 20px;
    }

    #community-member-shop-details-popup .imager {
      width: 20%;
      height: 100%;
      left: 0;
      margin-right: 300px;
      border-radius: 12px 0px 0px 10px;
      border: none;
    }

    #community-member-shop-details-popup body {
      margin: 0;
    }

    #community-member-shop-details-popup .div-h {
      border: none !important;
    }

 
    #community-member-shop-details-popup .black-nav {
      width: 100% !important;
      height: 250px !important;
      margin: 25px auto !important;
      border-radius: 10px;
      background-color: #01051D;

    }

    #community-member-shop-details-popup .black-nav ul li input {
      background: none;
      margin-top: 10px;
      border: none;
      direction: rtl;
      color: white;
      /* margin-right: 80px; */
      border-bottom: 1px solid white;
      width: 100% !important;
      height: 30px;
      text-decoration: none;
      float: right;
      padding: 50px auto !important;
      font-size: 20px !important;
      font-weight: 600;
    }

    #community-member-shop-details-popup .black-nav li {
      width: 100% !important;
    }

    #community-member-shop-details-popup .black-nav ul li button {
      float: right;
      display: inline-flex;
      justify-content: space-around;
      text-align: center;
      align-items: center;
      font-weight: 600;
      font-size: 20px;
      text-decoration: none;
      border: none;
      width: 100% !important;
      height: 90%;
      margin: 5% 1px;
      border-radius: 10px;
      background-color: #ffffff;
    }
  }

  @media only screen and (max-width: 700px) {
    #community-member-shop-details-popup .body2 {
      width: 100% !important;
      margin-top: 47px !important;
      left: 29px;
      overflow-y: scroll;
      height: auto;
      margin: auto;
      padding: auto;
    }

    #community-member-shop-details-popup .card123 {
      grid-template-columns: 1fr;
      overflow-y: scroll;
      width: 100% !important;
      margin: auto;
      font-weight: 600;
      gap: 30px;
    }

    #community-member-shop-details-popup .card123e {
      grid-template-columns: 1fr;
      overflow-y: scroll;
      width: 100%;
      margin: auto 25px;
      font-weight: 600;
      gap: 30px;
    }

    #community-member-shop-details-popup .card-content {
      background-color: #f8f8f8;
      width: 300px;
      height: 400px;
      margin: auto;
      border-radius: 20px;
    }

    #community-member-shop-details-popup .imager {
      width: 20%;
      height: 100%;
      left: 0;
      margin-right: 300px;
      border-radius: 12px 0px 0px 10px;
      border: none;
    }

    #community-member-shop-details-popup body {
      margin: 0;
    }

    #community-member-shop-details-popup .div-h {
      border: none !important;
    }



    #community-member-shop-details-popup .black-nav {
      width: 100% !important;
      height: 250px !important;
      margin: 25px auto !important;
      border-radius: 10px;
      background-color: #01051D;

    }

    #community-member-shop-details-popup .black-nav li {
      width: 100% !important;
    }

    #community-member-shop-details-popup .black-nav ul li button {
      float: right;
      display: inline-flex;
      justify-content: space-around;
      text-align: center;
      align-items: center;
      font-weight: 600;
      font-size: 20px;
      text-decoration: none;
      border: none;
      width: 100% !important;
      height: 90%;
      margin: 5% auto !important;
      border-radius: 10px;
    }
  }



  #community-member-shop-details-popup .black-nav {
    width: 100% !important;
    background-color: #01051D;

  }

  #community-member-shop-details-popup .black-nav ul li button {
    float: right;
    display: inline-flex;
    justify-content: space-around;
    text-align: center;
    align-items: center;
    font-weight: 600;
    font-size: 20px;
    text-decoration: none;
    border: none;
    color: white;
    width: 278px;
    height: 50px;
    margin: 9px 0;
    float: left;
    border-radius: 10px;
    background: none;
  }

  #community-member-shop-details-popup .btn-my {
    float: right;
    display: inline-flex;
    justify-content: space-around;
    text-align: center;
    color: #000000 !important;
    align-items: center;
    font-weight: 600;
    font-size: 20px;
    text-decoration: none;
    border: none;
    padding: 10px 0;
    width: 278px !important;
    height: 55px;
    border-radius: 10px;
    background-color: #E4E4E4 !important;
  }

  #community-member-shop-details-popup .black-nav ul li svg {
    height: 28px;
  }
</style>

<div class="container">




  <!-- shop-details modal Starts here -->

  <div class="modal fade" id="community-member-shop-details-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
      <div class="modal-content p-4" style="direction: rtl; overflow-y: auto; overflow-y: hidden;">


        <img src="/images/Shop logo in order.png" alt="">
        <div class="body2" style="">
          <nav class="black-nav">
            <ul>
              <li><a href="" class="btn-my mt-2" id="call_btn">חייגו לחנות ←</a></li>
              <li><button class="">כתובהחנות:<span id="store_address"></span></button></li>
              <li><button class="">שם החנות: <span id="store_name"></span></button></li>
            </ul>
          </nav>
          <div class="card123" id="vouchers">
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="store-manager-voucher-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal modal-dialog-centered modal-dialog-scrollable ">
    <div class="modal-content p-4" style="direction: rtl">
      <h3>Do you wish to purchase <span id="voucher_name"></span> for <span id="voucher_price"></span></h3>

      <div class="add-new-benefit-buttons mt-4">
        <form method="POST" action="">
          <input type="hidden" name="voucher_id" id="voucher_id">
          <input type="hidden" name="csvp_request" value="purchase_voucher">
          <input type="hidden" name="community_member_id" id="community_member_id">
          <input type="hidden" name="transaction_amount" id="transaction_amount">
          <input type="submit" class="btn btn-primary bg-black w-25" value="אישור">
          <button type="button" onclick="closeModal('store-manager-voucher-delete')"class="btn btn-danger w-25">ביטול</button>
        </form>
      </div>

    </div>
  </div>
</div>
<!--  shop-details modal ends here -->

<div class="d-flex flex-row gap-3 mt-3 flex-wrap" style="margin-left: 10px;">
  <?php foreach ($pageData["shops"] as $key => $request) {
  ?>

    <div class="card order-management-cards col-xl-4 rounded-3">
      <!-- Photo -->

      <div class="" style="background-image: url(media/shop-logo1.png); background-size: cover; border-top-left-radius: 8px; border-top-right-radius: 8px; height: 200px; background-repeat: no-repeat; background-position: center;">
        <!-- <img src="media/shop-logo1.png" style="object-fit: cover; width: 100%; height: 150px;" alt=""> -->
      </div>


      <p class="card-footer-text pt-4 pb-0 m-0">
        <strong>שם החנות:</strong> <?php echo $request->store_data->store_name; ?><br>
        <strong>כתובת החנות:</strong> <?php echo $request->store_data->store_address; ?>
      </p>

      <div class="card-body px-3 m-auto">
        <div class="d-flex flex-column gap-3">
          <a href="tel:<?php echo $request->store_data->store_phone; ?>" class="btn btn-gray">← חייגו לחנות</a>
          <button class="btn btn-dark" onclick='loadStoreModal(<?php echo json_encode($request); ?>)'>← לשוברי החנות</button>
        </div>

      </div>

    </div><?php
        } ?>



</div>

</div>
</div>
<script>
  function closeModal(modalId) {
    // Use jQuery to select the modal and call the Bootstrap modal method to hide it
    jQuery('#' + modalId).modal('hide');
}
  function loadStoreModal(storeData) {
    jQuery('#community-member-shop-details-popup').modal('show');
    console.log(storeData)

    let modal = document.querySelector('#community-member-shop-details-popup');
    modal.querySelector("#call_btn").href = `tel:${storeData.store_data.store_phone}`;
    modal.querySelector("#store_name").innerHTML = storeData.store_data.store_name;
    modal.querySelector("#store_address").innerHTML = storeData.store_data.store_address;
    modal.querySelector("img").src = `https://placehold.co/800x300?text=${storeData.store_data.store_name}&font=roboto`;

    console.log('')
    // Assuming storeData is an array containing the voucher data
    let vouchersHTML = storeData.vouchers.map((voucher) => {
      let product_image = '<?php echo home_url(); ?>/wp-content/uploads' + voucher.product_image;
      return `
        <div class="card1">
            <div class="card-bodyer">
                <div class="card card-content ">
                    <div class="inner"></div>
                    <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(${product_image})"></div>
                    <div class="card-body">
                        <h3 class="card-title">${voucher.product_name}</h3>
                        <h3 class="card-title">${voucher.voucher_price}₪ במקום ${voucher.normal_price}₪</h3>
                        <div class=" mx-auto h-32" style=" background-color: #01051D; width: 200px; height: 40px; border-radius: 10px; margin-top: 50px;">
                            <h5 class="phone" onclick='buyVoucher(${JSON.stringify(voucher)}, "<?php echo $community_member->get_community_member_by_user_id(array('wp_user_id' => get_current_user_id()))->id; ?>")'">לרכישת השובר ←</h5>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>`;
    });

    modal.querySelector("#vouchers").innerHTML = vouchersHTML;


  }

  function buyVoucher(voucher, member_id) {
    console.log(voucher)
    jQuery('#store-manager-voucher-delete').modal('show');

    let modal = document.querySelector('#store-manager-voucher-delete');
    modal.querySelector('#voucher_name').innerHTML = voucher.product_name;
    modal.querySelector('#voucher_price').innerHTML = voucher.voucher_price;
    modal.querySelector('#transaction_amount').value = voucher.voucher_price;
    modal.querySelector('#voucher_id').value = voucher.id;
    modal.querySelector('#community_member_id').value = member_id;
  }
</script>
</div>
</div>
</body>