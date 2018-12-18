<?php
/**
 * Created by PhpStorm.
 * User: adrisilva
 * Date: 18/12/18
 * Time: 15:30
 */

namespace App\Util;

class Util
{
    public static function slugGenerate($name)
    {
        //tirando os acentos
        $name= preg_replace('![áàãâä]+!u','a',$name);
        $name= preg_replace('![éèêë]+!u','e',$name);
        $name= preg_replace('![íìîï]+!u','i',$name);
        $name= preg_replace('![óòõôö]+!u','o',$name);
        $name= preg_replace('![úùûü]+!u','u',$name);
        //parte que tira o cedilha e o ñ
        $name= preg_replace('![ç]+!u','c',$name);
        $name= preg_replace('![ñ]+!u','n',$name);
        //tirando outros caracteres invalidos
        $name= preg_replace('[^a-z0-9\-]','_',$name);
        //tirando espaços
        $name = str_replace(' ','_',$name);
        //tirano hifen
        $name = str_replace('-','_',$name);
        //tirando barra
        $name = str_replace('/','_',$name);
        //trocando duplo espaço (hifen) por 1 hifen só
        $name = str_replace('--','_',$name);

        return strtolower($name);
    }
}