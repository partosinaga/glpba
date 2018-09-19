<?php
 $test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=Subsidiary Ledger.xls");

header("Pragma: no-cache");

header("Expires: 0");
 echo $test;
?>



<body>
<div id="div1">
    <div>
        <table style="width:100%;">
            <tr>
                <th colspan="6"><b>SUBSIDIARY LEDGER</b></th>
            </tr>
            <tr>
                <th colspan="6"><b>Date From</b> : <?php echo $date_from ?>  <b>To</b> : <?php echo $date_to ?></th>
            </tr>
            <tr>
                <th colspan="6"><b>COA From</b> : <?php echo $coa_from ?> <b>To</b> : <?php echo $coa_to ?></th>
            </tr>
        </table>
    </div>

    <div id="body">
        <!-- BALANCE SHEET ACCOUNT -->
        <?php
        $group='';
        $i=1;
        $balanceTotal = 0;
        foreach ($subsled as $sl) {
            ?>
            <?php
            $result = '';
            if ($group != $sl->coa_id ) {
                $balanceTotal = 0;
                $prevBalanceDebit = 0;
                $prevBalanceCredit = 0;
                $result.='
                        <tfoot>
                          <tr>
                            <td colspan="6" style="border-bottom: 1px solid black;border-top: 1px solid black;    border-collapse: collapse;"></td>
                          </tr>
                        <tfoot>';
                foreach ($balance as $bl) {
                    if($sl->coa_id == $bl->coa_id){
                        $prevBalanceDebit = $bl->balance_debit;
                        $prevBalanceCredit = $bl->balance_credit;
                        $balanceTotal = 0 ;
                        if($sl->kelompok == 1 OR $sl->kelompok == 6 OR $sl->kelompok == 7 OR $sl->kelompok == 8) { //SALDO DEBIT
                            $balanceTotal += ($prevBalanceDebit - $prevBalanceCredit);
                        } else{
                            $balanceTotal += ($prevBalanceCredit - $prevBalanceDebit);
                        };
                        break;
                    }



                }

                $result .=
                    '<table border="1" margin="10px" style="width:100%;margin-bottom: 20px;">

                  <thead class="table_detail">
                    <tr bgcolor="#94A0b2">
                      <th class="coa-name" colspan="3"><b>'. strtoupper($sl->name_coa).'</b></th>
                      <th class="coa-id" colspan="3"><b>'.$sl->coa_id.'</b></th>
                    </tr>
                    <tr bgcolor="#94A0b2">
                      <th class="head" width="100px" >VOUCHER NO.</th>
                      <th class="head" width="80px" >DATE</th>
                      <th>DESCRIPTION</th>
                      <th class="head" width="100px"  >DEBIT</th>
                      <th class="head" width="100px" >CREDIT</th>
                      <th class="head" width="100px" >BALANCE</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                $result .= '
                      <td align="right" class="number" ><b>'.($prevBalanceDebit).'</b></td>
                      <td align="right" class="number" ><b>'.($prevBalanceCredit).'</b></td>
                      <td align="right" class="number" ><b>'.($balanceTotal).'<b></td >
                      </td>
                    </tr>';
                $group=$sl->coa_id;


            } else {
                $result .= '';
            };


            if($sl->kelompok == 1 OR $sl->kelompok == 6 OR $sl->kelompok == 7 OR $sl->kelompok == 8  ) { //SALDO DEBIT
                $balanceTotal += ($sl->debit - $sl->credit);
            } else{
                $balanceTotal += ($sl->credit - $sl->debit);
            };
            $result .=
                '<tr>
                      <td align="center">'.$sl->gl_no.'</td>
                      <td align="center">'.$sl->gl_date.'</td>
                      <td>'.$sl->description.'</td>
                      <td align="right"  class="number" >'.($sl->debit).'</td>
                      <td align="right" class="number" >'.($sl->credit).'</td>
                      <td align="right" class="number" ><b>'.($balanceTotal).'</b></td>
                    </tr>
                  </tbody>';
            echo $result;
            ?>
        <?php } ?>
        </table>
        <!-- END OF BALANCE SHEET ACCOUNT -->


        <!-- PROFIT LOSS ACCOUNT -->
        <?php
        $group='';
        $balanceTotal = 0;
        foreach ($subsled2 as $sl) {
            ?>
            <?php
            $result = '';
            if ($group != $sl->coa_id ) {
                $balanceTotal = 0;
                $prevBalanceDebit =0;
                $prevBalanceCredit =0;
                $result.='
                  <tfoot>
                    <tr>
                      <td colspan="6" style="border-bottom: 1px solid black;border-top: 1px solid black;    border-collapse: collapse;">&nbsp</td>
                    </tr>
                  <tfoot>';
                foreach ($balance2 as $bl) {
                    if($sl->coa_id == $bl->coa_id){
                        $prevBalanceDebit = $bl->balance_debit;
                        $prevBalanceCredit = $bl->balance_credit;
                        if($sl->kelompok == 1 OR $sl->kelompok == 6 OR $sl->kelompok == 7 OR $sl->kelompok == 8 OR $sl->kelompok == 9)
                        {
                            $balanceTotal += ($prevBalanceDebit - $prevBalanceCredit);
                        } else{
                            $balanceTotal += ($prevBalanceCredit - $prevBalanceDebit);
                        };

                        break;

                    }
                }
                $result .=
                    '<table border="1" margin="10px" style="width:100%;margin-bottom: 20px;" >

                  <thead class="table_detail">
                    <tr bgcolor="#94A0b2">
                      <th class="coa-name" colspan="3"><b>'. strtoupper($sl->name_coa).'</b></th>
                      <th class="coa-id" colspan="3"><b>'.$sl->coa_id.'</b></th>
                    </tr>
                    <tr bgcolor="#94A0b2">
                      <th class="head" width="100px" >VOUCHER NO.</th>
                      <th class="head" width="80px" >DATE</th>
                      <th>DESCRIPTION</th>
                      <th class="head" width="100px"  >DEBIT</th>
                      <th class="head" width="100px" >CREDIT</th>
                      <th class="head" width="100px" >BALANCE</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                $result .= '
                      <td align="right" class="number" ><b>'.($prevBalanceDebit).'</b></td>
                      <td align="right" class="number" ><b>'.($prevBalanceCredit).'</b></td>
                      <td align="right" class="number" ><b>'.($balanceTotal).'<b></td >
                      </td>
                    </tr>';
                $group=$sl->coa_id;


            } else {
                $result .= '';
            };


            if($sl->kelompok == 1 OR $sl->kelompok == 6 OR $sl->kelompok == 7 OR $sl->kelompok == 8 OR $sl->kelompok == 9) { //SALDO DEBIT
                $balanceTotal += ($sl->debit - $sl->credit);
            } else{
                $balanceTotal += ($sl->credit - $sl->debit);
            };


            $result .=
                '<tr>
                      <td align="center">'.$sl->gl_no.'</td>
                      <td align="center">'.$sl->gl_date.'</td>
                      <td>'.$sl->description.'</td>
                      <td align="right" class="number" >'.($sl->debit).'</td>
                      <td align="right" class="number" >'.($sl->credit).'</td>
                      <td align="right" class="number" ><b>'.($balanceTotal).'</b></td>
                    </tr>
                  </tbody>';
            echo $result;
            ?>

        <?php } ?>
        </table>
        <!-- END OF PROFIT LOSS ACCOUNT -->

        <div style=" width: 100%;text-align: center; font-size: 15px; font-weight: bold;color: red" >UNTRANSACTION ACCOUNT</div>



        <!-- UNTRANSACTION ACCOUNT BALANCESHEET -->
        <?php
        $group='';
        $i=1;
        $balanceTotal = 0;
        foreach ($balance as $bl) {
            $result = '';
            if ($group != $bl->coa_id ) {
                $balanceTotal = 0;
                $prevBalanceDebit = 0;
                $prevBalanceCredit = 0;
                $result.='
                  <tfoot>
                    <tr>
                      <td colspan="6" style="border-bottom: 1px solid black;border-top: 1px solid black;    border-collapse: collapse;">&nbsp</td>
                    </tr>
                  <tfoot>';
                foreach ($subsled as $sl) {
                    if($sl->coa_id == $bl->coa_id){
                        $prevBalanceDebit = $bl->balance_debit;
                        $prevBalanceCredit = $bl->balance_credit;
                        $balanceTotal = 0 ;
                        if($bl->kelompok == 1 OR $bl->kelompok == 6 OR $bl->kelompok == 7 OR $bl->kelompok == 8) { //SALDO DEBIT
                            $balanceTotal += ($bl->balance_debit - $bl->balance_credit);
                        } else{
                            $balanceTotal += ($bl->balance_credit - $bl->balance_debit);
                        };
                        break;
                    }else{
                        $prevBalanceDebit = $bl->balance_debit;
                        $prevBalanceCredit = $bl->balance_credit;
                        $balanceTotal = 0 ;
                        if($bl->kelompok == 1 OR $bl->kelompok == 6 OR $bl->kelompok == 7 OR $bl->kelompok == 8) { //SALDO DEBIT
                            $balanceTotal += ($bl->balance_debit - $bl->balance_credit);
                        } else{
                            $balanceTotal += ($bl->balance_credit - $bl->balance_debit);
                        };
                    }
                }
                if ($bl->coa_id != $sl->coa_id) {
                    $result .=
                        '<table border="1" margin="10px" style="width:100%;margin-bottom: 20px;" >

                     <thead class="table_detail">
                       <tr bgcolor="#94A0b2">
                         <th class="coa-name" colspan="3"><b>'. strtoupper($bl->name_coa).'</b></th>
                         <th class="coa-id" colspan="3"><b>'.$bl->coa_id.'</b></th>
                       </tr>
                       <tr bgcolor="#94A0b2">
                         <th class="head" width="100px" >VOUCHER NO.</th>
                         <th class="head" width="80px" >DATE</th>
                         <th>DESCRIPTION</th>
                         <th class="head" width="100px"  >DEBIT</th>
                         <th class="head" width="100px" >CREDIT</th>
                         <th class="head" width="100px" >BALANCE</th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <td></td>
                         <td></td>
                         <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                    $result .= '
                         <td align="right"  class="number" ><b>'.($bl->balance_debit).'</b></td>
                         <td align="right"  class="number" ><b>'.($bl->balance_credit).'</b></td>
                         <td align="right"  class="number" ><b>'.($balanceTotal).'<b></td >
                         </td>
                       </tr>
                  </table>';
                    $group=$bl->coa_id;

                };
            } else {
                $result .= '';
            };
            echo $result;
            ?>
        <?php } ?>
        <!-- END OF UNSTRANSACTION ACCOUNT BALANCESHEET -->





        <?php
        echo  '
                <tr align="right">
                  <td>Exported by:</td>
                  <td><i>'.$this->session->userdata('username').'</i></td>
                </tr><br>
                <tr>
                  <td>Date/time: </td>
                  <td><i>'.date('d-M-Y'). ' / ' . date('H;i;sa').'</i></td>
                </tr>
             ';;
        ?>
    </div>
</div>
</body>