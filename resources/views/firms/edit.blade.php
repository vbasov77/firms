@extends('layouts.app')
@section('content')
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('edit.firm')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$firm['id']}}">
                        <h3>Редактировать</h3>
                        <label for="name"><b>Название</b></label><br>
                        <input type="text" placeholder="Название" class="form-control" name="name"
                               value="{{ $firm['name'] }}"
                               required><br>
                        <br>
                        <label for="inn"><b>ИНН:</b></label><br>
                        <input type="text" placeholder="ИНН...." class="form-control" name="inn"
                               value="{{ $firm['inn'] }}"
                               required><br>
                        <br>

                        <div>
                            <label for="about"><b>Текст:</b></label><br>
                            <textarea class="form-control" placeholder="Введите текст" name="about" id="text"
                                      rows="5" cols="85"> {{$firm['about']}}</textarea><br>
                        </div>

                        <br>
                        <label for="general_director"><b>Генеральный директор:</b></label><br>
                        <input type="text" placeholder="Генеральный директор (ФИО)" class="form-control"
                               name="general_director"
                               value="{{ $firm['general_director'] }}"
                               required><br>
                        <br>
                        <div>
                            <label for="address"><b>Адрес:</b></label>
                            <input name="address" type="text" value="{{ $firm['address'] }}"
                                   class="form-control"
                                   placeholder="Адрес...." autocomplete="off" required>
                        </div>
                        <div>
                            <label for="phone"><b>Телефон:</b></label>
                            <input name="phone" type="text" value="{{ $firm['phone'] }}"
                                   class="form-control"
                                   placeholder="Телефон...." autocomplete="off" required>
                        </div>
                        <br>
                        <div>
                            <label for="old_image"><b>Лого:</b></label><br>
                            <input name="old_image" type="text" value="{{ $logo }}" readonly class="form-control">
                        </div>
                        <br>
                        <div>
                            <label for="mage"><b>Лого:</b></label><br>
                            <input name="image" type="file" value="" class="btn btn-primary submit">
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-outline-danger"
                                onclick="window.location.href = '{{route('view.firm', ['id'=>$firm->id])}}';">Отмена
                        </button>
                        <input class="btn btn-outline-primary" type="submit" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')

@endpush