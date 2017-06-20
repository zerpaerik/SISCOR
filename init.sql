-- Table: public.tblorganismo

-- DROP TABLE public.tblorganismo;

CREATE TABLE public.tblorganismo
(
  id bigserial,
  descripcion character(50),
  estatus integer NOT NULL DEFAULT 1, -- Estatus:...
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
  id bigserial NOT NULL,
  descripcion character(50),
  CONSTRAINT tblcargos_pkey PRIMARY KEY (idcargo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcargos
  OWNER TO postgres;

  CREATE TABLE public.tblcargo
(
  id bigint NOT NULL DEFAULT nextval('tblcargos_id_seq'::regclass),
  descripcion character(50),
  estatus integer NOT NULL DEFAULT 1,
  CONSTRAINT tblcargos_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblcargo
  OWNER TO postgres;
  CREATE TABLE public.tblusuarios
(
  id bigint NOT NULL DEFAULT nextval('usuarios_id_seq'::regclass),
  cedula character varying NOT NULL,
  nombres character varying NOT NULL,
  apellidos character varying NOT NULL,
  usuario character varying NOT NULL,
  contrasena character varying NOT NULL,
  iniciales character varying NOT NULL,
  id_org integer,
  id_dep integer NOT NULL,
  id_cargo integer NOT NULL,
  estatus integer NOT NULL DEFAULT 1,
  fecha_creacion timestamp without time zone NOT NULL DEFAULT now(),
  perfil integer, -- Perfiles:...
  CONSTRAINT usuarios_pkey PRIMARY KEY (id),
  CONSTRAINT usuarios_id_fkey FOREIGN KEY (id)
      REFERENCES public.tblorganismo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_id_fkey1 FOREIGN KEY (id)
      REFERENCES public.tbldependencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_id_fkey2 FOREIGN KEY (id)
      REFERENCES public.tblcargos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tblusuarios
  OWNER TO postgres;
COMMENT ON COLUMN public.tblusuarios.perfil IS 'Perfiles:
1: Usuario Regular
2: Usuario Admin';



