<?php
  include_once "IfcReadFromSource.php";
  include_once "LightMeterReader.php";
  include_once "LightMeterXmlReader.php";
  include_once "LightMeterCsvReader.php"; 
  include_once "ScamScanner.php";
  include_once "SystemOut.php";
  include_once "DataSourceFactory.php";
  include_once "SystemIn.php";


class TheMain {
  private $dataSourceFactory;
  private $scamScanner;
  private $systemOut;
  private $systemIn;

  public function __construct($dataSourceFactory,$scamScanner,$systemOut,$systemIn){
    $this->dataSourceFactory = $dataSourceFactory;
    $this->scamScanner = $scamScanner;
    $this->systemOut = $systemOut;
    $this->systemIn = $systemIn;
  }

  public function execute(){
    $source = $this->systemIn->readFromClient();
    $customersData = $this->dataSourceFactory->getSourceService($source)->read();
    $scammers = $this->scamScanner->search($customersData);
    $this->systemOut->write($scammers);
    echo "\nhappy coding!\n";    
  }

}

$dataSourceFactory = new DataSourceFactory();
$scamScanner = new ScamScanner();
$systemIn = new SystemIn();
$systemOut = new SystemOut();
//$systemOut->setTranslation('EN');
//$systemOut->unsetTranslation();
$theMain = new TheMain($dataSourceFactory, $scamScanner, $systemOut, $systemIn);
$theMain->execute();


