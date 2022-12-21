<?php

class Request
{
    //1. method
    //2. body (gia tri)
    private $rules = [], $message = [];
    public $errors = [];
    public function getMethod()
    {
        echo $_SERVER['REQUEST_METHOD'];
        // return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // public function isPost()
    // {
    //     if ($this->getMethod() == 'post') {
    //         return true;
    //     }
    //     return false;
    // }

    // public function isGet()
    // {
    //     if ($this->getMethod() == 'get') {
    //         return true;
    //     }
    //     return false;
    // }

    // public function getField()
    // {
    //     $dataField = [];
    //     if ($this->isGet()) {
    //         // xu ly lay du lieu voi phuong thuc get
    //         if (!empty($_GET)) {
    //             foreach ($_GET as $key => $values) {
    //                 if (is_array($values)) {
    //                     $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    //                 } else {
    //                     $dataField[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    //                 }
    //             }
    //         }
    //     }

    //     if ($this->isPost()) {
    //         // xu ly lay du lieu voi phuong thuc post
    //         if (!empty($_POST)) {
    //             foreach ($_POST as $key => $values) {
    //                 if (is_array($values)) {
    //                     $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    //                 } else {
    //                     $dataField[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    //                 }
    //             }
    //         }
    //     }
    //     return $dataField;
    // }

    // public function rules($rules = [])
    // {
    //     $this->rules = $rules;
    //     // print_r($this->rules);
    // }

    // public function message($message = [])
    // {
    //     $this->message = $message;
    //     // print_r($this->message);
    // }

    // public function validate()
    // {
    //     $this->rules = array_filter($this->rules);
    //     if (!empty($this->rules)) {
    //         $dataField = $this->getField();
    //         foreach ($this->rules as $fieldName => $ruleItem) {
    //             $ruleItemArr = explode('|', $ruleItem);


    //             foreach ($ruleItemArr as $rules) {
    //                 $ruleName = null;
    //                 $ruleVal = null;
    //                 $rulesArr = explode(":", $rules);
    //                 $ruleName = reset($rulesArr);
    //                 if (count($rulesArr) > 1) {
    //                     $ruleVal = end($rulesArr);
    //                 }
    //                 if ($ruleName == 'require') {
    //                     if (empty($dataField[$fieldName])) {
    //                         $this->errors[$fieldName][$ruleName] = $this->message[$fieldName . '.' . $ruleName];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    // public function errors($fieldName)
    // {
    // }
}
