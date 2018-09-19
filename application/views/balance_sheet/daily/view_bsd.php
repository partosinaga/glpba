<!DOCTYPE html>
<html>
<head>
    <title>REPORT | Daily Balance Sheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    $sql ="SELECT * FROM system_parameter";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {?>
    <b value="<?php echo $row->company_id;?>">
        <?php } } ?>
        </head>


        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-magic"></i> Action
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li ><a href="#" onclick="printContent('div1')"><i class="fa fa-print"></i> Print</a></li>
                <li ><a target="_blank" href="<?php echo site_url('balance_sheet/bsd/export?id=').$periode ?>"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
            </ul>
        </div>

<body>
<div id="div1">
    <div class="t_header">
        <td><strong><?php echo strtoupper($row->name); ?></strong></td><br>
        <td><strong>DAILY BALANCE SHEET</strong></td><br>
        <td class="date">
            (Periode: <?php
            $per = New DateTime($periode);
            echo $per->format('d-M-Y');
            ?>)
        </td>
    </div>
    <hr class="style3">

    <div id="body">

        <table class="t_content table-hover">
            <thead>
                <tr>
                    <th width=""></th>
                    <th class="head_col">TOTAL<hr></th>
                </tr>
            </thead>

            <tbody>
            <!-- ASSETS -->
                <tr>
                    <td class="group" >ASSETS</td>
                    <td></td>
                </tr>
                <?php
                $group='';
                $prev = 0;
                foreach ($assets as $bs) { // GET EACH ROW
                    ?>
                    <?php
                    $result = '';
                    if ($group != $bs->subgroup_id) {
                        $result .= '

                          <tr>
                            <td class="subgroup" > '. strtoupper($bs->name_sg).' </td>
                            <td></td>
                          </tr>';
                        $group=$bs->subgroup_id;
                    } else {
                        $result .= '';
                    };
                    $result .='
                          <tr >
                            <td class="content">'.$bs->name_coa.'</td>
                            <td class="content" align="right">'.number_format($bs->assets).'</td>
                          </tr>';

                    echo $result;

                    ?>
                <?php  }; ?>
                <!-- END OF ASSETS -->
                <tr>
                    <td></td>
                    <td><hr class="style1"></td>
                </tr>
                <tr bgcolor="#f9f4f4">
                    <td class="group" > TOTAL ASSETS </td>
                    <td class="subgroup" align="right"> <?php echo number_format($total_assets->total_assets) ?> </td>
                </tr>
                <tr>
                    <td></td>
                    <td><hr class="style1"></td>
                </tr>
                <!-- LIABILITIES -->
                <tr>
                    <td class="group">LIABILITIES</td>
                    <td></td>
                </tr>
                <?php
                $group='';
                $prv=0;
                foreach ($liabilities as $bsl) {
                    ?>
                    <?php
                    $result = '';

                    if ($group != $bsl->subgroup_id) {
                        $result .= '
                          <tr>
                            <td class="subgroup"> '. strtoupper($bsl->name_sg).' </td>
                            <td></td>
                          </tr>';
                        $group=$bsl->subgroup_id;
                    } else {
                        $result .= '';
                    };
                    $result .='
                      <tr >
                        <td class="content">'.$bsl->name_coa.'</td>
                        <td class="content" align="right">'.number_format($bsl->liabilities).'</td>
                      </tr>';

                    echo $result;
                    ?>
                <?php }; ?>

                <!-- LABA DITAHAN -->
                <?php
                $income = $LDI5->ldi5 + $LDI8->ldi8;
                $expense = $LDE7->lde7 + $LDE802->lde802;
                $labaDitahan = $income - $expense;
                ?>
                <tr>
                    <td class="subgroup"> LABA DITAHAN </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="content">Laba Ditahan</td>
                    <td class="content" align="right"><?php echo number_format($labaDitahan); ?></td>
                </tr>
                <!-- END OF LABA DITAHAN -->

                <!-- LABA/RUGI TAHUN BERJALAN -->
                <?php
                //FOR CURRENT MONTH
                $inc = $LRI5->lri5 + $LRI8->lri8;
                $exp = $LRE7->lre7 + $LRE802->lre802;
                $labaRugiTahunBerjalan = $inc - $exp;
                ?>
                <tr>
                    <td class="subgroup"> LABA (RUGI) TAHUN BERJALAN </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="content"> Laba (Rugi) Tahun Berjalan</td>
                    <td class="content" align="right"><?php echo number_format($labaRugiTahunBerjalan); ?></td>
                </tr>
                <!-- END OF LABA/RUGI TAHUN BERJALAN -->

                <tr>
                    <td></td>
                    <td><hr class="style1"></td>
                </tr>
                <tr bgcolor="#f9f4f4">
                    <td class="group"> TOTAL LIABILITIES </td>
                    <td class="subgroup" align="right"> <?php echo number_format($total_liabilities->total_liabilities+$labaDitahan+$labaRugiTahunBerjalan) ?> </td>
                </tr>
                <tr>
                    <td></td>
                    <td><hr class="style1"></td>
                </tr>
            <!-- END OF LIABILITIES -->
            </tbody>
            <footer>
                <th ></th>
                <th align="right"></th>
            </footer>
        </table>
        <hr class="style3">
        <?php
        echo '
              <table class="t_user">
                <tr>
                  <td>Printed by:</td>
                  <td>'.$this->session->userdata('username').'</td>
                </tr><br>
                <tr>
                  <td>Date/time: </td>
                  <td>'.date('d-M-Y'). ' / ' . date('H;i;sa').'</td>
                </tr>
              <table>';
        ?>


    </div>
</div>
</body>
</html>
<style type="text/css">
    body{
        margin: 10px;
        margin-left: 100px;
        margin-right: 100px;
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
    .t_content{
        width: 100%;
    }
    .t_user{
        font-family: Courier, monospace;
        font-size: 7pt;
        font-style: italic;
    }
    .t_header{
        font-family: Courier, monospace;
        font-size: 15pt;
        text-align: center;
    }
    .group{
        padding-left: 1em;
        font-weight: bold;
        font-family: Courier, monospace;
    }
    .subgroup{
        font-family: Courier, monospace;
        padding-left: 3em;
        font-weight: bold;
    }
    .content{
        font-size: 10pt;
        padding-left: 6em;
        font-weight:normal
    }
    .head_col{
        width: 10%;
        text-align: right;
        font-size: 15pt;
    }
    .date{
        font-size: 4pt
    }
    .dropdown{
        position: fixed;;
    }
</style>

<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>