 <?php
 $test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

 header("Content-Disposition: attachment; filename=PL-".$periode.".xls");

header("Pragma: no-cache");

header("Expires: 0");
 echo $test;
?>
<body>
  <div id="div1">
    

      <table>
        <tr>
          <td colspan="3" align="center"><b>JMA</b></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b>PROFIT LOSS</b></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b>
                  (Periode: <?php
                    $per = New DateTime($periode);
                    echo $per->format('M-Y');
                  ?>)</b>
          </td>
        </tr>
      </table>

   <hr class="style3">

    <div id="body">

      <table   style="width:100%;" class="table_detail">
        <thead>
          <tr >
            <th width=""></th>
            <th class="head_col">CURRENT MONTH</th>
            <th class="head_col">YEAR TO DATE</th>
          </tr>
        </thead>
        <tbody>

          <!-- PENDAPATAN -->
          <tr>
            <td class="group"><b>PENDAPATAN USAHA</b></td>
            <td></td>
            <td></td>
          </tr>
          <?php
            $a=0;
              foreach ($prevIncome as $pi) {
                foreach ($income as $in) {
                  if ($pi->coa_id == $in->coa_id) {
                    $a = $in->income;
                  } else if (count($pi->coa_id) < count($in->coa_id)) {
                    $a = 0;
                  };
                }
          ?>
            <tr>
              <td class="content" style="padding-left: 4em"><?php echo $pi->name_coa ?></td>
              <td class="number"><?php echo ($a) ?></td>
              <td class="number" align="right"><?php echo ($pi->prev_income) ?></td>


              </td>
            </tr>
          <?php  } ?>
          <!-- END OF PENDAPATAN -->

          <!-- TOTAL PENDAPATAN -->
          <tr>
            <td></td>
            <td><hr></td>
            <td><hr></td>
          </tr>
          <?php
            foreach ($sumIncome as $si) {
          ?>
            <tr>
              <td  bgcolor="#f9f4f4"  class="group2"><B>TOTAL PENDAPATAN (i)</B></td>
              <td bgcolor="#f9f4f4" class="number" align="right"><b><?php echo ($si->sum_income) ?></b></td>
              <td bgcolor="#f9f4f4" class="number" align="right"><b> <?php
                    if (!empty($pi->prev_income)) {
                      echo ($spi->prev_sum_income);
                    } else {
                      echo (0);
                    }
                   ?> </b>
             </td>
            </tr>
          <?php } ?>
          <!-- END OF TOTAL PENDAPATAN -->

          <tr>
            <td></td>
            <td><hr></td>
            <td><hr></td>
          </tr>



          <!-- LABA KOTOR -->
          <tr>
            <td></td>
            <td><hr class="style2"></td>
            <td><hr class="style2"></td>
          </tr>
          <?php
            $laba_kotor = 0;
            $laba_kotor = $si->sum_income;

            $laba_kotor_prev = 0;
            $laba_kotor_prev = $sumPrevIncome->prev_sum_income

          ?>
          <tr>
            <td bgcolor="#f9f4f4" class="group2"><B>LABA KOTOR (iii=i-ii)</B></td>
            <td bgcolor="#f9f4f4" class="number" align="right"><b><?php echo ($laba_kotor) ?></b> </td>
            <td bgcolor="#f9f4f4" class="number" align="right"><b><?php echo ($laba_kotor_prev) ?></b></td>
          </tr>
          <!-- END OF LABA KOTOR -->

          <tr>
            <td></td>
            <td><hr class="style2"></td>
            <td><hr class="style2"></td>
          </tr>

          <!-- EXPENSE -->
          <tr>
            <td class="group"><b>BIAYA OPERASIONAL</b></td>
            <td></td>
            <td></td>
          </tr>
           <?php
            $b=0;
              foreach ($prevExpense as $pe) {
                foreach ($expense as $ex) {
                  if ($ex->coa_id == $pe->coa_id) {
                    break;
                  }
                }
            ?>
            <tr>
              <td class="content" style="padding-left: 4em">
                <?php
                  if (count($ex->name_coa) > count($pe->name_coa)) {
                    echo $ex->name_coa;
                  } else {
                    echo $pe->name_coa;
                  }
                ?>
              </td>
              <td class="number" align="right">
                <?php
                  if (($ex->coa_id == $pe->coa_id) == 0  ) {
                     echo 0;
                   } else {
                      echo ($ex->expense) ;
                   }
               ?>
              </td>
              <td class="number" align="right">
                <?php echo ($pe->prev_expense) ?>
              </td>
            </tr>
          <?php } ?>
          <!-- END OF EXPENSE -->


          <!-- TOTAL EXPENSE -->
          <tr>
            <td></td>
            <td><hr></td>
            <td><hr></td>
          </tr>

            <tr>
              <td  bgcolor="#f9f4f4" class="group2"><b>TOTAL BIAYA (iv)</b></td>
              <td  bgcolor="#f9f4f4" class="number" align="right"><b><?php echo ($sumExpense->sum_expense) ?></b> </td>
              <td  bgcolor="#f9f4f4" class="number" align="right"><b><?php echo ($sumPrevExpense->sum_prev_expense) ?></b> </td>
            </tr>

          <!-- END OF TOTAL EXPENSE -->


          <!-- OTHER INCOME EXPENSE -->
            <tr>
                <td class="group"><b>PENDAPATAN & BIAYA LAINNYA</b></td>
                <td></td>
                <td></td>
            </tr>

            <?php
            $pother_in_ex = 0;
            $other_in_ex = 0;
            foreach ($coaOiOe as $key ) {

                foreach ($otherInEx as $oie) {
                    if($key->coa_id == $oie->coa_id){
                        $other_in_ex = $oie->other_in_ex;
                        break;
                    }else{
                        $other_in_ex = 0;
                    }
                };

                foreach ($prevOtherInEx as $poie) {
                    if($key->coa_id == $poie->coa_id){
                        $pother_in_ex = $poie->prev_other_in_ex;
                        break;
                    }else{
                        $pother_in_ex = 0;
                    }
                }
            ?>
                    <?php if($other_in_ex OR $pother_in_ex != 0){ ?>
                    <tr>
                        <td class="content"><?php echo $key->name_coa ?></td>
                        <td class="number" align="right"><?php echo ($other_in_ex) ?></td>
                        <td class="number" align="right"><?php echo ($pother_in_ex) ?></td>
                    </tr>
                    <?php } ?>
            <?php } ?>
            <!-- END OF  OTHER INCOME EXPENSE -->


          <!-- TOTAL OTHER INCOME & EXPENSE -->
          <tr>
            <td></td>
            <td><hr></td>
            <td><hr></td>
          </tr>
          <?php

           ?>
            <tr>
                <td bgcolor="#f9f4f4" class="group"><b>TOTAL PENDAPATAN & BIAYA LAINNYA</b></td>
                <td bgcolor="#f9f4f4" class="number" align="right">
                    <b><?php echo (($SumOtherInEx->sum_other_in_ex - $rica->ricabum)- $rica->ricabum) ?></b></td>
                <td bgcolor="#f9f4f4" class="number" align="right">
                    <b><?php echo (($SumPrevOtherInEx->sum_prev_other_in_ex - $prevRica->prev_ricabum) - $prevRica->prev_ricabum) ?></b></td>
            </tr>
            <?php  ?>
          <!-- END OF TOTAL OTHER INCOME & EXPENSE-->




          <!-- LABA BERSIH -->
          <tr>
            <td></td>
            <td><hr class="style1"></td>
            <td><hr class="style1"></td>
          </tr>


           <?php
            $laba_bersih = ($laba_kotor - $sumExpense->sum_expense) + $SumOtherInEx->sum_other_in_ex;

            $laba_bersih_prev = $laba_kotor_prev - $sumPrevExpense->sum_prev_expense + $SumPrevOtherInEx->sum_prev_other_in_ex;
          ?>

          <tr>
            <td  bgcolor="#f9f4f4" class="group"><b>LABA / RUGI BERSIH SEBELUM PAJAK (viii=iii-iv+vii)</b></td>
            <td  bgcolor="#f9f4f4" class="number" align="right"><b>
              <?php
                  $bbn=0;
                  if (empty($rica->ricabum)) {
                   $bbn =0;
                  }else{
                    $bbn = $rica->ricabum;
                  }
               echo ($laba_bersih-$bbn-$bbn)
              ?>
            </b></td>
            <td  bgcolor="#f9f4f4" class="number" align="right"><b>
              <?php
                  $pbbn=0;
                  if (empty($prevRica->prev_ricabum)) {
                   $pbbn =0;
                  }else{
                    $pbbn = $prevRica->prev_ricabum;
                  }
               echo ($laba_bersih_prev-$pbbn-$pbbn)
              ?>
            </b></td>
          </tr>
          <tr>
            <td></td>
            <td><hr class="style3"></td>
            <td><hr class="style3"></td>
          </tr>
          <!-- END OF LABA BERSIH -->
        </tbody>
        <footer>
            <th ></th>
            <th ></th>
            <th align="right"></th>
        </footer>
      </table>
      <hr class="style3">
      <?php
              echo '
              <table class="t_user">
                <tr>
                  <td>Printed by:</td>
                  <td>'.$this->session->userdata('username').'</td>
                </tr><br>
                <tr>
                  <td>Date/time: </td>
                  <td>'.date('d-M-Y'). ' / ' . date('H;i;sa').'</td>
                </tr>
              <table>';
            ?>
    </div>
  </div>
</body>