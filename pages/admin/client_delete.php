    <?php
  if($_SESSION['login_hash']=="admin")
  {
  ?>

<?php
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Membaca data dari URL
$Kode	= $_GET['Kode'];
if(isset($Kode)){
	// Skrip menghapus data dari tabel database
	$mySql = "DELETE FROM client WHERE kd_client='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Error query".mysql_error());
	
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?cat=admin&page=client_data'>";
}
else {
	echo "Data yang dihapus tidak ada";
}

?>


  <?php
        }else{
          include("pages/web/homepage.php");}
  ?>    