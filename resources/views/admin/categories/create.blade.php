{{-- Pertemuan 18 semua --}}

@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid g-0">

    <div class="row g-0">
        <div class="bg-info" style="height: 200px">
            <h3 class="p-4 text-light">Create Category</h3>
        </div>
    </div>

    <div class="row g-0" style="position: relative;top:-100px;">
      <div class="offset-1 col-5">
        <div class="card border-0 shadow-sm">
            
            
            <div class="p-4">
              @isset($category)
              <form action="/dashboard/categories/{{ $category->id }}" method="post">
                    @method('PUT')
                @else
                    <form action="/dashboard/categories" method="post">
                @endisset
                    @csrf
                        <label for="name_category" class="my-2 fw-semibold">Name Category</label>
                        <input type="text" id="name_category"  class="form-control @error('name_category') is-invalid @enderror" name="name_category" value="{{ isset($category) ? $category->name_category : old('name_category') }}" placeholder="name category">
                        @error('name_category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <a href="/dashboard/categories" class="btn btn-primary my-3"><i class="fas fa-arrow g-0-left"></i> Back</a>
                        <button type="submit" class="btn btn-success my-3"><i class="fas fa-save"></i> Save</button>
                
                </form>                
            </div>

        </div>
      </div>

    </div>
</div>

@endsection