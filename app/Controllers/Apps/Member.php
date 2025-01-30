<?php

namespace App\Controllers\Apps;


use App\Controllers\BaseController;

class Member extends BaseController
{
    protected $module;
    protected $path;
    protected $title;
    protected $memberModel;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Member";
        $this->title = "Daftar Member";
        $this->memberModel = new \App\Models\MemberModel();
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        $data = [
            "title"     => $this->title,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "",
        ];
        return view($this->path . '/' . $this->module, $data);
    }


    public function Add()
    {
        $data['title'] = 'Data Admin';
        $data = [
            "title"     => $this->title,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "Add",
        ];
        return view($this->path . '/' . $this->module, $data);
    }

    public function Edit()
    {
        $data['title'] = 'Data Admin';
        $data = [
            "title"     => $this->title,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "Edit",
        ];
        return view($this->path . '/' . $this->module, $data);
    }



    public function getShowData()
    {
        $start = (int) $this->request->getVar('start');
        $length = (int) $this->request->getVar('length');
        $search = $this->request->getVar('search')['value'];
        $order = $this->request->getVar('order');

        $data = [];
        $dataTable = $this->memberModel->getData($search, $order);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = $result->no_pendaftaran;
            $row[] = $result->NISN;
            $row[] = $result->nama;
            $row[] = date("d/m/Y", strtotime($result->tgl_lahir));

            $btnEdit = "<a href='" . site_url()  . strtolower($this->module) . "/edit/" . $result->id_pendaftaran . "' type='button' class='btn btn-warning text-white btn-sm'><i class='fa fa-edit'></i></a>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm' id='delete' data-id='" . $result->id_pendaftaran . "'><i class='fa fa-trash-alt'></i></button>";
            $row[] = "<div class='btn-group'>$btnEdit $btnDelete</div>";
            $data[] = $row;
        }

        $countFilter = $dataTable->countAllResults();
        $output = [
            "draw"              => $this->request->getPost('draw'),
            "recordsTotal"      => $countFilter,
            "recordsFiltered"   => $countFilter,
            "data"              => $data
        ];
        return $this->response->setJSON(json_encode($output));
    }


    public function InsertData() {}
    public function UpdateData() {}
    public function DeleteData() {}
}
