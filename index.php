<?php 
date_default_timezone_set('Asia/karachi');
date_default_timezone_set('Asia/karachi');
$ServerName="server";
//$ServerName="ITS-4\SQL2014";
$ConnectionInfo=array('Database'=>'MIS', "UID"=>"ajax", "PWD"=>"Forward@123");
//$ConnectionInfo2=array('Database'=>'ERPFG', "UID"=>"sa", "PWD"=>"Forward@123");
$conn=sqlsrv_connect($ServerName,$ConnectionInfo);
if ($conn==true){
	// Echo "Established ";
	// die;
}else{
	Echo "Connection is Disable";
	die( print_r( sqlsrv_errors(), true));
}
// $Query="SELECT        dbo.tbl_DMMS_Dept_Machine.DMID, dbo.tbl_DMMS_Dept.DeptName + '-' + dbo.tbl_DMMS_Sections.SecName + '-' + dbo.tbl_DMMS_Dept_Machine.Name AS Name
// FROM            dbo.tbl_DMMS_Dept_Machine INNER JOIN
//                          dbo.tbl_DMMS_Dept ON dbo.tbl_DMMS_Dept_Machine.DeptID = dbo.tbl_DMMS_Dept.DeptID INNER JOIN
//                          dbo.tbl_DMMS_Sections ON dbo.tbl_DMMS_Dept_Machine.SectionID = dbo.tbl_DMMS_Sections.SecID";

// //print_r($Query);die;

//  $Doo = sqlsrv_query($conn,$Query);
// print_r($Doo);
// die;
// While($Data=sqlsrv_fetch_Array($Doo)){
//  Echo    $machineName=$Data['Name'];

// }


  
 $Query="SELECT        dbo.tbl_DMMS_Dept_Machine.DMID, dbo.tbl_DMMS_Dept.DeptName + '-' + dbo.tbl_DMMS_Sections.SecName + '-' + dbo.tbl_DMMS_Dept_Machine.Name AS Name, dbo.tbl_DMMS_Dept.DeptID, 
                         dbo.tbl_DMMS_Dept_Machine.Status
FROM            dbo.tbl_DMMS_Dept_Machine INNER JOIN
                         dbo.tbl_DMMS_Dept ON dbo.tbl_DMMS_Dept_Machine.DeptID = dbo.tbl_DMMS_Dept.DeptID INNER JOIN
                         dbo.tbl_DMMS_Sections ON dbo.tbl_DMMS_Dept_Machine.SectionID = dbo.tbl_DMMS_Sections.SecID
WHERE        (dbo.tbl_DMMS_Dept_Machine.Status = 1) AND (dbo.tbl_DMMS_Dept.DeptID =25)";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
//print_r($Doo1);

//die;
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    

$text = "http://192.168.15.3:2000/DMM/index.php/QRCOntroller/getid/0";
  
// $path variable store the location where to 
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = 'images/Packing/';

  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
  
// Generates QR Code and Stores it in directory given
//for($i=1;$i<1245; $i++){
While($Data=sqlsrv_fetch_Array($Doo1)){

  $machineName=$Data['Name'];

    $explode = explode("/",$text);
    $explode[count($explode)-1] = $machineName;
    $text = implode("/",$explode);

    $name=str_replace("/","-",$machineName);
    $file = $path.$name.".png";
  
    QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);
}
//}

  
// Displaying the stored QR code from directory
// echo "<center><img src='".$file."'></center>";
?>
    