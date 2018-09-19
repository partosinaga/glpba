<?php
$test = "<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=PL-" . $periode . ".xls");

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

        <table class="t_content">
            <thead>
            <tr>
                <th width=""></th>
                <th class="head_col">CURRENT MONTH</th>
                <th class="head_col">YEAR TO DATE</th>
            </tr>
            </thead>

            <tbody>
            <?php

            $ctg_caption = '';
            $sub_ctg_caption = '';
            $current_month = 0;
            $previous = 0;
            $tot_ctg_ytm = 0;
            $tot_ctg_ytd = 0;
            $i = 0;

            foreach ($account as $row):
                foreach($yearToMonth as $ytm){
                    if($row->id_detail == $ytm->id_detail){
                        $current_month = $ytm->balance_ytm;
                        break;
                    }else{
                        $current_month = 0;
                    }
                }

                foreach($yearToDate as $ytd){
                    if($row->id_detail == $ytd->id_detail){
                        $previous = $ytd->balance_ytd;
                        break;
                    }else{
                        $previous = 0;
                    }
                }


                if($ctg_caption != $row->category){//TO GET TOTAL EACH CATEGORY EXCEPT THE LAST CATEGORY
                    if($ctg_caption != ''){
                        echo '<tr id="total">
                                <th style="text-align: left" > TOTAL ' . strtoupper($ctg_caption) .'</th>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.($income_ytm = $tot_ctg_ytm).'</td>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.($income_ytd = $tot_ctg_ytd).'</td>
                           </tr>';

                        $tot_ctg_ytm = 0;
                        $tot_ctg_ytd = 0;

                    }
                }

                if($ctg_caption != $row->category){//TO GET CATEGORY
                    echo '<tr>
                              <th colspan="3" style="text-align: left"> ' . strtoupper($row->category) . '</th>
                            </tr>';

                    $ctg_caption = $row->category;
                }

                if($sub_ctg_caption != $row->name){//TO GET SUBCATEGORY

                    echo '<tr>
                              <th colspan="3" style="text-align: left">' . strtoupper($row->name) . '</th>
                            </tr>';

                    $sub_ctg_caption = $row->name;
                }
                //GET ROW DETAIL ACCOUNT
                echo '
                    <tr style="cursor: pointer">
                        <td class="content" onclick="breakdown(\''.$row->id_detail.'\',\''.$dateFrom.'\',\''.$dateTo.'\',\''.$row->account.'\')">' .$row->account . '</td>
                        <td class="number" onclick="breakdown(\''.$row->id_detail.'\',\''.$dateFrom.'\',\''.$dateTo.'\',\''.$row->account.'\')" align="right">'.($current_month).'</td>
                        <td class="number" onclick="breakdownYtd(\''.$row->id_detail.'\',\''.$dateTo.'\',\''.$row->account.'\')" align="right">'.($previous).'</td>
                    </tr>';
                $tot_ctg_ytm = $tot_ctg_ytm + $current_month;
                $tot_ctg_ytd = $tot_ctg_ytd + $previous;
                $i++;


                if($i == count($account)){//TO GET TOTAL IN LAST CATEGORY,in this case TOTAL EXPENSE
                    if($ctg_caption != ''){
                        echo '<tr>
                                <th style="text-align: left">TOTAL ' . strtoupper($row->category) . '</th>
                                <th class="number" id = "ytm-exp" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.($expense_ytm = $tot_ctg_ytm).'</td>
                                <th class="number" id="ytd-exp" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.($expense_ytd = $tot_ctg_ytd).'</td>
                            </tr>';
                        $tot_ctg_ytm = 0;
                        $tot_ctg_ytd = 0;
                    }

                }


                ?>

            <?php endforeach ?>
            <tr>
                <th class="group" style="height: 30px; text-align: left">NET PROFIT </th>
                <th class="number"  style="text-align:right; border-top: 3px double black;border-bottom: 3px double black; background-color: #e4e4e4; font-weight:bold"><?php echo ($income_ytm - $expense_ytm) ?></td>
                <th class="number"  style="text-align:right; border-top: 3px double black;border-bottom: 3px double black; background-color: #e4e4e4; font-weight:bold"><?php echo ($income_ytd - $expense_ytd) ?></td>
            </tr>
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
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>