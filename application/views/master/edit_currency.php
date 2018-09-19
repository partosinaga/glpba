  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Master
          <small></small>
        </h1>
      </section>


      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-edit "></i> Edit Currency</h3>
          </div>
          <div class="box-body">
            <div class="page-content-inner">
              
                

                <div class="portlet light bordered">
                 <?php foreach ($editCurr as $ec) { ?>
                  <form role="form" method="POST" action="<?php echo site_url().'/master/currency/save_edit' ?>">
                        <div class="form-body">
                          <div class="row">

                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="form_control_1">Currency id</label>
                                <div class="input-icon">
                                  <i class="fa fa-key font-green"></i>
                                  <input type="text" name="curr_id" class="form-control" value="<?php echo $ec->curr_id ?>">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group ">
                              <label for="form_control_1">Currency Name</label>
                                <div class="input-icon">
                                  <i class="fa fa-user font-green"></i>
                                  <input type="text" name="curr_name" class="form-control" value="<?php echo $ec->curr_name ?>" >
                                </div>
                              </div>
                            </div>
                          
                          </div>

                              <button type="submit" class="btn green"><i class="fa fa-save"> </i> Save </button>
                              <button type="button " class="btn red" VALUE="Back" onClick="history.go(-1);return true;"><i class="fa fa-chevron-circle-left" ></i> Cancel</button>                       
                        </div>
                          
                  </form>
                  <?php } ?>
                </div>  


              <div class="m-heading-1 border-green">                      
                  <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        
                        <tr>
                          <th>NO</th>
                          <th>CURRENCY ID</th>
                          <th>CURRENCY NAME</th>
                      </tr>
                        
                      </thead>
                      <tbody>

                        
                        <?php
                      
                          $no=1;

                          foreach($curr as $b){
                        ?>
                        
                        <tr>

                          <td><?php echo $no++ ?></td>
                          <td><?php echo $b->curr_id ?></td>
                          <td><?php echo $b->curr_name ?></td>
                          
                        </tr>
                        
                        <?php } ?>


                      </tbody>
                        
                    </table>                        
              </div>
             </div>
          </div>

        </div>

      </section>

    </div>

  </div><br><br><br><br><br><br><br><br><br>
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>