<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Productos</title>
    <style>
        
       
        div.listadoContenedor{
         
            
            padding: 25px;
            margin: 30px;;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            
        }
        
        div.listadoContenedor tr th {
            position: relative;
            padding-right: 40px;
            background-color: deepskyblue;
        }
        div.listadoContenedor tr td{
            position: relative;
            padding-top: 10px;
            
        }
     
        body
        {
            position: relative;

            border:3px solid gray;
/*background-color: cadetblue;*/

        }
        .contenedor{     

        }
        .imgLogo
        { 
            position: absolute;
            top: -30px;
            right: 160px;
        }
        
        div.reporteContact{
            position: absolute;
            top: 0px;
            left: 10px;
            
        }
        
    </style>

</head>
<body>

<div class="contenedor" >
        
    <h1 style="text-align:center">Todos Nuestros Productos</h1>
        <h3 style="text-align:center">({{$date}})</h3>

<!--<img src="https://ibb.co/bNhjEo" alt="Logo" height="75px">-->
<img src="{{base_path()}}/public/imagenes/AparicioLogo.png" alt="" class="imgLogo">
<br>
    <br>
    <br>
    <br>
    <br>
<div class="reporteContact">
    <p>Telefono: <b>75304132</b></p>
    <p>Correo:</p>
    <p>distribuidoraAparicio@gmail.com</p>
</div>    
<div class="listadoContenedor">
    
<table>
    <thead>
                   <tr>
                       
<!--                    <th>idProd</th>-->
                    <th>descripcion</th>	
					<th>precio</th>
					<th>TipoBebida</th>
					<th>TipoEnvase</th>
					<th>Paquete</th>
					<th>Medida</th>
					<th>Marca</th>	
					<th>Sabor</th>			
					<th>estado</th>
					<!--quite tipo-->
				
                   </tr>
                   
					
    </thead>
    <tbody>
    
      @foreach($datos as $p)
          <tr>
           
<!--                    <td>{{$p->idProd}}</td>-->
                    <td>{{ $p->descripcion}}</td>
					<td>{{ $p->precio}}</td>
					<td>{{ $p->tipoBebida}}</td>
					<td>{{ $p->tipoEnvase}}</td>
					<td>{{ $p->paquete}}</td>
					<td>{{ $p->medida}}</td>
					<td>{{ $p->marca}}</td>
					<td>{{ $p->sabor}}</td>	
					<td>{{ $p->estado}}</td>

              </tr>
@endforeach
   
    </tbody>
            
        
</table>
</div>
    </div>

</body>
