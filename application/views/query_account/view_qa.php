  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           Q<small>uery</small>A<small>ccount</small>
           
        </h1>
      </section>


      <section class="content">
       
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-binoculars"></i> Query Acount List</h3>
          </div>
          <div class="box-body">
              <div class="page-content-inner">

                <div  class="col-md-12" >
                  <div class="color-demo tooltips">
                    <div style="height: 90px" class="color-view bg-blue-sharp bg-font-grey-gallery bold uppercase"> 
                      ACCOUNT NUMBER : <?php echo $coa_id ?> <br> MODULE : <?php echo $module; ?>
                    </div>
                    <div class="color-info bg-white c-font-14 sbold">
                      <a href="<?php echo site_url().'/query_account/query_account/qa_form' ?>"> 
                        <button type="submit" class="btn green"><i class="fa fa-arrow-circle-left"> </i> Back </button>
                      </a>
                    </div>
                  </div>
                </div>

                
                 <table id="example" class="table table-striped table-bordered" cellspacing="0"><br><br><br><br><br><br><br><br><br><br>
                      <thead bgcolor="#5C9BD1">
                        
                        <tr>
                          <th width="30" >VOUCHER NO.</th>
                          <th width="40px">VOUCHER DATE</th>
                          <th width="20px">STATUS</th>
                          <th width="40px">JOURNAL NO.</th>
                          <th>DESCRIPTION</th>
                          <th width="100px">DEBIT</th>
                          <th width="100px">CREDIT</th>
                      </tr>
                        
                      </thead>
                      <tbody>
                        <?php
                          foreach ($qaList as $qa) {?>
                     
                        <tr>
                          <td><?php echo $qa->reff_no ?></td>
                          <td><?php echo $qa->gl_date ?></td>
                          <td> <span class="label label-info"> <?php echo $qa->status ?></span></td>
                          <td><?php echo $qa->gl_no ?></td>
                          <td><?php echo $qa->description ?></td>
                          <td align="right"><?php echo number_format($qa->debit) ?></td>
                          <td align="right"><?php echo number_format($qa->credit) ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
              </div>
          </div>

        </div>

      </section>

    </div>

  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
</script>