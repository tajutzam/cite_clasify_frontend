@extends('layouts.dashboard')


@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Dashboard</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{ route('dashboard.index', ['id' => 1]) }}" class="text-white text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">User</li>
                </ul>
            </div>
            <div class="d-flex align-items-center py-3 py-md-1">
                <a href="#" class="btn btn-bg-white btn-active-color-primary" data-bs-toggle="modal"
                    id="kt_toolbar_primary_button" data-bs-toggle="modal" data-bs-target="#add_user">Create</a>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                <div class="col">
                    <div class="card mb-xl-3 w-full">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Data User</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="card card-p-0 card-flush">
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    <div class="card-title">

                                        <div class="d-flex align-items-center position-relative my-1">
                                            <input type="text" data-kt-filter="search"
                                                class="form-control form-control-solid w-250px ps-14"
                                                placeholder="Search User" />
                                        </div>
                                        <div id="kt_datatable_example_1_export" class="d-none"></div>
                                    </div>
                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                            Export Report
                                        </button>
                                        <div id="kt_datatable_example_export_menu"
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="copy">
                                                    Copy to clipboard
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="excel">
                                                    Export as Excel
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                                    Export as CSV
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                                    Export as PDF
                                                </a>
                                            </div>
                                        </div>
                                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table align-middle  table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                <th class="min-w-100px">Name</th>
                                                <th class="min-w-100px">Email</th>
                                                <th class="min-w-100px">Role</th>
                                                <th class="min-w-100px">iS Google Account</th>
                                                <th class="text-end min-w-75px">Image</th>
                                                <th class="text-end min-w-100px pe-5">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($users as $item)
                                                <tr>
                                                    <td>
                                                        <span class="text-gray-900 text-hover-primary">
                                                            {{ $item->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-gray-900 text-hover-primary">
                                                            {{ $item->email }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-hover-primary badge badge-light-success">
                                                            {{ $item->role }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-900 text-hover-primary badge badge-light-danger">
                                                            {{ $item->is_google_account ? 'Ya' : 'Bukan' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <img class="img-fluid rounded w-25" referrerpolicy="no-referrer"
                                                            src="{{ $item->is_google_account ? $item->image : asset('assets/media/avatars/150-25.jpg') }}"
                                                            alt="">
                                                    </td>
                                                    <td class="d-flex justify-content-center gap-2">
                                                        <button class="btn  btn-sm btn-edit" data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                                            data-role="{{ $item->role }}"
                                                            @if ($item->role == 'admin') disabled @endif>
                                                            <i class="fa-solid fa-pen-to-square text-warning"></i>
                                                        </button>
                                                        <button class="btn  btn-sm btn-delete"
                                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                            @if ($item->role == 'admin') disabled @endif>
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="add_user">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.user.store', ['id' => 1]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah User</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-solid" placeholder="email"
                                name="email" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-solid" placeholder="name"
                                name="name" />
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-solid" placeholder="Password"
                                name="password" />
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control form-control-solid"
                                placeholder="Konfirmasi Password" name="password_confirmation" />
                        </div>


                        <div class="mb-3">
                            <select name="role" class="form-select" data-control="select2"
                                data-placeholder="Select an Role">
                                <option></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <input type="file" class="form-control form-control-solid" placeholder="Masukan Foto"
                                name="image" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                let selectedUserId = null;

                $(".btn-edit").click(function() {
                    let userId = $(this).data("id");
                    let userName = $(this).data("name");
                    let userEmail = $(this).data("email");
                    let userRole = $(this).data("role");

                    $("#editUserId").val(userId);
                    $("#editName").val(userName);
                    $("#editEmail").val(userEmail);
                    $("#editRole").val(userRole);

                    $("#editUserModal").modal("show");
                });

                $("#editUserForm").submit(function(e) {
                    e.preventDefault();

                    let userId = $("#editUserId").val();
                    let formData = {
                        _token: "{{ csrf_token() }}",
                        name: $("#editName").val(),
                        email: $("#editEmail").val(),
                        role: $("#editRole").val()
                    };

                    // 🔄 Tampilkan Swal Loading
                    Swal.fire({
                        title: "Memproses...",
                        text: "Harap tunggu sebentar.",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: `{{ url('dashboard/user') }}/${userId}`,
                        type: "PUT",
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                title: response.title ||
                                    "Berhasil!",
                                text: response.message ||
                                    "User berhasil diperbarui.",
                                icon: response.icon || "success",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location
                                        .reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            let response = xhr.responseJSON;
                            Swal.fire({
                                title: response?.title || "Gagal!",
                                text: response?.message ||
                                    "Terjadi kesalahan saat memperbarui user.",
                                icon: "error",
                                confirmButtonText: "Coba Lagi"
                            });
                            console.log(xhr);
                        }
                    });
                });


                // Open Delete Modal
                $(".btn-delete").click(function() {
                    selectedUserId = $(this).data("id");
                    let userName = $(this).data("name");

                    $("#deleteUserName").text(userName);
                    $("#deleteUserModal").modal("show");
                });

                function deleteUser(userId) {
                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "User yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Tampilkan loading Swal
                            Swal.fire({
                                title: "Menghapus...",
                                text: "Harap tunggu sebentar.",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                url: `{{ url('dashboard/user') }}/${userId}`,
                                type: "DELETE",
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: response.title,
                                        text: response.message,
                                        icon: response.icon,
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: "Terjadi kesalahan saat menghapus user.",
                                        icon: "error",
                                        confirmButtonText: "Coba Lagi"
                                    });
                                    console.log(xhr);
                                }
                            });
                        }
                    });
                }
                $(".btn-delete").click(function() {
                    deleteUser(selectedUserId)
                });
            });
        </script>
    @endpush
@endsection
