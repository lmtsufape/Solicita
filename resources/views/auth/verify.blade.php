@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <div class="row justify-content-center" style="height:80vh">
        <div class="col-md-8">
            <div class="card" style="margin-top:50px">
                <div class="card-header">{{ __('Verifique seu email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor verifique seu email e clique no link de verificação.') }}
                    {{ __('Se você não recebeu o email') }}, <a href="{{ route('verification.resend') }}" onclick="event.preventDefault(); document.getElementById('form').submit();">{{ __('clique aqui para um novo') }}</a>.
                </div>
                <form method="POST" action="{{ route('verification.resend') }}" id="form">
                  @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
