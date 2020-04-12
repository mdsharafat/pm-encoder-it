@extends('layouts.admin.master-layout')

@section('header-script')
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 968px;
    margin: auto;
    text-align: center;
    font-family: arial;
    padding: 20px;
}

.title {
  color: grey;
  font-size: 14px;
  font-weight: bold;
  margin-top: 5px;
  margin-bottom: 0px;
}

.client_edit_show_page {
    max-width: 40px;
    display: inline-block;
}

</style>
@endsection

@section('main-content')
    
    <div class="card">
        <div class="row">
            <div class="col-md-4">
                @if($client->image)
                    <img src="{{ asset('storage/clients/'.$client->image) }}" alt="{{ $client->name }}" style="width:150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                @else
                    <img src="{{ asset('assets/img/user.jpg') }}" alt="{{ $client->name }}" style="width:150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 1px solid #cecece;">
                @endif
            </div>
            <div class="col-md-8 text-left">
                <h1 class="text-success" style="font-size: 20px; margin-top: 10px; font-weight: bold;">{{ $client->name }}</h1>
                <span>4.5 <span class="text-warning"><i class="fas fa-star"></i></span></span>
                <p class="title">Platform: {{ ucfirst($client->platform->name) }}</p>
                <p class="title">Email: {{ $client->email }}</p>
                <p class="title">Skype: {{ $client->skype }}</p>
            </div>
        </div>
        <p class="text-justify" style="margin-top: 10px;">{{ $client->desc }}</p>
        <a class="btn btn-sm btn-primary client_edit_show_page" href="{{ url('/clients/' . $client->id.'/edit') }}" title="Edit Client" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
    </div>
@endsection

@section('footer-script')

@endsection