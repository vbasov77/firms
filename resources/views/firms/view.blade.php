@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/window.css')}}">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-10">
                        @if($firm->path != null)

                            <img src="{{asset("storage/images/logo/$firm->path")}}"
                                 style="width: 70px; height: auto" class="card-img-top"
                                 alt="...">
                        @else
                            <img src="{{ asset("images/no_image/no_image.jpg") }}" class="card-img-top"
                                 style="width: 30px; height: auto" alt="...">
                        @endif

                    <div class="field">
                        <b style="font-size: 23px">{!! $firm['name'] !!}</b>
                        @if (auth()->check())
                            <div class="textRight link" onclick="openNameForm()">Прокомментировать <i
                                        class="fas fa-comment"></i></div>@endif
                    </div>
                    <p style="color:green;" id="infoName">Ваша заметка добавлена <i class="fas fa-thumbs-up"></i></p>
                    <div id="name"></div>
                    {{------------------------------------------------------------------ Форма комментария Name--}}
                    <div class="form-popup" id="nameForm">
                        <form id="addName" class="form-container">
                            @csrf
                            <h4>Ваша заметка</h4>

                            <input type="text" placeholder="Ваш коммнет" id="name_text" name="name_comment"
                                   required>
                            <button type="submit" class="btn submitName" id="submitName">Отправить</button>
                            <button type="button" class="btn cancel" onclick="closeNameForm()">Закрыть</button>
                        </form>
                    </div>
                    {{---------------------------------Конец формы--}}
                    <br>
                    <div class="justify-content-start text-left">
                        <div class="field">
                            <b>Инн:</b>
                            @if (auth()->check())
                                <div class="textRight link" onclick="openForm()">Прокомментировать <i
                                            class="fas fa-comment"></i></div>@endif
                            {{------------------------------------------------------------- Форма комментария ИНН--}}
                            <div class="form-popup" id="innForm">
                                <form id="add_inn" class="form-container">
                                    @csrf
                                    <h4>Ваша заметка</h4>

                                    <input type="text" placeholder="Ваш коммнет" id="inn_text" name="inn_comment"
                                           required>
                                    <button type="submit" class="btn submitInn" id="submitInn">Отправить</button>
                                    <button type="button" class="btn cancel" onclick="closeForm()">Закрыть</button>
                                </form>
                            </div>
                            {{---------------------------------Конец формы--}}
                            <br>
                            {!! $firm->inn !!}
                            <p style="color:green;" id="infoInn">Ваша заметка добавлена <i class="fas fa-thumbs-up"></i></p>
                            <div id="inn"></div>
                        </div>
                        <div class="field">
                            <b>Подробнее:</b>
                            @if (auth()->check())
                                <div class="textRight link" onclick="openAboutForm()">Прокомментировать <i
                                            class="fas fa-comment"></i></div>@endif
                            <br> {!! $firm->about !!}
                            <p style="color:green;" id="infoAbout">Ваша заметка добавлена<i class="fas fa-thumbs-up"></i></p>
                            <div id="about"></div>
                            {{----------------------------------------------Форма добавления комментария Подробнее--}}
                            <div class="form-popup" id="aboutForm">
                                <form id="addAbout" class="form-container">
                                    @csrf
                                    <h4>Ваша заметка</h4>

                                    <input type="text" placeholder="Ваш коммнет" id="about_text" name="about_comment"
                                           required>
                                    <button type="submit" class="btn submitAbout" id="submitAbout">Отправить</button>
                                    <button type="button" class="btn cancel" onclick="closeAboutForm()">Закрыть</button>
                                </form>
                            </div>
                            {{---------------------------------Конец формы--}}
                            <br>
                        </div>
                        <div class="field">
                            <b>Ген. дир:</b>
                            @if (auth()->check())
                            <div class="textRight link" onclick="openDirForm()">Прокомментировать
                                <i class="fas fa-comment"></i></div>@endif
                            <br> {!! $firm->general_director !!}
                            <p style="color:green;" id="infoDir">Ваша заметка добавлена <i class="fas fa-thumbs-up"></i></p>
                            <div id="dir"></div>
                            {{----------------------------------------------Форма добавления коммента Директора--}}
                            <div class="form-popup" id="dirForm">
                                <form id="addDir" class="form-container">
                                    @csrf
                                    <h4>Ваша заметка</h4>

                                    <input type="text" placeholder="Ваш коммнет" id="dir_text" name="dir_comment"
                                           required>
                                    <button type="submit" class="btn submitDir" id="submitDir">Отправить</button>
                                    <button type="button" class="btn cancel" onclick="closeDirForm()">Закрыть</button>
                                </form>
                            </div>
                            {{---------------------------------Конец формы--}}
                        </div>
                        <div class="field">
                            <b>Адрес:</b>
                            @if (auth()->check())
                            <div class="textRight link" onclick="openAddrForm()">Прокомментировать <i
                                        class="fas fa-comment"></i></div>@endif
                            <br>
                            {!! $firm->address !!}
                            <p style="color:green;" id="infoAddr">Ваша заметка добавлена<i class="fas fa-thumbs-up"></i></p>
                            <div id="addr"></div>
                            {{-------------------------------Форма добавления коммента Адреса--}}
                            <div class="form-popup" id="addrForm">
                                <form id="addAddr" class="form-container">
                                    @csrf
                                    <h4>Ваша заметка</h4>
                                    <input type="text" placeholder="Ваш коммнет" id="addr_text" name="addr_comment"
                                           required>
                                    <button type="submit" class="btn submitAddr" id="submitAddr">Отправить</button>
                                    <button type="button" class="btn cancel" onclick="closeAddrForm()">Закрыть</button>
                                </form>
                            </div>
                            {{---------------------------------Конец формы--}}
                        </div>
                        <div class="field">
                            <b>Телефон:</b>
                            @if (auth()->check())
                            <div class="textRight link" onclick="openPhForm()">Прокомментировать <i
                                        class="fas fa-comment"></i></div>@endif
                            <br> {!! $firm->phone !!}
                            <p style="color:green;" id="infoPh">Ваша заметка добавлена <i class="fas fa-thumbs-up"></i></p>
                            <div id="ph"></div>
                            <div class="form-popup" id="phForm">
                                {{---------------------------------------------Форма добавления коммента Телефона--}}
                                <form id="addPh" class="form-container">
                                    @csrf
                                    <h4>Ваша заметка</h4>
                                    <input type="text" placeholder="Ваш коммнет" id="ph_text" name="ph_comment"
                                           required>
                                    <button type="submit" class="btn submitPh" id="submitPh">Отправить</button>
                                    <button type="button" class="btn cancel" onclick="closePhForm()">Закрыть</button>
                                </form>
                                {{---------------------------------Конец формы--}}

                            </div>
                            <div class="justify-content-center text-center">
                                @guest
                                @else
                                    <button class="btn btn-success" style="color: white;"
                                            onclick="window.location.href = '{{route('edit.firm', ['id'=>$firm->id])}}';">
                                        Редактировать фирму
                                    </button>
                                    <a onClick="return confirm('Подтвердите удаление!')"
                                       href='{{route('delete.firm', ['id'=>$firm->id])}}' type='button'
                                       class='btn btn-danger' style="margin: 5px">Удалить</a>
                                @endguest
                            </div>
                            <br>
                        </div>

                    </div>

                    {{-- Комментарии --}}
                    <div class="card mt-4">
                        <h5 class="card-header">Комментарии <span
                                    class="comment-count float-right badge badge-info">{{ count($firm->comments) }}</span>
                        </h5>
                        <div class="card-body">
                            {{-- Добавляем коммент --}}
                            <div class="add-comment mb-3">
                                @csrf
                                <textarea class="form-control comment" placeholder="Введите комментарий"></textarea>
                                <button data-firm="{{ $firm->id }}"
                                        class="btn btn-success btn-sm mt-2 save-comment">
                                    Добавить
                                </button>
                            </div>
                            <hr/>

                            <div class="comments">
                                @if(count($firm->comments)>0)
                                    @foreach($firm->comments as $comment)
                                        <blockquote class="blockquote">
                                            <small class="mb-0">{{ $comment->comment_text }}</small>
                                            <br><small style="font-size: 10px"
                                                       class="mb-0 justify-content-start">{!! $firm->created_at !!}</small>
                                        </blockquote>
                                        <hr/>
                                    @endforeach
                                @else
                                    <p class="no-comments">Нет комментариев</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Конец комментов --}}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @guest
    @else
        <script>
            var firm_id = @json($firm->id);
            var user_id = @json($userId);
        </script>
        <script src="{{asset('js/firm/name.js')}}"></script>
        <script src="{{asset('js/firm/inn.js')}}"></script>
        <script src="{{asset('js/firm/about.js')}}"></script>
        <script src="{{asset('js/firm/dir.js')}}"></script>
        <script src="{{asset('js/firm/address.js')}}"></script>
        <script src="{{asset('js/firm/ph.js')}}"></script>
    @endguest
    <script>
        const escapeHtml = (unsafe) => {
            return unsafe.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
        }
        // Save Comment
        $(".save-comment").on('click', function () {
            var _comment = escapeHtml($(".comment").val());
            var _firm = $(this).data('firm');
            var vm = $(this);
            // Run Ajax
            $.ajax({
                url: "{{url('/save_comment')}}",
                type: "post",
                dataType: 'json',
                data: {
                    comment: _comment,
                    firm: _firm,
                    _token: "{{ csrf_token() }}"
                },

                beforeSend: function () {
                    vm.text('Добавляем...').addClass('disabled');

                },
                success: function (res) {
                    var _html = '<blockquote class="blockquote">\
            <small class="mb-0">' + _comment + '</small>\
            <br><small style="font-size: 10px" class="mb-0 text-left">' + res.date + '</small>\
            </blockquote><hr/>';
                    if (res.bool == true) {
                        $(".comments").prepend(_html);
                        $(".comment").val('');
                        $(".comment-count").text($('blockquote').length);
                        $(".no-comments").hide();
                    }
                    vm.text('Добавить').removeClass('disabled');
                }
            });
        });
    </script>
@endpush