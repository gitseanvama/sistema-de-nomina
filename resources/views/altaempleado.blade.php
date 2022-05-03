@extends('vistabootstrap')

@section('contenido')
<div class="container">
<h1>Alta de empleado</h1>
<hr>
<form action = "{{route('guardarempleado')}}" method = "POST" enctype = 'multipart/form-data'>
    {{csrf_field()}}
    <div class="well">
      <div class="form-group">
          <label for="dni">Clave Empleado:
              @if($errors->first('ide'))
              <p class='text-danger'>{{$errors->first('ide')}}</ide>
              @endif
          </label>
          <input type="text" name="ide" id="ide" value="{{$idsigue}}" readonly = 'readonly' class="form-control" placeholder="Clave empleado" tabindex="5">
      </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre:
                        @if($errors->first('nombre'))
              <p class='text-danger'>{{$errors->first('nombre')}}</p>
              @endif
                    </label>
                <input type="text" name="nombre" id="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre" tabindex="1">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="apellido">Apellido:
                        @if($errors->first('apellido'))
              <p class='text-danger'>{{$errors->first('apellido')}}</ide>
              @endif
                    </label>
                    <input type="text" name="apellido" id="apellido" value="{{old('apellido')}}" class="form-control" placeholder="Apellido" tabindex="2">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="email">Email:
                        @if($errors->first('email'))
              <p class='text-danger'>{{$errors->first('email')}}</ide>
              @endif
                    </label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Email" tabindex="4">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="celular">Celular:
                        @if($errors->first('celular'))
              <p class='text-danger'>{{$errors->first('celular')}}</ide>
              @endif
                    </label>
                    <input type="text" name="celular" id="celular" value="{{old('celular')}}"class="form-control" placeholder="Celular" tabindex="3">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="dni">Sexo:</label>
                <div class="custom-control custom-radio">
                <input type="radio" id="sexo1" name="sexo"  value = "M" class="custom-control-input" checked="">
                <label class="custom-control-label" for="sexo1">Masculino</label>
                </div>
                <div class="custom-control custom-radio">
                <input type="radio" id="sexo2" name="sexo" value = "F" class="custom-control-input">
                <label class="custom-control-label" for="sexo2">Femenino</label>
                </div>


            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">

              <div class="form-group">
                <label for="dni">Departamento:</label>
                <select name = 'idd' class="custom-select">
                  <option selected="">Selecciona un departamento</option>
                  @foreach ($departamentos as $depa)
                  <option value="{{$depa->idd}}">{{$depa->nombre}}</option>                      
                  @endforeach
                    
                </select>
              </div>

            </div>
        </div>
        <div class="form-group">
            <label for="dni">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" tabindex="5">
            </textarea>
        </div>

        <div class="form-group">
            <label for="dni">Foto perfil:</label>
            @if($errors->first('img'))
              <p class='text-danger'>{{$errors->first('img')}}</p>
              @endif
            <input type='file' name="img" id="img" class="form-control" tabindex="6">
            </input>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-6"><input type="submit" value="Guardar" class="btn btn-danger btn-block btn-lg" tabindex="7"
                title="Guardar datos ingresados"></div>
        </div>
</form>
  @stop
