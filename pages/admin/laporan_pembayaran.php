    <?php
  if($_SESSION['login_hash']=="admin")
  {
  ?>

<?php
//  1. Add your php database connection/file here.
//
//  2. Call your function to retreive your data and store it as a variable called $result (this is what we use in this example, you can name it whatever you like).
//
//      ex: $result = fetch_books_array();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
$result= mysql_query("SELECT invoice.*, pembayaran.* FROM pembayaran 
      LEFT JOIN invoice ON invoice.kd_invoice = pembayaran.kd_Invoice
       ORDER BY kd_pembayaran DESC");
?>

<html lang="en">
<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="DataTables/media/css/jquery.dataTables.css" media="screen" />


        <!-- styles -->
  
        <script src="DataTables/media/js/jquery.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="DataTables/media/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
       oTable = $('#example').dataTable({
         "sPaginationType": "full_numbers"
       });
  } );
</script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

<body>
<table class="table-list" width="100%">
  <tr>
    <th colspan="3">LAPORAN PEMBAYARAN</th>
  </tr>
</table>


      <table id="example" class="table-list" width="100%">
          <thead>
            <tr>
                <th width="10px"><font size='1'>No</font></th>
                <th align="center"><font size='1'>Kd. Pembayaran</font></th>
                <th align="center"><font size='1'>Kd. Invoice</font></th> 
                <th align="center"><font size='1'>Kd. Client</font></th>
                <th align="center"><font size='1'>Nominal</font></th>
                <th align="center"><font size='1'>Tgl Bayar</font></th>
                <th align="center"><font size='1'>Jml Bayar</font></th>
                <th align="center"><font size='1'>Bank Tujuan</font></th>
                <th align="center"><font size='1'>Bank Pengirim</font></th>
                <th align="center"><font size='1'>Nama Rek</font></th>
                <th align="center"><font size='1'>No Rek</font></th>
                <th align="center"><font size='1'>Pesan</font></th>
                <th align="center"><font size='1'>Bukti</font></th>



            </tr>
          </thead>
          <tbody class="oetable">
              <?php $nomor=0;while ($row= mysql_fetch_array($result)) {    
                $nomor++;
                ?>
                <tr>
                    <td width="5px"><?php echo $nomor; ?></td>
                    <td width="10px"><?php echo $row['kd_pembayaran']; ?></td>
                    <td width="10px"><?php echo $row['kd_invoice']; ?></td>
                    <td width="10px"><?php echo $row['kd_client']; ?></td>
                    <td width="50px" align="right"><?php echo $row['nominal']; ?></td>  
                    <td><?php echo IndonesiaTgl($row['tgl_bayar']); ?></td>
                    <td><?php echo $row['jml_bayar']; ?></td>
                    <td><?php echo $row['bank_to']; ?></td>
                    <td><?php echo $row['bank_from']; ?></td>
                    <td><?php echo $row['nama_rek']; ?></td>
                    <td><?php echo $row['no_rek']; ?></td>
                    <td><?php echo $row['pesan']; ?></td>
                    <td><?php echo $row['bukti']; ?></td>


                </tr>
                  
              <?php } ?>   
          </tbody>
        </table>




</body>
</html>


  <?php
        }else{
          include("pages/web/homepage.php");}
  ?>    