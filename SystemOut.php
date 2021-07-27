<?php

class SystemOut{
  private $_LANG_ES = 'ES';
  private $_LANG_EN = 'EN';
  private $_TRANSLATE;
  private $_LANG;

  public function __construct() {
    $this->unsetTranslation();
  }

  public function setTranslation($lang){
    $this->_TRANSLATE = TRUE;
    $this->_LANG = $lang;
  }
  
  public function unsetTranslation(){
    $this->_TRANSLATE = FALSE;
  }


  private function i18n($key) {
    $dictionary = [
                   $this->_LANG_ES => ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                   $this->_LANG_EN => ['January','February','March','April','May','June','July','August','September','October','November','December']
                 ];

   return $dictionary[$this->_LANG][$key];
  }

  private function printMonth($value){
    if($this->_TRANSLATE) {
     echo $this->i18n($value);
    }else{
      echo $value;
    }
    echo ',';
  }

  public function write($scammers){
    echo "client,month,reading,median\n";
    $keys = array_keys($scammers);
    for( $indx=0; $indx<count($keys); ++$indx) {
      echo $keys[$indx].',';
      $this->printMonth($scammers[$keys[$indx]]["month"]);
      echo $scammers[$keys[$indx]]["reading"].',';
      echo $scammers[$keys[$indx]]["median"]."\n";
    }
  }
  
}