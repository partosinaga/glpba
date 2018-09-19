  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          A<small>ccount</small> P<small>ayable</small>
          
        </h1>
      </section>

      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-check"></i> Payment Voucher Approval</h3>
          </div>
          <div class="box-body">
            <div class="page-content-inner">
                <table id="example" class="table table-striped table-bordered" cellspacing="0">
                  <thead bgcolor="#1BBC9B"> 
                        <tr>
                          <th width="120px">NO. VOUCHER</th>
                          <th width="100px">DATE</th>
                          <th>DESCRIPTION</th>
                          <th width="100px">TOTAL</th>
                          <th width="40px" >ACTION</th>
                      </tr>     
                  </thead>
                  <tbody>
                  	<?php 
                  		foreach ($onest as $o) {
                  	 ?>
                  	 <tr>
                  	 	<td><?php echo $o->no_voucher ?></td>
                  	 	<td><?php echo $o->date ?></td>
                  	 	<td><?php echo $o->description ?></td>
                  	 	<td align="right"><?php echo number_format($o->total) ?></td>
                  	 	<td>
                  	 		<a href="<?php echo site_url('ap/approve/ap_detail?id=').$o->no_voucher ?>">
                  	 			<button class="btn green btn-xs"><i class="fa fa-search"></i> Detail
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