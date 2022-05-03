<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Empresa PATITO.COM</h1>
    <br>
    Nombre del empleado {{$nombre}} trabajo {{$dias}} se le pago {{$nomina}}
    <br>
    @if($nombre=="Cristiano")
    <h1>Hola Cristiano Ronaldo</h1>
    <br>
    <img src="{{asset('fotos/cristiano.jpg')}}" weight =100 height=100>
    @endif
    @if($nombre=="Kath")
    <h1>Hola Laguerta</h1>
    <br>
    <img src="{{asset('fotos/kath.jpg')}}" weight =100 height=100>
    @else
    <h1>Sin foto</h1>
    @endif
    <br>
    <a href="{{route('salirnomina')}}"> Cerrar Nomina</a>
</body>
</html> 