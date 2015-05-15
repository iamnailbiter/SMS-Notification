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
$result= mysql_query("SELECT client.*, invoice.* FROM invoice 
      LEFT JOIN client ON invoice.kd_client = client.kd_client WHERE invoice.status < 2
       ORDER BY kd_invoice DESC");
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
    <th colspan="3">INPUT PEMBAYARAN</th>
  </tr>
</table>


      <table id="example" class="table-list" width="100%" >
          <thead>
            <tr>
                <th>No</th>
                <th align="center">Kd Invoice</th> 
                <th align="center">Kd Client</th>
                <th align="center">Nama Client</th>
                <th align="center">Nominal</th>
                <th align="center">Status</th>
                <td></td>
            </tr>
          </thead>
          <tbody class="oetable">
              <?php $nomor=0; while ($row= mysql_fetch_array($result)) {    
                $nomor++;
                $KodeInvoice = $row['kd_invoice'];   
                $Kode = $row['kd_invoice'];
                switch ($row['status']) {
                    case 0:
                        $status='Menunggu';

                        break;
                    case 1:
                        $status='SMS Confirm';
                        break;

                    case 2:
                        $status='Terbayar';
                        break;
                }

                ?>
                <tr>
                    <td width="10px"><?php echo $nomor; ?></td>
                    <td width="100px"><?php echo $row['kd_invoice']; ?></td>
                    <td width="100px"><?php echo $row['kd_client']; ?></td>
                    <td width="100px"><?php echo $row['nm_client']; ?></td>
                    <td width="100px" align="right"><?php echo $row['nominal']; ?></td>
                    <td width="50px"><?php echo $status; ?></td>
                    <td width="30px" align="center"><a href="?cat=admin&page=pembayaran_add&Kode=<?php echo $Kode; ?>" target="_self" alt="Pembayaran"><span class="icon-ok"></span></a></td>             

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