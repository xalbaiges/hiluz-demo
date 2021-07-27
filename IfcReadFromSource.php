<?php

  interface IfcReadFromSource {
      public function loadTarget($resourceName);
      public function read();
  }