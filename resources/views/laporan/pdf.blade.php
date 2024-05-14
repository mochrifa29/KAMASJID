 {{-- Modal Kategori --}}
    <div class="modal fade" id="cetak_pdfModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Pdf</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row">
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="uraian_pemasukan">
                            <span class="text-danger mt-2 d-none" id="msg-uraian_pemasukan"></span>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="jumlah_pemasukan">
                            <span class="text-danger mt-2 d-none" id="msg-jumlah_pemasukan"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btn-simpan">Cetak</button>
                </div>
            </div>
        </div>
    </div>