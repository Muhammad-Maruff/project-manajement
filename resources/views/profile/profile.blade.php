<link rel="stylesheet" href="style.css">

@extends('layouts.mainLayout')
@section('title','Profile')

@section('content')
<div class="row profile-container">
    <div class="card profile-card">
        <div class="card-header">
            <div class="user-panel mt-3 mb-3 d-flex">
                <div class="image">
                  <img src="{{ asset('images/profile.jpg') }}" class="img-circle profile-image" alt="User Image">
                </div>
            </div>
        </div>
            <div class="card-content">
                <section class="card-information">
                    <div class="info-row">
                        <div class="info-item">
                            <label for="">Username</label>
                            <p>{{ auth()->user()->username }}</p>
                        </div>
                        <div class="info-item">
                            <label for="">Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                        <div class="info-row">
                            <div class="info-item">
                                <label for="">Phone Number</label>
                                <p>{{ auth()->user()->phone }}</p>
                            </div>
                            <div class="info-item">
                                <label for="">Address</label>
                                <p>{{ auth()->user()->address }}</p>
                            </div>
                        </div>
                </section>
            </div>  
    </div>
</div>

@endsection