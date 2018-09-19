<?php
$test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
 header("Content-type: application/vnd-ms-excel");

 header("Content-Disposition: attachment; filename=BS-".$periode.".xls");

 header("Pragma: no-cache");

 header("Expires: 0");
echo $test;
 ?>
<body>
  <div id="div1">
     <table>
        <tr>
          <td colspan="3" align="center"><b>Halo Kang Indonesia</b></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b>BALANCE SHEET</b></td>
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

          <table class="t_content">
              <thead>
              <tr>
                  <th></th>
                  <th class="head_col">CURRENT MONTH
                      <hr>
                  </th>
                  <th class="head_col">PREVIOUS MONTH
                      <hr>
                  </th>
              </tr>
              </thead>

              <tbody>
              <!--ASSETS-->
              <?php
              $group = '';
              $group2 = '';
              $ctg_caption = '';
              $tot_current = 0;
              $tot_previous = 0;
              $i=0;
              $current_balance=0; //UNTUK MENAMPUNG HASIL PENJUMLAHAN $RowCurrent + $LabaDitahan / $RowCurrent + $labaRugiTahunBerjalan
              $previous_balance = 0;
              $labaDitahan=0;
              $labaRugiTahunBerjalan = 0;
              $income = 0;
              $expense = 0;
              $rowCurrent = 0; //UNTUK MENAMPUNG JUMLAH BALANCE_CURRENT SETIAP ACCOUNT
              $rowPrevious = 0;
              foreach ($account as $a) { //GET ALL ROW DETAIL CATEGORY ACCOUNT
                  foreach($current as $crt){ //GET BALANCE FOR CURRENT MONTH
                      if($a->id_detail == $crt->id_detail){
                          $rowCurrent = $crt->balance_current;
                          break;
                      }else{
                          $rowCurrent = 0;
                      }
                  }
                  foreach($previous as $prv){
                      if($a->id_detail == $prv->id_detail){
                          $rowPrevious = $prv->balance_previous;
                          break;
                      }else{
                          $rowPrevious = 0;
                      }
                  }
                  ?>
                  <?php
                  if($ctg_caption != $a->ctg_caption){//TO GET TOTAL EACH CATEGORY EXCEPT THE LAST CATEGORY
                      if($ctg_caption != ''){
                          echo '<tr id="total">
                                <th style="text-align: left" > TOTAL ' . strtoupper($ctg_caption) .'</th>
                                <th class="number" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.($tot_current).'</th>
                                <th class="number" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.($tot_previous).'</th>
                            </tr>';
                          $tot_current = 0;
                          $tot_previous = 0;
                      }
                  }



                  if ($ctg_caption != $a->ctg_caption) {
                      echo '
                    <tr>
                      <th style="text-align: left"> ' . strtoupper($a->ctg_caption) . ' </th>
                      <th></th>
                      <th></th>
                    </tr>';
                      $ctg_caption = $a->ctg_caption;
                  }

                  if($group2 != $a->id_subcategory){
                      echo '
                    <tr>
                      <th style="text-align: left"> ' . strtoupper($a->subcategory) . ' </th>
                      <th></th>
                      <th></th>
                    </tr>';
                      $group2 = $a->id_subcategory;
                  }

                  //GET LABA DITAHAN
                  $income = $LDI5->ldi5 + $LDI8->ldi8;
                  $expense = $LDE7->lde7 + $LDE802->lde802;
                  $labaDitahan = $income - $expense;
                  if(strpos($a->account, 'tahan')){ //FOR CHECK LABA DITAHAN ACCOUNTS
                      $current_balance = $rowCurrent +  $labaDitahan;
                      $previous_balance = $rowPrevious + $labaDitahan;
                  } else {
                      $current_balance = $rowCurrent;
                      $previous_balance = $rowPrevious;
                  }
                  //END OF GET LABA DITAHAN

                  //GET CURRENT LABARUGI BERJALAN
                  $inc = $LRI5->lri5 + $LRI8->lri8;
                  $exp = $LRE7->lre7 + $LRE802->lre802;
                  $labaRugiTahunBerjalan = $inc - $exp;

                  //GET PREVIOUS LABARUGI BERJALAN
                  $pinc = $PLRI5->plri5 + $PLRI8->plri8;
                  $pexp = $PLRE7->plre7 + $PLRE802->plre802;
                  $PreviousLabaRugiTahunBerjalan = $pinc - $pexp;

                  if(strpos($a->account, 'berjalan')){ //FOR CHECK LABA BERJALAN ACCOUNT
                      $current_balance = $current_balance +  $labaRugiTahunBerjalan;
                      $previous_balance = $previous_balance + $PreviousLabaRugiTahunBerjalan;
                  } else {
                      $current_balance = $current_balance;
                      $previous_balance = $previous_balance;
                  }
                  //END OF LABARUGI BERJALAN
                  echo '
                        <tr style="cursor: pointer" >
                          <td class="content" >' . $a->account . '</td>
                          <td class="number" align="right" >' . ($current_balance) . '</td>
                          <td class="number" align="right" >' . ($previous_balance) . '</td>
                        </tr>';
                  $tot_current = $tot_current + $rowCurrent;
                  $tot_previous = $tot_previous + $rowPrevious;

                  $i++;

                  if($i == count($account)){//TO GET TOTAL IN LAST CATEGORY,in this case TOTAL EXPENSE
                      if($ctg_caption != ''){
                          echo '<tr>
                                <th style="text-align: left">TOTAL ' . strtoupper($a->ctg_caption) . '</th>
                                <th class="number" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.($tot_current + $labaRugiTahunBerjalan + $labaDitahan).'</th>
                                <th class="number" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.($tot_previous + $PreviousLabaRugiTahunBerjalan + $labaDitahan).'</th>
                              </tr>';
                          $tot_current = 0;
                          $tot_previous = 0;
                      }

                  }

                  ?>

              <?php } ?>


              </tbody>
          </table>
          <hr class="style3">
          <?php
          echo '
              <table class="t_user">
                <tr>
                  <td>Printed by:</td>
                  <td>' . $this->session->userdata('username') . '</td>
                </tr><br>
                <tr>
                  <td>Date/time: </td>
                  <td>' . date('d-M-Y') . ' / ' . date('H;i;sa') . '</td>
                </tr>
              <table>';
          ?>


      </div>
  </div>
</body>