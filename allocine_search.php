<?php
class Allocine
{
    private $_api_url = 'http://api.allocine.fr/rest/v3';
    private $_partner_key;
    private $_secret_key;
    private $_user_agent = 'Dalvik/1.6.0 (Linux; U; Android 4.2.2; Nexus 4 Build/JDQ39E)';

    public function __construct($partner_key, $secret_key)
    {
        $this->_partner_key = $partner_key;
        $this->_secret_key = $secret_key;
    }

    private function _do_request($method, $params)
    {
        $query_url = $this->_api_url.'/'.$method;
        $sed = date('Ymd');
        $sig = urlencode(base64_encode(sha1($this->_secret_key.http_build_query($params).'&sed='.$sed, true)));
        $query_url .= '?'.http_build_query($params).'&sed='.$sed.'&sig='.$sig;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->_user_agent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function search($query)
    {
        $params = array(
            'partner' => $this->_partner_key,
            'q' => $query,
            'format' => 'json',
            'filter' => 'movie'
        );
        $response = $this->_do_request('search', $params);
        return $response;
    }
}

// define('ALLOCINE_PARTNER_KEY', '100043982026');
// define('ALLOCINE_SECRET_KEY', '29d185d98c984a359e6e6f26a0474269');
// header('Content-type: application/json; charset=utf-8');

// $allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);
// $result = $allocine->search("inception");
// echo $result;
// $arrayAllocine = json_decode($result, true);


// $titleMovie = "The Amazing Spider-Man";
// $found = false;
// if (is_array($arrayAllocine["feed"]["movie"])) {
//     foreach($arrayAllocine["feed"]["movie"] as $movie) {
//         if (strcmp($movie["originalTitle"], $titleMovie) == 0 && !$found) {
//             $found = true;
//             $title = $movie["originalTitle"];
//             $image = $movie["poster"]["href"];
//             $link = $movie["link"][0]["href"];
//             $actors = $movie["castingShort"]["actors"];
//             $directors = $movie["castingShort"]["directors"];
//         }
//     }
// }












