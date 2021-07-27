<?php

  class LightMeterReader {
      private $service;
      public function __construct($service) {
        $this->service = $service;
      }
      
      public function read() {
         return $this->service->read();
      }
  }