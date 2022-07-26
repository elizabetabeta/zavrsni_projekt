@extends('layouts.app')

@section('content')
    <div class="container" id="visina">
        <div class="p-3 pb-4" id="slika">
        <form action="{{ url('animal/update/'.$animal->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="form-group row">

                    <div class = "row">
                        <h1 class="text text-primary">Edit animal info</h1>
                    </div>
                    <br><br><br>

                    <div class="row">

                    <div class="form-group col">
                        <label for="name" class="col-md-4 col-form-label">Name</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') ?? $animal->name }}"
                               autocomplete="name" autofocus
                               minlength="1">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                    <div class="row">

                    <div class="form-group col">
                        <label for="scientific_name" class="col-md-4 col-form-label">Scientific Name</label>

                        <input id="scientific_name" type="text" class="form-control @error('scientific_name') is-invalid @enderror"
                               name="scientific_name" value="{{ old('scientific_name') ?? $animal->scientific_name }}"
                               autocomplete="scientific_name" autofocus
                               >

                        @error('scientific_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row">

                    <div class="form-group col">
                        <label for="status" class="col-md-4 col-form-label">Status</label>

                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror"
                               name="status" value="{{ old('status') ?? $animal->status }}"
                               autocomplete="status" autofocus
                               >

                        @error('status')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                      
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">Profile Picture</label>

                        <input type="file" class="form-control-file" id = "image" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <br>
                    <div class="pt-4">
                        <button class="btn btn-primary" type="submit">
                            Save changes
                        </button>
                        <a href="/animal{{ $animal->id }}" class="btn btn-secondary"> Cancel </a>
                        <br><br>

                        <hr>
                        <button type="button" class="btn btn-outline-danger mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalForDelete">
                            Delete this animal
                        </button>
                    </div>


                </div>
            </div>
        </form>
        </div>
    </div>

    <!-- MODAL ZA DELETE ANIMAL -->
    <div class="modal fade" id="modalForDelete" tabindex="-1" aria-labelledby="modalForDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">
                        Jeste li sigurni da želite obrisati ovu životinju?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-center">
                    <table>
                        <tr>
                            <td>
                                <p class="text-danger"> Warning! If you delete this animal all its data will be lost!</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <a href="{{ route('animal.delete', $animal->id) }}" class = "btn btn-danger">Obriši</a>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    #slika {
        border-radius: 15px;
    }
    #visina{
        min-height: 100%;
    }
</style>