var app = angular.module('Examen', []);
app.controller('controlventas', function($scope, $http) {
    $scope.vista = "factura";
    $scope.listaproductos = [];
    $scope.productodetalle = [];
    $scope.detalleu = [];
    $scope.listacategorias = [];

    $scope.verListaProductos = function() {
        $scope.vista = "listap";
    }
    $scope.volver = function() {
        $scope.vista = "factura";
    }
    $scope.volver1 = function() {
        $scope.vista = "listap";
    }
    $scope.addproducto = function(producto) {
        var prod = $scope.listaproductos.filter(function(p) {
            return p == producto;
        })
        $scope.productodetalle = prod[0];
        $scope.vista = "agregarpedido";
        $scope.datosderegistro.direccion = "";
        $scope.datosderegistro.usuario = "";
        $scope.datosderegistro.cantidad = "";
        $scope.datosderegistro.numeroFactura = "";
    }
    $scope.generarFactura = function(producto, datosderegistro) {
        var lista = angular.copy(producto);
        var dt = angular.copy(datosderegistro);
        var direccion = dt.direccion;
        var nombre = dt.usuario;
        var cantidad = dt.cantidad;
        var factura = dt.numeroFactura;
        var f = new Date();
        var d, m, a;
        d = f.getDate();
        m = f.getMonth() + 1;
        a = f.getFullYear();
        var fecha = a + '-' + m + '-' + d;
        var precio = lista.precio;
        var subtotal = parseFloat(cantidad) * parseFloat(precio);
        var pid = lista.id;
        var igv = subtotal * 0.18;
        var total = subtotal + igv;
        var nuevodetalle = {
            cantidad: cantidad,
            precio: subtotal,
            producto_id: pid,
            nrofactura: factura,
            nombrecliente: nombre,
            direccion: direccion,
            fecha: fecha,
            total: total,
        };

        console.log(nuevodetalle);
        $http({
            method: "POST",
            url: '../Control/ControlDetalles.php?action=newDetail',
            data: nuevodetalle
        }).then(function(response) {
            if (response.status == 200) {
                $scope.listandoDetalless();
                $scope.vista = "factura";
            }

        })

    }

    $scope.adminproductos = function() {
        $scope.vista = "ctrlproducto";
    }
    $scope.listandoProductos = function() {
        $http({
            method: "GET",
            url: "../Control/controlProducto.php?action=listar"
        }).then(function(response) {
            $scope.listaproductos = response.data;
            console.log($scope.listaproductos);
        })

    }
    $scope.listandoProductos();
    $scope.verDetalleProducto = function(producto) {
        var prod = $scope.listaproductos.filter(function(p) {
            return p == producto;
        })
        $scope.detalleu = prod[0];
        $scope.vista = "verdetalleproducto";
    }
    $scope.volver2 = function() {
        $scope.vista = "ctrlproducto";
    }
    $scope.editarproducto = function(producto) {
        var prod = $scope.listaproductos.filter(function(p) {
            return p == producto;
        })

        $scope.detalleu = prod[0];
        $http({
            method: "GET",
            url: "../Control/controlCategoria.php?action=listar"
        }).then(function(response) {
            $scope.listacategorias = response.data;
            console.log($scope.listacategorias);
        })
        $scope.vista = "editarproductoo";
    }
    $scope.GuardarCambios = function(producto) {
        $scope.prod = angular.copy(producto);
        $http({
            method: "POST",
            url: "../Control/controlProducto.php?action=update",
            data: $scope.prod
        }).then(function(response) {})
        console.log($scope.prod);
        $scope.listandoProductos();
        $scope.vista = "ctrlproducto";
    }
    $scope.addprod = function() {
        $http({
            method: "GET",
            url: "../Control/controlCategoria.php?action=listar"
        }).then(function(response) {
            $scope.listacategorias = response.data;
            console.log($scope.listacategorias);
        })
        $scope.vista = "nuevoproducto";
        $scope.detalleu1.id = "";
        $scope.detalleu1.denominacion = "";
        $scope.detalleu1.stock = "";
        $scope.detalleu1.precio = "";
        $scope.detalleu1.cat = "";
    }
    $scope.darbajaProducto = function(producto) {
        $scope.prod = angular.copy(producto);
        $http({
            method: "POST",
            url: "../Control/controllerProducto.php?action=eliminar",
            data: $scope.prod
        }).then(function(response) {});
        $scope.listandoProductos();
        console.log($scope.prod);
        $scope.vista = "ctrlproducto";
    }
    $scope.AgregarProducto = function(producto) {
        $scope.prod = angular.copy(producto);
        $http({
            method: "POST",
            url: "../Control/controllerProducto.php?action=agregar",
            data: $scope.prod
        }).then(function(response) {})
        $scope.listandoProductos();
        console.log($scope.prod);
        $scope.vista = "ctrlproducto";
    }
    $scope.listaDetalless = [];
    $scope.calcularotros = function(det) {
        $scope.total11 = 0;
        $scope.subtotal11 = 0;
        $scope.igv11 = 0;
        for (var i = 0; i < det.length; i++) {
            $scope.subtotal11 = $scope.subtotal11 + parseFloat(det[i].dp);
        }
        $scope.igv11 = $scope.subtotal11 * 0.18;
        $scope.total11 = $scope.subtotal11 + $scope.igv11;

    }
    $scope.listandoDetalless = function() {
        $http({
            method: "GET",
            url: "../Control/controlDetalles.php?ac=listar"
        }).then(function(response) {
            $scope.listaDetalless = response.data;
            console.log($scope.listaDetalless);
            if (response.status == 200) {
                $scope.calcularotros($scope.listaDetalless);
            }
        })


    }
    $scope.listandoDetalless();


});