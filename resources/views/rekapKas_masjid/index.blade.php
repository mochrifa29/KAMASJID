@extends('layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <table>
                            <tr>
                                <td>
                                    <h6 class="alert-heading">Saldo Pemasukan</h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading">: </h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading" id="saldo_pemasukan"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="alert-heading">Saldo Pengeluaran</h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading">: </h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading" id="saldo_pengeluaran"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="alert-heading">Saldo Akhir</h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading">: </h6>
                                </td>
                                <td>
                                    <h6 class="alert-heading" id="saldo_akhir"></h6>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body mt-3">
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

            saldo_pemasukan()
            saldo_pengeluaran()
            saldo_akhir()

        })

        function saldo_pemasukan() {

            $.ajax({
                type: "GET",
                url: "/rekapKas_masjid/saldo_pemasukan",
                cache: false,
                success: function(data) {

                    if (data.saldo) {
                        let rupiahFormat = data.saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $("#saldo_pemasukan").text(' Rp. ' + rupiahFormat)
                    } else {
                        $("#saldo_pemasukan").text(' Rp. 0')
                    }
                }
            })
        }

        function saldo_pengeluaran() {

            $.ajax({
                type: "GET",
                url: "/rekapKas_masjid/saldo_pengeluaran",
                cache: false,
                success: function(data) {

                    if (data.saldo) {
                        let rupiahFormat = data.saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $("#saldo_pengeluaran").text('Rp. ' + rupiahFormat)
                    } else {
                        $("#saldo_pengeluaran").text('Rp. 0')
                    }
                }
            })
        }

        function saldo_akhir() {

            $.ajax({
                type: "GET",
                url: "/rekapKas_masjid/saldo_akhir",
                cache: false,
                success: function(data) {

                    if (data.saldo) {
                        let rupiahFormat = data.saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $("#saldo_akhir").text('Rp. ' + rupiahFormat)
                    } else {
                        $("#saldo_akhir").text('Rp. 0')
                    }
                }
            })
        }
    </script>
@endsection
