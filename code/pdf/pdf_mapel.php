<?php

require_once("../../koneksi.php");

$html = '

<font face="Calibri">DAFTAR MATA PELAJARAN</font>

<br><br>

<table border="1" bordercolor="#D3D3D3" style="width:100%">
 <!-- Ini Header Tabelnya -->
 <thead>
 <tr style="text-align:left" class="headerrow">
 <th>Kode Mata Pelajaran</th>
 <th>Nama Mata Pelajaran</th>
 </tr>
 </thead>
 <!-- Ini Body Tabelnya -->
 <tbody>';
 // Tampilkan Data Dari Tabel Siswa
 $no=1;
 $sql = mysqli_query($connect,"select * from mata_pelajaran");
 while ($data = mysqli_fetch_array($sql)){  
  $html .= '<tr>';
  $html .= '<td>'.$data['kode_mp'].'</td>';
  $html .= '<td>'.$data['nama_mp'].'</td>';
  $html .= '</tr>';
 $no++;
 }
$html .= '</tbody></table>';

$footer = '<div><div style="text-align:left; width:50; float:left;">'.$a.'</div>
           <div style="text-align:right; width:40; float:right;">Hal {PAGENO}</div></div>
		   <div style="float:right; text-align:right;">Printed by: Sisinfo SMK Nasional Malang</div>
          ';

include("../../mpdf/mpdf.php");
ob_clean();
$mpdf = new mPDF('utf-8','A4','','Calibri'); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->setHtmlFooter($footer);
$mpdf->SetWatermarkImage('smknasional.png', 0.02, 'F');
$mpdf->showWatermarkImage = true;
$mpdf->WriteHTML($html);
$mpdf->Output('mapel_smk.pdf','I');
exit;

?>