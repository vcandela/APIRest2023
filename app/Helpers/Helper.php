<?php
use App\Models\User;

function zero_fill ($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}

define('METHOD','AES-256-CBC');
define('SECRET_KEY','00VICTORCANDELA00');
define('SECRET_IV','00202300');

function encryptar($string){
  $output=FALSE;
  $key=hash('sha256', SECRET_KEY);
  $iv=substr(hash('sha256', SECRET_IV), 0, 16);
  $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
  $output=base64_encode($output);
  return $output;
}
function desencryptar($string){
  $key=hash('sha256', SECRET_KEY);
  $iv=substr(hash('sha256', SECRET_IV), 0, 16);
  $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
  return $output;
}


function UserJSON($value){
    return User::select('id','name','email','color_text','color_back')->where('id',$value)->first();
}

function UserID(){
    return auth()->user()->id;
}
function UserName(){
    return auth()->user()->name;
}
function UserRole(){
    return auth()->user()->roles->implode('name',',');
}

function textUpper($text){
    $text = mb_convert_case($text, MB_CASE_UPPER,"UTF-8");
    return $text;
}
function textLower($text){
    $text = mb_convert_case($text, MB_CASE_LOWER,"UTF-8");
    return $text;
}
function textTitle($text){
    $text = mb_convert_case($text, MB_CASE_TITLE,"UTF-8");
    return $text;
}

function eliminar_acentos($cadena){

    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç'),
    array('N', 'n', 'C', 'c'),
    $cadena
    );

    $cadena = utf8_decode($cadena);
    return $cadena;
}

function change_date($date){
        return Carbon\Carbon::parse($date)->format('d/m/Y');
}
function change_datetime($date){
    return Carbon\Carbon::parse($date)->format('d/m/Y - H:i A');
}
