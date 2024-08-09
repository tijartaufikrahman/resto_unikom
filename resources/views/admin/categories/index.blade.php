

{{-- SEMUA PERTEMUAN 17 --}}

@extends('dashboard.layouts.main')
@section('container')

<div class="" style="height: 200px;background-color: #357CA5;">
  <h3 class="p-4 text-light">Categories</h3>
</div>
<div class="row g-0">
  
    {{-- Conten --}}  
  <div class=" offset-1 col-10 bg-white shadow-sm rounded mb-5" style="overflow: hidden;margin-top: -15vh;min-height: 60vh;">
    
    <div class="w-100 bg-light" >
      <h5 class=" p-3 text-dark-emphasis fw-normal" >Data Categories</h5>
    </div>
    <div class="row g-0">
      <div class="px-5 col-12">
        <a class="btn btn-primary mb-3 mt-1 " href="/dashboard/categories/create" role="button">Create new category</a>
        <div class="row">
            <div class="col-12-6">
                {{--  --}}
                    @if(session()->has('success'))
                    <div class="col-12 alert alert-success  alert-dismissible fade show" role="alert" style="border: none">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                    @endif
                    {{--  --}}
            </div>
        </div>
        <div class="row">
          <div class="col-12 ">
            @php
                $currentPage = $categories->currentPage();
                $perPage = $categories->perPage();
            @endphp

              <table class="table ">
                  <thead>
                      <tr style="background-color: #f5f5f5">
                          <th>No</th>
                          <th>NAME CATEGORY</th>
                          <th>ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($categories as $category)
                          <tr>
                              <td>{{ ($currentPage - 1) * $perPage + $loop->iteration }}</td>
                              <td>{{ $category->name_category }}</td>
                              <td>
                                  <a href="/dashboard/categories/{{ $category->id }}/edit" class="btn btn-success btn-sm px-2">
                                      <i class="fa-solid fa-pen-to-square"></i>
                                  </a>
                                  {{-- Uncomment the button below if you want to add a view action --}}
                                  {{-- <button type="button" class="btn btn-primary btn-sm px-2">
                                      <i class="fa-solid fa-eye"></i>
                                  </button> --}}
                                  <form action="/dashboard/categories/{{ $category->id }}" method="post" class="d-inline">
                                      @method('delete')
                                      @csrf
                                      <button class="btn btn-danger btn-sm px-2" onclick="return confirm('Are you sure?')">
                                          <i class="fa-solid fa-trash"></i>
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>


          <div class="d-flex justify-content-end">
            {{ $categories->links() }}
          </div>
          </div>
        </div>
  </div>  
    </div>
    
  </div>
</div>


@endsection

