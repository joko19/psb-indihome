<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('Template.head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Fullcalender CRUD Events in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /><!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.sidebar')
        <div class="content-wrapper">
            <div class="container">
                <div id='full_calendar_events'></div>
            </div>
        </div>

    </div>
    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var todayDate = new Date().toISOString().slice(0, 10);
            var dayClick
            var calendar = $('#full_calendar_events').fullCalendar({
                validRange: {
                    start: todayDate,
                },
                editable: true,
                editable: true,
                events: "/calendar/" + window.location.href.split('/')[5],
                displayEventTime: true,
                // Show scheduled
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                dayClick: function(date, jsEvent, view){
                    dayClick = date.day();
                },
                // add scheduled
                select: function(event_start, event_end, allDay) {
                    var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD");
                    var event_name = confirm("Apakah anda yakin?");
                    if (event_name) {
                        $.ajax({
                            url: "/schedule",
                            data: {
                                id: window.location.href.split('/')[4],
                                teknisi: window.location.href.split('/')[5],
                                date: event_start,
                                type: 'create',
                                day: dayClick
                            },
                            type: "POST",
                            success: function(data) {
                                if (data === "full") {
                                    alertMessage("Jadwal Penuh, Silahkan pilih hari lain");
                                } else if(data === "libur"){
                                    alertMessage("Hari Minggu Libur, Silahkan pilih hari lain");
                                } else {
                                    displayMessage("Success");
                                    window.location = '/schedule';
                                }
                            }
                        });
                    }
                }
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

        function alertMessage(message) {
            toastr.error(message, 'Alert');
        }
    </script>
</body>

</html>