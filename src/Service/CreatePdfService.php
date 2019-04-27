<?php
namespace App\Service;

use App\Entity\Quotation;
use Dompdf\Dompdf;
use Dompdf\Options;

//use \Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\Templating\EngineInterface;


class CreatePdfService
{

    private $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function createPdf($html)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $pdfOutput = $dompdf->output();

        return $pdfOutput;
    }
}