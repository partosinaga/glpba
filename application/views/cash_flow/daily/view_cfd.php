<html>
<head>
    <title>REPORT | Cash Flow Details</title>
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
    <b value="<?php echo $row->company_id; ?>"><?php }
        } ?>
        </head>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                    class="fa fa-magic"></i> Action <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
                <li><a target="_blank" href="<?php echo site_url('cash_flow/cfd/export?id='.$periode) ?>"><i class="fa fa-file-excel-o"></i> Export to
                        Excel</a></li>
            </ul>
        </div>
<body>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td>
        <br>
        <td><strong>CASH FLOW</strong></td>
        <br>
        <td class="date">
            (Periode <?php
            $per = new DateTime($periode);

            echo $per->format('d-M-Y');
            ?>)
        </td>
    </div>
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
            $i= 0;
            $month = 0;
            $month_prev = 0;
            $sum_monthly = 0;
            $tot_sum_montlhy = 0;
            $total = 0;
            $total_prev = 0;
            $tot_sum_total = 0;
            $mutation = 0;
            $mutation_ytd = 0;
                foreach($coa as $acc){
//                    FOR MONTHLY
                    foreach($monthly as $m){
                        if($m->coa_id == $acc->coa_id){
                            $month = $m->monthly;
                            break;
                        }else{
                            $month = 0;
                        }
                    }
                    foreach($monthlyPrev as $mp){
                        if($mp->coa_id == $acc->coa_id){
                            $month_prev = $mp->prev_monthly;
                            break;
                        }else{
                            $month_prev = 0;
                        }
                    }
                    if(($acc->subgroup >= 100 AND $acc->subgroup <= 199) OR
                        ($acc->subgroup >= 600 AND $acc->subgroup <= 799) OR
                        ($acc->subgroup >= 802 AND $acc->subgroup <= 999)
                    ){ //check group debit or credit
                        $sum_monthly = $month_prev - $month;
                    }else{
                        $sum_monthly = $month - $month_prev;
                    }
//            END OF MONTHLY
//                    YEAR TO DATE
                    foreach($ytd as $y){
                        if($y->coa_id == $acc->coa_id){
                            $total = $y->total;
                            break;
                        }else{
                            $total = 0;
                        }
                    }
                    foreach($ytdPrev as $yp){
                        if($yp->coa_id == $acc->coa_id){
                            $total_prev = $yp->total_prev;
                            break;
                        }else{
                            $total_prev = 0;
                        }
                    }
                    if(($acc->subgroup >= 100 AND $acc->subgroup <= 199) OR
                        ($acc->subgroup >= 600 AND $acc->subgroup <= 799) OR
                        ($acc->subgroup >= 802 AND $acc->subgroup <= 999)
                    ){ //check group debit or credit
                        $sum_total = $total_prev - $total;
                    }else{
                        $sum_total = $total - $total_prev;
                    }
//                    END OF YEAR TO DATE

                    if($ctg_caption != $acc->name){
                        if($ctg_caption != ''){
                            echo '<tr class="conclusion">
                                <th style="color:#4298d6"> TOTAL ' . strtoupper($ctg_caption) .'</th>
                                <th style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($tot_sum_montlhy).'</td>
                                <th style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($tot_sum_total).'</td>
                           </tr>';
                            $tot_sum_montlhy = 0;
                            $tot_sum_total = 0;
                        }
                    }

                    if($ctg_caption != $acc->name){
                        echo '<tr>
                              <td colspan="3" style="color:#4298d6" class="conclusion"> ' . strtoupper($acc->name) . '</td>
                            </tr>';

                        $ctg_caption = $acc->name;
                    }

                    if($sub_ctg_caption != $acc->account){
                        echo '<tr>
                              <td colspan="3" class="subgroup"> ' . strtoupper($acc->account) . '</td>
                            </tr>';

                        $sub_ctg_caption = $acc->account;
                    }

                    echo '
                    <tr>
                      <td class="content">'.$acc->name_coa.'</td>
                      <td class="content" align="right">'.number_format($sum_monthly).'</td>
                      <td class="content" align="right">'.number_format($sum_total).'</td>
                    </tr>';
                    $tot_sum_montlhy = $tot_sum_montlhy + $sum_monthly;
                    $tot_sum_total = $tot_sum_total + $sum_total;
                    $mutation = $mutation + $sum_monthly;
                    $mutation_ytd = $mutation_ytd + $sum_total;
                    $i++;


                    if($i == count($coa)){//TO GET TOTAL IN LAST CATEGORY
                        if($ctg_caption != ''){
                            echo '<tr class="conclusion">
                                <th style="color:#4298d6">TOTAL ' . strtoupper($acc->name) . '</th>
                                <th style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($tot_sum_montlhy).'</td>
                                <th style="text-align:right; border-top: 1px solid;border-bottom: 1px solid; background-color: #f7f7f7; font-weight:bold">'.number_format($tot_sum_total).'</td>
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
                <th class="text-right" style="color:#4298d6">Begining Cash & bank balance</th>
                <th style="border-top: 2px solid; text-align: right"><?php echo number_format($bgn->begining) ?></th>
                <th style="border-top: 2px solid; text-align: right"><?php echo number_format($bgn_prev->begining_ytd + $mutation_ytd) ?></th>
            </tr>
            <tr class="conclusion">
                <th class="text-right" style="color:#4298d6">Mutation</th>
                <th class="text-right "><?php echo number_format($mutation) ?></th>
                <th class="text-right"><?php echo number_format($mutation_ytd) ?></th>
            </tr>
            <tr class="conclusion">
                <th class="text-right" style="color:#4298d6">Ending Cash & bank balance</th>
                <th style="border-bottom: 2px solid;text-align: right"><?php echo number_format($bgn->begining + $mutation) ?></th>
                <th style="border-bottom: 2px solid;text-align: right"><?php echo number_format($bgn_prev->begining_ytd) ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr class="style3">
</div>
</body>
</html>
<style type="text/css">
    .conclusion{
        font-style: italic;
        font-weight: bold;
        font-family: "Open Sans", sans-serif;
        font-size: 14px;
    }
    hr.style2 {
        border-top: 2px double black;
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
        width: 200px;
        text-align: right;
        font-size: 10pt;
    }

    .group {
        padding-left: 1em;
        font-weight: bold;
        font-family: Courier, monospace;
    }

    .subgroup {
        font-family: Courier, monospace;
        padding-left: 3em;
        font-weight: bold;
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
        margin: 15px;
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