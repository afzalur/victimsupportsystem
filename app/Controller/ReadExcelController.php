<?php
App::import('Vendor', 'php-excel-reader/excel_reader2'); //import statement
class ReadExcelController extends AppController {
 /**
   * Display the content of example.xls
   */
function show_excel() {
$data = new Spreadsheet_Excel_Reader('example.xls', true);
$this->set('data', $data); 
  }
}
?>