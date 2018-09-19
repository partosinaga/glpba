  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>
      <section class="content">
        <div  class="box box-success col-md-6" style="margin-left: 300px" >
          <div class="box-header with-border">
            <h3 class="box-title">Unclose Month</h3>
          </div>
          <div  class="box-body ">
            <div class="col-md-6">
              <div  style="overflow-y:scroll; height:300px;">
                <table   width="40%" class="table table-striped table-bordered" >
                  <thead bgcolor="#1BBC9B" >
                    <tr>
                      <th colspan="2" class="text-center" >UNCLOSED LIST</th>
                    </tr>
                    <tr>
                      <th class="text-center" width="30px" >MONTH</th>
                      <th class="text-center" width="30px" >YEAR</th>
                    </tr>
                  </thead>
                  <tbody align="center">
                    <?php foreach ($unclose as $uc) { ?>
                    <tr>
                      <td><?php echo $uc->month ?></td>
                      <td><?php echo $uc->year ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
              </table>
            </div>  
          </div>  


            <div class="pull-right">
              <form method="post" action="<?php echo site_url("unclose_month/unclose_month/unclose") ?>">
                <div class="form-group ">
                  <label for="form control">LAST CLOSED MONTH</label>
                    
                      <input type="text" value="<?php  $d = New Datetime($last->last_date); echo $d->format('Y-m') ?>" class="form-control input" name="period"
                      readonly>
                        
                        
                </div>
                  <button type="submit" class="btn green"><i class="fa fa-remove"> </i> Unclose </button>
              </form>
            </div>

          </div>
        </div>
      </section>
    </div>
  </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


