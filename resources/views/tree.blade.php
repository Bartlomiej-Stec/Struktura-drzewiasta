<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name')}}</title>

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('jstree/dist/themes/default/style.min.css') }}" />
        <script src="{{ asset('jstree/dist/jstree.min.js') }}"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>

    </head>
    <body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Zarządzanie strukturą drzewiastą</h2>
            <hr class="col-xs-12">
        </div>

        <div class="row">
            <div class="col-md-6 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Zarządzaj węzłem
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Zaznaczony węzeł</h6>
                        </div>
                        <span class="text-muted" id="selected-node"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="input-group">
                            <input type="text" class="form-control" id="updateNodeName" placeholder="Nowa nazwa węzła" minlength="{{config('tree.node_minlength')}}" maxlength="{{config('tree.node_maxlength')}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary" id="changeName">Zmień</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Usuń węzeł rekursywnie</h6>
                        </div>
                        <button class="btn btn-danger delete" data-type="recursive">Usuń</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Usuń węzeł (dzieci dołączą do rodzica usuniętego węzła)</h6>
                        </div>
                        <button class="btn btn-warning delete" data-type="parent-connect">Usuń</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Usuń węzeł (dzieci stworzą nowy węzeł główny)</h6>
                        </div>
                        <button class="btn btn-primary delete" data-type="root-connect">Usuń</button>
                    </li>
                </ul>
                <div class="input-group has-validation">
                    <label class="input-group-text" for="parent-select">Rodzic węzła</label>
                    <select class="form-control" id="parent-select">
                        <option value="currently-selected">Obecnie zaznaczony</option>
                        <option value="root">Brak rodzica (węzeł główny)</option>
                    </select>
                </div>
                <div class="input-group">
                    <input id="newNodeName" type="text" class="form-control" placeholder="Nazwa nowego węzła " minlength="{{config('tree.node_minlength')}}" maxlength="{{config('tree.node_maxlength')}}">
                    <div class="input-group-append">
                        <button class="btn btn-success" id="createNode">Stwórz węzeł</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Struktura drzewa</h4>
                <div id="tree"></div>
            </div>
        </div>
    </div>

    </body>
    <script src="{{asset('js/tree.js')}}"></script>
    <script src="{{asset('js/events.js')}}"></script>
    <script src="{{asset('js/data.js')}}"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
</html>
