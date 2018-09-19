<!DOCTYPE html>
<html>
<head>
    <title>REPORT | Breakdown Balance Sheet</title>
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
<div class="dropdown" style="position: fixed">
    <a href="#" onclick="printBreakdown('div1')">
    <button class="btn btn-primary" data-toggle="dropdown"><i class="fa fa-print"></i> Print</button>
    </a>
</div>
<body>
<div id="div1">
    <div class="t_header">
        <table width="100%" >
            <tr>
                <td align="center"><strong><?php echo strtoupper($row->name); ?></strong></td>
            </tr>
            <tr>
                <td align="center"><strong>BALANCE SHEET BREAK DOWN</strong></td>
            </tr>
            <tr>
                <td align="center">
                    <small><?php $per = new DateTime($period);
                        echo $per->format('M-Y') ?></small>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <small><?php echo str_replace(array('%20', '%26'), ' ' ,$account) ?></small>
                </td>
            </tr>
        </table>
    </div>
    <hr class="style3">

    <div id="body">
        <table class="table table-report table-striped table-hover" style="margin-top:0px;margin-bottom:15px;background:#ffffff;">
            <thead>
            <tr>
                <th width="10%" class="text-center">COA ID</th>
                <th>DESCRIPTION</th>
                <th width="15%" class="text-right">BALANCE</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($rowData as $r): ?>
                <tr>
                    <td align="center" class="content"><?php echo $r->coa_id ?></td>
                    <td class="content"><?php echo $r->name_coa ?></td>
                    <td align="right" class="content"><?php echo number_format($r->balance) ?></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <th colspan="2" class="text-right">TOTAL</th>
                    <th align="right" class="text-right" style="background-color: #e4e4e4"><?php echo number_format($rowTotal->total) ?></th>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<hr class="style3">
</body>
</html>
<style type="text/css">
    body {
        margin: 30px;
    }
    hr.style3 {
        border-top: 5px double black;
    }
    .t_header {
        font-family: Courier, monospace;
        font-size: 15pt;
        text-align: center;
    }
    .content {
        font-size: 10pt;
        padding-left: 6em;
        font-weight: normal
    }

    .dropdown {
        position: fixed;;
    }
</style>

<script>
    function printBreakdown(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>