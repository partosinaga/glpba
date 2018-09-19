  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           J<small>ournal</small> V<small>oucher</small>
        </h1>
      </section>


      <section class="content">
       
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-book"></i> Receipt Voucher List</h3>
          </div>
          <div class="box-body">
              <div class="page-content-inner">
                <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead bgcolor="#578EBE">
                        
                        <tr>
                         <th width="30px">NO</th>
                          <th width="100px">NO. VOUCHER</th>
                          <th width="50px">DATE</th>
                          <th>DESCRIPTION</th>
                          <th width="100px">GL DATE</th>
                          <th width="100px">TOTAL</th>
                          <th width="30px" >ACTION</th>
                      </tr>
                        
                      </thead>
                      <tbody >

                        <?php 
                          $no=1;
                          foreach ($jvList as $jv) {
                            ?>                        
                        <tr>

                          <td><?php echo $no++ ?></td>
                          <td><?php echo $jv->no_voucher ?></td>
                          <td>
                            <?php  
                                $date = New DateTime($jv->date);
                                echo $date->format("d-m-Y"); 
                              ?>
                          </td>
                          <td><?php echo $jv->description ?></td>

                          <td align="center" >
                            <a style="color: black" data-target="#static<?php echo $jv->id ?>" data-toggle="modal">   
                              <?php  
                                $date = New DateTime($jv->gl_date);
                                echo $date->format("d-m-Y"); 
                              ?>    
                          </td>
                          
                          <td align="right"><?php echo number_format($jv->total) ?></td>
                        
                          <td align="center">  
                            <div class="btn-group">
                              <button class="btn red blue-hoki-stripe btn-xs dropdown-toggle" data-toggle="dropdown"><i class="angle-down"></i> Action
                                <i class="fa fa-angle-down"></i>
                              </button>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a class="view_data"  name="view" value="view" id="<?php echo $jv->no_voucher ?>"  ><i class="fa fa-search"></i> Detail </a>
                                  </li>
                                  <li>
                                    <!-- CEK APAKAH TOTAL > 50JT OR NOT -->
                                  <?php
                                    $result='';
                                    if ($jv->total >= 50000000 ) {
                                      $result .= '<a href ="'.site_url('/jv/jv/print_jv_up?id=').$jv->no_voucher.'" target="_blank"  "><i class="fa fa-print"></i> Print
                                        </a>';
                                    }else{
                                       $result .= '<a href ="'.site_url('/jv/jv/print_jv?id=').$jv->no_voucher.'" target="_blank"  "><i class="fa fa-print"></i> Print
                                        </a>';
                                    }
                                    echo $result;
                                  ?>
                                   <!-- END CEK APAKAH TOTAL > 50JT OR NOT -->
                                  </li>
                                  <?php
                                  $result = '<li>';  
                                  if ($jv->status == "posted" AND $jv->Fclose = "close" OR $jv->Fmonth == 'close') {
                                    echo '
                                      <li>
                                      </li>
                                    ';
                                  } else {
                                    $result .= '<a href='.site_url('jv/jv/edit_jv?id=').$jv->no_voucher.' >
                                                  <i class="fa fa-edit">  </i> Edit
                                                </a> </li>';
                                  };
                                  echo $result;

                                ?>
                                
                                </ul>
                            </div>
                          </td>
                        </tr>



<!--EDIT GL DATE-->
    <div id="static<?php echo $jv->id ?>" class="modal fade modale"  data-backdrop="static" data-keyboard="false">
      <div class="modal-body">
        <form method="post" action="<?php echo site_url('jv/jv/edit_glDate?id=').$jv->no_voucher ?>">
          <div class="col-md-4">
            <label for="single" class="control-label">
             <b>Day</b>
            </label>
            <div class="input-icon">
              <select  class="form-control select2 input-sm" name ="day" required>
                <option value="a" selected="" disabled="">Choose Day</option>
                <?php
                  for ($i=1; $i <= 31; $i++) { 
                    if ($i < 10) {
                      $i = '0'.$i;
                    }
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="single" class="control-label">
              <b>Month</b>
            </label>
            <div class="input-icon">
              <select  class="form-control select2" name ="month" required>
                <option value="b" selected="" disabled="">Choose Month</option>
                <option value="01">01 - Jan</option>
                <option value="02">02 - Feb</option>
                <option value="03">03 - Mar</option>
                <option value="04">04 - Apr</option>
                <option value="05">05 - Mei</option>
                <option value="05">06 - Jun</option>
                <option value="07">07 - Jul</option>
                <option value="08">08 - Ags</option>
                <option value="09">09 - Spt</option>
                <option value="10">10 - Oct</option>
                <option value="11">11 - Nov</option>
                <option value="12">12 - Des</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <label for="single" class="control-label">
              <b>Year</b>
            </label>
            <div class="input-icon">
              <select class="form-control select2" name ="year" required>
                <option value="a" selected="" disabled="">Choose Year</option>
                <?php 
                  $cr = date("Y");
                  $pr = date("Y")-1;
                  $nx = date("Y")+1;
                ?>
                <option value="<?php echo $pr ?>"><?php echo $pr ?></option>
                <option value="<?php echo $cr ?>"><?php echo $cr ?></option>
                <option value="<?php echo $nx ?>"><?php echo $nx ?></option>
              </select>
            </div>
          </div><br><br><br><br><br>
          <div >
            <div class="col-md-4">
              <button type="submit"  class="btn green blue-hoki-stripe"><i class="fa fa-save"></i> Save</button>
            </div>
            <div class="col-md-4 text-center" style="background-color: #e0ebeb">
               <label> <?php echo $jv->no_voucher ?> </label>
            </div>
            <div class="col-md-4">
              <button type="button" data-dismiss="modal" class="btn red blue-hoki-stripe pull-right"><i class="fa fa-remove"></i> Cancel</button>
            </div>

          </div>
        </form>
      </div>
      
    </div>
<!--EDIT GL DATE-->



     
                       <?php } ?>


                      </tbody>
                        
                    </table>
                    <div class="note note-info">
                      <h4 class="block"><i class="fa  fa-info-circle"></i> PS</h4>
                      <p><b>Edit</b> can only be done for transactions that are not Posted <b>AND/OR</b> not Close Month </p>
                    </div>
              </div>
          </div>

        </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </section>

    </div>

  </div>


  <!--modals-->
    <div width="1000px"  id="dataModal" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
        <h4 align="center"><i class="fa fa-search-plus"></i> TRANSACTION DETAIL</h4>  
      </div>

      <div class="modal-body" id="transaction_detail" >
      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn red blue-hoki-stripe"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
<!--modals-->

<script type="text/javascript">
 $(document).ready(function(){
    $('.view_data').click(function(){
      var transaction_detail = $(this).attr("id");

      $.ajax({
        url:"<?php echo base_url('index.php/jv/jv/detail_jv');?>",
        method:"post", 
        data:{transaction_detail:transaction_detail},
        success:function(data){
          $('#transaction_detail').html(data);
          $('#dataModal').modal("show");

        }
      });

    });
 });

 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<style type="text/css">
  .modal-header {
   background:#578EBE;
}
.modale {
   top: 10px;
   bottom: 520px;
   overflow: auto;
   overflow-y: auto;
}
</style>
