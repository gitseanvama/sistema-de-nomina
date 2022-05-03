@extends('vistabootstrap')

@section('contenido')
<div class="container">
<h1>Inicio de Sesion</h1>
<hr>
<form action = "{{route('validar')}}" method = "POST" >
    {{csrf_field()}}
    <div class="well">
      <div class="form-group">
          <label for="dni">Usuario:
              @if($errors->first('usuario'))
              <p class='text-danger'>{{$errors->first('usuario')}}</p>
              @endif

          </label>
          <input type="text" name="usuario" id="usuario" value="" class="form-control" placeholder="Usuario" tabindex="5">
      </div>
                <div class="form-group">
                    <label for="dni">Pasword:
                        @if($errors->first('pasw'))
              <p class='text-danger'>{{$errors->first('pasw')}}</p>
              @endif

                </label>
                <input type="text" name="pasw" id="pasw" value="" class="form-control" placeholder="Pasword" tabindex="1">
            </div>   

        <div class="row">
            <div class="col-xs-6 col-md-6"><input type="submit" value="Iniciar" class="btn btn-danger btn-block btn-lg" tabindex="7"
                title="Iniciar"></div>
        </div>
</form>
<br>
<br>
@if(Session::has('mensaje'))
<div class="alert alert-danger">{{Session::get('mensaje')}}</div>
@endif
  @stop