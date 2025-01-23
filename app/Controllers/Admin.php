<?php

namespace App\Controllers;

use App\Models\adminModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('Admin/Admin');
    }

    public function getDataAdmin()
    {

        if ($this->request->isAJAX()) {
            $model = new adminModel;
            $data = ['getAdmin' => $model->findAll()];

            $msg = [
                'data' => view('Admin/tabelDataAdmin', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf dapat tidak di proses');
        }
    }

    public function formTambahData()
    {

        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Admin/formAddData')
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf dapat tidak di proses');
        }
    }
}
