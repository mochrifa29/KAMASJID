 {{-- Modal Kategori --}}
 <div class="modal fade" id="penggunaModal" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Form Tambah Pengguna</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row">
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Nama</label>
                         <input type="text" class="form-control" id="nama">
                         <span class="text-danger mt-2 d-none" id="msg-nama"></span>
                     </div>
                     <div class="col-md-12 mb-2">
                         <label for="validationCustom01" class="form-label">Jabatan</label>
                         <input type="text" class="form-control" id="jabatan">
                         <span class="text-danger mt-2 d-none" id="msg-jabatan"></span>
                     </div>
                     <div class="col-md-12 mb-4">
                         <label for="validationCustom01" class="form-label">Email</label>
                         <input type="text" class="form-control" id="email">
                         <span class="text-danger mt-2 d-none" id="msg-email"></span>
                     </div>
                     <div class="row">
                         <div class="col-md-6 mb-2">
                             <label for="validationCustom01" class="form-label">Password</label>
                             <input type="password" class="form-control" id="password">
                             <span class="text-danger mt-2 d-none" id="msg-password"></span>
                         </div>
                         <div class="col-md-6 mb-2">
                             <label for="validationCustom01" class="form-label">No Telpon</label>
                             <input type="text" class="form-control" id="no_telpon">
                             <span class="text-danger mt-2 d-none" id="msg-no_telpon"></span>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Alamat</label>
                         <textarea type="text" class="form-control" id="alamat"></textarea>
                         <span class="text-danger mt-2 d-none" id="msg-alamat"></span>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button class="btn btn-primary" id="btn-simpanPengguna">Simpan</button>
             </div>
         </div>
     </div>
 </div>
