@extends('layouts.mainLayout')
@section('title','Profile')

@section('content')


<div class="row profile-container">
    <div class="card profile-card">
            <button id="editProfileButton" class="editProfileButton">
                <i class="nav-icon fa fa-edit card-edit" id="editButton"></i>
            </button>
        <div class="card-header">
            <div class="user-panel mt-3 mb-3 d-flex">
                <div class="image">
                  <img src="{{ Auth()->user()->image != null ?  asset('storage/images/'.Auth()->user()->image) : asset('images/profile.jpg') }}" class="img-circle profile-image" alt="User Image">
                </div>
            </div>
        </div>

        <div class="card-content">
            <section class="content-one">
                <label for="">Username</label>
                <p id="usernameDisplay">{{   Auth()->user()->username    }}</p>
                <input type="text" id="usernameInput" value="{{ Auth()->user()->username }}" style="display: none">

                <label for="">Email</label>
                <p id="emailDisplay">{{   Auth()->user()->email   }}</p>
                <input type="text" id="emailInput" value="{{ Auth()->user()->email }}" style="display: none">
            </section>

            <section class="content-two">
                <label for="">Phone</label>
                <p id="phoneDisplay">{{   Auth()->user()->phone   }}</p>
                <input type="text" id="phoneInput" value="{{ Auth()->user()->phone }}" style="display: none">

                <label for="">Address</label>
                <p id="addressDisplay">{{   Auth()->user()->address     }}</p>
                <input type="text" id="addressInput" value="{{ Auth()->user()->address}}" style="display: none">
            </section>
        </div>

        <button class="checkIconContainer">
            <i class="fas fa-check-circle saveEditProfile"></i>
        </button>

    </div>
</div>

@endsection