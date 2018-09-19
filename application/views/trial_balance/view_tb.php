<!DOCTYPE html>
<html>
<head>
  <title>IEM | Trial Balance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?php echo base_url(); ?>resource/trial_balance.css" rel="stylesheet" type="text/css"/>
  <!-- <link href="<?php echo base_url(); ?>resource/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> -->
  <!--  <script src="<?php echo base_url(); ?>resource/global/plugins/jquery.min.js" type="text/javascript"></script> -->
  <script>
    function printContent(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
    }
  </script>
  <?php
  $sql ="SELECT * FROM system_parameter";
  $query = $this->db->query($sql);
  if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
      ?>
    <?php } } ?>
</head>
<div class="dropdown" style="position: fixed;">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-magic"></i> Action
    <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li ><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
     <li ><a target="_blank" href="<?php echo site_url('trial_balance/trial_balance/export?id=').$period ?>"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
  </ul>
</div>
<body>
<div id="div1">
  <div>
    <table style="width:100%;" >
      <tr>
        <p align="center" style="font-size:14pt;" ><?php echo strtoupper($row->name); ?></p>
        <p align="center" style="font-size:14pt ">TRIAL BALANCE</p>
        <p class="text-center" style="font-size:10pt ">Date :
          <?php
          $per = New DateTime($period);
          echo $per->format('M-Y')
          ?>
        </p>
      </tr>
    </table>
  </div>

  <div id="body">
    <i align="right">FORMULA : Ending Balance = (begining debit + mutasi debit) - (begining credit + mutasi credit)</i>
    <table class="table-hover" id="table" >
      <thead>
      <tr >
        <th rowspan="2" width="10px" class="va" >#</th>
        <th rowspan="2" width="100px" class="va" >ACCOUNT NO.</th>
        <th rowspan="2" >DESCRIPTION</th>
        <th colspan="2" >BEGINNING</th>
        <th colspan="2" >MUTATION</th>
        <th colspan="2" >ENDING</th>
        <th class="text-center" rowspan="2">ENDING BALANCE</th>
      </tr>
      <tr>
        <th width="150px" class="text-center">DEBIT</th>
        <th width="150px" class="text-center">CREDIT</th>
        <th width="150px" class="text-center" hidden="">BALANCE</th>

        <th width="150px" class="text-center">DEBIT</th>
        <th width="150px" class="text-center">CREDIT</th>
        <th width="150px" class="text-center" hidden="">BALANCE</th>

        <th width="150px" class="text-center">DEBIT</th>
        <th width="150px" class="text-center">CREDIT</th>
        
      </tr>
      </thead>

      <tbody class="table-body">
      <?php
          $no=1;
          $dBegin = 0;
          $cBegin = 0;
          $dMutasi = 0;
          $cMutasi = 0;
          $tDebit = 0;
          $tCredit= 0;
          foreach($coa as $c):
            foreach($begining as $bgn){
              if($bgn->coa_id == $c->coa_id){
                $dBegin = $bgn->d_begin;
                $cBegin = $bgn->c_begin;
                break;
              }else{
                $dBegin = 0;
                $cBegin = 0;
              }
            }
            foreach($mutasi as $mts){
              if($mts->coa_id == $c->coa_id){
                $dMutasi = $mts->d_mutasi;
                $cMutasi = $mts->c_mutasi;
                break;
              }else{
                $dMutasi = 0;
                $cMutasi = 0;
              }
            }
        ?>
        <!--FORMULA: ENDING BALANCE = (begining debit - begining credit) + (mutasi debit - mutasi credit) -->
        <tr>
          <td align="center"><?php echo $no++ ?></td>
          <td align="center"><?php echo $c->coa_id ?></td>

          <td><?php echo $c->name_coa ?></td>

          <td align="right" class="begin-debit"><?php echo $dBegin ?></td>
          <td align="right" class="begin-credit"><?php echo ($cBegin) ?></td>
          <td align="right" class=""  bgcolor="red" hidden="">
              <?php
                if(($c->subgroup >= 100 AND $c->subgroup <= 199) OR 
                    ($c->subgroup >= 600 AND $c->subgroup <= 799) OR 
                    ($c->subgroup >= 802 AND $c->subgroup <= 999)
                ){
                    echo number_format($b = $dBegin - $cBegin);
                }else{
                    echo number_format($b = $cBegin - $dBegin);
                }
            ?>    
          </td>

          <td align="right" class="mutasi-debit" ><?php echo ($dMutasi) ?></td>
          <td align="right" class="mutasi-credit"><?php echo ($cMutasi) ?>  </td>
          <td align="right" class=""  bgcolor="red" hidden="">
              <?php
                if(($c->subgroup >= 100 AND $c->subgroup <= 199) OR 
                    ($c->subgroup >= 600 AND $c->subgroup <= 799) OR 
                    ($c->subgroup >= 802 AND $c->subgroup <= 999)
                ){
                    echo number_format($m = $dMutasi - $cMutasi);
                }else{
                    echo number_format($m = $cMutasi - $dMutasi);
                }
            ?>    
          </td>

          <td align="right" class="total-debit">
            <?php
              if(($bgn->coa_id OR $mts->coa_id) == $c->coa_id ){
               echo $tDebit = $dBegin+$dMutasi;
              }
            ?>
          </td>
          <td align="right" class="total-credit">
            <?php
            if(($bgn->coa_id OR $mts->coa_id) == $c->coa_id ){
              echo $tCredit = $cBegin+$cMutasi;
            }
            ?>
          </td>
          <td align="right" style="font-weight: bold;"><?php echo number_format($b + $m) ?> </td>

        </tr>
      <?php endforeach ?>


      </tbody>
      <tfoot>
      <tr>
        <th colspan="3">TOTAL</th>
        <th class="sum-begin-debit text-right"></th>
        <th class="sum-begin-credit text-right"></th>
        <th class="sum-mutasi-debit text-right"></th>
        <th class="sum-mutasi-credit text-right"></th>
        <th class="sum-total-debit text-right"></th>
        <th class="sum-total-credit text-right"></th>
      </tr>
      </tfoot>
    </table>
    <a id="back-to-top" href="#" class=" btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  </div>
</div>
</body>
</html>
<i class="pull-right"><?php echo 'Page render time:' .$this->benchmark->elapsed_time('code_start', 'code_end'); ?></i>
<style type="text/css">
/*  tr:nth-child(even) {background: #f4f4f4}
  tr:nth-child(odd) {background: #FFF}*/

  .back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
  }
</style>

<script type="text/javascript">


  $(document).ready(function(){

    //SUM BEGINING
    var BgnDebit = 0;
    $(".begin-debit").each(function () {
      BgnDebit += parseInt($(this).html());
      var num = BgnDebit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-begin-debit").html(num);
    });

    var BgnCredit = 0;
    $(".begin-credit").each(function(){
      BgnCredit += parseInt($(this).html());
      var num = BgnCredit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-begin-credit").html(num);
    });
    // END OF SUM BEGININ

    //SUM MUTATION
    var MtnDebit = 0;
    $(".mutasi-debit").each(function(){
      MtnDebit += parseInt($(this).html());
      var num = MtnDebit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-mutasi-debit").html(num);
    });

    var MtnCredit = 0;
    $(".mutasi-credit").each(function(){
      MtnCredit += parseInt($(this).html());
      var num = MtnCredit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-mutasi-credit").html(num);
    });
    //END OF SUM MUTATION

    //SUM TOTAL
    var TtlDedit = 0;
    $(".total-debit").each(function(){
      TtlDedit += parseInt($(this).html());
      var num = TtlDedit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-total-debit").html(num);
    });

    var TtlCredit = 0;
    $(".total-credit").each(function(){
      TtlCredit += parseInt($(this).html());
      var num = TtlCredit.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      $(".sum-total-credit").html(num);
    });
    //END OF SUM TOTAL

    //TO NUMBER FORMAT ALL ROW
    $("td.begin-debit, td.begin-credit, td.mutasi-debit, td.mutasi-credit, td.total-debit, td.total-credit").each(function() {
      $(this).html(parseFloat($(this).text()).toLocaleString('en-US'));
    });
    //END OF NUMBER FORMAT ALL ROW

    $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
      } else {
        $('#back-to-top').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
      $('#back-to-top').tooltip('hide');
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
    $('#back-to-top').tooltip('show');


  });
</script>