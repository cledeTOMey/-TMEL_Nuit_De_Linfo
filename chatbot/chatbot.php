<?php
//nom IA: JYC
$RESSEMBLANCE_PERCENTAGE = 0.7;
$user_sentence = "obtenir position";

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
        "boison" => ["eau", "vodka", "alcool"]
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
        "boison" => ["eau", "vodka", "alcool"]
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

echo "For sentence \"".$user_sentence."\" :\n\n";
$sentence_type = "None";

foreach ($sentence_words as $word) {
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
                        echo " (+2 TL because swear word)";
                    } else if ($key_word_type == "_commands") {
                        echo "\nCMD";
                    }

                    echo "\n";
                    (maj_abuse_quantity($word))? $thug_level++: FALSE;
                }
            }
        }
    }
    echo "Selected match for '".$word."': ".(($selected_word != null)? $selected_word: "None")."\n";
}

if (strpos($user_sentence, "?") !== FALSE) $sentence_type = "Question";
if (strpos($user_sentence, "!") !== FALSE) {
    $sentence_type = "Exclamation";
    if ($thug_level > 0) $thug_level++;
}

echo "----------------------------------------------------------------------\n";
echo "• Sentence type: ".$sentence_type."\n";
echo "THUG LEVEL: ".$thug_level."\n\n\n\n";

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