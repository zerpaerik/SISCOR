
  $enviadas = DB::table('tblcorrespondencia as a')
             ->select('a.id','a.id_correspondencia',)
             ->join('tblrecepcion as b','a.id','b.id_correspondencia','b.id_dep_receptor','c.fecha_emision','e.descripcion','d.asunto')
             ->join('tblemision as c','a.id','c.id_correspondencia')
             ->join('tbldetallecorrespondencia as d','a.id_correspondencia','d.id_correspondencia')
             ->join('tbldependencia as e','b.id_dep_receptor','e.id')
             ->where('id_org_emisor','=',$usuarioOrg)
             ->where('id_dep_emisor','=',$usuarioDep)
             ->where('id_estatus_emision','=','6')
             ->orderby('id_correspondencia')
             ->paginate(5);          

 $mostrarCorrespondencia = DB::table('tblcorrespondencia as a ')
                    ->select('a.id','a.id_correspondencia','f.asunto','f.contenido','b.fecha_emision','d.descripcion','e.descripcion')
                    ->join('tblemision as b','a.id','b.id_correspondencia')
                    ->join('tblrecepcion as c','a.id','c.id_correspondencia')
                    ->join('tblorganismo as d','c.id_org_receptor','d.id')
                    ->join('tbldependencia as e','c.id_dep_receptor','e.id')
                    ->join('tbldetallecorrespondencia as f','a.id','f.id_correspondencia')
                    ->where('a.id.correspondencia','=', $id)
                    ->get();

 $recibidas = DB::table('tblrecepcion as a')
            ->select('a.id_correspondencia','a.id_org_receptor','a.id_dep_receptor','a.fecha_recepcion','b.asunto','c.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_emisor','c.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','1')
            ->orderby('id_correspondencia')
            ->paginate(5);  


  $recibidas = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','c.fecha_recepcion','d.asunto','d.descripcion','b.id_dep_emisor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','1')
            ->orderby('id_correspondencia')
            ->paginate(5);                 
                          

   $borradores = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);   
            


    $borradores = DB::table('tblcorrespondencia as a')
            ->select('a.id','a.id_correspondencia','c.id_org_receptor','c.id_dep_receptor','b.fecha_emision','d.asunto','d.descripcion','c.id_dep_receptor')
            ->join('tblemision as b','a.id','b.id_correspondencia')
            ->join('tblrecepcion as c','a.id','c.id_correspondencia')
            ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
            ->join('tbldependencia as e','b.id_dep_emisor','e.id')
            ->where('id_org_receptor','=',$usuarioOrg)
            ->where('id_dep_receptor','=',$usuarioDep)
            ->where('id_estatus_recepcion','=','8')
            ->orderby('id_correspondencia')
            ->paginate(5);  


       $poraprobar = DB::table('tblemision as a')
            ->select('a.id_correspondencia','b.id_org_receptor','b.id_dep_receptor','a.fecha_emision','a.asunto','c.descripcion','b.id_dep_receptor')
            ->join('tblrecepcion as b','a.id_correspondencia','b.id_correspondencia')
            ->join('tbldependencia as c','b.id_dep_receptor','c.id')
            ->where('id_org_emisor','=',$usuarioOrg)
            ->where('id_dep_emisor','=',$usuarioDep)
            ->where('id_estatus_emision','=','3')
            ->orderby('id_correspondencia')
            ->paginate(5);
            

        $poraprobar = DB::table('tblcorrespondencia as')
             ->select('a.id','a.id_correspondencia','b.fecha_emision','c.id_dep_receptor','d.asunto','d.contenido','e.descripcion')  
             ->join('tblemision as b','a.id','b.id_correspondencia')
             ->join('tblrecepcion as as c','a.id','c.id_correspondencia')
             ->join('tbldetallecorrespondencia as d','a.id','d.id_correspondencia')
             ->join('tbldependencia as e','c.id_dep_receptor','e.id')
             ->where('id_org_emisor','=',$usuarioOrg)
             ->where('id_dep_emisor','=',$usuarioDep)
             ->where('id_estatus_emision','=','3')
             ->orderby('id_correspondencia')
             ->paginate(5);               

