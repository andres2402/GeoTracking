@extends('layouts.app', [
'class' => '',
'elementActive' => 'parameters'
])

@section('content')
<div class="content" id="app">
    <paramters-value inline-template>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Parametros</h4>
                    </div>
                    <div class="card-body">
                        
                        <form  :action="action" method="post">
                            <input type="hidden" v-model="method" name="_method">
                            @csrf
                            <div class="form-group">
                                <label for="">Nombre*</label>
                                <input ref="name"  type="text" name="name" id="" v-model="name" class="form-control" placeholder="Ingrese Nombre"
                                    aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Ejemplo: Tipo de documento, tipo de
                                    pago</small>
                            </div>
                            <div v-if="method=='PUT'" class="form-group">
                                <label class="form-control-label" for="input-password">Estado *</label>
                                <select name="state"  class="form-control" required>
                                    <option :selected="parameterChoosen.state=='Activo'" value="1"> Activo</option>
                                    <option :selected="parameterChoosen.state=='Inactivo'" value="0"> Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Descripcion*</label>
                                <textarea required ref="description" cols="30" v-model="description" rows="5" type="text" name="description" id="" class="form-control"
                                    placeholder="Ingrese Descripcion"></textarea>
                                <small id="helpId" class="text-muted">Ejemplo: Parametro para ....</small>
                            </div>
                            

                            <button v-if="method=='PUT'" @click="clearParameter" type="button" class="btn btn-danger btn-lg btn-block">Cancelar </button>
                            <button type="submit" class="btn btn-primary btn-lg btn-block" v-text="method=='POST'?'Crear':'Actualizar'"> </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @include('layouts.alerts')
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Descripcion
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>
                                        Opciones
                                    </th>
                                </thead>
                                <tbody>
                                    <tr v-for="param in parameters" :key="param.id">
                                        <td v-text="param.name"></td>
                                        <td v-text="param.description"></td>
                                        <td v-text="param.state"></td>
                                        <td class="d-flex justify-content-between">
                                            <button @click="current=param;showModal=true" type="button"
                                                class="btn btn-secondary btn-sm"><i
                                                    class="nc-icon nc-tile-56"></i></button>
                                            <button @click="selectedParameter(param)" type="button" class="btn btn-info btn-sm"><i
                                                    class="nc-icon nc-settings"></i></button>
                                            @checkAction('destroy','valores-parametros.destroy')
                                                <button v-if="!param.extra" @click="remove('/valores-parametros', param.id)" type="button"
                                                    class="btn btn-danger btn-sm"><i class="nc-icon nc-simple-delete"></i>
                                                </button>
                                            @endcheckAction
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <modal v-if="showModal" @close="showModal = false">
                <div slot="header" class="d-flex justify-content-between w-100">
                    <h4 class="card-title"> Valores Parametros
                    </h4>
                    <button type="button" @click="showModal=false" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row" v-if="current" slot="body">
                    <form ref="formValues" class="col-md-4"   method="post">
                        <div v-if="'message' in errors" class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong v-text="errors.message"> </strong> 
                        </div>
                        <input type="hidden" :value="current.id" name="parameter_id">
                        <input type="hidden" v-model="methodValue" name="_method">
                        <div class="form-group">
                            <label for="">Nombre*</label>
                            <input ref="nameValue" type="text" v-model="valueName" name="name" id="" class="form-control" placeholder="Ingrese Nombre"
                                aria-describedby="helpId" required>
                            <small id="helpId" class="text-muted">Ejemplo: Tipo de documento, tipo de
                                pago</small>
                        </div>
                        <div v-if="methodValue=='PUT'" class="form-group">
                            <label class="form-control-label" for="input-password">Estado *</label>
                            <select name="state"  class="form-control" required>
                                <option :selected="valueChoosen.state=='Activo'" value="1"> Activo</option>
                                <option :selected="valueChoosen.state=='Inactivo'" value="0"> Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Descripcion*</label>
                            <textarea required ref="descriptionValue" v-model="valueDescription" cols="30" rows="5" type="text" name="description" id="" class="form-control"
                                placeholder="Ingrese Descripcion" required></textarea>
                            <small id="helpId" class="text-muted">Ejemplo: Parametro para ....</small>
                        </div>
                        <button v-if="methodValue=='PUT'" @click="clearValue" type="button" class="btn btn-danger btn-lg btn-block">Cancelar </button>
                        <button @click="saveValues" v-if="methodValue=='POST'" type="button" class="btn btn-primary btn-lg btn-block"> Crear</button>
                        <button @click="updateValues" v-if="methodValue=='PUT'" type="button" class="btn btn-primary btn-lg btn-block"> Actualizar</button>
                    
                    </form>
                    <div class="table-responsive col-md-8" style="height: 400px">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Descripcion
                                </th>
                                <th>
                                    estado
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </thead>
                            <tbody>
                                <tr v-for="value in current.parameters_values" :key="value.id">
                                    <td v-text="value.name"></td>
                                    <td v-text="value.description"></td>
                                    <td v-text="value.state"></td>
                                    <td class="d-flex justify-content-between">
                                        <button  @click="selectedValue(value)" type="button" class="btn btn-info btn-sm"><i
                                                class="nc-icon nc-settings"></i></button>
                                        <button @click="remove('/values', value.id,false)" type="button"
                                            class="btn btn-danger btn-sm"><i class="nc-icon nc-simple-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div slot="footer" class="d-flex justify-content-between">
                    
                    <button type="button" @click="showModal=false" class="btn btn-danger btn-sm"><i class="nc-icon nc-simple-remove"></i> cerrar</button>

                </div>
            </modal>
        </div>
    </paramters-value>
</div>
@endsection
