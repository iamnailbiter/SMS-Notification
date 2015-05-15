<?php
session_start();
if(!isset($_SESSION['login_hash']))
{
	echo "<script>window.location='index.php'</script>";
}
include("library/inc.connection.php");

## Tambahan IRWAN ##
require_once 'Class/Gammu.php';
require_once 'Class/Client.php';
require_once 'Class/Database.php';
require_once 'Class/TableGateway.php';
require_once 'Class/ClientTable.php';
### Tambahan END ###
?>

<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PT Data Utama Dinamika</title>
	<?php include("_scr.php"); ?>
</head>




<body>


<div class="mainwrapper fullwrapper">

	
    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">
    	
        <div class="logopanel">
        	<img src="images/logoDU.png" width="90%" height="90%">
        </div><!--logopanel-->
        
        <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div>
    	
        <?php include("_main-nav.php"); ?> <!--NAVIGASI MENU UTAMA-->
    
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
    	<div class="headerpanel">
        	<a href="" class="showmenu"></a>
            <div class="headerright">
            	<span  style="color:#5E5E5E">
                <?php 
				echo "Anda login sebagai:  <b><font color=#000 size=2>" .$_SESSION['login_user']. "</font>";
				?>
                </span>
                <?php
				include("_userinfo.php"); 
				?>
            </div><!--headerright-->
    	</div><!--headerpanel-->
        
        <div class="breadcrumbwidget">
        	<ul class="breadcrumb">
                <li></li>
            </ul>
        </div> 
        <!--breadcrumbwidget-->
  <!--    
		<div class="pagetitle">
        	<h3>Sistem Informasi Stok Barang PT Data Utama Dinamika</h3> 
       	  <span>This is a sample description for dashboard page...</span>
        </div>
        pagetitle-->
        
      <div class="maincontent">
       	<div class="contentinner content-dashboard">
            	<!--<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Welcome!</strong> This alert needs your attention, but it's not super important.
                </div>--><!--alert-->
                
                <div class="row-fluid"><!--span8-->
                <?php
				$v_cat = (isset($_REQUEST['cat'])&& $_REQUEST['cat'] !=NULL)?$_REQUEST['cat']:'';
				$v_page = (isset($_REQUEST['page'])&& $_REQUEST['page'] !=NULL)?$_REQUEST['page']:'';
				if(file_exists("pages/".$v_cat."/".$v_page.".php"))
				{
					include("pages/".$v_cat."/".$v_page.".php");
				}else{
					include("pages/web/homepage.php");
				}
				
				
				?>
                
                <!--span4-->
              </div>
                <!--row-fluid-->
          </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    

    
</div><!--mainwrapper-->
	<!--SLIDE NAVIGASI-->
    <?php include("_nav-slider.php"); ?>

</body>

</html>
