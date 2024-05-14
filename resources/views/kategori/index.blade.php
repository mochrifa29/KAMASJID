@extends('layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Kategori Kas</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kategoriModal">
                                    Tambah Data
                                </button>
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table" id="kategoriTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
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

    @include('kategori.modal_tambah')
    @include('kategori.modal_edit')

    <script>
        $(document).ready(function() {

            $('#kategoriTable').DataTable({
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
                        data: 'kategori',
                        name: 'kategori',
                        orderable: true,
                        searchable: true,
                        width: '25%'
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

        })


        // edit
        function EditData(id) {
            $("#kategoriEdit").modal('show');
            let token = $("meta[name='csrf-token']").attr("content")
            $.ajax({
                type: "GET",
                url: "/kategori/" + id + '/edit',
                cache: false,
                data: {
                    "_token": token
                },
                success: function(response) {
                    kategori = response.data
                    $("#kategori_kasEdit").val(kategori.kategori)
                    $("#id_kategori").val(kategori.id)

                }
            })
        }

        // update
        $("#btn-update").click(function() {
            let token = $("meta[name='csrf-token']").attr("content")
            let kategori_kas = $("#kategori_kasEdit").val()
            let id = $("#id_kategori").val()
            $.ajax({
                type: "PUT",
                url: "/kategori/" + id,
                cache: false,
                data: {
                    "kategori_kas": kategori_kas,
                    "_token": token
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#kategoriEdit").modal('hide');
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#kategoriTable').DataTable().ajax.reload();

                    }
                },
                error: function(error) {
                    //show alert
                    $('#msg-kategoriEdit').removeClass('d-none');
                    $('#msg-kategoriEdit').addClass('d-block');

                    //add message to alert
                    $('#msg-kategoriEdit').html(error.responseJSON.kategori_kas[0]);
                }

            })

        })

        // simpan data
        $("#btn-simpan").click(function() {

            let kategori_kas = $("#kategori_kas").val();
            let token = $("meta[name='csrf-token']").attr("content")
            $.ajax({
                type: "POST",
                url: "/kategori",
                cache: false,
                data: {
                    "kategori_kas": kategori_kas,
                    "_token": token
                },
                success: function(response) {
                    $("#kategoriModal").modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#kategori_kas").val('')
                    $('#kategoriTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    if (error.responseJSON.kategori_kas[0]) {

                        //show alert
                        $('#msg-kategori').removeClass('d-none');
                        $('#msg-kategori').addClass('d-block');

                        //add message to alert
                        $('#msg-kategori').html(error.responseJSON.kategori_kas[0]);
                    }
                }
            })
        })

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
                        url: "/kategori/" + id,
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
                            $('#kategoriTable').DataTable().ajax.reload();
                        }
                    })
                }
            });

        }
    </script>
@endsection
