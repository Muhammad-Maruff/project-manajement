<link rel="stylesheet" href="style.css">

@extends('layouts.mainLayout')
@section('title','Profile')

@section('content')

<div class="row profile-container">
    <div class="card profile-card">
        <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon fa fa-edit card-edit"></i>
          </a>
        <div class="card-header">
            <div class="user-panel mt-3 mb-3 d-flex">
                <div class="image">
                  <img src="{{ asset('images/profile.jpg') }}" class="img-circle profile-image" alt="User Image">
                </div>
            </div>
        </div>

        <div class="card-content">
            <section class="content-one">
                <label for="">Username</label>
                <p>{{Auth()->user()->username}}</p>
                <label for="">Email</label>
                <p>{{Auth()->user()->email}}</p>
            </section>
            <section class="content-two">
                <label for="">Phone</label>
                <p>{{Auth()->user()->phone}}</p>
                <label for="">Address</label>
                <p>{{Auth()->user()->address}}</p>
            </section>
        </div>
          
    </div>
</div>

@endsection