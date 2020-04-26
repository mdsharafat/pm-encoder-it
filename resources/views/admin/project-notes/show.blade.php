@extends('layouts.admin.master-layout')

@section('header-script')
    <style>
        .card {
            background: #fff;
            border-radius: 2px;
            display: grid;
            height: auto;
            margin: 1rem auto;
            position: relative;
            padding: 10px;
            width: 100%;
            box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
        }
        .card:hover {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
    </style>
@endsection

@section('main-content')
    <div class="container">
        <div class="form-style-5" style="padding-top: 0px; padding-bottom: 0px;">
            <fieldset>
                <legend><span class="number"><i class="fas fa-table"></i></span>All Notes for <span class="font-weight-bold">"{{ ucfirst($project->title) }}"</span></legend>
            </fieldset>
        </div>
        @foreach($project->projectNotes as $item)
            <div class="card">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <p><u>created at: {{ $item->created_at }} </u></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url('/project-notes/' . $item->id . '/edit') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>
                        <form method="POST" action="{{ url('/project-notes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ProjectNote" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="">{{ $item->note }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
