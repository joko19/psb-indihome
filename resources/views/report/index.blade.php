<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h1 class="m-0">Data Report</h1>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    @if (auth()->user()->level == "admin")
                                    <th>Jenih Identitas</th>
                                    <th>Nomor Identitas</th>
                                    <th>Teknisi</th>
                                    @endif
                                    @if (auth()->user()->level == "teknisi")
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    @endif
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataReport as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->phone}}</td>
                                    @if (auth()->user()->level == "admin")
                                    <td>{{$item->typeIdentity}}</td>
                                    <td>{{$item->numberIdentity}}</td>
                                    <td>{{$item->teknisi}}</td>
                                    @endif
                                    @if (auth()->user()->level == "teknisi")
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    @endif
                                    <td><a href="/report/{{$item->id}}" + {{$item->id}} type="button" class="btn btn-success">View Report</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <!-- jQuery -->
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>