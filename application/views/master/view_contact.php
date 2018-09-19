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
                    <i class="fa fa-money "></i> Contact
                </h3>
            </div>
            <div class="box-body">
                <div class="portlet light bordered">
                    <form method="POST" action="<?php echo site_url('master/contact/add_contact') ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Name</label>

                                    <div class="input-icon">
                                        <i class="fa fa-user font-green"></i>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Address</label>
                                    <textarea class="form-control" name="address"
                                              placeholder="contact address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Contact</label>

                                    <div class="input-icon">
                                        <i class="fa fa-key font-green"></i>
                                        <input type="text" name="contact" class="form-control"
                                               placeholder="Phone Number or Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >Debtor</label>
                                    <div>
                                        <input type="checkbox" name="is_debtor" value="1" class="make-switch" data-on-text="Yes" data-off-text="No">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >Creditor</label>
                                    <div>
                                        <input type="checkbox" name="is_creditor" value="1" class="make-switch" data-on-text="Yes" data-off-text="No">
                                    </div>
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
                                <th>ADDRESS</th>
                                <th width="200pt">CONTACT</th>
                                <th width="50pt" style="text-align: center;">DEBTOR</th>
                                <th width="50pt" style="text-align: center;">CREDITOR</th>
                                <th width="150px" style="text-align: center;">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($debtor as $d) { ?>
                                <tr>
                                    <td><?php echo $d->name ?></td>
                                    <td><?php echo $d->address ?></td>
                                    <td><?php echo $d->contact ?></td>
                                    <td align="center">
                                        <?php
                                            if($d->is_debtor == 1){
                                                echo '<p>&#10004</p>';
                                            }
                                        ?></td>
                                    <td align="center">
                                        <?php
                                        if($d->is_creditor == 1){
                                            echo '<p>&#10004</p>';
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <a data-target="#static<?php echo $d->contact_id ?>" data-toggle="modal">
                                            <button type="button" class="btn default red-stripe btn-xs">
                                                <i class="fa fa-trash"></i> delete
                                            </button>
                                        </a>
                                        <a href=" <?php echo site_url() . '/master/contact/edit_contact/' . $d->contact_id; ?>">
                                            <button type="button" class="btn default blue-stripe btn-xs">
                                                <i class="fa fa-edit"></i> edit
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <!--MODAL CONFIRMATION-->
                                <div id="static<?php echo $d->contact_id ?>" class="modal fade" tabindex="-1"
                                     data-backdrop="static" data-keyboard="false">
                                    <div class="modal-header">
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to <b>DELETE</b> this data?

                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo site_url() . '/master/contact/delete_contact/' . $d->contact_id; ?>">
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