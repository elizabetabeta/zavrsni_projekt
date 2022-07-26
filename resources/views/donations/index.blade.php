@extends('layouts.app')

@section('content')
<div class="container" id="visina">
    <div class="row justify-content-center">
       
        <div class="col-md-12" id="visina">
            <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif

                        <!--<div class="row">
                            <div class="col-10">
                                <form action="{{ route('searchuser') }}" method="GET" role="search">

                                    <div class="input-group">
                                        <div class="form-outline">
                                            <input type="text" name="search" placeholder="Pretrazi..." class="form-control" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <p><small class="text-muted">Pretraži po nazivu ili email-u...</small></p>
                                </form>
                            </div>
                        <div class="col-2">-->

                        @if(Auth()->user()->role == "Admin")
                        <div class="card-body">
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add new donation
                        </button>
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title text-primary">List of donations</h3>
                                <!--<div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>-->
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>Donation Amount</th>
                                        <th>User That Donated</th>   
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($donations as $donation)
                                    <tr>
                                    <td>                                      
                                    
                                        ${{ $donation->amount }} 
                                  
                                        </td>
                                       
                                    <td>
                                    @foreach($user as $u)
                                    @if($u->id == $donation->user_id)

                                        <a href="/profile{{ $u->id }}">
                                        {{ $u->name }}
                                        </a>

                                    @endif
                                    @endforeach                                    
                                    </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                     {{$donations->links('pagination::bootstrap-4')}}
                                </div>

                            </div>
                        </div>

                        
                </div>
            </div>
        </div>
    </div>
</div>
</div>

                     <!-- Modal za dodavanje novog korisnika -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Dodavanje korisnika</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Donation amount</label>
                                                <input type="text" maxlength="30"
                                                       class="form-control @error('name') is-invalid @enderror" name="name" id="name2" value="{{ old('name') }}" placeholder="Unesite ime životinje">

                                                @error('name')
                                                     <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                     </span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="scientific_name">Scientific Name</label>
                                                <input type="scientific_name" maxlength="191" class="form-control @error('scientific_name') is-invalid @enderror" name="scientific_name" id="scientific_name" placeholder="Unesite znanstveni naziv">

                                                @error('scientific_name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                     </span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="status">Conservation status</label>
                                                <input type="status" class="form-control @error('status') is-invalid @enderror" name="status" id="status" placeholder="Unesite status">

                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                     </span>
                                                @enderror

                                            </div>
                                            <label for="image" class="col-md-4 col-form-label">Dodajte sliku</label>
                                            <br>
                                            <input type="file" class="form-control-file" id = "image" name="image">

                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                                            <button id="addUserBtn" type="submit" class="btn btn-primary">Spremi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

@endsection

    <style>
        #visina{
            min-height: 100%;
        }
        td {
            height: 50px;
            vertical-align: middle;
        }
    </style>