<?php

namespace App\Controllers\Apps;


use App\Controllers\BaseController;

class Pendaftar extends BaseController
{
    protected $module;
    protected $modulelulus;
    protected $moduletidaklulus;
    protected $path;
    protected $title;
    protected $titleL;
    protected $titleTL;
    protected $pendaftarModel;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Pendaftar";
        $this->title = "Data Pendaftar";

        $this->modulelulus = "SiswaLulus";
        $this->titleL = "Data Siswa Lulus";

        $this->moduletidaklulus = "SiswaTidakLulus";
        $this->titleTL = "Data Siswa Tidak Lulus";

        $this->pendaftarModel = new \App\Models\PendaftarModel();
    }

    public function index()
    {

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
        $dataTable = $this->pendaftarModel->getData($search, $order,);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = $result->NISN;
            $row[] = $result->nama;
            $row[] = date("d/m/Y", strtotime($result->tgl_lahir));
            $row[] = $result->asal_sekolah;
            $row[] = '<img src="' . base_url('images/PasFoto/' . $result->pas_foto) . '" width="100" height="100" class="img-thumbnail">';

            $row[] = '<select class="form-control status-dropdown" data-id="' . $result->id_pendaftaran . '">
                        <option value="menunggu_verifikasi" ' . ($result->konfirmasi_status == 'menunggu_verifikasi' ? 'selected' : '') . '>Menunggu Verifikasi</option>
                        <option value="lulus" ' . ($result->konfirmasi_status == 'lulus' ? 'selected' : '') . '>Lulus</option>
                        <option value="tidak_lulus" ' . ($result->konfirmasi_status == 'tidak_lulus' ? 'selected' : '') . '>Tidak Lulus</option>
                    </select>';

            $row[] = "<button type='button' class='btn btn-info btn-sm tombol_detailData' id='detail' data-id='" . $result->id_pendaftaran . "'><i class='fa-solid fa-eye'></i></button>";

            $btnEdit = "<button type='button' class='btn btn-warning text-white btn-sm tombol_editData' id='edit' data-id='" . $result->id_pendaftaran . "'><i class='fa fa-edit'></i></button>";
            $btnDelete = "<button type='button' class='btn btn-danger btn-sm tombol_deletData' id='delete' data-id='" . $result->id_pendaftaran . "'><i class='fa fa-trash-alt'></i></button>";
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

    public function Lulus()
    {
        $data['title'] = 'Data Siswa Lulus';
        $data = [
            "title"     => $this->titleL,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "",
        ];
        return view($this->path . '/' . $this->modulelulus, $data);
    }

    public function Tidaklulus()
    {
        $data['title'] = 'Data Siswa Tidak Lulus';
        $data = [
            "title"     => $this->titleTL,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "",
        ];
        return view($this->path . '/' . $this->moduletidaklulus, $data);
    }

    public function getShowDataLulus()
    {
        return $this->getShowDataByStatus('lulus');
    }

    public function getShowDataTidakLulus()
    {
        return $this->getShowDataByStatus('tidak_lulus');
    }

    public function getShowDataByStatus($konfirmasi_status)
    {
        $start = (int) $this->request->getVar('start');
        $length = (int) $this->request->getVar('length');
        $search = $this->request->getVar('search')['value'];
        $order = $this->request->getVar('order');

        $data = [];
        $dataTable = $this->pendaftarModel->getByStatus($konfirmasi_status, $search, $order);
        foreach ($dataTable->limit($length, $start)->get()->getResult() as $result) {
            $row = [];
            $start++;
            $row[] = '<div class="text-center">' . $start . '</div>';

            $row[] = $result->NISN;
            $row[] = $result->nama;
            $row[] = date("d/m/Y", strtotime($result->tgl_lahir));
            $row[] = $result->asal_sekolah;
            $row[] = '<img src="' . base_url('images/Pasfoto/' . $result->pas_foto) . '" width="100" height="100" class="img-thumbnail">';

            $row[] = "<button type='button' class='btn btn-info btn-sm tombol_detailData' id='detail' data-id='" . $result->id_pendaftaran . "'><i class='fa-solid fa-eye'></i></button>";
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

    public function getById($id_pendaftaran)
    {
        $data = $this->pendaftarModel->find($id_pendaftaran);

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

    public function updateStatus()
    {
        $id_pendaftaran = $this->request->getPost('id_pendaftaran');
        $konfirmasi_status = $this->request->getPost('konfirmasi_status');

        if (!in_array($konfirmasi_status, ['menunggu_verifikasi', 'lulus', 'tidak_lulus'])) {
            return $this->response->setJSON([
                'rcode' => '01',
                'message' => 'Status tidak valid'
            ]);
        }

        $this->pendaftarModel->update($id_pendaftaran, ['konfirmasi_status' => $konfirmasi_status]);

        return $this->response->setJSON([
            'rcode' => '00',
            'message' => 'Status berhasil diperbarui!'
        ]);
    }


    // public function InsertData()
    // {
    //     if ($this->request->isAJAX()) {

    //         $validation = \Config\Services::validation();
    //         $file = $this->request->getFile('foto_galeri');

    //         $valid = $this->validate([

    //             'nama_foto'    => [
    //                 'rules'        => 'required|min_length[3]',
    //                 'errors'       => [
    //                     'required'      => 'Nama foto wajib diisi.',
    //                     'min_length'    => 'Nama foto harus memiliki minimal 3 karakter.'
    //                 ]
    //             ],

    //             'foto_galeri'  => [
    //                 'rules'       => 'uploaded[foto_galeri]|is_image[foto_galeri]|mime_in[foto_galeri,image/jpg,image/jpeg,image/png]|max_size[foto_galeri,2048]',
    //                 'errors'      => [
    //                     'uploaded'      => 'Silakan pilih gambar terlebih dahulu.',
    //                     'is_image'      => 'File yang diunggah harus berupa gambar.',
    //                     'mime_in'       => 'Format gambar harus JPG, JPEG, atau PNG.',
    //                     'max_size'      => 'Ukuran gambar maksimal 2MB.'
    //                 ]
    //             ],
    //         ]);

    //         if (!$valid) {
    //             $respond = [
    //                 "rcode"        => "11",
    //                 "errors" => [
    //                     'nama_foto'    => $validation->getError('nama_foto'),
    //                     'foto_galeri'      => $validation->getError('foto_galeri'),
    //                 ],
    //                 "message"      => "Data gagal tersimpan",
    //             ];
    //             return $this->response->setJSON($respond);
    //         }

    //         if ($file && $file->isValid() && !$file->hasMoved()) {
    //             $newName = $file->getRandomName();
    //             $file->move('images', $newName);

    //             $simpandata = [
    //                 'nama_foto'   => $this->request->getVar('nama_foto'),
    //                 'foto_galeri' => $newName,
    //             ];

    //             $this->pendaftarModel->insert($simpandata);

    //             return $this->response->setJSON([
    //                 "rcode"  => "00",
    //                 "message" => "Data berhasil tersimpan",
    //             ]);
    //         }
    //     }
    // }

    public function UpdateData()
    {
        if ($this->request->isAJAX()) {

            $id_pendaftaran = $this->request->getVar('id_pendaftaran_edit');
            $nama = $this->request->getVar('nama_edit');
            $tempat_lahir = $this->request->getVar('tempat_lahir_edit');
            $tgl_lahir = $this->request->getVar('tgl_lahir_edit');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin_edit');
            $agama = $this->request->getVar('agama_edit');
            $asal_sekolah = $this->request->getVar('asal_sekolah_edit');
            $nm_ayah = $this->request->getVar('nm_ayah_edit');
            $nm_ibu = $this->request->getVar('nm_ibu_edit');
            $pekerjaan = $this->request->getVar('pekerjaan_edit');

            $bahasa_indonesia = $this->request->getVar('bahasa_indonesia_edit');
            $ipa = $this->request->getVar('ipa_edit');
            $matematika = $this->request->getVar('matematika_edit');
            $bahasa_inggris = $this->request->getVar('bahasa_inggris_edit');

            $alamat = $this->request->getVar('alamat_edit');
            $no_tlp = $this->request->getVar('no_tlp_edit');

            $file_pas_foto = $this->request->getFile('pas_foto_edit');
            $file_skhu = $this->request->getFile('foto_skhu_edit');


            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_edit'    => [
                    'label'        => 'Nama Lengkap',
                    'rules'        => 'required|min_length[3]|max_length[100]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => '{field} harus memiliki minimal 3 karakter.',
                        'max_length'    => '{field} harus memiliki maksimal 100 karakter.',
                    ]
                ],
                'tempat_lahir_edit'    => [
                    'label'        => 'Tempat Lahir',
                    'rules'        => 'required|min_length[3]|max_length[50]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => '{field} harus memiliki minimal 3 karakter.',
                        'max_length'    => '{field} harus memiliki maksimal 50 karakter.',
                    ]
                ],
                'tgl_lahir_edit'    => [
                    'label'        => 'Tanggal Lahir',
                    'rules'        => 'required|valid_date',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'valid_date'    => '{field} tidak valid!
                        ',
                    ]
                ],
                'jenis_kelamin_edit'    => [
                    'label'        => 'Jenis Kelamin',
                    'rules'        => 'required',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                    ]
                ],
                'agama_edit'    => [
                    'label'        => 'Agama',
                    'rules'        => 'required',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                    ]
                ],
                'asal_sekolah_edit'    => [
                    'label'        => 'Asal Sekolah',
                    'rules'        => 'required|min_length[3]|max_length[100]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => 'Nama Sekolah minimal 3 karakter.',
                        'max_length'    => 'Nama Sekolah maksimal 100 karakter.',
                    ]
                ],
                'nm_ayah_edit'    => [
                    'label'        => 'Nama Ayah',
                    'rules'        => 'required|min_length[3]|max_length[100]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => '{field}  minimal 3 karakter.',
                        'max_length'    => '{field}  maksimal 100 karakter.',
                    ]
                ],
                'nm_ibu_edit'    => [
                    'label'        => 'Nama Ibu',
                    'rules'        => 'required|min_length[3]|max_length[100]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => '{field}  minimal 3 karakter.',
                        'max_length'    => '{field}  maksimal 100 karakter.',
                    ]
                ],
                'pekerjaan_edit'    => [
                    'label'        => 'Pekerjaan Orang Tua',
                    'rules'        => 'required|min_length[3]|max_length[100]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => 'Pekerjaan minimal 3 karakter.',
                        'max_length'    => 'Pekerjaan maksimal 100 karakter.',
                    ]
                ],
                'bahasa_indonesia_edit'    => [
                    'label'        => 'Nilai',
                    'rules'        => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                    'errors'       => [
                        'required'                 => '{field} Bahasa Indonesia wajib diisi.',
                        'integer'                  => '{field} harus berupa angka',
                        'greater_than_equal_to'    => '{field} minimal 0.',
                        'less_than_equal_to'       => '{field} maksimal 100.',
                    ]
                ],
                'ipa_edit'    => [
                    'label'        => 'Nilai',
                    'rules'        => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                    'errors'       => [
                        'required'                 => '{field} Ipa wajib diisi.',
                        'integer'                  => '{field} harus berupa angka',
                        'greater_than_equal_to'    => '{field} minimal 0.',
                        'less_than_equal_to'       => '{field} maksimal 100.',
                    ]
                ],
                'matematika_edit'    => [
                    'label'        => 'Nilai',
                    'rules'        => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                    'errors'       => [
                        'required'                 => '{field} Matematika wajib diisi.',
                        'integer'                  => '{field} harus berupa angka',
                        'greater_than_equal_to'    => '{field} minimal 0.',
                        'less_than_equal_to'       => '{field} maksimal 100.',
                    ]
                ],
                'bahasa_inggris_edit'    => [
                    'label'        => 'Nilai',
                    'rules'        => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
                    'errors'       => [
                        'required'                 => '{field} Bahasa Inggris wajib diisi.',
                        'integer'                  => '{field} harus berupa angka',
                        'greater_than_equal_to'    => '{field} minimal 0.',
                        'less_than_equal_to'       => '{field} maksimal 100.',
                    ]
                ],
                'alamat_edit'    => [
                    'label'        => 'Alamat',
                    'rules'        => 'required|min_length[5]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'min_length'    => '{field} minimal 5 karakter.',
                    ]
                ],
                'no_tlp_edit'    => [
                    'label'        => 'Nomor Telepon',
                    'rules'        => 'required|numeric|min_length[8]|max_length[15]',
                    'errors'       => [
                        'required'      => '{field} wajib diisi.',
                        'numeric'       => '{field} harus berupa angka.',
                        'min_length'    => '{field} minimal 8 karakter.',
                        'max_length'    => '{field} maksimal 15 karakter.',
                    ]
                ],

                'pas_foto_edit'  => [
                    'rules'       => 'permit_empty|is_image[pas_foto]|mime_in[pas_foto,image/jpg,image/jpeg,image/png]|max_size[pas_foto,2048]',
                    'errors'      => [
                        'is_image'      => 'File yang diunggah harus berupa gambar.',
                        'mime_in'       => 'Format gambar harus JPG, JPEG, atau PNG.',
                        'max_size'      => 'Ukuran gambar maksimal 2MB.'
                    ]
                ],

                'foto_skhu_edit'  => [
                    'rules'       => 'permit_empty|is_image[foto_skhu]|mime_in[foto_skhu,image/jpg,image/jpeg,image/png]|max_size[foto_skhu,2048]',
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

            $oldData = $this->pendaftarModel->find($id_pendaftaran);
            $oldFile = $oldData['pas_foto'];
            if ($file_pas_foto->isValid() && !$file_pas_foto->hasMoved()) {
                $mimeType = $file_pas_foto->getMimeType();
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return $this->response->setJSON([
                        "rcode" => "11",
                        "errors" => ["pas_foto_edit" => "File yang diunggah tidak valid."],
                        "message" => "Gagal menyimpan data karena format file tidak sesuai."
                    ]);
                }
                if ($oldFile && file_exists('images/PasFoto/' . $oldFile)) {
                    unlink('images/PasFoto/' . $oldFile);
                }

                $newFileName2 = $file_pas_foto->getRandomName();
                $file_pas_foto->move('images/PasFoto/', $newFileName2);
            } else {
                $newFileName2 = $oldFile;
            }

            $oldData = $this->pendaftarModel->find($id_pendaftaran);
            $oldFile = $oldData['foto_skhu'];
            if ($file_skhu->isValid() && !$file_skhu->hasMoved()) {
                $mimeType = $file_skhu->getMimeType();
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return $this->response->setJSON([
                        "rcode" => "11",
                        "errors" => ["foto_skhu_edit" => "File yang diunggah tidak valid."],
                        "message" => "Gagal menyimpan data karena format file tidak sesuai."
                    ]);
                }
                if ($oldFile && file_exists('images/FotoSKHU/' . $oldFile)) {
                    unlink('images/FotoSKHU/' . $oldFile);
                }

                $newFileName1 = $file_skhu->getRandomName();
                $file_skhu->move('images/FotoSKHU/', $newFileName1);
            } else {
                $newFileName1 = $oldFile;
            }

            $data = [
                'nama'              => $nama,
                'tempat_lahir'      => $tempat_lahir,
                'tgl_lahir'         => $tgl_lahir,
                'jenis_kelamin'     => $jenis_kelamin,
                'agama'             => $agama,
                'asal_sekolah'      => $asal_sekolah,
                'nm_ayah'           => $nm_ayah,
                'nm_ibu'            => $nm_ibu,
                'pekerjaan'         => $pekerjaan,
                'bahasa_indonesia'  => $bahasa_indonesia,
                'ipa'               => $ipa,
                'matematika'        => $matematika,
                'bahasa_inggris'    => $bahasa_inggris,
                'alamat'            => $alamat,
                'no_tlp'            => $no_tlp,

                'pas_foto'          => $newFileName2,
                'foto_skhu'         => $newFileName1,
            ];

            $this->pendaftarModel->update($id_pendaftaran, $data);

            return $this->response->setJSON([
                "rcode"  => "00",
                "message" => "Data berhasil tersimpan",
            ]);
        }
    }


    public function DeleteData()
    {
        if ($this->request->isAJAX()) {
            $id_pendaftaran = $this->request->getPost('id_pendaftaran');


            $delete = $this->pendaftarModel->delete($id_pendaftaran);

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
            return redirect()->to('/pendaftar');
        }
    }
};
