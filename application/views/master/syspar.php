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
            <h3 class="box-title"><i class="fa fa-institution"></i> System parameter</h3>
          </div>
          <div class="box-body">
             
              <div  style="padding-left: 250px; padding-right: 250px"> 
                <div class="m-heading-1 border-green m-bordered " >

                <?php foreach ($syspar as $s) { ?>
                  <form method="post" action = "<?php echo site_url().'/master/syspar/edit_syspar/'; ?>"> 
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
                            <input type="text" style="width: 260px" name="company_id" class="form-control" value="<?php echo $s->company_id ?>" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Name</label>
                          <div class="input-icon">
                            <i class="fa fa-user font-green"></i>
                            <input type="text" name="name" class="form-control" value="<?php echo $s->name ?>" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Top approval</label>
                          <div class="input-icon">
                            <i class="fa fa-user-plus font-green"></i>
                            <input type="text" name="top approval" class="form-control" value="<?php echo $s->top_approval ?>" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="form_control_1">Base currency</label>
                          <div class="input-icon">
                            <i class="fa fa-dollar font-green"></i>
                            <input style="width: 260px"  type="text" name="base_currency" class="form-control" value="<?php echo $s->curr_name ?>" readonly>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xs-6">
                            <label for="pwd">Financial month</label>
                            <div class="input-icon">
                              <i class="fa fa-calendar-plus-o font-green"></i>
                              <input type="number" class="form-control" name="financial_month" value="<?php echo $s->financial_month ?>" readonly>
                            </div>
                          </div>  

                              <div class="col-xs-6">
                                <label for="pwd">Financial year</label>
                                <div class="input-icon">
                                  <i class="fa fa-calendar-minus-o font-green"></i>
                                  <input type="number" class="form-control" name="financial_year" value="<?php echo $s->financial_year ?>" readonly>
                                </div>
                              </div>
                        </div>  <br>

                        <div class="row">
                              <div class="col-xs-6">
                              <label for="pwd">Retained earning account (accumulation)</label>
                                <div class="input-icon">
                                  <i class="fa fa-money font-green"></i>
                                    <input type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" class="form-control" name="reaa" 
                                       value="<?php echo $s->reaa ?>" readonly>
                                </div>
                              </div>  

                              <div class="col-xs-6">
                                <label for="pwd">Retained earning account (current year)</label>
                                <div class="input-icon">
                                  <i class="fa fa-money font-green"></i>
                                   <input type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" class="form-control" name="reac" 
                                  value="<?php echo $s->reac?>" readonly>
                                </div>
                              </div>
                        </div> <br>
                         <button type="submit" class="btn green"><i class="fa fa-edit"> </i> Edit </button>
                      </div>
                    </form>
                  <?php } ?>
              </div>
              
              
          </div>

        </div>

      </section>

    </div>

  </div>