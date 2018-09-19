 <?php
 $test="<style> .number{mso-number-format:\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)} </style>";
header("Content-type: application/vnd-ms-excel");

 header("Content-Disposition: attachment; filename=BS-".$periode.".xls");

header("Pragma: no-cache");

header("Expires: 0");
 echo $test;
?>
<body>
  <div id="div1">
     <table>
        <tr>
          <td colspan="3" align="center"><b>IEM</b></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><b>BALANCE SHEET</b></td>
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
   <hr class="style3">

    <div id="body">
      
      <table class="t_content">
        <thead>
          <tr >
            <th width=""></th>
            <th class="head_col">CURRENT MONTH<hr></th>
            <th class="head_col">PREVIOUS MONTH<hr></th>
          </tr>
        </thead>

        <tbody>
<!-- ASSETS -->
          <tr>
            <th class="group" >ASSETS</th>
            <td></td>
            <td></td>
          </tr>
            <?php
              $group='';
              $prev = 0;
              foreach ($bsheetA as $bs) { // GET EACH ROW
              foreach ($prev_month_asset as $pma) { //GET PREVIOUS MONTH
                if ($bs->coa_id == $pma->coa_id) { // TO GET PREVIOUS MONTH
                  $prev = $pma->asset_previous;
                  break;
                } else {
                  $prev = 0;

                }
              };            
              
            ?>
            <?php          
              $result = '';
                if ($group != $bs->subgroup_id) {
                    $result .= '

                      <tr>
                        <td class="subgroup" > '. strtoupper($bs->name_sg).' </td>
                        <td></td>
                        <td></td>
                      </tr>';
                      $group=$bs->subgroup_id;
                } else {
                    $result .= '';
                };
                $result .='
                      <tr >
                        <td class="number" style="padding-left: 4em">'.$bs->name_coa.'</td>
                        <td class="number" align="right">'.($bs->asset_current).'</td>
                        <td class="number" align="right">'.($prev).'</td>
                      </tr>';
                
              echo $result;
              
            ?>
          <?php  }; ?>
<!-- END OF ASSETS -->
          <tr>
            <td></td>
            <td><hr class="style1"></td>
            <td><hr class="style1"></td>
          </tr>
          <tr bgcolor="#f9f4f4">
            <th class="group" > TOTAL ASSETS </th>
            <th class="number" align="right"> <?php echo ($total_asset->t_asset) ?> </th>
            <th class="number" align="right"> <?php echo ($total_prev_asset->t_asset_prev) ?> </th>
          </tr>
          <tr>
            <td></td>
            <td><hr class="style1"></td>
            <td><hr class="style1"></td>
          </tr>
<!-- LIABILITIES -->
          <tr>
            <th class="group">LIABILITIES</th>
            <td></td>
            <td></td>
          </tr>
            <?php 
              $group='';
              $prv=0;
              foreach ($bsheetL as $bsl) {
                foreach ($prev_month_liab as $pml) {
                  if ($pml->coa_id == $bsl->coa_id) {
                      $prv = $pml->liabiliti_previous;
                      break;
                  } else {
                      $prv=0;
                  } 
                }
            ?>  
            <?php
              $result = '';

                    if ($group != $bsl->subgroup_id) {
                    $result .= '
                      <tr>
                        <td class="subgroup"> '. strtoupper($bsl->name_sg).' </td>
                        <td></td>
                        <td></td>
                      </tr>';
                    $group=$bsl->subgroup_id;
                    } else {
                      $result .= '';
                    };
                $result .='
                  <tr >
                    <td class="content" style="padding-left: 4em">'.$bsl->name_coa.'</td>
                    <td class="number" align="right">'.($bsl->liabiliti_current).'</td>
                    <td class="number" align="right">'.($prv).'</td>
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
              <td></td>
            </tr>
            <tr>
              <td class="content" style="padding-left: 4em">Laba Ditahan</td>
              <td class="number" align="right"><?php echo ($labaDitahan); ?></td>
              <td class="number" align="right"><?php echo ($labaDitahan); ?></td>
            </tr>
        <!-- END OF LABA DITAHAN -->

        <!-- LABA/RUGI TAHUN BERJALAN -->
        <?php 
          //FOR CURRENT MONTH
          $inc = $LRI5->lri5 + $LRI8->lri8;
          $exp = $LRE7->lre7 + $LRE802->lre802;
          $labaRugiTahunBerjalan = $inc - $exp;
        ?>

        <?php
          //FOR PREVIOUS MONTH
          $pinc = $PLRI5->plri5 + $PLRI8->plri8;
          $pexp = $PLRE7->plre7 + $PLRE802->plre802;
          $PlabaRugiTahunBerjalan = $pinc - $pexp;
        ?>
        <tr>
          <td class="subgroup"> LABA (RUGI) TAHUN BERJALAN </td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td class="content" style="padding-left: 4em"> Laba (Rugi) Tahun Berjalan</td>
          <td class="number" align="right"><?php echo ($labaRugiTahunBerjalan); ?></td>
          <td class="number" align="right"><?php echo ($PlabaRugiTahunBerjalan); ?></td>
        </tr>
        <!-- END OF LABA/RUGI TAHUN BERJALAN -->

            <tr>
              <td></td>
              <td><hr class="style1"></td>
              <td><hr class="style1"></td>
            </tr>
            <tr bgcolor="#f9f4f4">
              <th class="group"> TOTAL LIABILITIES </th>
              <th class="number" align="right"> <?php echo ($total_liabiliti->t_liabiliti+$labaDitahan+$labaRugiTahunBerjalan) ?> </th>
              <th class="number" align="right"> <?php echo ($total_prev_liabiliti->t_liabiliti_prev+$labaDitahan+$PlabaRugiTahunBerjalan) ?> </th>
            </tr>
            <tr>
              <td></td>
              <td><hr class="style1"></td>
              <td><hr class="style1"></td>
            </tr>
<!-- END OF LIABILITIES -->
        </tbody>
        <footer>
            <th ></th>
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