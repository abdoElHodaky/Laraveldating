@extends('layouts.app')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>


@section('content')

    <div class="container">
        <div class="container mt-5">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4 pb-5">
                    <div class="author-card pb-3">
                        <div class="author-card-profile">
                            <div class="author-card-avatar">
                                <img src="{{ $userInfo->getPicture() }}"
                                     id="profile_picture"
                                     alt="Picture of you">
                                <div class="text-center upload">
                                    <form action="{{ route('profile.updateProfilePicture') }}"
                                          enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('put')
                                        <input id="custom" type="file" name="picture" onchange="this.form.submit()"
                                               required="" multiple>
                                        <label class="btn">
                                            Change profile photo
                                            <input
                                                type="file"
                                                name="picture"
                                                onchange="this.form.submit()"
                                                multiple>
                                        </label>
                                    </form>
                                </div>
                            </div>
                            <div class="author-card-details">
                                <h5 class="author-card-name text-lg">{{ $userInfo->name . ' ' . $userInfo->surname }}</h5>
                                <span class="author-card-position">Joined {{ $user->created_at }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a class="list-group-item active" href="{{ route('profile.updateProfile') }}">Edit
                                Profile</a>
                            <a class="list-group-item" href="{{ route('profile.updateSettings') }}">Edit Settings</a>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-8 pb-5">
                    <form class="row" method='post' action="{{ route('profile.updateProfile') }}">
                        @csrf

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name"
                                       value="{{ $userInfo->name }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input class="form-control" type="text" name="surname" id="surname"
                                       value="{{ $userInfo->surname }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control" type="email" name="email" id="email"
                                       value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                       value="{{ $userInfo->phone }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" class="js-range-slider" name="age" id="age" value=""
                                       data-type="single"
                                       data-min="18"
                                       data-max="100"
                                       data-from="{{ $userInfo->age }}"
                                       data-grid="false"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="description">Bio</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                      style="resize:none;" required
                                      autocomplete="description">{{ $userInfo->description }}</textarea>
                        </div>
                        <div class="col-12">
                            <hr class="mt-2 mb-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(".js-range-slider").ionRangeSlider();
        document.registrationForm.ageInputId.oninput = function () {
            document.registrationForm.ageOutputId.value = document.registrationForm.ageInputId.value;
        }
    </script>
@endsection
<style>
    .text-center.upload input {
        display: none
    }

    .text-center.upload {
        color: white;
        font-weight: bold;
        text-decoration: underline;
    }

    .text-center .btn {
        color: black;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #profile_picture {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
