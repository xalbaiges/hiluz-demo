<?php

class ScamScanner {
    
 protected function avg($values) {
  if($values<0 || $values == 0) {
      return 0;
  }   
  $acc = 0;    
  for($indx=0;$indx<count($values);++$indx) {
      $acc +=$values[$indx];
  }    
  return $acc / count($values);
 }

 protected function delta($avg) {
  return $avg * 0.5;    // ooh a magic number! 
 }
 
 public function search($customers) {
  $scammers = [];    
  foreach($customers as $key=>$content) {
    $values = $customers[$key];
  
    $avg = $this->avg($values); 
    $delta = $this->delta($avg);

    $topLimit = $avg+$delta;
    $bottomLimit = $avg-$delta;
    for($indx=0;$indx<count($values); ++$indx) {
        $val = intVal($values[$indx]);
        if($val<=$bottomLimit || $val>=$topLimit) {
          $scammers[$key] =[
                              "month"=> $indx,
                              "reading"=>$val,
                              "median"=>$avg
                           ];     
        }
    }
  }
  return $scammers;
 }

}
