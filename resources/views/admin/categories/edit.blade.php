@extends('admin.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $category->name }}</h3>
                        <a href="{{route('admin.categories.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Departamentlər
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.categories.update', $category->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Əsas kateqoriya</div>
                                <select id="status" name="parent_id"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="NULL">--Yoxdur--</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ !is_null($item->parent) && $item->parent_id == $item->id ? 'selected' : '' }}>
                                            {{ !is_null($item->parent) ? $item->parent->name.' -> ' : '' }} {{$item->name}} {{ !is_null($item->child) ? ' -> '.$item->child->name : '' }}
                                        </option>
                                    @endforeach
                                </select>

                                @if($errors->has('parent_id'))
                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Kateqoriya adı</div>
                                <input type="text" name="name" value="{{$category->name}}" id="" class="form-control">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Status</div>
                                <select id="status" name="status"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="1" {{ $category->status == '1' ?  'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ $category->status == '0' ?  'selected' : '' }}>Deaktiv</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-success btn-lg">Yadda saxlayın</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
