<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    //------------------PERSONAL---------------------
        //ZONA EMPLEADO
        Permission::create([
            'name'          => 'Navegar zona empleado',
            'slug'          => 'personal.zonaempleado.index',
            'description'   => 'Lista y navega todos los zona empleado del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un zona empleado',
            'slug'          => 'personal.zonaempleado.show',
            'description'   => 'Ve en detalle cada zona empleado del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de zona empleado',
            'slug'          => 'personal.zonaempleado.create',
            'description'   => 'Podría crear nuevos zona empleado en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de zona empleado',
            'slug'          => 'personal.zonaempleado.edit',
            'description'   => 'Podría editar cualquier dato de un zona empleado del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar zona empleado',
            'slug'          => 'personal.zonaempleado.destroy',
            'description'   => 'Podría eliminar cualquier zona empleado del sistema',      
        ]);

         //usuario
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',      
        ]);


        Permission::create([
            'name'          => 'Creación de usuario',
            'slug'          => 'users.create',
            'description'   => 'Podría crear nuevos usuario en el sistema',
        ]);

 //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema'           
        ]);
        
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',      
        ]);

//-----CARGO
        Permission::create([
            'name'          => 'Navegar cargo',
            'slug'          => 'personal.cargo.index',
            'description'   => 'Lista y navega todos los cargo del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un cargo',
            'slug'          => 'personal.cargo.show',
            'description'   => 'Ve en detalle cada cargo del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de cargo',
            'slug'          => 'personal.cargo.create',
            'description'   => 'Podría crear nuevos cargo en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de cargo',
            'slug'          => 'personal.cargo.edit',
            'description'   => 'Podría editar cualquier dato de un cargo del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar cargo',
            'slug'          => 'personal.cargo.destroy',
            'description'   => 'Podría eliminar cualquier cargo del sistema',      
        ]);
        
 //----Reg empleado personal user
         Permission::create([
            'name'          => 'Navegar usuario-personal',
            'slug'          => 'personal.user.index',
            'description'   => 'Lista y navega todos los usuario-personal del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un usuario-personal',
            'slug'          => 'personal.user.show',
            'description'   => 'Ve en detalle cada usuario-personal del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de usuario-personal',
            'slug'          => 'personal.user.create',
            'description'   => 'Podría crear nuevos usuario-personal en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de usuario-personal',
            'slug'          => 'personal.user.edit',
            'description'   => 'Podría editar cualquier dato de un usuario-personal del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario-personal',
            'slug'          => 'personal.user.destroy',
            'description'   => 'Podría eliminar cualquier usuario-personal del sistema',      
        ]);


///-----------Ventas--------------
      
         //zona
                Permission::create([
            'name'          => 'Navegar zona',
            'slug'          => 'ventas.zona.index',
            'description'   => 'Lista y navega todos las zona del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un zona',
            'slug'          => 'ventas.zona.show',
            'description'   => 'Ve en detalle cada zona del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de zona',
            'slug'          => 'ventas.zona.create',
            'description'   => 'Podría crear nuevas zona en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de zona',
            'slug'          => 'ventas.zona.edit',
            'description'   => 'Podría editar cualquier dato de un zona del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar zona',
            'slug'          => 'ventas.zona.destroy',
            'description'   => 'Podría eliminar cualquier zona del sistema',      
        ]);

//---------Clientes
                Permission::create([
            'name'          => 'Navegar cliente',
            'slug'          => 'ventas.cliente.index',
            'description'   => 'Lista y navega todos las cliente del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un cliente',
            'slug'          => 'ventas.cliente.show',
            'description'   => 'Ve en detalle cada cliente del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de cliente',
            'slug'          => 'ventas.cliente.create',
            'description'   => 'Podría crear nuevas cliente en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de cliente',
            'slug'          => 'ventas.cliente.edit',
            'description'   => 'Podría editar cualquier dato de un cliente del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar cliente',
            'slug'          => 'ventas.cliente.destroy',
            'description'   => 'Podría eliminar cualquier cliente del sistema',      
        ]);

  //---------Pedido
                Permission::create([
            'name'          => 'Navegar pedido',
            'slug'          => 'ventas.pedido.index',
            'description'   => 'Lista y navega todos las pedido del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un pedido',
            'slug'          => 'ventas.pedido.show',
            'description'   => 'Ve en detalle cada pedido del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de pedido',
            'slug'          => 'ventas.pedido.create',
            'description'   => 'Podría crear nuevas pedido en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de pedido',
            'slug'          => 'ventas.pedido.edit',
            'description'   => 'Podría editar cualquier dato de un pedido del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar pedido',
            'slug'          => 'ventas.pedido.destroy',
            'description'   => 'Podría eliminar cualquier pedido del sistema',      
        ]);


  //---------Entregaentrega
                Permission::create([
            'name'          => 'Navegar entrega',
            'slug'          => 'ventas.entrega.index',
            'description'   => 'Lista y navega todos las entrega del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un entrega',
            'slug'          => 'ventas.entrega.show',
            'description'   => 'Ve en detalle cada entrega del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de entrega',
            'slug'          => 'ventas.entrega.create',
            'description'   => 'Podría crear nuevas entrega en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de entrega',
            'slug'          => 'ventas.entrega.edit',
            'description'   => 'Podría editar cualquier dato de un entrega del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar entrega',
            'slug'          => 'ventas.entrega.destroy',
            'description'   => 'Podría eliminar cualquier entrega del sistema',      
        ]);


//---------COMPRAS----------
         //proveedor
                Permission::create([
            'name'          => 'Navegar proveerdor',
            'slug'          => 'compras.proveedor.index',
            'description'   => 'Lista y navega todos las proveerdor del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un proveerdor',
            'slug'          => 'compras.proveedor.show',
            'description'   => 'Ve en detalle cada proveerdor del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de proveerdor',
            'slug'          => 'compras.proveedor.create',
            'description'   => 'Podría crear nuevas proveerdor en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de proveerdor',
            'slug'          => 'compras.proveedor.edit',
            'description'   => 'Podría editar cualquier dato de un proveerdor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar proveerdor',
            'slug'          => 'compras.proveedor.destroy',
            'description'   => 'Podría eliminar cualquier proveerdor del sistema',      
        ]);

         //TipoCompratipocompra
                Permission::create([
            'name'          => 'Navegar tipocompra',
            'slug'          => 'compras.tipocompra.index',
            'description'   => 'Lista y navega todos las tipocompra del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un tipocompra',
            'slug'          => 'compras.tipocompra.show',
            'description'   => 'Ve en detalle cada tipocompra del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de tipocompra',
            'slug'          => 'compras.tipocompra.create',
            'description'   => 'Podría crear nuevas tipocompra en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de tipocompra',
            'slug'          => 'compras.tipocompra.edit',
            'description'   => 'Podría editar cualquier dato de un tipocompra del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar tipocompra',
            'slug'          => 'compras.tipocompra.destroy',
            'description'   => 'Podría eliminar cualquier tipocompra del sistema',      
        ]);

         //Ingreso
                Permission::create([
            'name'          => 'Navegar ingreso',
            'slug'          => 'compras.ingreso.index',
            'description'   => 'Lista y navega todos las ingreso del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un ingreso',
            'slug'          => 'compras.ingreso.show',
            'description'   => 'Ve en detalle cada ingreso del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de ingreso',
            'slug'          => 'compras.ingreso.create',
            'description'   => 'Podría crear nuevas ingreso en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de ingreso',
            'slug'          => 'compras.ingreso.edit',
            'description'   => 'Podría editar cualquier dato de un ingreso del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar ingreso',
            'slug'          => 'compras.ingreso.destroy',
            'description'   => 'Podría eliminar cualquier ingreso del sistema',      
        ]);

        
//------------------INVENTARIO------------
         //Marca
                Permission::create([
            'name'          => 'Navegar marca',
            'slug'          => 'inventario.marca.index',
            'description'   => 'Lista y navega todos las marca del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un marca',
            'slug'          => 'inventario.marca.show',
            'description'   => 'Ve en detalle cada marca del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de marca',
            'slug'          => 'inventario.marca.create',
            'description'   => 'Podría crear nuevas marca en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de marca',
            'slug'          => 'inventario.marca.edit',
            'description'   => 'Podría editar cualquier dato de un marca del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar marca',
            'slug'          => 'inventario.marca.destroy',
            'description'   => 'Podría eliminar cualquier sabor del sistema',      
        ]);
        //Sabor
        Permission::create([
            'name'          => 'Navegar sabores',
            'slug'          => 'inventario.sabor.index',
            'description'   => 'Lista y navega todos los sabores del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un sabores',
            'slug'          => 'inventario.sabor.show',
            'description'   => 'Ve en detalle cada sabor del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de sabores',
            'slug'          => 'inventario.sabor.create',
            'description'   => 'Podría crear nuevos sabors en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de sabores',
            'slug'          => 'inventario.sabor.edit',
            'description'   => 'Podría editar cualquier dato de un sabor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar sabor',
            'slug'          => 'inventario.sabor.destroy',
            'description'   => 'Podría eliminar cualquier sabor del sistema',      
        ]);
       
        //Medida
                Permission::create([
            'name'          => 'Navegar medida',
            'slug'          => 'inventario.medida.index',
            'description'   => 'Lista y navega todos los medida del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un medida',
            'slug'          => 'inventario.medida.show',
            'description'   => 'Ve en detalle cada medida del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de medida',
            'slug'          => 'inventario.medida.create',
            'description'   => 'Podría crear nuevos medida en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de medida',
            'slug'          => 'inventario.medida.edit',
            'description'   => 'Podría editar cualquier dato de un medida del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar medida',
            'slug'          => 'inventario.medida.destroy',
            'description'   => 'Podría eliminar cualquier medida del sistema',      
        ]);

        //paquete
                Permission::create([
            'name'          => 'Navegar paquete',
            'slug'          => 'inventario.paquete.index',
            'description'   => 'Lista y navega todos los paquete del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un paquete',
            'slug'          => 'inventario.paquete.show',
            'description'   => 'Ve en detalle cada paquete del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de paquete',
            'slug'          => 'inventario.paquete.create',
            'description'   => 'Podría crear nuevos paquete en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de paquete',
            'slug'          => 'inventario.paquete.edit',
            'description'   => 'Podría editar cualquier dato de un paquete del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar paquete',
            'slug'          => 'inventario.paquete.destroy',
            'description'   => 'Podría eliminar cualquier paquete del sistema',      
        ]);
        //TipoEnvase
                Permission::create([
            'name'          => 'Navegar tipoenvase',
            'slug'          => 'inventario.tipoenvase.index',
            'description'   => 'Lista y navega todos los tipoenvase del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un tipoenvase',
            'slug'          => 'inventario.tipoenvase.show',
            'description'   => 'Ve en detalle cada tipoenvase del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de tipoenvase',
            'slug'          => 'inventario.tipoenvase.create',
            'description'   => 'Podría crear nuevos tipoenvase en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de tipoenvase',
            'slug'          => 'inventario.tipoenvase.edit',
            'description'   => 'Podría editar cualquier dato de un sabor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar tipoenvase',
            'slug'          => 'inventario.tipoenvase.destroy',
            'description'   => 'Podría eliminar cualquier sabor del sistema',      
        ]);
        //tipo de bebida
                Permission::create([
            'name'          => 'Navegar tipos de bebidas',
            'slug'          => 'inventario.tipobebida.index',
            'description'   => 'Lista y navega todos los tipos de bebidas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un tipos de bebidas',
            'slug'          => 'inventario.tipobebida.show',
            'description'   => 'Ve en detalle cada tipos de bebidas del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de tipos de bebidas',
            'slug'          => 'inventario.tipobebida.create',
            'description'   => 'Podría crear nuevos tipos de bebidas en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de tipos de bebidas',
            'slug'          => 'inventario.tipobebida.edit',
            'description'   => 'Podría editar cualquier dato de un tipos de bebidas del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar tipos de bebidas',
            'slug'          => 'inventario.tipobebida.destroy',
            'description'   => 'Podría eliminar cualquier tipos de bebidas del sistema',      
        ]);     
        //Producto

                     Permission::create([
            'name'          => 'Navegar producto',
            'slug'          => 'inventario.producto.index',
            'description'   => 'Lista y navega todos los producto del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un producto',
            'slug'          => 'inventario.producto.show',
            'description'   => 'Ve en detalle cada producto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de producto',
            'slug'          => 'inventario.producto.create',
            'description'   => 'Podría crear nuevos producto en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de producto',
            'slug'          => 'inventario.producto.edit',
            'description'   => 'Podría editar cualquier dato de un producto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar producto',
            'slug'          => 'inventario.producto.destroy',
            'description'   => 'Podría eliminar cualquier producto del sistema',      
        ]);


           //INVETARIO

                     Permission::create([
            'name'          => 'Navegar inventario',
            'slug'          => 'inventario.index',
            'description'   => 'Lista y navega todos los inventario del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un inventario',
            'slug'          => 'inventario.show',
            'description'   => 'Ve en detalle cada inventario del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de inventario',
            'slug'          => 'inventario.create',
            'description'   => 'Podría crear nuevos inventario en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de inventario',
            'slug'          => 'inventario.edit',
            'description'   => 'Podría editar cualquier dato de un inventario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar inventario',
            'slug'          => 'inventario.destroy',
            'description'   => 'Podría eliminar cualquier inventario del sistema',      
        ]);


   //ALMACEN

                     Permission::create([
            'name'          => 'Navegar almacen',
            'slug'          => 'inventario.almacen.index',
            'description'   => 'Lista y navega todos los almacen del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un almacen',
            'slug'          => 'inventario.almacen.show',
            'description'   => 'Ve en detalle cada almacen del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de almacen',
            'slug'          => 'inventario.almacen.create',
            'description'   => 'Podría crear nuevos almacen en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de almacen',
            'slug'          => 'inventario.almacen.edit',
            'description'   => 'Podría editar cualquier dato de un almacen del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar almacen',
            'slug'          => 'inventario.almacen.destroy',
            'description'   => 'Podría eliminar cualquier almacen del sistema',      
        ]);

    //

    }
}
