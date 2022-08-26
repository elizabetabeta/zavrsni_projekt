@extends('layouts.app')

@section('content')
    <div class="container" id="visina">
        <div class="row justify-content-center">

            <div class = "col-md-12" id="vis">
                <div class="text text-dark">
                    <div class="row">
                    <div class = "col-2">

                    <img src="/storage/{{ $user->profile_image }}" class="rounded-circle"
                        style="height: 160px; width: 160px;border: medium solid white">
                        </div>

                        <div class="col">
                            <br>
                        <h2>
                            <i class="fa-solid fa-user"></i>
                             {{ $user->name }}
                        </h2>

                        <h2>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:{{ $user->email }}" style="text-decoration: none; color: black">
                            {{ $user->email }}
                            </a>
                        </h2>


                            <small class="text-dark">
                                Datum registracije:
                                {{ $user->created_at->format('d.m.Y.') }}
                            </small>
                            </div>
                        </div>
                </div>

                <br><br>

                @if(Auth::user()->id == $user->id)
                    <a href="/editprofile{{ $user->id }}" class = "btn btn-primary mb-2 float-right">
                        Uredi svoj profil
                    </a>
                @endif

                <br>

                @foreach($donations as $donation)
                    <h1 class="text text-success">User {{ $user->name }} has donated ${{ $donation->amount }}!</h1>
                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                @endforeach


            </div>
        </div>
        <br><br>
    </div>
    </div>
@endsection

<style>
    #visina {
        min-height: 100%;
    }
    @media only screen and (min-width: 750px) {
        #flo{
            float: right;
        }
    }
</style>
