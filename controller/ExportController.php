<?php 
 require_once __DIR__ . '/Controller.php';
    include('library/PDF-Library/tcpdf.php');

class ExportController extends Controller {

    function __construct() {
    }

    public function Catalogus(){
        $pdf = new TCPDF('p', 'mm', 'A4');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $content = "";
        foreach($_SESSION['results'] as $item){
            $content .= $item['titel'];
        }
        $pdf->writeHTML($content, true, false, true, false, "");
        $pdf->Output('catalogus.pdf', 'I');

    }

}

?>
