<?php
error_reporting(E_ERROR | E_PARSE);
class REST {

  protected $_content_type = 'application/json';
  protected $_data = array();
  protected $_code = 200;

  public function __construct() {
    $this->inputs();
  }

  public function response($data, $status) {
    $this->_code = ($status) ? $status : 200;
    $this->set_headers();
    echo $data;
    exit;
  }

  public function get_request_method() {
    return $_SERVER['REQUEST_METHOD'];
  }

  private function inputs() {
    switch ($this->get_request_method()) {
      case 'POST':
        $this->_data = $this->cleanInputs($_POST);
        break;

      case 'GET':
      case 'DELETE':
        $this->_data = $this->cleanInputs($_GET);
        break;

      case 'PUT':
        parse_str(file_get_contents('php://input'), $this->_data);
        $this->_data = $this->cleanInputs($this->_data);
        break;

      default:
        $this->response('', 406);
        break;
    }
  }

  private function cleanInputs($data) {
    $clean_input = array();
    if (is_array($data)) {
      foreach ($data as $k => $v) {
        $clean_input[$k] = $this->cleanInputs($v);
      }
    } else {
      $data = strip_tags($data);
      $clean_input = trim($data);
    }

    return $clean_input;
  }

  private function set_headers() {
    header('HTTP/1.1 ' . $this->_code . ' ' . $this->get_status_message());
    header('Content-Type:' . $this->_content_type);
  }

  private function get_status_message() {
    $status = array(
      100 => 'Continue',
      101 => 'Switching Protocols',
      200 => 'OK',
      201 => 'Created',
      202 => 'Accepted',
      203 => 'Non-Authoritative Information',
      204 => 'No Content',
      205 => 'Reset Content',
      206 => 'Partial Content',
      300 => 'Multiple Choices',
      301 => 'Moved Permanently',
      302 => 'Found',
      303 => 'See Other',
      304 => 'Not Modified',
      305 => 'Use Proxy',
      306 => '(Unused)',
      307 => 'Temporary Redirect',
      400 => 'Bad Request',
      401 => 'Unauthorized',
      402 => 'Payment Required',
      403 => 'Forbidden',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      406 => 'Not Acceptable',
      407 => 'Proxy Authentication Required',
      408 => 'Request Timeout',
      409 => 'Conflict',
      410 => 'Gone',
      411 => 'Length Required',
      412 => 'Precondition Failed',
      413 => 'Request Entity Too Large',
      414 => 'Request-URI Too Long',
      415 => 'Unsupported Media Type',
      416 => 'Requested Range Not Satisfiable',
      417 => 'Expectation Failed',
      500 => 'Internal Server Error',
      501 => 'Not Implemented',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable',
      504 => 'Gateway Timeout',
      505 => 'HTTP Version Not Supported'
    );

    return ($status[$this->_code]) ? $status[$this->_code] : $status[500];
  }
}
