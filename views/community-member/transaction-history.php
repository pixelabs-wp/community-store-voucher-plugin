 <?php include CSVP_PLUGIN_PATH."views/community-member/header.php" ?>

  <style>
      @import url("https://rsms.me/inter/inter.css");
      :root {
        --tblr-font-sans-serif: "Inter Var", -apple-system, BlinkMacSystemFont,
          San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }

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
        width: 25%;
      }

      .ts-date {
        width: 25%;
      }
      .ts-product {
        width: 25%;
      }
      .ts-store-name {
        width: 25%;
      }
      .ts-text {
        text-align: right;
        font-size: 20px;
        font-weight: 600;
      }
      .navbar {
        background: #e4e4e4;
      }
      /* @media screen and (max-width: 775px) {
        .ts-price {
          width: 110px;
        }

        .ts-date {
          width: 540px;
        }
        .ts-product {
          width: 290px;
        }
        .ts-store-name {
          width: 310px;
        }
      } */

      
        /* resonsive  */

        .community-member-transaction-history-table tr {
          display: flex;
          flex-direction: row-reverse;
        }

        @media screen and (max-width: 775px) {
        tr {
          width: 875px;
        }
      }
    </style>

    <div class="container p-0">
      
      <div class="container col-12 mt-5">
        <div class="card-x mt-3">
          <div class="community-member-transaction-history-table" style="overflow-x: auto; direction: rtl; ">
            <table class="table table-vcenter card-table">
              <tbody class="d-flex flex-column ts-text">
                <?php
                $total_acummulated = 0;
                foreach($pageData["data"]["transactions"] as $transaction)
                {
                  $total_acummulated = $total_acummulated + 1;
                  ?>
                  <tr>
                  <td class="ts-date">תאריך: <?php echo (new DateTime($transaction['transaction_date']))->format('d/m/Y'); ?></td>

                  <td class="text-muted ts-product">
                    שם החנות: <?php echo $transaction['store_data']->store_name; ?>
                  </td>
                  <td class="text-muted ts-price">סכום: ₪<?php echo $transaction['transaction_amount']; ?></td>
                  <td class="text-muted ts-store-name">סוג העסקה: ערך צבור</td>
                </tr>
                <?php } 
                $total_voucher = 0;
                 foreach($pageData["data"]["voucher_transactions"] as $voucher_transaction)
                {
                  $total_voucher = $total_voucher + 1;
                  ?>
                  
                <tr>
                  <td class="ts-date">תאריך: <?php echo (new DateTime($voucher_transaction['transaction_date']))->format('d/m/Y'); ?></td>
                  <td class="text-muted ts-price">שם החנות: <?php echo $voucher_transaction['store_data']->store_name; ?></td>
                  <td class="text-muted ts-product">
                    סוג השובר: <?php echo $voucher_transaction['voucher_data']->product_name; ?>
                  </td>
                  <td class="text-muted ts-store-name">
                    סוג העסקה: מימוש שובר
                  </td>
                </tr>
                <?php } ?>
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
                    <a
                      class="page-link"
                      href="#"
                      tabindex="-1"
                      aria-disabled="true"
                    >
                      <div
                        class="page-item-subtitle text-white mx-4"
                        style="font-size: 20px"
                      >
                        סה”כ עסקאות ערך צבור: <?php echo  $total_acummulated; ?>
                      </div>
                    </a>
                  </li>

                  <li class="page-item page-next">
                    <a class="page-link" href="#">
                      <div
                        class="page-item-title text-white mx-4"
                        style="font-size: 20px"
                      >
                        סה”כ עסקאות שוברים: <?php echo  $total_voucher; ?>
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