<?php
Class PDOCrudTableFormat extends PDOCrudHelper
{
    
    public function __construct()
    {
    }
    
    public function formatTableData($data, $tableDataFormat)
    {
        $output = array();
        foreach ($tableDataFormat as $dataFormat) {
            $loop = 0;
            list($col, $operator, $match) = $dataFormat["condition"];
            
            foreach ($data as $rows) {
                if ($this->compareVal($rows[$col], $operator, $match)) {
                    if ($dataFormat["applyOn"] === "col")
                        $rows[$col] = $this->applyDataRule($dataFormat["apply"], $rows[$col], $dataFormat["formatType"]);
                    else
                        $rows[] = $this->applyDataRule($dataFormat["apply"], $rows[$col], $dataFormat["formatType"]);
                }
                $output[$loop] = $rows;
                $loop++;
            }
        }
        return $output;
    }
    
    public function applyDataRule($rule, $val, $type)
    {
        if (!empty($type)) {
            $output["style"]   = "";
            $output["class"]   = "";
            $output["content"] = $val;
            if ($type === "style")
                $output["style"] = "style='" . implode(";", $rule) . "'";
            else if ($type === "class")
                $output["class"] = "class='" . implode(" ", $rule) . "'";
            else if ($type === "hide")
                $output["style"] = "style='display:none'";
            else if ($type === "custom") {
                if (isset($rule[0]) && is_callable($rule[0]))
                    return call_user_func($rule[0], $val);
            }
            return $output;
        }
        return $val;
    }
    
    public function bulkUpdate($data, $colFormat, $pk) {
        $loop = 0;
        foreach ($colFormat as $col => $options) {
            foreach ($data as $rows) {
                if (isset($rows[$col])) {
                    $rows[$col] = preg_replace('/{val}/', $rows[$col], $options["field"]);
                    $rows[$col] = preg_replace('/{pk-val}/', $rows[$pk], $rows[$col]);
                }
                $data[$loop] = $rows;
                $loop++;
            }
            $loop = 0;
        }
        return $data;
    }

    public function formatTableCol($data, $colFormatData)
    {
        $loop = 0;
        foreach ($colFormatData as $colFormat) {
            foreach ($colFormat as $col => $options) {
                foreach ($data as $rows) {
                    if (isset($rows[$col]))
                        $rows[$col] = $this->formatTableColOptions($col, $options, $rows[$col]);
                    $data[$loop] = $rows;
                    $loop++;
                }
                $loop = 0;
            }
        }
        return $data;
    }
    
    private function formatTableColOptions($col, $options, $val)
    {
        switch (strtolower($options["formatType"])) {
            case "image":
                return $this->formatTableColImage($val, $options["paramaters"]);
            case "string":
                return $this->formatTableColString($val, $options["paramaters"]);
            case "date":
                return $this->formatTableColDate($val, $options["paramaters"]);
            case "html":
                return $this->formatTableColString($val, $options["paramaters"]);
            case "formula":
                return $this->formatTableColFormula($val, $options["paramaters"]);
            case "replace":
                return $this->formatTableColReplaceVal($val, $options["paramaters"]);
            case "readmore":
                return $this->formatTableColReadMore($val, $options["paramaters"]);
            case "dialog":
                return $this->formatTableColDialog($val, $options["paramaters"]);
             case "url":
                return $this->formatTableColURL($val, $options["paramaters"]);    
            default:
                return $val;
        }
    }
    
    private function formatTableColImage($val, $parameters = "")
    {
        return $this->getImageCol($val, $parameters);
    }
    
    private function formatTableColURL($val, $parameters = "")
    {
        return $this->getURLCol($val, $parameters);
    }
    
    private function formatTableColString($val, $parameters = "")
    {
        switch (strtolower($parameters["type"])) {
            case "uppercase":
                return strtoupper($val);
            case "lowercase":
                return strtolower($val);
            case "upperfirst":
                return ucfirst($val);
            case "prefix":
                return $parameters["str"] . $val;
            case "suffix":
                return $val . $parameters["str"];
            case "html":
                return preg_replace('/{[^}]+}/', $val, $parameters["str"]);
            default:
                return $val;
        }
    }
    
    private function formatTableColDate($val, $parameters = ""){
        return date($parameters["format"], strtotime($val)); 
    }
    
    private function formatTableColFormula($val, $parameters = "")
    {
        switch (strtolower($parameters["type"])) {
            case "percentage":
                $val = ($val / 100);
                return $val . "%";
            case "number_format":
                return number_format($val, $parameters["decimalpoint"]);
            case "round":
                return round($val, $parameters["decimalpoint"]);
            case "ceil":
                return ceil($val);
            case "floor":
                return floor($val);
            default:
                $val;
        }
    }
    
    private function formatTableColReplaceVal($val, $parameters = "")
    {
        if (isset($parameters[$val]))
            return $parameters[$val];
        return $val;
    }
    
    private function formatTableColReadMore($val, $parameters = "")
    {
        if (isset($parameters["length"]) && strlen($val) > $parameters["length"]) {
            $readmoretext = "read more";
            $readmore     = isset($parameters["showreadmore"]) ? "<a href=\"javascript:;\" class=\"pdocrud-actions\" data-hide=\"false\" data-action=\"read_more\" data-read-more=\"$val\">" . $readmoretext . "</a>" : "";
            return "<p>" . substr($val, 0, $parameters["length"]) . "...." . "</p>" . $readmore;
        }
        return $val;
    }
    
    private function formatTableColDialog($val, $parameters = "")
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $modal_id = substr(str_shuffle($alphabet), 0, 10);
        return "<a href=\"javascript:;\" class=\"pdocrud-dialog\" data-toggle=\"modal\" data-target=\"#$modal_id\">
            Read More
                </a>
                <div class=\"modal fade\" id=\"$modal_id\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                  <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                      <div class=\"modal-body\">
                        $val
                      </div>
                      <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                      </div>
                    </div>
                  </div>
                </div>";
    }
    
    public function addSumPerPage($data, $colSumPerPageData)
    {
        $sumRow = array();
        foreach ($colSumPerPageData as $col) {
            $sum   = 0;
            $index = 0;
            foreach ($data as $rows) {
                if (isset($rows[$col])) {
                    $sum += $rows[$col];
                    $index = array_search($col, array_keys($rows));
                }
            }
            $sumRow[$index] = array("content"=>$sum,"sum_type"=>"sum_per_page");
        }
        if (isset($sumRow)) {
            for ($loop = 0; $loop < count($data[0]); $loop++) {
                if (!isset($sumRow[$loop]))
                    $sumRow[$loop] = "";
            }
        }
        ksort($sumRow);
        $data[] = $sumRow;
        return $data;
    }
    
    public function addTableCol($data, $colAddData)
    {
        $loop = 0;
        foreach ($colAddData as $col => $options) {
            foreach ($data as $rows) {
                $fields = array();
                foreach ($options["cols"] as $option) {
                    if (isset($rows[$option]))
                        $fields[] = $rows[$option];
                }
                if (count($fields))
                    $rows[$col] = $this->getNewTableCol($options["type"], $fields);
                
                $data[$loop] = $rows;
                $loop++;
            }
            $loop = 0;
        }
        
        return $data;
    }
    
    public function addColSwitch($data, $actions, $pk) {
        $loop = 0;
        foreach ($actions as $uniquekey => $action) {
            foreach ($data as $rows) {
                if (isset($rows[$action[0]]))
                    $rows[$action[0]] = $this->getActionData($uniquekey, $action, $rows[$action[0]], $rows[$pk]);
                $data[$loop] = $rows;
                $loop++;
            }
            $loop = 0;
        }
        return $data;
    }   
    
    private function getActionData($uniquekey, $actionData, $dataColVal = "", $dataID = "")
    {
        list($colName, $action, $type, $text, $attr) = $actionData;
        $url = "javascript:;";
        if ($type === "url")
            $url = $action;
        $url =  preg_replace('/{[^}]+}/', $dataID, $url);
        $field = "<a href=\"$url\" ";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        } else {
            $field .= " class=\"pdocrud-actions pdocrud-switch\" ";
        }
        
        $field .= " data-action=\"$type\"";
        $field .= " data-id=\"$dataID\"";
        $field .= " data-unique-id=\"$uniquekey\"";        
        $field .= " data-column-val=\"$dataColVal\" ";
        
        $field .= ">";
        if (is_array($text) && isset($text[$dataColVal]))
            $field .= $text[$dataColVal];
        else if(empty($text))
            $field .= $dataColVal;
        else
            $field .= $text;
        $field .= "</a>";
        return $field;
    }
    
    private function getNewTableCol($type, $fields)
    {
        switch (strtolower($type)) {
            case "sum":
                return array_sum($fields);
            case "merge":
                return implode(" ", $fields);
            case "division":
                if (isset($fields[0]) && isset($fields[1])) {
                    return $fields[1]/$fields[0];
                }
        }
    }
    
    private function getImageCol($path, $attr = "")
    {
        $imgField = "<img src=\"$path\" ";
        foreach ($attr as $c => $v) {
            $imgField .= " $c=\"$v\" ";
        }
        $imgField .= " />";
        return $imgField;
    } 
    
    private function getURLCol($path, $attr = "")
    {
        $urlField = "<a href=\"$path\" ";
        $text = $path;
        foreach ($attr as $c => $v) {
            if($c === "text"){
                $text = $v;
                continue;
            }
            $urlField .= " $c=\"$v\" ";
        }
        
        $urlField .= ">$text</a>";
        return $urlField;
    }        
}