<?php
ob_start();
?>

<?php
include("../../_db.php");

	$result=mysql_query("SELECT data_barang.kode_barang, data_barang.nama_barang, data_barang.jenis_barang, data_persediaan.stok_tersedia
FROM data_barang LEFT JOIN data_persediaan ON data_barang.kode_barang = data_persediaan.kode_barang GROUP BY data_barang.kode_barang" ) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());;
$filename="Export-stok-".date("Y-m-d");
$file_ending = "xls";
 
//header info for browser
header("Content-Type: application/ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
 
/*******Start of Formatting for Excel*******/
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
 
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");
//end of printing column names
 
//start while loop to get data
    while($row = mysql_fetch_array($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
		
        $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
		
    }
	
?>
<?php
ob_end_flush();
?>

