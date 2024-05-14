@extends('layouts.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Kas Masjid</li>
                    <li class="breadcrumb-item">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success  alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Saldo Pemasukan</h4>
                        <p>
                        <h2 id="saldo_pemasukan"></h2>
                        </p>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kas_masukModal">
                                    Tambah Data
                                </button>
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="kas_masuk table" id="kas_masukTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Uraian</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    {{-- Modal Kategori --}}
    <div class="modal fade" id="kas_masukModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Edit Kas Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row">
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" aria-label="Default select example">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger mt-2 d-none" id="msg-kategori"></span>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Uraian Pemasukan</label>
                            <input type="text" class="form-control" id="uraian_pemasukan">
                            <span class="text-danger mt-2 d-none" id="msg-uraian_pemasukan"></span>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Jumlah Pemasukan</label>
                            <input type="text" class="form-control" id="jumlah_pemasukan">
                            <span class="text-danger mt-2 d-none" id="msg-jumlah_pemasukan"></span>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="validationCustom01" class="form-label">Tanggal Pemasukan</label>
                            <input type="date" class="form-control" id="tanggal_masuk">
                            <span class="text-danger mt-2 d-none" id="msg-tanggal_masuk"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btn-simpan">simpan</button>
                </div>
            </div>
        </div>
    </div>

    @include('kas_masjid.kas_masuk.modal_edit')

    <script>
        $(document).ready(function() {

            $('#kas_masukTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%'
                    },
                    {
                        data: 'kategori.kategori',
                        name: 'id_kategori',
                        orderable: true,
                        searchable: true,
                        width: '25%'
                    },
                    {
                        data: 'uraian',
                        name: 'uraian',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'masuk',
                        name: 'masuk',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%'
                    }
                ]
            });

            saldo_pemasukan()

        })

        function saldo_pemasukan() {

            $.ajax({
                type: "GET",
                url: "/kas_masuk/saldo_pemasukan",
                cache: false,
                success: function(data) {

                    if (data.saldo) {
                        let rupiahFormat = data.saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $("#saldo_pemasukan").text('Rp.' + rupiahFormat)
                    } else {
                        $("#saldo_pemasukan").text('Rp. 0')
                    }
                }
            })
        }

        // hapus data
        function hapus(id) {

            Swal.fire({
                title: "Apakah kamu yakin ingin menghapusnya?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let token = $("meta[name='csrf-token']").attr("content")
                    $.ajax({
                        type: "DELETE",
                        url: "/rekapKas_masjid/" + id,
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('#kas_masukTable').DataTable().ajax.reload()
                            saldo_pemasukan()
                        }
                    })
                }
            });

        }

        // edit
        function EditData(id) {
            $("#kas_masukEdit").modal('show');
            let token = $("meta[name='csrf-token']").attr("content")
            $.ajax({
                type: "GET",
                url: "/rekapKas_masjid/" + id + '/edit',
                cache: false,
                data: {
                    "_token": token
                },
                success: function(response) {
                    rekap = response.data
                    $("#kategoriEdit").val(rekap.id_kategori)
                    $("#uraian_pemasukanEdit").val(rekap.uraian)
                    $("#jumlah_pemasukanEdit").val(rekap.masuk)
                    $("#tanggal_masukEdit").val(rekap.tanggal)
                    $("#id_rekap").val(rekap.id)

                }
            })
        }

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
        $('#jumlah_pemasukan').keyup(function() {
            var $this = $(this);
            $this.val(formatRupiah($this.val(), 'Rp.'));
        });

        // simpan
        $("#btn-simpan").click(function() {
            data = {
                '_token': $("meta[name='csrf-token']").attr("content"),
                'id_kategori': $("#kategori").val(),
                'uraian': $("#uraian_pemasukan").val(),
                'masuk': $("#jumlah_pemasukan").val().replace(/,.*|[^0-9]/g, ''),
                'tanggal': $("#tanggal_masuk").val(),
            };

            $.ajax({
                type: "POST",
                url: "/kas_masuk",
                cache: false,
                data: data,
                success: function(response) {
                    $("#kas_masukModal").modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#uraian_pemasukan").val('')
                    $("#jumlah_pemasukan").val('')
                    $("#tanggal_masuk").val('')
                    $('#kas_masukTable').DataTable().ajax.reload()
                    saldo_pemasukan()
                },
                error: function(error) {
                    if (error.responseJSON.id_kategori[0]) {

                        //show alert
                        $('#msg-kategori').removeClass('d-none');
                        $('#msg-kategori').addClass('d-block');

                        //add message to alert
                        $('#msg-kategori').html(error.responseJSON.id_kategori[0]);
                    }

                    if (error.responseJSON.uraian[0]) {

                        //show alert
                        $('#msg-uraian_pemasukan').removeClass('d-none');
                        $('#msg-uraian_pemasukan').addClass('d-block');

                        //add message to alert
                        $('#msg-uraian_pemasukan').html(error.responseJSON.uraian[
                            0]);
                    }

                    if (error.responseJSON.masuk[0]) {

                        //show alert
                        $('#msg-jumlah_pemasukan').removeClass('d-none');
                        $('#msg-jumlah_pemasukan').addClass('d-block');

                        //add message to alert
                        $('#msg-jumlah_pemasukan').html(error.responseJSON.masuk[
                            0]);
                    }

                    if (error.responseJSON.tanggal[0]) {

                        //show alert
                        $('#msg-tanggal_masuk').removeClass('d-none');
                        $('#msg-tanggal_masuk').addClass('d-block');

                        //add message to alert
                        $('#msg-tanggal_masuk').html(error.responseJSON.tanggal[0]);
                    }
                }
            })
        })
    </script>
@endsection
