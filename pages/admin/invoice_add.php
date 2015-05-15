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
  $txtNominal  = $_POST['txtNominal'];
  
  # Validasi form, jika kosong sampaikan pesan error
  $pesanError = array();
  if (trim($txtClient)=="") {
    $pesanError[] = "Data <b>Nama Client</b> tidak boleh kosong !";   
  }

  if (trim($txtNominal)=="") {
    $pesanError[] = "Data <b>Nominal</b> tidak boleh kosong !";    
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
    # SIMPAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
    $kodeBaru = buatKode("invoice", "I");
    $Kode = $_POST['txtKode'];
    $txtNominal = $_POST['txtNominal'];
    $mySql  = "INSERT INTO invoice (kd_invoice, kd_client, nominal) 
          VALUES ('$kodeBaru',
              '$Kode',
              '$txtNominal')";
    $myQry  = mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
    if($myQry){
    ## Tambahan IRWAN ##
        $smsd = new Gammu();
        $client = new Client();
        $smsd->sendInvoice($kodeBaru, $client->getClientPhone($Kode));
    ### Tambahan END ###
      echo "<meta http-equiv='refresh' content='0; url=?cat=admin&page=invoice_data'>";
    }
    exit;
  } 
} // Penutup POST

# TAMPILKAN DATA DARI DATABASE
$dataKodeBaru = buatKode("invoice", "I");
$Kode = $_GET['Kode']; 
$mySql  = "SELECT * FROM client WHERE kd_client='$Kode'";
$myQry  = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

  # MASUKKAN DATA KE VARIABEL FORM
  $dataKode = $myData['kd_client'];
  $dataNama = isset($_POST['txtClient']) ? $_POST['txtClient'] : $myData['nm_client'];
  $dataNominal= isset($_POST['txtNominal']) ? $_POST['txtNominal'] : $myData['abonemen'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
  <tr>
    <th colspan="3">Tambah Invoice </th>
  </tr>
  <tr>
    <td width="20%"><b>Kode Transaksi</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="textfield" value="<?php echo $dataKodeBaru; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKodeBaru" type="hidden" value="<?php echo $dataKodeBaru; ?>" /></td></tr>
  <tr>
  <tr>
    <td width="20%"><b>Kode Client</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
  <tr>
    <td><b>Nama Client </b></td>
    <td><b>:</b></td>
    <td><input name="txtClient" value="<?php echo $dataNama; ?>" size="80" maxlength="100" readonly="readonly"/></td></tr>
  <tr>
  <tr>
    <td><b>Nominal </b></td>
    <td><b>:</b></td>
    <td><input name="txtNominal" value="<?php echo $dataNominal; ?>" size="80" maxlength="100"/></td></tr>
  <tr>
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