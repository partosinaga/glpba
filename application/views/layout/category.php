<section class="content-header">
    <h1>
        <small>Layout Settings</small>
    </h1>
</section>


<section class="content">
    <div class="box box-success">

        <div class="box-header with-border">
            <ul class="nav nav-tabs">
                <li class="">
                    <a href="<?php echo site_url("layout/layout/bs_layout") ?>"><i class="fa fa-gears"></i> Layout </a>
                </li>
                <li class="active">
                    <a href="<?php echo site_url("layout/layout/category") ?>"><i class=" fa fa-list"></i> Category </a>
                </li>
            </ul>
            <br>
            <h3 class="box-title"><i class="fa fa-dot-circle-o"></i> Financial Statement Categories</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="well">
                        <button type="submit" class="btn green btn-sm" id="save-category"><i class="fa fa-save"></i> Save</button>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center" >Report</th>
                                <th >Category</th>
                                <th>Caption</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($ctgr as $row):
                                ?>
                                <tr align="center">
                                    <td><?php if($row->id_report == 1){
                                            echo 'BS';
                                        }else if($row->id_report == 2){
                                            echo 'PL';
                                        }else{
                                            echo 'CF';
                                        } ?>
                                    </td>
                                    <td align="left"><input type="hidden" class="form-control input-sm" name="id_category[]" value="<?php echo $row->id_category ?>"><?php echo $row->category ?></td>
                                    <td><input type="text" class="form-control input-sm" name="account[]" value="<?php echo $row->account ?>"></td>
                                    <td id="<?php echo $row->id_category ?>" class="expands" style="cursor: pointer; text-align: center"><i class="fa fa-arrow-circle-right"></i></td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well" >
                        <button type="submit" class="btn green btn-sm" id="save-subcategory"><i class="fa fa-save"></i> Save</button>
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th>Subcategory</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="details">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>



    </div>
</section>

<style>
    tr.collapse.in {
        display:table-row;
    }
</style>
<script>


    $('.expands').on("click", function(){
        var id = $(this).attr("id");
        $.ajax({
            url: '<?php echo site_url('layout/layout/get_expands') ?>',
            type: 'POST',
            data: {
                id
            },
            success: function (data) {
                $("#details").html(data);
            },
        })
    })

    $(document).ready(function(){
        $("#save-category").on("click", function(){
            get();
        })
    })

    function get(){
        var account = $("input[name='account[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var id_category = $("input[name='id_category[]']")
            .map(function () {
                return $(this).val();
            }).get();
        $("#loading").show();
        $.ajax({
            url: '<?php echo site_url('layout/layout/save_edit_category') ?>',
            method: 'POST',
            data:{
                account, id_category
            },
            success: function(){
                toastr.success('Saved!');
            },
            error: function(){
                toastr.error('Fail to save, try again later');
            },
            complete: function(){
                $("#loading").hide();
            }

        })
    }

    $(document).ready(function(){
        $("#save-subcategory").on("click", function(){
            get_sub();
        })
    })
    function get_sub(){
        var name_sub = $("input[name='name_sub[]']")
            .map(function () {
                return $(this).val();
            }).get();
        var id_subcategory = $("input[name='id_subcategory[]']")
            .map(function () {
                return $(this).val();
            }).get();
        if(id_subcategory == ''){
            toastr.error('No category selected!');
        }else {
            $("#loading").show();
            $.ajax({
                url: '<?php echo site_url('layout/layout/save_edit_subcategory') ?>',
                method: 'POST',
                data: {
                    name_sub, id_subcategory
                },
                success: function () {
                    toastr.success('Saved!');
                },
                error: function () {
                    toastr.error('Fail to save, try again later');
                },
                complete: function () {
                    $("#loading").hide();
                }

            })
        }
    }
</script>