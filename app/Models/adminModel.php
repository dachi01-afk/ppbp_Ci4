<?php

namespace App\Models;

use CodeIgniter\Model;

class adminModel extends Model
{
    protected $table = 'tbl_admin';
    protected $id    = 'id_admin';
    protected $allowedFields = ['nama_admin', 'username', 'password', 'level'];
}
