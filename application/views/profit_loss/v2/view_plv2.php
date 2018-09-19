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
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-magic"></i>
        Action
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
        <li><a target="_blank" href="<?php echo site_url('profit_loss/profit_lossv2/export?id=') . $periode ?>"><i
                    class="fa fa-file-excel-o"></i> Export to Excel</a></li>
    </ul>
</div>

<body>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td>
        <br>
        <td><strong>PROFIT & LOSS STATEMENT</strong></td>
        <br>
        <td class="date">
            <small>
                (Periode: <?php
                $per = New DateTime($periode);
                echo $per->format('M-Y');
                ?>)
            </small>
        </td>
    </div>
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
                                <th class="group" > TOTAL ' . strtoupper($ctg_caption) .'</th>
                                <th class="content ytm" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($income_ytm = $tot_ctg_ytm).'</td>
                                <th class="content ytm" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($income_ytd = $tot_ctg_ytd).'</td>
                           </tr>';

                        $tot_ctg_ytm = 0;
                        $tot_ctg_ytd = 0;

                    }
                }

                if($ctg_caption != $row->category){//TO GET CATEGORY
                    echo '<tr>
                              <td colspan="3" class="group"> ' . strtoupper($row->category) . '</td>
                            </tr>';

                    $ctg_caption = $row->category;
                }

                if($sub_ctg_caption != $row->name){//TO GET SUBCATEGORY

                    echo '<tr>
                              <td colspan="3" class="subgroup">' . strtoupper($row->name) . '</td>
                            </tr>';

                    $sub_ctg_caption = $row->name;
                }
                //GET ROW DETAIL ACCOUNT
                echo '
                    <tr style="cursor: pointer">
                        <td class="content" onclick="breakdown(\''.$row->id_detail.'\',\''.$dateFrom.'\',\''.$dateTo.'\',\''.$row->account.'\')">' .$row->account . '</td>
                        <td class="content" onclick="breakdown(\''.$row->id_detail.'\',\''.$dateFrom.'\',\''.$dateTo.'\',\''.$row->account.'\')" align="right">'.number_format($current_month).'</td>
                        <td class="content" onclick="breakdownYtd(\''.$row->id_detail.'\',\''.$dateTo.'\',\''.$yearStart.'\', \''.$row->account.'\')" align="right">'.number_format($previous).'</td>
                    </tr>';
                $tot_ctg_ytm = $tot_ctg_ytm + $current_month;
                $tot_ctg_ytd = $tot_ctg_ytd + $previous;
                $i++;


                if($i == count($account)){//TO GET TOTAL IN LAST CATEGORY,in this case TOTAL EXPENSE
                    if($ctg_caption != ''){
                        echo '<tr>
                                <th class="group" >TOTAL ' . strtoupper($row->category) . '</th>
                                <th class="content ytmexp" id = "ytm-exp" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($expense_ytm = $tot_ctg_ytm).'</td>
                                <th class="content ytdexp" id="ytd-exp" style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($expense_ytd = $tot_ctg_ytd).'</td>
                            </tr>';
                        $tot_ctg_ytm = 0;
                        $tot_ctg_ytd = 0;
                    }

                }


                ?>

            <?php endforeach ?>
            <tr>
                <th class="group" style="height: 30px">NET PROFIT </th>
                <th class="content ytm-total"  style="text-align:right; border-top: 3px double black;border-bottom: 3px double black; background-color: #e4e4e4; font-weight:bold"><?php echo number_format($income_ytm - $expense_ytm) ?></td>
                <th class="content ytd-total"  style="text-align:right; border-top: 3px double black;border-bottom: 3px double black; background-color: #e4e4e4; font-weight:bold"><?php echo number_format($income_ytd - $expense_ytd) ?></td>
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
</html>
<style type="text/css">
    body {
        margin: 30px;
    }

    hr.style2 {
        border-top: 3px double black;
    }

    hr.style1 {
        border-top: 3px double black;
    }

    hr.style3 {
        border-top: 5px double black;
    }

    .t_content {
        width: 100%;
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

    .group {
        padding-left: 1em;
        font-weight: bold;
        font-size: 12pt;
        font-family: Courier, monospace;
    }

    .subgroup {
        font-family: Courier, monospace;
        padding-left: 3em;
        font-size: 10pt;
        font-weight: bold;
    }

    .content {
        font-size: 10pt;
        padding-left: 6em;
        font-weight: normal
    }

    .head_col {
        width: 150px;
        text-align: right;
        font-size: 10pt;
        border-bottom: 1px solid black;
    }

    .date {
        font-size: 4pt
    }

    .dropdown {
        position: fixed;;
    }

    td:hover {
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
    $(document).ready(function(){

        //MONTHLY
        var cogsID = 0; //GET ID TD GOGS
        $('.ytm').each(function() {
            cogsID = Math.max(this.id, cogsID);
        });//GET COGS VALUE
        var incomeID = cogsID-1; //GET ID TD INCOME



        var inc = document.getElementById(incomeID).innerText;
        var cogs = document.getElementById(cogsID).innerText;
        var expense = document.getElementById('ytm-exp').innerText;
        var gross = inc-cogs;
        var result = gross-expense;
        $(".ytm-total").html(result.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        //END OF MONTHLY

        //YTD
        var ytd_inc = document.getElementById('ytd-'+incomeID).innerText;
        var ytd_cogs = document.getElementById('ytd-'+cogsID).innerText;
        var ytd_expense = document.getElementById('ytd-exp').innerText;

        var ytd_gross = ytd_inc-ytd_cogs;
        var ytd_result = ytd_gross-ytd_expense;

        $(".ytd-total").html(ytd_result.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        //END OF YTD

        $("th.ytm, th.ytmexp, th.ytd, th.ytdexp").each(function() {//TO MAKE FORMAT NUMEBR
            $(this).html(parseFloat($(this).text()).toLocaleString());
        });

    })

    function breakdown(id_detail, dateFrom, dateTo, ctg_caption){
        console.log(id_detail);
        window.open('<?php echo site_url('profit_loss/profit_lossv2/breakdown/')?>'+id_detail+'/'+dateFrom+'/'+dateTo+'/'+encodeURIComponent(ctg_caption)+'  ');
    }
    function breakdownYtd(id_detail, dateTo, yearStart, ctg_caption){
        console.log(id_detail);
        window.open('<?php echo site_url('profit_loss/profit_lossv2/breakdownYtd/')?>'+id_detail+'/'+dateTo+'/'+yearStart+'/'+encodeURIComponent(ctg_caption)+'  ');
    }
</script>