@extends('layouts.mail')
@section('content')
	<p>Recuperação de Acesso</p>
    <p>Clique no link abaixo para recuperar seu acesso ao sistema Samu Life:</p><br>
    <a href="https://samulife.com.br/recover/{{ $user['custom_id'] }}">Redefinir minha senha</a>
@endsection
