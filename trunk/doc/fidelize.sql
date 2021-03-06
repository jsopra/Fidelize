PGDMP     /        
            o            fidelize    8.4.8    8.4.8     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                        0    0 
   STDSTRINGS 
   STDSTRINGS     )   SET standard_conforming_strings = 'off';
                       false                       1262    60614    fidelize    DATABASE     x   CREATE DATABASE fidelize WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'pt_BR.utf8' LC_CTYPE = 'pt_BR.utf8';
    DROP DATABASE fidelize;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                       0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    3            �           1259    60642    tbl_fila    TABLE     �   CREATE TABLE tbl_fila (
    "Chave" character varying NOT NULL,
    "Classe" character varying(500) NOT NULL,
    "Parametros" character varying(500) NOT NULL,
    data_solic timestamp with time zone DEFAULT now() NOT NULL
);
    DROP TABLE public.tbl_fila;
       public         postgres    false    1781    3            �           1259    60625    tbl_lancamento    TABLE     �   CREATE TABLE tbl_lancamento (
    id bigint NOT NULL,
    vencimento date NOT NULL,
    valor real,
    cta_credor character varying(20),
    cta_devedor character varying(20),
    descricao character varying(1000) NOT NULL
);
 "   DROP TABLE public.tbl_lancamento;
       public         postgres    false    3            �           1259    60623    tbl_lancamento_id_seq    SEQUENCE     w   CREATE SEQUENCE tbl_lancamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tbl_lancamento_id_seq;
       public       postgres    false    1499    3                       0    0    tbl_lancamento_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE tbl_lancamento_id_seq OWNED BY tbl_lancamento.id;
            public       postgres    false    1498                       0    0    tbl_lancamento_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('tbl_lancamento_id_seq', 7, true);
            public       postgres    false    1498            �           1259    60634    tbl_mensagem    TABLE     �   CREATE TABLE tbl_mensagem (
    chave character varying(500) NOT NULL,
    link character varying(500),
    data_gerado timestamp with time zone DEFAULT now() NOT NULL
);
     DROP TABLE public.tbl_mensagem;
       public         postgres    false    1780    3            �           2604    60628    id    DEFAULT     c   ALTER TABLE tbl_lancamento ALTER COLUMN id SET DEFAULT nextval('tbl_lancamento_id_seq'::regclass);
 @   ALTER TABLE public.tbl_lancamento ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    1498    1499    1499            �          0    60642    tbl_fila 
   TABLE DATA               H   COPY tbl_fila ("Chave", "Classe", "Parametros", data_solic) FROM stdin;
    public       postgres    false    1501   |       �          0    60625    tbl_lancamento 
   TABLE DATA               \   COPY tbl_lancamento (id, vencimento, valor, cta_credor, cta_devedor, descricao) FROM stdin;
    public       postgres    false    1499   �       �          0    60634    tbl_mensagem 
   TABLE DATA               9   COPY tbl_mensagem (chave, link, data_gerado) FROM stdin;
    public       postgres    false    1500          �           2606    60649    PK_FILA 
   CONSTRAINT     N   ALTER TABLE ONLY tbl_fila
    ADD CONSTRAINT "PK_FILA" PRIMARY KEY ("Chave");
 <   ALTER TABLE ONLY public.tbl_fila DROP CONSTRAINT "PK_FILA";
       public         postgres    false    1501    1501            �           2606    60630    PK_LANCAMENTO 
   CONSTRAINT     U   ALTER TABLE ONLY tbl_lancamento
    ADD CONSTRAINT "PK_LANCAMENTO" PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.tbl_lancamento DROP CONSTRAINT "PK_LANCAMENTO";
       public         postgres    false    1499    1499            �           2606    60641    PK_MENSAGEM 
   CONSTRAINT     T   ALTER TABLE ONLY tbl_mensagem
    ADD CONSTRAINT "PK_MENSAGEM" PRIMARY KEY (chave);
 D   ALTER TABLE ONLY public.tbl_mensagem DROP CONSTRAINT "PK_MENSAGEM";
       public         postgres    false    1500    1500            �      x������ � �      �   b   x�U�K�0D�p�ֻ��z����.H&/o� ��XH89\A�c�HwP;Lc�h_�}u�{�
Z�
P�R蒸�zx��Mm6;?���e�� �      �   �   x��ϻ�0 �ښ"X�W5K�6��_Im��7X/�����R&82
<h�6��9k#@��v�/�Ű�;�O�;p��
JuN1&/	�W� ��)�3d�u5Q��g�A�23��aqI8����;��_�{k��J�     