@extends('layouts.app')

@section('content')

    <div class="container" id="slika">
        <div class="row">
            <div class="col-4">

                     <img class="ms-4"
                         src="/storage/{{ $animal->image }}" id="imgshadow" style="height: 300px; width: 300px;">

                <br><br><br>


                @if(auth()->user()->role == "Admin")
                <a href="/editanimal{{ $animal->id }}" class = "btn btn-primary mb-2">
                    Edit/Delete
                </a>       
                @endif

                <a href="/animals" class="btn btn-outline-primary mb-2 ">All animals</a>

            </div>
            <img id="eh" src="https://commons.wikimedia.org/wiki/File:HD_transparent_picture.png">

            <div class="col">
                <h1 class="text text-primary">
                    {{ $animal->name }}
                </h1>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>
                                Scientific name:
                            </th>
                            <td>
                                {{ $animal->scientific_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Status:
                            </th>
                            <td class="text text-danger">
                                <b>{{ $animal->status }}</b>
                            </td>
                        </tr>

                        <tr>
                          
                            <td colspan="2">
                                {{ $animal->description }}
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>

            </div>

@endsection

<style>
    @media (max-width: 990px) {
        #eh {
            height: 2px;
            width: 300px;
        }
    }
    @media (min-width: 990px) {
        #eh {
            width: 1px;
        }
    }
    .table{
        background-color: white;
    }
    #slika{
        border-radius: 15px;
    }
</style>