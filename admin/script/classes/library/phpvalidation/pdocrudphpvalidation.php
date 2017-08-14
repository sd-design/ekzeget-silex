<?php

class PDOCrudPHPValidation {

    public function __construct() {
        
    }
    
    public function validateField($rules, $val, $param = "") {
        foreach ($rules as $data) {
            foreach ($data as $rule => $rule_val) {
                $rule = str_replace("-", "", strstr($rule, "-"));
                switch (strtolower($rule)) {
                    case "required": if (!$this->isRequired($val))
                            return "req_fields";
                        else
                            return true;
                    case "minlength": if (!$this->minLength($val, $rule_val))
                            return "min_length";
                        else
                            return true;
                    case "maxlength": if (!$this->maxLength($val, $rule_val))
                            return "max_length";
                        else
                            return true;
                    case "date": if (!$this->isValidDate($val))
                            return "invalid_date";
                        else
                            return true;
                    case "email": if (!$this->isValidEmail($val))
                            return "invalid_email";
                        else
                            return true;
                    case "url": if (!$this->isValidURL($val))
                            return "invalid_url";
                        else
                            return true;
                    case "numeric": if (!$this->isNumeric($val))
                            return "numeric_only";
                        else
                            return true;
                    case "int": if (!$this->isInt($val))
                            return "int_only";
                        else
                            return true;
                    case "float": if (!$this->isFloat($val))
                            return "float_only";
                        else
                            return true;
                     case "match": if (!$this->matchFields($val,$param))
                            return "match";
                        else
                            return true;   
                }
            }
        }
        return true;
    }

    public function isRequired($val) {
        if (is_scalar($val)) {
            $val = trim($val);
        }
        return (!is_null($val) && (!empty($val)));
    }

    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isValidURL($url) {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
    }
    
    public function isValidDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    public function isNumeric($var) {
        return is_numeric($var);
    }

    public function isInt($var) {
        return is_int($var);
    }

    public function isFloat($var) {
        return is_float($var);
    }

    public function exactLength($var, $length) {
        return strlen($var) == $length;
    }

    public function maxLength($var, $length) {
        return strlen($var) <= $length;
    }

    public function minLength($var, $length) {
        return strlen($var) >= $length;
    }

    public function matchFields($field1, $field2) {
        return (string) $field1 == (string) $field2;
    }

    public function alphaNumeric($val) {
        $reg = '/^([a-z0-9])+$/ui';
        return preg_match($reg, $val);
    }

    public function alpha($val) {
        $reg = '/^([a-z])+$/ui';
        return preg_match($reg, $val);
    }

    public function regMatch($reg, $val) {
        return preg_match($reg, $val);
    }

}