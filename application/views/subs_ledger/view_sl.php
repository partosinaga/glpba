<!DOCTYPE html>
<html>
<head>
    <title>Subsidiary Ledger</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>resource/bank_book.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>resource/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

</head>
<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

<div class="dropdown" style="position: fixed;">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-magic"></i> Action
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li ><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
        <li ><a target="_blank" href="<?php echo site_url().'/subs_ledger/subs_ledger/export?df='.$date_from.'&dt='.$date_to.'&cf='.$coa_from.'&ct='.$coa_to ?>"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
        <li ><a href="javascript:;" onclick="goTo()"><i class="fa fa-arrow-circle-down"></i> Go to Untransaction Account</a></li>
        <li ><a href="javascript:;" onclick="goTop()"><i class="fa fa-arrow-circle-up"></i> Go to top</a></li>
    </ul>
</div>

<body>
<div class="se-pre-con"></div>
<div id="div1">
    <div id="top">
        <table style="width:100%;">
            <tr>
                <td class="text-center" style="padding-top: 10px;font-size: 14pt;"><strong>PT INTEGRAHA EKAMAKMUR</strong></td>
            </tr>
            <tr>
                <td class="text-center" style="padding-top: 10px;font-size: 14pt;"><strong>SUBSIDIARY LEDGER</strong></td><br>
            </tr>
            <tr>
                <td class="text-center" style="font-size: 10pt;"><b>Date From</b> : <?php echo $date_from ?>  <b>To</b> : <?php echo $date_to ?></td><br>
            </tr>
            <tr>
                <td class="text-center" style="font-size:10pt "><b>COA From</b> : <?php echo $coa_from ?> <b>To</b> : <?php echo $coa_to ?></td>
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
                </tr>
             ';

        ?><hr>



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
                    '<table style="width:100%;margin-bottom: 20px;" class="table_detail table-hover" >

                  <thead class="table_detail">
                    <tr>
                      <th class="coa-name" colspan="3"><b>'. strtoupper($sl->name_coa).'</b></th>
                      <th class="coa-id" colspan="3"><b>'.$sl->coa_id.'</b></th>
                    </tr>
                    <tr>
                      <th class="head" width="100px" >VOUCHER NO.</th>
                      <th class="head" width="80px" >DATE</th>
                      <th>DESCRIPTION</th>
                      <th class="head" width="100px"  >DEBIT</th>
                      <th class="head" width="100px" >CREDIT</th>
                      <th class="head" width="100px" >BALANCE</th>
                    </tr>
                  </thead>

                  <tfoot>
                     <tr>
                     <th class="total" colspan=6><b>'.$sl->coa_id.' - '.strtoupper($sl->name_coa).'</b></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                $result .= '
                      <td align="right"><b>'.number_format($prevBalanceDebit).'</b></td>
                      <td align="right"><b>'.number_format($prevBalanceCredit).'</b></td>
                      <td align="right"><b>'.number_format($balanceTotal).'<b></td >
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
                      <td align="right">'.number_format($sl->debit).'</td>
                      <td align="right">'.number_format($sl->credit).'</td>
                      <td align="right"><b>'.number_format($balanceTotal).'</b></td>
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
                    '<table style="width:100%;margin-bottom: 20px;" class="table_detail table-hover" >

                  <thead class="table_detail">
                    <tr>
                      <th class="coa-name" colspan="3"><b>'. strtoupper($sl->name_coa).'</b></th>
                      <th class="coa-id" colspan="3"><b>'.$sl->coa_id.'</b></th>
                    </tr>
                    <tr>
                      <th class="head" width="100px" >VOUCHER NO.</th>
                      <th class="head" width="80px" >DATE</th>
                      <th>DESCRIPTION</th>
                      <th class="head" width="100px"  >DEBIT</th>
                      <th class="head" width="100px" >CREDIT</th>
                      <th class="head" width="100px" >BALANCE</th>
                    </tr>
                  </thead>

                  <tfoot>
                     <tr>
                     <th class="total" colspan=6><b>'.$sl->coa_id.' - '.strtoupper($sl->name_coa).'</b></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                $result .= '
                      <td align="right"><b>'.number_format($prevBalanceDebit).'</b></td>
                      <td align="right"><b>'.number_format($prevBalanceCredit).'</b></td>
                      <td align="right"><b>'.number_format($balanceTotal).'<b></td >
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
                      <td align="right">'.number_format($sl->debit).'</td>
                      <td align="right">'.number_format($sl->credit).'</td>
                      <td align="right"><b>'.number_format($balanceTotal).'</b></td>
                    </tr>
                  </tbody>';
            echo $result;
            ?>

        <?php } ?>
        </table>
        <!-- END OF PROFIT LOSS ACCOUNT -->


        <div id="untransaction" class="cross">UNTRANSACTION ACCOUNT</div>


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
                        '<table style="width:100%;margin-bottom: 20px;" class="table_detail table-hover" >

                     <thead class="table_detail">
                       <tr>
                         <th class="coa-name" colspan="3"><b>'. strtoupper($bl->name_coa).'</b></th>
                         <th class="coa-id" colspan="3"><b>'.$bl->coa_id.'</b></th>
                       </tr>
                       <tr>
                         <th class="head" width="100px" >VOUCHER NO.</th>
                         <th class="head" width="80px" >DATE</th>
                         <th>DESCRIPTION</th>
                         <th class="head" width="100px"  >DEBIT</th>
                         <th class="head" width="100px" >CREDIT</th>
                         <th class="head" width="100px" >BALANCE</th>
                       </tr>
                     </thead>

                     <tfoot>
                        <tr>
                        <th class="total" colspan=6><b>'.$bl->coa_id.' - '.strtoupper($bl->name_coa).'</b></th>
                       </tr>
                     </tfoot>
                     <tbody>
                       <tr>
                         <td></td>
                         <td></td>
                         <td align="right" colspan=""><b>BEGINING BALANCE</b> </td>';
                    $result .= '
                         <td align="right"><b>'.number_format($bl->balance_debit).'</b></td>
                         <td align="right"><b>'.number_format($bl->balance_credit).'</b></td>
                         <td align="right"><b>'.number_format($balanceTotal).'<b></td >
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






    </div>
</div>
</body>
</html>
<style type="text/css">


    .coa-id{
        text-align: center;
    }
    .coa-name{
        text-align: center;
    }
    .total{
        text-align: center;
    }
    .head{
        text-align: center
    }
    .cross{
        width: 100%;
        height: auto;
        background-color: #4286f4;
        margin-bottom: 20px;
        text-align: center;
        font-size: 15px
    }
</style>
<script type="text/javascript">
    function goTo() {
        var elmnt = document.getElementById("untransaction");
        elmnt.scrollIntoView({behavior: 'smooth' });
    }
    function goTop() {
        var elmnt = document.getElementById("top");
        elmnt.scrollIntoView({behavior: 'smooth' });
    }
    $(document).ready(function(){
        $('#page').fadeIn(2000);
    });
</script>