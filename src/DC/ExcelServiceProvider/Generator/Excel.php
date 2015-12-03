<?php

namespace DC\ExcelServiceProvider\Generator;

class Excel {

    public function generateXLS($headers, $data) {

        $objPHPExcel = new \PHPExcel(); // Create new PHPExcel object

        $A = 65;
        foreach($headers AS $k => $headerValue)
        {
            $cellReference = chr(65+$k) . '1';
            $objPHPExcel->getActiveSheet()->setCellValue($cellReference,$headerValue); // Add column heading data
        }

        foreach($data AS $k => $row)
        {
            foreach(array_keys($row) AS $number => $field) {
                $cellLetter = chr(65+$number);
                $cellNumber = $k+2; // start from the row below the headings
                $objPHPExcel->getActiveSheet()->setCellValue($cellLetter.$cellNumber, $row["$field"]);
            }
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_start();
        $objWriter->save('php://output');
        $contents = ob_get_clean();
        return $contents;
    }
}