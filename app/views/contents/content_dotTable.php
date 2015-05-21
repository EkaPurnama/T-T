<script type="text/plain" id="tmpl_spd">
<tr>
<td rowspan=2>{{=it.rn}}</td>
<td rowspan=2>
<span>
{{? it.nama_pemangku }}
{{=it.nama_pemangku}}</span>
<br>
<span>
{{=it.nip}}
{{??}}
Terlampir
</span>
<br>
<span>
Terlampir
{{?}}
</span>
</td>
<td>
{{=it.kode_spd}}
</td>
<td>
{{? it.tgl_terbit == null}}belum terisi{{??}}{{=it.tgl_terbit}}{{?}}</td>
<td>
{{=it.tgl_berangkat}}</td>
<td>
{{=it.tgl_kembali}}</td>
<td style="text-transform:Capitalize">
{{=it.tujuan}}</td>
<td rowspan=2>
<div class="dropdown" style="list-style:none">
<a href="#" class="dropdown-toggle btn btn-warning">
<i class="icon-cog"></i> 
Opsi 
<b class="caret"></b>
</a>
<div class="dropdown-menu dropdown-opsi dropdown-out" style="cursor:pointer">
<div class="list-group list-group-dropdown" style="margin:0">
<a data-field-button="rincian_biaya"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-toggle="modal"
data-target="#form_rincian_biaya"
data-id-rinci="<?php $latest = Spd_rincian::orderBy('id_rincian','desc')->pluck('id_rincian');
        if ($latest == null) {
            $latest = 0;
        }
        echo $latest +1; ?>"
onclick="formColor('bg-biru')">
Rincian Biaya
<i class="icon-coins pull-right"></i>
</a>
<a data-field-button="detail"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-sumberdana="{{=it.kop_surat}}"
data-toggle="modal" 
data-target="#dialog_detail">
Detail
<i class="icon-search pull-right"></i>
</a>
<a data-field-button="ubah"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-jenis="{{=it.jenis}}"
data-toggle="modal"
data-target="#form_spd"
onclick="formColor('bg-hijau')">
Ubah
<i class="icon-pencil pull-right"></i>
</a>
<a data-field-button="ubah_jadwal"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-toggle="modal"
data-target="#form_ubah_jadwal"
onclick="formColor('bg-biru-matang')">
Ubah Jadwal
<i class="icon-calendar pull-right"></i>
</a>
<a data-field-button="cancel"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-toggle="modal" 
data-target="#form_batalkan"
onclick="formColor('bg-biru-jenuh')">
Batalkan
<i class="icon-cancel-2 pull-right"></i>
</a>
<a data-field-button="hapus"
class="ajax list-group-item"
data-action-to="{{=it.kode_spd}}"
data-toggle="modal" 
data-target="#dialog_hapus">
Hapus
<i class="icon-remove pull-right"></i>
</a>
</div>
</div>
</div>
</td>
</tr>
<tr>
<td colspan=5>
{{? it.reason == null}}
kosong
{{??}}
{{=it.reason}}
{{?}}
</td>
</tr>
</script>
<script>
$.fn.tmpl = function(tmplId, data) {
    var tmpl = doT.template($('#tmpl_' + tmplId).html());
    if (!$.isArray(data)) data = [data];

    return this.each(function() {
        var html = '';
        for (var itemIdx = 0; itemIdx < data.length; itemIdx++) {
            data[itemIdx].rn = itemIdx+1;
            html += tmpl(data[itemIdx]);
        }
        $(this).html(html);
    });
};
</script>
    <?php 
    if(isset($bulan)){
    $a = Spd_pemangku::join('spd_spd','spd_pemangku.nip','=','spd_spd.nip')->whereBetween('tgl_berangkat', array('01-'.$bulan.'-2014', '01-'.($bulan+1).'-2014'))->where('jenis','umum')->orderBy('id_spd','asc')->get();
    $b = Spd_spd::whereBetween('tgl_berangkat', array('01-'.$bulan.'-2014', '01-'.($bulan+1).'-2014'))->where('jenis','khusus')->orderBy('id_spd','asc')->get();
    }else{
    $a = Spd_pemangku::join('spd_spd','spd_pemangku.nip','=','spd_spd.nip')->where('jenis','umum')->orderBy('id_spd','asc')->get();
    $b = Spd_spd::where('jenis','khusus')->orderBy('id_spd','asc')->get();
    }
    $c = array_merge($a->toArray(),$b->toArray());
    ?>
<script type="text/javascript">
$(document).ready(function(){
    <?php if(isset($bulan)){ ?>
        writeaction(<?php echo $bulan ?>)
    <?php }else{ ?>
        writeaction(<?php echo date('m') ?>)
        <?php } ?>
    data = <?php echo json_encode($c) ?>;
    window.ordered = sortByKey(data, 'id_spd');
    implement(ordered);
});
function implement(data){
	$('tbody#ajax_table_spd').tmpl('spd', data);
}
function toForm(data){
    $('form#ekspormonitor').tmpl('formekspor', data);
}
function writeaction(bln){
    $('#ekspormonitor').attr('action','ekspor/monitor/bulan/'+bln);
}
function sortByKey(array, key) {
    return array.sort(function(a, b) {
        var x = a[key]; var y = b[key];
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}
</script>