<?php
    $this->load->view('alert/alert');
  ?>
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
            <h3 class="box-title"><i class="fa fa-balance-scale"></i> Begining Balance</h3>
          </div>
          <div class="box-body">
              <div class="page-content-inner">
                  <div class="box-body">
                    <div class="page-content-inner">
                      


                      <div class="m-heading-1 border-green ">
                      <form method="post" action ="<?php echo site_url().'/master/begbal/set_drcr'; ?>">  
                        <table id="example" class="table table-striped table-bordered" cellspacing="0">
                        <thead>
                       
                          
                 
                          <tr>
                            <th>NO</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
                            <th class="hidden">CODE</th>
                            <th>DEBIT BALANCE</th>
                            <th>CREDIT BALANCE</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                           $no=1;
                          foreach ($begbal as $bb) 
                          { ?>
                          <tr>
                            <td> <?php echo $no++; ?> </td>
                            <td> <?php echo $bb->coa_id; ?> </td>
                            <td> <?php echo $bb->name_coa; ?> </td>
                            <td> <?php echo $bb->date; ?> </td>
                          
                            <td class="hidden"> 
                              <input type="text" name="coa_id[]" class="form-control " value="<?php echo $bb->coa_id; ?>"  >
                            </td>
                            <td> 
                              <div class="input-icon">
                                <i class="fa fa-money font-green"></i>
                                <input type="text" name="debit[]" class="form-control input text-right" value="<?php echo $bb->debit; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                              </div>
                            </td>
                            <td>
                             <div class="input-icon">
                                <i class="fa fa-money font-green"></i>
                                <input type="text" name="credit[]" class="form-control input text-right" value="<?php echo $bb->credit; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                             </div>
                            </td>                   
                          </tr>
                          <?php } ?>
                          </tbody>
                          <tr>
                            <td colspan="5" align="right">
                      
                          </td>
                           <td >
                              <button type="submit" style="width: 200px"  class="btn green"><i class="fa fa-plus-square"> </i> Submit </button>
                            </td>
                          </tr>
                        </table>
                      </form>

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