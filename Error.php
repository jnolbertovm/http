<?php

namespace nolbertovilchez\http;

class Error {

    private $code;
    private $message;

    function __construct($json) {
        $json = is_string($json) ? json_decode($json) : $json;
        if (json_last_error() == JSON_ERROR_NONE) {
            if (array_key_exists("code", $json) && array_key_exists("message", $json)) {
                $this->code    = $json->{"code"};
                $this->message = $json->{"message"};
            }
        } else {
            error_log("Error creating error object from string " . $json);
        }
    }

    public function getCode() {
        return $this->code;
    }

    public function getMessage() {
        return $this->message;
    }

    public function toJson() {
        return json_encode(array(
            "code"    => $this->code,
            "message" => $this->message
        ));
    }

}
