<?php

Class PDOCrudHelper
{
    
    private $logFile = "log.txt";
    public $recordErrorLog = true;
    public $delimiter = ","; // Delimiter to be used in handling csv files, default is ','
    public $enclosure = '"'; // Enclosure to be used in handling csv files, default is '"' 
    public $pdfFontName = "helvetica"; // font name for pdf
    public $pdfFontSize = "8"; // font size for pdf
    public $pdfFontWeight = "B"; // font weight for pdf
    public $pdfAuthorName = "Author Name"; // Author name for pdf
    public $pdfSubject = "PDF Subject Name"; // Subject name for pdf	
    private $errorCollector;
    
    function __construct(PDOCrudErrorCtrl $errorCollector)
    {
        $this->errorCollector = $errorCollector;
    }
    
    /**
     * Writes error log
     */
    public function setErrorLog($error)
    {
        try {
            $this->error = $error;
            if ($this->recordErrorLog) {
                $error  = "\n" . date('Y-m-d H:i:s') . " " . $error;
                $handle = fopen($this->logFile, 'a+');
                fwrite($handle, $error);
                fclose($handle);
            }
        }
        catch (Exception $e) {
            
        }
    }
    
    /**
     *  Returns current page url
     */
    public function getCurrentPageURL()
    {
        
        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        
        return $pageURL;
    }
    
    /*
     * Exports to CSV
     * @param   array $csvArray           2-D array of csv data
     * @param   string $fileName          Exported Filename 
     */
    
    public function exportTOCSV($csvArray, $fileSavePath, $downloadURL, $fileName = "file.csv")
    {
        if (!is_array($csvArray)) {
            $this->setErrorLog("Please provide valid input. ");
            return false;
        }
        if (!$fileName) {
            $this->setErrorLog("Please provide the csv file name");
            return false;
        }
        
        $list = $csvArray;
        if ($fileSavePath && !is_dir($fileSavePath))
            mkdir($fileSavePath);
        
        $fp = fopen($fileSavePath . $fileName, 'w');
        
        foreach ($list as $fields) {
            fputcsv($fp, $fields, $this->delimiter, $this->enclosure);
        }
        
        echo $downloadURL . $fileName;
        fclose($fp);
        return true;
    }
    
    /*
     * Exports to pdf
     * @param   array  $pdfArray                2-D array of data to be exported
     * @param   string $outputFileName          Exported Filename 
     */
    
    public function exportTOPDF($pdfArray, $fileSavePath, $downloadURL, $fileName = "file.pdf")
    {
        error_reporting(0);
        if (!is_array($pdfArray)) {
            $this->setErrorLog("Please provide valid input. ");
            return false;
        }
        
        require_once(PDOCrudABSPATH . "library/tcpdf/tcpdf.php");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetFont($this->pdfFontName, $this->pdfFontWeight, $this->pdfFontSize, '', 'false');
        $pdf->SetAuthor($this->pdfAuthorName);
        $pdf->SetSubject($this->pdfSubject);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $html = $this->arrayToHTML($pdfArray, "file.html", true);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output($fileSavePath . $fileName, 'F');
        echo $downloadURL . $fileName;
        return true;
    }
    
    /**
     * Generates the html table as output from the array provided.
     * 
     * @param   array     $htmlArray             	Associative array with key as column name and value as table values.
     * @param   array     $outputFileName           Output file name
     * @param   bool      $isCalledFromPDF          This function is used internally in arrayToPDF() also, to check whether it is called directly 			                                                    or using the pdf function 
     
     *
     */
    function arrayToHTML($htmlArray, $outputFileName = "file.html", $isCalledFromPDF = false)
    {
        if (!is_array($htmlArray)) {
            $this->setErrorLog("Please provide valid input. ");
            return false;
        }
        $table_output = '<table>';
        $table_head   = "<thead>";
        $table_body   = '<tbody>';
        $loop_count   = 0;
        
        foreach ($htmlArray as $k => $v) {
            if ($loop_count == 0)
                $table_head .= '<tr id="row_' . $loop_count . '">';
            else
                $table_body .= '<tr id="row_' . $loop_count . '">';
            
            foreach ($v as $col => $row) {
                if ($loop_count == 0)
                    $table_head .= '<th>' . $row . '</th>';
                else
                    $table_body .= '<td>' . $row . '</td>';
            }
            $table_body .= '</tr>';
            if ($loop_count == 0)
                $table_body .= '</tr></thead>';
            
            $loop_count++;
        }
        
        $table_body .= '</tbody>';
        $table_output = $table_output . $table_head . $table_body . '</table>';
        return $table_output;
    }
    
    public function getDirFiles($dir, $extension = "")
    {
        $files = array_diff(scandir($dir), array(
            '..',
            '.'
        ));
        if (!empty($extension) && count($files)) {
            $outputFiles = array();
            foreach ($files as $file) {
                if ($this->getFileExtension($file) === $extension)
                    $outputFiles[] = $file;
            }
            $files = $outputFiles;
        }
        return $files;
    }
    
    public function compareVal($currentVal, $operator, $match)
    {
        switch ($operator) {
            case ">":
                return ((float) $currentVal > (float) $match) ? true : false;
            case ">=":
                return ((float) $currentVal >= (float) $match) ? true : false;
            case "<":
                return ((float) $currentVal < (float) $match) ? true : false;
            case "<=":
                return ((float) $currentVal <= (float) $match) ? true : false;
            case "!=":
                return ((float) $currentVal !== (float) $match) ? true : false;
            case "=":
                return ((float) $currentVal == (float) $match) ? true : false;
        }
        return false;
    }
    
    public function pagination($page = 1, $totalrecords, $limit = 10, $adjacents = 1, $lang = array())
    {
        $pagination = "";
        if ($totalrecords > 0) {
            if (!$adjacents)
                $adjacents = 1;
            if (!$limit)
                $limit = 15;
            if (!$page)
                $page = 1;
            
            $prev     = $page - 1;
            $next     = $page + 1;
            $lastpage = ceil($totalrecords / $limit);
            $lpm1     = $lastpage - 1;
            
            
            if ($lastpage > 1) {
                $pagination .= "<ul class=\"pagination\">";
                
                //previous button
                if ($page > 1)
                    $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\" data-page=" . $prev . ">« " . $lang["prev"] . "</a></li>";
                
                //pages	
                if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"active\"><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\" data-page=" . $counter . ">$counter</a></li>";
                        else
                            $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $counter . ">" . $counter . "</a></li>";
                    }
                } elseif ($lastpage >= 7 + ($adjacents * 2)) { //enough pages to hide some
                    //close to beginning; only hide later pages
                    if ($page < 1 + ($adjacents * 3)) {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a class='pdocrud-actions pdocrud-page' data-page=" . $counter . " data-action='pagination' href=\"javascript:;\">$counter</a></li>";
                            else
                                $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $counter . ">" . $counter . "</a></li>";
                        }
                        $pagination .= "<li class=\"elipses\">...</li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $lpm1 . ">" . $lpm1 . "</a></li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $lastpage . ">" . $lastpage . "</a></li>";
                    }
                    //in middle; hide some front and some back
                    elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=\"1\">1</a></li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=\"2\">2</a></li>";
                        $pagination .= "<li class=\"elipses\">...</li>";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\" data-page=" . $counter . ">$counter</a></li>";
                            else
                                $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $counter . ">" . $counter . "</a></li>";
                        }
                        $pagination .= "<li class=\"elipses\">...</li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $lpm1 . ">" . $lpm1 . "</a></li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $lastpage . ">" . $lastpage . "</a></li>";
                    }
                    //close to end; only hide early pages
                    else {
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=\"1\">1</a></li>";
                        $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=\"2\">2</a></li>";
                        $pagination .= "<li class=\"elipses\"></li>";
                        for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\" data-page=" . $counter . ">$counter</a></li>";
                            else
                                $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination''href=\"javascript:;\"  data-page=" . $counter . ">" . $counter . "</a></li>";
                        }
                    }
                }
                
                //next button
                if ($page < $counter - 1)
                    $pagination .= "<li><a class='pdocrud-actions pdocrud-page' data-action='pagination'' href=\"javascript:;\"  data-page=" . $next . ">" . $lang["next"] . "</a></li>";
                $pagination .= "</ul>\n";
            }
        }
        
        return $pagination;
    }
    
}