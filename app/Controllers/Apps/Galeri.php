<?php

namespace App\Controllers\Apps;


use App\Controllers\BaseController;

class Galeri extends BaseController
{
    protected $module;
    protected $path;
    protected $title;
    protected $galeriModel;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Galeri";
        $this->title = "Daftar Galeri";
        $this->galeriModel = new \App\Models\GaleriModel();
    }

    public function index()
    {
        $data['title'] = 'Data Galeri';
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
        $dataTable = $this->galeriModel->getData($search, $order);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = $result->nama_foto;
            $row[] = '<img src="' . base_url('images/' . $result->foto_galeri) . '" width="100" height="100" class="img-thumbnail">';

            // $row[] = $result->foto_galeri;

            $btnEdit = "<button type='button' class='btn btn-warning text-white btn-sm tombol_editData' id='edit' data-id='" . $result->id_foto . "'><i class='fa fa-edit'></i></button>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm tombol_deletData' id='delete' data-id='" . $result->id_foto . "'><i class='fa fa-trash-alt'></i></button>";
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

    public function getById($id_foto)
    {
        $data = $this->galeriModel->find($id_foto);

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
            $file = $this->request->getFile('foto_galeri');

            $valid = $this->validate([

                'nama_foto'    => [
                    'rules'        => 'required|min_length[3]',
                    'errors'       => [
                        'required'      => 'Nama foto wajib diisi.',
                        'min_length'    => 'Nama foto harus memiliki minimal 3 karakter.'
                    ]
                ],

                'foto_galeri'  => [
                    'rules'       => 'uploaded[foto_galeri]|is_image[foto_galeri]|mime_in[foto_galeri,image/jpg,image/jpeg,image/png]|max_size[foto_galeri,2048]',
                    'errors'      => [
                        'uploaded'      => 'Silakan pilih gambar terlebih dahulu.',
                        'is_image'      => 'File yang diunggah harus berupa gambar.',
                        'mime_in'       => 'Format gambar harus JPG, JPEG, atau PNG.',
                        'max_size'      => 'Ukuran gambar maksimal 2MB.'
                    ]
                ],
            ]);

            if (!$valid) {
                $respond = [
                    "rcode"        => "11",
                    "errors" => [
                        'nama_foto'    => $validation->getError('nama_foto'),
                        'foto_galeri'      => $validation->getError('foto_galeri'),
                    ],
                    "message"      => "Data gagal tersimpan",
                ];
                return $this->response->setJSON($respond);
            } else if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('images', $newName);

                $simpandata = [
                    'nama_foto'   => $this->request->getVar('nama_foto'),
                    'foto_galeri' => $newName,
                ];

                $this->galeriModel->insert($simpandata);

                return $this->response->setJSON([
                    "rcode"  => "00",
                    "message" => "Data berhasil tersimpan",
                ]);
            }
        }
    }

    public function UpdateData()
    {
        if ($this->request->isAJAX()) {

            $id_foto = $this->request->getVar('id_foto_edit');
            $nama_foto = $this->request->getVar('nama_foto_edit');
            $file = $this->request->getFile('foto_galeri_edit');


            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_foto_edit'    => [
                    'rules'        => 'required|min_length[3]',
                    'errors'       => [
                        'required'      => 'Nama foto wajib diisi.',
                        'min_length'    => 'Nama foto harus memiliki minimal 3 karakter.'
                    ]
                ],

                'foto_galeri_edit'  => [
                    'rules'       => 'permit_empty|is_image[foto_galeri]|mime_in[foto_galeri,image/jpg,image/jpeg,image/png]|max_size[foto_galeri,2048]',
                    'errors'      => [
                        'is_image'      => 'File yang diunggah harus berupa gambar.',
                        'mime_in'       => 'Format gambar harus JPG, JPEG, atau PNG.',
                        'max_size'      => 'Ukuran gambar maksimal 2MB.'
                    ]
                ],
            ]);

            if (!$valid) {
                return $this->response->setJSON([
                    "rcode"   => "11",
                    "errors"  => $validation->getErrors(),
                    "message" => "Data gagal tersimpan",
                ]);
            }

            $oldData = $this->galeriModel->find($id_foto);
            $oldFile = $oldData['foto_galeri'];

            if ($file->isValid() && !$file->hasMoved()) {
                if ($oldFile && file_exists('images/' . $oldFile)) {
                    unlink('images/' . $oldFile);
                }

                $newFileName = $file->getRandomName();
                $file->move('images', $newFileName);
            } else {
                $newFileName = $oldFile;
            }

            $data = [
                'nama_foto' => $nama_foto,
                'foto_galeri' => $newFileName,
            ];

            $this->galeriModel->update($id_foto, $data);

            return $this->response->setJSON([
                "rcode"  => "00",
                "message" => "Data berhasil tersimpan",
            ]);
        }
    }


    public function DeleteData()
    {
        if ($this->request->isAJAX()) {
            $id_foto = $this->request->getPost('id_foto');


            $delete = $this->galeriModel->delete($id_foto);

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
            return redirect()->to('/admin');
        }
    }
};
