<!DOCTYPE html>
<html>
<head>
    <title>REPORT | Profit & Loss</title>
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


        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                    class="fa fa-magic"></i> Action
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
                <li><a target="_blank" href="<?php echo site_url('profit_loss/profit_loss/export?id=') . $periode ?>"><i
                            class="fa fa-file-excel-o"></i> Export to Excel</a></li>
            </ul>
        </div>
<body>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td>
        <br>
        <td><strong>PROFT & LOSS</strong></td>
        <br>
        <td class="date">
            (Periode <?php
            $per = new DateTime($periode);

            echo $per->format('M-Y');
            ?>)
        </td>
    </div>
    <hr class="style3">

    <div id="body">

        <table style="width:100%;" class="table_detail">
            <thead>
            <tr>
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
            $a = 0;
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
                    <td class="content"><?php echo $pi->name_coa ?></td>
                    <td class="content"><?php echo number_format($a) ?></td>
                    <td class="content" align="right"><?php echo number_format($pi->prev_income) ?></td>


                    </td>
                </tr>
            <?php } ?>
            <!-- END OF PENDAPATAN -->

            <!-- TOTAL PENDAPATAN -->
            <tr>
                <td></td>
                <td>
                    <hr>
                </td>
                <td>
                    <hr>
                </td>
            </tr>
            <?php
            foreach ($sumIncome as $si) {
                ?>
                <tr>
                    <td bgcolor="#f9f4f4" class="group"><B>TOTAL PENDAPATAN</B></td>
                    <td bgcolor="#f9f4f4" class="subgroup" align="right">
                        <b><?php echo number_format($si->sum_income) ?></b></td>
                    <td bgcolor="#f9f4f4" class="subgroup" align="right"><b> <?php
                            if (!empty($pi->prev_income)) {
                                echo number_format($spi->prev_sum_income);
                            } else {
                                echo number_format(0);
                            }
                            ?> </b>
                    </td>
                </tr>
            <?php } ?>
            <!-- END OF TOTAL PENDAPATAN -->

            <tr>
                <td></td>
                <td>
                    <hr>
                </td>
                <td>
                    <hr>
                </td>
            </tr>


            <!-- LABA KOTOR -->
            <tr>
                <td></td>
                <td>
                    <hr class="style2">
                </td>
                <td>
                    <hr class="style2">
                </td>
            </tr>
            <?php
            $laba_kotor = 0;
            $laba_kotor = $si->sum_income;

            $laba_kotor_prev = 0;
            $laba_kotor_prev = $sumPrevIncome->prev_sum_income;

            ?>
            <tr>
                <td bgcolor="#f9f4f4" class="group"><B>LABA KOTOR)</B></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right"><b><?php echo number_format($laba_kotor) ?></b>
                </td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right">
                    <b><?php echo number_format($laba_kotor_prev) ?></b></td>
            </tr>
            <!-- END OF LABA KOTOR -->

            <tr>
                <td></td>
                <td>
                    <hr class="style2">
                </td>
                <td>
                    <hr class="style2">
                </td>
            </tr>

            <!-- EXPENSE -->
            <tr>
                <td class="group"><b>BIAYA OPERASIONAL</b></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $b = 0;
            foreach ($prevExpense as $pe) {
                foreach ($expense as $ex) {
                    if ($ex->coa_id == $pe->coa_id) {
                        break;
                    }
                }
                ?>
                <tr>
                    <td class="content">
                        <?php
                        if (count($ex->name_coa) > count($pe->name_coa)) {
                            echo $ex->name_coa;
                        } else {
                            echo $pe->name_coa;
                        }
                        ?>
                    </td>
                    <td class="content" align="right">
                        <?php
                        if (($ex->coa_id == $pe->coa_id) == 0) {
                            echo 0;
                        } else {
                            echo number_format($ex->expense);
                        }
                        ?>
                    </td>
                    <td class="content" align="right">
                        <?php echo number_format($pe->prev_expense) ?>
                    </td>
                </tr>
            <?php } ?>
            <!-- END OF EXPENSE -->


            <!-- TOTAL EXPENSE -->
            <tr>
                <td></td>
                <td>
                    <hr>
                </td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td bgcolor="#f9f4f4" class="group"><b>TOTAL BIAYA</b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right">
                    <b><?php echo number_format($sumExpense->sum_expense) ?></b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right">
                    <b><?php echo number_format($sumPrevExpense->sum_prev_expense) ?></b></td>
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
                        <td class="content" align="right"><?php echo number_format($other_in_ex) ?></td>
                        <td class="content" align="right"><?php echo number_format($pother_in_ex) ?></td>
                    </tr>
                    <?php } ?>
            <?php } ?>
            <!-- END OF  OTHER INCOME EXPENSE -->


            <!-- TOTAL OTHER INCOME & EXPENSE -->
            <tr>
                <td></td>
                <td>
                    <hr>
                </td>
                <td>
                    <hr>
                </td>
            </tr>
            <?php

            ?>
            <tr>
                <td bgcolor="#f9f4f4" class="group"><b>TOTAL PENDAPATAN & BIAYA LAINNYA</b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right">
                    <b><?php echo number_format(($SumOtherInEx->sum_other_in_ex - $rica->ricabum)- $rica->ricabum) ?></b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right">
                    <b><?php echo number_format(($SumPrevOtherInEx->sum_prev_other_in_ex - $prevRica->prev_ricabum) - $prevRica->prev_ricabum) ?></b></td>
            </tr>
            <?php ?>
            <!-- END OF TOTAL OTHER INCOME & EXPENSE-->


            <!-- LABA BERSIH -->
            <tr>
                <td></td>
                <td>
                    <hr class="style1">
                </td>
                <td>
                    <hr class="style1">
                </td>
            </tr>


            <?php
            $laba_bersih = ($laba_kotor - $sumExpense->sum_expense) + $SumOtherInEx->sum_other_in_ex;
            $laba_bersih_prev = $laba_kotor_prev - $sumPrevExpense->sum_prev_expense + $SumPrevOtherInEx->sum_prev_other_in_ex;
            ?>

            <tr>
                <td bgcolor="#f9f4f4" class="group"><b>LABA / RUGI BERSIH SEBELUM PAJAK </b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right"><b>
                        <?php
                        $bbn = 0;
                        if (empty($rica->ricabum)) {
                            $bbn = 0;
                        } else {
                            $bbn = $rica->ricabum;
                        }
                        echo number_format($laba_bersih - $bbn - $bbn)
                        ?>
                    </b></td>
                <td bgcolor="#f9f4f4" class="subgroup" align="right"><b>
                        <?php
                        $pbbn = 0;
                        if (empty($prevRica->prev_ricabum)) {
                            $pbbn = 0;
                        } else {
                            $pbbn = $prevRica->prev_ricabum;
                        }
                        echo number_format($laba_bersih_prev - $pbbn - $pbbn)
                        ?>
                    </b></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <hr class="style3">
                </td>
                <td>
                    <hr class="style3">
                </td>
            </tr>
            <!-- END OF LABA BERSIH -->
            </tbody>
            <footer>
                <th></th>
                <th></th>
                <th align="right"></th>
            </footer>
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
        width: 150px;
        text-align: right;
        font-size: 10pt;
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
                   
              