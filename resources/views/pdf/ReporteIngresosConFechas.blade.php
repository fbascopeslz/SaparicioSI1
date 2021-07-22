<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Ingresos</title>
	<style>
           
        div.listadoContenedor{
         
            
            padding: 25px;
            margin: 30px;;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            
        }
        
        div.listadoContenedor tr th {
            position: relative;
            padding-right: 90px;
            background-color: deepskyblue;
        }
        div.listadoContenedor tbody tr td{
            position: relative;
            padding-top: 10px;
            padding-right: 15px;
            
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
        h1{
            position: relative;
            left: 250px;
            width: 600px;
            
        }

    
    </style>
</head>
<body>
    
   
<div class="contenedor" >
        
    <h1 style="text-align:center">Reporte de todos nuestros ingresos de productos desde la fecha {{$fIni}} hasta la fecha {{$fFin}}</h1>
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
                    <th>Fecha</th>	
					<th>Proveedor</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>	
				
                   </tr>
                   
					
    </thead>
    <tbody>
    @foreach($datos as $i)
    <tr>
        <td>{{$i->fecha}}</td>
        <td>{{$i->nombre}}</td>
        <td>{{$i -> tipoComprobante.':   '.$i -> serieComprobante.' -  '.$i -> numComprobante}}</td>
                    <td>{{$i -> impuesto}}</td>
                    <td>{{$i -> total1}}</td>                    
                    <td>{{$i -> estado}}</td>                    
                    
    </tr>
    
    @endforeach
    
      
   
    </tbody>
            
        
</table>
</div>
    </div>

 
    
</body>