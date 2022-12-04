<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Tamu</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Tamu sistem informasi perhotelan</p>

<div class="contrainer mt-3">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id="table-tamu" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Negara</th>
            <th>No Handphone</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tamu</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTamu" method="post" action="<?=base_url('tamu')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-control">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Negara</label>
                        <select name="negara_id" class="form-control">
                            <option>Pilih Negara</option>
                            <?php foreach($data_negara as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['negara']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Handphone</label>
                        <input type="text" name="nohp" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control"/>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Sandi</label>
                        <input type="password" name="sandi" class="form-control"/>
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
        $('select[name=negara_id]').select2({
            width:'100%'
        });
        
        $('button#btn-kirim').on('click', function(){
            $('form#formTamu').submit();
        });

        $('table#table-tamu').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/tamu/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('select[name=jenis_kelamin]').val(e.jenis_kelamin);
                $('input[name=email]').val(e.email);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=negara_id]').val(e.negara_id);
                $('input[name=nohp]').val(e.nohp);
               // $('input[name=sandi]').val(e.sandi)
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-tamu').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/tamu`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-tamu').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formTamu').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-tamu').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formTamu').trigger('reset');
        });

        $('table#table-tamu').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('tamu/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'nama_depan' },
                { data: 'nama_belakang' },
                { data: 'email' },
                { data: 'gender', 
                    render: (data, type, meta, row)=>{
                        if(data === 'L'){
                            return 'Laki-Laki';
                        }
                        else if( data === 'P'){
                            return 'Perempuan';
                        }
                        return data;
                    }
                 },
                { data: 'alamat' },
                { data: 'kota' },
                { data: 'negara' },
                { data: 'nohp' },

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