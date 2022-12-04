<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Pembayaran</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Pembayaran sistem informasi perhotelan</p>

<div class="contrainer mt-3">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id="table-pembayaran" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Tagihan</th>
            <th>Dibayar</th>
            <th>Nama Pembayar</th>
            <th>Metode bayar</th>
            <th>Nama Pengguna</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPembayaran" method="post" action="<?=base_url('pembayaran')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tgl" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tagihan</label>
                        <input type="double" name="tagihan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dibayar</label>
                        <input type="double" name="dibayar" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pembayar</label>
                        <input type="text" name="nama_pembayar" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Metode Bayar</label>
                        <select name="metodebayar_id" class="form-control">
                            <option>Pilih Metode Bayar</option>
                            <?php foreach($data_metodebayar as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['metode']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Pengguna</label>
                        <select name="pengguna_id" class="form-control">
                            <option>Pilih Pengguna</option>
                            <?php foreach($data_pengguna as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['nama_depan']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn-kirim">Kirim</button>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>

<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=metodebayar_id]').select2({
            width:'100%'
        });
        $('select[name=pengguna_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formPembayaran').submit();
        });

        $('table#table-pembayaran').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pembayaran/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl]').val(e.tgl);
                $('input[name=tagihan]').val(e.tagihan);
                $('select[name=dibayar]').val(e.dibayar);
                $('input[name=nama_pembayar]').val(e.nama_pembayar);
                $('input[name=metodebayar_id]').val(e.metodebayar_id);
                $('input[name=pengguna_id]').val(e.pengguna_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        
        $('table#table-pembayaran').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/pembayaran`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pembayaran').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formPembayaran').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-pembayaran').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPembayaran').trigger('reset');
        });

        $('table#table-pembayaran').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pembayaran/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tgl' },
                { data: 'tagihan' },
                { data: 'dibayar' },
                { data: 'nama_pembayar' },
                { data: 'metode' },
                { data: 'nama_depan' },

                { data: 'id',
                render: (data, type, meta, row)=>{
                    var btnEdit = `<button class='btn btn-info btn-edit' data-id='${data}'> Edit </button>`;
                    var btnHapus = `<button class='btn btn-danger btn-hapus' data-id='${data}'> Hapus </button>`;
                    return btnEdit + btnHapus;
                    
                } 
            }
            ]
        });
    });
</script>

<?=$this->endSection()?>