<?php

class PDOCrudView {

    private $template_path;

    function __construct() {
        $this->template_path = dirname(__FILE__) . "/templates";
    }

    public function outputJs($jsList) {
        if (count($jsList)) {
            $jsOutput = "";
            foreach ($jsList as $js) {
                $jsOutput .= "<script src='" . $js . "' type='text/javascript'></script>";
            }
            return $jsOutput;
        }
    }

    public function outputApplyJs($applyJs) {
        if (count($applyJs)) {
            foreach ($applyJs as $jsList) {
                $jsOutput = "";
                foreach ($jsList as $key => $js) {
                    $options = json_encode($js["options"]);
                    $jsOutput .= "<script type='text/javascript'>";
                    $jsOutput .= "jQuery(document).on('" . $js["action"] . "', function(evt, obj, data) {";
                    $jsOutput .= "jQuery(obj).parents('.pdocrud-table-container').children().find(\"[firstname='" . $js["applyOnVal"] . "']\")." . $js["functionName"] . "(" . $options . ");";
                    $jsOutput .= "})";
                    $jsOutput .= "</script>";
                }
                return $jsOutput;
            }
        }
    }

    public function outputCss($cssList) {
        if (count($cssList)) {
            $cssOutput = "";
            foreach ($cssList as $css) {
                $cssOutput .= "<link href='" . $css . "' rel='stylesheet' />";
            }
            return $cssOutput;
        }
    }

    public function outputJsSetting($jsSetting) {
        if (count($jsSetting) > 0) {
            $jsOutput = "<script type='text/javascript'>";
            $jsOutput .= "var pdocrud_js = " . json_encode($jsSetting);
            $jsOutput .= "</script>";
            return $jsOutput;
        }
    }

    public function outputHTMLContent($html) {
        if (count($html)) {
            $htmlOutput = "";
            foreach ($html as $content) {
                $htmlOutput .= $content;
            }
            return $htmlOutput;
        }
    }

    public function renderSQL($columns, $data, $objKey, $lang, $settings, $pagination, $perPageRecords) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-sql.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderTable($columns, $data, $pk, $objKey, $lang, $settings, $colsRemove, $btnActions) {
        ob_start();
        $template = strtolower($settings["template"]);
        $action_template = $settings["actionBtnPosition"];
        if($action_template === "right")
            require $this->template_path . "/$template/template-table.php";
        else if($action_template === "left")
            require $this->template_path . "/$template/template-table-left-action-btn.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public function renderPortfolio($columns, $data, $pk, $objKey, $lang, $settings, $colsRemove, $btnActions, $colPerRow) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-portfolio.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderCrud($data, $searchbox, $pagination, $perPageRecords, $lang, $objKey, $modal, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-crud.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderCrudFilter($filters, $data, $lang, $objKey, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-filter-display.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public function renderCrudAdvSearch($advSearch, $lang, $objKey, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-adv-search.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderForm($form, $output, $settings, $submitData, $lang) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-form.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderViewForm($data, $columns, $lang, $settings, $objKey, $leftJoinData, $id) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-view.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public function renderOnePage($form, $crud, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-one-page.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderField($data, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-field.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderInlineField($data, $settings, $submitData) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-inline-edit.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderInlineForm($form, $output, $settings, $submitData) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-inline-form.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderLeftJoin($data, $settings, $lang, $showHeader = true) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-left-join.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderMessage($data, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-message.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function renderFilter($filterControl, $displayText, $settings) {
        ob_start();
        $template = strtolower($settings["template"]);
        require $this->template_path . "/$template/template-filter.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function showError($error) {
        $errorMessage = "   <div class=\"alert alert-danger\" role=\"alert\">
                            <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                            <span class=\"sr-only\">Error:</span>
                            $error
                          </div>";
        echo $errorMessage;
    }

}
