  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <small>Account</small> <small>Receivable (AR)</small>
          
        </h1>
      </section>


      <section class="content">
        
        <div class="box box-success">
          <div class="box-header with-border" align="center">
            <h3 class="box-title"><i class="fa fa-remove"></i> Canceled Voucher List</h3>
          </div>
          <div class="box-body">

              <div class="page-content-inner">
              
                <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead bgcolor="#1BBC9B">
                        
                        <tr>
                          <th width="30px">NO</th>
                          <th width="100px">NO. VOUCHER</th>
                          <th width="50px">DATE</th>
                          <th>DESCRIPTION</th>
                          <th width="100px">RECEIVE FROM</th>
                          <th width="100px">GL DATE</th>
                          <th width="100px">TOTAL</th>
                          <th width="40px" >ACTION</th>
                      </tr>
                        
                      </thead>
                      <tbody>

                        <?php 
                          $no=1;
                          foreach ($cancel as $cc) {
                            ?>                        
                        <tr>

                          <td><?php echo $no++ ?></td>
                          <td><?php echo $cc->no_voucher ?></td>
                          <td><?php $d=New DateTime($cc->date); echo $d->format('d-m-Y') ?></td>
                          <td><?php echo $cc->description ?></td>
                          <td><?php echo $cc->receive_from ?></td>

                          <td align="center" >  
                              <?php  
                                $date = New DateTime($cc->gl_date);
                                echo $date->format("d-m-Y");
                              ?>    
                          </td>
                          <td align="right"><?php echo number_format($cc->total) ?></td>
                          <td align="center">  
                            <a href="<?php echo site_url("ar/ar/open_ar?id=".$cc->no_voucher) ?>">
                              <button class="btn blue-hoki red-stripe btn-xs "><i class="fa fa-check"></i> Open
                              </button>
                            </a>
                          </td>
                        </tr>
                       <?php } ?>


                      </tbody>
                        
                    </table>
              </div>
          </div>

        </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </section>

    </div>

  </div>





<style type="text/css">
  .modal-header {
   background:#1BBC9B;
}
</style>


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
        url:"<?php echo base_url('index.php/ar/ar/detail_ar');?>",
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
.modale {
   top: 10px;
   bottom: 70%;
   overflow: auto;
   overflow-y: auto;
}
.modal-header {
   background:#1BBC9B;
}
</style>