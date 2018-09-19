<section class="content-header">
    <h1>
        <small>Layout Settings</small>
    </h1>
</section>


<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?php echo site_url("layout/layout/bs_layout") ?>" ><i class="fa fa-gears"></i> Layout </a>
                </li>
                <li class="">
                    <a href="<?php echo site_url("layout/layout/category") ?>"><i class=" fa fa-list"></i> Category </a>
                </li>
            </ul>
            <br>
            <h3 class="box-title"><i class="fa fa-dot-circle-o"></i> Cashflow</h3>

            <div class="pull-right box-tools">
                <button class="btn blue-ebonyclay btn-sm dropdown-toggle" data-toggle="dropdown"><i
                        class="angle-down"></i> Report type
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo site_url("layout/layout/bs_layout") ?>"><i class="fa fa-dot-circle-o"></i> Balance sheet</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url("layout/layout/pl_layout") ?>"><i class="fa fa-dot-circle-o"></i> Profit & loss statement</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url("layout/layout/cf_layout") ?>"><i class="fa fa-dot-circle-o"></i> Cashflow</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="box-body">
            <button type="submit" class="btn green btn-sm" id="input"><i class="fa fa-save"></i> Save</button>
            <button type="submit" class="pull-right btn grey-salt btn-sm" data-toggle="modal" href="#new-layout"><i
                    class="fa fa-plus"></i> New layout accont
            </button><hr>
            <table class="table table-striped table-bordered table-hover" id="detail-table">
                <thead>
                <tr role="row">
                    <th class="text-center" width="2%">#</th>
                    <th class="text-center" width="12%">CATEGORY</th>
                    <th class="text-center" width="12%">SUB CATEGORY</th>
                    <th class="text-center" width="4%">ORDER</th>
                    <th class="text-center">ACCOUNT</th>
                    <th class="text-center" width="4%">RANGE</th>
                    <th class="text-center" width="8%">RANGE START</th>
                    <th class="text-center" width="8%">RANGE END</th>
                    <th class="text-center">CUSTOM FORMULA</th>
                    <th class="text-center" width="1%">#</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($detail as $d): ?>
                    <tr>
                        <td align="center">
                            <?php echo $no++ ?>
                            <input type="hidden" disabled class="form-control input-sm id-detail " name="id-detail[]" value="<?php echo ($d->id_detail) ?>" code="<?php echo ($d->id_detail) ?>">
                        </td>
                        <td align="center"><?php echo strtoupper($d->ctg_account) ?></td>
                        <td align="center"><?php echo strtoupper($d->name) ?></td>
                        <td align="center">
                            <input class="form-control input-sm" style=" height: 24px; text-align: center" name="order[]" value="<?php echo $d->is_cf ?>" >
                        </td>
                        <td><input class="form-control input-sm" style=" height: 24px" name="account[]" value="<?php echo $d->account ?>" ></td>
                        <td align="center">
                            <?php
                            if($d->is_range == 1){
                                echo "<input type=\"hidden\" name=\"is_range[]\" value=\"1\"><input type=\"checkbox\" onclick=\"this.previousSibling.value=1-this.previousSibling.value\" checked>";
                            }else{
                                echo "<input type=\"hidden\" name=\"is_range[]\" value=\"0\"><input type=\"checkbox\" onclick=\"this.previousSibling.value=1-this.previousSibling.value\">";
                            }
                            ?>

                        </td>
                        <td><input class="form-control input-sm" style=" height: 24px;text-align: center" name="range_start[]" value="<?php echo $d->range_start ?>" ></td>
                        <td><input class="form-control input-sm" style=" height: 24px;text-align: center" name="range_end[]" value="<?php echo $d->range_end ?>"></td>
                        <td class="custom-formula">
                            <textarea rows="1" class="form-control input-sm" data-autosize-on="true" style="overflow: hidden; resize: vertical; word-wrap: break-word;" name="custom[]"><?php echo $d->custom ?></textarea>
                        </td>
                        <td align="center"><button class="btn red btn-xs delete"  id="<?php echo $d->id_detail ?>" data-toggle="modal" href="#confirm"><i class="fa fa-remove"></i></button></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--confirm-->
<div id="confirm" class="modal modale" data-backdrop="static" data-keyboard="false">
    <div class="modal-header">
        <b>Confrim</b>
    </div>

    <div class="modal-body">
        Are you sure to delete this row?
    </div>

    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="pull-left btn red blue-hoki-stripe btn-sm"><i
                class="fa fa-remove"></i> No
        </button>
        <button class="pull-right btn green blue-hoki-stripe btn-sm sure"><i class="fa fa-check"></i> Yes
        </button>

    </div>
</div>
<!--end of confirm-->
<!--modal-->
<div id="new-layout" class="modal fade  modale" data-backdrop="static" data-keyboard="false">
    <div class="modal-header">
        <i class="fa fa-plus"></i> New layout
    </div>

    <div class="modal-body">
        <form id="new-category">
            <div class="form-group">
                <label>Categoty</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="id_category"
                        name="id_category">
                    <option value="" selected="selected" disabled>select</option>
                    <?php foreach ($category as $c): ?>
                        <option value="<?php echo $c->id_category ?>"> <?php echo strtoupper($c->category) ?> </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Subcategory</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="id_subcategory"
                        name="id_subcategory">
                    <option value="" selected="selected" disabled>select</option>
                </select>
            </div>
            <div class="form-group">
                <label>Account</label>
                <input type="text" name="account" class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" name="report_id" value="3" class="form-control">
                <input type="hidden" name="url" value="<?php echo $this->uri->segment('3'); ?>" class="form-control">
            </div
    </div>

    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="pull-left btn red blue-hoki-stripe btn-sm"><i
                class="fa fa-remove"></i> Cancel
        </button>
        <button class="pull-right btn green blue-hoki-stripe btn-sm" name="save"><i class="fa fa-save"></i> Save
        </button>

    </div>
</div>
<!--end of modal-->

<script>
    $('.custom-formula').on( 'change keyup keydown paste cut', 'textarea', function (){
        $(this).height(0).height(this.scrollHeight);
    }).find( 'textarea' ).change();

    //save
    $('button[name="save"]').on("click", function () {
        var url = '<?php echo site_url('layout/layout/save') ?>'
        $('#new-category').attr("method", "post");
        $('#new-category').attr("action", url).submit();
    })

    $(document).ready(function () {
        $("#id_category").change(function () {
            $.ajax({
                url: '<?php echo site_url('layout/layout/subcategory') ?>',
                type: 'POST',
                data: {
                    id: $(this).val()
                },
                success: function (data) {
                    $("#id_subcategory").html(data);
                }
            })
        })
    })

    $('.delete').on("click", function(){
        var id = $(this).attr("id");
        var url = "<?php echo $this->uri->segment('3'); ?>";
        var id_report = 3;
        $('.sure').on("click", function(){
            $.ajax({
                url: '<?php echo site_url('layout/layout/remove') ?>',
                type: 'POST',
                data: {
                    id, url, id_report
                },
                success: function (msg) {
                    console.log(msg);
                    location.reload();
                },
            })
        })
    })

    $(document).ready(function(){
        $("#input").on("click", function(){
            get();
        })
    })

    function get() {
        var id = $("input[name='id-detail[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var account = $("input[name='account[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var range_start = $("input[name='range_start[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var range_end = $("input[name='range_end[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var custom = $("textarea[name='custom[]']")
            .map(function () {
                return $(this).val();
            }).get();
        //KOLOM IS_CF DI GANTI FUNGSI MENJADI URUTAN
        var is_cf = $("input[name='order[]']")
            .map(function () {
                return $(this).val();
            }).get();

        var is_range = $("input[name='is_range[]']")
            .map(function (){
                return $(this).val();
            }).get();
        var id_report = 3;
        //console.log(is_cf + ' -- ' + is_range);

        $("#loading").show();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('layout/layout/save_edit');?>',
            data: {
                id,
                account,
                range_start,
                range_end,
                custom,
                is_cf,
                is_range,
                id_report
            },
            success: function (msg) {
                console.log(msg);
                toastr.success('Saved');
            },
            error: function (msg) {
                console.log(msg);
                toastr.error('Failed, try again!');
            },
            complete: function(){
                $("#loading").hide();
            }
        })


    }
</script>