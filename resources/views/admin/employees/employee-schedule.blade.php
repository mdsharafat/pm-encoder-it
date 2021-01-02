@extends('layouts.admin.master-layout')

@section('header-script')
    <link href='{{ asset('assets/calender/main.css') }}' rel='stylesheet' />

    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('main-content')
    <div class="form-style-5">
        <form>
            <fieldset>
                <legend><span class="number"><i class="fas fa-clock"></i></span> EMPLOYEE SCHEDULE</legend>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col-md-8">
                        <label for="job_type_id" class="control-label">{{ 'Employee' }}</label>
                        <select required id="emp_id" name="emp_id" class="emp_id">
                            <option value="" disabled selected>Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->unique_key }}">{{ $employee->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="mg-t-30">
                            <button type="button" class="customButton check_employee_schedule_button">Check</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
        <hr>
        <br>
        <div class="schedule_calender">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script src='{{ asset('assets/calender/main.js') }}'></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.check_employee_schedule_button' ,function(){
                let emp_id = $('.emp_id').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/check-employee-schedule') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        emp_id  : emp_id
                    },
                    success: function(data) {
                        if(data.msg == 'success'){

                            var calendarEl = document.getElementById('calendar');
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                headerToolbar: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'dayGridMonth,timeGridWeek,listMonth'
                                },
                                navLinks: true, // can click day/week names to navigate views
                                businessHours: true, // display business hours
                                editable: true,
                                selectable: true,
                                events: []
                            });

                            data.schedule.forEach(function(empSchedule) {
                                empScheduleObject = {
                                    title: empSchedule.title,
                                    start: empSchedule.starts_from,
                                    end: empSchedule.deadline
                                }
                                calendar.addEvent(empScheduleObject)
                            });
                            calendar.render();
                        }
                    }
                });


            });
        });
    </script>
@endsection
