use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class Usuario extends Model
{
    protected $table='usuarios';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'email',
        'contrasena' ,
        'estatus',
        'perfil'
        ];


    public static function login($data){
        $usuario = DB::table('usuarios')
                     ->where('email','=',$data['email'])
                     ->where('estatus','=','Activo')
                     ->first();

         if(!is_null($usuario)){
            if (Hash::check($data['contrasena'],$usuario->contrasena)) {
               Session::put('ID',$usuario->id);
               Session::put('NOMBRE',$usuario->nombre." ".$usuario->apellido);
               Session::put('PERFIL',$usuario->perfil);

               return true;
            }else{
               return false;
            }
         }else{
            return false;
         }        
    }

    public static function lista(){
        $usuario = DB::table('usuarios')
                     ->where('estatus','=','Activo')
                     ->paginate(5);

         if(!is_null($usuario)){
            return $usuario;
         }else{
            return false;
         }        
    }

    public static function guardar($data){
        $usuario=new Usuario;
        $usuario->nombre=$data['nombre'];
        $usuario->apellido=$data['apellido'];
        $usuario->email=$data['email'];
        $usuario->contrasena=$data['contrasena'];
        $usuario->perfil=$data['perfil'];


        $usuario->save();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }


    public static function actualizar($id,$data){
       $usuario=Usuario::findOrFail($id);
       $usuario->nombre=$data['nombre'];
       $usuario->apellido=$data['apellido'];
       $usuario->email=$data['email'];
       $usuario->perfil=$data['perfil'];


       $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }

    public static function eliminar($id){
       $usuario=Usuario::findOrFail($id);
       $usuario->estatus='Inactivo';

       $usuario->update();

         if(!is_null($usuario)){
            return true;
         }else{
            return false;
         }        
    }

}
