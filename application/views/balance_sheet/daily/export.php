<?php
$test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=DBS-".$periode.".xls");

header("Pragma: no-cache");

header("Expires: 0");
echo $test;
?>

<body>
<div id="div1">
    <div class="t_header">
         <table>
            <tr>
                <td colspan="3" align="center"><b>PT INTERGRAHA EKAMAKMUR</b></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><b>DAILY BALANCE SHEET</b></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><b>
                        (Periode: <?php
                        $per = New DateTime($periode);
                        echo $per->format('M-Y');
                        ?>)</b>
                </td>
            </tr>
        </table>
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
                <th class="group" >ASSETS</th>
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
                            <td style="padding-left: 4em" class="content">'.$bs->name_coa.'</td>
                            <td class="content" align="right">'.($bs->assets).'</td>
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
                <th class="group" > TOTAL ASSETS </th>
                <th class="subgroup" align="right"> <?php echo ($total_assets->total_assets) ?> </th>
            </tr>
            <tr>
                <td></td>
                <td><hr class="style1"></td>
            </tr>
            <!-- LIABILITIES -->
            <tr>
                <th class="group">LIABILITIES</th>
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
                        <td style="padding-left: 4em" class="content">'.$bsl->name_coa.'</td>
                        <td class="content" align="right">'.($bsl->liabilities).'</td>
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
                <td style="padding-left: 4em" class="content">Laba Ditahan</td>
                <td  class="content" align="right"><?php echo ($labaDitahan); ?></td>
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
                <td style="padding-left: 4em" class="content"> Laba (Rugi) Tahun Berjalan</td>
                <td class="content" align="right"><?php echo ($labaRugiTahunBerjalan); ?></td>
            </tr>
            <!-- END OF LABA/RUGI TAHUN BERJALAN -->

            <tr>
                <td></td>
                <td><hr class="style1"></td>
            </tr>
            <tr bgcolor="#f9f4f4">
                <th class="group"> TOTAL LIABILITIES </th>
                <th class="subgroup" align="right"> <?php echo ($total_liabilities->total_liabilities+$labaDitahan+$labaRugiTahunBerjalan) ?> </th>
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