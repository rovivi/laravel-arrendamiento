<?php
//$dompdf->loadHtml(  File::get(public_path().'/html/c1.html'));
// reference the Dompdf namespace
use Dompdf\Dompdf;
//def("DOMPDF_ENABLE_REMOTE", true);
// instantiate and use the dompdf class

$dompdf = new Dompdf();








$html = view('contrato', $data)->render();
//$dompdf->loadHtml(  File::get(public_path().'/html/c1.html'));

$dompdf->loadHtml( $html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portroit');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('my.pdf',array('Attachment'=>0));
     

?>