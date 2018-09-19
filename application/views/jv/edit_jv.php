<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                J<small>ournal</small> V<small>oucher</small>
            </h1>
        </section>
        <section class="content">

            <div class="box box-success">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i> Journal Voucher</h3>
                </div>

                <div class="box-body">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <?php foreach ($editjvh as $jvh) { ?>
                                <?php echo $jvh->no_voucher ?>
                            </div>
                        </div>

                        <div class="portlet-body">


                            <form action="javascript:;" method="post" id="form-entry" class="form-horizontal">
                                <div class="row">

                                    <input type="hidden" name="id" class="form-control input" value="<?php echo $jvh->id ?>" readonly>

                                    <input type="hidden" name="posted_no"  class="form-control input" value="<?php echo $jvh->posted_no ?>" readonly>

                                    <input type="hidden" name="id2"  class="form-control input" value="<?php echo $jvh->no_voucher ?>" readonly>

                                    <div class="hidden">
                                        <label>No.Voucher</label>
                                        <div class="input-icon">
                                            <i class="fa fa-key font-green"></i>
                                            <input type="text" name="no_voucher" id="no_voucher"  class="form-control input" value="<?php echo $jvh->no_voucher ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Date</label>
                                        <div class="input-icon">
                                            <i class="fa fa-calendar-plus-o font-green"></i>
                                            <input type="date" name="date" id="date" class="form-control input" value="<?php echo $jvh->date ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="single" class="control-label"><b>Bank Code</b></label>
                                        <div class="input-icon">
                                            <select id="bank_id" class="form-control select2" name ="bank_id" required>
                                                <option value="" selected >--select bank code-- </option>
                                                <?php
                                                foreach ($bank as $data){
                                                    echo '<option id="'.$data->account_code.'" value="'.$data->bank_id.'" >'
                                                        .$data->account_code.' - '.$data->name.
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
                                </div><br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Desription</label>
                                        <textarea class="form-control" name="description" id="description"   placeholder="Enter description of transaction" ><?php echo $jvh->description ?></textarea>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="single" class="control-label"><b>Currency</b></label>
                                        <div class="input-icon">
                                            <select id="curr_id" class="form-control select2" name ="curr_id">
                                                <?php
                                                foreach ($curr->result_array() as $data){
                                                    echo "<option value=". $data["curr_id"]." >"
                                                        .$data["curr_name"].
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

                                            <input type="text" name="total" id="good" value="<?php echo $jvh->total ?>" id="display" class="form-control input text-right" placeholder="Total" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Exchange Rate</label>
                                        <div class="input-icon">
                                            <i class="fa fa-adjust font-green"></i>
                                            <input type="bank_id" name="kurs" id="kurs" class="form-control input text-right" placeholder="Kurs" value="<?php echo $jvh->kurs ?>" >
                                        </div>
                                    </div>

                                </div><br>


                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Receive From/Paid to</label>
                                        <div class="input-icon">
                                            <i class=" fa fa-plus-square-o font-green"></i>
                                            <input type="text" name="receive_from" id="receive_from" class="form-control input" placeholder="Receive from" value="<?php echo $jvh->receive_from ?>">
                                        </div>
                                    </div>

<!--                                    <div class="col-md-4">-->
<!--                                        <label>No.Cek/Giro</label>-->
<!--                                        <div class="input-icon">-->
<!--                                            <i class="fa fa-dollar font-green"></i>-->
<!--                                            <input type="text" name="no_cek" id="no_cek" class="form-control input" placeholder="Cek/Giro Number" value="--><?php //echo $jvh->no_cek ?><!--">-->
<!--                                        </div>-->
<!--                                    </div>-->


                                    <div class="col-md-4">
                                        <label>GL.Date</label>
                                        <div class="input-icon">
                                            <i class="fa fa-calendar-plus-o font-green"></i>
                                            <input type="date" name="gl_date" id="gl_date" class="form-control input" placeholder="General Ledger Date" value="<?php echo $jvh->gl_date ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Cashflow Transaction</label>
                                        <div class="md-checkbox has-success" style="margin-top: 10px">
                                            <?php
                                            if($jvh->is_cashflow == 'on'){
                                                echo '
                                                        <input type="checkbox" id="checkbox9" name="cashflow" class="md-check" checked>
                                                        <label for="checkbox9">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Cashflow </label>
                                                    ';
                                            }else{
                                                echo '
                                                        <input type="checkbox" id="checkbox9" name="cashflow" class="md-check">
                                                        <label for="checkbox9">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Cashflow </label>
                                                    ';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div><br>

                                <?php } ?>

                                <div class="box-body">
                                    <div class="page-content-inner">
                                        <table class="table table-bordered table-striped" id="table_detail">
                                            <thead>
                                            <tr>
                                                <th class="text-center hidden" width="100px" >NO.VOUCHER</th>
                                                <th class="text-center" width="100px" >ACCOUNT</th>
                                                <th class="text-center" >DESCRIPTION</th>
                                                <th class="text-center" width="200px">DEBIT</th>
                                                <th class="text-center" width="200px">CREDIT</th>
                                                <th class="text-center" width="30px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($editjvd as $jvd) { ?>
                                                <tr>
                                                    <td class="hidden">
                                                        <input type="" class="form-control input" name="no_vouc[]" value="<?php echo $jvd->no_voucher ?>">
                                                    </td>
                                                    <td align="center"><?php echo $jvd->coa_id ?>
                                                        <input type="hidden" class="form-control input" name="coa_id[]" value="<?php echo $jvd->coa_id ?>">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="desc[]"><?php echo $jvd->description ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control input text-right input-sm debit" name="debit[]" value="<?php echo $jvd->debit ?>">
                                                    </td>
                                                    <td >
                                                        <input type="text" class="form-control input text-right input-sm credit" name="credit[]" value="<?php echo $jvd->credit ?>">
                                                    </td>
                                                    <td>
                                                        <button type="button"  onclick="deleteRow(this)"  class="btn red btn-sm text-center"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <th colspan="5" >
                                                <a class="btn green red-stripe btn-xs" data-target="#static" data-toggle="modal"><b> Add Detail</b> </a>
                                            </th>
                                            </th>
                                            </tfoot>
                                        </table>
                                        <button onclick="goBack()"  class="btn red  green-stripe"><i class="fa fa-remove" ></i> Back</button>
                                        <button type="button" class="btn green red-stripe pull-right" name="save"><i class="fa fa-save" ></i> Save</button>
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

<!--modals-->
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-width="760" data-keyboard="false">
    <div align="center" class="modal-header">
        <label >CHART OF ACCOUNT (COA)</label>
    </div>
    <div class="modal-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0">
            <thead bgcolor="#578EBE">
            <tr>
                <th width="50px">COA ID</th>
                <th>DESCRIPTION</th>
                <th width="100px">POSITION</th>
                <th width="10px">#</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($coa as $c){?>
                <tr>
                    <td align="center"><?php echo $c->coa_id ?></td>
                    <td><?php echo $c->name_coa ?></td>
                    <td align="center"><?php echo $c->name ?></td>
                    <td>
                        <a href="javascript:;"  >
                            <button type="button" class="btn red btn-xs select_coa"
                                    data-coa-id="<?php echo $c->coa_id?>" name_coa="<?php echo $c->name_coa?>" name="select"  > <i class="fa fa-plus-square " > </i>
                            </button> </a>
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
<!--modals-->


<script type="text/javascript">
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


    var rowIndex = <?php echo (isset($rowIndex) ? $rowIndex : 0) ; ?>;
    $('#good').inputmask("numeric", {
        radixPoint: ".",
        autoGroup: true,
        groupSeparator: ",",
        digits: 0,
        groupSize: 3,
        removeMaskOnSubmit: true,
        autoUnmask: true
    });

    $('.debit').inputmask("numeric", {
        radixPoint: ".",
        autoGroup: true,
        groupSeparator: ",",
        digits: 0,
        groupSize: 3,
        removeMaskOnSubmit: true,
        autoUnmask: true
    });
    $('.credit').inputmask("numeric", {
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

            "<td align=\"center\"> <input type=hidden name=\"coa_id[]\"  id = \"coa_id\" value= " + coaID + " >  " + coaID + " </td>" +
            "<td><textarea class=\"form-control\" name=\"desc[]\" >" + desc + "</textarea></td>" +

            "<td><input type=\"text\"  class=\"form-control input input-sm mask_currency text-right debit\" name=\"debit[]\" id=\"debit\" value = 0 ></td>" +

            "<td><input type=\"text\" class=\"form-control input input-sm mask_currency text-right credit\" name=\"credit[]\" id=\"credit\" value = 0 ></td>" +

            "<td> <button  value=\"x\" onclick=\"deleteRow(this)\"  class=\"btn red btn-sm text-center\" ><i class=\"fa fa-remove\"></i></button> </td>" +
            "<td class=\"hidden\"> <input type=\"hidden\" name=\"\" id=\"no_voucher\"  class=\"form-control input\" value=\"\"> </td>" +
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


    //SAVE
    $('button[name="save"]').on('click', function (e) {
        //TO CHECK DR CR BALANCE
        //1.SUM DEBIT
        var sums = $('.debit'); // this will need to be the class of the things you want to sum
        var sum_debit = 0;
        for (var i = 0; i < sums.length; i++) {
            if(sums[i].value == null){//validate if input text is null
                sums[i].value = 0;
            };
            sum_debit += parseFloat(sums[i].value);// or maybe parseFloat(sums[i].innerHTML)
        }
        $('#total-debit').val(sum_debit);


        //2. SUM CREDIT
        var sums2 = $('.credit'); // this will need to be the class of the things you want to sum
        var sum_credit = 0;
        for (var i = 0; i < sums2.length; i++) {
            if(sums2[i].value == null){//validate if input text is null
                sums2[i].value = 0;
            };
            sum_credit += parseFloat(sums2[i].value);// or maybe parseFloat(sums[i].innerHTML)
        }
        $('#total-credit').val(sum_credit);

        if (sum_debit == sum_credit) {
            e.preventDefault();
            var url = '<?php echo base_url('/index.php/jv/jv/save_edit');?>';
            $("#form-entry").attr("method", "post");
            $('#form-entry').attr('action', url).submit();
        } else {
            toastr.error('Debit & Credit not balance (' + (sum_debit - sum_credit) + ') ');
        }

    });


    $(document).ready(function () {
        $('#example').DataTable();
    });


    function goBack() {
        window.history.back();
    }
    //get selected tags
    $(document).ready(function () {
        $(function(){
            $("#multi-prepend").select2().val([<?php echo $selectedTag->tag_id?>]).trigger('change.select2');
        });
    });
</script>