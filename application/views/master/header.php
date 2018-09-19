<!DOCTYPE html>
<?php
    $sql ="SELECT * FROM system_parameter";
     $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {?>
        <b value="<?php echo $row->company_id;?>">
<?php } } ?>  </b>
<html>
<head>
  <link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="animated_favicon1.gif">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo strtoupper( $row->name); ?></title>
<!-- MODAL -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'resource/modal.css' ?>"> 


  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/bower_components/select2/dist/css/select2.min.css">
 <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>resource/plugins/iCheck/all.css">
<!-- SAPARATOR RUPIAH -->
<!--script type="text/javascript" src="<?php echo base_url() ?>resource/my.js"></script-->
<!-- BEGIN THEME GLOBAL STYLES -->
 <link href="<?php echo base_url() ?>resource/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url() ?>resource/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- nice form -->
<link href="<?php echo base_url() ?>resource/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- nice form -->

 <!-- for nice dropdown -->
<link href="<?php echo base_url() ?>resource/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>resource/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- for nice dropdown -->


<!-- Modals -->
<link href="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- Modals -->
   

<script src="<?php echo base_url() ?>resource/global/plugins/jquery.min.js"></script>
<!--
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
 <link href="<?php echo base_url() ?>resource/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo base_url() ?>resource/global/plugins/moment.min.js" type="text/javascript"></script>

<!-- Select2 -->
<script src="<?php echo base_url() ?>resource/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url() ?>resource/plugins/iCheck/icheck.min.js"></script>


        <!-- nice dropdown -->

        

   
<!-- <script type="text/javascript" src="<?php echo base_url() ?>resource/editable.js"></script> -->



<!-- jQuery 3 -->
<!-- script src="<?php echo base_url() ?>resource/bower_components/jquery/dist/jquery.min.js"></script -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>resource/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>resource/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>resource/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>resource/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App 
<script src="<?php echo base_url() ?>resource/dist/js/adminlte.min.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script>
       

 <!-- BEGIN PAGE LEVEL PLUGINS -->
 <script src="<?php echo base_url() ?>resource/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() ?>resource/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- INPUT MASK -->
<script src="<?php echo base_url() ?>resource/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resource/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<!-- INPUT MASK -->



</head>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url().'/home/dashboard' ?>" class="navbar-brand">             
            
             <?php
                $sql ="SELECT * FROM system_parameter";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {?>
                 <b value="<?php echo $row->company_id;?>">
              <?php } } ?> <?php echo strtoupper($row->name);?>  </b>
            
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i> Master <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li> <a href="<?php echo site_url().'/master/user/view_user';?>"><i class="fa fa-dot-circle-o"></i>User</a></li>
                <li><a href="<?php echo site_url().'/master/currency/view_currency';?>"><i class="fa fa-dot-circle-o"></i>Currency</a></li>  
                <li><a href="<?php echo site_url().'/master/bank/view_bank';?>"><i class="fa fa-dot-circle-o"></i>Bank</a></li>
                <li><a href="<?php echo site_url().'/master/syspar/view_syspar';?>"><i class="fa fa-dot-circle-o"></i>System Parameter</a></li>
                <li><a href="<?php echo site_url().'/master/coa/view_coa';?>"><i class="fa fa-dot-circle-o"></i>Chart of account</a></li>
           
                <li><a href="<?php echo site_url().'/master/begbal/view_begbal';?>"><i class="fa fa-dot-circle-o"></i>Begining  balance</a></li>

              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download"></i> AR <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">

              <?php if ($this->session->userdata('AREntry') == 'y') {  ?>
                <li><a href="<?php echo site_url().'/ar/ar/view_ar';?>"><i class="fa fa-dot-circle-o"></i>Reciept Voucher Entry</a></li>
              <?php } ?>

                
                <li><a href="<?php echo site_url().'/ar/ar/ar_list';?>"><i class="fa fa-dot-circle-o"></i>Reciept Voucher List</a></li>



                <?php if ($this->session->userdata('ARPost') == 'y') {  ?>
                  <li class="divider"></li>
                  <li><a href="<?php echo site_url().'/ar/ar/posting';?>"><i class="fa fa-dot-circle-o"></i>Posting RV</a></li>
                  <li><a href="<?php echo site_url().'/ar/ar/unposting';?>"><i class="fa fa-dot-circle-o"></i>Unposting RV</a></li>
                <?php } ?>

              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-upload"></i> AP <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php if ($this->session->userdata('APEntry') == 'y') {  ?>
                  <li><a href="<?php echo site_url().'/ap/ap/view_ap';?>"><i class="fa fa-dot-circle-o"></i>Payment Voucher Entry</a></li>
                <?php } ?>

                <li><a href="<?php echo site_url().'/ap/ap/ap_list';?>"><i class="fa fa-dot-circle-o"></i>Payment Voucher List</a></li>  

                

                <?php if ($this->session->userdata('APPost') == 'y') {  ?>
                  <li class="divider"></li>
                  <li><a href="<?php echo site_url().'/ap/ap/posting';?>"><i class="fa fa-dot-circle-o"></i>Posting PV</a></li>
                  <li><a href="<?php echo site_url().'/ap/ap/unposting';?>"><i class="fa fa-dot-circle-o"></i>Unposting PV</a></li>
                <?php } ?>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file"></i> GL <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php if ($this->session->userdata('GLEntry') == 'y') {  ?>
                  <li><a href="<?php echo site_url().'/jv/jv/view_jv';?>"><i class="fa fa-dot-circle-o"></i>Journal Voucher Entry</a></li>
                <?php } ?>

                <li><a href="<?php echo site_url().'/jv/jv/jv_list';?>"><i class="fa fa-dot-circle-o"></i>Journal Voucher List</a></li>

                

                <?php if ($this->session->userdata('GLPost') == 'y') {  ?>
                <li class="divider"></li>
                  <li><a href="<?php echo site_url().'/jv/jv/posting';?>"><i class="fa fa-dot-circle-o"></i>Posting JV</a></li>
                  <li><a href="<?php echo site_url().'/jv/jv/unposting';?>"><i class="fa fa-dot-circle-o">  </i>Unposting JV</a></li>
                <?php } ?>

                <li class="divider"></li>
                <li><a href="<?php echo site_url().'/query_journal/query_journal/view_qj';?>"><i class="fa fa-dot-circle-o"></i>Query Journal</a></li>
                <li><a href="<?php echo site_url().'/query_account/query_account/qa_form';?>"><i class="fa fa-dot-circle-o"></i>Query Account</a></li>
                <li><a href="<?php echo site_url().'/trial_balance/trial_balance/tb_form';?>"><i class="fa fa-dot-circle-o"></i>Trial Balance GL</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url().'/bank_book/bank_book/bank_book_form';?>"><i class="fa fa-dot-circle-o"></i>Bank Book</a></li>
                <li><a href="<?php echo site_url().'/subs_ledger/subs_ledger/subs_ledger_form';?>"><i class="fa fa-dot-circle-o"></i>Subsidiary Ledger</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url().'/close_month/close_month/close_month_form';?>"><i class="fa fa-dot-circle-o"></i>Close Month</a></li>
                <li><a href="<?php echo site_url().'/unclose_month/unclose_month/unclose_month_form';?>"><i class="fa fa-dot-circle-o"></i>Unclose Closed Month</a></li>
                <li><a href="<?php echo site_url().'/close_year/close_year/close_year_form';?>"><i class="fa fa-dot-circle-o"></i>Close Year</a></li>


              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pie-chart"></i> Report <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php if ($this->session->userdata('reportACC') == 'y') {  ?>
                  <li><a href="<?php echo site_url().'/balance_sheet/balance_sheet/balance_sheet_form';?>"><i class="fa fa-dot-circle-o"></i>Balance Sheet</a></li>
                  <li><a href="<?php echo site_url().'/profit_loss/profit_loss/profit_loss_form';?>"><i class="fa fa-dot-circle-o"></i>Profit and Loss</a></li>
                <?php } ?>
              </ul>
            </li>

            <?php if($this->session->userdata('adminACC') == 'y' ) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> Admin <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url().'/admin/user_settings/user_settings';?>"><i class="fa fa-dot-circle-o"></i>User Settings</a></li>
              </ul>
            </li>

            <?php } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->  
        <!-- Navbar Right Menu -->    
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <!-- Menu Toggle Button -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <?php echo $this->session->userdata('username'); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo site_url('profile/profile/view_profile?id=').$this->session->userdata('user_id')?>"><i class="fa fa-user"></i> My Profile</a></li>
             
                  <li><a href="<?php echo site_url('home/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
               
                
                </ul>
              </li>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>