@extends('app.layouts')

@section('content')
<div class="container">
    <h2 class="text-center">Tambah Data Pegawai</h2>

    <div class="card mt-4">
        <div class="card-header text-center">
            <h4 class="mb-0">Form Tambah Data Pegawai</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" id="employeeForm">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Profil</label>
                    <div class="col-md-10">
                        <div class="dropzone" id="profileDropzone"></div>
                        <input type="hidden" name="profile" id="profileInput">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="name" placeholder="nama lengkap" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-md-10">
                        <select name="gender" class="form-control select2" required>
                            <option disabled selected> -- Pilih Jenis Kelamin -- </option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Alamat</label>
                    <div class="col-md-10">
                        <input type="text" name="address" placeholder="alamat tempat tinggal" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Divisi</label>
                    <div class="col-md-10">
                        <select name="division" class="form-control select2" required>
                            <option disabled selected> -- Pilih Divisi -- </option>
                            <option value="Marketing">Marketing</option>
                            <option value="HRD">HRD</option>
                            <option value="Finance">Finance</option>
                            <option value="Creative">Creative</option>
                            <option value="Operasional">Operasional</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Level</label>
                    <div class="col-md-10">
                        <select name="level" class="form-control select2" required>
                            <option disabled selected> -- Pilih Level -- </option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Jabatan</label>
                    <div class="col-md-10">
                        <input type="text" name="position" placeholder="jabatan" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Gaji</label>
                    <div class="col-md-10">
                        <input type="number" name="salary" placeholder="gaji" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Tanggal Bergabung</label>
                    <div class="col-md-10">
                        <input type="date" name="hire_date" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('employees.index') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#employeeForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                gender: {
                    required: true
                },
                address: {
                    required: true
                },
                division: {
                    required: true
                },
                level: {
                    required: true
                },
                position: {
                    required: true
                },
                salary: {
                    required: true,
                    number: true
                },
                hire_date: {
                    required: true,
                    date: true
                }
            },
            messages: {
                name: {
                    required: "Nama wajib diisi",
                    minlength: "Nama harus terdiri dari minimal 3 karakter"
                },
                gender: {
                    required: "Jenis kelamin wajib dipilih"
                },
                address: {
                    required: "Alamat wajib diisi"
                },
                division: {
                    required: "Divisi wajib dipilih"
                },
                level: {
                    required: "Level wajib dipilih"
                },
                position: {
                    required: "Jabatan wajib diisi"
                },
                salary: {
                    required: "Gaji wajib diisi",
                    number: "Gaji harus berupa angka"
                },
                hire_date: {
                    required: "Tanggal bergabung wajib diisi",
                    date: "Harap masukkan tanggal yang valid"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').find('.col-md-10').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
            });
    });
    </script>
    
    <script>
    Dropzone.autoDiscover = false;

    const profileDropzone = new Dropzone("#profileDropzone", {
        url: "{{ route('employees.uploadProfile') }}",
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('#profileInput').val(response.path);
        },
        removedfile: function (file) {
            $('#profileInput').val('');
            file.previewElement.remove();
        }
    });
    </script>

@endsection
