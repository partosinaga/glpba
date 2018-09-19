  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        </h1>
      </section>


      <section class="content">
        <div class="box box-success " >
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-binoculars"></i> Trial Balance Form</h3>
          </div>
          <div class="box-body">
            <div class="" style="margin-left: 20px">
              <form method="get" target="_blank" action="<?php echo site_url("trial_balance/trial_balance/view_tb") ?>">
                <div class="row">

                  <div class="col-md-3" >
                    <div class="form-group ">
                      <label for="form_control_1">Periode</label>
                        <div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm" data-date-viewmode="years">
                          <input type="text" class="form-control input" name="periode" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                              <i class="fa fa-calendar"></i>
                            </button>
                          </span>
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

  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <script type="text/javascript">
 $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy'});
    });​
  </script>
  <style type="text/css">
.ui-datepicker-calendar {
   display: none;
}
  </style>