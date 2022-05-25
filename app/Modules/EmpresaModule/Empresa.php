<?php

namespace App\Modules\EmpresaModule;

// use App\Http\Controllers\Traits\RestActions;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use App\Http\Controllers\RestActions;

class Empresa extends Model
{
    use Authenticatable, HasApiTokens, SoftDeletes, LogsActivity, RestActions;
    // use HasFactory;

    protected $table = 'empresas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Em_nombre',
        'Em_kit',
        'Em_direccion',
        'Em_per_cont',
        'Em_tel_Cont',
        'Em_logo',
        'Em_correo',
        'Em_contrasena',
    ];


    // Relationships Config
    // public function getType()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'type');
    // }

    // public function getFaculty()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'faculty');
    // }

    // public function getProgram()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'program');
    // }
    // End Relationships config


    public function validateEmpresa($request)
    {
        return Validator::make(
            $request->all(),
            [
                'Em_nombre' => 'required',
                'Em_kit' => 'required',
                'Em_direccion' => 'required',
                'Em_per_cont' => 'required',
                'Em_tel_Cont' => 'required',
                'Em_logo' => '',
                'Em_correo' => 'required',
                'Em_contrasena' => 'required',
            ]
        );
    }

    /* Scopes Config */
    public function scopeEm_nombre($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_nombre', 'like', '%' . $value . '%');
        }
    }
    public function scopeEm_kit($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_kit', 'like', '%' . $value . '%');
        }
    }
    public function scopeEm_direccion($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_direccion', 'like', '%' . $value . '%');
        }
    }
    public function scopeEm_per_cont($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_per_cont', 'like', '%' . $value . '%');
        }
    }
    public function scopeEm_tel_Cont($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_tel_Cont', 'like', '%' . $value . '%');
        }
    }
    public function scopeEm_correo($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Em_correo', 'like', '%' . $value . '%');
        }
    }
    

    public function saveEmpresa($request)
    {
        $validator = $this->validateEmpresa($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $empresa = $this::create([
                'Em_nombre' => $request->Em_nombre,
                'Em_kit' => $request->Em_kit,
                'Em_direccion' => $request->Em_direccion,
                'Em_per_cont' => $request->Em_per_cont,
                'Em_tel_Cont' => $request->Em_tel_Cont,
                'Em_logo' => $request->Em_logo,
                'Em_correo' => $request->Em_correo,
                'Em_contrasena' => $request->Em_contrasena,
            ]);

            //return view($this->path . 'create');
            return $this->respond(200, $empresa, null, 'Empresa creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear empresa');
        }
    }

    public function updateEmpresa($request, $id)
    {
        try {
            $validator = $this->validateEmpresa($request);

            if ($validator->fails()) {
                return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
            }

            $empresa = $this::find($id);
            if (is_null($empresa)) {
                return $this->respond(500, [], 'No se encontró la empresa');
            }

            $empresa->update([
                'Em_nombre' => $request->Em_nombre ?? $empresa->Em_nombre,
                'Em_kit' => $request->Em_kit ?? $empresa->Em_kit,
                'Em_direccion' => $request->Em_direccion ?? $empresa->Em_direccion,
                'Em_per_cont' => $request->Em_per_cont ?? $empresa->Em_per_cont,
                'Em_tel_Cont' => $request->Em_tel_Cont ?? $empresa->Em_tel_Cont,
                'Em_logo' => $request->Em_logo ?? $empresa->Em_logo,
                'Em_correo' => $request->Em_correo ?? $empresa->Em_correo,
                'Em_contrasena' => $request->Em_contrasena ?? $empresa->Em_contrasena,
            ]);

            return $this->respond(200, $empresa, null, 'Empresa creada exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear empresa');
        }
    }

    public function deleteEmpresa($id)
    {
        try {
            $empresa = $this::find($id);
            if (is_null($empresa)) {
                return $this->respond(500, [], 'No se encontró la empresa');
            }
            $empresa->delete();
            return $this->respond(200, $empresa, null, 'Empresa eliminada exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar empresa');
        }
    }
}
