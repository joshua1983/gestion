var IP_SERVER = "http://ec2-52-32-48-65.us-west-2.compute.amazonaws.com/admin/index.php";

var MiRutas = {
	admin :{
		toIndex: function(){
			location.href = IP_SERVER + "/Admin";
		},
		toUpload: function(){
			location.href = IP_SERVER + "/Admin/upload";
		},
        toNewEst: function (){
            location.href = IP_SERVER + "/Admin/registrar";
        }
	}, 
	docente:{
		toIndex: function(){
			location.href = IP_SERVER + "/Docente";
		},
		toNew: function(){
			location.href = IP_SERVER + "/Docente/nuevoDocente";
		}
	},
	vendedor:{
		toIndex: function(){
			location.href = IP_SERVER + "/Vendedor";
		},
		toNew: function(){
			location.href = IP_SERVER + "/Vendedor/nuevoVendedor";
		}
	},
	info: {
		toIndex: function(){
			location.href= IP_SERVER + "/Informe";
		}
	},
	general:{
		toExit: function(){
			location.href = IP_SERVER + "/Login/salir";
		}
	}
}