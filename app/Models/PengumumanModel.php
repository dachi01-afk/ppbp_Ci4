<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'tbl_pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $allowedFields = ['tgl_pengumuman', 'judul_pengumuman', 'isi_pengumuman', 'foto_pengumuman'];


    function getData($search, $order)
    {
        $columnOrder = [null, 'tgl_pengumuman', 'judul_pengumuman', 'isi_pengumuman', 'foto_pengumuman', null];
        $orderDefault = ['tgl_pengumuman' => 'DESC'];

        $this->select("tbl_pengumuman.*");

        $where = "";
        if ($search <> "") {
            $where .= " (";
            $where .= " tgl_pengumuman like '%$search%'";
            $where .= " OR judul_pengumuman like '%$search%'";
            $where .= " OR isi_pengumuman like '%$search%'";
            $where .= " OR foto_pengumuman like '%$search%'";
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
}
