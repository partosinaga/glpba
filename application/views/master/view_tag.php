<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
        </h1>
    </section>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-money "></i> Tag
                </h3>
            </div>
            <div class="box-body">
                <div class="portlet light bordered">
                    <form method="POST" action="<?php echo site_url('master/tag/add_tag') ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Name tag</label>

                                    <div class="input-icon">
                                        <i class="fa fa-user font-green"></i>
                                        <input type="text" name="name_tag" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="single" class="control-label"><b>Status</b></label>
                                <div class="input-icon">
                                    <select id="bank_id" class="form-control select2" name ="status" required>
                                        <option value="1">Aktif</option>
                                        <option value="2">Inaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn green"><i class="fa fa-plus-square"> </i> Submit</button>

                    </form>
                </div>
            </div>

            <!-- TABLE -->
            <div class="box-body">
                <div class="page-content-inner">
                    <div class="m-heading-1 border-green">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th width="150px" style="text-align: center;">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tag as $d) { ?>
                                <tr>
                                    <td><?php echo $d->name_tag ?></td>
                                    <td>
                                        <?php if($d->status == 1) {
                                            echo '<label class="label label-info">Aktif</label>';
                                        }else{
                                            echo '<label class="label label-danger">Inaktif</label>';

                                        } ?>
                                    </td>
                                    <td align="center">
                                        <a data-target="#static<?php echo $d->id ?>" data-toggle="modal">
                                            <button type="button" class="btn default red-stripe btn-xs">
                                                <i class="fa fa-trash"></i> delete
                                            </button>
                                        </a>
                                        <a href=" <?php echo site_url() . '/master/tag/edit_tag/' . $d->id; ?>">
                                            <button type="button" class="btn default blue-stripe btn-xs">
                                                <i class="fa fa-edit"></i> edit
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <!--MODAL CONFIRMATION-->
                                <div id="static<?php echo $d->id ?>" class="modal fade" tabindex="-1"
                                     data-backdrop="static" data-keyboard="false">
                                    <div class="modal-header">
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to <b>DELETE</b> this data?

                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo site_url() . '/master/tag/delete_tag/' . $d->id; ?>">
                                            <button type="button" class="btn btn-success"><i class="fa fa-check"></i> OK
                                            </button>
                                        </a>
                                        <button type="button" data-dismiss="modal" form="form1" class="btn btn-danger">
                                            <i
                                                class="fa fa-remove"></i> Cancel
                                        </button>
                                    </div>
                                </div>
                                <!--/MODAL CONFIRMATION-->
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END OF TABLE -->
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>