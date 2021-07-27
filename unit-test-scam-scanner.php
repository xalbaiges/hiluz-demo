<?php
include_once "ScamScanner.php";


class ScamScannerUnitTest extends ScamScanner {

    private function avg_test(){
      echo "Testing: avg... ";
      $values = [1,2,3];
      $expectedResult = 2;
      $result = parent::avg($values);
      if($result==$expectedResult){
      	return TRUE;
      }else{
      	return FALSE;
      }
    }

    private function delta_test(){
      echo "Testing: delta... ";
      $values = 100;
      $expectedResult = 50;
      $result = parent::delta($values);
      if($result==$expectedResult){
      	return TRUE;
      }else{
      	return FALSE;
      }    	
    }

    private function search_test(){
      echo "Testing: search... ";
      $data=[
       "aaa" => [100,3,100,100,100,100,100,100,100,100,100,100],
       "bbb" => [100,100,100,100,100,100,100,100,100,100,100,100],
       "ccc" => [100,100,100,100,100,999900,100,100,100,100,100,100]      
      ];
      $expectedResult = [
       "aaa" => [100,3,100,100,100,100,100,100,100,100,100,100],
       "ccc" => [100,100,100,100,100,999900,100,100,100,100,100,100]      
      ];

      $result = parent::search($data);

      $a = array_keys($result);
      $b = array_keys($expectedResult);
    
      if ( (count($result) == count($expectedResult)) && 
      	   (strcmp($a[0],$b[0])==0) &&
      	   (strcmp($a[1],$b[1])==0) )  {
        return TRUE;
      }else{
        return FALSE;
      }
      
    }

    public function run(){
      if( $this->avg_test() == TRUE) {
        echo "SUCCESS\n";
      }else{
        echo "ERROR!\n";
      }
      if( $this->delta_test() == TRUE) {
        echo "SUCCESS\n";
      }else{
        echo "ERROR!\n";
      }      
      if( $this->search_test() == TRUE) {
        echo "SUCCESS\n";
      }else{
        echo "ERROR!\n";
      }
    }

  }


$scamScannerUnitTest = new ScamScannerUnitTest();
$scamScannerUnitTest->run();
