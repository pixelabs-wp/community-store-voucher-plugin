<?php include CSVP_PLUGIN_PATH . "views/system-admin/header.php" ?>


<style>
    .community-management-popup,
    .store-management-popup {
        display: none;
    }
</style>


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
        width: 24%;
    }

    .ts-date {
        width: 15%;
    }

    .ts-product {
        width: 25%;
    }

    .ts-store-name {
        width: 20%;
    }

    .ts-guy-name {
        width: 24%;
    }

    .ts-text {
        text-align: right;
        font-size: 20px;
        font-weight: 600;
    }


    .transaction-history-table {
        direction: rtl;
    }

    .transaction-history-table tr {
        display: flex;
        flex-direction: row-reverse;
    }


    @media screen and (max-width: 1200px) {
        .ts-price {
            width: 300px;
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
            width: 1000px;
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

    .ts-date button {
        font-size: 20px;
        font-weight: 300;
        border-radius: 100px;
    }


    .btn-markaspaid {
        background-color: rgba(249, 248, 199, 1);
    }

    .btn-paid {
        background-color: rgba(1, 5, 29, 1);
        color: white;
        cursor: context-menu;
    }

    .btn-paid:hover,
    .btn-paid:focus {
        background-color: #01051d;
        outline: none;
        color: white;
        cursor: context-menu;
    }
</style>


<div class="modal fade" id="mark-as-paid-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-4">
            <form action="" method="post">
                <h2 class="text-center">Do you want to accept it?</h2>
                <input type="hidden" name="csvp_request" value="accept_request">
                <input type="hidden" name="request_id" id="request_id">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <button class="w-25 btn text-white bg-dark" type="submit">Yes</button>
                    <button class="w-25 btn btn-outline" type="button">No</button>
                </div>
            </form>


        </div>
    </div>

</div>


<div class="container p-0">

    <div class="container col-12 mt-5">



        <!-- Filter Bar -->



        <div class="card-x mt-3">
            <div class="transaction-history-table" style="overflow-x: auto">
                <table class="table table-vcenter card-table">
                    <tbody class="d-flex flex-column ts-text">
                        <?php

                        foreach ($pageData["joining_request_data"] as $request) {
                        ?>
                            <tr>
                                <td class="ts-date  text-center">
                                    <?php if ($request->request_status == JOINING_REQUEST_STATUS_PENDING) {
                                    ?>
                                        <button class="btn btn-markaspaid" onclick='acceptRequest(<?php echo json_encode($request, JSON_UNESCAPED_SLASHES); ?>)'>Accept Request</button>

                                    <?php
                                    } else {
                                        echo $request->request_status;
                                    } ?>

                                </td>
                                <td>Date: <?php echo date('Y-m-d', strtotime($request->created_at)); ?></td>

                                <td class="text-muted ts-requested_by">Requested By: <?php echo $request->requested_by; ?></td>
                                <td class="text-muted ts-product">
                                    Store Name: <?php echo $request->store_data->store_name; ?>
                                </td>
                                <td class="text-muted ts-store-name">Community Name: <?php echo $request->community_data->community_name; ?></td>
                            </tr>
                        <?php
                        }

                        ?>




                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="col-12">
            <div class="container p-0">
                <div class="card-x">
                    <div class="card-body my-3 bg-black rounded-3 p-2">
                        <ul class="pagination p-1">
                            <li class="page-item page-prev disabled">
                                    <div class="page-item-subtitle text-white mx-4" style="font-size: 20px">
                                        סה”כ עסקאות במערכת: 87
                                    </div>
                            </li>

                            <li class="page-item page-next">
                                    <div class="page-item-title text-white mx-4" style="font-size: 20px">
                                        סה”כ חנויות: 450
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
</body>







<script>
    function acceptRequest(request) {
        console.log('data', request)

        jQuery('#mark-as-paid-confirmation').modal('show');

        document.querySelector('#request_id').value = request.id;

    }
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('guys-select-tags'), {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
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
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('stores-select-tags'), {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
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
    document.addEventListener("DOMContentLoaded", function() {
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