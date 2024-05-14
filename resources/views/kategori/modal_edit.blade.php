 {{-- Modal Kategori --}}
 <div class="modal fade" id="kategoriEdit" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Form Edit Kategori</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="row">
                     <input type="hidden" id="id_kategori">
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Kategori Kas</label>
                         <input type="text" class="form-control" id="kategori_kasEdit">
                         <span class="text-danger mt-2 d-none" id="msg-kategoriEdit"></span>
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
