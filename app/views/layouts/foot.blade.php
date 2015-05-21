@if( Auth::check() )
@if(Request::is('/'))
<div id="dialog_hapus" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" class="modal fade">
@include('modals.dialog_hapus')
<script type="text/javascript">
$('#dialog_hapus').on('show.bs.modal', function (e){
    $at = $(e.relatedTarget).data('action-to');
    $(this).find('.modal-body p code').html($at);
    $(this).find('.modal-footer input[name=id]').attr('value', $at);
});
$('#dialog_hapus').on('hidden.bs.modal',function(){
    $(this).find('.modal-body p code').html('');
});

</script>


</div>
<div id="form_spd" role="dialog" aria-hidden="true" class="modal fade">
<script type="text/javascript">
	fsCaller();
</script>
@include('form.form_spd')
<script type="text/javascript">
$('#nama_pegawai_umum').multiselect({
    enableFiltering: true,
    filterPlaceholder: 'Cari',
    maxHeight: 200,
    onChange: function(option, checked) {
        var values = [];
        $('#nama_pegawai_umum option').each(function() {
            if ($(this).val() !== option.val()) {
                values.push($(this).val());
            }
        });
        $('#nama_pegawai_umum').multiselect('deselect', values);
    }
});
$('#nama_pegawai_khusus').multiselect({
    enableFiltering: true,
    filterPlaceholder: 'Cari',
    numberDisplayed: 2,
    maxHeight: 200
});
$('#form_spd').on('hidden.bs.modal', function(){

    $('option', $('#nama_pegawai_umum')).each(function(element) {
        $(this).removeAttr('selected').prop('selected', false);
    });
    $('#nama_pegawai_umum').multiselect('refresh');
    $('option', $('#nama_pegawai_khusus')).each(function(element) {
        $(this).removeAttr('selected').prop('selected', false);
    });
    $('#nama_pegawai_khusus').multiselect('refresh');
}); 
</script>

</div>
<div id="form_rincian_biaya" role="dialog" aria-hidden="true" class="modal fade">
@include('form.form_rincian_biaya')


</div>
<div id="dialog_detail" role="dialog" aria-hidden="true" class="modal fade">
@include('modals.dialog_detail')


</div>
<div id="dialog_ubah" role="dialog" aria-hidden="true" class="modal fade">
@include('modals.dialog_ubah')


</div>
<div id="form_batalkan" role="dialog" aria-hidden="true" class="modal fade">
@include('form.form_batalkan')
</div>


<div id="form_ubah_jadwal" role="dialog" aria-hidden="true" class="modal fade">
@include('form.form_ubah_jadwal')
	
</div>
@endif
@endif