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
$result= mysql_query("SELECT * FROM client");
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
    <th colspan="3">MANAJEMEN DATA CLIENT </th>
  </tr>
</table>

<a href="?cat=admin&page=client_add" target="_self"><img src="images/btn_add_data.png"  /></a>
<hr>

      <table id="example" class="table-list" width="100%" >
          <thead>
            <tr>
                <th>No</th>
                <th align="center">Kode</th>
                <th align="center">Nama Client</th>
                <th align="center">Email</th>
                <th align="center">Alamat</th>
                <th align="center">Kota</th>
                <th align="center">No.Telp</th>
                <th align="center">Abonemen</th>
                <td></td>
                <td></td>
            </tr>
          </thead>
          <tbody class="oetable">
              <?php $nomor=0;while ($row= mysql_fetch_array($result)) {    
                $nomor++;   
                $Kode = $row['kd_client'];?>
                <tr>
                    <td width="10px"><?php echo $nomor; ?></td>
                    <td width="100px"><?php echo $row['kd_client']; ?></td>
                    <td><?php echo $row['nm_client']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['kota']; ?></td>
                    <td><?php echo $row['no_telepon']; ?></td>
                    <td><?php echo $row['abonemen']; ?></td>
                    <td width="30px" align="center"><a href="?cat=admin&page=client_edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><span class="icon-edit"></span></a></td>
                    <td width="10px" align="center"><a href="?cat=admin&page=client_delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')"><span class="icon-remove"></span></a></td>
              
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