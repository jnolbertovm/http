<?php

namespace nolbertovilchez\http;

use nolbertovilchez\http\Error;

class Response {

    public $data  = null;
    public $error = null;

    public function __construct($jsonString) {
        $json = json_decode($jsonString);
        if (!is_null($json)) {
            if (array_key_exists("data", $json)) {
                $this->data = $json->{"data"};
            }
            if (array_key_exists("error", $json)) {
                $this->error = new Error($json->{"error"});
            }
        }
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = json_decode($data);
    }

    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = new Error($error);
    }

    public function toJSON() {
        $response = array();
        if (!empty($this->data)) {
            $response["data"] = $this->data;
        }

        if (!empty($error)) {
            $response["error"] = $this->error;
        }
        return json_encode($response);
    }

}
