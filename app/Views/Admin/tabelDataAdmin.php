 <table id="tableDataAdmin" class="table table-bordered table-striped">
     <thead>
         <tr>
             <th>No</th>
             <th>Nama Admin</th>
             <th>Username</th>
             <th>Password</th>
             <th>Jabatan</th>
             <th>Aksi</th>
         </tr>
     </thead>
     <tbody>
         <?php $no = 1;
            foreach ($getAdmin as $dtAdmin): ?>
             <tr>
                 <td><?= $no ?></td>
                 <td><?= $dtAdmin['nama_admin']; ?></td>
                 <td><?= $dtAdmin['username']; ?></td>
                 <td><?= $dtAdmin['password']; ?></td>
                 <td><?= $dtAdmin['level']; ?></td>
                 <td>X</td>
             </tr>
         <?php $no++;
            endforeach ?>
     </tbody>
 </table>

 <script>
     $(document).ready(function() {
         // Table data
         $("#tableDataAdmin").DataTable({
             "responsive": true,
             "lengthChange": false,
             "autoWidth": false,
         })

     })
 </script>