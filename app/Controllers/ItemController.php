<?php

    require_once __DIR__ . '/../Models/ItemModel.php';
    require_once __DIR__ . '/../Views/ItemView.phtml';    

class ItemController {

    private $model;
    private $view;

    public function __construct() {
        $this->model= new ItemModel();
        $this->view= new ItemView();
    }

    public function GetItems() {
        $items= $this->model->GetElements();
        $this->view->DisplayItems($items);
    }

    public function GetItem($id) {
        $item= $this->model->GetItem($id);
        $this->view->DisplayItem($item);
    }
}