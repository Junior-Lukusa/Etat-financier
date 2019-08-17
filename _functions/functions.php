<?php

/**
 * Renvoi la string sécurisée
 * @param $string
 * @return string
 */
function str_secur($string)
{
    return trim(htmlspecialchars($string));
}


/**
 * Renvoi les valeurs d'un tableau sécurisées
 * @param array $array
 * @param bool $param
 * @return array
 */
function array_secur($array, $param = false) {
    if ($param === 'trim') {
        foreach ($array as $index => $value) {
            $array[$index] = trim($array[$index]);
        }
    } elseif ($param === 'htmlspecialchars') {
        foreach ($array as $index => $value) {
            $array[$index] = trim($array[$index]);
        }
    } else {
        foreach ($array as $index => $value) {
            $array[$index] = trim(htmlspecialchars($array[$index]));
        }
    }
    return $array;
}

/**
 * Renvoi un array lisible simplement
 * @param $array
 */
function debug($array){
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
}

/**
 * Renvoie la date écrite en français sans les heures/secondes
 * @param $datetime
 * @return string
 */
function date_fr($datetime) {
    setlocale(LC_ALL, 'fr_FR');
    return strftime('%A %d %B ', strtotime($datetime));
}



/**
 * Supprimer les accents
 * 
 * @param string $str chaîne de caractères avec caractères accentués
 * @param string $encoding encodage du texte (exemple : utf-8, ISO-8859-1 ...)
 */
function suppr_accents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
 
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
 
    // Remplacer les ligatures tel que : , Æ ...
    // Exemple "œ" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);
 
    return $str;
}
 

