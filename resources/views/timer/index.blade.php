<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
                            <h1 class="m-0">Timer</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li> -->
                            </ol>
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
                                <span class="info-box-number">{{$item->time }}</span>
                                <span>{{$item->date ? $item->date : '-' }}</span>
                                <a href="/timer/{{$item->id}}" type="button" class="btn btn-info">Mulai Kerja</a>
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

    <!-- jQuery -->

    <script>
        // Set the date we're counting down to
        var time = "12:40:34";
        var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug" , "Sep", "Okt", "Nov" , "Des"];
        var date = "11-04-2022";
        var newDate = month[date.split("-")[0] - 1] + " " + date.split("-")[1] + "," + " " + date.split("-")[2] + " " + time;
        console.log(newDate)
        var countDownDate = new Date(newDate).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "Waktu Habis";
            }
        }, 1000);
    </script>
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>