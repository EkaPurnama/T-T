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
//10 Januari 2014
//azimi
//document ready action

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

function takeDot(bln){
    if(bln){
        $.ajax({
            url: 'data/ajax/monitor/'+bln,
            cache: false,
            success: function(data){
                $('tbody#ajax_table_spd').html(data);
            }
        });
    }else{
        $.ajax({
            url: 'data/ajax/monitor',
            cache: false,
            success: function(data){
                $('tbody#ajax_table_spd').html(data);
            }
        });
    }
}

/////form SPD
//reset
function fsCaller(e){
//adds
$('#form_spd').on('show.bs.modal', function (e) {
    $jenis = $(e.relatedTarget).attr('data-jenis');
    $idbaru = $(e.relatedTarget).data('id-baru');
    $idpeng = $(e.relatedTarget).data('id-pengikut');
    $kd = $(e.relatedTarget).attr('data-action-to');

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
                        $val = $('div#select_'+$jenis).find('option[value='+item.nip+']').text();
                        $('span#nama_nama').text($val);

                    });
                }
            });
            $(this).find('.form-header #edition').html("Revisi data SPD no. <span style='text-decoration:Capitalized'>"+$kd+"</span>");
            $('div#select_'+$jenis).addClass('hide');
            $('#o_pengikut').addClass('hide');
            $('a[href=#o_pengikut]').addClass('hide');
            $('div.edithide').addClass('hide');
            $('div#sd').addClass('hide');

        }else{
            if ($jenis != 'khusus'){
                $('#select_khusus').addClass('hide');
                $('#select_umum').removeClass('hide');
                $('#o_pengikut').removeClass('hide');
                $('a[href=#o_pengikut]').removeClass('hide');
            }else{
                $('#select_umum').addClass('hide');
                $('#select_khusus').removeClass('hide');
                $('#o_pengikut').addClass('hide');
                $('a[href=#o_pengikut]').addClass('hide');
            }
            if($idbaru){
                $('form#illuminati input[name=id_spd]').attr('value',$idbaru);
                $('form#illuminati input[name=id_pengikut]').attr('value',$idpeng);
                $('form#illuminati input[name=jenis]').attr('value',$jenis);
            }
            $(this).find('.form-header #edition').html("Buat SPD <span style='text-decoration:Capitalized'>"+$jenis+"</span> Baru");
            $('form#illuminati').attr('action','post/spd/create');
            $('div.edithide').removeClass('hide');
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
            $('select[name="nip[]"]').removeAttr('disabled');
            $('div#select_'+$jenis+' span').text(' ');
            $.ajax({
                url : "new/kode_spd",
                cache : false,
                success : function (data){
                    $('input[name="no_surat"]').attr('value', data);
                }
            })
        };

    });
}

//ismi
//Rincian biaya
function rb(dome){
$('#form_rincian_biaya').on('show.bs.modal', function (e){
    var g = ["data-action-to","data-id-rinci"];
    var rin = [];
    for(i=0;i<g.length;i++){
        rin[i] = $(e.relatedTarget).attr(g[i]);
    }
    $(this).find('.form-header code').html(rin[0]);
    $(this).find('button.ekspor').attr('action', 'ekspor/data/rincian_biaya/'+rin[0]);
    $(this).find('.hidden').html("<input name=\"kode_spd\" type=\"hidden\" value=\""+ rin[0] +"\"><input name=\"id_rincian\" type=\"hidden\" value=\""+ rin[1] +"\">");
    $(this).find('.form-medium #frm-rincian').attr('action','rincian/post/create');
    $.ajax({
        url: "ajax/get/nama/" + rin[0],
        cache: false,
        success: function(data){
            $o = 0;
            $.each(data, function(r,ritem){
                $('div#new-rincian-khusus').append('<h2 id=rincianke'+$o+'>'+($o+1)+'. <strong>'+data[r][0].nama_pemangku+'</strong><a href=#rincianke'+($o+1)+' style=color:white;text-decoration:none; class=pull-right>Selanjutnya <i class=icon-arrow-down-3></i></a></h2><input type="hidden" name="jumlah_data" value="'+($o+1)+'"><input type="hidden" name="nip_'+$o+'" value="'+data[r][0].nip+'"><div class="form-group">&nbsp;Uang Harian<input id="input_uangharian"name="uangharian_'+data[r][0].nip+'"type="number"class="form-control"style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div>Uang Makan<input id="input_uangharian"name="uangmakan_'+data[r][0].nip+'"type="number"class="form-control"style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Transportasi<input id="input_transportasi"name="transportasi_'+data[r][0].nip+'"  type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Penginapan<input id="input_penginapan"name="penginapan_'+data[r][0].nip+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Uang Representasi<input id="input_representasi" name="representasi_'+data[r][0].nip+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Sewa Kendaraan<input id="input_sewakendaraan"name="sewakendaraan_'+data[r][0].nip+'" type="number" class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div><div class="form-group">&nbsp;Biaya Menjemput/Mengantar Jenazah<input id="input_jenazah"name="jenazah_'+data[r][0].nip+'" type="number"class="form-control" style="text-align: right; padding-right: 10px; margin: 5px;"><div class="busek"></div></div>');
                $.ajax({
                    url: "ajax/rincian/" + rin[0],
                    cache: false,
                    success: function(mata){
                        var prefix = ['Uang Harian','Uang Makan','Transportasi','Penginapan','Representasi','Sewa Kendaraan','Jenazah'];
                        var name = ['uangharian','uangmakan','transportasi','penginapan','representasi','sewakendaraan','jenazah'];
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
            $o++;
            });
            $('a[href=#rincianke'+($o)+']').html('');

        $('input[type=number]').each(function(){
            $(this).attr('min','1').attr('max','99999999').attr('size','8');
            
    $(document).ready(function(){

        $('form#frm-rincian input[type=number]').each(function() {

            $(this).keyup(function(){
                calculateSum();
            });
        });
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

    });
        $("#pandurinci").click(function(){
            bootstro.start(".pandurinci");    
        });
    function calculateSum() {

        var sum = 0;
        //iterate through each textboxes and add the values
        $('form#frm-rincian input[type=number]').each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("span#totalValue").html('Rp. ' + sum.toFixed(2));
    };
        });
        dome;
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
    $sumberdana = $(e.relatedTarget).attr('data-sumberdana');

    $.ajax({
        url: "data/ajax/spd/" + $kodespd,
        cache: false,
        success: function(data){
            var v = [];
            $.each(data, function(i,item){
                v[0] = item.tgl_berangkat_revisi;
                if(v[0] == null){v[0]='-'}
                v[1] = item.tgl_kembali_revisi;
                if(v[1] == null){v[1]='-'}
                v[2] = item.sumberdana;
                if(v[2]){if(v[2] == 1){ v[2] = 'APBD'}else{ v[2] = 'APBN'}}else{ v[2] = '-'}
                v[3] = item.status;
                if(v[3] == null){v[3]='-'}
                v[4] = item.reason;
                if(v[4] == null){v[4]='-'}
                v[5] = item.dasar_penugasan;
                if(v[5] == null){v[5]='-'}
            //template detail data
            $text = "<table class='table table-condensed table-striped'><thead><tr><th class='col-sm-4'>No. Surat</th><th><code>"+item.kode_spd+
            "</code></th></tr></thead><tbody><tr><td>Nama Petugas</td><td id='gonenama'></td></tr><tr><td>Berangkat Dari</td><td>"+item.tmpt_asal+
            "</td></tr><tr><td>Tujuan Perjalanan</td><td>"+item.tujuan+
            "</td></tr><tr><td>Waktu Mulai</td><td>"+item.waktu_mulai+" s/d "+item.waktu_selesai+
            "</td></tr><tr><td>Tanggal Berangkat</td><td>"+item.tgl_berangkat+
            "</td></tr><tr><td>Tanggal Kembali</td><td>"+item.tgl_kembali+
            "</td></tr><tr><td>Tanggal Berangkat Revisi</td><td>"+v[0]+
            "</td></tr><tr><td>Tanggal Kembali Revisi</td><td>"+v[1]+
            "</td></tr><tr><td>Maksud Tujuan</td><td>"+item.maksud+
            "</td></tr><tr><td>Transportasi</td><td>"+item.transportasi+
            "</td></tr><tr><td>Sumber Dana</td><td>"+v[2]+
            "</td></tr><tr><td>Dasar Penugasan</td><td>"+v[5]+
            "</td></tr><tr><td>MAK</td><td>"+item.mak+
            "</td></tr><tr><td>Status</td><td>"+v[3]+
            "</td></tr><tr><td>Alasan</td><td>"+v[4]+"</td></tr></tbody></table>";

            $('div.child_detail').append($text);
            $('form#ekspor_kwitansi').append('<input type=hidden name=maksud value="'+item.maksud+'""><input type=hidden name=tanggalkwitansi value="'+item.tgl_berangkat+'""><input type=hidden name=mak value="'+item.mak+'"">');
            $('form#ekspor_lampiran_sppd').append('<input type=hidden name=tgl_berangkat value="'+item.tgl_berangkat+'"><input type=hidden name=tgl_kembali value="'+item.tgl_kembali+'"><input type=hidden name=tujuan value="'+item.tujuan+'"><input type=hidden name=tmpt_asal value="'+item.tmpt_asal+'"><input type=hidden name=transportasi value="'+item.transportasi+'"><input type=hidden name=tingkat_biaya value="'+item.tingkat_biaya+'">');
            });
        }
    });
    var jumlah = 0;
    var jumlah_khusus = 0;
    $.ajax({
        url: "ajax/get/nama/" + $kodespd,
        cache: false,
        success: function(data){
            $ah = 0;
            $.each(data, function(l,litem){
                $i = 0;
                
                $('div.child_rincian').append('<div class="child_'+data[l][0].nip+'"><strong>'+data[l][0].nama_pemangku+'</strong><br>'+data[l][0].nip+'<table class="table table-condensed table-striped"><thead><tr><th class="col-sm-4">Komponen Biaya</th><th>Jumlah</th></tr><tbody></tbody></table></div>');
                $('td#gonenama').append('<strong>'+data[l][0].nama_pemangku+'</strong><br>'+data[l][0].nip+'<br>');
                $('form#ekspor_lampiran_sppd').attr('action', 'ekspor/lampiran/'+$kodespd+'/'+$sumberdana);
                $('form#ekspor_lampiran_sppd').append('<input type="hidden" name="nama['+$ah+']" value="'+data[l][0].nama_pemangku+'"><input type="hidden" name="nip['+$ah+']" value="'+data[l][0].nip+'"><input type="hidden" name="golongan['+$ah+']" value="'+data[l][0].golongan_ruang+'"><input type="hidden" name="pangkat['+$ah+']" value="'+data[l][0].pangkat+'"><input type="hidden" name="jabatan['+$ah+']" value="'+data[l][0].jabatan+'">');
                $ah++;      
                $.ajax({
                    url: "ajax/detail/"+$kodespd+"/" + l,
                    cache: false,
                    success: function(mata){
                        $r = $i;
                        $.each(mata, function(i,item){
                            $('div.child_'+item.nip+' table tbody').append("<tr><td>"+ item.komponen_biaya + "</td><td>" + item.jumlah+"</td></tr>");
                            if(!isNaN(item.jumlah)) jumlah += item.jumlah;
                        });
                        jumlah_khusus += jumlah;
                        $('div.child_'+l+' table tbody').append("<tr><td> <strong>Total</strong> </td><td style='font-style: italic;color: green;font-weight: bold;'>" + jumlah +"</td></tr>");
                        $('div#alltotal').html('<span class="col-sm-4">Total Semua</span><span style="color:#900;font-weight:bolder;">'+jumlah_khusus+'</span>');
                        $('a#ekspor_surat_tugas').attr('href', 'ekspor/surat_tugas/'+$kodespd+'/'+$sumberdana);
                        $('a#ekspor_sppd').attr('href', 'ekspor/sppd/'+$kodespd+'/'+$sumberdana);
                        $('form#ekspor_rincian_biaya').attr('action', 'ekspor/rincian/'+$kodespd+'/'+$sumberdana);
                        $('form#ekspor_rincian_biaya').append('<input name=total['+$i+'] type=hidden value='+jumlah+'><input type=hidden name=nip['+$i+'] value="'+data[l][0].nip+'"><input type=hidden name=nama['+($i++)+'] value="'+data[l][0].nama_pemangku+'">');
                        $('form#ekspor_kwitansi').attr('action', 'ekspor/kwitansi/'+$kodespd+'/'+$sumberdana);
                        $('form#ekspor_kwitansi').append('<input name=total['+$i+'] type=hidden value='+jumlah+'><input type=hidden name=nip['+$i+'] value="'+data[l][0].nip+'"><input type=hidden name=nama['+($i++)+'] value="'+data[l][0].nama_pemangku+'">');
                        jumlah = 0;
                    }
                });
            });
        }
    });

    $.ajax({
        url: "data/ajax/pengikut/" + $kodespd,
        cache: false,
        success: function(data){
            $.each(data, function(i,item){
                $('div.child_pengikut').append("<li>"+ item.nama +"</li>")
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
    $("div#alltotal").html("");
    });
}

//ismi
//ubah jadwal
function ubah_jadwal(){
$('#form_ubah_jadwal').on('show.bs.modal', function (e){
    $at = $(e.relatedTarget).attr('data-action-to');
    $(this).find('.form-header code').html($at);  
    $('form.child-ubah-jadwal').attr('action', 'post/batal/' + $at);
    
    $.ajax({
        url: "data/ajax/spd/" + $at,
        cache: false,
        success: function(data){
            $.each(data, function(i,item){
                $('div.child-tgl-berangkat').append("<code>"+item.tgl_berangkat+"</code>");
                $('div.child-tgl-kembali').append("<code>"+item.tgl_kembali+"</code>");
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
    $(this).find('form.child-batalkan').attr('action', 'post/pembatal/' + $kodespd);
});
//reset form batalkan
$('#form_batalkan').on('hidden.bs.modal', function (e){
    $(this).find('div.form-header code').html("");
    $(this).find('form.child-batalkan').attr('action', '');
});
}
function bulanizer(bln){
    $('select[name=bulan]').find('option[value='+bln+']').attr('selected','selected');
    $('select[name=bulan]').multiselect('refresh');
}