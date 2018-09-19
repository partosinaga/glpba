  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      
      </section>


      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class=" fa fa-window-close-o"></i> Close Year</h3>
          </div>
          <div class="box-body " >
            <div class="note note-danger" style="text-align: center;">
                <h4 class=""><i class="fa  fa-warning font-red"></i></h4>
                <p>Make Sure to <b>PRINT</b> Previous Period Report !</p> <br>
            </div>
              <form method="post" action="<?php echo site_url('close_year/close_year/close') ?>">
                  <div class="" align="center">
                    <div class="col-md-12" >
                      <div class="form-group input-small ">
                        <input type="number" class="form-control text-center" value="<?php echo date("Y") ?>" name="year"> 
                      </div>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"> </i> Process </button>
                    <a href="<?php echo site_url('home/dashboard') ?>"><button type="button" class="btn btn-danger" name="save"><i class="fa fa-remove" ></i> Cancel</button></a>
                  </div>
              </form>
          </div>
        </div>
      </section>

    </div>

  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  