<?php

class DataSourceFactory{

  public function getSourceService($source){
    $service = null;
    if($this->isSourceCsv($this->getFileExtension($source))) {
      $service = $this->createCsvService($source);
    } else
    if($this->isSourceXml($this->getFileExtension($source))) {
      $service = $this->createXmlService($source);
    } 
   return $service;
  }

  private function isSourceCsv($fileExtension){
    return (strcmp($fileExtension,"csv")==0);
  }

  private function isSourceXml($fileExtension){
    return (strcmp($fileExtension,"xml")==0);
  }

  private function getFileExtension($value){
    return (explode(".", strtolower($value)))[1];  
  }

  private function createCsvService($source){
    $service = new LightMeterCsvReader();
    $service->loadTarget($source);
    return new LightMeterReader($service);    
  }

  private function createXmlService($source){
    $service = new LightMeterXmlReader();
    $service->loadTarget($source);
    return new LightMeterReader($service);    
  }

}