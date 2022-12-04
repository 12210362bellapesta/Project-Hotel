<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Negara</h1>
<p class="mb-4">Fitur ini disediakan untuk mengelola data Negara sistem informasi perhotelan</p>

<div class="contrainer mt-3">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
    
<table id="table-negara" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Negara</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Negara</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNegara" method="post" action="<?=base_url('negara')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Negara</label>
                        <input type="text" name="negara" class="form-control"/>
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
            $('form#formNegara').submit();
        });

        $('table#table-negara').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/negara/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=negara]').val(e.negara);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        $('table#table-negara').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/negara`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-negara').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formNegara').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-negara').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formNegara').trigger('reset');
        });

        $('table#table-negara').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('negara/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'negara' },
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