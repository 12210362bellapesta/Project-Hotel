<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Pengguna sistem informasi perhotelan</p>

<form method="post" action="<?=url_to('login')?>">
    <input type="hidden" name="_method" value="delete" />
    <button class="btn btn-sm btn-danger">Logout</button>
</form>
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id="table-pengguna" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Tanggal Lahir</th>
            <th>No Telepon</th>
            <th>No Handphone</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengguna</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPengguna" method="post" action="<?=base_url('pengguna')?>">
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
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lhr" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="notelp" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Handphone</label>
                        <input type="text" name="nohp" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-control">
                            <option>Pilih Level</option>
                            <option value="M">Manager</option>
                            <option value="A">Administrasi</option>
                            <option value="R">Resepsionis</option>
                            <option value="B">Room Boy</option>
                        </select>
                    </div>
                    <div class="mb-3" id="fileberkas"></div>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    function buatDropify(filename = ''){
        $('div#fileberkas').html(`
            <input type="file" name="berkas" data-default-file="${filename}" />
        `);
        $('input[name=berkas]').dropify();
    }

    $(document).ready(function(){
        $('button#btn-kirim').on('click', function(){
            $('form#formPengguna').submit();
        });

        $('table#table-pengguna').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $('#modalForm').modal('show');
            $('input[name=_method]').val('patch');
            
            $.get(`${baseurl}/pengguna/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('select[name=jenis_kelamin]').val(e.jenis_kelamin);
                $('input[name=email]').val(e.email);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=tgl_lhr]').val(e.tgl_lhr);
                $('input[name=notelp]').val(e.notelp);
                $('input[name=nohp]').val(e.nohp);
                $('select[name=level]').val(e.level);
                
                buatDropify(a.berkas);
            });
        });

        
        $('table#table-pengguna').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/pengguna`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pengguna').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formPengguna').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-pengguna').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPengguna').trigger('reset');
            $('input[name=_method]').val('');
            buatDropify('');
        });

        $('table#table-pengguna').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pengguna/all')?>",
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
                { data: 'tgl_lhr' },
                { data: 'notelp' },
                { data: 'nohp' },
                { data: 'level',
                    render: (data, type, meta, row)=>{
                        if(data === 'M'){
                            return 'Manager';
                        }
                        else if( data === 'A'){
                            return 'Administrasi';
                        }
                        else if( data === 'R'){
                            return 'Resepsionis';
                        }
                        else if( data === 'B'){
                            return 'Room Boy';
                        }
                        return data;
                    }
                
                 },
               

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