  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           U<small>ser</small> S<small>ettings</small>
        </h1>
      </section>
      <section class="content">
        <div class="box box-success">
          <div class="box-header witd-border">
            <h3 class="box-title"><i class="fa fa-wrench"></i>User list</h3>
          </div>
          <div class="box-body">
             <table id="example" class="table table-striped table-bordered" cellspacing="0">
                <thead bgcolor="#ACB5C3">
                  <tr >
                    <th rowspan="2"  class="text-center">USER ID</th>
                    <th rowspan="2" class="text-center">USERNAME</th>
                    <th rowspan="2" class="text-center">PASSWORD</th>
                    <th rowspan="2" class="text-center">DEP.</th>
                    <th colspan="2" class="text-center">AR</th>
                    <th colspan="2" class="text-center">AP</th>
                    <th colspan="2" class="text-center">GL</th> 
                    <th rowspan="2">REPORT</th>
                    <th rowspan="2">ADMIN</th>
                    <th rowspan="2">ACTION</th>
                  </tr>
                  <tr>
                    <th> ENTRY</th> <!-- ar -->
                    <th> POST</th>  <!-- ar -->
                    <th> ENTRY</th> <!-- ap -->
                    <th> POST</th>  <!-- ap -->
                    <th> ENTRY</th> <!-- gl -->
                    <th> POST</th>  <!-- gl -->
                    
                  </tr>
                </tdead>
                <tbody>
                <?php 
                  foreach ($user as $us) {
                    if ($us->AREntry == 'y') {
                      $us->AREntry = '&#10004';
                    };
                    if ($us->ARPost == 'y') {
                      $us->ARPost = '&#10004';
                    };
                    if ($us->APEntry == 'y') {
                      $us->APEntry = '&#10004';
                    };
                    if ($us->APPost == 'y') {
                      $us->APPost = '&#10004';
                    };
                    if ($us->GLEntry == 'y') {
                      $us->GLEntry = '&#10004';
                    };
                    if ($us->GLPost == 'y') {
                      $us->GLPost = '&#10004';
                    };
                    if ($us->reportACC == 'y') {
                      $us->reportACC = '&#10004';
                    };
                    if ($us->adminACC == 'y') {
                      $us->adminACC = '&#10004';
                    };
                ?>    
                  <tr>
                    <td><?php echo $us->user_id ?></td>
                    <td><?php echo $us->username ?></td>
                    <td><?php echo md5($us->password) ?></td>
                    <td><?php echo $us->departemen ?></td>
                    <td align="center"><?php echo $us->AREntry ?></td>
                    <td align="center"><?php echo $us->ARPost ?></td>
                    <td align="center"><?php echo $us->APEntry ?></td>
                    <td align="center"><?php echo $us->APPost ?></td>
                    <td align="center"><?php echo $us->GLEntry ?></td>
                    <td align="center"><?php echo $us->GLPost ?></td>
                    <td align="center"><?php echo $us->reportACC ?></td>
                    <td align="center"><?php echo $us->adminACC ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn red blue-hoki-stripe btn-xs dropdown-toggle" data-toggle="dropdown"><i class="angle-down"></i> Action
                          <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a href ="<?php echo site_url().'/master/user/edit_user/'.$us->user_id ;?>"><i class="fa fa-edit"></i> Edit </a>
                          </li>
                          <li>
                            <a  data-target="#static<?php echo $us->user_id ?>" data-toggle="modal"><i class="fa fa-trash"></i> Delete </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
 <!--MODAL CONFIRMATION-->
    <div id="static<?php echo $us->user_id ?>"  class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        Are you sure to <b>DELETE</b> this data?
      
      </div>
      <div class="modal-footer">
        <a href="<?php echo site_url().'/master/user/delete_user/'.$us->user_id;?>"  >
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
      </section>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
