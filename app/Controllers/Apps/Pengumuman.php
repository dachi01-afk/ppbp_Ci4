<?php

namespace App\Controllers\Apps;


use App\Controllers\BaseController;

class Pengumuman extends BaseController
{
    protected $module;
    protected $path;
    protected $title;
    protected $pengumumanModel;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Pengumuman";
        $this->title = "Daftar Pengumuman";
        $this->pengumumanModel = new \App\Models\PengumumanModel();
    }

    public function index()
    {
        $data['title'] = 'Data Pengumuman';
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
        $dataTable = $this->pengumumanModel->getData($search, $order);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = date("d/m/Y", strtotime($result->tgl_pengumuman));
            $row[] = $result->judul_pengumuman;
            $row[] = $result->isi_pengumuman;
            $row[] = '<img src="' . base_url('images/Pengumuman/' . $result->foto_pengumuman) . '" width="200" height="200" class="img-thumbnail">';;

            $btnEdit = "<button type='button' class='btn btn-warning text-white btn-sm tombol_editData' id='edit' data-id='" . $result->id_pengumuman . "'><i class='fa fa-edit'></i></button>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm tombol_deletData' id='delete' data-id='" . $result->id_pengumuman . "'><i class='fa fa-trash-alt'></i></button>";
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

    public function getById($id_pengumuman)
    {
        $data = $this->pengumumanModel->find($id_pengumuman);

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
            $file = $this->request->getFile('foto_pengumuman');

            $valid = $this->validate([
                'tgl_pengumuman' => [
                    'rules'  => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required'   => 'Tanggal pengumuman wajib diisi.',
                        'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD).'
                    ]
                ],

                'judul_pengumuman' => [
                    'rules'  => 'required|min_length[5]|max_length[255]',
                    'errors' => [
                        'required'    => 'Judul pengumuman wajib diisi.',
                        'min_length'  => 'Judul pengumuman minimal 5 karakter.',
                        'max_length'  => 'Judul pengumuman maksimal 255 karakter.'
                    ]
                ],

                'isi_pengumuman' => [
                    'rules'  => 'required|min_length[10]',
                    'errors' => [
                        'required'   => 'Isi pengumuman wajib diisi.',
                        'min_length' => 'Isi pengumuman minimal 10 karakter.'
                    ]
                ],

                'foto_pengumuman' => [
                    'rules'  => 'is_image[foto_pengumuman]|mime_in[foto_pengumuman,image/jpg,image/jpeg,image/png]|max_size[foto_pengumuman,2048]',
                    'errors' => [
                        'is_image'  => 'File yang diunggah harus berupa gambar.',
                        'mime_in'   => 'Format gambar harus JPG, JPEG, atau PNG.',
                        'max_size'  => 'Ukuran gambar maksimal 2MB.'
                    ]
                ],
            ]);

            if (!$valid) {
                $respond = [
                    "rcode"        => "11",
                    'errors'       => $validation->getErrors(),
                    "message"      => "Data gagal tersimpan",
                ];
                return $this->response->setJSON($respond);
            }

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('images/Pengumuman', $newName);

                $simpandata = [
                    'tgl_pengumuman'        => $this->request->getVar('tgl_pengumuman'),
                    'judul_pengumuman'      => $this->request->getVar('judul_pengumuman'),
                    'isi_pengumuman'        => $this->request->getVar('isi_pengumuman'),
                    'foto_pengumuman'       => $newName
                ];

                $this->pengumumanModel->insert($simpandata);

                return $this->response->setJSON([
                    "rcode"  => "00",
                    "message" => "Data berhasil tersimpan",
                ]);
            } else {
                exit('Maaf data tidak di proses');
            }
        }
    }

    public function UpdateData()
    {
        if ($this->request->isAJAX()) {

            $id_pengumuman = $this->request->getVar('id_pengumuman_edit');
            $tgl_pengumuman = $this->request->getVar('tgl_pengumuman_edit');
            $judul_pengumuman = $this->request->getVar('judul_pengumuman_edit');
            $isi_pengumuman = $this->request->getVar('isi_pengumuman_edit');
            $file = $this->request->getFile('foto_pengumuman_edit');


            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tgl_pengumuman_edit' => [
                    'rules'  => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required'   => 'Tanggal pengumuman wajib diisi.',
                        'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD).'
                    ]
                ],

                'judul_pengumuman_edit' => [
                    'rules'  => 'required|min_length[5]|max_length[255]',
                    'errors' => [
                        'required'    => 'Judul pengumuman wajib diisi.',
                        'min_length'  => 'Judul pengumuman minimal 5 karakter.',
                        'max_length'  => 'Judul pengumuman maksimal 255 karakter.'
                    ]
                ],

                'isi_pengumuman_edit' => [
                    'rules'  => 'required|min_length[10]',
                    'errors' => [
                        'required'   => 'Isi pengumuman wajib diisi.',
                        'min_length' => 'Isi pengumuman minimal 10 karakter.'
                    ]
                ],

                'foto_pengumuman_edit' => [
                    'rules'  => 'permit_empty|is_image[foto_pengumuman]|mime_in[foto_pengumuman,image/jpg,image/jpeg,image/png]|max_size[foto_pengumuman,2048]',
                    'errors' => [
                        'is_image'  => 'File yang diunggah harus berupa gambar.',
                        'mime_in'   => 'Format gambar harus JPG, JPEG, atau PNG.',
                        'max_size'  => 'Ukuran gambar maksimal 2MB.'
                    ]
                ],
            ]);

            if (!$valid) {
                return $this->response->setJSON([
                    "rcode"   => "11",
                    'errors'  => $validation->getErrors(),
                    "message" => "Data gagal tersimpan",
                ]);
            }

            $oldData = $this->pengumumanModel->find($id_pengumuman);
            $oldFile = $oldData['foto_pengumuman'];

            if ($file->isValid() && !$file->hasMoved()) {
                $mimeType = $file->getMimeType();
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return $this->response->setJSON([
                        "rcode" => "11",
                        "errors" => ["foto_pengumuman_edit" => "File yang diunggah tidak valid."],
                        "message" => "Gagal menyimpan data karena format file tidak sesuai."
                    ]);
                }
                if ($oldFile && file_exists('images/Pengumuman/' . $oldFile)) {
                    unlink('images/Pengumuman/' . $oldFile);
                }

                $newFileName = $file->getRandomName();
                $file->move('images/Pengumuman/', $newFileName);
            } else {
                $newFileName = $oldFile;
            }

            $data = [
                'tgl_pengumuman'    => $tgl_pengumuman,
                'judul_pengumuman'  => $judul_pengumuman,
                'isi_pengumuman'    => $isi_pengumuman,
                'foto_pengumuman'   => $newFileName,
            ];

            $this->pengumumanModel->update($id_pengumuman, $data);

            return $this->response->setJSON([
                "rcode"  => "00",
                "message" => "Data berhasil tersimpan",
            ]);
        }
    }


    public function DeleteData()
    {
        if ($this->request->isAJAX()) {
            $id_pengumuman = $this->request->getPost('id_pengumuman');

            $delete = $this->pengumumanModel->delete($id_pengumuman);

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
            return redirect()->to('/pengumuman');
        }
    }
}
