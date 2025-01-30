<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nama_admin', 'username', 'password', 'level'];


    function getData($search, $order)
    {
        $columnOrder = [null, 'nama_admin', 'username', 'level', null];
        $orderDefault = ['nama_admin' => 'DESC'];

        $this->select("tbl_admin.*");

        $where = "";
        if ($search <> "") {
            $where .= " (nama_admin like '%$search%'";
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
