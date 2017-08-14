<?php

@session_start();

Class PDOCrudAjaxCtrl {

    public function handleRequest() {
        $instanceKey = $_REQUEST["pdocrud_instance"];
        $pdocrud = unserialize($_SESSION["pdocrud_sess"][$instanceKey]);
        $action = $_POST["pdocrud_data"]["action"];
        $data = $_POST["pdocrud_data"];
        $post = $_POST;

        if (isset($_FILES))
            $post = array_merge($_FILES, $post);
        $data["post"] = $post;
        switch (strtoupper($action)) {
            case "VIEW":
                echo $pdocrud->render("VIEWFORM", $data);
                break;
            case "SORT":
                $data["action"] = "asc";
                echo $pdocrud->render("CRUD", $data);
                break;
            case "ASC":
                echo $pdocrud->render("CRUD", $data);
                break;
            case "DESC":
                echo $pdocrud->render("CRUD", $data);
                break;
            case "ADD":
                echo $pdocrud->render("INSERTFORM", $data);
                break;
            case "INSERT":
                $pdocrud->render("INSERT", $post);
                break;
            case "INSERT_BACK":
                $pdocrud->setBackOperation();
                $pdocrud->render("INSERT", $post);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "BACK":
                $pdocrud->setBackOperation();
                echo $pdocrud->render("CRUD", $data);
                break;
            case "EDIT":
                $pdocrud->setInlineEdit(false);
                echo $pdocrud->render("EDITFORM", $data);
                break;
            case "INLINE_EDIT":
                $pdocrud->setBackOperation();
                $pdocrud->setInlineEdit(true);
                echo $pdocrud->render("EDITFORM", $data);
                break;
            case "ONEPAGEEDIT":
                $pdocrud->setInlineEdit(false);
                echo $pdocrud->render("ONEPAGE", $data);
                break;
            case "INLINE_BACK":
                $pdocrud->render("UPDATE", $post);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "UPDATE":
                $pdocrud->render("UPDATE", $post);
                break;
            case "UPDATE_BACK":
                $pdocrud->setBackOperation();
                $pdocrud->render("UPDATE", $post);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "DELETE":
                $pdocrud->render("DELETE", $data);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "DELETE_SELECTED":
                $pdocrud->render("DELETE_SELECTED", $data);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "PAGINATION":
                $pdocrud->currentPage($data["page"]);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "RECORDS_PER_PAGE":
                $pdocrud->currentPage(1);
                $pdocrud->recordsPerPage($data["records"]);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "SEARCH":
                $pdocrud->currentPage(1);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "EXPORTTABLE":
                echo $pdocrud->render("EXPORTTABLE", $data);
                break;
            case "EXPORTFORM":
                $pdocrud->render("EXPORTFORM", $data);
                break;
            case "SWITCH":
                $pdocrud->render("SWITCH", $data);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "BTNSWITCH":
                $pdocrud->render("BTNSWITCH", $data);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "LOADDEPENDENT":
                echo $pdocrud->render("LOADDEPENDENT", $data);
                break;
            case "EMAIL" : echo $pdocrud->render("EMAIL", $post);
                break;
            case "SELECT":
                echo $pdocrud->render("CRUD", $data);
                break;
            case "SELECTFORM":
                echo $pdocrud->render("SELECT", $post);
                break;
            case "FILTER":
                echo $pdocrud->render("CRUD", $data);
                break;
            case "RELOAD":
                echo $pdocrud->render("CRUD", $data);
                break;
            case "SAVE_CRUD_TABLE_DATA":
                $pdocrud->render("SAVE_CRUD_DATA", $data);
                echo $pdocrud->render("CRUD", $data);
                break;
            case "RENDER_ADV_SEARCH":
                echo $pdocrud->render("CRUD", $data);
                break;
            default:
                break;
        }
    }

}
