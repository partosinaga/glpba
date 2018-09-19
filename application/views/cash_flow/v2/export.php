<?php
$test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=CF-".$date_to.".xls");

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
                $per = New DateTime($date_to);
                echo $per->format('M-Y');
                ?>)</b>
        </td>
    </tr>
</table>

<table class="table_detail " width="100%" id="cashflow">
    <thead>
    <tr>
        <th width=""></th>
        <th class="head_col">MONTHLY</th>

        <th class="head_col">YEAR TO DATE</th>
    </tr>
    <tr>
        <th colspan="4">
            <hr class="style2">
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $group = '';
    $month = 0;
    $month_prev = 0;
    $anl = 0;
    $anl_prev = 0;
    $tot = 0;
    $tot_prev = 0;
    $sum_monthly = 0;
    $mutation = 0;
    $mutation_ytd = 0;
    $report_type_monthly = '';
    $report_type_monthly_prev = '';

    foreach ($account as $ac) {
        foreach ($monthly as $my) {
            if ($my->id_detail == $ac->id_detail) {
                $month = $my->monthly;
                $report_type_monthly = $my->report_type;
                break;
            } else {
                $month = 0;
                $report_type_monthly = '';
            }
        };
        foreach ($monthly_prev as $myp) {
            if ($myp->id_detail == $ac->id_detail) {
                $month_prev = $myp->prev_monthly;
                $report_type_monthly_prev = $myp->report_type;
                break;
            } else {
                $month_prev = 0;
                $report_type_monthly_prev = '';
            }
        }
        foreach ($total as $tl) {
            if ($tl->id_detail == $ac->id_detail) {
                $tot = $tl->total;
                break;
            } else {
                $tot = 0;
            }
        }
        foreach ($total_prev as $tlp) {
            if ($tlp->id_detail == $ac->id_detail) {
                $tot_prev = $tlp->total_prev;
                break;
            } else {
                $tot_prev = 0;
            }
        }

        if ($group != $ac->id_subcategory) {
            echo '<tr>
                    <th class="group" style="color:#4298d6; text-align: left">' . strtoupper($ac->name) . '</th>
                    <th align="right"></td>
                </tr>';
            $group = $ac->id_subcategory;
        } else {
            echo '';
        }


        ?>
        <tr style="cursor: pointer">
            <td class="content" onclick="breakdownMonthly('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $date_from ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )"><?php echo $ac->account ?></td>
            <td style="cursor: pointer" align="right" class="number " onclick="breakdownMonthly('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $date_from ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )">
                <?php
                if (($ac->subgroup >= 100 AND $ac->subgroup <= 199) OR
                    ($ac->subgroup >= 600 AND $ac->subgroup <= 799) OR
                    ($ac->subgroup >= 802 AND $ac->subgroup <= 999)
                ) { //check group debit or credit
                    echo ($sum_monthly = $month_prev - $month);
                } else {
                    echo ($sum_monthly = $month - $month_prev);
                }
                ?>
            </td>
            <td style="cursor: pointer" align="right" class="number" onclick="breakdownTotal('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $yearStart ?>','<?php echo $PrevYearStart ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )">
                <?php
                if (($ac->subgroup >= 100 AND $ac->subgroup <= 199) OR
                    ($ac->subgroup >= 600 AND $ac->subgroup <= 799) OR
                    ($ac->subgroup >= 802 AND $ac->subgroup <= 999)
                ) { //check group debit or credit
                    echo ($sum_total = $tot_prev - $tot);
                } else {
                    echo ($sum_total = $tot - $tot_prev);
                }

                ?>
            </td>
        </tr>

        <?php
        $mutation = $mutation + $sum_monthly;
        $mutation_ytd = $mutation_ytd + $sum_total;
    }
    ?>
    </tbody>
    <tfoot>
    <tr class="conclusion">
        <th class="text-right" style="color:#4298d6; text-align: right">Begining Cash & bank balance</th>
        <th class="number" style="border-top: 2px solid; text-align: right"><?php echo ($bgn->begining) ?></th>
        <th class="number" style="border-top: 2px solid; text-align: right"><?php echo ($bgn_prev->begining_ytd + $mutation_ytd) ?></th>
    </tr>
    <tr class="conclusion">
        <th class="text-right" style="color:#4298d6; text-align: right">Mutation</th>
        <th class="number"><?php echo ($mutation) ?></th>
        <th class="number"><?php echo ($mutation_ytd) ?></th>
    </tr>
    <tr class="conclusion">
        <th class="text-right" style="color:#4298d6; text-align: right">Ending Cash & bank balance</th>
        <th class="number" style="border-bottom: 2px solid;text-align: right"><?php echo ($bgn->begining + $mutation) ?></th>
        <th class="number" style="border-bottom: 2px solid;text-align: right"><?php echo ($bgn_prev->begining_ytd) ?></th>
    </tr>
    </tfoot>
</table>
