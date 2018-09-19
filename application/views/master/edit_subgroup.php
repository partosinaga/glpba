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
            <h3 class="box-title"><i class="fa fa-edit" ></i> Edit Subgroup</h3>
          </div>
          <div class="box-body">
              <div class="page-content-inner">
                  <div class="page-content-inner">
                    <div class=""> 
                      <div>
                        <div class="portlet light ">
                         

                          <div class="portlet-body">
                            <ul class="nav nav-tabs">
                              <li class="active">
                                <a href="#tab_1_1" data-toggle="tab"> Subgroup </a>
                              </li>
                             
                                                            
                            </ul>
                            <div class="tab-content">

<!--====================================PAGE GROUP====================================-->
                              <div class="tab-pane fade active in" id="tab_1_1"><br>
                                  <div class="portlet-body form">
                                  <?php
                                    foreach ($editSubgroup as $es  ) { ?>
                                    <form role="form" method="POST" action="<?php echo site_url().'/master/coa/save_edit_subgroup' ?>">
                                          <div class="form-body">
                                            <div class="row">

                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="form_control_1">Code</label>
                                                  <div class="input-icon">
                                                  <i class="fa fa-key font-green"></i>
                                                    <input type="text" name="subgroup_id" class="form-control" value="<?php echo $es->subgroup_id ?>">
                                                  </div>
                                                </div>
                                              </div>
                                           
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Description</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-align-right font-green"></i>
                                                    <input type="text" name="name_sg" class="form-control" value="<?php echo $es->name_sg ?>">
                                                  </div>
                                                </div>
                                              </div>  

                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Group</label>
                                                  <div class="input-icon">
                                                  <select class="form-control select2" name ="kelompok">
                                                  <option value="" selected >Select New Account Group  </option>
                                                  <?php
                                                    foreach ($getGroup->result_array() as $data){
                                                      echo "<option value=". $data["group_id"]." >"
                                                            .$data["group_id"]. "-" .$data["name"]. 
                                                          "</option>";
                                                    }
                                                  ?>
                                                </select>
                                                  </div>
                                                </div>
                                              </div> 


                                            </div>
                                             
                                            <button type="submit" class="btn green"><i class="fa fa-save"> </i> Save </button>
                                            <button type="button " class="btn red" VALUE="Back" onClick="history.go(-1);return true;"><i class="fa fa-chevron-circle-left" ></i> Cancel</button>                                
                                          </div> <hr>
                                            
                                    </form>
                                    <?php } ?>
                                  </div>
                                  <div class="box-body">
                                      <div class="page-content-inner">
                                        <div class="m-heading-1 border-green ">
                                          <table id="example" class="table table-striped table-bordered" cellspacing="0">
                                            <thead>
                                              <tr>
                                                <th>NO</th>
                                                <th>CODE</th>
                                                <th>DESCRIPTION</th>
                                                <th>GROUP</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                              $no=1;
                                              foreach ($subgroup as $sg) 
                                            { ?>
                                              <tr>
                                                <td> <?php echo $no++; ?> </td>
                                                <td> <?php echo $sg->subgroup_id; ?> </td>
                                                <td> <?php echo $sg->name_sg; ?> </td>
                                                <td> <?php echo $sg->name; ?> </td>
                                                
                                              </tr>
                                              <?php } ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div> 
                              </div>

<!--==================================== END PAGE GROUP====================================-->
      

                                <div class="tab-pane fade" id="tab_1_3">
                                  <p> coa page </p>
                                </div>
                                                          
                            </div>
                            <div class="clearfix margin-bottom-20"> </div>
                                                        
                                                        
                        </div>
                        </div>
                      </div>
                  </div>       


                                            
                </div>
             
          </div>

        </div>

      </section>

    </div>

  </div>
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>