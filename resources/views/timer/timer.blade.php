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
            <div style="margin: 12px;" id="progress">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h1 id="demo" class="text-center h1" style="font-size: 72px;"></h1>
                        <button class="btn btn-success m-auto" data-toggle="modal" data-target="#exampleModal">Finish this process</button>
                    </div>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin telah menyelesaikan proses ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <div class="modal-body">
                    ...
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Belum</button>
                    <button type="button" class="btn btn-primary" id="finish">Iya</button>
                </div>
            </div>
        </div>
    </div>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            var data = []
            // var deadline = ""
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/timer/" + window.location.href.split('/')[4] + "/getTime",
                type: "GET",
                success: function(res) {
                    var prepare = res[0].prepare ? "<button style='border-radius: 5px; margin:4px; '>Manajemen Janji</button>" : "<button style='border-radius: 5px; margin:4px; background-color: green; color: white; '>Manajemen Janji</button>";
                    var otw = !res[0].ontheway && !res[0].prepare ? "<button style='border-radius: 5px; margin:4px;'>Menuju Lokasi Pemasangan</button>" : res[0].ontheway ? "<button style='border-radius: 5px; margin:4px; '>Menuju Lokasi Pemasangan</button>" : "<button style='border-radius: 5px; margin:4px; background-color: green; color: white;'>Menuju Lokasi Pemasangan</button>";
                    var pemasangan = !res[0].process && !res[0].ontheway ? "<button style='border-radius: 5px; margin:4px;'>Pemasangan</button>" : res[0].process ? "<button style='border-radius: 5px; margin:4px; '>Pemasangan</button>" : "<button style='border-radius: 5px; margin:4px; background-color: green; color: white;'>Pemasangan</button>";
                    var finish = res[0].process ? "<button style='border-radius: 5px; margin:4px; background-color: green; color: white;'>Penyiapan Berita Acara</button>" : "<button style='border-radius: 5px; margin:4px; '>Penyiapan Berita Acara</button>";
                    $("#progress").append(prepare, otw, pemasangan, finish)
                    var d = res[0].time.split("-")[1] + ".00"
                    var deadline = d.split(".").join(":")
                    // console.log(deadline)
                    // var start_time = time.split(":")[0] - 3 + ":" + time.split(":")[1] + ":" + time.split(":")[2];
                    var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"];
                    var date = res[0].date;
                    // var start = month[date.split("-")[1] - 1] + " " + date.split("-")[0] + "," + " " + date.split("-")[2] + " " + start_time;
                    var newDate = month[date.split("-")[1] - 1] + " " + date.split("-")[0] + "," + " " + date.split("-")[2] + " " + deadline;
                    var countDownDate = new Date(newDate).getTime();

                    // var countDownstartDate = new Date(start).getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function() {
                        // Get today's date and time
                        var now = new Date().getTime();
                        // var a = now.toLocaleString("en-US", {
                        //     timeZone: "Asia/Jakarta"
                        // });
                        var today = new Date()
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();
                        var dateNow = yyyy + "-" + mm + "-" + dd
                        // console.log(newDate)
                        // var sekarang = Date.now();
                        // console.log(Date().now());
                        // console.log(sekarang);
                        // console.log(now);
                        // console.log(a)
                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;

                        //jika belum waktunya
                        // console.log(distance)
                        var days = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        // console.log(hours + "h " + minutes + "m " + seconds + "s ")
                        // console.log(date)
                        // console.log(dateNow)
                        if (date === dateNow) {
                            if (hours > 2) {
                                document.getElementById("demo").innerHTML = res[0].time;
                            } else if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "Waktu Habis";
                            } else {
                                // Time calculations for days, hours, minutes and seconds
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                // Display the result in the element with id="demo"
                                document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
                            }
                        } else {
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "Waktu Habis";
                            } else {
                                document.getElementById("demo").innerHTML = res[0].date + " " + res[0].time;
                            }
                        }
                        // console.log(hours)
                    }, 1000);

                    // send data
                    $('#finish').click(function() {
                        var d = res[0].time.split("-")[0] + ".00"
                        var startTime = d.split(".").join(":")
                        var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"];
                        var date = res[0].date;
                        var start = month[date.split("-")[1] - 1] + " " + date.split("-")[0] + "," + " " + date.split("-")[2] + " " + startTime;
                        var startCount = new Date(start).getTime();
                        var x = setInterval(function() {
                            var now = new Date().getTime();
                            var distance = now - startCount;
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            $.ajax({
                                url: "/timer/" + window.location.href.split('/')[4] + "/setTime",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    estimate: hours + "h " + minutes + "m " + seconds + "s "
                                },
                                type: 'POST',
                                success: function(result) {
                                    console.log(result.isFinished)
                                    if (result.isFinished) {
                                        window.location = "/timer/"
                                    } else {
                                        window.location = "/timer/" + window.location.href.split('/')[4]
                                    }
                                }
                            });
                        }, 1000);
                    });

                    // $.ajax({
                    //     url: "/timer/" + window.location.href.split('/')[4] + "/setTime",
                    //     type: "POST",
                    //     success: function(res) {
                    //         console.log(res)
                    //     }
                    // })
                }
            });
        })
    </script>
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>