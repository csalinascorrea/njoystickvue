<template>
     <main class="main">

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Socios
                        <button type="button" @click="abrirModal('socio', 'registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombreClientes">Nombre</option>
                                      <option value="idClientes">Código</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCliente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Código Njoystick</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Puntos</th>
                                    <th class="text-center">Modificar</th>
                                    <th class="text-center">Visualizar</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr v-for="socio in arraySocios" :key="socio.idClientes">
                                    <td v-text="'NJ'+socio.idClientes"></td>
                                    <td v-text="socio.nombreClientes"></td>
                                    
                                    <td v-if="socio.estadoSocios==1">Activo</td>
                                    <td v-else>Inactivo</td>

                                    <td v-text="socio.puntosSocios"></td>
                                    
                                    <td>
                                        <button type="button" @click="abrirModal('socio', 'actualizar', socio)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                     <td>
                                        <button type="button" @click="abrirModal('socio', 'visualizar', socio)" class="btn btn-succes btn-sm btnvisualizar">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class = "page-item" v-if="pagination.current_page>1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page -1, buscar, criterio)"> Ant</a>
                                
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                
                                <li class = "page-item" v-if="pagination.current_page< pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page+1, buscar, criterio)"> Sig</a>
                                
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" :class="{'mostrar' :modal}" role="dialog"  tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Nuevo socio</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idClientes">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="cliente in arrayClientes" :key="cliente.idClientes"
                                            :value="cliente.idClientes" v-text="cliente.nombreClientes"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Socio invitador</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="Socio_idClientes">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="socio in arraySocios" :key="socio.idClientes"
                                            :value="socio.idClientes" v-text="socio.nombreClientes"></option>
                                        </select>
                                    </div>
                                </div>
                                <!-- listado de socios -->
                                
                                <!-- fin listado de socios -->
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSocio()" >Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarSocio()">Actualizar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data(){
            return{
                idClientes:0,
                nombreClientes:'',
                puntosSocios:'',
                estadoSocios:'',
                Socio_idClientes: 0,
                arraySocios:[],
                arrayClientes:[],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errors: [],
                pagination : {
                'total' :0 ,
                'current_page':0 ,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0,
                },
                offset: 3,
                criterio: 'nombre',
                buscar : ''

            }
        },
        computed:{
            // filterClientes: function() {
            //     var aSoc= this.arraySocios;
            //     return this.arrayClientes.filter(function(cliente) {
            //     return (!(cliente.idClientes in aSoc));

            //     })
            // },
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }

                var from= this.pagination.current_page - this.offset;
                if(from<1){
                    from = 1;
                }

                var to = from + (this.offset*2);
                if(to>=this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray = [];
                while(from<=to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
           
            listarSocio(page, buscar, criterio){
                let me=this;
                var url= '/socios?page='+page + '&buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arraySocios = respuesta.socios.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                })
            },
            selectClientes(){
                let me=this;
                var url= '/clientes/selectClientes';
                axios.get(url).then(function (response){
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayClientes = respuesta.clientes;
                })
                .catch(function (error){
                    console.log(error.response);
                })
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarSocio(page, buscar, criterio);
            },
            registrarSocio(){
                // if(this.validarCliente()){
                //     return;
                // }
                this.errors= []
                let me=this;
                axios.post('socios/registrar',{
                    'idClientes': this.idClientes,
                    'Socio_idClientes': this.Socio_idClientes,
                    

                    }).then(function (response){
                        me.cerrarModal();
                        me.listarCliente(1,'', 'nombre');
                }).catch(function (error){
                    console.log(error.response);
                })
            },
                actualizarCliente(){
                    // if(this.validarCliente()){
                //     return;
                // }
                this.errors= []
                let me=this;
                axios.put('clientes/actualizar',{
                   'idClientes': this.idClientes,
                   'Socio_idClientes': this.Socio_idClientes,
                    }).then(function (response){
                        me.cerrarModal();
                        me.listarCliente(1,'', 'nombre');
                }).catch(error=>{
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                    
                    
                })
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombreClientes='';
                this.errorMsjCliente='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "socio":
                        {
                        switch(accion){
                            case 'registrar':{
                                this.modal = 1;
                                this.tituloModal = "Registrar Nuevo Socio";
                                this.idClientes=0;
                                this.Socio_idClientes=0;
                                this.tipoAccion = 1;
                                break;

                            }
                            case 'actualizar':{
                                this.modal = 1;
                                this.tipoAccion = 2;
                                this.tituloModal = "Modificar Socio";
                                this.idClientes=data['idClientes'];
                                this.Socio_idClientes=data['Socio_idClientes'];
                                this.estadoSocios=data['estadoSocios'];
                                
                                break;

                            }
                        }
                    }
                }
                this.selectClientes();
            }
        },
        
        mounted() {
            this.listarSocio(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>