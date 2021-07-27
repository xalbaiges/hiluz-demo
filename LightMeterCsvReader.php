<?php

  class LightMeterCsvReader  implements IfcReadFromSource {
       private $resourceName;
       public function loadTarget($resourceName) {
           $this->resourceName = $resourceName;
       }    
              
       public function read(){
         $_CLIENT_ID = 0;
         $_VALUE_METER= 2;
         $data = [];
         $clientId = "";
         $meters = [];
         $filename = $this->resourceName;
         $rowIndex = 0;
         $monthCount = 0;
         if (($fhandle = fopen($filename, "r")) !== FALSE) {
           while (($dataRow = fgetcsv($fhandle, 1000, ",")) !== FALSE) {
             ++$rowIndex; // if(++$rowIndex==1) continue; skip first row 
             if($rowIndex==1) {
               continue;
             }
             ++$monthCount; 
             if($monthCount == 1) {
               $clientId = $dataRow[$_CLIENT_ID];
             }elseif ($monthCount == 12) {
               $meters[]=$dataRow[$_VALUE_METER];
               $data[$clientId]= $meters;
               $monthCount= 0;
               $meters=[];
               continue;
             } 
             $meters[]=$dataRow[$_VALUE_METER];
           }
           fclose($fhandle);
         }
        return $data;
       }
  }