  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Master
          <small></small>
        </h1>
      </section>


      <section class="content">
       
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-edit" ></i> Edit COA</h3>
          </div>
          <div class="box-body">
              <div class="page-content-inner">
                  <div class="page-content-inner">
                        <div class="portlet light ">
                          <div class="portlet-body">
                            <ul class="nav nav-tabs">
                              <li class="active">
                                <a href="#tab_1_1" data-toggle="tab"> COA </a>
                              </li>
                             
                                                            
                            </ul>
                            <div class="tab-content">

<!--====================================PAGE GROUP====================================-->
                              <div class="tab-pane fade active in" id="tab_1_1"><br>
                                  <?php foreach ($editCoa as $ec) { ?>  
   <form role="form" method="POST" action="<?php echo site_url().'/master/coa/save_edit_coa' ?>">
                                          <div class="form-body">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="form_control_1">Subroup</label>
                                                  <div class="input-icon">
                                                  <select class="form-control select2" name ="subgroup">
                                                  <option value="" selected >Select Subgroup Account </option>
                                                  <?php
                                                    foreach ($getSubgroup->result_array() as $data){
                                                      echo "<option value=". $data["subgroup_id"]." >"
                                                            .$data["subgroup_id"]. "-" .$data["name_sg"]. 
                                                          "</option>";
                                                    }
                                                  ?>
                                                </select>
                                                  </div>
                                                </div>
                                              </div>
                                           
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>COA ID</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-key font-green"></i>
                                                    <input type="text" name="coa_id" class="form-control" value="<?php echo $ec->coa_id ?>">
                                                  </div>
                                                </div>
                                              </div>  
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Description</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-align-right font-green"></i>
                                                    <input type="text" name="name_coa" class="form-control" value="<?php echo $ec->name_coa ?>">
                                                  </div>
                                                </div>
                                              </div> 

                                            </div>

                                            <div class="row">
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Date</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-calendar-plus-o font-green"></i>
                                                    <input type="date" name="date" class="form-control" value="<?php echo $ec->date ?>">
                                                  </div>
                                                </div>
                                              </div>  
                                           
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Debit Balance</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-dollar font-green"></i>
                                                     <input type="text" name="debit" id="total" pattern="[0-9]*" class="form-control input text-right" value="<?php echo $ec->debit ?>"> 
                                                  </div>
                                                </div>
                                              </div>  

                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>Credit Balance</label>
                                                  <div class="input-icon">
                                                    <i class="fa fa-dollar font-green"></i>
                                                     <input type="text" name="credit" id="total" pattern="[0-9]*" class="form-control input text-right" value="<?php echo $ec->credit ?>"> 
                                                  </div>
                                                </div>
                                              </div>  
                                            </div>
                      <div class="row">
                        <div class="col-md-4">                        
                        <label class="checkbox-inline"><input type="checkbox" name="header" value="header">Header</label>  |
                        <label class="checkbox-inline"><input type="checkbox" name="active" value="active" checked="">Active</label>
                        </div>
                      </div> 
                                       <br>     
                                            <button type="submit" class="btn green"><i class="fa fa-plus-square"> </i> Submit </button>
                                            <button type="button " class="btn red" VALUE="Back" onClick="history.go(-1);return true;"><i class="fa fa-chevron-circle-left" ></i> Cancel</button>                                 
                                         <hr>
                                      </form> 
                                  <?php } ?>
                              </div>

<!--==================================== END PAGE GROUP====================================-->
                                <br>                          
                                <br>                          
                                <br>                          
                                <br>                          
                                <br>                                           
                            </div>
                            <div class="clearfix margin-bottom-20"> </div>                        
                          </div>
                        </div>                      
                </div>
          </div>
        </div>
      </section>
    </div>
  </div>
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );
   //for input type number
 document.getElementById("total").onblur =function (){    
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed()
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    document.getElementById("display").value = this.value.replace(/,/g, "")
    
}
</script>