CREATE TABLE public.tblorganismo
(
  id bigserial NOT NULL,
  descripcion character(50),
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
  siglas character varying NOT NULL,
  CONSTRAINT tblorganismo_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblorganismo
  OWNER TO postgres;
COMMENT ON COLUMN public.tblorganismo.estatus IS 'Estatus:
1: Activo
2: Inactivo';



CREATE TABLE public.tbldependencia
(
  id bigserial NOT NULL,
  descripcion character(50) NOT NULL,
  id_org integer,
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
  siglas character varying NOT NULL,
  firmante integer, -- Firmante:...
  CONSTRAINT tbldependencia_pkey PRIMARY KEY (id),
  CONSTRAINT tbldependencia_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbldependencia
  OWNER TO postgres;
COMMENT ON COLUMN public.tbldependencia.estatus IS 'Estatus:
1: Activo
2: Inactivo';
COMMENT ON COLUMN public.tbldependencia.firmante IS 'Firmante:
1:Si
2:No';

-- Table: public.tblcargos

-- DROP TABLE public.tblcargos;

CREATE TABLE public.tblcargos
(
  id bigserial NOT NULL,
  descripcion character(50) NOT NULL,
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
  CONSTRAINT tblcargos_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcargos
  OWNER TO postgres;
COMMENT ON COLUMN public.tblcargos.estatus IS 'Estatus:
1: Activo
2: Inactivo';




CREATE TABLE public.tbldireccion
(
  id bigserial NOT NULL,
  descripcion character varying NOT NULL,
  id_org integer,
  id_dep integer,
  siglas character varying NOT NULL,
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
  CONSTRAINT tbldireccion_pkey PRIMARY KEY (id),
  CONSTRAINT tbldireccion_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tbldireccion_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbldireccion
  OWNER TO postgres;
COMMENT ON COLUMN public.tbldireccion.estatus IS 'Estatus:
1: Activo
2: Inactivo';

-- Table: public.tbldivision

-- DROP TABLE public.tbldivision;

CREATE TABLE public.tbldivision
(
  descripcion character varying NOT NULL,
  id_org integer,
  id_dep integer,
  id_dir integer,
  siglas character varying,
  estatus integer NOT NULL DEFAULT 1, -- -Estatus:...
  id bigserial NOT NULL,
  CONSTRAINT tbldivision_pkey PRIMARY KEY (id),
  CONSTRAINT tbldivision_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tbldivision_id_dir_fkey FOREIGN KEY (id_dir)
      REFERENCES public.tbldireccion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tbldivision_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbldivision
  OWNER TO postgres;
COMMENT ON COLUMN public.tbldivision.estatus IS '-Estatus:
1:Activo
2:Inactivo';

CREATE TABLE public.tblimagenes
(
  id bigserial NOT NULL,
  descripcion character varying,
  pie character varying,
  encabezado character varying,
  estatus integer,
  fecha_creacion timestamp without time zone DEFAULT now(),
  id_org integer,
  CONSTRAINT tblimagenes_pkey PRIMARY KEY (id),
  CONSTRAINT tblimagenes_id_fkey FOREIGN KEY (id)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblimagenes
  OWNER TO postgres;

CREATE TABLE public.tblpie
(
  descripcion character varying NOT NULL,
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  pie character varying NOT NULL,
  id_org integer NOT NULL,
  id_dep integer NOT NULL,
  estatus integer DEFAULT 1, -- 1: activo...
  id bigserial NOT NULL,
  CONSTRAINT tblpie_pkey PRIMARY KEY (id),
  CONSTRAINT tblpie_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblpie_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblpie
  OWNER TO postgres;
COMMENT ON COLUMN public.tblpie.estatus IS '1: activo
2:inactivo';


CREATE TABLE public.users
(
  id bigserial NOT NULL,
  nombres character varying NOT NULL,
  apellidos character varying NOT NULL,
  contrasena character varying NOT NULL,
  iniciales character varying NOT NULL,
  id_org integer NOT NULL,
  id_dep integer NOT NULL,
  cargo character varying NOT NULL,
  perfil integer NOT NULL,
  tipo_usuario integer NOT NULL,
  id_dir integer,
  id_div integer,
  aprobador integer,
  estatus integer DEFAULT 1,
  cedula character varying NOT NULL,
  usuario character varying NOT NULL,
  CONSTRAINT users_pkey PRIMARY KEY (id),
  CONSTRAINT users_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT users_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.users
  OWNER TO postgres;


CREATE TABLE public.tblusuariosaprob
(
  id bigserial NOT NULL,
  id_usuario integer NOT NULL,
  id_org integer,
  id_dep integer,
  id_dir integer,
  id_div integer,
  id_dpt integer,
  fecha_inicio timestamp without time zone DEFAULT now(),
  fecha_fin timestamp without time zone,
  CONSTRAINT tblusuariosaprob_pkey PRIMARY KEY (id),
  CONSTRAINT tblusuariosaprob_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_dir_fkey FOREIGN KEY (id_dir)
      REFERENCES public.tbldireccion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_div_fkey FOREIGN KEY (id_div)
      REFERENCES public.tbldivision (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_usuario_fkey FOREIGN KEY (id_usuario)
      REFERENCES public.users (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblusuariosaprob
  OWNER TO postgres;



CREATE TABLE public.tblcorrelativo
(
  id bigserial NOT NULL,
  contador integer NOT NULL,
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  id_org integer,
  id_dep integer,
  id_tipo_correspondencia integer,
  CONSTRAINT tblcorrelativo_pkey PRIMARY KEY (id),
  CONSTRAINT tblcorrelativo_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblcorrelativo_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION

)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcorrelativo
  OWNER TO postgres;

  
  CREATE TABLE public.tbltipocorrespondencia
(
  id bigserial NOT NULL,
  descripcion character varying NOT NULL, -- Tipos de Correspondencia...
  CONSTRAINT tbltipocorrespondencia_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbltipocorrespondencia
  OWNER TO postgres;
COMMENT ON COLUMN public.tbltipocorrespondencia.descripcion IS 'Tipos de Correspondencia
-Oficios
-Memorandum
-Circulares';
CREATE TABLE public.tblestatuscorrespondencia
(
  id bigserial NOT NULL,
  descripcion character varying NOT NULL, -- -Estatus de Correspondencias
  CONSTRAINT tblestatuscorrespondencia_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblestatuscorrespondencia
  OWNER TO postgres;
COMMENT ON COLUMN public.tblestatuscorrespondencia.descripcion IS '-Estatus de Correspondencias';





CREATE TABLE public.tblcorrespondencia
(
  id bigserial NOT NULL,
  id_correspondencia character varying NOT NULL, -- --Númeración de correspondencia
  fecha timestamp with time zone NOT NULL DEFAULT now(),
  CONSTRAINT tblcorrespondencia_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcorrespondencia
  OWNER TO postgres;
COMMENT ON COLUMN public.tblcorrespondencia.id_correspondencia IS '--Númeración de correspondencia';


CREATE TABLE public.tblemision
(
  id bigserial NOT NULL,
  id_correspondencia character varying NOT NULL,
  id_org_emisor integer NOT NULL,
  id_dep_emisor integer NOT NULL,
  id_tipo_correspondencia integer NOT NULL,
  id_usuario_emisor integer NOT NULL,
  id_usuario_aprobador integer NOT NULL,
  fecha_emision timestamp without time zone NOT NULL DEFAULT now(),
  id_estatus_emision integer NOT NULL,
  esrespuesta boolean,
  CONSTRAINT tblemision_pkey PRIMARY KEY (id),
  CONSTRAINT tblemision_id_dep_emisor_fkey FOREIGN KEY (id_dep_emisor)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblemision_id_estatus_emision_fkey FOREIGN KEY (id_estatus_emision)
      REFERENCES public.tblestatuscorrespondencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblemision_id_org_emisor_fkey FOREIGN KEY (id_org_emisor)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblemision_id_tipo_correspondencia_fkey FOREIGN KEY (id_tipo_correspondencia)
      REFERENCES public.tbltipocorrespondencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblemision
  OWNER TO postgres;

  CREATE TABLE public.tblrecepcion
(
  id bigserial NOT NULL,
  id_correspondencia character varying NOT NULL,
  id_org_receptor integer NOT NULL,
  id_dep_receptor integer NOT NULL,
  id_estatus_recepcion integer NOT NULL,
  CONSTRAINT tblrecepcion_pkey PRIMARY KEY (id),
  CONSTRAINT tblrecepcion_id_dep_receptor_fkey FOREIGN KEY (id_dep_receptor)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblrecepcion_id_estatus_recepcion_fkey FOREIGN KEY (id_estatus_recepcion)
      REFERENCES public.tblestatuscorrespondencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblrecepcion_id_org_receptor_fkey FOREIGN KEY (id_org_receptor)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblrecepcion
  OWNER TO postgres;

  CREATE TABLE public.tblhistorialcorrespondencia
(
  id bigserial NOT NULL,
  id_correspondencia character varying NOT NULL,
  id_usuario integer NOT NULL, -- --Id del usuario
  id_estatus_correspondencia integer NOT NULL,
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  emiorec integer NOT NULL, -- Emitido o Recibido....
  CONSTRAINT tblhistorialcorrespondencia_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblhistorialcorrespondencia
  OWNER TO postgres;
COMMENT ON COLUMN public.tblhistorialcorrespondencia.id_usuario IS '--Id del usuario';
COMMENT ON COLUMN public.tblhistorialcorrespondencia.emiorec IS 'Emitido o Recibido.
1. Emitido
2. Recibido';

CREATE TABLE public.tbladjunto
(
  id bigint NOT NULL DEFAULT nextval('tbladjunto_id_seq'::regclass),
  id_correspondencia character varying,
  adjunto character varying,
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT tbladjunto_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbladjunto
  OWNER TO postgres;

