@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <section class="section text-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($firms as $value)
                    <div class="card" style="width: 18rem;margin: 5px">
                        <div class="card-body text-left">
                            <div class="text-right">
                                @if($value->path != null)
                                    <img src="{{asset("storage/images/logo/$value->path")}}"
                                         style="width: 30px; height: auto" class="card-img-top"
                                         alt="...">
                                @else
                                    <img src="{{ asset("images/no_image/no_image.jpg") }}" class="card-img-top"
                                         style="width: 30px; height: auto" alt="...">
                                @endif
                            </div>
                            <div style="margin-top: 10px">
                                <a href="{{route('view.firm', ['id'=>$value ['id']])}}"> {!! $value->name !!}</a>
                            </div>
                            Адрес: {!! $value->address !!}<br>
                            Телефон: {!! $value->phone !!}<br>
                            Генеральный директор: {!! $value->general_director !!}<br>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
@push('scripts')

@endpush