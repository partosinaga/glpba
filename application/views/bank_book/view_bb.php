<!DOCTYPE html>
<html>
<head>
  <title>Bank Book</title>
  <link href="<?php echo base_url(); ?>resource/bank_book.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url(); ?>resource/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo base_url(); ?>resource/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
  function printContent(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
  }
</script>
</head>
<a onclick="printContent('div1')" >
  <button style="background-color: #cc0000" type="button" class="btn btn-block btn-primary btn-flat"><h3>Print</h3></button>
</a>
<body>
  <div id="div1">
    
    <div>  
        <table style="width:100%;">
          <tr>
            <td class="text-center bb" ><strong>BANK BOOK</strong></td><br>
          </tr>
          <tr>
            <td class="text-center" style="font-size: 12pt;"><?php echo $account_code.' - '. $bank_name ?></td><br>
          </tr>
          <tr>
            <td class="text-center" style="font-size:9pt ">(Period End Of: 
              <?php
              $per = New DateTime($period);
              echo $per->format('d-M-Y');
               ?>)</td>
          </tr>
        </table>
    </div>

    <div id="body">
      <?php 
              echo '
                <tr align="right">
                  <td>Printed by:</td>
                  <td>'.$this->session->userdata('username').'</td>
                </tr><br>
                <tr>
                  <td>Date/time: </td>
                  <td>'.date('d-M-Y'). ' / ' . date('H;i;sa').'</td>
                </tr>'; 
          ?>
      <table   style="width:100%;margin-bottom: 20px;" class="table_detail">
        <thead>
          <tr>
            <th width="50px">VOUCHER</th>
            <th width="60px">DATE</th>
            <th width="50px" >MODULE</th>
            <th align="center">DESCRIPTION</th>
            <th width="100px">DEBIT</th>
            <th width="100px">CREDIT</th>
            <th width="100px">SALDO</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $balance=0;
            foreach ($bb as $b){
            if($b->debit >= 0) {
                $balance += ($b->debit - $b->credit);  
              } else{
                $balance += ($b->credit - $b->debit);
                
            };
          ?>
          <tr>
            <td><?php echo $b->gl_no ?></td>
            <td><?php 
              $dt = New DateTime($b->gl_date);
              echo $dt->format('d-m-Y') ?>
            </td>
            <td align="center"><?php echo strtoupper($b->Fmodule) ?></td>
            <td><?php echo $b->description ?></td>
            <td align="right"><?php echo number_format($b->debit) ?></td>
            <td align="right"><?php echo number_format($b->credit) ?></td>
            <td align="right"><b><?php echo number_format($balance) ?></b></td>
           <tr>
           <?php } ?>
        </tbody>
        <footer>
            <th colspan="6" >TOTAL</th>
            <th align="right"><b><?php echo number_format($balance) ?><b></th>
        </footer>
      </table>
    </div>
  </div>
</body>
</html>
<style type="text/css">
.bb{
  font-size: 20pt;
  font-family: Courier, monospace;
}
</style>