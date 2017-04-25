<?php
$word = new COM("Word.application") or die("open err");	
$word ->Visible = 0;	
$doc = $word->Documents->Open('D:\soft\xampp-win32-5.5.28-0-VC11\xampp\htdocs\ExperienceBase\test1.docx');	
$doc ->SaveAs2();	
$doc ->ExportAsFixedFormat('D:\soft\xampp-win32-5.5.28-0-VC11\xampp\htdocs\ExperienceBase\testKay.pdf',17);	
$word ->Quit();
?>