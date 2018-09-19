    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           I<small>mport</small> T<small>ransaction</small>
        </h1>
      </section>
      <section class="content">
        <div class="box box-success">
          <div class="box-header witd-border">
            <h3 class="box-title"><i class="fa fa-cloud"></i> Payment Voucher Voucher</h3>
          </div>
          <div class="box-body">
          
            <fieldset class="groupbox-border">
                <legend class="groupbox-border">DONWLOAD</legend>
                <div class="control-group">
                   Click <a href="<?php echo site_url('ap/ap/download') ?>">here</a> to downlad Format in MS.Excel
                </div>
            </fieldset>

              
                <div class="col-md-6 well">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-level-up"></i> <b>HEADER</b></a></li>
                      <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-list-ul"></i><b> DETAILS</b></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                       UPLOAD TRANSACTION HEADER.
                        <p>Make sure that all data entry is correct, system can't control's all row data.</p>
                          <form action="<?php echo site_url('ap/ap/upload')?>" method="post" enctype="multipart/form-data">
                            <td><input name="file" type="file" required="" /></td><hr>
                             <button type="submit" class="btn blue"><i class="fa fa-upload"> </i> Upload </button>
                          </form>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        UPLOAD TRANSACTION DETAILS.
                        <p>Make sure that all data entry is correct and sync with Header, system can't control's all row data.</p>
                          <form action="<?php echo site_url('ap/ap/upload2')?>" method="post" enctype="multipart/form-data">
                            <td><input name="file" type="file" required="" /></td><hr>
                             <button type="submit" class="btn blue"><i class="fa fa-upload"> </i> Upload </button>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="note note-info">
                      <h4 class="block"><i class="fa  fa-info-circle"></i> NOTED</h4>
                      <ul style="list-style-type:circle">
                        <li><b>Never</b> change format column in file Excel. call administrator to configuration</li>
                        <li><b>Always</b> download format excel from application every single part transaction </li>
                        <li>After upload done check existing transaction to make sure it clear</li>
                      </ul> 
                    </div>
                </div>
              


          </div>
        </div>
      </section>
      
    </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<style type="text/css">

fieldset.groupbox-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 1.2em 1.2em 1.2em 1.2em !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
    box-shadow:  0px 0px 0px 0px #000;
}

legend.groupbox-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width:auto;
    padding:0px 10px 0px 10px;
    border-bottom:none;
    
}
</style>