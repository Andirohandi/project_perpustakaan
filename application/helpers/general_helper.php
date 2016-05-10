<?php 

if(!function_exists('encode')) {
	function encode($text='') {
	
		$encode = base64_encode($text);
		$encode = base64_encode($encode);
		
		return $encode;
	}
}

if(!function_exists('decode')) {
	function decode($text='') {
	
		$decode = base64_decode($text);
		$decode = base64_decode($decode);
		
		return $decode;
	}
}

if( !function_exists('gen_paging')) {
	function gen_paging($page_data = array()) {
		$page_result = '';
		
		$func_name = 'pageLoad';

		$count = 1;
		
		if(isset($page_data['load_func_name'])) {
			if($page_data['load_func_name'])
				$func_name = $page_data['load_func_name'];
		}
		
		if($page_data['count_row'] > 1)
			$count = ceil($page_data['count_row']/$page_data['limit']);
		
		$page_result .= '<ul class="pagination pagination-sm no-margin pull-right">
							<li ' . ( $page_data['current'] == 1 ? 'class="active"' : '' ) . '><a href="javascript:void(0)" ' . ($page_data['current'] == 1 ? '' : 'onclick = "'.$func_name.'(1)"') .' >&laquo; First</a></li>';
		
		$paging_show 	= 3;
		$page_start		= $page_data['current'] - $paging_show;
		$page_start		= $page_start < 1 ? 1 : $page_start;
		
		$page_end		= $page_data['current'] + $paging_show;
		$page_end		= $count > $page_end ? $page_end : $count;
		$page_end		= $count > 1 ? $page_end : 1;
		
		if($page_start > 1)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		for($i=$page_start ; $i<=$page_end; $i++) {
			$page_result .= '<li '.($page_data['current'] == $i ? 'class="active"' : '').'><a href="javascript:void(0)" '.($page_data['current'] == $i ? "" : 'onclick="'.$func_name.'('.$i.')"').'>'.$i.'</a></li>';
			
		}
		
		if($count > $page_end)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		$page_result .= '<li ' . ( $page_data['current'] == $page_end ? 'class="active"' : '' ) . '><a href="javascript:void(0)" onclick = "'.$func_name.'('.$count.')">Last &raquo;</a></li>';
		$page_result .='</ul>';
		
		return $page_result;
	}
}

if( !function_exists('gen_paging_dua')) {
	function gen_paging_dua($page_data = array()) {
		$page_result = '';
		
		$func_name = 'pageLoadModal';

		$count = 1;
		
		if(isset($page_data['load_func_name'])) {
			if($page_data['load_func_name'])
				$func_name = $page_data['load_func_name'];
		}
		
		if($page_data['count_row'] > 1)
			$count = ceil($page_data['count_row']/$page_data['limit']);
		
		$page_result .= '<ul class="pagination pagination-sm no-margin pull-right pagination-flat">
							<li ' . ( $page_data['current'] == 1 ? 'class="active"' : '' ) . '><a href="javascript:void(0)" ' . ($page_data['current'] == 1 ? '' : 'onclick = "'.$func_name.'(1)"') .' >&laquo; First</a></li>';
		
		$paging_show 	= 3;
		$page_start		= $page_data['current'] - $paging_show;
		$page_start		= $page_start < 1 ? 1 : $page_start;
		
		$page_end		= $page_data['current'] + $paging_show;
		$page_end		= $count > $page_end ? $page_end : $count;
		$page_end		= $count > 1 ? $page_end : 1;
		
		if($page_start > 1)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		for($i=$page_start ; $i<=$page_end; $i++) {
			$page_result .= '<li '.($page_data['current'] == $i ? 'class="active"' : '').'><a href="javascript:void(0)" '.($page_data['current'] == $i ? "" : 'onclick="'.$func_name.'('.$i.')"').'>'.$i.'</a></li>';
			
		}
		
		if($count > $page_end)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		$page_result .= '<li ' . ( $page_data['current'] == $page_end ? 'class="active"' : '' ) . '><a href="javascript:void(0)" onclick = "'.$func_name.'('.$count.')">Last &raquo;</a></li>';
		$page_result .='</ul>';
		
		return $page_result;
	}
}

if( !function_exists('gen_paging_front')) {
	function gen_paging_front($page_data = array()) {
		$page_result = '';
		
		$func_name = 'pageLoadFront';

		$count = 1;
		
		if(isset($page_data['load_func_name'])) {
			if($page_data['load_func_name'])
				$func_name = $page_data['load_func_name'];
		}
		
		if($page_data['count_row'] > 1)
			$count = ceil($page_data['count_row']/$page_data['limit']);
		
		$page_result .= '<ul class="pagination pagination-sm no-margin pagination-flat">
							<li ' . ( $page_data['current'] == 1 ? 'class="active"' : '' ) . '><a href="javascript:void(0)" ' . ($page_data['current'] == 1 ? '' : 'onclick = "'.$func_name.'(1)"') .' >&laquo; First</a></li>';
		
		$paging_show 	= 3;
		$page_start		= $page_data['current'] - $paging_show;
		$page_start		= $page_start < 1 ? 1 : $page_start;
		
		$page_end		= $page_data['current'] + $paging_show;
		$page_end		= $count > $page_end ? $page_end : $count;
		$page_end		= $count > 1 ? $page_end : 1;
		
		if($page_start > 1)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		for($i=$page_start ; $i<=$page_end; $i++) {
			$page_result .= '<li '.($page_data['current'] == $i ? 'class="active"' : '').'><a href="javascript:void(0)" '.($page_data['current'] == $i ? "" : 'onclick="'.$func_name.'('.$i.')"').'>'.$i.'</a></li>';
			
		}
		
		if($count > $page_end)
			$page_result .= '<li class="active"><a href="javascript:void(0)">...</a></li>';
		
		$page_result .= '<li ' . ( $page_data['current'] == $page_end ? 'class="active"' : '' ) . '><a href="javascript:void(0)" onclick = "'.$func_name.'('.$count.')">Last &raquo;</a></li>';
		$page_result .='</ul>';
		
		return $page_result;
	}
}

if(!function_exists('getNamaKategori')) {
	function getNamaKategori($id) {
		
		$CI =& get_instance();
		$CI->load->model('m_kategori_buku');

		$query	= $CI->m_kategori_buku->getNamaKtgrById($id);
		
		return ucwords($query['nama_ktgr']);
	}
}

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.'-'.$bulan.'-'.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Agust";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}
}


if(!function_exists('get_select_kategori_buku')) {
	function get_select_kategori_buku($id='') {
		
		$CI =& get_instance();
		$CI->load->model('m_kategori_buku');
		$result	= '';

		$query	= $CI->m_kategori_buku->getAllActive();
		
		?> <option value=''>-- PILIH KATEGORI --</option><?php
		
		foreach($query->result() as $row){ ?>
			
			<option value="<?php echo encode($row->id_ktgr); ?>" <?php echo $row->id_ktgr == $id ? 'selected' : '' ?> ><?php echo strtoupper($row->nama_ktgr); ?></option>
			
		<?php }
	}
}

if(!function_exists('get_select_kategori_buku_all')) {
	function get_select_kategori_buku_all($id='') {
		
		$CI =& get_instance();
		$CI->load->model('m_kategori_buku');
		$result	= '';

		$query	= $CI->m_kategori_buku->getAll();
		
		?> <option value=''>-- PILIH KATEGORI --</option><?php
		
		foreach($query->result() as $row){ ?>
			
			<option value="<?php echo $row->id_ktgr; ?>" <?php echo $row->id_ktgr == $id ? 'selected' : '' ?> ><?php echo strtoupper($row->nama_ktgr); ?></option>
			
		<?php }
	}
}

if(!function_exists('get_select_kategori_anggota')) {
	function get_select_kategori_anggota($id='') {
		
		$CI =& get_instance();
		$CI->load->model('m_user');
		$result	= '';

		$query	= $CI->m_user->getAllKategori();
		
		?> <option value=''>-- PILIH KATEGORI --</option><?php
		
		foreach($query->result() as $row){ ?>
			
			<option value="<?php echo $row->id_kategori_anggota; ?>" <?php echo $row->id_kategori_anggota == $id ? 'selected' : '' ?> ><?php echo strtoupper($row->nama_kategori_anggota); ?></option>
			
		<?php }
	}
}

if(!function_exists('get_select_jurusan')) {
	function get_select_jurusan($id='') {
		
		$CI =& get_instance();
		$CI->load->model('m_jurusan');
		$result	= '';

		$query	= $CI->m_jurusan->getAll();
		
		?> <option value=''>-- PILIH JURUSAN --</option><?php
		
		foreach($query->result() as $row){ ?>
			
			<option value="<?php echo $row->id_jurusan; ?>" <?php echo $row->id_jurusan == $id ? 'selected' : '' ?> ><?php echo strtoupper($row->nama_jurusan); ?></option>
			
		<?php }
	}
}


if(!function_exists('getNewKodeBuku')) {
	function getNewKodeBuku() {
		
		$CI =& get_instance();
		$CI->load->model('m_buku');

		$query	= $CI->m_buku->getNewKodeBuku();
		
		if($query) {
			$query	= explode("-",$query['kode_buku']);
			$hasil_1= ((int) $query[1]) + 1;
			$kd		= '';
			
			if(count($hasil_1) == 1){
				$kd	= '00'.$hasil_1;
			}else if(count($hasil_1) == 2){
				$kd	= '0'.$hasil_1;
			}else if(count($hasil_1) == 3){
				$kd	= $hasil_1;
			}else{
				$kd	= '#&^$*&*#@*(+_@#$^';
			}
			
			$data = 'BK-'.$kd;
		}else{
			$data = 'BK-001';
		}
		
		return $data;
	}
}

if(!function_exists('getCountBookOnCategory')) {
	function getCountBookOnCategory($id) {
		
		$CI =& get_instance();
		$CI->load->model('m_buku');

		$query	= $CI->m_buku->getCountBookOnCategory($id);
		
		return $query;
	}
}

if(!function_exists('getUser')) { 
	function getUser($id_user,$level) {
		
		$CI =& get_instance();
		$CI->load->model('m_user');

		$query	= $CI->m_user->getUserByIdAndLevel($id_user,$level);
		
		$nama_peminjam = '';
		$status		= '';
		if($level == 1){
			$status	= 'ADMIN';
			$nama_peminjam = 'nip_admin';
		}else if($level == 2){
			$status	= 'PUSTAKAWAN';
			$nama_peminjam = 'nip_pustakawan';
		}else if($level == 3){
			$status	= 'DOSEN';
			$nama_peminjam = 'nip_dosen';
		}else if($level == 4){
			$status	= 'MAHASISWA';
			$nama_peminjam = 'nim_mhs';
		}else{
			$status	= 'Error Found';
			$nama_peminjam = 'Error Found';
		}
		return $query[$nama_peminjam];
	}
}

if(!function_exists('getUserNama')) { 
	function getUserNama($id_user,$level) {
		
		$CI =& get_instance();
		$CI->load->model('m_user');

		$query	= $CI->m_user->getUserByIdAndLevel($id_user,$level);
		
		$nama_peminjam = '';
		$status		= '';
		if($level == 1){
			$status	= 'ADMIN';
			$nama_peminjam = 'nama_admin';
		}else if($level == 2){
			$status	= 'PUSTAKAWAN';
			$nama_peminjam = 'nama_pustakawan';
		}else if($level == 3){
			$status	= 'DOSEN';
			$nama_peminjam = 'nama_dosen';
		}else if($level == 4){
			$status	= 'MAHASISWA';
			$nama_peminjam = 'nama_mhs';
		}else{
			$status	= 'Error Found';
			$nama_peminjam = 'Error Found';
		}
		return $query[$nama_peminjam];
	}
}

if(!function_exists('getUserNi')) { 
	function getUserNi($id_user,$level) {
		
		$CI =& get_instance();
		$CI->load->model('m_user');

		$query	= $CI->m_user->getUserByIdAndLevel($id_user,$level);
		
		$nama_peminjam = '';
		$status		= '';
		if($level == 1){
			$status	= 'ADMIN';
			$nama_peminjam = 'nip_admin';
		}else if($level == 2){
			$status	= 'PUSTAKAWAN';
			$nama_peminjam = 'nip_pustakawan';
		}else if($level == 3){
			$status	= 'DOSEN';
			$nama_peminjam = 'nip_dosen';
		}else if($level == 4){
			$status	= 'MAHASISWA';
			$nama_peminjam = 'nim_mhs';
		}else{
			$status	= 'Error Found';
			$nama_peminjam = 'Error Found';
		}
		return $query[$nama_peminjam];
	}
}

if(!function_exists('getMatkul')) { 
	function getMatkul($id_matkul) {
		
		$CI =& get_instance();
		$CI->load->model('a/m_matakuliah');

		$query	= $CI->m_matakuliah->getAll(array("id_matkul" => $id_matkul))->row_array();

		return $query['nama_matkul'];
	}
}

if(!function_exists('getTglKembali')) { 
	function getTglKembali() {
		
		$CI =& get_instance();
		$CI->load->model('m_setting');
		
		$get = $CI->m_setting->getAll();
		
		$selisih	= $get['lama_peminjaman'];
		$convert	= mktime(0,0,0, date("m"), date("d") + $selisih, date("Y"));
		return date("d-M-Y",$convert);
	}
}

if(!function_exists('getNomorPeminjaman')) {
	function getNomorPeminjaman() {
		
		$CI =& get_instance();
		$CI->load->model('m_peminjaman');

		$query	= $CI->m_peminjaman->getNewNomorPeminjaman();
		$data	= '';
		
		if($query) {
			$kd		= '';
			$query	= explode("-",$query['nomor_peminjaman']);
			$rs_thn = $query[1];
			$rs_no	= ( (int) $query[2] ) + 1;
			$urutan	= '';
			
			if($rs_thn == date("Y")){
				
				if($rs_no >= 1 && $rs_no <= 9){
					$urutan = "000000";
				}else if($rs_no >= 10 && $rs_no <= 99){
					$urutan = "00000";
				}else if($rs_no >= 100 && $rs_no <= 999){
					$urutan = "0000";
				}else if($rs_no >= 1000 && $rs_no <= 9999){
					$urutan = "000";
				}else if($rs_no >= 10000 && $rs_no <= 99999){
					$urutan = "00";
				}else if($rs_no >= 100000 && $rs_no <= 999999){
					$urutan = "0";
				}else if($rs_no >= 1000000 && $rs_no <= 9999999){
					$urutan = "";
				}else{
					$urutan = "Error";
				}
				
				$data	= "PNJ-".$rs_thn."-".$urutan.$rs_no;
			}else{
				$data	= "PNJ-".date("Y")."-0000001";
			}
		}else{
			$data	= "PNJ-".date("Y")."-0000001";
		}
		
		return $data;
	}
}

if(!function_exists('getNomorPengembalian')) {
	function getNomorPengembalian() {
		
		$CI =& get_instance();
		$CI->load->model('m_pengembalian');

		$query	= $CI->m_pengembalian->getNewNomorPengembalian();
		$data	= '';
		
		if($query) {
			$kd		= '';
			$query	= explode("-",$query['nomor_pengembalian']);
			$rs_thn = $query[1];
			$rs_no	= ( (int) $query[2] ) + 1;
			$urutan	= '';
			
			if($rs_thn == date("Y")){
				
				if($rs_no >= 1 && $rs_no <= 9){
					$urutan = "000000";
				}else if($rs_no >= 10 && $rs_no <= 99){
					$urutan = "00000";
				}else if($rs_no >= 100 && $rs_no <= 999){
					$urutan = "0000";
				}else if($rs_no >= 1000 && $rs_no <= 9999){
					$urutan = "000";
				}else if($rs_no >= 10000 && $rs_no <= 99999){
					$urutan = "00";
				}else if($rs_no >= 100000 && $rs_no <= 999999){
					$urutan = "0";
				}else if($rs_no >= 1000000 && $rs_no <= 9999999){
					$urutan = "";
				}else{
					$urutan = "Error";
				}
				
				$data	= "PMB-".$rs_thn."-".$urutan.$rs_no;
			}else{
				$data	= "PMB-".date("Y")."-0000001";
			}
		}else{
			$data	= "PMB-".date("Y")."-0000001";
		}
		
		return $data;
	}
}

if(!function_exists('getStatus')) {
	function getStatus($status) {
		
		$data	= '';
		
		if($status == 1) $data = "ADMIN";
		else if($status == 2) $data = "PUSTAKAWAN";
		else if($status == 3) $data = "DOSEN";
		else if($status == 4) $data = "MAHASISWA";
		else $data = "Error Found";
		
		return $data;
	}
}

if(!function_exists('set_barcode')) {
	function set_barcode($code) {
		
		return Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
}

//barcode128


