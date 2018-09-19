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
            <h3 class="box-title"><i class="fa fa-dollar "></i> Currency</h3>
          </div>
          <div class="box-body">
            <div class="page-content-inner">
              
                

                <div class="portlet light bordered">
                  <form role="form" method="POST" action="<?php echo site_url().'/master/currency/add_currency' ?>">
                        <div class="form-body">
                          <div class="row">

                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="form_control_1">Currency id</label>
                                <div class="input-icon">
                                  <i class="fa fa-key font-green"></i>
                                  <input type="text" name="curr_id" class="form-control" placeholder="Currency id">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group ">
                              <label for="form_control_1">Currency Name</label>
                                <div class="input-icon">
                                  <i class="fa fa-user font-green"></i>
                                  <input type="text" name="curr_name" class="form-control" placeholder="Currency Name">
                                </div>
                              </div>
                            </div>
                          
                          </div>

                              <button type="submit" class="btn green"><i class="fa fa-plus-square"> </i> Submit </button>
                                                             
                        </div>
                          
                  </form>
                </div>  


              <div class="m-heading-1 border-green">                      
                  <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        
                        <tr>
                          <th>NO</th>
                          <th>CURRENCY ID</th>
                          <th>CURRENCY NAME</th>
                          <th>ACTION</th>

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
                          <td align="center">  
                            <a data-target="#static<?php echo $b->curr_id ?>" data-toggle="modal">  <button type="button" class="btn default red-stripe btn-sm"><i class="fa fa-trash"></i> delete</button> </a>
                            <a href ="<?php echo site_url().'/master/currency/edit_currency/'.$b->curr_id ;?>">  <button type="button" class="btn default blue-stripe btn-sm"><i class="fa fa-edit"></i> edit</button> </a>
                          </td>
                        </tr>
                        

<!--MODAL CONFIRMATION-->
    <div id="static<?php echo $b->curr_id ?>"  class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        Are you sure to <b>DELETE</b> this data?
      
      </div>
      <div class="modal-footer">
        <a href="<?php echo site_url().'/master/currency/delete_currency/'.$b->curr_id;?>"  >
          <button type="button" class="btn btn-success"><i class="fa fa-check"></i> OK</button>
        </a>
        <button type="button" data-dismiss="modal" form="form1" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
<!--/MODAL CONFIRMATION-->



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