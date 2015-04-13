<?php
require_once('REST.php');
require_once('allocine.php');

class API extends REST {

  const SERVER = 'localhost';
  const USER = 'root';
  const PASSWORD = '';
  const DB = 'restmovie';

  private $_db = NULL;

  public function __construct() {
    parent::__construct();
    $this->connect();
  }

  private function connect() {
    $this->_db = new mysqli(self::SERVER, self::USER, self::PASSWORD, self::DB);
  }

  private function query($sql) {
    return $this->_db->query($sql);
  }

  public function processAPI() {
    $function = $_REQUEST['class'];

    if (method_exists($this, $function) > 0) {
      $this->$function();
    } else {
      $this->response('', 404);
    }
  }

  private function parse($data) {
    if (is_array($data)) {
      return json_encode($data);
    }
  }

  private function autocomplete() {
    if ($this->get_request_method() == 'GET') {
      $search = $this->_data['id'];
      $search = '%' . $search . '%';
      $rs = $this->_db->prepare('SELECT * FROM movies WHERE title LIKE ?;');
      $rs->bind_param('s', $search);
      $rs->execute();
      $rs = $rs->get_result();

      if ($rs->num_rows > 0) {
        $return = array();

        while ($line = $rs->fetch_assoc()) {
          $return[] = $line;
        }

        $this->response($this->parse($return), 200);
      }
    }

    $this->response('', 204);
  }

  private function imdb() {

    $search = urlencode($this->_data['id']);

    $requestURL = "http://www.omdbapi.com/?t='.$search.'&r=json";

    $result = file_get_contents($requestURL);
    $imdbResults = json_decode($result, true);

    $return = array();
    $movieFormated = array();
    $movieFormated['title'] = $imdbResults["Title"];
    $movieFormated['picture'] = empty($imdbResults['Poster']) ? 'http://placehold.it/262x350' : $imdbResults['Poster'];
    $movieFormated['actors'] = $imdbResults['Actors'];
    $movieFormated['directors'] = $imdbResults['Director'];

    $return[] = $movieFormated;

    $this->response($this->parse($return), 200);
  }

  private function allocine() {
    if ($this->get_request_method() == 'GET') {
      $search = $this->_data['id'];
      $search = '%' . $search . '%';

      $allocine = new Allocine('100043982026', '29d185d98c984a359e6e6f26a0474269');
      $result = $allocine->search($search);
      $allocineResult = json_decode($result, true);

      if (is_array($allocineResult['feed']['movie'])) {
        $return = array();
        foreach($allocineResult['feed']['movie'] as $movie) {
          $movieFormated = array();
          $movieFormated['title'] = $movie['originalTitle'];
          $movieFormated['picture'] = empty($movie['poster']['href']) ? 'http://placehold.it/262x350' : $movie['poster']['href'];
          $movieFormated['link'] = $movie['link'][0]['href'];
          $movieFormated['actors'] = $movie['castingShort']['actors'];
          $movieFormated['directors'] = $movie['castingShort']['directors'];

          $return[] = $movieFormated;
        }
      }

      $this->response($this->parse($return), 200);
    }

    $this->response('', 204);
  }

  private function movies() {
    if ($this->get_request_method() == 'GET' && isset($this->_data['id'])) {
      $id = $this->_data['id'];
      $rs = $this->query('SELECT * FROM movies WHERE id = '.$id.';');
      if ($rs->num_rows > 0) {
        $return = array();

        while ($line = $rs->fetch_assoc()) {
          if (empty($line['picture'])) {
            $line['picture'] = 'http://placehold.it/262x350';
          }

          $return = $line;
        }

        $this->response($this->parse($return), 200);
      }
    } else if ($this->get_request_method() == 'GET') {
      $rs = $this->query('SELECT * FROM movies;');

      if ($rs->num_rows > 0) {
        $return = array();

        while ($line = $rs->fetch_assoc()) {
          if (empty($line['picture'])) {
            $line['picture'] = 'http://placehold.it/262x350';
          }

          $return[] = $line;
        }

        $this->response($this->parse($return), 200);
      }
    } else if ($this->get_request_method() == 'POST') {
      $title = $this->_data['title'];
      $link = $this->_data['link'];
      $picture = $this->_data['picture'];
      $actors = $this->_data['actors'];
      $directors = $this->_data['directors'];

      $rs = $this->_db->prepare('INSERT INTO movies (title, link, actors, picture, directors) VALUES (?, ?, ?, ?, ?);');
      $rs->bind_param('sssss', $title, $link, $actors, $picture, $directors);
      $rs->execute();

      $curl = curl_init('http://restmovie.dev/api/movies/' . $this->_db->insert_id);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $return = curl_exec($curl);
      curl_close($curl);

      $this->response($return, 200);
    } else if ($this->get_request_method() == 'PUT') {
      $id = $this->_data['id'];
      $title = $this->_data['title'];
      $link = $this->_data['link'];
      $picture = $this->_data['picture'];
      $actors = $this->_data['actors'];
      $directors = $this->_data['directors'];

      $rs = $this->_db->prepare('UPDATE movies SET title = ?, link = ?, actors = ?, picture = ?, directors = ? WHERE id = ?;');
      $rs->bind_param('sssssi', $title, $link, $actors, $picture, $directors, $id);
      $rs->execute();

      $curl = curl_init('http://restmovie.dev/api/movies/' . $id);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $return = curl_exec($curl);
      curl_close($curl);

      $this->response($return, 200);
    }

    $this->response('', 204);
  }
}

$api = new API;
$api->processAPI();
