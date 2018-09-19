  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           Q<small>uery</small> A<small>ccount</small>
        </h1>
      </section>


      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-binoculars"></i> Query Acount Form</h3>
          </div>
          <div class="box-body">
            <div class="page-content-inner">
              <form method="post" action="<?php echo site_url("query_account/query_account/view_qa") ?>">
                <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="form_control_1">ACCOUNT CODE</label>
                          <div class="input-icon">
                            <select  class="form-control select2" name ="coa_id" required>
                              <option value="" selected ></option>
                              <?php
                                foreach ($coaGL->result_array() as $data){
                                  echo "<option value=".$data["coa_id"]." >"
                                                       .$data["coa_id"]."-".$data["name_coa"];
                                        "</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group ">
                        <label for="form_control_1">MODULE</label>
                          <div class="input-icon">
                            <select  class="form-control select2" name ="module" required>
                              <option value="" selected >sdfg</option>
                              <option value="ar"  >AR - Account Receivable</option>
                              <option value="ap"  >AP - Account Payable</option>
                              <option value="jv"  >JV - Journal Voucher</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>
                      


                      <div class="col-md-4">
                        <div class="form-group ">
                        <label for="form_control_1">&nbsp</label>
                          <div class="input-icon">
                            <button type="submit" class="btn green"><i class="fa fa-search"> </i> View </button>  
                          </div>
                        </div>
                      </div>


                    </div>
              </form>
            </div>
          </div>
        </div>
      </section>

    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>