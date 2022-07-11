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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <span class="m-2 text-md">Schedule
                            </span>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="row">
                    @foreach ($dataOrder as $item)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-danger">
                            <div class="info-box-content">
                                <span class="info-box-number">{{$item->name}}</span>
                                <span class="progress-description">
                                    {{$item->address}}
                                </span>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <span class="info-box-number">{{$item->teknisi ? $item->teknisi : '-' }}</span>
                                <span>{{$item->date ? $item->date : '-' }}</span>
                                <a href="/schedule/{{$item->id}}" type="button" class="btn btn-info">{{$item->date ? 'Ubah' : 'Atur' }} Jadwal</a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    @endforeach
                </div>
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

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>