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
                <h1 class="m-0">Timer</h1>
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
                                <span class="info-box-number">{{$item->time }}</span>
                                <span>{{$item->date ? $item->date : '-' }}</span>
                                <a href="/timer/{{$item->id}}" type="button" class="btn btn-info">View</a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
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
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>