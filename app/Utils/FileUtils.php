<?php

namespace App\Utils;
use Storage;

class FileUtils {


    public static function guardar($file, $destinationPath, $prefix){
        if ($file->isValid()) {
          $extension = $file->getClientOriginalExtension();
          $fileName = uniqid($prefix).'.'.$extension;
            // $fileName = $file->getClientOriginalName(); // No renaming image
            // $path = $file->storeAss($destinationPath,$fileName); // Con esta linea, se hace magia al guardar en la ruta
          $file->move($destinationPath, $fileName);
          return url($destinationPath.$fileName);
        }
        return null;
    }

    /**
     * Eliminar imagen
     * Método estático que permite la eliminación de una imagen si esta existe dentro del servidor.
     * @param $url
     */
    public static function eliminar($url){
        $spl = explode("/", $url);
        if(count($spl) > 3) {
            $path = $spl[count($spl) - 3] . "/" . $spl[count($spl) - 2] . "/" . $spl[count($spl) - 1];
            if ( file_exists($url) ){
              unlink($url);
            }
            if (file_exists($path)){
              unlink($path);
            }
        }
    }

    public static function mesANum($mes) {
      switch ($mes) {
        case 'Enero':
          $mes = '01';
          break;
        case 'Febrero':
          $mes = '02';
          break;
        case 'Marzo':
          $mes = '03';
          break;
        case 'Abril':
          $mes = '04';
          break;
        case 'Mayo':
          $mes = '05';
          break;
        case 'Junio':
          $mes = '06';
          break;
        case 'Julio':
          $mes = '07';
          break;
        case 'Agosto':
          $mes = '08';
          break;
        case 'Septiembre':
          $mes = '09';
          break;
        case 'Octubre':
          $mes = '10';
          break;
        case 'Noviembre':
          $mes = '11';
          break;
        case 'Diciembre':
          $mes = '12';
          break;
        default:
          $mes = '01';
          break;
      }

      return $mes;
    }
}
