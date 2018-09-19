  <div class="content-wrapper">
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
            <h3 class="box-title"><i class="fa fa-list-alt"></i> Master user </h3>
          </div>
          <div class="portlet light bordered">
            <form role="form" method="POST" action="<?php echo site_url().'/master/user/add_user' ?>">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="form_control_1">User id</label>
                          <div class="input-icon">
                          <i class="fa fa-key font-green"></i>
                            <input type="text" name="user_id" class="form-control" placeholder="User id">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group ">
                        <label for="form_control_1">Username</label>
                          <div class="input-icon">
                           <i class="fa fa-user font-green"></i>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>                                             
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group ">
                          <label for="form_control_1">Password</label>
                          <div class="input-icon">
                            <i class="fa fa-lock font-green"></i>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="form_control_1">Departement</label>
                          <div class="input-icon">
                            <i class="fa fa-building font-green"></i>
                            <input type="text" name="departemen" class="form-control" placeholder="Departemen">
                          </div>
                        </div>
                      </div>                                                
                    </div>

                    
                 

                    <button type="submit" class="btn green"><i class="fa fa-plus-square"> </i> Submit </button>
                                                       
                  </div> 
                    
            </form>
          </div>
          <div class="box-body">

              <div class="page-content-inner">
                  <div class="m-heading-1 border-green ">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        
                        <tr>
                          <th width="10">NO</th>
                          <th width="80px">USER ID</th>
                          <th width="100px">USERNAME</th>
                          <th>DEPARTEMENT</th>
                          <th>PASSWORD</th>
                      </tr>
                        
                      </thead>
                      <tbody>

                        
                        <?php
                      
                          $no=1;

                          foreach($user as $u){
                        ?>
                        
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $u->user_id ?></td>
                          <td><?php echo $u->username ?></td>
                          <td><?php echo $u->departemen ?></td>
                          <td><?php echo md5($u->password) ?></td>
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

  </div>


    



<style type="text/css">
  .btn span.glyphicon {         
  opacity: 0;       
}
.btn.active span.glyphicon {        
  opacity: 1;       
}
</style>
 <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>