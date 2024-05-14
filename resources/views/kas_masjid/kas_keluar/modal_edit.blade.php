 {{-- Modal Kategori --}}
 <div class="modal fade" id="kas_keluarEdit" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Form Edit Kas Keluar</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row">
                     <input type="hidden" id="id_rekap">
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Kategori</label>
                         <select class="form-select" id="kategoriEdit" aria-label="Default select example">
                             <option value="">Pilih Kategori</option>
                             @foreach ($kategori as $item)
                                 <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                             @endforeach
                         </select>
                         <span class="text-danger mt-2 d-none" id="msg-kategoriEdit"></span>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Uraian Pengeluaran</label>
                         <input type="text" class="form-control" id="uraian_pengeluaranEdit">
                         <span class="text-danger mt-2 d-none" id="msg-uraian_pengeluaranEdit"></span>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Jumlah Pengeluaran</label>
                         <input type="text" class="form-control" id="jumlah_pengeluaranEdit">
                         <span class="text-danger mt-2 d-none" id="msg-jumlah_pengeluaranEdit"></span>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Tanggal Keluar</label>
                         <input type="date" class="form-control" id="tanggal_keluarEdit">
                         <span class="text-danger mt-2 d-none" id="msg-tanggal_keluarEdit"></span>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button class="btn btn-primary" id="btn-update">Ubah</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     function formatRupiah(angka, prefix) {
         var number_string = angka.replace(/[^,\d]/g, '').toString(),
             split = number_string.split(','),
             sisa = split[0].length % 3,
             rupiah = split[0].substr(0, sisa),
             ribuan = split[0].substr(sisa).match(/\d{3}/gi);

         if (ribuan) {
             separator = sisa ? '.' : '';
             rupiah += separator + ribuan.join('.');
         }

         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
         return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
     }
     $('#jumlah_pengeluaranEdit').keyup(function() {
         var $this = $(this);
         $this.val(formatRupiah($this.val(), 'Rp.'));
     });

     // update
     $("#btn-update").click(function() {
         data = {
             "id_kategori": $("#kategoriEdit").val(),
             "uraian": $("#uraian_pengeluaranEdit").val(),
             "keluar": $("#jumlah_pengeluaranEdit").val().replace(/,.*|[^0-9]/g, ''),
             "tanggal": $("#tanggal_keluarEdit").val(),
             "_token": $("meta[name='csrf-token']").attr("content")
         };
         let id = $("#id_rekap").val()
         $.ajax({
             type: "PUT",
             url: "/kas_keluar/update/" + id,
             cache: false,
             data: data,
             success: function(response) {
                 if (response.status == 200) {
                     $("#kas_keluarEdit").modal('hide');
                     Swal.fire({
                         icon: "success",
                         title: response.message,
                         showConfirmButton: false,
                         timer: 2000
                     });
                     $('#kas_keluarTable').DataTable().ajax.reload()
                     saldo_pengeluaran()
                 }
             },
             error: function(error) {
                 if (error.responseJSON.id_kategori[0]) {

                     //show alert
                     $('#msg-kategoriEdit').removeClass('d-none');
                     $('#msg-kategoriEdit').addClass('d-block');

                     //add message to alert
                     $('#msg-kategoriEdit').html(error.responseJSON.id_kategori[0]);
                 }

                 if (error.responseJSON.uraian[0]) {

                     //show alert
                     $('#msg-uraian_pengeluaranEdit').removeClass('d-none');
                     $('#msg-uraian_pengeluaranEdit').addClass('d-block');

                     //add message to alert
                     $('#msg-uraian_pengeluaranEdit').html(error.responseJSON
                         .uraian[0]);
                 }

                 if (error.responseJSON.keluar[0]) {

                     //show alert
                     $('#msg-jumlah_pengeluaranEdit').removeClass('d-none');
                     $('#msg-jumlah_pengeluaranEdit').addClass('d-block');

                     //add message to alert
                     $('#msg-jumlah_pengeluaranEdit').html(error.responseJSON
                         .keluar[0]);
                 }

                 if (error.responseJSON.tanggal[0]) {

                     //show alert
                     $('#msg-tanggal_keluarEdit').removeClass('d-none');
                     $('#msg-tanggal_keluarEdit').addClass('d-block');

                     //add message to alert
                     $('#msg-tanggal_keluarEdit').html(error.responseJSON.tanggal[
                         0]);
                 }
             }

         })

     })
 </script>
