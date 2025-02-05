<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftarModel extends Model
{
    protected $table = 'tbl_pendaftar';
    protected $primaryKey = 'id_pendaftaran';

    protected $allowedFields = [
        'id_register',
        'no_pendaftaran',
        'tgl_daftar',
        'NISN',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'nm_ayah',
        'nm_ibu',
        'pekerjaan',
        'bahasa_indonesia',
        'ipa',
        'matematika',
        'bahasa_inggris',
        'pas_foto',
        'foto_skhu',
        'alamat',
        'no_tlp',
        'konfirmasi_status',
    ];


    function getData($search, $order)
    {
        $columnOrder = [null, 'NISN', 'nama', 'tgl_lahir', 'asal_sekolah', 'pas_foto', null];
        $orderDefault = ['NISN' => 'DESC'];

        $this->select("tbl_pendaftar.*");

        $where = "";
        if ($search <> "") {
            $where .= " (";
            $where .= " NISN like '%$search%'";
            $where .= " OR nama like '%$search%'";
            $where .= " OR tgl_lahir like '%$search%'";
            $where .= " OR asal_sekolah like '%$search%'";
            $where .= " )";
        }

        if ($where <> "") {
            $this->where($where);
        }

        if ($order['0']['column'] == 0) {
            $this->orderBy(key($orderDefault), $orderDefault[key($orderDefault)]);
        } else {
            $this->orderBy($columnOrder[$order['0']['column']], $order['0']['dir']);
        }
        return $this;
    }

    public function getByStatus($konfirmasi_status, $search, $order)
    {
        $columnOrder = [null, 'NISN', 'nama', 'tgl_lahir', 'asal_sekolah', 'pas_foto', null];
        $orderDefault = ['NISN' => 'DESC'];

        $this->select("tbl_pendaftar.*");
        $this->where("konfirmasi_status", $konfirmasi_status);

        if (!empty($search)) {
            $this->groupStart()
                ->like("NISN", $search)
                ->orLike("nama", $search)
                ->orLike("tgl_lahir", $search)
                ->orLike("asal_sekolah", $search)
                ->groupEnd();
        }

        if (!isset($order[0]['column']) || $order[0]['column'] == 0) {
            $this->orderBy(key($orderDefault), $orderDefault[key($orderDefault)]);
        } else {
            $this->orderBy($columnOrder[$order[0]['column']], $order[0]['dir']);
        }

        return $this;
    }
}
