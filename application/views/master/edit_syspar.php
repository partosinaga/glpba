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
            <h3 class="box-title"><i class="fa fa-edit"></i> Edit system parameter</h3>
          </div>
          <div class="box-body">
             
              <div  style="padding-left: 250px; padding-right: 250px"> 
                <div class="m-heading-1 border-green m-bordered " >

                <?php foreach ($syspar as $s) { ?>
                 <form method="post" action = "<?php echo site_url().'/master/syspar/save_edit/'; ?>">  
                      <div class="form-body">
                         <div class="hidden">
                          <label for="form_control_1"> id</label>
                          <div class="input-icon">
                            <i class="fa fa-key font-green"></i>
                            <input type="text" style="width: 260px" name="id" class="form-control" value="<?php echo $s->id ?>" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Company id</label>
                          <div class="input-icon">
                            <i class="fa fa-key font-green"></i>
                            <input type="text" style="width: 260px" name="company_id" class="form-control" value="<?php echo $s->company_id ?>" required>
                          </div>
                        </div>
                    

                        <div class="form-group">
                          <label for="form_control_1">Name</label>
                          <div class="input-icon">
                            <i class="fa fa-user font-green"></i>
                            <input type="text" name="name" class="form-control" value="<?php echo $s->name ?>" required >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Top approval</label>
                          <div class="input-icon">
                            <i class="fa fa-user-plus font-green"></i>
                            <input type="text" name="top approval" class="form-control" value="<?php echo $s->top_approval ?>"  >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Base currency</label>
                          <div class="input-icon">
                            <select required style="width: 260px" class="form-control select2" name ="base_currency">
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

                        <div class="row">
                              <div class="col-xs-6">
                              <label for="pwd">Financial month</label>
                                <div class="input-icon">
                                  <select class="form-control select2" name ="financial_month" required="">
                                    <option value="" selected=""></option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                   
                                    </select>
                                </div>
                              </div>  

                              <div class="col-xs-6">
                                <label for="pwd">Financial year</label>
                                <div class="input-icon">
                                  <i class="fa fa-calendar-minus-o font-green"></i>
                                  <input type="number" class="form-control" name="financial_year" value="<?php echo $s->financial_year ?>" required >
                                </div>
                              </div>
                        </div>  <br>

                        <div class="row">
                              <div class="col-xs-6">
                              <label for="single" class="control-label"><b>Retained earning account<br> (accumulation)</b></label>
                                <div class="input-icon">
                                  <select class="form-control select2" name ="reaa">
                                    <option value="">Select Account</option>
                                    <?php 
                                      foreach($coa as $row)
                                      { 
                                        echo '<option value="'.$row->coa_id.'">'.$row->coa_id." - ".$row->name_coa.'</option>';
                                      }
                                    ?>
                                    </select>
                                </div>
                              </div>  

                              <div class="col-xs-6">
                                <label for="pwd">Retained earning account<br> (current year)</label>
                                <div class="input-icon">
                                   <select class="form-control select2" name ="reac">
                                    <option value="">Select Account</option>
                                    <?php 
                                      foreach($coa as $row)
                                      { 
                                        echo '<option value="'.$row->coa_id.'">'.$row->coa_id." - ".$row->name_coa.'</option>';
                                      }
                                    ?>
                                    </select>
                                </div>
                              </div>
                        </div> <br>
                         <button type="submit" class="btn green"><i class="fa fa-save"> </i> Save </button>
                         <button type="button " class="btn red" VALUE="Back" onClick="history.go(-1);return true;"><i class="fa fa-chevron-circle-left" ></i> Cancel</button>
                      </div>
                    </form>  
                <?php } ?>
              </div>
              
              
          </div>

        </div>

      </section>

    </div>

  </div>