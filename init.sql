-- Table: public.tblorganismo

-- DROP TABLE public.tblorganismo;

-- DROP TABLE public.tblorganismo;

CREATE TABLE public.tblorganismo
(
  id bigint NOT NULL DEFAULT nextval('tblorganismo_id_org_seq'::regclass),
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


-- Table: public.tbldependencia

-- DROP TABLE public.tbldependencia;

CREATE TABLE public.tbldependencia
(
  id bigserial,
  descripcion character(50) NOT NULL,
  id_org integer,
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
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

-- Table: public.tblcargos

-- DROP TABLE public.tblcargos;

CREATE TABLE public.tblcargos
(
  id bigint NOT NULL DEFAULT nextval('tblcargos_id_seq'::regclass),
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
<<<<<<< HEAD


=======
>>>>>>> 3a40f6b8ae7fe75fa5715f20c05cf9a1992805e0
  -- Table: public.tblusuarios

-- DROP TABLE public.tblusuarios;

CREATE TABLE public.users
(
  id bigint NOT NULL DEFAULT nextval('users_id_seq'::regclass),
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
  id bigint NOT NULL DEFAULT nextval('tblusuariosaprob_id_seq'::regclass),
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
  CONSTRAINT tblusuariosaprob_id_dpt_fkey FOREIGN KEY (id_dpt)
      REFERENCES public.tbldepartamento (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblusuariosaprob_id_usuario_fkey FOREIGN KEY (id_usuario)
      REFERENCES public.tblusuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblusuariosaprob
  OWNER TO postgres;



-- Table: public.tblimagenes

-- DROP TABLE public.tblimagenes;

CREATE TABLE public.tblimagenes
(
  id bigserial,
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

  -- Table: public.tbldireccion

-- DROP TABLE public.tbldireccion;

CREATE TABLE public.tbldireccion
(
  id bigint NOT NULL DEFAULT nextval('tbldireccion_id_seq'::regclass),
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
  id bigint NOT NULL DEFAULT nextval('tbldivision_id_seq'::regclass),
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

-- Table: public.tbldepartamento

-- DROP TABLE public.tbldepartamento;

CREATE TABLE public.tbldepartamento
(
  id integer NOT NULL,
  descripcion character varying NOT NULL,
  id_org integer,
  id_dep integer,
  id_dir integer,
  id_div integer,
  siglas character varying NOT NULL,
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
  CONSTRAINT tbldepartamento_pkey PRIMARY KEY (id),
  CONSTRAINT tbldepartamento_id_dep_fkey FOREIGN KEY (id_dep)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tbldepartamento_id_dir_fkey FOREIGN KEY (id_dir)
      REFERENCES public.tbldireccion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tbldepartamento_id_org_fkey FOREIGN KEY (id_org)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tbldepartamento
  OWNER TO postgres;
COMMENT ON COLUMN public.tbldepartamento.estatus IS 'Estatus:
1: Activo
2.: Inactivo';

CREATE TABLE public.tblcorrelativo
(
  id bigint NOT NULL DEFAULT nextval('tblcorrelativo_id_seq'::regclass),
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
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tblcorrelativo_id_tipo_correspondencia_fkey FOREIGN KEY (id_tipo_correspondencia)
      REFERENCES public.tbltipocorrespondencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcorrelativo
  OWNER TO postgres;

  
  CREATE TABLE public.tbltipocorrespondencia
(
  id bigint NOT NULL DEFAULT nextval('tbltipocorrespondencia_id_seq'::regclass),
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
