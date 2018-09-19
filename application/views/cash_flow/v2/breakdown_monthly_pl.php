<!DOCTYPE html>
<html>
<head>
    <title>REPORT | Profit & Loss Statement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    $sql = "SELECT * FROM system_parameter";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
    ?>
    <b value="<?php echo $row->company_id; ?>">
        <?php }
        } ?></b>
</head>

<div class="dropdown">
    <a href="#" onclick="printContent('div1')">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-print"></i>
            Print
        </button>
    </a>
</div>

<body>
<div id="div1">
    <div class="t_header">

        <tr>
            <td align="center"><strong><?php echo strtoupper($row->name); ?></strong></td>
        </tr>
        <br>
        <tr>
            <td align="center"><strong>CASHFLOW BREAK DOWN</strong></td>
        </tr>
        <br>
        <tr>
            <td align="center">
                <small><?php $per = New DateTime($periode);
                    echo $per->format('M-Y'); ?></small>
            </td>
        </tr>
        <br>
        <tr>
            <td align="center">
                <small><?php echo str_replace(array('%20', '%26'), ' ', $account) ?></small>
            </td>
        </tr>

    </div>


    <div id="body">
        <hr class="style3">
        <table class="table table-report table-striped table-hover" style="margin-top:0px;margin-bottom:15px;background:#ffffff;font-size: 12px">
            <thead>
            <tr>
                <th width="15%" class="text-center">COA ID</th>
                <th>DESCRIPTION</th>
                <th class="text-right" width="10%">DEBIT</th>
                <th class="text-right" width="10%">CREDIT</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $d_total = 0;
                $c_total = 0;
                    foreach($current as $crn):
                        $d_total = $d_total + $crn->debit;
                        $c_total = $c_total + $crn->credit;
                ?>

                <tr>
                    <td align="center"><?php echo $crn->coa_id ?></td>
                    <td><?php echo $crn->name_coa ?></td>
                    <td align="right"><?php echo number_format($crn->debit) ?></td>
                    <td align="right"><?php echo number_format($crn->credit) ?></td>
                </tr>
                <?php endforeach ?>

            </tbody>
            <tfoot>
            <tr>
                <th class="text-right" colspan="2">TOTAL</th>
                <th class="text-right" style="background-color: #e4e4e4;border-bottom:3px double black"><?php echo number_format($d_total) ?></th>
                <th class="text-right" style="background-color: #e4e4e4;border-bottom:3px double black"><?php echo number_format($c_total) ?></th>
            </tr>
            </tfoot>
        </table>


        <hr class="style3">
    </div>

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
</body>
</html>
<style type="text/css">


    body {
        margin: 30px;
    }

    hr.style3 {
        border-top: 5px double black;
    }

    .total {
        border-top: 3px double black;
        border-bottom: 3px double black;
        height: 35px;
        background-color: #e4e4e4;
    }

    .t_user {
        font-family: Courier, monospace;
        font-size: 7pt;
        font-style: italic;
    }

    .t_header {
        font-family: Courier, monospace;
        font-size: 15pt;
        text-align: center;
    }

    .coa {
        font-style: italic;
        font-weight: bold;
        font-family: "Open Sans", sans-serif;
        font-size: 14px;
        border-top: 2px solid;
    }

    .header {
        font-family: Courier, monospace;
        font-size: 10pt;
        border-top: 2px solid;
        border-bottom: 2px solid;

    }

    .content {
        font-size: 10pt;
        font-weight: normal
    }

    .dropdown {
        position: fixed;
    }

    tr:hover {
        background-color: #e4e4e4;
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
