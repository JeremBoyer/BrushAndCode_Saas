<?php
namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

use Symfony\Component\Templating\EngineInterface;

class CreatePdfService
{
    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * CreatePdfService constructor.
     * @param EngineInterface $engine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Create a pdf with dompdf
     * https://github.com/dompdf/dompdf
     *
     * @param $html
     * @return null|string
     */
    public function createPdf($html)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', TRUE);

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $pdfOutput = $dompdf->output();

        return $pdfOutput;
    }
}