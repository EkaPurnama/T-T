//SPD Malang Javascript Library
//10-02-2014
//azimi
//email : artologeist@gmail.com

//22 Maret 2014
//azimi
//pace Section
//listen page action
var paceOptions = {
    ajax: true, 
    document: false, 
    eventLag: false, 
    elements: {
        selectors: ['body'] 
    }
};
loadSelection();
//10 Januari 2014
//azimi
//document ready action
$(document).ready(function () {
    takeDot();
});

//edit dialog
//19-03-2014
//ismi
$('#dialog_ubah').on('show.bs.modal', function (e){
    $ide = $(e.relatedTarget).attr('data-id');
    $(this).find('.modal-body p').html("Anda akan mengubah data dengan indeks <code>" + $ide + "</code>, apakah anda yakin ?");

});


//17-03-2014
//afoe
//mengganti warna form secara dinamis, dan mereset kelas dan input pada form
function formColor(warna){
    var formClasses = ["form-header","form-box","form-buttons-box"];
    for (i=0;i<formClasses.length;i++){
        $("."+formClasses[i]).removeClass().addClass(formClasses[i]).addClass(warna);
    }
    $('#illuminati')[0].reset();
}


//17-03-2014
//azimi
//function untuk menambah kelas dari objek tertentu
function reseterAction(x,y,z){
    $("#" + x + " #" + y).addClass(z);
}


//18-03-2014
//Ismi Gheantaka Yudha
//mengambil data terakhir pada identitas spd
function getNewId(o,p,q){
    $.ajax({
        url: p,
        cache: false,
        success: function(d){
            $(o).attr(q,d);
        }
    });
}


getNewId('a[data-target=#form_spd]','new/spd','data-id-baru');
getNewId('a[data-target=#form_spd]','new/pengikut','data-id-pengikut');

function takeDot(){
    $.ajax({
        url: 'data/ajax/monitor',
        cache: false,
        success: function(data){
            $('tbody#ajax_table_spd').html(data);
        }
    })
}

function loadSelection(){
    $.ajax({
        url: "data/nip",
        cache: false,
        success: function(d){
            for(i=0;i<d.length;i++){
                $("select#nama_pegawai_khusus").append('<option value="'+d[i].nip+'">'+d[i].nama_pemangku+'</option>');
                $("select#nama_pegawai_umum").append('<option value="'+d[i].nip+'">'+d[i].nama_pemangku+'</option>');
            }
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
        }
    });
}

/////form SPD
//reset
function fsCaller(e){
//adds
$('#form_spd').on('show.bs.modal', function (e) {
    $at = $(e.relatedTarget).attr('data-jenis');
    $kd = $(e.relatedTarget).attr('data-action-to');
    $id = $(e.relatedTarget).attr('data-id-spd');
    $nm = $(e.relatedTarget).attr('data-nama');
//Insert atau Edit
        if ($kd){
            $.ajax({
                url: "data/ajax/spd/" + $kd,
                cache: false,
                success: function(data){
                    $.each(data, function(i,item){
                        $('input[name="no_surat"]').attr('value', item.kode_spd);
                        $('input[name="mak"]').attr('value', item.mak);
                        $('textarea[name="dasar_penugasan"]').html(item.dasar_penugasan);
                        $('textarea[name="maksud"]').html(item.maksud);
                        $('input[name="waktu_mulai"]').attr('value', item.waktu_mulai);
                        $('input[name="waktu_selesai"]').attr('value', item.waktu_selesai);
                        $('input[name="tgl_berangkat"]').attr('value', item.tgl_berangkat);
                        $('input[name="tgl_kembali"]').attr('value', item.tgl_kembali);
                        $('input[name="tmpt_asal"]').attr('value', item.tmpt_asal);
                        $('input[name="tujuan"]').attr('value', item.tujuan);
                        $('input[name="edit_id_spd"]').attr('value', item.id_spd);
                        $('form#illuminati').attr('action','post/spd/edit/'+ item.id_spd);
                    });
                }
            });
            $(this).find('.form-header #edition').html("Revisi data SPD no. <span style='text-decoration:Capitalized'>"+$kd+"</span>");
            
        }else{
            $(this).find('.form-header #edition').html("Buat SPD <span style='text-decoration:Capitalized'>"+$at+"</span> Baru");
            $('form#illuminati').attr('action','post/spd/create');
            $('input[name="no_surat"]').attr('value', '');
            $('input[name="mak"]').attr('value', '');
            $('textarea[name="dasar_penugasan"]').html("");
            $('textarea[name="maksud"]').html("");
            $('input[name="waktu_mulai"]').attr('value', '');
            $('input[name="waktu_selesai"]').attr('value', '');
            $('input[name="tgl_berangkat"]').attr('value', '');
            $('input[name="tgl_kembali"]').attr('value', '');
            $('input[name="tmpt_asal"]').attr('value', '');
            $('input[name="tujuan"]').attr('value', '');
            $('input[name="edit_id_spd"]').attr('value', '');
        };

    });
}

//ismi
//Rincian biaya
function rb(){
$('#form_rincian_biaya').on('show.bs.modal', function (e){
    var g = ["data-action-to","data-id-rinci"];
    var rin = [];
    for(i=0;i<g.length;i++){
        rin[i] = $(e.relatedTarget).attr(g[i]);
    }
    $(this).find('.form-header code').html(rin[0]);
    $(this).find('.hidden').html("<input name=\"kode_spd\" type=\"hidden\" value=\""+ rin[0] +"\"><input name=\"id_rincian\" type=\"hidden\" value=\""+ rin[1] +"\">");
    $(this).find('.form-medium #frm-rincian').attr('action','rincian/post/create');
    $.ajax({
        url: "ajax/jumlah/nip_spd/" + rin[0],
        cache: false,
        success: function(data){
            for (var i = 0; i < data.length; i++) {
                $('div#new-rincian-khusus').append('<h5>Data Rincian Biaya dengan NIP : '+data[i]+'</h5><input type="hidden" name="jumlah_data" value="'+data.length+'"><input type="hidden" name="nip_'+[i]+'" value="'+data[i]+'"><div class="form-group">&nbsp;Uang Harian<input id="input_uangharian"name="uangharian_'+data[i]+'"type="number"class="form-control"style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Transportasi<input id="input_transportasi"name="transportasi_'+data[i]+'"  type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Penginapan<input id="input_penginapan"name="penginapan_'+data[i]+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Uang Representasi<input id="input_representasi" name="representasi_'+data[i]+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Sewa Kendaraan<input id="input_sewakendaraan"name="sewakendaraan_'+data[i]+'" type="number" class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Biaya Menjemput/Mengantar Jenazah<input id="input_jenazah"name="jenazah_'+data[i]+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Total Biaya<div id="totalValue" style="margin-left: 30px;"></div></div>');
                $.ajax({
                    url: "data/ajax/rincian/" + data[i],
                    cache: false,
                    success: function(mata){
                        var prefix = ['Uang Harian','Transportasi','Penginapan','Representasi','Sewa Kendaraan','Jenazah'];
                        var name = ['uangharian','transportasi','penginapan','representasi','sewakendaraan','jenazah'];
                        $.each(mata, function(i,item){
                            for (i=0;i<prefix.length;i++) {
                                if(item.komponen_biaya == prefix[i]){
                                    $("input[name="+name[i]+"_"+item.nip+"]").attr('value',item.jumlah);
                                    $("input[name="+name[i]+"_"+item.nip+"]").parent().find('.busek').append("<input type='hidden' name='edit_"+name[i]+"_"+item.nip+"' value='true'><input type='hidden' name='edit_id_"+name[i]+"_"+item.nip+"' value='"+item.id_rincian+"'>");
                                }
                            };
                        });
                    }
                });
            };
        }
    });
});

//ismi
//Reset form Rincian Biaya
$('#form_rincian_biaya').on('hidden.bs.modal',function(){
    $(this).find('input').attr('value','');
    $('div#new-rincian-khusus').html("");
    $('div.busek').html("");
    });
}

//ismi
//Detail Data, Rincian Biaya, Pengikut
function detail(){
$('#dialog_detail').on('show.bs.modal', function (e){
    $kodespd = $(e.relatedTarget).attr('data-action-to');
    $namapemangku = $(e.relatedTarget).attr('data-nama');
    $.ajax({
        url: "data/ajax/spd/" + $kodespd,
        cache: false,
        success: function(data){
            $.each(data, function(i,item){
            //template detail data
            $text = "No. Surat :<code>"+item.kode_spd+
            "</code><br>NIP : "+item.nip +
            "<br>Nama : "+ $namapemangku+
            "<br>Berangkat Dari : "+item.tmpt_asal+
            "<br>Tujuan Perjalanan : "+item.tujuan+
            "<br>Waktu Mulai : "+item.waktu_mulai+" S/d "+item.waktu_selesai+
            "<br>Tanggal Berangkat : "+item.tgl_berangkat+
            "<br>Tanggal Kembali : "+item.tgl_kembali+
            "<br>Tanggal Berangkat Revisi : "+item.tgl_berangkat_revisi+
            "<br>Tanggal Kembali Revisi : "+item.tgl_kembali_revisi+
            "<br>Maksud Tujuan : "+item.tujuan+
            "<br>Transportasi : "+item.transportasi+
            "<br>Sumber Dana : "+item.sumberdana+
            "<br>Dasar Penugasan : "+item.dasar_penugasan+
            "<br>MAK : "+item.mak+
            "<br>Status : "+item.status+
            "<br>Alasan : "+item.reason;

            $('div.child_detail').append($text);
            });
        }
    });
    $.ajax({
        url: "ajax/jumlah/nip_spd/" + $kodespd,
        cache: false,
        success: function(data){
            for (var s = 0; s < data.length; s++) {
                $('div.child_rincian').append('<div class="child_'+data[s]+'"><h5>'+data[s]+'</h5><p></p></div>');
                $.ajax({
                    url: "data/ajax/rincian/" + data[s],
                    cache: false,
                    success: function(mata){
                        $.each(mata, function(i,item){
                            $('div.child_'+item.nip).append("- "+ item.komponen_biaya + " : " + item.jumlah+"<br>");
                        });
                    }
                });
            };

        }
    });
    $.ajax({
        url: "data/ajax/pengikut/" + $kodespd,
        cache: false,
        success: function(data){
            $.each(data, function(i,item){
                $('div.child_pengikut').append("- "+ item.nama +"<br>")
            })
        }
    });

});

//ismi
//reset modals Detail data
$('#dialog_detail').on('hidden.bs.modal',function(){
    $("div.child_detail").html("");
    $("div.child_rincian").html("");
    $("div.child_pengikut").html("");
    });
}

//ismi
//ubah jadwal
function ubah_jadwal(){
$('#form_ubah_jadwal').on('show.bs.modal', function (e){
    $at = $(e.relatedTarget).attr('data-action-to');
    $(this).find('.form-header code').html($at);
    $.ajax({
        url: "data/ajax/spd/" + $at,
        cache: false,
        success: function(data){
            $.each(data, function(i,item){
                $('div.child-tgl-berangkat').append("<code>"+item.tgl_berangkat+"</code>");
                $('div.child-tgl-kembali').append("<code>"+item.tgl_kembali+"</code>");
                $('form.child-ubah-jadwal').attr('action', 'post/jadwal/edit/' + $at);
            });
        }
    });
});
//reset form ubah jadwal
$('#form_ubah_jadwal').on('hidden.bs.modal', function (e){
    $(this).find('div.child-tgl-berangkat').html("");
    $(this).find('div.child-tgl-kembali').html("");
    $(this).find('form.child-ubah-jdwl').attr('action', '');
});
}

//ismi
//cancel
function cancel(){
$('#form_batalkan').on('show.bs.modal', function (e){
    $kodespd = $(e.relatedTarget).attr('data-action-to');
    $(this).find('div.form-header code').html($kodespd);
    $(this).find('form.child-batalkan').attr('action', 'post/batal/' + $kodespd);
});
//reset form batalkan
$('#form_batalkan').on('hidden.bs.modal', function (e){
    $(this).find('div.form-header code').html("");
    $(this).find('form.child-batalkan').attr('action', '');
});
}