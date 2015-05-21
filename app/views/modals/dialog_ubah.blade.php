<div class="modal-dialog" 
style="position:absolute;top:30%;left:30%">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body">
            <p></p>
        </div>
        <div class="modal-footer">
            <form id="btnConfirm" method="post">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" 
                class="btn btn-primary" 
                id="confirm"            
                data-toggle="modal"
                data-target="#insertSpd"
                data-dismiss="modal"
                onclick="formColor('bg-biru')">
                Ya, Ubah Sekarang</button>
            </form>
        </div>
    </div>
</div>