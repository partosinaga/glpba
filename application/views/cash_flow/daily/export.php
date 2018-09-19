<?php
$test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=CF-".$periode.".xls");

header("Pragma: no-cache");

header("Expires: 0");
echo $test;
?>
<table>
    <tr>
        <td colspan="3" align="center"><b>IEM</b></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><b>CASH FLOW</b></td>
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
    <table class="table_detail table-hover" width="100%" id="cashflow">
        <thead>
        <tr style="border-bottom: 2px solid black">
            <th width=""></th>
            <th class="head_col">MONTHLY</th>
            <th class="head_col">YEAR TO DATE</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ctg_caption = '';
        $sub_ctg_caption = '';
        $i = 0;
        $month = 0;
        $month_prev = 0;
        $sum_monthly = 0;
        $tot_sum_montlhy = 0;
        $total = 0;
        $total_prev = 0;
        $tot_sum_total = 0;
        $mutation = 0;
        $mutation_ytd = 0;
        foreach ($coa as $acc) {
//                    FOR MONTHLY
            foreach ($monthly as $m) {
                if ($m->coa_id == $acc->coa_id) {
                    $month = $m->monthly;
                    break;
                } else {
                    $month = 0;
                }
            }
            foreach ($monthlyPrev as $mp) {
                if ($mp->coa_id == $acc->coa_id) {
                    $month_prev = $mp->prev_monthly;
                    break;
                } else {
                    $month_prev = 0;
                }
            }
            if (($acc->subgroup >= 100 AND $acc->subgroup <= 199) OR
                ($acc->subgroup >= 600 AND $acc->subgroup <= 799) OR
                ($acc->subgroup >= 802 AND $acc->subgroup <= 999)
            ) { //check group debit or credit
                $sum_monthly = $month_prev - $month;
            } else {
                $sum_monthly = $month - $month_prev;
            }
//            END OF MONTHLY
//                    YEAR TO DATE
            foreach ($ytd as $y) {
                if ($y->coa_id == $acc->coa_id) {
                    $total = $y->total;
                    break;
                } else {
                    $total = 0;
                }
            }
            foreach ($ytdPrev as $yp) {
                if ($yp->coa_id == $acc->coa_id) {
                    $total_prev = $yp->total_prev;
                    break;
                } else {
                    $total_prev = 0;
                }
            }
            if (($acc->subgroup >= 100 AND $acc->subgroup <= 199) OR
                ($acc->subgroup >= 600 AND $acc->subgroup <= 799) OR
                ($acc->subgroup >= 802 AND $acc->subgroup <= 999)
            ) { //check group debit or credit
                $sum_total = $total_prev - $total;
            } else {
                $sum_total = $total - $total_prev;
            }
//                    END OF YEAR TO DATE

            if ($ctg_caption != $acc->name) {
                if ($ctg_caption != '') {
                    echo '<tr class="conclusion">
                                <th style="color:#4298d6; text-align: left"> TOTAL ' . strtoupper($ctg_caption) . '</th>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">' . ($tot_sum_montlhy) . '</td>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">' . ($tot_sum_total) . '</td>
                           </tr>';
                    $tot_sum_montlhy = 0;
                    $tot_sum_total = 0;
                }
            }

            if ($ctg_caption != $acc->name) {
                echo '<tr>
                      <th style="color:#4298d6; text-align: left" class="conclusion"> ' . strtoupper($acc->name) . '</th>
                    </tr>';

                $ctg_caption = $acc->name;
            }

            if ($sub_ctg_caption != $acc->account) {
                echo '<tr>
                      <th class="subgroup" style="text-align: left"> ' . strtoupper($acc->account) . '</th>
                    </tr>';

                $sub_ctg_caption = $acc->account;
            }

            echo '
                    <tr>
                      <td class="content">' . $acc->name_coa . '</td>
                      <td class="number" align="right">' . ($sum_monthly) . '</td>
                      <td class="number" align="right">' . ($sum_total) . '</td>
                    </tr>';
            $tot_sum_montlhy = $tot_sum_montlhy + $sum_monthly;
            $tot_sum_total = $tot_sum_total + $sum_total;
            $mutation = $mutation + $sum_monthly;
            $mutation_ytd = $mutation_ytd + $sum_total;
            $i++;


            if ($i == count($coa)) {//TO GET TOTAL IN LAST CATEGORY
                if ($ctg_caption != '') {
                    echo '<tr class="conclusion">
                                <th style="color:#4298d6;;text-align: left">TOTAL ' . strtoupper($acc->name) . '</th>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">' . ($tot_sum_montlhy) . '</td>
                                <th class="number" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">' . ($tot_sum_total) . '</td>
                            </tr>';
                    $tot_sum_montlhy = 0;
                    $tot_sum_total = 0;
                }
            }

        }
        ?>
        </tbody>
        <tfoot>
        <tr class="conclusion">
            <th class="text-right" style="color:#4298d6;text-align: right">Begining Cash & bank balance</th>
            <th class="number" style="border-top: 2px solid;"><?php echo ($bgn->begining) ?></th>
            <th class="number" style="border-top: 2px solid;"><?php echo ($bgn_prev->begining_ytd + $mutation_ytd) ?></th>
        </tr>
        <tr class="conclusion">
            <th class="text-right" style="color:#4298d6;text-align: right">Mutation</th>
            <th class="number"><?php echo ($mutation) ?></th>
            <th class="number"><?php echo ($mutation_ytd) ?></th>
        </tr>
        <tr class="conclusion">
            <th class="text-right" style="color:#4298d6;text-align: right">Ending Cash & bank balance</th>
            <th class="number" style="border-bottom: 2px solid;"><?php echo ($bgn->begining + $mutation) ?></th>
            <th class="number" style="border-bottom: 2px solid;"><?php echo ($bgn_prev->begining_ytd) ?></th>
        </tr>
        </tfoot>
    </table>
</div>