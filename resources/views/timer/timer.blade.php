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
            <div style="margin: 12px;">
                <!-- <div id="deadline"></div> -->
                <button style="border-radius: 5px; background-color: green; color: white; ">Manajemen Janji</button>
                <button style="border-radius: 5px;">Menuju Lokasi Pemasangan</button>
                <button style="border-radius: 5px;">Proses Pemasangan</button>
                <button style="border-radius: 5px;">Penyiapan Berita Acara</button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h1 id="demo" class="text-center h1" style="font-size: 72px;"></h1>
                        <button class="btn btn-success m-auto">Finish</button>
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

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        console.log("hello world")
        console.log(window.location.href.split('/')[4])

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

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
                    $("#deadline").append(res[0].time);
                    var d = res[0].time.split("-")[1] + ".00"
                    var deadline = d.split(".").join(":")
                    // console.log(deadline)
                    // var start_time = time.split(":")[0] - 3 + ":" + time.split(":")[1] + ":" + time.split(":")[2];
                    var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"];
                    var date = res[0].date;
                    console.log(date)
                    // var start = month[date.split("-")[1] - 1] + " " + date.split("-")[0] + "," + " " + date.split("-")[2] + " " + start_time;
                    var newDate = month[date.split("-")[1] - 1] + " " + date.split("-")[0] + "," + " " + date.split("-")[2] + " " + deadline;
                    console.log(newDate)
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
                        console.log(date)
                        console.log(dateNow)
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

                    document.querySelector('#from1').addEventListener('submit', function(e) {
                        var form = this;

                        e.preventDefault(); // <--- prevent form from submitting

                        swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this imaginary file!",
                            icon: "warning",
                            buttons: [
                                'No, cancel it!',
                                'Yes, I am sure!'
                            ],
                            dangerMode: true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                swal({
                                    title: 'Shortlisted!',
                                    text: 'Candidates are successfully shortlisted!',
                                    icon: 'success'
                                }).then(function() {
                                    form.submit(); // <--- submit form programmatically
                                });
                            } else {
                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                        })
                    });
                    $.ajax({
                        url: "/timer/" + window.location.href.split('/')[4] + "/setTime",
                        type: "POST",
                        success: function(res) {
                            console.log(res)
                        }
                    })
                }
            });
        })
    </script>
    @include('Template.script')
    @include('sweetalert::alert')
</body>

</html>