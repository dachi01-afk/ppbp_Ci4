<?php

namespace App\Controllers\Apps;


use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $module;
    protected $path;
    protected $title;
    protected $adminModel;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Admin";
        $this->title = "Daftar User Admin";
        $this->adminModel = new \App\Models\AdminModel();
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
        $dataTable = $this->adminModel->getData($search, $order);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = $result->nama_admin;
            $row[] = $result->username;
            $row[] = $result->level;

            $btnEdit = "<button type='button' class='btn btn-warning text-white btn-sm tombol_editData' id='edit' data-id='" . $result->id_admin . "'><i class='fa fa-edit'></i></button>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm' id='delete' data-id='" . $result->id_admin . "'><i class='fa fa-trash-alt'></i></button>";
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

    public function getById($id_admin)
    {
        $data = $this->adminModel->find($id_admin);

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


    public function InsertData()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama_admin' => [
                    'label'     => 'Nama Admin',
                    'rules'     => 'required|min_length[3]|alpha_space|max_length[50]',
                    'errors'    => [
                        'required'      => '{field} tidak boleh kosong.',
                        'min_length'    => '{field} minimal 3 karakter.',
                        'alpha_space'   => '{field} hanya boleh berisi huruf dan spasi.',
                        'max_length'    => '{field} maksimal 50 karakter.'
                    ]
                ],

                'username' => [
                    'label'     => 'Username',
                    'rules'     => 'required|is_unique[tbl_admin.username]|min_length[5]|alpha_numeric|max_length[20]',
                    'errors'    => [
                        'required'      => '{field} harus diisi.',
                        'is_unique'     => '{field} sudah digunakan.',
                        'min_length'    => '{field} minimal 5 karakter.',
                        'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka.',
                        'max_length'    => '{field} maksimal 20 karakter.',
                    ]


                ],

                'password' => [
                    'label'     => 'Password',
                    'rules'     => 'required|min_length[8]',
                    'errors'    => [
                        'required' => '{field} harus diisi.',
                        'min_length' => '{field} minimal 8 karakter.',
                    ]
                ],

                'level' => [
                    'label'     => 'Jabatan',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => '{field} tidak boleh kosong.',
                    ]
                ],
            ]);

            if (!$valid) {
                $respond = [
                    "rcode"        => "11",
                    "errors" => [
                        'nama_admin'    => $validation->getError('nama_admin'),
                        'username'      => $validation->getError('username'),
                        'password'      => $validation->getError('password'),
                        'level'         => $validation->getError('level'),
                    ],
                    "message"      => "Data Admin gagal tersimpan",
                ];
                return $this->response->setJSON($respond);
            } else {
                $simpandata = [
                    'nama_admin' => $this->request->getVar('nama_admin'),
                    'username'   => $this->request->getVar('username'),
                    'password'   => $this->request->getVar('password'),
                    'level'      => $this->request->getVar('level')
                ];

                $model = $this->adminModel;

                $model->insert($simpandata);

                $respond = [
                    "rcode"              => "00",
                    "message"      => "Data Admin berhasi tersimpan",
                ];
                return $this->response->setJSON($respond);
            }
            echo json_encode($respond);
        } else {
            exit('Maaf data tidak di proses');
        }
    }
    public function UpdateData($id_admin)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_admin' => 'required|min_length[3]|alpha_space|max_length[50]',
                'username'   => "required|min_length[5]|alpha_numeric|max_length[20]|is_unique[tbl_admin.username,id_admin,{$id_admin}]",
                'level'      => 'required',

                'nama_admin' => [
                    'label'     => 'Nama Admin',
                    'rules'     => 'required|min_length[3]|alpha_space|max_length[50]',
                    'errors'    => [
                        'required'      => '{field} tidak boleh kosong.',
                        'min_length'    => '{field} minimal 3 karakter.',
                        'alpha_space'   => '{field} hanya boleh berisi huruf dan spasi.',
                        'max_length'    => '{field} maksimal 50 karakter.'
                    ]
                ],

                'username' => [
                    'label'     => 'Username',
                    'rules'     => "required|min_length[5]|alpha_numeric|max_length[20]|is_unique[tbl_admin.username,id_admin,{$id_admin}]",
                    'errors'    => [
                        'required'      => '{field} harus diisi.',
                        'is_unique'     => '{field} sudah digunakan.',
                        'min_length'    => '{field} minimal 5 karakter.',
                        'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka.',
                        'max_length'    => '{field} maksimal 20 karakter.',
                    ]
                ],


                'level' => [
                    'label'     => 'Jabatan',
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => '{field} tidak boleh kosong.',
                    ]
                ],
            ]);

            if (!$valid) {
                return $this->response->setJSON([
                    "rcode" => "11",
                    "errors" => $validation->getErrors(),
                    "message" => "Validasi gagal.",
                ]);
            }

            $data = [
                'nama_admin' => $this->request->getVar('nama_admin'),
                'username'   => $this->request->getVar('username'),
                'level'      => $this->request->getVar('level'),
            ];


            if ($this->request->getVar('password')) {
                $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }

            $this->adminModel->update($id_admin, $data);

            return $this->response->setJSON([
                "rcode" => "00",
                "message" => "Data berhasil diperbarui.",
            ]);
        }
    }
    public function DeleteData() {}
}
