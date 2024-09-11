@extends('app.layouts')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Data Pegawai</h1>

    <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
            <a href="{{ route('employees.create') }}" type="button" class="btn btn-success">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="col-md-6 text-right">
            <input type="text" name="datefilter" class="form-control" placeholder="Filter berdasarkan tanggal bergabung"/>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Employee Table -->
    <table id="employeeTable" class="table table-striped table-bordered">
        <thead style="text-align:center;">
            <tr>
                <th>No</th>
                <th>Profil</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Divisi</th>
                <th>Level</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/' . $employee->profile) }}" alt="{{ $employee->name }}" width="50"></td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->division }}</td>
                    <td>{{ $employee->level }}</td>
                    <td>{{ $employee->position }}</td>
                    <td> Rp {{ number_format($employee->salary, 2) }}</td>
                    <td>
                        {{ date('Y-m-d', strtotime($employee->hire_date)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#ModalAdd').modal('show');
        });
    </script>
@endif

    <!-- DataTables -->
    <script>
        $(document).ready(function() {
            $('#employeeTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "decimal":        "",
                    "emptyTable":     "Tidak ada data yang tersedia pada tabel ini",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered":   "(difilter dari _MAX_ total entri)",
                    "infoPostFix":    "",
                    "thousands":      ".",
                    "lengthMenu":     "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing":     "Sedang diproses...",
                    "search":         "Cari:",
                    "zeroRecords":    "Tidak ditemukan data yang sesuai",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Berikutnya",
                        "previous":   "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending":  ": aktifkan untuk mengurutkan kolom secara menaik",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom secara menurun"
                    }
                }
            });
        });
    </script>    

    <!-- DateRangePicker -->
    <script type="text/javascript">
        $(function() {
            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'MM/DD/YYYY' 
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var hireDate = data[9].trim();

                        console.log("Start Date: " + startDate + ", End Date: " + endDate + ", hireDate: " + hireDate);
                        if (hireDate >= startDate && hireDate <= endDate) {
                            return true;
                        }
                        return false;
                    }
                );
                $('#employeeTable').DataTable().draw();
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');

                $.fn.dataTable.ext.search.pop();
                $('#employeeTable').DataTable().draw();
            });
        });
    </script>

@endsection
