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
                    <i class="fa fa-edit "></i> Edit Contact
                </h3>
            </div>
            <div class="box-body">
                <form method="POST" action="<?php echo site_url('master/contact/save_edit') ?>">
                    <?php foreach ($contact as $d) { ?>
                        <div class="row">

                            <input type="hidden" name="debtor_id" value="<?php echo $d->contact_id ?>" class="form-control"
                                   placeholder="debtor_id">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Name</label>

                                    <div class="input-icon">
                                        <i class="fa fa-user font-green"></i>
                                        <input type="text" name="name" value="<?php echo $d->name ?>"
                                               class="form-control" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Address</label>
                                    <textarea class="form-control" name="address"
                                              placeholder="Debtor Address"><?php echo $d->address ?></textarea>
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
                                               value="<?php echo $d->contact ?>" placeholder="Phone Number or Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >Debtor</label>
                                    <div>
                                        <?php
                                        if($d->is_debtor == 1){
                                            echo '<input type="checkbox" name="is_debtor" checked value="1" class="make-switch" data-on-text="Yes" data-off-text="No">';
                                        }else {
                                            echo '<input type="checkbox" name="is_debtor" value="1" class="make-switch" data-on-text="Yes" data-off-text="No">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >Creditor</label>
                                    <div>
                                        <?php
                                        if($d->is_creditor == 1){
                                            echo '<input type="checkbox" name="is_creditor" checked value="1" class="make-switch" data-on-text="Yes" data-off-text="No">';
                                        }else {
                                            echo '<input type="checkbox" name="is_creditor" value="1" class="make-switch" data-on-text="Yes" data-off-text="No">';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn green pull-right"><i class="fa fa-save"> </i> UPDATE
                            </button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </section>
</div>