<?php

namespace App\Controllers;

use App\Models\adminModel;

class Admin extends BaseController
{
    protected $adminModel;
    protected $module;

    function __construct()
    {
        $this->module = "Admin";
        $this->adminModel = new \App\Models\AdminModel();
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        return view('Admin/Admin', $data);
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

            $btnEdit = "<a href='" . site_url()  . strtolower($this->module) . "/edit/" . $result->id_admin . "' type='button' class='btn btn-warning text-white btn-sm'><i class='fa fa-edit'></i></a>";
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

    public function getDataAdmin()
    {

        if ($this->request->isAJAX()) {
            $model = new adminModel;
            $data = ['getAdmin' => $model->findAll()];

            try {
                $msg = [
                    'status' => 'success',
                    'data' => view('Admin/tabelDataAdmin', $data)
                ];
            } catch (\Exception $e) {
                $msg = [
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat di proses');
        }
    }

    public function Add()
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

    public function simpanData()
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
                $msg = [
                    'error' => [
                        'nama_admin'    => $validation->getError('nama_admin'),
                        'username'      => $validation->getError('username'),
                        'password'      => $validation->getError('password'),
                        'level'         => $validation->getError('level'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_admin' => $this->request->getVar('nama_admin'),
                    'username'   => $this->request->getVar('username'),
                    'password'   => $this->request->getVar('password'),
                    'level'      => $this->request->getVar('level')
                ];

                $model = new adminModel;

                $model->insert($simpandata);

                $msg = [
                    'sukses' => 'Data Admin berhasi tersimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf dapat tidak di proses');
        }
    }

    public function formEditData()
    {
        if ($this->request->isAJAX()) {
            $id_admin = $this->request->getVar('id_admin');

            $model = new adminModel;
            $row = $model->find($id_admin);

            $data = [
                'nama_admin' => $row['nama_admin'],
                'username'   => $row['username'],
                'password'   => $row['password'],
                'level'      => $row['level'],
            ];

            $msg = [
                'sukses' => view('Admin/formEditData', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updateData()
    {
        if ($this->request->isAJAX()) {

            // $validation = \Config\Services::validation();

            // $valid = $this->validate([

            //     'nama_admin' => [
            //         'label'     => 'Nama Admin',
            //         'rules'     => 'required|min_length[3]|alpha_space|max_length[50]',
            //         'errors'    => [
            //             'required'      => '{field} tidak boleh kosong.',
            //             'min_length'    => '{field} minimal 3 karakter.',
            //             'alpha_space'   => '{field} hanya boleh berisi huruf dan spasi.',
            //             'max_length'    => '{field} maksimal 50 karakter.'
            //         ]
            //     ],

            //     'username' => [
            //         'label'     => 'Username',
            //         'rules'     => 'required|is_unique[tbl_admin.username, $id_admin]|min_length[5]|alpha_numeric|max_length[20]',
            //         'errors'    => [
            //             'required'      => '{field} harus diisi.',
            //             'is_unique'     => '{field} sudah digunakan.',
            //             'min_length'    => '{field} minimal 5 karakter.',
            //             'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka.',
            //             'max_length'    => '{field} maksimal 20 karakter.',
            //         ]
            //     ],

            //     'password' => [
            //         'label'     => 'Password',
            //         'rules'     => 'required|min_length[8]',
            //         'errors'    => [
            //             'required' => '{field} harus diisi.',
            //             'min_length' => '{field} minimal 8 karakter.',
            //         ]
            //     ],

            //     'level' => [
            //         'label'     => 'Jabatan',
            //         'rules'     => 'required',
            //         'errors'    => [
            //             'required'      => '{field} tidak boleh kosong.',
            //         ]
            //     ],
            // ]);

            // if (!$valid) {
            //     $msg = [
            //         'error' => [
            //             'nama_admin'    => $validation->getError('nama_admin'),
            //             'username'      => $validation->getError('username'),
            //             'password'      => $validation->getError('password'),
            //             'level'         => $validation->getError('level'),
            //         ]
            //     ];
            // } else {
            $simpandata = [
                'nama_admin' => $this->request->getVar('nama_admin'),
                'username'   => $this->request->getVar('username'),
                'password'   => $this->request->getVar('password'),
                'level'      => $this->request->getVar('level')
            ];

            $model = new adminModel;
            $id_admin = $this->request->getVar('id_admin');

            $model->update($id_admin, $simpandata);

            $msg = [
                'sukses' => 'Data Admin berhasi di Update'
            ];
            // }
            echo json_encode($msg);
        } else {
            exit('Maaf dapat tidak di proses');
        }
    }
}
