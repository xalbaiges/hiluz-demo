<?php
  include_once "IfcReadFromSource.php";
  include_once "LightMeterXmlReader.php";
  include_once "LightMeterCsvReader.php";


  class XmlFileLoaderUnitTest extends LightMeterXmlReader {

    private function load_xml_file_test(){
      echo "Testing: load xml file... ";
      $filename = "2016-readings-test.xml";
      $expectedResult = [
        "583ef6329df6b"=>[37232,36537,36430,36622,37776,35382,37970,38463,35252,35704,38220,36688],
        "583ef6329e237"=>[30622,31072,29070,30056,31746,30560,32006,30209,30015,29554,1379,29597],
        "583ef6329e271"=>[21921,21732,20403,21068,20500,21590,21852,21223,22424,121208,21338,21892]
      ];

      parent::loadTarget($filename);
      $result = parent::read();
            
            
      if ( count($result) != count($expectedResult)) {
      	return FALSE;
      }

      $keysResult = array_keys($result);
      $keysExpectResult = array_keys($expectedResult);
      

      for( $indx=0; $indx<count($keysResult); ++$indx) {
        if( strcmp($keysResult[$indx],$keysExpectResult[$indx]) != 0 ) {
          return FALSE;
        }
        for($subindx=0; $subindx<count($result[$keysResult[$indx]]); ++$subindx) {
          if( $result[$keysResult[$indx]][$subindx] !=
          	  $expectedResult[$keysResult[$indx]][$subindx] ) {
          	return FALSE;
          }
        }
      }
    
     return TRUE;
    }

    public function run(){
      if( $this->load_xml_file_test() == TRUE) {
        echo "SUCCESS\n";
      }else{
        echo "ERROR!\n";
      }
    }

  }

  class CsvFileLoaderUnitTest extends LightMeterCsvReader{

    private function load_csv_file_test(){
      echo "Testing: load csv file... ";
      $filename = "2016-readings-test.csv";
      $expectedResult = [
        "583ef6329d7b9"=>[42451,44279,44055,40953,42566,41216,43597,43324,3564,44459,42997,42600],
        "583ef6329d81f"=>[39760,38785,37519,39028,39469,37463,37152,37756,37398,37770,38948,37342],
        "583ef6329d85d"=>[35181,36095,34258,35233,34573,35527,34428,37182,35544,35793,37420,37771]
      ];

      parent::loadTarget($filename);
      $result = parent::read();

      if ( count($result) != count($expectedResult)) {
      	return FALSE;
      }
 
      $keysResult = array_keys($result);
      $keysExpectResult = array_keys($expectedResult);
      
      for( $indx=0; $indx<count($keysResult); ++$indx) {
        if( strcmp($keysResult[$indx],$keysExpectResult[$indx]) != 0 ) {
          return FALSE;
        }
        for($subindx=0; $subindx<count($result[$keysResult[$indx]]); ++$subindx) {
          if( $result[$keysResult[$indx]][$subindx] !=
          	  $expectedResult[$keysResult[$indx]][$subindx] ) {
          	return FALSE;
          }
        }
      }

      return TRUE;
    }

    public function run(){
      if( $this->load_csv_file_test() == TRUE) {
        echo "SUCCESS\n";
      }else{
        echo "ERROR!\n";
      }
    }

  }


$xmlFileLoaderUnitTest = new XmlFileLoaderUnitTest();
$xmlFileLoaderUnitTest->run();

$csvFileLoaderUnitTest = new CsvFileLoaderUnitTest();
$csvFileLoaderUnitTest->run();
