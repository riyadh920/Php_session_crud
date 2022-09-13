<?php

namespace Project\Controllers;

class Product
{
    public $id;
    public $name;

    public function __construct()
    {
        session_start();
    }

    public function store(array $data)
    {
        $_SESSION['old'] = $data;

        if (empty($data['id'])) {
            $_SESSION['errors']['id'] = 'Required';
        } elseif (!is_numeric($data['id'])) {
            $_SESSION['errors']['id'] = 'Must be an integer';
        }

        if (empty($data['name'])) {
            $_SESSION['errors']['name'] = 'Required';
        }

        if (isset($_SESSION['errors'])) {
            return false;
        }

        $_SESSION['products'][] = $data;
        unset($_SESSION['old']);
        $_SESSION['message'] = 'Successfully Created';
        return true;
    }

    public function details(int $id)
    {
        return $_SESSION['products'][$this->findIndex($id)];
    }

    public function update(array $data, int $id)
    {
        $_SESSION['products'][$this->findIndex($id)] = $data;
        $_SESSION['message'] = 'Successfully Updated';
    }

    public function destroy(int $id)
    {
        unset($_SESSION['products'][$this->findIndex($id)]);
        $_SESSION['message'] = 'Successfully Deleted';
    }

    public function findIndex(int $id): int|null
    {
        $students = $_SESSION['products'];
        $index = null;
        foreach ($products as $key => $product) {
            if ($product['id'] == $id) {
                $index = $key;
            }
        }

        return $index;
    }
}
