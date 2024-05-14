@extends('layouts.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#penggunaModal">
                                    Tambah Data
                                </button>
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table" id="penggunaTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>No Telpon</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
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
    @include('pengguna.modal_tambah')
    @include('pengguna.modal_edit')
    <script>
        $(document).ready(function() {

            $('#penggunaTable').DataTable({
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
                        data: 'nama',
                        name: 'nama',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                        orderable: true,
                        searchable: true,
                        width: '15%'
                    },
                    {
                        data: 'no_telpon',
                        name: 'no_telpon',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%'
                    }
                ]
            });
        })



        // simpan data
        $("#btn-simpanPengguna").click(function() {

            let nama = $("#nama").val();
            let jabatan = $("#jabatan").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let no_telpon = $("#no_telpon").val();
            let alamat = $("#alamat").val();


            let token = $("meta[name='csrf-token']").attr("content")
            $.ajax({
                type: "POST",
                url: "/pengguna",
                cache: false,
                data: {
                    "nama": nama,
                    "jabatan": jabatan,
                    "email": email,
                    "password": password,
                    "no_telpon": no_telpon,
                    "alamat": alamat,
                    "_token": token
                },
                success: function(response) {
                    $("#penggunaModal").modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#nama").val('')
                    $("#jabatan").val('')
                    $("#email").val('')
                    $("#password").val('')
                    $("#no_telpon").val('')
                    $("#alamat").val('')

                    $('#penggunaTable').DataTable().ajax.reload()
                },
                error: function(error) {
                    if (error.responseJSON.nama[0]) {

                        //show alert
                        $('#msg-nama').removeClass('d-none');
                        $('#msg-nama').addClass('d-block');

                        //add message to alert
                        $('#msg-nama').html(error.responseJSON.nama[0]);
                    }
                    if (error.responseJSON.jabatan[0]) {
                        //show alert
                        $('#msg-jabatan').removeClass('d-none');
                        $('#msg-jabatan').addClass('d-block');

                        //add message to alert
                        $('#msg-jabatan').html(error.responseJSON.jabatan[0]);
                    }

                    if (error.responseJSON.email[0]) {
                        //show alert
                        $('#msg-email').removeClass('d-none');
                        $('#msg-email').addClass('d-block');

                        //add message to alert
                        $('#msg-email').html(error.responseJSON.email[0]);
                    }

                    if (error.responseJSON.password[0]) {
                        //show alert
                        $('#msg-password').removeClass('d-none');
                        $('#msg-password').addClass('d-block');

                        //add message to alert
                        $('#msg-password').html(error.responseJSON.password[0]);
                    }
                    if (error.responseJSON.no_telpon[0]) {
                        //show alert
                        $('#msg-no_telpon').removeClass('d-none');
                        $('#msg-no_telpon').addClass('d-block');

                        //add message to alert
                        $('#msg-no_telpon').html(error.responseJSON.no_telpon[0]);
                    }
                    if (error.responseJSON.alamat[0]) {
                        //show alert
                        $('#msg-alamat').removeClass('d-none');
                        $('#msg-alamat').addClass('d-block');

                        //add message to alert
                        $('#msg-alamat').html(error.responseJSON.alamat[0]);
                    }
                }
            })
        })

        //hapus
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
                        url: "/pengguna/" + id,
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
                            $('#penggunaTable').DataTable().ajax.reload()
                        }
                    })
                }
            });
        }

        //edit
        function edit(id) {
            $("#penggunaModalEdit").modal('show');
            let token = $("meta[name='csrf-token']").attr("content")
            $.ajax({
                type: "GET",
                url: "/pengguna/" + id + '/edit',
                cache: false,
                data: {
                    "_token": token
                },
                success: function(response) {
                    pengguna = response.data
                    $("#id_pengguna").val(pengguna.id)
                    $("#namaEdit").val(pengguna.nama)
                    $("#jabatanEdit").val(pengguna.jabatan)
                    $("#emailEdit").val(pengguna.email)
                    $("#passwordEdit").val(pengguna.password)
                    $("#no_telponEdit").val(pengguna.no_telpon)
                    $("#alamatEdit").val(pengguna.alamat)

                }
            })
        }

        // update
        $("#btn-update").click(function() {
            let id = $("#id_pengguna").val()
            data = {
                "nama": $("#namaEdit").val(),
                "jabatan": $("#jabatanEdit").val(),
                "email": $("#emailEdit").val(),
                "password": $("#passwordEdit").val(),
                "no_telpon": $("#no_telponEdit").val(),
                "alamat": $("#alamatEdit").val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            }
            $.ajax({
                type: "PUT",
                url: "/pengguna/" + id,
                cache: false,
                data: data,
                success: function(response) {
                    if (response.status == 200) {
                        $("#penggunaModalEdit").modal('hide');
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#penggunaTable').DataTable().ajax.reload()
                    }
                },
                error: function(error) {
                    if (error.responseJSON.nama[0]) {

                        //show alert
                        $('#msg-namaEdit').removeClass('d-none');
                        $('#msg-namaEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-namaEdit').html(error.responseJSON.nama[0]);
                    }
                    if (error.responseJSON.jabatan[0]) {
                        //show alert
                        $('#msg-jabatanEdit').removeClass('d-none');
                        $('#msg-jabatanEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-jabatanEdit').html(error.responseJSON.jabatan[0]);
                    }

                    if (error.responseJSON.email[0]) {
                        //show alert
                        $('#msg-emailEdit').removeClass('d-none');
                        $('#msg-emailEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-emailEdit').html(error.responseJSON.email[0]);
                    }

                    if (error.responseJSON.password[0]) {
                        //show alert
                        $('#msg-passwordEdit').removeClass('d-none');
                        $('#msg-passwordEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-passwordEdit').html(error.responseJSON.password[0]);
                    }
                    if (error.responseJSON.no_telpon[0]) {
                        //show alert
                        $('#msg-no_telponEdit').removeClass('d-none');
                        $('#msg-no_telponEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-no_telponEdit').html(error.responseJSON.no_telpon[0]);
                    }
                    if (error.responseJSON.alamat[0]) {
                        //show alert
                        $('#msg-alamatEdit').removeClass('d-none');
                        $('#msg-alamatEdit').addClass('d-block');

                        //add message to alert
                        $('#msg-alamatEdit').html(error.responseJSON.alamat[0]);
                    }
                }

            })

        })
    </script>
@endsection
