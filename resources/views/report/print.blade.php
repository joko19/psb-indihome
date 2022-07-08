<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('Template.head')
</head>

<body onload="window.print()">

    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> PSB
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Pelanggan
                    <address>
                        <strong>{{$dataReport->name}}</strong><br>
                        {{$dataReport->address}}<br>
                        Phone: {{$dataReport->phone}}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Order ID:</b> {{$dataReport->id}}<br>
                    <b>Teknisi:</b> {{$dataReport->teknisi}}<br>
                    <b>Tanggal Pemasangan:</b> {{$dataReport->date}}<br>
                    <b>Waktu Pemasangan:</b> {{$dataReport->time}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Deskripsi</th>
                                <th>Waktu Pengerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Manajemen Janji</td>
                                <td>{{$dataReport->prepare}}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Perjalanan Menuju Lokasi</td>
                                <td>{{$dataReport->ontheway}}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Proses Pemasangan</td>
                                <td>{{$dataReport->process}}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Penyiapan Berita Acara </td>
                                <td>{{$dataReport->finishing}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('sweetalert::alert')
</body>

</html>