<?php

  class LightMeterXmlReader implements IfcReadFromSource {
       private $resourceName;
       public function loadTarget($resourceName) {
           $this->resourceName = $resourceName;
       }
       
       public function read(){
         $filename = $this->resourceName;

         $xml = simplexml_load_file($filename);
         $buffer = [];
         foreach ($xml->reading as $line) {
           $attrib = $line->attributes();
           $buffer []= $attrib['clientID'].','.$line;
         }
  
         $_CLIENT_ID = 0;
         $_VALUE_METER= 1;
         $data = [];
         $clientId = "";
         $meters = [];
         $rowIndex = 0;
         $monthCount = 0;
         foreach($buffer as $indx=>$element) {
           $dataRow = explode(",", $element); // pos 0 client pos 1 value
           // Mismo algoritmo que en el otro
           ++$rowIndex; // if(++$rowIndex==1) continue; skip first row 
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
           // fin mismo algoritmo que en el otro lado
       
         }
        return $data;
       }    
  }