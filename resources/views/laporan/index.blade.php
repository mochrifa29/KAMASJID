@extends('layouts.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cetak Laporan</h5>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#cetak_excelModal"
                                class="btn btn-success"><i class="bi bi-file-earmark-excel-fill"></i></button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#cetak_pdfModal"
                                class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i></button>


                        </div>
                    </div>

                </div>
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <!-- Table with stripped rows -->
                            <table class="kas_masuk table" id="rekap_Table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Uraian</th>
                                        <th>Tanggal</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
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
    @include('laporan.excel')
    @include('laporan.pdf')
    <script>
        $(document).ready(function() {

            $('#rekap_Table').DataTable({
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
                        data: 'tanggal',
                        name: 'tanggal',
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
                        data: 'keluar',
                        name: 'keluar',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    }
                ]
            });

        })
    </script>
@endsection
