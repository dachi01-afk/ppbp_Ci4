<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'tbl_pendaftar';
    protected $primaryKey = 'id_pendaftaran';
    protected $allowedFields = ['no_pendaftaran', 'NISN', 'nama', 'tgl_lahir'];


    function getData($search, $order)
    {
        $columnOrder = [null, 'no_pendaftaran', 'NISN', 'nama', 'tgl_lahir', null];
        $orderDefault = ['no_pendaftaran' => 'DESC'];

        $this->select("tbl_pendaftar.*");

        $where = "";
        if ($search <> "") {
            $where .= " (no_pendaftaran like '%$search%'";
            $where .= " OR nama like '%$search%'";
            $where .= " OR tgl_lahir like '%$search%')";
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
