  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           S<small>ubsidiary</small> L<small>edger</small>
        </h1>
      </section>


      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-binoculars"></i> Subsidiary Ledger Form</h3>
          </div>
          <div class="box-body">
            <div class="page-content-inner">
              <form method="post" target="_blank" action="<?php echo site_url("subs_ledger/subs_ledger/view_sl") ?>">
                  
                <div class="row ">
                  <div class="col-md-3">
                      <label for="form_control_1">DATE</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3" >
                    <div class="form-group ">
                      <label for="form_control_1">From</label>
                        <div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                          <input type="text" class="form-control input" name="date_from" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                              <i class="fa fa-calendar"></i>
                            </button>
                          </span>
                        </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group ">
                      <label for="form_control_1">To</label>
                        <div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                          <input type="text" class="form-control input" name="date_to" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                              <i class="fa fa-calendar"></i>
                            </button>
                          </span>
                        </div>
                    </div>
                  </div>
                </div> <br>




              <div class="row ">
                  <div class="col-md-3">
                      <label for="form_control_1">ACCOUNT NUMBER</label>
                  </div>
                </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group ">
                    <label for="form_control_1">From</label>
                      <div class="input-group input-medium " >

                        <select id="bank_id" class="form-control select2" name ="coa_from">
                          <option value="" selected >--select bank code-- </option>    
                          <?php
                            foreach ($coa->result_array() as $c) {
                              echo '
                                <option value="'.$c['coa_id'].'"> '.$c['coa_id'].' - '.$c['name_coa'].'  </option>
                              ';
                            }
                          ?>    
                        </select>
                          
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group ">
                    <label for="form_control_1">To</label>
                      <div class="input-group input-medium "  >
                        <select id="bank_id" class="form-control select2" name ="coa_to">
                            
                          <?php
                            foreach ($coa->result_array() as $c) {
                              echo '
                                <option value="" selected >Select</option>   
                                <option value="'.$c['coa_id'].'"> '.$c['coa_id'].' - '.$c['name_coa'].'  </option>
                              ';
                            }
                          ?>    
                        </select>
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <a href="<?php echo site_url().'/subs_ledger/subs_ledger/view_sl' ?>"> 
                  <button type="submit" class="btn green"><i class="fa fa-search"> </i> View </button>
                </a>
              </div>

              </form>
            </div>


          </div>
        </div>
      </section>

    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<script type="text/javascript">
 
</script>