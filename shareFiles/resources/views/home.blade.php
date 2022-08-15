@extends('layouts.app')

<link href="{{ asset('css/home.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @foreach($invitations as $invitation)
            <form method="POST" action="/invit/{{ $invitation->id }}/store">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" disabled name="text" class="form-control"
                           placeholder="{{ $invitation->name }} vous a demandé en contact !">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" name="submit" value="accept" type="submit">Accepter
                        </button>
                        <button class="btn btn-outline-danger" name="submit" value="refuse" type="submit">Refuser
                        </button>
                    </div>
                </div>
            </form>
        @endforeach

        <form method="POST" action="/contact/store">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="matricule" class="form-control" placeholder="Matricule à demander en contact">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Demander</button>
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="contacts" class="card">
                    <div class="card-header">{{ __('Contacts') }}</div>

                    @if(empty($contacts))
                        <div class="contact">
                            Aucun contact pour l'instant, veuillez en rajouter.
                        </div>
                    @endif

                    @foreach($contacts as $contact)
                        <a href="/storage/{{ $contact->id }}">
                            <div class="contact">
                                {{ $contact->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <form method="POST" action="/file/store" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3" style="margin-top:1em">
                <input type="file" name="file" class="form-control"
                       accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.docx,.doc"
                       style="padding:3px 0 0 3px">
                <input type="text" placeholder="Nom du fichier" name="name_file" class="form-control"
                       style="padding:3px 0 0 3px">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Envoyer</button>
                </div>
            </div>
        </form>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="contacts" class="card">
                    <div class="card-header">{{ __('Fichiers partagés') }}</div>

                    @if(empty($files))
                        <div style="margin: 1em auto; text-align: center">
                            Vous n'avez pas encore de fichier à afficher.
                        </div>
                    @endif
                    <table>
                        @foreach($files as $file)

                            <tr>
                                <td style="width: 100%;">
                                    <a href="http://{{$_SERVER['SERVER_NAME']}}:{{$_SERVER['SERVER_PORT']}}/sharefile/{{sha1($file->mat_sender)}}/{{$file->name}}">
                                        <div class="contact">
                                            {{$file->name_file}}
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="/file/download" style="border-bottom: 1px solid #e0dcdc;">
                                        @csrf
                                        <div class="input-group mb-3" style="margin-top:1em">
                                            <input type="hidden" name="name_file" value="{{$file->name}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="submit">Télécharger</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="/file/delete" style="border-bottom: 1px solid #e0dcdc;">
                                        @csrf
                                        <div class="input-group mb-3" style="margin-top:1em">
                                            <input type="hidden" name="name_file" value="{{$file->name}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
