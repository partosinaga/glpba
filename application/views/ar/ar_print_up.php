<!DOCTYPE html>
<html>
<head>
  <title>&nbsp</title>
    <style type="text/css">
      .no_border {
          border-collapse: collapse;
      }

      .no_border, .td_no-border {
          border: 1px solid black;
      }
      
      body {
        background-color: #fff;
        margin: 15px 15px 15px 15px;
        font: 11px normal Helvetica, Arial, sans-serif;
        color: #000000;
      }
    </style>
</head>

  <body onload="window.print();"  >   
    <div>
      <p align="left" style="font-size: 12pt">PODOMORO BANGUN ABADI</p>
      <p align="center" style="font-size: 12pt">BUKTI PENERIMAAN KAS/BANK</p>
    </div>
      <table width="100%" style="bottom: 0px">
        <tr>
          <td width="15%">Diterima dari:</td>
          <td>:
            <?php foreach ($header as $h) {
              echo $h->name;
            } ?>
          </td>
          <td width="10%">No</td>
          <td>:
            <?php foreach ($header as $h) {
              echo $h->no_voucher;
            } ?>
          </td>
        </tr>

        <tr>
          <td>Jumlah Uang</td>
            <td>:
                <?php foreach ($header as $h) {
                    echo $h->curr_id. number_format($h->total);
                } ?>
            </td>
          
          <td>Tanggal</td>
          <td>:
            <?php foreach ($header as $h) {
              $date = new DateTime($h->date);
              echo $date->format('d-m-Y');
            } ?>
          </td>
        </tr>

        <tr>
          <td>Keterangan</td>
          <td>: 
            <?php foreach ($header as $h) {
              echo $h->description;
            } ?>
          </td>
          
          <td>GL</td>
          <td>:</td>
        </tr>

        <tr>
          <td>Bank</td>
          <td>: 
            <?php foreach ($header as $h) {
              echo $h->bank_id;
            } ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   Giro/Cek No. :
          </td> 
          
          <td>Tanggal</td>
          <td>:</td>
        </tr>
      </table><br>




      <table class="no_border" width="100%">
        <tr class="td_no-border">
          <td class="td_no-border" width="20%" align="center">ACCOUNT</td>
          <td class="td_no-border" align="center">KETERANGAN</td>
          <td class="td_no-border" width="20%" align="center">DEBIT</td>
          <td class="td_no-border" width="20%" align="center">KREDIT</td>
        </tr>
        <?php
          foreach ($detail as $d) {?>
        <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border"  align="center"> <?php echo $d->coa_id ?> </td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" > <?php echo $d->name_coa ?> </td> 
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"> <?php echo number_format((int)$d->debit) ?> </td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"> <?php echo number_format((int)$d->credit) ?> </td>  
        </tr>
        <?php } ?>
        <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="center">&nbsp</td>   
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
        </tr>
        <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="center">&nbsp</td>   
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
        </tr>
         <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="center">&nbsp</td>   
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
        </tr>
         <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="center">&nbsp</td>   
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
        </tr>
         <tr>
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="center">&nbsp</td>   
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
          <td style="border: none !important; border-right: solid 1px black !important;" class="td_no-border" align="right"></td>  
        </tr>
        <tr>
          <td colspan="2" class="td_no-border" class="td_no-border" align="center"></td>   
          <td class="td_no-border" align="right">
            <?php foreach ($totalDetail as $td) {
              echo number_format($td->total_debit);
            } ?>
          </td>  
          <td class="td_no-border" align="right">
            <?php foreach ($totalDetail as $td) {
              echo number_format($td->total_debit);
            } ?>
          </td>  
        </tr>
      </table><br>





  <table border="1" class="no_border"  width="100%" >
      
      <tr class="td_no-border" >
        <td class="td_no-border" valign="top" width="25%"  height="80px"> &nbsp&nbsp&nbsp Disiapkan: </td>
        <td class="td_no-border" valign="top" width="25%">&nbsp&nbsp&nbsp Diperiksa:</td>
        <td class="td_no-border" valign="top" width="25%" >&nbsp&nbsp&nbsp  Disetujui:</td>
        <td class="td_no-border" valign="top" width="25%" rowspan="2">&nbsp&nbsp&nbsp Diterima:<br><br><br><br><br>
        &nbsp&nbsp&nbsp Tanggal: </td>
      </tr>
  </table>
    <!-- END OF TOP -->
</body>
</html>



<style type="text/css">
  .bottom{
  padding-top: 150px;
  }
</style>