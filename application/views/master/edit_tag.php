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
                    <i class="fa fa-edit "></i> Edit tag
                </h3>
            </div>
            <div class="box-body">
                <form method="POST" action="<?php echo site_url('master/tag/save_edit') ?>">
                    <?php foreach ($tag as $d) { ?>
                        <div class="row">

                            <input type="hidden" name="id" value="<?php echo $d->id ?>" class="form-control"
                                   placeholder="tag_id">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_control_1">Name</label>
                                    <div class="input-icon">
                                        <i class="fa fa-user font-green"></i>
                                        <input type="text" name="name_tag" value="<?php echo $d->name_tag ?>"
                                               class="form-control" placeholder="Name">
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
                        <div class="col-md-12">
                            <button type="submit" class="btn green pull-right"><i class="fa fa-save"> </i> UPDATE
                            </button>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </section>
</div>