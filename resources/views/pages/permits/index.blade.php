@extends('layouts.app', [
   'class' => '',
   'elementActive' => 'tables'
])

@push('styles')
   <style media="screen">
   .overflowAuto {
      overflow: auto;
   }

   .form-check {
      display: inline !important;
   }
</style>
@endpush

@section('content')
   <div class="content">
      @if (Session::has('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
      @elseif(Session::has('warning'))
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
      @endif

      <div class="row">
         <div class="col-md-5">
            <div class="card">
               <div class="card-header">
                  <div class="row">
                     <div class="col">
                        <h4 class="card-title"> Roles</h4>
                     </div>
                     <div class="col text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#idAddRole"><i class="fa fa-plus"></i> Agregar rol</button>
                        <button class="btn btn-primary btn-sm btn-filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                     </div>

                     <div class="col-12">
                        <div class="card form-filter" style="display: none">
                           <div class="card-body">

                              <form action="{{route('roles.index')}}" method="get">
                                 <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
                                    placeholder="Ingrese nombre" value="{{request()->name}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Estado</label>
                                    <select class="form-control" name="state">
                                       <option  value=""  {{empty(request()->state)?'selected':''}}  >Todos</option>
                                       <option {{request()->state==1?'selected':''}} value="1">Activo</option>
                                       <option {{request()->state===0?'selected':''}} value="0">Inactivo</option>
                                    </select>
                                 </div>
                                 <div class="d-flex justify-content-around">
                                    <button type="submit" name="" id=""  class="btn btn-primary">Filtrar</button>
                                    <a href="{{route('roles.index')}}"  class="btn btn-danger">Limpiar</a>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive overflowAuto">
                     <table class="table">
                        <thead class=" text-primary">
                           <th>Nombre</th>
                           <th>Estado</th>
                           <th></th>
                        </thead>
                        <tbody>
                           @foreach ($roles as $key => $role)
                              <tr>
                                 <td class="text-uppercase">{{$role->name}}</td>
                                 <td>
                                    <span class="badge badge-{{Config::get('constant.states')[$role->state]['color']}} text-uppercase">{{Config::get('constant.states')[$role['state']]['name']}}</span>
                                 </td>
                                 <td class="text-center">
                                    <button class="btn btn-primary btn-sm btn-fab btn-icon btnEditRol {{$role->unique!=1 ? '' : 'disabled'}}" data-id="{{$role->id}}">
                                       <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-fab btn-icon {{$role->unique!=1 ? '' : 'disabled'}}" onclick="deleteResource('roles', {{$role->id}})">
                                       <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm btn-fab btn-icon btnPermits {{$role->id != 1 ? '' : 'disabled'}}" data-id="{{$role->id}}">
                                       <i class="fa fa-cog"></i>
                                    </button>
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-7">
            <form action="{{route('permits.store')}}" method="POST">
               @csrf
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col">
                           <h4 class="card-title">Modulos <strong id="idRoleTitle"></strong></h4>
                           <input type="hidden" id="idRole" name="role_id" value="">
                        </div>
                        <div class="col text-right">
                           <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o"></i> Guardar
                              permisos</button>
                           </div>
                        </div>
                     </div>
                     <div class="card-body p-3">
                        <div class="border p-3">
                           <div class="row align-items-center">
                              @foreach ($modules as $key => $module)
                                 <div class="col-12">
                                    <div class="card my-2">
                                       <div class="card-body">
                                          <div class="row">
                                             <div class="col-3 align-self-center">
                                                <h6 class="mb-0 text-muted font-weight-bold">{{$module->name}}</h6>
                                             </div>
                                             <div class="col-9 align-self-center">
                                                @foreach ($module->actions as $key => $action)
                                                   <div class="form-check">
                                                      <label class="form-check-label text-uppercase font-weight-bold">
                                                         <input name="permits[{{$module->id}}][]" class="form-check-input"
                                                         type="checkbox" id="idM{{$module->id}}A{{$action->id}}"
                                                         value="{{$action->id}}" disabled>
                                                         {{$action->name}}
                                                         <span class="form-check-sign">
                                                            <span class="check"></span>
                                                         </span>
                                                      </label>
                                                   </div>
                                                @endforeach
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade" id="idAddRole" tabindex="-1" role="dialog" aria-labelledby="idAddRoleLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <form class="" action="{{ route('roles.store') }}" method="POST">
               @csrf
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Crear rol</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form id="formAddRol" action="javascript:;" method="post">
                        <div class="form-group">
                           <label for="idAddRoleName">Nombre *</label>
                           <input type="text" name="name" class="form-control" id="idAddRoleName" placeholder="Nombre"
                           required>
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                     <button type="submit" class="btn btn-primary">Crear Rol</button>
                  </div>
               </div>
            </form>
         </div>
      </div>

      <div class="modal fade" id="idEditRole" tabindex="-1" role="dialog" aria-labelledby="idEditRoleLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form id="idFormUpdateRol" method="POST">
            @csrf
            @method('put')
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar rol</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i class="fa fa-times"></i>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label for="idEditRoleName">Nombre *</label>
                     <input type="text" name="name" class="form-control" id="idEditRoleName" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                     <label for="idEditRoleState">Estado *</label>
                     <select name="state" class="form-control" id="idEditRoleState" class="selecttwo form-control"
                     required>
                     @foreach(Config::get('constant.states') as $id => $state)
                        <option value="{{$id}}">{{$state['name']}}
                        </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary">Actualizar Rol</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection

@push('scripts')
   <script type="text/javascript">
   $(document).on('click', '.btnEditRol', function () {
      var id = $(this).data('id');

      fetch("roles/"+id, {
         method: 'GET',
         headers: {
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
         }
      })
      .then((response) => response.json())
      .then(function(data) {
         var data = data.data;
         $('#idFormUpdateRol').attr('action', '/roles/'+id);
         $('#idEditRoleName').val(data.name);
         $('#idEditRoleState').val(data.state).trigger('change');
         $('#idEditRole').modal();
      })
      .catch(function(error) {
         console.error('Error:', error);
      });
   });

   $(document).on('click', '.btnPermits', function () {
      var id = $(this).data('id');
      $("#idRoleTitle").text('');

      fetch("permits/"+id, {
         method: 'GET',
         headers: {
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
         }
      })
      .then((response) => response.json())
      .then(function(result) {
         var data = result.data;
         var permits = data.permits;

         $('input[type=checkbox]').prop('disabled', false);
         $('input[type=checkbox]').prop('checked', false);
         $("#idRoleTitle").text(data.role.name);
         $('#idRole').val(id);

         permits.map(function (p) {
            $('#idM' + p.action.module_id + 'A' + p.action_id).prop('checked', true);
         });
      })
      .catch(function(error) {
         console.log("error");
      });
   });
</script>
@endpush
