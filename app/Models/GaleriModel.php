<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tbl_galeri';
    protected $primaryKey = 'id_foto';
    protected $allowedFields = ['nama_foto', 'foto_galeri'];


    function getData($search, $order)
    {
        $columnOrder = [null, 'nama_foto', 'foto_galeri'];
        $orderDefault = ['nama_foto' => 'DESC'];

        $this->select("tbl_galeri.*");

        $where = "";
        if ($search <> "") {
            $where .= " (nama_foto like '%$search%'";
            $where .= " OR username like '%$search%'";
            $where .= " OR level like '%$search%')";
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
