@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'sms & emails'
])

@section('content')
    <div class="content" id="app">
        <alerting sms="{{env('SMS_COST')}}" inline-template>
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 v-if="type == 0" class="card-title">Envio</h5>
                                        <h5 v-if="type == 1" class="card-title">Envio de SMS</h5>
                                        <h5 v-if="type == 2" class="card-title">Envio de Emails</h5>
                                    </div>
                                    <div class="col-md-4 text-right">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control" v-model="type" name="type" id="select_type">
                                                <option disabled value="0">Selecciones una opción</option>
                                                <option value="1">SMS</option>
                                                <option value="2">Email</option>
                                            </select>
                                        </div>
                                        <div v-if="type == 1" class="form-group">
                                            <label for="input-message-sms">Mensaje</label>
                                            <textarea maxlength="160" v-model="smsMessage" class="form-control" name="messageSms" id="input-message-sms" cols="30" rows="10"></textarea>
                                        </div>
                                        <div v-if="type == 2" class="form-group">
                                            <label for="input-message">Mensaje</label>
                                            <textarea v-model="emailMessage" class="form-control" name="messageEmail" id="input-message-email" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h6 class="card-title">Seleccionar clientes</h6>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <div class="input-group-prepend">
                                                            <input v-model="filter_name" class="form-control" type="text">
                                                            <span class="input-group-text">
                                                                <i class="nc-icon nc-zoom-split"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive" style="height: 250px">
                                                    <table class="table table-flush">
                                                        <thead>
                                                            <tr>
                                                                <th><input v-model="selectAll" type="checkbox"></th>
                                                                <th>Nombre</th>
                                                                <th>Télefono</th>
                                                                <th>Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="customer in filter_customer"
                                                            :key="customer.id">
                                                                <td>
                                                                    <input type="checkbox"
                                                                    :id="customer.id"
                                                                    :value="customer"
                                                                    v-model="selected">
                                                                </td>
                                                                <td v-text="customer.user.name+ ' ' + customer.user.last_name"></td>
                                                                <td v-text="customer.user.phone"></td>
                                                                <td v-text="customer.user.email"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <button v-if="type==1" @click="sendSms" type="button" class="btn btn-primary btn-round">Enviar SMS</button>
                                    <button v-if="type==2" @click="sendEmail" type="button" class="btn btn-primary btn-round">Enviar Emails</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </alerting>
    </div>
@endsection
