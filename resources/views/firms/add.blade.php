@extends('layouts.app')
@section('content')

    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1>Добавить фирму</h1>
                    <form action="{{route('add.firm')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="name"><b>Название:</b></label>
                            <input name="name" type="text" value="{{ old('name') }}"
                                   class="form-control"
                                   placeholder="Название...." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="inn"><b>ИНН:</b></label>
                            <input name="inn" type="number" value="{{ old('inn') }}"
                                   class="form-control"
                                   placeholder="ИНН...." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="about"><b>Текст:</b></label>
                            <textarea placeholder="Введите текст..." name="about" cols="85" rows="5"
                                      value="{{ old('about') }}" class="form-control"></textarea>
                        </div>
                        <br>
                        <div>
                            <label for="general_director"><b>Генеральный директор:</b></label>
                            <input name="general_director" type="text" value="{{ old('general_director') }}"
                                   class="form-control"
                                   placeholder="Генеральный директор (ФИО)" autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="address"><b>Адрес:</b></label>
                            <input name="address" type="text" value="{{ old('address') }}"
                                   class="form-control"
                                   placeholder="Адрес...." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="phone"><b>Телефон:</b></label>
                            <input name="phone" type="text" value="{{ old('phone') }}"
                                   class="form-control"
                                   placeholder="Телефон...." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="image"><b>Лого:</b></label><br>
                            <input name="image" type="file" value="{{ old('image') }}" class="btn btn-primary submit">
                        </div>
                        <br>
                        <br><center>
                        <button class="btn btn-primary submit" id="submit" type="submit">Добавить</button></center>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')

@endpush