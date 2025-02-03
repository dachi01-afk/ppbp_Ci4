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

            $row[] = $result->NISN;
            $row[] = $result->nama;
            $row[] = $result->username;


            $btnEdit = "<button type='button' class='btn btn-warning text-white btn-sm tombol_editData' id='edit' data-id='" . $result->id_register . "'><i class='fa fa-edit'></i></button>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm tombol_deletData' id='delete' data-id='" . $result->id_register . "'><i class='fa fa-trash-alt'></i></button>";
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

    public function getById($id_register)
    {
        $data = $this->memberModel->find($id_register);

        if ($data) {
            return $this->response->setJSON([
                'rcode' => '00',
                'message' => 'Data ditemukan',
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'rcode' => '01',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }


    public function InsertData() {}


    public function UpdateData()
    {

        if ($this->request->isAJAX()) {

            $id_register = $this->request->getPost('id_register');

            if (!$id_register) {
                return $this->response->setJSON([
                    'rcode' => "11",
                    'message' => "ID Admin tidak ditemukan!"
                ]);
            }


            $NISN = $this->request->getPost('NISN_edit');
            $nama = $this->request->getPost('nama_edit');
            $username = $this->request->getPost('username_edit');
            $password = $this->request->getPost('password_edit');

            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'NISN_edit' => [
                    'rules'  => 'required|numeric|exact_length[10]|is_unique[tbl_register.NISN,id_register,' . $id_register . ']',
                    'errors' => [
                        'required'     => 'NISN wajib diisi.',
                        'numeric'      => 'NISN hanya boleh berisi angka.',
                        'exact_length' => 'NISN harus memiliki 10 digit.',
                        'is_unique'    => 'NISN sudah terdaftar oleh user lain.'
                    ]
                ],
                'nama_edit' => [
                    'rules'  => 'required|min_length[3]|max_length[100]',
                    'errors' => [
                        'required'   => 'Nama wajib diisi.',
                        'min_length' => 'Nama minimal 3 karakter.',
                        'max_length' => 'Nama maksimal 100 karakter.'
                    ]
                ],
                'username_edit' => [
                    'rules'  => 'required|min_length[5]|max_length[50]|is_unique[tbl_register.username,id_register,' . $id_register . ']',
                    'errors' => [
                        'required'   => 'Username wajib diisi.',
                        'min_length' => 'Username minimal 5 karakter.',
                        'max_length' => 'Username maksimal 50 karakter.',
                        'is_unique'  => 'Username sudah digunakan oleh user lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $response = [
                    'rcode' => "11",
                    'errors' => $validation->getErrors()
                ];
            } else {

                $model = $this->memberModel->find($id_register);
                $newPassword = ($password) ? password_hash($password, PASSWORD_DEFAULT) : $model['password'];

                $data = [

                    'NISN' => $NISN,
                    'nama' => $nama,
                    'username' => $username,
                    'password' => $newPassword,
                ];

                $this->memberModel->update($id_register, $data);

                $response = [
                    'rcode' => "00",
                    'message' => "Data berhasil diperbarui"
                ];
            }

            return $this->response->setJSON($response);
        }
    }
    public function DeleteData()
    {

        if ($this->request->isAJAX()) {
            $id_register = $this->request->getPost('id_register');

            $delete = $this->memberModel->delete($id_register);

            if ($delete) {
                $response = [
                    'rcode' => '00',
                    'message' => 'Data berhasil dihapus!'
                ];
            } else {
                $response = [
                    'rcode' => '99',
                    'message' => 'Gagal menghapus data!'
                ];
            }
            return $this->response->setJSON($response);
        } else {
            return redirect()->to('/member');
        }
    }
}
