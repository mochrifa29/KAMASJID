 {{-- Modal Kategori --}}
 <div class="modal fade" id="kategoriModal" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Form Tambah Kategori</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row">
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Kategori Kas</label>
                         <input type="text" class="form-control" id="kategori_kas">
                         <span class="text-danger mt-2 d-none" id="msg-kategori"></span>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button class="btn btn-primary" id="btn-simpan">Simpan</button>
             </div>
         </div>
     </div>
 </div>
