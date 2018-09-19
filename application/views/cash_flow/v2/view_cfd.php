<html>
<head>
    <title>REPORT | Cash Flow</title>
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
                <li><a target="_blank" href="<?php echo site_url('cash_flow/cash_flow/export?id='.$date_to) ?>"><i class="fa fa-file-excel-o"></i> Export to
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
            $per = new DateTime($date_to);

            echo $per->format('d-M-Y');
            ?>)
        </td>
    </div>
    <hr class="style3">
    <div id="body">
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

                foreach($account as $ac){
                    foreach($monthly as $my){
                        if($my->id_detail == $ac->id_detail){
                            $month = $my->monthly;
                            $report_type_monthly = $my->report_type;
                            break;
                        }else{
                            $month = 0;
                            $report_type_monthly = '';
                        }
                    };
                    foreach($monthly_prev as $myp){
                        if($myp->id_detail == $ac->id_detail){
                            $month_prev = $myp->prev_monthly;
                            $report_type_monthly_prev = $myp->report_type;
                            break;
                        }else{
                            $month_prev = 0;
                            $report_type_monthly_prev = '';
                        }
                    }
                    foreach($total as $tl){
                        if($tl->id_detail == $ac->id_detail){
                            $tot = $tl->total;
                            break;
                        }else{
                            $tot = 0;
                        }
                    }
                    foreach($total_prev as $tlp){
                        if($tlp->id_detail == $ac->id_detail){
                            $tot_prev = $tlp->total_prev;
                            break;
                        }else{
                            $tot_prev = 0;
                        }
                    }

                    if($group != $ac->id_subcategory){
                        echo'<tr>
                                <td class="group" style="color:#4298d6">'.strtoupper($ac->name).'</td>
                                <td align="right"></td>
                            </tr>';
                        $group = $ac->id_subcategory;
                    }else{
                        echo '';
                    }


            ?>
                    <tr style="cursor: pointer">
                        <td class="content"  onclick="breakdownMonthly('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $date_from ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )"><?php echo $ac->account ?></td>
                        <td style="cursor: pointer" align="right" class="content " onclick="breakdownMonthly('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $date_from ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )" >
                            <?php
                                if(($ac->subgroup >= 100 AND $ac->subgroup <= 199) OR
                                    ($ac->subgroup >= 600 AND $ac->subgroup <= 799) OR
                                    ($ac->subgroup >= 802 AND $ac->subgroup <= 999)
                                ){ //check group debit or credit
                                    echo number_format($sum_monthly = $month_prev - $month);
                                }else{
                                    echo number_format($sum_monthly = $month - $month_prev);
                                }
                            ?>
                        </td>
                        <td style="cursor: pointer" align="right" class="content total" onclick="breakdownTotal('<?php echo $ac->report_type ?>','<?php echo $date_to ?>','<?php echo $yearStart ?>','<?php echo $PrevYearStart ?>','<?php echo $ac->id_detail ?>','<?php echo $ac->account ?>' )">
                            <?php
                            if(($ac->subgroup >= 100 AND $ac->subgroup <= 199) OR
                                ($ac->subgroup >= 600 AND $ac->subgroup <= 799) OR
                                ($ac->subgroup >= 802 AND $ac->subgroup <= 999)
                            ){ //check group debit or credit
                                echo number_format($sum_total = $tot_prev - $tot);
                            }else{
                                echo number_format($sum_total = $tot - $tot_prev);
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

    function breakdownMonthly(report_type, date_to, date_from, id_detail, account){
        window.open('<?php echo base_url('index.php/cash_flow/cash_flow/breakdown_monthly/') ?>' + report_type + '/' + date_to + '/' + date_from + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');

    }

    function breakdownTotal(report_type, date_to, year_start,prev_year_start, id_detail, account){
//        console.log(report_type+'==='+periode+'==='+id_detail);
      window.open('<?php echo base_url('index.php/cash_flow/cash_flow/breakdown_total/') ?>' + report_type + '/' + date_to + '/' + year_start + '/' + prev_year_start + '/' + id_detail + '/' + encodeURIComponent(account) +  ' ');

    }
</script>