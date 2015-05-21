<div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Hapus Data</h4>
        </div>
        <div class="modal-body">
            <p>Anda akan menghapus data SPD ke <code></code>, apakah anda yakin?</p>
        </div>
        <div class="modal-footer">
            <form method="post" action="post/delete">
            <input type="hidden" name="id" />
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="icon-backspace"></i>
            Batal</button>
                <button type="submit" class="btn btn-danger" id="confirm"><i class="icon-remove"></i>
                Ya, Hapus Sekarang</button>
            </form>
        </div>
    </div>
</div>