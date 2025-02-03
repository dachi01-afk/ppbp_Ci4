<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'tbl_register';
    protected $primaryKey = 'id_register';
    protected $allowedFields = ['NISN', 'nama', 'username', 'password'];


    function getData($search, $order)
    {
        $columnOrder = [null, 'NISN', 'nama', 'username', null];
        $orderDefault = ['NISN' => 'DESC'];

        $this->select("tbl_register.*");

        $where = "";
        if ($search <> "") {
            $where .= " (";
            $where .= " NISN like '%$search%'";
            $where .= " OR nama like '%$search%'";
            $where .= " OR username like '%$search%'";
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
