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
//  $txtEmail= $_POST['txtEmail'];
  $txtTanggal  = $_POST['txtTanggal'];
  $txtJmlByr= $_POST['txtJmlByr'];
  $txtBankTo= $_POST['txtBankTo'];
  $txtBankFrom=$_POST['txtBankFrom'];
  $txtNamaRek=$_POST['txtNamaRek'];
  $txtNoRek=$_POST['txtNoRek'];
  $txtPesan=$_POST['txtPesan'];
  $txtBukti=$_POST['txtBukti']; 
  # Validasi form, jika kosong sampaikan pesan error
  $pesanError = array();
  if (trim($txtClient)=="") {
    $pesanError[] = "Data <b>Nama Client</b> tidak boleh kosong !";   
  }
//  if (trim($txtEmail)=="") {
//    $pesanError[] = "Data <b>Email</b> tidak boleh kosong !";    
//  }
  if (trim($txtTanggal)=="") {
    $pesanError[] = "Data <b>Tanggal</b> tidak boleh kosong !";    
  }
  if (trim($txtJmlByr)=="") {
    $pesanError[] = "Data <b>Jumlah Bayar</b> tidak boleh kosong !";    
  }
  if (trim($txtBankTo)=="") {
    $pesanError[] = "Data <b>Bank Tujuan</b> tidak boleh kosong !";    
  }
  if (trim($txtBankFrom)=="") {
    $pesanError[] = "Data <b>Bank Pengirim</b> tidak boleh kosong !";    
  }
  if (trim($txtNamaRek)=="") {
    $pesanError[] = "Data <b>Nama Rekening Pengirim</b> tidak boleh kosong !";    
  }
  if (trim($txtNoRek)=="") {
    $pesanError[] = "Data <b>Nomor Rekening Pengirim</b> tidak boleh kosong !";    
  }
  if (trim($txtPesan)=="") {
    $pesanError[] = "Data <b>Pesan</b> tidak boleh kosong !";    
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
    $kodeBaru   = buatKode("pembayaran", "P");
    $kodeInvoice = $_POST['txtKodeInvoice'];
    $kodeClient = $_POST['txtKodeClient'];
//    $txtEmail   = $_POST['txtEmail'];
    $txtTanggal  = $_POST['txtTanggal'];
    $txtJmlByr= $_POST['txtJmlByr'];
    $txtBankTo= $_POST['txtBankTo'];
    $txtBankFrom= $_POST['txtBankFrom'];
    $txtNamaRek= $_POST['txtNamaRek'];
    $txtNoRek= $_POST['txtNoRek'];
    $txtPesan= $_POST['txtPesan'];
    $txtBukti= $_POST['txtBukti'];
    $mySql  = "INSERT INTO pembayaran (kd_pembayaran, kd_invoice, kd_client, tgl_bayar, jml_bayar, bank_to, bank_from, nama_rek, no_rek, pesan, bukti) 
          VALUES ('$kodeBaru',
              '$kodeInvoice',
              '$kodeClient',
              '".InggrisTgl($txtTanggal)."',
              '$txtJmlByr',
              '$txtBankTo',
              '$txtBankFrom',
              '$txtNamaRek',
              '$txtNoRek',
              '$txtPesan',
              '$txtBukti')";
    $myQry  = mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?cat=admin&page=laporan_pembayaran'>";
    }
    exit;
  } 
} // Penutup POST

# TAMPILKAN DATA DARI DATABASE
$dataKodeBaru = buatKode("pembayaran", "P");
$Kode = $_GET['Kode']; 
$mySql  = "SELECT client.*, invoice.* FROM invoice 
      LEFT JOIN client ON invoice.kd_client = client.kd_client WHERE kd_invoice='$Kode'";
$myQry  = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA KE VARIABEL FORM
$dataKodeClient = $myData['kd_client'];
$dataInvoice = isset($_POST['txtInvoice']) ? $_POST['txtInvoice'] : $myData['kd_invoice'];
$dataNama = isset($_POST['txtClient']) ? $_POST['txtClient'] : $myData['nm_client'];
$dataTanggal  = isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataJmlByr= isset($_POST['txtJmlByr']) ? $_POST['txtJmlByr'] : '';
$dataBankTo= isset($_POST['txtBankTo']) ? $_POST['txtBankTo'] : '';
$dataBankFrom= isset($_POST['txtBankFrom']) ? $_POST['txtBankFrom'] : '';
$dataNamaRek= isset($_POST['txtNamaRek']) ? $_POST['txtNamaRek'] : '';
$dataNoRek= isset($_POST['txtNoRek']) ? $_POST['txtNoRek'] : '';
$dataPesan= isset($_POST['txtPesan']) ? $_POST['txtPesan'] : '';
$dataBukti= isset($_POST['txtBukti']) ? $_POST['txtBukti'] : '';


?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
  <tr>
    <th colspan="3">INPUT PEMBAYARAN</th>
  </tr>
  <tr>
    <td width="20%"><b>Kode Pembayaran</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="textfield" value="<?php echo $dataKodeBaru; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKodeBaru" type="hidden" value="<?php echo $dataKodeBaru; ?>" /></td></tr>
  <tr>
  <tr>
    <td width="20%"><b>Kode Client</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="textfield" value="<?php echo $dataKodeClient; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKodeClient" type="hidden" value="<?php echo $dataKodeClient; ?>" /></td></tr>
  <tr>
  <tr>
    <td width="20%"><b>Kode Invoice</b></td>
    <td width="1%"><b>:</b></td>
    <td width="79%"><input name="textfield" value="<?php echo $dataInvoice; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKodeInvoice" type="hidden" value="<?php echo $dataInvoice; ?>" /></td></tr>
  <tr>
  <tr>
    <td><b>Nama Client </b></td>
    <td><b>:</b></td>
    <td><input name="txtClient" value="<?php echo $dataNama; ?>" size="80" maxlength="100" readonly="readonly"/></td></tr>
  <tr>
  <tr>
    <td><b>Tanggal </b></td>
    <td><b>:</b></td>
    <td><input name="txtTanggal" value="<?php echo $dataTanggal; ?>" size="80" maxlength="100"/></td></tr>
  <tr>
    <tr>
    <td><b>Jumlah Bayar </b></td>
    <td><b>:</b></td>
    <td><input name="txtJmlByr" value="<?php echo $dataJmlByr; ?>" size="80" maxlength="12" type="Number"/></td></tr>
  <tr>
    <tr>
    <td><b>Bank Tujuan </b></td>
    <td><b>:</b></td>
    <td><select name="txtBankTo">
                                          <option value="">Pilih Tujuan Bank Anda</option>
                                          <option value="BCA">Bank BCA - No.Rek xxxxxxxx</option>
                                          <option value="MANDIRI">Bank Mandiri - No.Rek xxxxxxxx</option>
                                          <option value="CIMB">Bank CIMB Niaga - No.Rek xxxxxxxx</option>
                                          <option value="BNI">Bank BNI - No.Rek xxxxxxxxx</option>
                                        </select></td></tr>
  <tr>
    <tr>
    <td><b>Bank Pengirim </b></td>
    <td><b>:</b></td>
    <td><select name="txtBankFrom" >
                                        <option value="">Pilih Transaksi Bank Anda</option>
                                            <option value="BCA">BCA - ATM</option>
                                            <option value="BCA Internet Banking">BCA - Internet Banking Klikbca.com</option>
                                            <option value="BCA Transfer">BCA - Transfer antar Bank BCA/Setor Tunai</option>
                                            <option value="CIMB">CIMB Niaga - ATM</option>
                                            <option value="CIMB Internet Banking">CIMB Niaga - Internet Banking</option>
                                            <option value="CIMB Niaga Transfer">CIMB Niaga - Transfer antar CIMB Niaga/Setor Tunai</option>
                                            <option value="MANDIRI">Mandiri - ATM</option>
                                            <option value="MANDIRI Internet Banking">Mandiri - Internet Banking</option>
                                            <option value="MANDIRI Transfer">Mandiri - Transfer antar Bank Mandiri/Setor Tunai</option>
                                            <option value="BNI">BNI - ATM</option>
                                            <option value="BNI Internet Banking">BNI - Internet Banking</option>
                                            <option value="BNI Transfer">BNI - Transfer antar Bank BNI/Setor Tunai</option>
                                        </select></td></tr>
  <tr>
    <tr>
    <td><b>Nama Rekening Pengirim </b></td>
    <td><b>:</b></td>
    <td><input name="txtNamaRek" value="<?php echo $dataNamaRek; ?>" size="80" maxlength="200"/></td></tr>
  <tr>
    <tr>
    <td><b>Nomor Rekening </b></td>
    <td><b>:</b></td>
    <td><input name="txtNoRek" value="<?php echo $dataNoRek; ?>" size="80" maxlength="15"/></td></tr>
  <tr>
    <tr>
    <td><b>Pesan </b></td>
    <td><b>:</b></td>
    <td><textarea name="txtPesan" style="width: 300px;" name="txtPesan" value="<?php echo $dataPesan; ?>"  rows="5" maxlength="500"/></textarea></td></tr>
  <tr>
  <tr>
    <td><b>Bukti </b></td>
    <td><b>:</b></td>
    <td><input name="txtBukti" value="<?php echo $dataBukti; ?>" size="80" maxlength="100"/></td></tr>
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