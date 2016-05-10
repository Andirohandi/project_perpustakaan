
<aside class="main-sidebar">
    <section class="sidebar">
		 <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/img/no_poto.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('nama_admin') ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
            </div>
          </div>
        <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
            <li class="<?php echo $pg == 'dashboard' ? 'active' : '' ?>" >
                <a href="<?php echo site_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
                </a>
            </li>
			<li class="treeview <?php echo $pg == 'p_kategori' || $pg == 'p_buku' || $pg == 'p_anggota' || $pg == 'p_agt_mhs' || $pg == 'p_agt_dosen' || $pg == 'p_agt_akademik' || $pg == 'p_agt_add' ? 'active' : '' ?>">
				<a href="#">
					<i class="fa fa-database"></i> <span>DATA MASTER</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class='<?php echo $pg == 'p_kategori' ? 'active' : '' ?>'><a href="<?php echo site_url('p/kategori')?>"><i class="fa fa-angle-double-right"></i> Data Kategori</a></li>
					<li class='<?php echo $pg == 'p_buku' ? 'active' : '' ?>'><a href="<?php echo site_url('p/buku')?>"><i class="fa fa-angle-double-right"></i> Data Buku</a></li>
					
					<li class='<?php echo $pg == 'p_agt_mhs' || $pg == 'p_agt_dosen' || $pg == 'p_agt_akademik' || $pg == 'p_agt_add' ? 'active' : '' ?>'>
						<a href="javascript:void(0)"><i class="fa fa-angle-double-right"></i>
						Data Anggota
						<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class='<?php echo $pg == 'p_agt_add' ? 'active' : '' ?>'><a href="<?php echo site_url('p/anggota/add')?>"><i class="fa fa-caret-right"></i> Tambah Anggota</a></li>
							<li class='<?php echo $pg == 'p_agt_akademik' ? 'active' : '' ?>'><a href="<?php echo site_url('p/anggota/ktgr/akademik')?>"><i class="fa fa-caret-right"></i> Akademik</a></li>
							<li class='<?php echo $pg == 'p_agt_dosen' ? 'active' : '' ?>'><a href="<?php echo site_url('p/anggota/ktgr/dosen')?>"><i class="fa fa-caret-right"></i> Dosen</a></li>
							<li class='<?php echo $pg == 'p_agt_mhs' ? 'active' : '' ?>'><a href="<?php echo site_url('p/anggota/ktgr/mahasiswa')?>"><i class="fa fa-caret-right"></i> Mahasiswa</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="treeview <?php echo $pg == 'p_booking' || $pg == 'p_peminjaman' || $pg == 'p_pengembalian' ? 'active' : '' ?>">
				<a href="#">
					<i class="fa fa-gears"></i> <span>TRANSAKSI</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class='<?php echo $pg == 'p_peminjaman' ? 'active' : '' ?>'><a href="<?php echo site_url('p/peminjaman')?>"><i class="fa fa-angle-double-right"></i> Trans. Peminjaman</a></li>
					<li class='<?php echo $pg == 'p_pengembalian' ? 'active' : '' ?>'><a href="<?php echo site_url('p/pengembalian')?>"><i class="fa fa-angle-double-right"></i> Trans. Pengembalian</a></li>
				</ul>
			</li>
			<li class="treeview <?php echo $pg == 'buku_masuk' || $pg == 'buku_keluar' || $pg == 'arus_buku' ? 'active' : '' ?>">
				<a href="#">
					<i class="fa fa-book"></i> <span>ARUS BUKU</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class='<?php echo $pg == 'buku_masuk' ? 'active' : '' ?>'><a href="<?php echo site_url('p/arus_buku/buku_masuk')?>"><i class="fa fa-angle-double-right"></i> Buku Masuk</a></li>
					<li class='<?php echo $pg == 'buku_keluar' ? 'active' : '' ?>'><a href="<?php echo site_url('p/arus_buku/buku_keluar')?>"><i class="fa fa-angle-double-right"></i> Buku Keluar</a></li>
					<li class='<?php echo $pg == 'arus_buku' ? 'active' : '' ?>'><a href="<?php echo site_url('p/arus_buku')?>"><i class="fa fa-angle-double-right"></i> Arus Stok Buku</a></li>
				</ul>
			</li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">