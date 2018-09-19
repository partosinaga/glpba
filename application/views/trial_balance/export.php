
<?php
 $test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=TB.$period.xls");

header("Pragma: no-cache");

header("Expires: 0");
 echo $test;
?>
<body>
<div id="div1">
  <div>
     <table style="width:100%;">
        <tr>
          <th colspan="11"><b>TRIAL BALANCE</b></th>
        </tr>
        <tr>
          <th colspan="11">
                <?php
                  $per = New DateTime($period);
                  echo $per->format('M-Y')
                    ?>
          </th>
        </tr>
      </table>
  </div>

  <div id="body">
    <table border="1" >
      <thead>
      <tr >
        <th rowspan="2" width="100px" class="va" >ACCOUNT NO.</th>
        <th rowspan="2" >DESCRIPTION</th>
        <th colspan="3" >BEGINNING</th>
        <th colspan="3" >MUTATION</th>
        <th colspan="2" >ENDING</th>
        <th class="text-center" rowspan="2">ENDING BALANCE</th>
      </tr>
      <tr>
        <th width="150px" class="text-center">DEBIT</th>
        <th width="150px" class="text-center">CREDIT</th>
        <th width="150px" class="text-center" >BALANCE</th>

        <th width="150px" class="text-center">DEBIT</th>
        <th width="150px" class="text-center">CREDIT</th>
        <th width="150px" class="text-center" >BALANCE</th>

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
          $a = 0;
          $x = 0;
          $d = 0;
          $e = 0;
          $f = 0;
          $g = 0;
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
            $a = $a + $dBegin;
            $x = $x + $cBegin;
            $d = $d + $dMutasi;
            $e = $e + $cMutasi;
            $f = $f + $tDebit;
            $g = $g + $tCredit;
        ?>
        <!--FORMULA: ENDING BALANCE = (begining debit - begining credit) + (mutasi debit - mutasi credit) -->
        <tr>
          <td align="center"><?php echo $c->coa_id ?></td>

          <td><?php echo $c->name_coa ?></td>

          <td align="right" class="number"><?php echo $dBegin ?></td>
          <td align="right" class="number"><?php echo ($cBegin) ?></td>
          <td align="right" class="number" style="font-weight: bold;">
              <?php
                if(($c->subgroup >= 100 AND $c->subgroup <= 199) OR 
                    ($c->subgroup >= 600 AND $c->subgroup <= 799) OR 
                    ($c->subgroup >= 802 AND $c->subgroup <= 999)
                ){
                    echo ($b = $dBegin - $cBegin);
                }else{
                    echo ($b = $cBegin - $dBegin);
                }
            ?>    
          </td>

          <td align="right" class="number" ><?php echo ($dMutasi) ?></td>
          <td align="right" class="number"><?php echo ($cMutasi) ?>  </td>
          <td align="right" class="number"  style="font-weight: bold;">
              <?php
                if(($c->subgroup >= 100 AND $c->subgroup <= 199) OR 
                    ($c->subgroup >= 600 AND $c->subgroup <= 799) OR 
                    ($c->subgroup >= 802 AND $c->subgroup <= 999)
                ){
                    echo ($m = $dMutasi - $cMutasi);
                }else{
                    echo ($m = $cMutasi - $dMutasi);
                }
            ?>    
          </td>

          <td align="right" class="number">
            <?php
              if(($bgn->coa_id OR $mts->coa_id) == $c->coa_id ){
               echo $tDebit = $dBegin+$dMutasi;
              }
            ?>
          </td>
          <td align="right" class="number">
            <?php
            if(($bgn->coa_id OR $mts->coa_id) == $c->coa_id ){
              echo $tCredit = $cBegin+$cMutasi;
            }
            ?>
          </td>
          <td align="right" class="number" style="font-weight: bold;"><?php echo ($b + $m) ?> </td>

        </tr>
      <?php endforeach ?>


      </tbody>
      <tfoot>
      <tr>
        <th colspan="2">TOTAL</th>
        <th class="number" align="right"><?php echo ($a) ?></th>
        <th class="number" align="right"><?php echo ($x) ?></th>
        <th></th>
        <th class="number" align="right"><?php echo ($d) ?></th>
        <th class="number" align="right"><?php echo ($e) ?></th>
        <th></th>
        <th class="number" align="right"><?php echo ($f) ?></th>
        <th class="number" align="right"><?php echo ($g) ?></th>
        <th></th>
      </tr>
      </tfoot>
    </table>
    <a id="back-to-top" href="#" class=" btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  </div>
</div>
</body>