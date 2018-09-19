<html>
<head>
    <title>REPORT | Daily Profit & Loss</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    $sql = "SELECT * FROM system_parameter";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) { ?>
    <b value="<?php echo $row->company_id; ?>">
        <?php }
        } ?>
        </head>
<body>
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-magic"></i>
        Action
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
        <li ><a target="_blank" href="<?php echo site_url('profit_loss/pld/export?id=').$period ?>"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
        </li>
    </ul>
</div>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td>
        <br>
        <td><strong>DAILY PROFT & LOSS</strong></td>
        <br>
        <td class="date"> (Periode <?php
            $per = new DateTime($period);
            echo $per->format('d-M-Y');
            ?>)
        </td>
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
                <td class="group"><b>PENDAPATAN USAHA</b></td>
                <td></td>
            </tr>
            <?php
            foreach ($income as $in) {
                ?>
                <tr>
                    <td  class="content"> <?php echo $in->name_coa ?> </td>
                    <td align="right"  class="content"> <?php echo $in->income ?> </td>
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
                <td bgcolor="#f9f4f4" class="group"><B>TOTAL PENDAPATAN</B></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right"><b><?php echo number_format($sum_income->sum_income) ?></b></td>
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
                <td class="group"><b>BIAYA OPERASIONAL</b></td>
                <td></td>
            </tr>
            <?php foreach($expense as $ex){ ?>
            <tr>
                <td  class="content"><?php echo $ex->name_coa ?></td>
                <td  class="content" align="right"><?php echo number_format($ex->expense) ?></td>
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
                <td bgcolor="#f9f4f4" class="group"><b>TOTAL OPERASIONAL</b></td>
                <td bgcolor="#f9f4f4" class="group" align="right"> <?php echo number_format($sum_expense->sum_expense) ?> </td>
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
                <td class="group"><b>PENDAPATAN & BIAYA LAINNYA</b></td>
                <td class="group" align="right"></td>
            </tr>
            <?php foreach($other as $oth){ ?>
            <tr>
                <td class="content"><?php echo $oth->name_coa ?></td>
                <td class="content" align="right"><?php echo number_format($oth->other_in_ex) ?></td>
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
                <td bgcolor="#f9f4f4" class="group"><b>TOTAL PENDAPATAN & BIAYA LAINNYA</b></td>
                <td bgcolor="#f9f4f4" class="group" align="right"> <?php echo number_format(($sum_other->sum_other - $subtraction->subtraction) - $subtraction->subtraction) ?> </td>
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
                <td bgcolor="#f9f4f4" class="group"><b>LABA/RUGI SEBELUM PAJAK</b></td>
                <td bgcolor="#f9f4f4" class="group" align="right"> <?php echo number_format($result) ?> </td>
            </tr>
<!--        END OF LABA/RUGI-->
        </tbody>
    </table>
    <hr class="style3">
</div>
</body>
</html>


<style type="text/css">
    hr.style2 {
        border-top: 3px double black;
    }

    hr.style1 {
        border-top: 3px double black;
    }

    hr.style3 {
        border-top: 5px double black;
    }

    .t_header {
        font-family: Courier, monospace;
        font-size: 15pt;
        text-align: center;
    }

    .t_user {
        font-family: Courier, monospace;
        font-size: 7pt;
        font-style: italic;
    }

    .head_col {
        width: 20%;
        text-align: right;
    }

    .group {
        padding-left: 1em;
        font-weight: bold;
        font-family: Courier, monospace;
    }

    .group2 {
        padding-left: 4em;
        font-weight: bold;
        font-family: Courier, monospace;
    }

    .subgroup {
        font-family: Courier, monospace;
        padding-left: 3em;
    }

    .content {
        font-size: 10pt;
        padding-left: 6em;
        font-weight: normal
    }

    .dropdown {
        position: fixed;;
    }

    body {
        margin: 10px;
        margin-right: 10%;
        margin-left: 10%;
    }
</style>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
