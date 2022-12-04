<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Metode Bayar</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Metode Bayar sistem informasi perhotelan</p>

<div class="contrainer mt-3">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
    
<table id="table-metodebayar" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Metode</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Metode</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formMetodebayar" method="post" action="<?=base_url('metodebayar')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Metode</label>
                        <input type="text" name="metode" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aktif</label>
                        <select name="aktif" class="form-control">
                            <option value="Y">Aktif</option>
                            <option value="T">Tidak Aktif</option>
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
        $('button#btn-kirim').on('click', function(){
            $('form#formMetodebayar').submit();
        });

        $('table#table-metodebayar').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/metodebayar/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=metode]').val(e.metode);
                $('input[name=aktif]').val(e.aktif)
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });

        $('table#table-metodebayar').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/metodebayar`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-metodebayar').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formMetodebayar').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-metodebayar').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formMetodebayar').trigger('reset');
        });

        $('table#table-metodebayar').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('metodebayar/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'metode' },
                { data: 'aktif' },
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