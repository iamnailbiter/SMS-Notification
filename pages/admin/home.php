<?php
  if($_SESSION['login_hash']=="admin")
  {
?>


<div class="row-fluid">
<ul class="thumbnails">
<li class="span3">
<div class="thumbnail">
                  
                  <div class="caption">
                    <h3>Data Client</h3>
                    <p>Manajemen Data Client</p>
                    <p><a href="?cat=admin&page=client_data" class="btn btn-primary">Masuk</a> </p>
                  </div>
                </div>
</li>

<li class="span3">
<div class="thumbnail">
                  
                  <div class="caption">
                    <h3>Invoice</h3>
                    <p>Invoice Pelanggan</p>
                    <p><a href="?cat=admin&page=invoice_data" class="btn btn-primary">Masuk</a> </p>
                  </div>
                </div>
</li>

<li class="span3">
<div class="thumbnail">
                  
                  <div class="caption">
                    <h3>Pembayaran</h3>
                    <p>Input Pembayaran</p>
                    <p><a href="?cat=admin&page=pembayaran_data" class="btn btn-primary">Masuk</a> </p>
                  </div>
                </div>
</li>


</ul>
</div>

<?php
    }else{
     include("pages/web/homepage.php");}
?>    