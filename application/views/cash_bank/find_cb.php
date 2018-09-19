<html>
<head>
    <title>REPORT | Cash & Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php
$sql = "SELECT * FROM system_parameter";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
        ?>
    <?php }
} ?>
<body>
<!--ACTION-->
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo"><i class="fa fa-magic"></i>
    Action
</button>
<div id="demo" class="collapse well" style="width: 15%">
    <form method="post" action="<?php echo site_url('cash_bank/cash_bank/find') ?>">
        <label for="email">Period:</label>

        <div class="input-group">
            <input type="date" class="form-control input-sm" name="period">
              <span class="input-group-btn">
                <button class="btn btn-secondary btn-sm" type="button "><i class="fa fa-search"></i>&nbsp</button>
              </span>
        </div>
    </form>
    <hr>
    <a href="print" style="color: black"><i class="fa fa-print"></i> Print</a>
    <a href="export" style="color: black" class="pull-right"><i class="fa fa-book"></i> Export</a>
</div>
<!--END OF ACTION-->
<!--COMPANY IDENTITY-->
<table>
    <tr>
        <p align="center" style="font-size:14pt;"><?php echo strtoupper($row->name); ?></p>

        <p align="center" style="font-size:14pt ">Cash & Bank</p>

    </tr>
</table>
<hr class="style3">
<!--END OF COMPANY IDENTITY-->
<!--BODY CONTENT-->
<table width="100%" class="table-hover">
    <thead>
        <tr>
            <th width="25%"></th>
            <th style="text-align: center; font-size: 12pt; width: 50%">KETERANGAN</th>
            <?php
            $a = 4;
            for ($i = 0; $i <= $a; $i++) {
                $date = date('d-M-Y', strtotime('-'.$i.'day', strtotime($period)));
                ?>
                <th style="text-align: right; font-size: 12pt"><?php echo strtoupper($date) ?></th>
            <?php } ?>
            <th width="25%"></th>
        </tr>
        <tr>
            <th colspan="8"><hr class="style2"></th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($coa as $c) {
            foreach ($one as $sat) {
                if ($c->coa_id == $sat->coa_id) {
                    $satu = number_format($sat->saldo);
                    break;
                } else {
                    $satu = 0;
                }
                if ($c->header == 'header') {
                    $satu = '';
                }
            };

            foreach ($two as $du) {
                if ($c->coa_id == $du->coa_id) {
                    $dua = number_format($du->saldo);
                    break;
                } else {
                    $dua = 0;
                }
                if ($c->header == 'header') {
                    $dua = '';
                }
            };

            foreach ($three as $ti) {
                if ($c->coa_id == $ti->coa_id) {
                    $tiga = number_format($ti->saldo);
                    break;
                } else {
                    $tiga = 0;
                }
                if ($c->header == 'header') {
                    $tiga = '';
                }
            };

            foreach ($four as $em) {
                if ($c->coa_id == $em->coa_id) {
                    $empat = number_format($em->saldo);
                    break;
                } else {
                    $empat = 0;
                }
                if ($c->header == 'header') {
                    $empat = '';
                }
            };

            foreach ($five as $li) {
                if ($c->coa_id == $li->coa_id) {
                    $lima = number_format($li->saldo);
                    break;
                } else {
                    $lima = 0;
                }
                if ($c->header == 'header') {
                    $lima = '';
                }
            };
            ?>
            <tr>
                <?php if($satu AND $dua AND $tiga AND $empat AND $lima != 0 AND $c->header != 'header' OR $c->header =='header'){ ?>
                    <td></td>
                    <?php
                    if ($c->header == 'header') {
                        echo "<td style='padding-left: 1em;font-weight: bold;font-family: Courier, monospace;'><b>" . strtoupper($c->name_coa) . "<b></td>";
                    } else {
                        echo "<td style='font-size: 10pt;padding-left: 6em;font-weight:normal'>" . ($c->name_coa) . "</td>";
                    }
                    ?>

                    <td style='font-size: 10pt;padding-left: 6em;font-weight:normal' align="right"> <?php echo($satu); ?></td>
                    <td style='font-size: 10pt;padding-left: 6em;font-weight:normal' align="right"><?php echo($dua) ?></td>
                    <td style='font-size: 10pt;padding-left: 6em;font-weight:normal' align="right"><?php echo($tiga) ?></td>
                    <td style='font-size: 10pt;padding-left: 6em;font-weight:normal' align="right"><?php echo($empat) ?></td>
                    <td style='font-size: 10pt;padding-left: 6em;font-weight:normal' align="right"><?php echo($lima) ?></td>
                    <td></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8"><hr class="style2"></th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align: center; font-size: 12pt;">TOTAL</th>
            <th style="text-align: right; font-size: 12pt"><?php echo number_format($sum_satu) ?></th>
            <th style="text-align: right; font-size: 12pt"><?php echo number_format($sum_dua) ?></th>
            <th style="text-align: right; font-size: 12pt"><?php echo number_format($sum_tiga) ?></th>
            <th style="text-align: right; font-size: 12pt"><?php echo number_format($sum_empat) ?></th>
            <th style="text-align: right; font-size: 12pt"><?php echo number_format($sum_lima) ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<hr class="style3">
<!--END OF BODY CONTENT-->
</body>
</html>
<?php echo "<i class='pull-right' style='font-size: 8pt'>Page rendered time " . $this->benchmark->elapsed_time('code_start', 'code_end') . "</i>"; ?>
<style>
    body {
        margin: 10px;
    }

    hr.style3 {
        border-top: 5px double black;
    }
    hr.style2 {
        border-top: 2px double black;
    }
</style>