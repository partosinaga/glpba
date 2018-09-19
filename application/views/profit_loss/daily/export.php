<?php
$test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=DPL-".$period.".xls");

header("Pragma: no-cache");

header("Expires: 0");
echo $test;
?>
<body>
<div id="div1">
    <div class="t_header">
        <table>
            <tr>
                <td colspan="3" align="center"><b>PT INTERGRAHA EKAMAKMUR</b></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><b>DAILY PROFIT & LOSS STATEMENT</b></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><b>
                        (Periode: <?php
                        $per = New DateTime($period);
                        echo $per->format('d-M-Y');
                        ?>)</b>
                </td>
            </tr>
        </table>
    </div>
    <hr class="style3">

    <table style="width:100%;" class="table_detail table-hover" >
        <thead>
        <tr>
            <th width=""></th>
            <th class="head_col">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <!--                    INCOME-->
        <tr>
            <th class="group"><b>PENDAPATAN USAHA</b></th>
            <td></td>
        </tr>
        <?php
        foreach ($income as $in) {
            ?>
            <tr>
                <td style="padding-left: 4em" class="content"> <?php echo $in->name_coa ?> </td>
                <td align="right"> <?php echo $in->income ?> </td>
            </tr>
        <?php } ?>
        <!--                ENF OD INCOME-->
        <!--                SUM OF INCOME-->
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <tr>
            <th bgcolor="#f9f4f4" class="group"><B>TOTAL PENDAPATAN</B></th>
            <th bgcolor="#f9f4f4" class="subgroup" align="right"><b><?php echo ($sum_income->sum_income) ?></b></th>
        </tr>
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <!--                END OF SUM INCOME-->
        <!--            BIAYA-->
        <tr>
            <th class="group"><b>BIAYA OPERASIONAL</b></th>
            <td></td>
        </tr>
        <?php foreach($expense as $ex){ ?>
            <tr>
                <td style="padding-left: 4em" class="content"><?php echo $ex->name_coa ?></td>
                <td class="content" align="right"><?php echo ($ex->expense) ?></td>
            </tr>
        <?php } ?>
        <!--        END OF BIAYA-->
        <!--        SUM OF BIAYA-->
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <tr>
            <th bgcolor="#f9f4f4" class="group"><b>TOTAL OPERASIONAL</b></th>
            <th bgcolor="#f9f4f4" class="group" align="right"> <?php echo ($sum_expense->sum_expense) ?> </th>
        </tr>
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <!--        END OF SUM BIAYA-->
        <!--        OTHER INCOME & EXPENSE-->
        <tr>
            <th class="group"><b>PENDAPATAN & BIAYA LAINNYA</b></th>
            <td class="group" align="right"></td>
        </tr>
        <?php foreach($other as $oth){ ?>
            <tr>
                <td style="padding-left: 4em" class="content"><?php echo $oth->name_coa ?></td>
                <td class="content" align="right"><?php echo ($oth->other_in_ex) ?></td>
            </tr>
        <?php } ?>
        <!--        END OF OTHER INCONE & EXPENSE\-->
        <!--        TOTAL OTHER-->
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <tr>
            <th bgcolor="#f9f4f4" class="group"><b>TOTAL PENDAPATAN & BIAYA LAINNYA</b></th>
            <th bgcolor="#f9f4f4" class="group" align="right"> <?php echo (($sum_other->sum_other - $subtraction->subtraction) - $subtraction->subtraction) ?> </th>
        </tr>
        <tr>
            <td></td>
            <td>
                <hr class="style2">
            </td>
        </tr>
        <!--        END OF OTHER-->
        <!--        LABA/RUGI-->
        <?php
        $otherinex = ($sum_other->sum_other - $subtraction->subtraction) - $subtraction->subtraction;
        $result = $otherinex + ($sum_income->sum_income - $sum_expense->sum_expense);
        ?>
        <tr>
            <th bgcolor="#f9f4f4" class="group"><b>LABA/RUGI SEBELUM PAJAK</b></th>
            <th bgcolor="#f9f4f4" class="group" align="right"> <?php echo ($result) ?> </th>
        </tr>
        <!--        END OF LABA/RUGI-->
        </tbody>
    </table>
    <hr class="style3">
</div>
</body>

