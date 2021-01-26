<section>
        <div class="container">
		<div class="row">
			<div class="col-lg-12">
			<a class="btn btn-success" href="?page=add-user"><i class="icon-plus"></i> Add User</a>
			</div>
        </div>
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> User List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Nama Usaha</th>
                                            <th>Username</th>
                                            <th>Telp</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
if ($_SESSION['level']=='adminsp')
{        $query = mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM tab_user LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser ORDER BY tab_user.id ASC ");
} else { $query = mysql_query("SELECT * FROM tab_user WHERE level !='adminsp' ORDER BY id ASC ");
}
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		    <td><?php echo $data['fullname']; ?></td>
		    <td><?php echo $data['perusahaan']; ?></td>
        	<td><?php echo $data['username']; ?></td>
        	<td><?php echo $data['no_tlp']; ?></td>
			<td><?php echo $data['kotab']; ?></td>
			<td><?php echo $data['provi']; ?></td>
        	<td><?php $level = $data['level'];
			switch ($level){
			case $level == 'adminsp' : echo '<span class="label label-danger label-mini">Admin Super</span>';
			break;
			case $level == 'admin' : echo '<span class="label label-danger label-mini">Admin</span>';
			break;
			case $level == 'ksgrosir' : echo '<span class="label label-primary label-mini">Kasir Grosir</span>';
			break;
			case $level == 'minimart' : echo '<span class="label label-success label-mini">Kasir Counter</span>';
			break;
			case $level == 'gudang' : echo '<span class="label label-info label-mini">Gudang</span>';
			break;
			case $level == 'kurir' : echo '<span class="label label-default label-mini">Delivery</span>';
			break;
			case $level == 'sales' : echo '<span class="label label-warning label-mini">Sales</span>';
			break;
			case $level == 'hsales' : echo '<span class="label label-info label-mini">Head Sales</span>';
			}?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=user-list&act=edit&id=<?php echo $data['id']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=user-list&act=delete&id=<?php echo $data['id']; ?>"><i class="icon-trash "></i></a>
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>