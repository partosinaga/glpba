<?php
    $this->load->view('alert/alert');
  ?>

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
            <h3 class="box-title"><i class="fa fa-edit"></i> Edit bank<h3>
          </div>



          <div class="portlet light bordered">
           <?php foreach ($editBank as $eb) { ?>
            <form role="form" method="POST" action="<?php echo site_url().'/master/bank/save_edit' ?>">
                  <div class="form-body">
                    <div class="row">
                      <input type="hidden" name="id" class="form-control" value="<?php echo $eb->id; ?>">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="form_control_1">Bank id</label>
                          <div class="input-icon">
                            <i class="fa fa-key font-green"></i>
                            <input type="text" name="bank_id" class="form-control" value="<?php echo $eb->bank_id; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group ">
                        <label for="form_control_1">Name</label>
                          <div class="input-icon">
                            <i class="fa fa-user font-green"></i>
                            <input type="text" name="name" class="form-control" value="<?php echo $eb->name; ?>" required>
                          </div>
                        </div>
                      </div>
                                                                   
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group ">
                          <label for="form_control_1">Account code</label>
                          <div class="input-icon">
                            <i class="fa fa-lock font-green"></i>
                            <input type="text" name="account_code" class="form-control" value="<?php echo $eb->account_code; ?>"  required> 
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group ">
                        <label for="form_control_1">Start date</label>
                          <div class="input-icon">
                            <i class="fa fa-calendar-plus-o font-green"></i>
                            <input type="date" name="start_date" class="form-control" value="<?php echo $eb->start_date; ?>" required> 
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                       <div class="col-md-4">
                        <div class="form-group">
                         <label for="form_control_1">Begining balance</label>
                          <div class="input-icon">
                          <i class="fa fa-money font-green"></i>
                            <input type="text" name="begining_balance"  class="form-control input text-right" value="<?php echo $eb->begining_balance; ?>" required>                            
                          </div>
                        </div>
                      </div>

                     <div class="col-md-4">
                        <div class="form-group">
                          <label>Currency</label>
                            <div class="input-icon">
                              <select class="form-control select2" name ="currency" required>
                              <option value="" selected  >Select New Currency </option>
                              <?php
                                foreach ($getCurr->result_array() as $data){
                                  echo "<option value=". $data["curr_id"]." >"
                                                       .$data["curr_name"].
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
                          <th>BANK ID</th>
                          <th>NAME</th>
                          <th>ACCOUNT CODE</th>
                          <th>CURRENCY</th>
                          <th>START DATE</th>
                          <th>BEGINING BALANCE</th>
                      

                      </tr>
                        
                      </thead>
                      <tbody>

                        
                        <?php
                      
                          $no=1;

                          foreach($bank as $b){
                        ?>
                        
                        <tr>

                          <td><?php echo $no++ ?></td>
                          <td><?php echo $b->bank_id ?></td>
                          <td><?php echo $b->name ?></td>
                          <td><?php echo $b->account_code ?></td>
                          <td><?php echo $b->curr_name ?></td>
                          <td><?php echo $b->start_date ?></td>
                          <td><?php echo $b->begining_balance; ?></td>
                          
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
     <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>