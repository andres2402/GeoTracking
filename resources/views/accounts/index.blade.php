@extends('layouts.app', [
   'class' => '',
   'elementActive' => 'tables'
])

@push('styles')
   <style media="screen">
   .overflowAuto {overflow: auto;}
   .form-check{display: inline !important;}
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

      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col">
                  <h4 class="card-title"> Estado de cuenta</h4>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive overflowAuto">
               <table class="table">
                  <thead class=" text-primary">
                     <th>Fecha</th>
                     <th>Concepto</th>
                     <th>Valor anterior</th>
                     <th>Valor</th>
                     <th>Total</th>
                  </thead>
                  <tbody>
                     @foreach ($accounts as $key => $account)
                        <tr>
                           <td class="{{$account->type==1 ? 'text-success' : 'text-danger'}} text-uppercase">{{date('d/m/Y h:i a', strtotime($account->created_at))}}</td>
                           <td class="{{$account->type==1 ? 'text-success' : 'text-danger'}}"><b>{{$account->name}}</b></td>
                           <td class="{{$account->type==1 ? 'text-success' : 'text-danger'}}">${{number_format(Crypt::decryptString($account->previous_value), 0, ',', '.')}}</td>
                           <td class="{{$account->type==1 ? 'text-success' : 'text-danger'}}">${{number_format(Crypt::decryptString($account->value), 0, ',', '.')}}</td>
                           <td class="{{$account->type==1 ? 'text-success' : 'text-danger'}}">${{number_format(Crypt::decryptString($account->total), 0, ',', '.')}}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- MODAL -->
   {{-- <div class="modal fade" id="idAddRole" tabindex="-1" role="dialog" aria-labelledby="idAddRoleLabel" aria-hidden="true">
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
                        <input type="text" name="name" class="form-control" id="idAddRoleName" placeholder="Nombre" required>
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

   <div class="modal fade" id="idEditRole" tabindex="-1" role="dialog" aria-labelledby="idEditRoleLabel" aria-hidden="true">
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
                     <select name="state" class="form-control" id="idEditRoleState" class="selecttwo form-control" required>
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
   </div> --}}
@endsection

@push('scripts')
   <script type="text/javascript">
   let token = document.querySelector("meta[name=token]").content;

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
