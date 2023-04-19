@extends('layouts.app')

@section('title', ($project->id) ? 'Modifica progetto' : 'Nuovo progetto')

@section('content')

    <a class="btn btn-primary my-4" href="{{ route('admin.projects.index') }}">Torna ai progetti</a>
   
   @if($project->id)
        <h1 class='my-4'> Modifica "{{$project->title}}"</h1>
    @else 
        <h1 class='my-4'> Crea un nuovo progetto</h1>
    @endif
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Attenzione: </h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($project->id) {{-- se il post ha un id è una modifica altrimenti è una creazione --}}
    <form action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else 
    <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
    @endif

    @csrf
        <div class="row d-flex">
            
            <div class="col-5 fs-5">
                <div class="">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('name') ?? $project->title }}"/>
                 @error('title') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="d-flex flex-column mt-2">
                <label for="thumbnail" class="form-label">URL immagine di anteprima</label>
                <input type="text" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail"
                    value="{{ old('thumbnail') ?? $project->thumbnail}}" />
                   <div>
                        <img src="{{$project->thumbnail}}" alt="" class="w-100 mt-3">
                    </div>
                    @error('thumbnail') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-5">

                <div class="details ">
                    <textarea class=" w-100  @error('details') is-invalid @enderror" name="details" id="details" placeholder="Descrizione">{{ old('details') ?? $project->details}}</textarea>
                    @error('details') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror  
                 </div>  
                     
                 <div class="text-center ">
                    <button type="submit" class="btn btn-primary m-5 fs-3 px-5">Salva</button>    
                 </div>

            </div>
            
        </div>

       
    </form>
@endsection