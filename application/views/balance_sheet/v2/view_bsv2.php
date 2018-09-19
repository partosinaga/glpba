<!DOCTYPE html>
<html>
<head>
    <title>REPORT | Balance Sheet</title>
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
        <li><a target="_blank" href="<?php echo site_url('balance_sheet/balance_sheetv2/export?id=') . $periode ?>"><i
                    class="fa fa-file-excel-o"></i> Export to Excel</a></li>
    </ul>
</div>

<body>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td>
        <br>
        <td><strong>BALANCE SHEET</strong></td>
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
                <th class="head_col">CURRENT MONTH
                    <hr>
                </th>
                <th class="head_col">PREVIOUS MONTH
                    <hr>
                </th>
            </tr>
            </thead>

            <tbody>
            <!--ASSETS-->
            <?php
            $group = '';
            $group2 = '';
            $ctg_caption = '';
            $tot_current = 0;
            $tot_previous = 0;
            $i=0;
            $current_balance=0; //UNTUK MENAMPUNG HASIL PENJUMLAHAN $RowCurrent + $LabaDitahan / $RowCurrent + $labaRugiTahunBerjalan
            $previous_balance = 0;
            $labaDitahan=0;
            $labaRugiTahunBerjalan = 0;
            $income = 0;
            $expense = 0;
            $rowCurrent = 0; //UNTUK MENAMPUNG JUMLAH BALANCE_CURRENT SETIAP ACCOUNT
            $rowPrevious = 0;
            foreach ($account as $a) { //GET ALL ROW DETAIL CATEGORY ACCOUNT
                foreach($current as $crt){ //GET BALANCE FOR CURRENT MONTH
                    if($a->id_detail == $crt->id_detail){
                        $rowCurrent = $crt->balance_current;
                        break;
                    }else{
                        $rowCurrent = 0;
                    }
                }
                foreach($previous as $prv){
                    if($a->id_detail == $prv->id_detail){
                        $rowPrevious = $prv->balance_previous;
                        break;
                    }else{
                        $rowPrevious = 0;
                    }
                }
            ?>
                <?php
                if($ctg_caption != $a->ctg_caption){//TO GET TOTAL EACH CATEGORY EXCEPT THE LAST CATEGORY
                    if($ctg_caption != ''){
                        echo '<tr id="total">
                                <th class="group" > TOTAL ' . strtoupper($ctg_caption) .'</th>
                                <th class="text-right" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.number_format($tot_current).'</th>
                                <th class="text-right" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.number_format($tot_previous).'</th>
                            </tr>';
                        $tot_current = 0;
                        $tot_previous = 0;
                    }
                }



                if ($ctg_caption != $a->ctg_caption) {
                    echo '
                    <tr>
                      <th class="group"> ' . strtoupper($a->ctg_caption) . ' </th>
                      <th></th>
                      <th></th>
                    </tr>';
                    $ctg_caption = $a->ctg_caption;
                }

                if($group2 != $a->id_subcategory){
                    echo '
                    <tr>
                      <th class="subgroup"> ' . strtoupper($a->subcategory) . ' </th>
                      <th></th>
                      <th></th>
                    </tr>';
                    $group2 = $a->id_subcategory;
                }

                //GET LABA DITAHAN
                $income = $LDI5->ldi5 + $LDI8->ldi8;
                $expense = $LDE7->lde7 + $LDE802->lde802;
                $labaDitahan = $income - $expense;
                if(strpos($a->account, 'tahan')){ //FOR CHECK LABA DITAHAN ACCOUNTS
                    $current_balance = $rowCurrent +  $labaDitahan;
                    $previous_balance = $rowPrevious + $labaDitahan;
                } else {
                    $current_balance = $rowCurrent;
                    $previous_balance = $rowPrevious;
                }
                //END OF GET LABA DITAHAN

                //GET CURRENT LABARUGI BERJALAN
                $inc = $LRI5->lri5 + $LRI8->lri8;
                $exp = $LRE7->lre7 + $LRE802->lre802;
                $labaRugiTahunBerjalan = $inc - $exp;

                //GET PREVIOUS LABARUGI BERJALAN
                $pinc = $PLRI5->plri5 + $PLRI8->plri8;
                $pexp = $PLRE7->plre7 + $PLRE802->plre802;
                $PreviousLabaRugiTahunBerjalan = $pinc - $pexp;

                if(strpos($a->account, 'berjalan')){ //FOR CHECK LABA BERJALAN ACCOUNT
                    $current_balance = $current_balance +  $labaRugiTahunBerjalan;
                    $previous_balance = $previous_balance + $PreviousLabaRugiTahunBerjalan;
                } else {
                    $current_balance = $current_balance;
                    $previous_balance = $previous_balance;
                }
                //END OF LABARUGI BERJALAN
                echo '
                        <tr style="cursor: pointer" >
                          <td class="content" onclick="breakdown(\'' . $a->id_detail . '\', \'' . $a->account . '\');" >' . $a->account . '</td>
                          <td class="content" align="right" onclick="breakdown(\'' . $a->id_detail . '\', \'' . $a->account . '\');" >' . number_format($current_balance) . '</td>
                          <td class="content" align="right" onclick="breakdownPrev(\'' . $a->id_detail . '\', \'' . $a->account . '\');">' . number_format($previous_balance) . '</td>
                        </tr>';
                $tot_current = $tot_current + $rowCurrent;
                $tot_previous = $tot_previous + $rowPrevious;

                $i++;

                if($i == count($account)){//TO GET TOTAL IN LAST CATEGORY,in this case TOTAL EXPENSE
                    if($ctg_caption != ''){
                        echo '<tr>
                                <th class="group" >TOTAL ' . strtoupper($a->ctg_caption) . '</th>
                                <th class="text-right" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.number_format($tot_current + $labaRugiTahunBerjalan + $labaDitahan).'</th>
                                <th class="text-right" style="border-top:1px solid; border-bottom:1px solid; background-color: #f7f7f7">'.number_format($tot_previous + $PreviousLabaRugiTahunBerjalan + $labaDitahan).'</th>
                              </tr>';
                        $tot_current = 0;
                        $tot_previous = 0;
                    }

                }

                ?>

            <?php } ?>


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

    function breakdown(id_detail, account) {
        var dateTo = "<?php echo $dateTo ?>";
        if(account.includes('tahan') == true){ //UNTUK CEK APAKAH AKUN LABADITAHAN OR NOT
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownLabaDitahan/') ?>' + dateTo + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }else if(account.includes('berjalan')){ //CEK AKUN LABARUGI BERJALAN ATAU TIDAK
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownLabaBerjalan/') ?>' + dateTo + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }else{
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdown/') ?>' + dateTo + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }
    }

    function breakdownPrev(id_detail, account) {
        var dateFrom = "<?php echo $dateFrom ?>";
        if(account.includes('tahan')){
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownLabaDitahan/') ?>' + dateFrom + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }else if(account.includes('berjalan')){
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownLabaBerjalanPrev/') ?>' + dateFrom + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }else {
            window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownPrev/') ?>' + dateFrom + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
        }
    }


    function breakdownLabaBerjalanPrev(id_detail, account) {
        var dateTo = "<?php echo $dateTo ?>";
        window.open('<?php echo base_url('index.php/balance_sheet/balance_sheetv2/breakdownLabaBerjalanPrev/') ?>' + dateTo + '/' + id_detail + '/' + encodeURIComponent(account) + ' ');
    }
</script>