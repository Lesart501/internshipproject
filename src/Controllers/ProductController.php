<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Lib\Files\FileJSONReader;
use App\Models\Product;
use App\Lib\Formatting\ProductDataFormatter;
use App\Lib\Validation\ProductDataValidator;
use App\Lib\Exceptions\CustomException;

class ProductController extends Controller
{
    protected Product $product;
    protected FileJSONReader $fileJsonReader;
    protected ProductDataValidator $validator;
    protected ProductDataFormatter $formatter;
    protected string $url;

    public function __construct(
        View $view,
        FileJSONReader $fileJsonReader,
        ProductDataValidator $validator,
        ProductDataFormatter $formatter,
        string $url
    ) {
        parent::__construct($view);
        $this->fileJsonReader = $fileJsonReader;
        $this->validator = $validator;
        $this->formatter = $formatter;
        $this->url = $url;
    }

    public function getProducts(): void
    {
        $db = $this->fileJsonReader->convertToArrayOfObjects();
        $this->view->render('Все продукты', $db);
    }
    
    public function getCurrentUsersProducts(): void
    {
        $db = $this->fileJsonReader->convertToArrayOfObjects();
        $this->view->render('Ваши продукты', $db);
    }
    
    public function getProduct(): void
    {
        $db = $this->fileJsonReader->convertToArray();
        $id = (int) explode('/', $this->url)[2];
        $index = $id - 1;
        if (!array_key_exists($index, $db)) {
            throw new CustomException(404);
        }
        $this->view->render("Продукт №$id", $db[$index]);
    }

    public function createProduct(): void
    {
        parse_str(file_get_contents('php://input'), $data);
        if ($this->validator->isDataComplete($data)) {
            $data = $this->formatter->convertDataTypes($data);
        }
        $status = $this->validator->validate($data);
        if ($status['success']) {
            $this->fileJsonReader->addElement($data);
        }
        $this->view->render("Добавление товара", $status);
    }

    public function editProduct(): void
    {
        $products = $this->fileJsonReader->convertToArray();
        $id = (int) explode('/', $this->url)[2];
        $index = $id - 1;
        if (!array_key_exists($index, $products)) {
            throw new CustomException(404);
        }
        parse_str(file_get_contents('php://input'), $data);
        if ($this->validator->isDataComplete($data)) {
            $data = $this->formatter->convertDataTypes($data);
        }
        $status = $this->validator->validate($data);
        if ($status['success']) {
            $this->fileJsonReader->editElement($index, $data);
        }
        $this->view->render("Редактирование товара №$id", $status);
    }

    public function deleteProduct(): void
    {
        $products = $this->fileJsonReader->convertToArray();
        $id = (int) explode('/', $this->url)[2];
        $index = $id - 1;
        if (!array_key_exists($index, $products)) {
            throw new CustomException(404);
        }
        $this->fileJsonReader->deleteElement($index);
        $this->view->render("Удаление товара №$id", ['success' => true]);
    }
    
    public function editAmount(): void
    {
        $products = $this->fileJsonReader->convertToArrayOfObjects();
        $id = (int) explode('/', $this->url)[2];
        $index = $id - 1;
        if (!array_key_exists($index, $products)) {
            throw new CustomException(404);
        }
        parse_str(file_get_contents('php://input'), $data);
        $status = $this->validator->checkAmount($data['amount']);
        $products[$index]['amount'] = (int) ($data['amount']);
        $this->fileJsonReader->updateFile($products);
        $this->view->render("Редактирование количества товара №$id", $status);
    }
    
    public function editPrice(): void
    {
        $products = $this->fileJsonReader->convertToArrayOfObjects();
        $id = (int) explode('/', $this->url)[2];
        $index = $id - 1;
        if (!array_key_exists($index, $products)) {
            throw new CustomException(404);
        }
        parse_str(file_get_contents('php://input'), $data);
        $status = $this->validator->checkPrice($data['price']);
        $products[$index]['price'] = ($data['price']);
        $this->fileJsonReader->updateFile($products);
        $this->view->render("Редактирование цены", $status);
    }
}