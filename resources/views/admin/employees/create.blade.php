@extends('layouts.admin.master-layout')

@section('header-script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

<style>

</style>

@endsection

@section('main-content')
    @if ($errors->any())
        <ul class="text-center" style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li><h4 class="text-danger">{{ $error }}</h4></li>
            @endforeach
        </ul>
    @endif
    @if(Session::has('flashMessageError'))
        <h4 class="text-center text-danger">{{ Session::get('flashMessageError') }}</h4>
    @endif
    @if(Session::has('flashMessage'))
        <h4 class="text-center text-success">{{ Session::get('flashMessage') }}</h4>
    @endif

    <div class="form-style-5">
        <form action="{{ url('/employees') }}" method="post" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend><span class="number"><i class="fas fa-plus"></i></span> Add Employee</legend>
            </fieldset>
            <fieldset>
                @include ('admin.employees.form', ['formMode' => 'create'])
            </fieldset>
        </form>
    </div>
@endsection
@section('footer-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function(){
            $(function () {
                $("#datepicker").datepicker({
                        autoclose: true,
                        format: 'mm/dd/yyyy'
                }).datepicker('update', new Date());
            });
            $(function () {
                $("#datepicker2").datepicker({
                        autoclose: true,
                        format: 'mm/dd/yyyy'
                }).datepicker('update', new Date());
            });
            var count = 1;
            $(document).on('click', '.add_certificate_button', function(){
                let html = `<div class="row certificate_row_`+count+`">
                                <div class="col-md-4">
                                    <label for="institute" class="control-label">{{ 'Institute' }}</label>
                                    <input required type="text" name="institute[]" id="institute" placeholder="Institute *" value="{{ isset($employee->employeeCertificates->institute) ? $employee->employeeCertificates->institute : old('institute')}}" >
                                    {!! $errors->first('institute', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="certificate" class="control-label">{{ 'Certificate' }}</label>
                                    <input required type="text" name="certificate[]" id="certificate" placeholder="Name Of Certificate *" value="{{ isset($employee->employeeCertificates->certificate) ? $employee->employeeCertificates->certificate : old('certificate')}}" >
                                    {!! $errors->first('certificate', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="cert_image" class="control-label">{{ 'Certificate Image' }}</label>
                                    <input required type="file" name="cert_image[]" id="cert_image" style="width: 100%; background: #ffffff; padding: 7px; border: 1px solid #cecece;">
                                    {!! $errors->first('cert_image', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-success btn-sm delete_certificate_button" del-row-attr="`+count+`" style="background: red; border-width: 0px; width:40px; height: 40px; border-radius: 50% !important; margin-top: 35px;"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>`;
                $('.add_certificate_div').append(html);
                count++;
            });

            $(document).on('click', '.delete_certificate_button', function(){
                let delRowAttr = $(this).attr('del-row-attr');
                $('.certificate_row_'+delRowAttr).remove();
            });
        });
    </script>
@endsection