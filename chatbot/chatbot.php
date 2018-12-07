<?php
//nom IA: JYC

include_once("db.php");

$RESSEMBLANCE_PERCENTAGE = 0.7;
$user_sentence = $_GET["usr_message"];

$data_base_key_words = [
    "pronouns" => [
        "utilisateur" => ["je", "moi", "j"],
        "IA" => ["tu", "toi", "t", "te"]
    ],
    "verbs" => [
        "manger" => ["manger", "bouffe", "avaler", "ingurgiter", "deguster"],
        "boire" => ["boire", "avaler", "ingurgiter"]
    ],
    "nouns" => [
        "nourriture" => ["haricot", "pizza", "burger", "mangue", "poire"],
        "boisson" => ["eau", "vodka", "alcool"]
    ],
    "swear_words" => [
        ["nique", "merde", "pute", "connard", "fdp", "grochowski"]
    ],
    "_commands" => [
        "environnement" => ["meteo", "postion", "stock"]
    ]
];

$data_base_answers = [
    "pronouns" => [
        "utilisateur" => ["je", "moi", "j"],
        "IA" => ["tu", "toi", "t", "te"]
    ],
    "verbs" => [
        "manger" => ["manger", "bouffe", "avaler", "ingurgiter", "deguster"],
        "boire" => ["boire", "avaler", "ingurgiter"]
    ],
    "nouns" => [
        "nourriture" => ["haricot", "pizza", "burger", "mangue", "poire"],
        "boisson" => ["eau", "vodka", "alcool"]
    ],
    "swear_words" => [
        ["nique", "merde", "pute", "connard", "fdp", "grochowski"]
    ],
    "_commands" => [
        "environnement" => ["meteo", "postion", "stock"]
    ]
];

$sentence_words = explode(" ", $user_sentence);

$thug_level = 0;

//$array[] = $user_sentence;
$sentence_type = "None";
$user_sentence = strtolower($user_sentence);

function getMots($mot){
    $array = array();
    if($mot == "!help"){
        $array[] = "Vraiment ? T'abuses, utilise des mots-clés tels que : Avaler, Soif, Vodka, Yanis ...";
        return $array;
    }
    $getidmot = DB::getInstance()->prepare("SELECT * FROM motscles");
    $getidmot->execute();
    while($checkmots = $getidmot->fetch(PDO::FETCH_ASSOC)){
        if(strtolower($checkmots["libelle_mot"]) != $mot){
            $getsynonymesmots = DB::getInstance()->prepare("SELECT * FROM synonymes S JOIN motscles M ON M.idmot = S.idmot WHERE LOWER(S.libelle_synonyme) = '".$mot."'");
            $getsynonymesmots->execute();
            if($getsynonymesmots->rowCount() > 0){
                while($checksynonymes = $getsynonymesmots->fetch(PDO::FETCH_ASSOC)){
                    $getdata = DB::getInstance()->prepare("SELECT * FROM motscles M JOIN reponses R ON M.idmot = R.idmot WHERE M.idmot = ".$checksynonymes["idmot"]);
                    $getdata->execute();
                }
                while($checkrow = $getdata->fetch(PDO::FETCH_ASSOC)){
                    $array[] = $checkrow["text_reponse"];
                }
            }
        }else{
            $getdata = DB::getInstance()->prepare("SELECT * FROM motscles M JOIN reponses R ON M.idmot = R.idmot WHERE LOWER(M.libelle_mot) = '".$mot."'");
            $getdata->execute();
            while($checkrow = $getdata->fetch(PDO::FETCH_ASSOC)){
                $array[] = $checkrow["text_reponse"];
            }
        }
    }
    if(empty($array)){
        $array[] = "Vraiment t'es trop nul, utilise !help";
    }
    return array_unique($array);
}

function getObjectMot($mot){
    $getidmot = DB::getInstance()->prepare("SELECT * FROM motscles");
    $getidmot->execute();
    $array = array();
    while($checkmots = $getidmot->fetch(PDO::FETCH_ASSOC)){
        if(strtolower($checkmots["libelle_mot"]) != $mot){
            $getsynonymesmots = DB::getInstance()->prepare("SELECT * FROM synonymes S JOIN motscles M ON M.idmot = S.idmot WHERE libelle_synonyme = '".$mot."'");
            $getsynonymesmots->execute();
            if($getsynonymesmots->rowCount() > 0){
                while($checksynonymes = $getsynonymesmots->fetch(PDO::FETCH_ASSOC)){
                    $getdata = DB::getInstance()->prepare("SELECT * FROM motscles M JOIN reponses R ON M.idmot = R.idmot WHERE M.idmot = ".$checksynonymes["idmot"]);
                    $getdata->execute();
                }
                $checkrow = $getdata->fetch(PDO::FETCH_ASSOC);
                $idmot = $checkrow["idmot"];
                $array[$idmot] = $checkrow["poid_mot"];
                $truc = $idmot."}".$checkrow["poid_mot"];
            }
        }else{
            $getdata = DB::getInstance()->prepare("SELECT * FROM motscles M JOIN reponses R ON M.idmot = R.idmot WHERE LOWER(M.libelle_mot) = '".$mot."'");
            $getdata->execute();
            $checkrow = $getdata->fetch(PDO::FETCH_ASSOC);
            $idmot = $checkrow["idmot"];
            $array[$idmot] = $checkrow["poid_mot"];
            $truc = $idmot."}".$checkrow["poid_mot"];
        }
    }
    return $truc;
}

function getPoids($mot){
    $mot = str_replace(" ", ",", $mot);
    $array = explode(",", $mot);
    $arrayPoids = array();
    foreach($array as $motphrase){
        $arrayPoids[] = explode("}", getObjectMot($motphrase));
    }
    //asort($arrayPoids);
    //return $arrayPoids;
    $i = 0;
    $j = 0;
    $pluspetit = 0;
    $test = array();
    $testPlusGrand = array();
    $j = 0;
    //return $arrayPoids;
    foreach($arrayPoids as $k => $v){
        $test = $v;
        if($j == 0){
            $testPlusGrand = $v;
        }
        if($test[1] > $testPlusGrand[1]){
            $testPlusGrand = $test;
        }
        $j++;
    }
    $getdata = DB::getInstance()->prepare("SELECT * FROM motscles WHERE idmot = '".$testPlusGrand[0]."'");
    $getdata->execute();
    while($checkrow = $getdata->fetch(PDO::FETCH_ASSOC)){
        //return $checkrow["libelle_mot"];
        return getMots(strtolower($checkrow["libelle_mot"]));
    }
 }


//echo json_encode(getMots($user_sentence));
echo json_encode(getPoids($user_sentence));

/*foreach ($sentence_words as $word) {
    $selected_word = null;
    $selected_word_percentage = 0;
    foreach ($data_base_key_words as $key_word_type => $key_words) {
        foreach ($key_words as $sub_key_type => $cat) {
            foreach ($cat as $final_word) {
                $sim = similar_text(strtoupper(replace_accents($word)), strtoupper(replace_accents($final_word)), $perc);
                if ($perc >= $RESSEMBLANCE_PERCENTAGE * 100)
                {
                    if ($perc > $selected_word_percentage) {
                        $selected_word = $final_word;
                        $selected_word_percentage = $perc;
                    }

                    echo "Recognized the word '".$word."':\n";
                    echo "\t- Correspond à '".$final_word."' avec un taux de ".round($perc, 2)."%\n";
                    echo "\t- Sous-Categorie: ".$sub_key_type."\n";
                    echo "\t- Type de mot: ".$key_word_type;

                    if ($key_word_type == "swear_words") {
                        $thug_level += 2;
                        //echo " (+2 TL because swear word)";
                    } else if ($key_word_type == "_commands") {
                        //echo "\nCMD";
                    }

                    //echo "\n";
                    (maj_abuse_quantity($word))? $thug_level++: FALSE;
                }
            }
        }
    }
    //echo "Selected match for '".$word."': ".(($selected_word != null)? $selected_word: "None")."\n";
}

if (strpos($user_sentence, "?") !== FALSE) $sentence_type = "Question";
if (strpos($user_sentence, "!") !== FALSE) {
    $sentence_type = "Exclamation";
    if ($thug_level > 0) $thug_level++;
}*/

/*echo "----------------------------------------------------------------------\n";
echo "• Sentence type: ".$sentence_type."\n";
echo "THUG LEVEL: ".$thug_level."\n\n\n\n";*/

function maj_abuse_quantity($word) {
    $maj_letters = 0;

    foreach (str_split($word) as $char) {
        if (strtoupper($char) == $char) ++$maj_letters;
    }

    return ($thug_percentage = $maj_letters / strlen($word) > 0.5);
}

function replace_accents($str) {
    $str = htmlentities($str, ENT_COMPAT, "UTF-8");
    $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/','$1',$str);
    return html_entity_decode($str);
}