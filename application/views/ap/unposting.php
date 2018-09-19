  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           <small>Account</small><small>Payable (AP)</small>
        </h1>
      </section>


      <section class="content">
       
        <div class="box box-success">
          <div class="box-header with-border" align="center">
            <h3 class="box-title"><i class="fa fa-tag" ></i> Unposting Payment Voucher</h3>
          </div><br>

          <div align="center">
            <label class="mt-checkbox">CHECK ALL                     
              <input type="checkbox" value="1" name="test" onchange="checkAll(this)" name="chk[]" />
              <span></span><br>
            </label><br>
            <button id="mass_posting"  class="btn green-meadow btn-sm"><i class="fa fa-bookmark-o"></i> UNPOST ALL CHECKED</button>
          </div>


          <div class="box-body">
            <div class="page-content-inner">
              <table id="example" class="table table-striped table-bordered" cellspacing="0">
                      <thead bgcolor="#E7505A">
                        
                        <tr>
                           <th  class="text-center" width="10px" ></th>
                          <th class="text-center" width="100px">NO. VOUCHER</th>
                          <th width="50px">DATE</th>
                          <th>DESCRIPTION</th>
                          <th class="text-center" width="100px" >TOTAL</th>
                          <th class="text-center" width="80px" >GL. DATE</th>
                          <th class="text-center" width="100px" >POSTED NO.</th>
                          <th class="text-center" width="50px" >STATUS</th>
                          <th class="text-center" width="80px" >ACTION</th>
                      </tr>
                        
                      </thead>
                      <tbody>

                        <?php 
                          
                          foreach ($unpostlist as $p) {
                            ?>                        
                        <tr>
                          <td align="center">
                            <?php
                              if ($p->Fclose == 'close') {
                                echo '<i class="fa fa-times" aria-hidden="true" title="Confirmation Nedded"></i>';
                              } else {
                                echo '  
                                    <input type="checkbox" gl-no = "'.$p->gl_no.'" class="chk" value="'.$p->no_voucher.'" name = "nov[]" />
                                    <span></span>
                                ';
                              }
                              
                            ?>
                          </td>
                          <td class="text-center"><?php echo $p->no_voucher ?></td>
                          <td class="text-center"><?php echo $p->date ?></td>
                          <td><?php echo $p->description ?></td>
                          <td align="right"><?php echo number_format($p->total) ?></td>
                          <td class="text-center"><?php echo $p->gl_date ?></td>
                          <td class="text-center"> <?php echo $p->gl_no ?> </td>
                          <?php
                            //for labeling
                            if ($p->status == "unposted" )  {
                              $label = "label label-danger";
                            } else{
                              $label = "label label-info";
                            }
                          ?>
                          <td align="center" ><span class="<?php echo $label ?>"> <?php echo strtoupper($p->status) ?></span> </td>
                          <?php
                            $nv = $p->no_voucher;
                            if ($p->Fclose == "close" ) {
                              echo '
                              <td align="center"> 
                                <span title="Have been close month" class="label label-danger">CLOSED !</span>
                              </td>                            
                              ';
                              } else if ($p->status == "unposted") {
                                 echo '<td></td>';
                                } else {
                                 echo '
                                 <td align="center" class="text-center">  
                                    <a href="#'.$nv.'"> <button align="center" class="btn red blue-soft-stripe pull-right btn-xs "> <i class="fa fa-bookmark-o"></i> Uposting</button></a>
                                  </td>';
                                }
                            
                          ?>
                          
                        </tr>
                        
<!--MODAL CONFIRMATION-->
<div id="<?php echo $p->no_voucher ?>" class="modalDialog">
  <div>
    <a href="#close" title="Close" ><i class=" pull-right fa fa-remove"></i></a>
    <h2 align="center"><i class="fa fa-warning"></i></h2>
      <div class="modal-body">
       Are you sure to <b>UNPOSTING</b> this data?

      </div>
      <div class="modal-footer">
          <a href="<?php echo site_url('/ap/ap/save_unposting?id=').$p->no_voucher.'&gl='.$p->gl_no ?>"  >
           <button type="button" class="btn btn-success"><i class="fa fa-check"></i> OK</button>
          </a>

          <a href="#close" title="Close" > 
            <button type="button" data-dismiss="modal" form="form1" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</button>
          </a>
      <div>
          </form>
  </div>
</div>
<!--/MODAL CONFIRMATION-->



                       <?php } ?>


                      </tbody>
                        
                    </table>    
            </div>
          </div>

        </div>
      </section>

    </div>

  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );

function checkAll(ele) {
 var checkboxes = document.getElementsByTagName('input');
 if (ele.checked) {
     for (var i = 0; i < checkboxes.length; i++) {
         if (checkboxes[i].type == 'checkbox') {
             checkboxes[i].checked = true;
         }
     }
 } else {
     for (var i = 0; i < checkboxes.length; i++) {
         console.log(i)
         if (checkboxes[i].type == 'checkbox') {
             checkboxes[i].checked = false;
         }
     }
 }
}


$(document).ready(function(){
  $('#mass_posting').click(function(){
    getCheckedValue();
  });
});

function getCheckedValue(){
  var check = [];
  var gln = [];

  $('.chk:checked').each(function(){
    gln.push($(this).attr("gl-no"));
    check.push($(this).val());
  });
  
  if (check.length <= 1) {
    alert('Ups!, Select more than One Voucher')
  } else {

    // to mass unpositng
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url();?>/ap/ap/mass_unposting',
      data : {
        check : check,
        gln: gln
      },
      success: function (msg) {
          console.log(msg);
          location.reload();
          toastr.success('All selected Voucher Posted !');
      }
    })

  }
}
</script>

