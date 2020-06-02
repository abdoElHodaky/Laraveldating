@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if($user->info->profile_picture == null)
                <div class="col-8 offset-2 text-center" id="no_picture">
                    <h1>Please complete your profile by adding a profile picture!</h1>
                </div>
            @elseif($pictures == null)
                <div class="col-8 offset-2 text-center" id="no_picture">
                    <h1>There is nobody to show :(</h1>
                    <br>
                    <h2>Try adjusting your search settings</h2>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-6 text-right">
                        @if(count($pictures) == 0)
                            <img class="d-block w-100" src="{{ $otherUser->info->getPicture() }}" alt="First slide">
                        @else
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ $otherUser->info->getPicture() }}"
                                             alt="Profile picture of the user">
                                    </div>
                                    @foreach($pictures as $picture)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ $picture->getPicture() }}"
                                                 alt="Picture of the user">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-6">
                        <h2>{{ $otherUser->info->name . ' ' . $otherUser->info->surname . ', ' . $otherUser->info->age }}</h2>
                        <br>
                        <h3>Bio:</h3>
                        <p id="description">{{ $otherUser->info->description}}</p>
                        <a href="{{ route('user.show', $otherUser->id) }}">Open profile</a>
                        <div class="row reaction">

                            <div class="col-4">
                                <form action="{{ route('like', $otherUser->id) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><img
                                            src="https://img.icons8.com/cotton/64/000000/like--v3.png"
                                            style="width: 100px" alt="Like button picture"></button>
                                </form>
                            </div>

                            <div class="col-4 offset-4">
                                <form action="{{ route('dislike', $otherUser->id) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit"><img
                                            src="https://img.icons8.com/ios/100/000000/--broken-heart.png"
                                            alt="Dislike button picture"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
<style>
    .row.justify-content-center {
        width: 100%;
    }

    #no_picture {
        padding-top: 30px;
    }

    .col-6.text-right img {
        width: 100%;
        max-height: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #description {
        font-size: 18px;
    }

    .reaction .btn {

    }
</style>
