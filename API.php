<?php
require_once('REST.php');

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

  private function movies() {
    if ($this->get_request_method() == 'GET' && isset($this->_data['id'])) {
      $id = $this->_data['id'];
      $rs = $this->query('SELECT id, title, link, created_at, updated_at FROM movies WHERE id = '.$id.';');

      if ($rs->num_rows > 0) {
        $return = array();

        while ($line = $rs->fetch_assoc()) {
          $return = $line;
        }

        $this->response($this->parse($return), 200);
      }
    } else if ($this->get_request_method() == 'GET') {
      $rs = $this->query('SELECT id, title, link, created_at, updated_at FROM movies;');

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
}

$api = new API;
$api->processAPI();
