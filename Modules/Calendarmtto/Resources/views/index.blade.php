


@extends('layouts.app')

@section('title', 'Calendar')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Calendario Mantenimiento</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        @can('create')
                            <a href="{{ route('calendarmttos.create') }}" class="btn btn-primary">
                                Añadir Actividad Mtto <i class="bi bi-plus"></i>
                            </a>
                        @endcan
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='calendar'></div>
@endsection

@push('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

<script type="text/javascript">

  

    $(document).ready(function () {
    
          
    
        /*------------------------------------------
    
        --------------------------------------------
    
        Get Site URL
    
        --------------------------------------------
    
        --------------------------------------------*/
    
        var SITEURL = "{{ url('/') }}";
    
        
    
        /*------------------------------------------
    
        --------------------------------------------
    
        CSRF Token Setup
    
        --------------------------------------------
    
        --------------------------------------------*/
    
        $.ajaxSetup({
    
            headers: {
    
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    
            }
    
        });
    
          
    
        /*------------------------------------------
    
        --------------------------------------------
    
        FullCalender JS Code
    
        --------------------------------------------
    
        --------------------------------------------*/
    
        var calendar = $('#calendar').fullCalendar({
    
                        editable: true,
    
                        events: SITEURL + "/fullcalender",
    
                        displayEventTime: false,
    
                        editable: true,
    
                        eventRender: function (calendarmtto, element, view) {
    
                            if (calendarmtto.allDay === 'true') {
    
                                    calendarmtto.allDay = true;
    
                            } else {
    
                                    calendarmtto.allDay = false;
    
                            }
    
                        },
    
                        selectable: true,
    
                        selectHelper: true,
    
                        select: function (start, end, allDay) {
    
                            var title = prompt('Event Title:');
    
                            if (title) {
    
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
    
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
    
                                $.ajax({
    
                                    url: SITEURL + "/fullcalenderAjax",
    
                                    data: {
    
                                        title: title,
    
                                        start: start,
    
                                        end: end,
    
                                        type: 'add'
    
                                    },
    
                                    type: "POST",
    
                                    success: function (data) {
    
                                        displayMessage("Event Created Successfully");
    
      
    
                                        calendar.fullCalendar('renderEvent',
    
                                            {
    
                                                id: data.id,
    
                                                title: title,
    
                                                start: start,
    
                                                end: end,
    
                                                allDay: allDay
    
                                            },true);
    
      
    
                                        calendar.fullCalendar('unselect');
    
                                    }
    
                                });
    
                            }
    
                        },
    
                        eventDrop: function (calendarmtto, delta) {
    
                            var start = $.fullCalendar.formatDate(calendarmtto.start, "Y-MM-DD");
    
                            var end = $.fullCalendar.formatDate(calendarmtto.end, "Y-MM-DD");
    
      
    
                            $.ajax({
    
                                url: SITEURL + '/fullcalenderAjax',
    
                                data: {
    
                                    title: calendarmtto.title,
    
                                    start: start,
    
                                    end: end,
    
                                    id: calendarmtto.id,
    
                                    type: 'update'
    
                                },
    
                                type: "POST",
    
                                success: function (response) {
    
                                    displayMessage("calendarmtto Updated Successfully");
    
                                }
    
                            });
    
                        },
    
                        eventClick: function (calendarmtto) {
    
                            var deleteMsg = confirm("Do you really want to delete?");
    
                            if (deleteMsg) {
    
                                $.ajax({
    
                                    type: "POST",
    
                                    url: SITEURL + '/fullcalenderAjax',
    
                                    data: {
    
                                            id: calendarmtto.id,
    
                                            type: 'delete'
    
                                    },
    
                                    success: function (response) {
    
                                        calendar.fullCalendar('removecalendarmttos', calendarmtto.id);
    
                                        displayMessage("calendarmtto Deleted Successfully");
    
                                    }
    
                                });
    
                            }
    
                        }
    
     
    
                    });
    
     
    
        });
    
          
    
        /*------------------------------------------
    
        --------------------------------------------
    
        Toastr Success Code
    
        --------------------------------------------
    
        --------------------------------------------*/
    
        function displayMessage(message) {
    
            toastr.success(message, 'Event');
    
        } 
    
        
    
    </script>
@endpush
