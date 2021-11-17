!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples
    SweetAlert.prototype.init = function() {

    $('.swal_delete').click(function(e){
      // const hapus_href = $('.swal_delete').data('hapusId');
      // console.log(hapus_href);
        e.preventDefault();
          // const url_hapus = $('.delete_url').data('hapus_id');
          // console.log(url_hapus);
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        }, function(){
            // $.ajax({
            //   url: url_hapus,
            //   type: "POST",
            //   data: $('.swal_delete').serialize(), //serialize() untuk mengambil semua data di dalam form
            //   dataType: "html",
            //   success: function(){
            //       setTimeout(function(){
            //         swal({
            //           title:"Data Berhasil Disimpan",
            //           text: "Terimakasih",
            //           type: "success"
            //         });
            //       }, 1500);
            //     }
            //   });
            // document.location.href = hapus_href;
            swal({
              title: "Terhapus",
              text: "Data Berhasil di Hapus",
              type: "success",
              timer: 1500
            });
        });
    });

    const fd = $('.pesan_flash').data('flashdata');

    if (fd) {
      // console.log(fd);
      swal({
      title: "Data Berhasil",
      text: "Di" + fd,
      type: "success",
      timer: 2000
      });
    }

    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);
