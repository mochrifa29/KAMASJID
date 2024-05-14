 {{-- Modal Kategori --}}
 <div class="modal fade" id="penggunaModalEdit" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Form Ubah Pengguna</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row">
                     <input type="hidden" id="id_pengguna">
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Nama</label>
                         <input type="text" class="form-control" id="namaEdit">
                         <span class="text-danger mt-2 d-none" id="msg-namaEdit"></span>
                     </div>
                     <div class="row">
                         <div class="col-md-6 mb-2">
                             <label for="validationCustom01" class="form-label">Jabatan</label>
                             <input type="text" class="form-control" id="jabatanEdit">
                             <span class="text-danger mt-2 d-none" id="msg-jabatanEdit"></span>
                         </div>
                         <div class="col-md-6 mb-2">
                             <label for="validationCustom01" class="form-label">Email</label>
                             <input type="text" class="form-control" id="emailEdit">
                             <span class="text-danger mt-2 d-none" id="msg-emailEdit"></span>
                         </div>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Password</label>
                         <input type="text" class="form-control" id="passwordEdit">
                         <span class="text-danger mt-2 d-none" id="msg-passwordEdit"></span>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">No Telpon</label>
                         <input type="text" class="form-control" id="no_telponEdit">
                         <span class="text-danger mt-2 d-none" id="msg-no_telponEdit"></span>
                     </div>
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Alamat</label>
                         <textarea type="text" class="form-control" id="alamatEdit"></textarea>
                         <span class="text-danger mt-2 d-none" id="msg-alamatEdit"></span>
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
