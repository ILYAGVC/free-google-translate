<?php
class TranslateGoogleFree
{
    public static function Translate($source, $sourceLang, $targetLang)
    {
        $text = array();
        $result = array();

        $encodedSource = urlencode($source);
        $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" .
            $sourceLang . "&tl=" . $targetLang . "&dt=t&q=" . $encodedSource;

        $r = file_get_contents($url);
        if ($r === false) {
            return array("err", new Exception("Error getting translate.googleapis.com"));
        }

        $bReq = strpos($r, '<title>Error 400 (Bad Request)') !== false;
        if ($bReq) {
            return array("err", new Exception("Error 400 (Bad Request)"));
        }

        $body = json_decode($r, true);
        if ($body === null) {
            return array("err", new Exception("Error unmarshaling data"));
        }

        if (count($body) > 0) {
            $inner = $body[0];
            foreach ($inner as $slice) {
                foreach ($slice as $translatedText) {
                    $text[] = sprintf("%s", $translatedText);
                    break;
                }
            }
            $cText = implode("", $text);

            return array($cText, null);
        } else {
            return array("err", new Exception("No translated data in responce"));
        }
    }
}
?>
