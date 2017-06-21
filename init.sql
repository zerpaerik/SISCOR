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
