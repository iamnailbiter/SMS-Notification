<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
    
    <!--MENU MASTER-->
    <?php
	if($_SESSION['login_hash']=="master")
	{
	?>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> System</a>
      <ul>       
        <li><a href="?cat=master&page=user">User Management</a></li> 
        
      </ul>
    </li>
    <?php
	}elseif($_SESSION['login_hash']=="admin"){
	?>
	
    <!--MENU ADMIN-->
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Master</a>
      <ul>
        <li><a href="?cat=admin&page=client_data">Client</a></li> 
      </ul>
    </li>        
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Transaksi</a>
      <ul>     
        <li><a href="?cat=admin&page=invoice_data">Invoice</a></li>    
        <li><a href="?cat=admin&page=pembayaran_data">Pembayaran</a></li>    
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-list-alt"></span> Laporan</a>
      <ul>
        <li><a href="?cat=admin&page=laporan_invoice">Laporan Invoice</a></li>
        <li><a href="?cat=admin&page=laporan_pembayaran">Laporan Pembayaran</a></li>

      </ul>
    </li>

     <!--MENU ADMIN-->
        <?php
	}elseif($_SESSION['login_hash']=="tsupport"){
	?>    
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span>Tugas</a>
      <ul>       
        <li><a href="?cat=tsupport&page=laporan_tugas">Tugas</a></li> 
        
      </ul>
    </li>
  	<?php
	}
	?>
  </ul>


</div>
<!--leftmenu-->

</div>
<!--mainleft--> 
<!-- END OF LEFT PANEL -->