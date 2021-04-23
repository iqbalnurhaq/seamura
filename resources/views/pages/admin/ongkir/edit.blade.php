@extends('layouts.admin')

@section('title')
    Create Ongkir
@endsection

@section('content')
    <!-- Section Content -->

          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Ongkir</h2>
                <p class="dashboard-subtitle">Create New Ongkir</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body"> 
        
                                <form action="{{ route('ongkir.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="regencies_id">City</label>
                                                <select name="regencies_id" class="form-control" >
                                                <option value="{{ $item->district->regency['name'] }}" selected>{{ $item->district->regency['name'] }}</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="districts_id">Kecamatan</label>
                                                <select name="districts_id" class="form-control">
                                                       <option value="{{ $item->district['name'] }}" selected>{{ $item->district['name'] }}</option>
                                            
                                                </select>
                                               
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Ongkir</label>
                                                    <input type="number" name="ongkir" class="form-control" min=0 required>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mt-4">
                                            <button type="submit" class="btn btn-success px-5">Save</button>
                                        </div>
                                       
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> 
@endsection