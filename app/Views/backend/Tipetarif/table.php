<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Tipe Tarif</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Tipe Tarif sistem informasi perhotelan</p>

<div class="contrainer mt-3">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

    <table id="table-tipetarif" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tipe</th>
            <th>Keterangan</th>
            <th>Urutan</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tipe Tarif</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTipetarif" method="post" action="<?=base_url('tipetarif')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <input type="text" name="tipe" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="int" name="urutan" class="form-control"/>
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
            $('form#formTipetarif').submit();
        });

        $('table#table-tipetarif').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/tipetarif/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tipe]').val(e.tipe);
                $('select[name=keterangan]').val(e.keterangan);
                $('input[name=urutan]').val(e.urutan);
                $('input[name=aktif]').val(e.aktif)
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });

        $('table#table-tipetarif').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/tipetarif`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-tipetarif').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formTipetarif').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-tipetarif').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formTipetarif').trigger('reset');
        });

        $('table#table-tipetarif').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('tipetarif/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tipe' },
                { data: 'keterangan' },
                { data: 'urutan' },
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