    <?php
  if($_SESSION['login_hash']=="admin")
  {
  ?>

<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />


<?php
//include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtClient= $_POST['txtClient'];
        $txtEmail= $_POST['txtEmail'];
	$txtAlamat	= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	$txtKota	= $_POST['txtKota'];
        $txtAbonemen	= $_POST['txtAbonemen'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtClient)=="") {
		$pesanError[] = "Data <b>Nama Client</b> tidak boleh kosong !";		
	}
        if (trim($txtEmail)=="") {
		$pesanError[] = "Data <b>Email</b> tidak boleh kosong !";		
	}
	if (trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat Lengkap</b> tidak boleh kosong !";		
	}
	if (trim($txtTelepon)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";		
	}
	if (trim($txtKota)=="") {
		$pesanError[] = "Data <b>Kota</b> tidak boleh kosong !";		
	}
        if (trim($txtAbonemen)=="") {
		$pesanError[] = "Data <b>Abonemen</b> tidak boleh kosong !";		
	}
		
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "
				<div class='alert alert-danger' role='alert'><span class='icon-exclamation-sign' aria-hidden='true'></span>
				<span class='sr-only'>Error:</span><br>
				&nbsp;&nbsp; $noPesan. $pesan_tampil</div>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE client SET nm_client='$txtClient',email='$txtEmail', alamat='$txtAlamat',
					no_telepon='$txtTelepon', kota='$txtKota', abonemen='$txtAbonemen' WHERE kd_client ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?cat=admin&page=client_data'>";
		}
		exit;
	}	
} // Penutup POST

# TAMPILKAN DATA DARI DATABASE
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM client WHERE kd_client='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	# MASUKKAN DATA KE VARIABEL FORM
	$dataKode	= $myData['kd_client'];
	$dataNama	= isset($_POST['txtClient']) ? $_POST['txtClient'] : $myData['nm_client'];
        $dataEmail	= isset($_POST['txtEmail']) ? $_POST['txtEmail'] : $myData['email'];
	$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataKota 	= isset($_POST['txtKota']) ? $_POST['txtKota'] : $myData['kota'];
	$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : $myData['no_telepon'];
        $dataAbonemen= isset($_POST['txtAbonemen']) ? $_POST['txtAbonemen'] : $myData['abonemen'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">UBAH DATA CLIENT </th>
	</tr>
	<tr>
	  <td width="20%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="79%"><input name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Client </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtClient" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td></tr>
	<tr>
            <tr>
	  <td><b>Email </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtEmail" type="text" value="<?php echo $dataEmail; ?>" size="80" maxlength="100" /></td></tr>
	<tr>
      <td><b>Alamat Lengkap </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtAlamat" value="<?php echo $dataAlamat; ?>" size="80" maxlength="200" /></td>
    </tr>
 	<tr>
      <td><b>Kota </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtKota" value="<?php echo $dataKota; ?>" size="80" maxlength="200" /></td>
    </tr>    
	<tr>
      <td><b>No Telepon </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
    	<tr>
      <td><b>Abonemen </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtAbonemen" value="<?php echo $dataAbonemen; ?>" size="20" maxlength="20" /></td>
    </tr>

	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input class="button" type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

  <?php
        }else{
          include("pages/web/homepage.php");}
  ?>    