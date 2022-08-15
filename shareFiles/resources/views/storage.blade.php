@extends('layouts.app')

<link href="{{ asset('css/sharefile.css') }}" rel="stylesheet">

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
                        <button class="btn btn-outline-success" name="submit" value="accept">Accepter</button>
                        <button class="btn btn-outline-danger" name="submit" value="refuse">Refuser</button>
                    </div>
                </div>
            </form>
        @endforeach

        <form method="POST" action="/contact/store">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="matricule" class="form-control" placeholder="Matricule à demander en contact">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary">Demander</button>
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-md-2">
                <div id="contacts" class="card">
                    <div class="card-header">{{ __('Contacts') }}</div>
                    @foreach($contacts as $contact)
                        <form class="remove" action="/storage/{{ $contact->id }}/delete" method="POST">
                            @csrf
                            <button>X</button>
                        </form>
                        <a href="/storage/{{ $contact->id }}">
                            <div class="contact">
                                @if (strtotime($contact->last_action) + (60 * 5) > strtotime(now()))
                                    <span class="online"></span>
                                @else
                                    <span class="offline"></span>
                                @endif
                                {{ $contact->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Fichier de ' . $currentContact->name) }}</div>
                    <div class="messages"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function getStorageId() {
        return "{{ $storageId }}";
    }

    function getUserMatricule() {
        return "{{ $currentMatriculeHash }}"
    }

    function loadMessages() {
        console.log("/storage/files/" + getStorageId())
        $.getJSON("/storage/files/" + getStorageId(), function (data, status) {
            $(".messages").empty();

            if (data.length === 0) {
                $(".messages").append($('<div>').addClass("message")
                    .append($('<div>').addClass("content").text("Aucun fichier pour l'instant ! Veuillez attendre qu'il y ait de nouveaux fichiers disponbiles !"))
                );
            }

            const host = window.location.protocol + "//" + window.location.host;
            $(".messages").append($('<table>').css({"width": "100%"}));
            data.forEach(function (item) {
                let link = `${host}/sharefile/${getUserMatricule()}/${item.name}`

                $(".messages table").append($('<div>').addClass("message")
                    .append($('<div>').addClass("user").html(`
                        <tr>
                            <td style="width: 100%"><a href="${link}">${item.name_file}</a></td>
                            <td>
                                <form method="POST" action="/file/download" style="border-bottom: 1px solid #e0dcdc;">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token">
                                    <div class="input-group mb-3" style="margin-top:1em">
                                        <input type="hidden" name="name_file" value="${item.name}">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="submit">Télécharger</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>`)));
            });
        });
    }

    loadMessages();
    window.setInterval(loadMessages, 3000);
</script>
