<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>Account</small>
                <small>Payable (AP)</small>
            </h1>
        </section>
        <section class="content">

            <div class="box box-success">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i> Payment Voucher</h3>
                </div>

                <div class="box-body">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <?php echo $kode ?>
                            </div>
                        </div>

                        <div class="portlet-body">


                            <form action="javascript:;" name="myFormA" onsubmit="return validateFormA()" method="post" id="form-entry" class="form-horizontal">
                                <div class="row">
                                    <div class="hidden">
                                        <label>No.Voucher</label>

                                        <div class="input-icon">
                                            <i class="fa fa-key font-green"></i>
                                            <input type="text" name="no_voucher" id="no_voucher"
                                                   class="form-control input" value="<?php echo $kode ?>" readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Date</label>

                                        <div class="input-group input-medium date date-picker"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input type="text" placeholder="Klik to open calender" class="form-control input" id="date" name="date" readonly="" required="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                             </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Bank Code</label>

                                        <div class="input-icon">
                                            <select id="bank_id" class="form-control select2" name="bank_id" required>
                                                <option value="" selected>--select bank code--</option>
                                                <?php
                                                foreach ($bank as $data) {
                                                    echo '<option id="' . $data->account_code . '" value="' . $data->bank_id . '" >'
                                                        . $data->account_code . ' - ' . $data->name .
                                                        '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tag</label>
                                        <div class="input-icon select2-bootstrap-prepend">
                                            <select id="multi-prepend" name="tag[]" class="form-control select2" multiple >
                                                <option></option>
                                                <?php
                                                foreach($tag as $t){
                                                    echo '<option value="'.$t->id.'">'.$t->name_tag.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Desription</label>
                                        <textarea class="form-control" name="description" id="description"
                                                  placeholder="Enter description of transaction"></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Currency</label>

                                        <div class="input-icon">
                                            <select id="curr_id" class="form-control select2" name="curr_id">
                                                <?php
                                                foreach ($curr->result_array() as $data) {
                                                    echo "<option value=" . $data["curr_id"] . " >"
                                                        . $data["curr_name"] .
                                                        "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Total</label>

                                        <div class="input-icon">
                                            <i class="fa fa-calculator font-green"></i>
                                            <input id="good" type="text" name="total"
                                                   class="form-control input text-right" placeholder="Total">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Exchange Rate</label>

                                        <div class="input-icon">
                                            <i class="fa fa-adjust font-green"></i>
                                            <input type="bank_id" name="kurs" id="kurs"
                                                   class="form-control input text-right" placeholder="Kurs" value=1>
                                        </div>
                                    </div>

                                </div>
                                <br>


                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Paid to</label>
                                        <div class="input-group">
                                            <input type="text" id="receive_from" class="form-control" placeholder="Paid to" readonly>
                                            <input type="hidden" id="receive_from_id" name="receive_from" class="form-control" placeholder="Receive from" readonly>
                                            <span class="input-group-btn">
                                                <button class="btn grey" type="button" data-target="#receive-from"
                                                        data-toggle="modal"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>No.Cek/Giro</label>
                                        <div class="input-icon">
                                            <i class="fa fa-dollar font-green"></i>
                                            <input type="text" name="no_cek" id="no_cek" class="form-control input"
                                                   placeholder="Cek/Giro Number">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label>GL Date</label>
                                        <div class="input-group input-medium date date-picker"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input type="text" placeholder="Klik to open calender"
                                                   class="form-control input" name="gl_date" readonly="">
                                                    <span class="input-group-btn">
                                                      <button class="btn default" type="button">
                                                          <i class="fa fa-calendar"></i>
                                                      </button>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <br>


                                <div class="box-body">
                                    <div class="page-content-inner">
                                        <table class="table table-bordered table-striped" id="table_detail">
                                            <thead>
                                            <tr>
                                                <th class="text-center hidden" width="100px">NO.VOUCHER</th>
                                                <th class="text-center" width="100px">ACCOUNT</th>
                                                <th class="text-center">DESCRIPTION</th>
                                                <th class="text-center" width="200px">DEBIT</th>
                                                <th class="text-center" width="200px">CREDIT</th>
                                                <th class="text-center" width="30px">#</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                            <th colspan="5">
                                                <a class="btn green red-stripe btn-xs" data-target="#static"
                                                   data-toggle="modal"><b> Add Detail</b> </a>
                                            </th>
                                            </tfoot>
                                        </table>
                                        <button type="button" class="btn red green-stripe pull-right" name="save"><i
                                                class="fa fa-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div> <!--/portlet-body-->

                    </div> <!--/portlet box blue-hoki-->
                </div> <!--/box-body-->

            </div> <!--/box box success-->

        </section>
    </div>
</div>
<!--modals coa-->
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-width="760" data-keyboard="false">
    <div align="center" class="modal-header">
        <label>CHART OF ACCOUNT (COA)</label>
    </div>
    <div class="modal-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0">
            <thead bgcolor="#E7505A">
            <tr>
                <th width="50px">COA ID</th>
                <th>DESCRIPTION</th>
                <th width="auto" style="text-align: center">POSITION</th>
                <th width="10px"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($coa as $c) {
                ?>
                <tr>
                    <td align="center"><?php echo $c->coa_id ?></td>
                    <td><?php echo $c->name_coa ?></td>
                    <td align="center"><?php echo $c->name ?></td>
                    <td align="center">
                        <a href="javascript:;">
                            <button type="button" class="btn red btn-xs select_coa"
                                    data-coa-id="<?php echo $c->coa_id ?>" name_coa="<?php echo $c->name_coa ?>"
                                    name="select"><i class="fa fa-plus-square "> </i>
                            </button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" form="form1" class="btn btn-outline dark">Cancel</button>
    </div>
</div>
<!--end of modals coa-->

<!-- Modal ALLERT -->
<div class="modal" id="myModal" tabindex="-1" data-backdrop="static" data-width="300" data-keyboard="false">
    <!-- Modal content-->
    <div class="modal-content">

        <div align="center" class="modal-body">
            <i class="fa fa-info-circle" style="color:red; font-size: 36px"></i>

            <p>All field must be filled out</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline dark" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<!--end of modal ALLERT-->
<!--Contact modal-->
<div id="receive-from" class="modal fade" tabindex="-1" data-backdrop="static" data-width="760" data-keyboard="false">
    <div align="center" class="modal-header">
        <label>CONTACT</label>
    </div>
    <div class="modal-body">
        <table id="example2" class="table table-striped table-bordered" cellspacing="0">
            <thead bgcolor="#1BBC9B">
            <tr>
                <th>NAME</th>
                <th>ADDRESS</th>
                <th width="100px">CONTACT</th>
                <th width="40px"  style="text-align: center">DEBTOR</th>
                <th width="40px"  style="text-align: center">CREDITOR</th>
                <th width="10px" style="text-align: center"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($contact as $c) {
                ?>
                <tr>
                    <td><?php echo $c->name ?></td>
                    <td><?php echo $c->address ?></td>
                    <td><?php echo $c->contact ?></td>
                    <td align="center">
                        <?php
                        if($c->is_debtor == 1){
                            echo '<p>&#10004</p>';
                        }
                        ?></td>
                    <td align="center">
                        <?php
                        if($c->is_creditor == 1){
                            echo '<p>&#10004</p>';
                        }
                        ?>
                    </td>
                    <td align="center">
                        <a href="javascript:;">
                            <button type="button" class="btn red btn-xs select-contact"
                                    contact-id="<?php echo $c->contact_id ?>" contact-name="<?php echo $c->name ?>"
                                    name="select-contact"><i class="fa fa-plus-square "> </i>
                            </button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" form="form1" class="btn btn-outline dark">Cancel</button>
    </div>
</div>
<!-- end of contact modal-->


<script type="text/javascript">
    var rowIndex = <?php echo (isset($rowIndex) ? $rowIndex : 0) ; ?>;

    var handleMask = function () {
        $(".mask_currency").inputmask("numeric", {
            radixPoint: ".",
            autoGroup: true,
            groupSeparator: ",",
            digits: 0,
            groupSize: 3,
            removeMaskOnSubmit: true,
            autoUnmask: true
        });
    }

    $('#good').inputmask("numeric", {
        radixPoint: ".",
        autoGroup: true,
        groupSeparator: ",",
        digits: 0,
        groupSize: 3,
        removeMaskOnSubmit: true,
        autoUnmask: true
    });


    //get data selected
    $(document).ready(function () {
        $('.select_coa').on("click", function () {
            console.log("coa-id" + $(this).attr("data-coa-id"));
        })
    });
    //new row
    var tbody = $('#table_detail').children('tbody')
    var table = tbody.length ? tbody : $('#table_detail');
    $('button[name="select"]').on('click', function () {

        var coaID = $(this).attr("data-coa-id");
        var name_coa = $(this).attr("name_coa");
        var desc = $('textarea[name="description"]').val();
        var newRowContent =
            "<tr>" +

            "<td align=\"center\"> <input type=hidden name=\"coa_id[]\"  id = \"coa_id\" value= " + coaID + ">  " + coaID + " </td>" +

            "<td> <textarea class=\"form-control\" placeholder=\"If this box empty, make sure to fill Header Description first than choose COA\">" + desc + "</textarea> </td>" +

            "<td><input type=\"text\" class=\"form-control input input-sm mask_currency text-right debit\" name=\"debit[]\" id=\"debit\"  value = 0 ></td>" +

            "<td><input type=\"text\" class=\"form-control input input-sm mask_currency text-right credit\" name=\"credit[]\" id=\"credit\" value = 0 ></td>" +

            "<td> <button  value=\"x\" onclick=\"deleteRow(this)\"  class=\"btn red btn-sm text-center\" ><i class=\"fa fa-remove\"></i></button> </td>" +
            "<td class=\"hidden\"> <input type=\"hidden\" name=\"no_vouc[]\" id=\"no_voucher\"  class=\"form-control input\" value=\"<?php echo $kode; ?>\"> </td>" +
            "</tr>";

        //Add row
        $('#table_detail tbody').append(newRowContent);
        rowIndex++;
        handleMask();
        $('#static').modal('hide');
    });


    //delete row
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    ;

    $(document).ready(function(){
        $('.select-contact').on("click", function (){
            var contact_name = $(this).attr("contact-name");
            var contact_id = $(this).attr("contact-id");
            document.getElementById("receive_from").value = contact_name;
            document.getElementById("receive_from_id").value = contact_id;
            $('#receive-from').modal('hide');
        })
    })

    //save
    $('button[name="save"]').on('click', function (e) {
        e.preventDefault();

        //TO CHECK DR CR BALANCE
        //1.SUM DEBIT
        var sums = $('.debit'); // this will need to be the class of the things you want to sum
        var sum_debit = 0;
        for (var i = 0; i < sums.length; i++) {
            sum_debit += parseFloat(sums[i].value);// or maybe parseFloat(sums[i].innerHTML)
        }
        $('#total-debit').val(sum_debit);
        //2. SUM CREDIT
        var sums2 = $('.credit'); // this will need to be the class of the things you want to sum
        var sum_credit = 0;
        for (var i = 0; i < sums2.length; i++) {
            sum_credit += parseFloat(sums2[i].value);// or maybe parseFloat(sums[i].innerHTML)
        }
        $('#total-credit').val(sum_credit);


        if (sum_debit == sum_credit) { //validate for dr cr balance
            var url = '<?php echo base_url('/index.php/ap/ap/input_ap');?>';
            $("#form-entry").attr("method", "post");
            $('#form-entry').attr('action', url).submit();
        } else {
            toastr.error('Debit & Credit not balance (' + (sum_debit - sum_credit) + ') ');
        }


    });


    $(document).ready(function () {
        $('#example').DataTable();
    });


    function validateFormA() {
        var x = document.forms["myFormA"]["bank_id"].value;
        var x = document.forms["myFormA"]["date"].value;
        var x = document.forms["myFormA"]["curr_id"].value;
        var x = document.forms["myFormA"]["description"].value;
        var x = document.forms["myFormA"]["total"].value;
        var x = document.forms["myFormA"]["kurs"].value;
        var x = document.forms["myFormA"]["receive_from"].value;
        var x = document.forms["myFormA"]["no_cek"].value;
        var x = document.forms["myFormA"]["gl_date"].value;
        if (x == "") {
            $('#myModal').modal('show');
            return false;
        }
    }

</script>