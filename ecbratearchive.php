<?php

class ECBRateArchive{

  public function __construct()
  {
    $remote = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref.zip';
    $local = 'eurofxref.zip';
    $copy = copy($remote, $local);

    if(!$copy){
      echo "Could not copy files";
    } else {
      echo "Copied files";
    }

    $zip = new ZipArchive;
    $unzip = $zip->open('eurofxref.zip');
    if ($unzip === TRUE) {
        echo 'ok';
        $zip->extractTo('ecbrates');
        $zip->close();
    } else {
        echo 'failed, code:' . $unzip;
    }
  }

}

$archive = new ECBRateArchive;
