<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-0">
        <i class="fas fa-light fa-hotel"></i>
    </div>
    <div class="sidebar-brand-text mx-3">PERHOTELAN<sup>KITA</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=base_url('dashboard')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Halaman
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelola Data</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Data:</h6>
            <a class="collapse-item" href="<?=site_url('pengguna')?>">Data Pengguna</a>
            <a class="collapse-item" href="<?=site_url('metodebayar')?>"> Data Metode Bayar</a>
            <a class="collapse-item" href="<?=site_url('tipetarif')?>">Data Tipe Tarif</a>
            <a class="collapse-item" href="<?=site_url('kamartipe')?>">Data Kamar Tipe</a>
            <a class="collapse-item" href="<?=site_url('kamartarif')?>">Data Kamar Tarif</a>
            <a class="collapse-item" href="<?=site_url('kamarstatus')?>">Data Kamar Status</a>
            <a class="collapse-item" href="<?=site_url('kamar')?>">Data Kamar</a>
            <a class="collapse-item" href="<?=site_url('pemesananstatus')?>">Data Pemesanan Status</a>
            <a class="collapse-item" href="<?=site_url('negara')?>">Data Negara</a>
            <a class="collapse-item" href="<?=site_url('tamu')?>">Data Tamu</a>
            <a class="collapse-item" href="<?=site_url('pemesanan')?>">Data Pemesanan</a>
            <a class="collapse-item" href="<?=site_url('kamardipesan')?>">Data Kamar Dipesan</a>
            <a class="collapse-item" href="<?=site_url('pembayaran')?>">Data Pembayaran</a>
            
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Media Sosial</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header">Media Sosial:</h6>
            <a class="collapse-item" href="https://instagram.com/bellapesta_?igshid=YmMyMTA2M2Y=">Instagram</a>
            <a class="collapse-item" href="https://free.facebook.com/bella.pesta.73?eav=Afa9PuuJ12sYyqihhGJ4ns2wr8n4j7CnDaVPTlMhmwV7cdsPaYuaDa-OczyiEJLmXYM&ref_component=mbasic_home_bookmark&ref_page=%2Fwap%2Fhome.php&refid=7&paipv=0">Facebook</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->