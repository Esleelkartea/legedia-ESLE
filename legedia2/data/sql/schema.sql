
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- usuario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;


CREATE TABLE `usuario`
(
	`id_usuario` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_idioma` VARCHAR(6)  NOT NULL,
	`usuario` VARCHAR(30),
	`clave` VARCHAR(255),
	`nombre` VARCHAR(150),
	`apellido1` VARCHAR(100),
	`apellido2` VARCHAR(100),
	`dni` VARCHAR(10),
	`domicilio` TEXT,
	`poblacion` VARCHAR(50),
	`cp` INTEGER(9),
	`id_provincia` INTEGER(11),
	`pais` VARCHAR(80),
	`movil` VARCHAR(15),
	`telefono` VARCHAR(15),
	`fax` VARCHAR(15),
	`ultima_visita` DATETIME,
	`email` VARCHAR(45),
	`public_key` TEXT,
	`es_externo` TINYINT,
	`alerta_email` TINYINT default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`fecha_borrado` DATETIME,
	PRIMARY KEY (`id_usuario`),
	INDEX `FI_idioma_usuario` (`id_idioma`),
	CONSTRAINT `fk_idioma_usuario`
		FOREIGN KEY (`id_idioma`)
		REFERENCES `catalogue` (`cat_id`),
	INDEX `FI_usuario_provincia` (`id_provincia`),
	CONSTRAINT `fk_usuario_provincia`
		FOREIGN KEY (`id_provincia`)
		REFERENCES `provincia` (`id_provincia`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo`;


CREATE TABLE `grupo`
(
	`id_grupo` INTEGER  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255),
	`padre` INTEGER,
	PRIMARY KEY (`id_grupo`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- grupo_modulo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo_modulo`;


CREATE TABLE `grupo_modulo`
(
	`modulo` VARCHAR(50)  NOT NULL,
	`accion` VARCHAR(50)  NOT NULL,
	`id_grupo` INTEGER  NOT NULL,
	`permiso` TINYINT default 1,
	PRIMARY KEY (`modulo`,`accion`,`id_grupo`),
	INDEX `FI_grupo_modulo_grupo` (`id_grupo`),
	CONSTRAINT `fk_grupo_modulo_grupo`
		FOREIGN KEY (`id_grupo`)
		REFERENCES `grupo` (`id_grupo`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- usuario_grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario_grupo`;


CREATE TABLE `usuario_grupo`
(
	`id_usuario` INTEGER  NOT NULL,
	`id_grupo` INTEGER  NOT NULL,
	PRIMARY KEY (`id_usuario`,`id_grupo`),
	CONSTRAINT `fk_usuario_grupo_usuario`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`),
	INDEX `FI_grupo_usuario_grupo` (`id_grupo`),
	CONSTRAINT `fk_grupo_usuario_grupo`
		FOREIGN KEY (`id_grupo`)
		REFERENCES `grupo` (`id_grupo`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- catalogue
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue`;


CREATE TABLE `catalogue`
(
	`cat_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nvisible` VARCHAR(100),
	`name` VARCHAR(100),
	`source_lang` VARCHAR(100),
	`target_lang` VARCHAR(100),
	`date_created` DATETIME,
	`date_modified` DATETIME,
	`author` VARCHAR(255),
	PRIMARY KEY (`cat_id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- trans_unit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `trans_unit`;


CREATE TABLE `trans_unit`
(
	`msg_id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cat_id` INTEGER,
	`id` VARCHAR(255),
	`source` TEXT,
	`target` TEXT,
	`comments` TEXT,
	`date_added` DATETIME,
	`date_modified` DATETIME,
	`author` VARCHAR(255),
	`translated` INTEGER,
	PRIMARY KEY (`msg_id`),
	INDEX `trans_unit_FI_1` (`cat_id`),
	CONSTRAINT `trans_unit_FK_1`
		FOREIGN KEY (`cat_id`)
		REFERENCES `catalogue` (`cat_id`)
		ON DELETE CASCADE
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- sesion_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sesion_log`;


CREATE TABLE `sesion_log`
(
	`id_log` INTEGER(15)  NOT NULL AUTO_INCREMENT,
	`id_sesion` INTEGER  NOT NULL,
	`fecha` DATETIME  NOT NULL,
	`URL` VARCHAR(100)  NOT NULL,
	`modulo` VARCHAR(40),
	`accion` VARCHAR(40),
	`firma` TEXT,
	`public_key` TEXT,
	`parametros` TEXT  NOT NULL,
	`mensaje` TEXT  NOT NULL,
	PRIMARY KEY (`id_log`),
	INDEX `FI_inasVistas` (`id_sesion`),
	CONSTRAINT `PaginasVistas`
		FOREIGN KEY (`id_sesion`)
		REFERENCES `sesion` (`id_sesion`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- alcance
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `alcance`;


CREATE TABLE `alcance`
(
	`id_alcance` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_usuario` INTEGER  NOT NULL,
	`id_empresa` INTEGER  NOT NULL,
	`id_tabla` INTEGER  NOT NULL,
	`titulo` VARCHAR(255),
	`descripcion` TEXT,
	`ver_todos_registros` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id_alcance`,`id_usuario`),
	INDEX `FI_empresa_alcance` (`id_empresa`),
	CONSTRAINT `fk_empresa_alcance`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`),
	INDEX `FI_tabla_alcance` (`id_tabla`),
	CONSTRAINT `fk_tabla_alcance`
		FOREIGN KEY (`id_tabla`)
		REFERENCES `tabla` (`id_tabla`),
	INDEX `FI_usuario_alcance` (`id_usuario`),
	CONSTRAINT `fk_usuario_alcance`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- sesion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sesion`;


CREATE TABLE `sesion`
(
	`id_sesion` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_usuario` INTEGER(15)  NOT NULL,
	`sesion` VARCHAR(50),
	`IP` VARCHAR(15),
	PRIMARY KEY (`id_sesion`),
	INDEX `FI_itasDeUsuarios` (`id_usuario`),
	CONSTRAINT `VisitasDeUsuarios`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- mensaje
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mensaje`;


CREATE TABLE `mensaje`
(
	`id_mensaje` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_usuario` INTEGER  NOT NULL,
	`asunto` VARCHAR(255),
	`cuerpo` TEXT,
	`fecha` DATETIME,
	`email` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`borrado` TINYINT,
	PRIMARY KEY (`id_mensaje`),
	INDEX `FI_usuario_mensaje` (`id_usuario`),
	CONSTRAINT `fk_usuario_mensaje`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- mensaje_destino
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mensaje_destino`;


CREATE TABLE `mensaje_destino`
(
	`id_mensaje` INTEGER  NOT NULL,
	`id_usuario` INTEGER  NOT NULL,
	`leido` TINYINT,
	`borrado` TINYINT,
	PRIMARY KEY (`id_mensaje`,`id_usuario`),
	CONSTRAINT `fk_mensaje_destino_mensaje`
		FOREIGN KEY (`id_mensaje`)
		REFERENCES `mensaje` (`id_mensaje`),
	INDEX `FI_usuario_mensaje_destino` (`id_usuario`),
	CONSTRAINT `fk_usuario_mensaje_destino`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- parametro
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `parametro`;


CREATE TABLE `parametro`
(
	`id_parametro` INTEGER  NOT NULL AUTO_INCREMENT,
	`tipoParametro` VARCHAR(100)  NOT NULL,
	`nombre` VARCHAR(100),
	`orden` INTEGER,
	`numero` FLOAT,
	`numero2` FLOAT,
	`cadena` TEXT,
	`cadena1` TEXT,
	`otroObjeto` INTEGER,
	`si_no` TINYINT,
	`fecha` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`fechaBorrado` DATETIME,
	`nombreFichero` VARCHAR(200),
	`tipo` VARCHAR(100),
	`fichero` TEXT,
	`tamano` INTEGER,
	PRIMARY KEY (`id_parametro`),
	INDEX `FI_parametro_definicion_parametro` (`tipoParametro`),
	CONSTRAINT `fk_parametro_definicion_parametro`
		FOREIGN KEY (`tipoParametro`)
		REFERENCES `parametro_def` (`tipoParametro`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- parametro_def
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `parametro_def`;


CREATE TABLE `parametro_def`
(
	`tipoParametro` VARCHAR(100)  NOT NULL,
	`nombre` VARCHAR(100),
	`descripcion` TEXT,
	`esLista` TINYINT,
	`camposLista` TEXT,
	`campoNombre` VARCHAR(150),
	`campoNumero` VARCHAR(150),
	`campoNumero2` VARCHAR(150),
	`campoCadena` TEXT,
	`campoCadena1` VARCHAR(150),
	`campoCadenaMultiIdioma` VARCHAR(150),
	`campoOtroObjeto` TEXT,
	`campoSiNo` VARCHAR(150),
	`campoFecha` VARCHAR(150),
	`campoFichero` VARCHAR(150),
	`esEditable` TINYINT default 1,
	`esBorrable` TINYINT default 1,
	PRIMARY KEY (`tipoParametro`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- empresa
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `empresa`;


CREATE TABLE `empresa`
(
	`id_empresa` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_provincia` INTEGER  NOT NULL,
	`id_usuario` INTEGER  NOT NULL,
	`nombre` VARCHAR(150),
	`id_actividad` VARCHAR(3)  NOT NULL,
	`telefono` VARCHAR(20),
	`fax` VARCHAR(20),
	`email` VARCHAR(50),
	`domicilio` TEXT,
	`poblacion` VARCHAR(255),
	`codigo_postal` VARCHAR(10),
	`cif` VARCHAR(45),
	`logo_min` VARCHAR(150),
	`logo_med` VARCHAR(150),
	`logo_max` VARCHAR(150),
	`id_vtiger` INTEGER,
	`smtp_server` VARCHAR(150),
	`smtp_user` VARCHAR(150),
	`smtp_password` VARCHAR(255),
	`smtp_port` INTEGER,
	`sender_address` VARCHAR(150),
	`sender_name` VARCHAR(100),
	`color1` VARCHAR(10),
	`color2` VARCHAR(10),
	`color3` VARCHAR(10),
	`color4` VARCHAR(10),
	`color_letra1` VARCHAR(10),
	`color_letra2` VARCHAR(10),
	`color_letra3` VARCHAR(10),
	`color_letra4` VARCHAR(10),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`borrado` TINYINT,
	PRIMARY KEY (`id_empresa`),
	INDEX `FI_empresa_provincia` (`id_provincia`),
	CONSTRAINT `fk_empresa_provincia`
		FOREIGN KEY (`id_provincia`)
		REFERENCES `provincia` (`id_provincia`),
	INDEX `FI_usuario_empresa` (`id_usuario`),
	CONSTRAINT `fk_usuario_empresa`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`),
	INDEX `FI_empresa_actividad` (`id_actividad`),
	CONSTRAINT `fk_empresa_actividad`
		FOREIGN KEY (`id_actividad`)
		REFERENCES `taula1` (`t1id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- tabla
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tabla`;


CREATE TABLE `tabla`
(
	`id_tabla` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_usuario` INTEGER  NOT NULL,
	`id_empresa` INTEGER  NOT NULL,
	`nombre` VARCHAR(255)  NOT NULL,
	`imagen` VARCHAR(255),
	`mostrar_en_lista` TINYINT default 1,
	`orden` INTEGER(11),
	`es_ficheros` TINYINT,
	`id_categoria` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`borrado` TINYINT,
	PRIMARY KEY (`id_tabla`),
	INDEX `FI_tabla_empresa` (`id_empresa`),
	CONSTRAINT `fk_tabla_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`),
	INDEX `FI_usuario_tabla` (`id_usuario`),
	CONSTRAINT `fk_usuario_tabla`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`),
	INDEX `FI_categoria_parametro` (`id_categoria`),
	CONSTRAINT `fk_categoria_parametro`
		FOREIGN KEY (`id_categoria`)
		REFERENCES `parametro` (`id_parametro`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- campo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `campo`;


CREATE TABLE `campo`
(
	`id_campo` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_empresa` INTEGER  NOT NULL,
	`es_general` TINYINT,
	`es_nombre` TINYINT,
	`nombre` VARCHAR(150),
	`descripcion` TEXT,
	`tipo` INTEGER,
	`misma_fila` TINYINT,
	`en_lista` TINYINT,
	`desplegable` TINYINT,
	`seleccion_multiple` TINYINT,
	`tipo_items` INTEGER,
	`unidad_rangos` VARCHAR(10),
	`tipo_periodo` INTEGER,
	`valor_tabla` INTEGER,
	`mostrar_en_padre` TINYINT,
	`valor_objeto` VARCHAR(250),
	`defecto` VARCHAR(250),
	`obligatorio` TINYINT,
	`es_cod_agencia` TINYINT,
	`tamano` VARCHAR(250),
	`orden` INTEGER,
	`es_inconsistente` TINYINT,
	`borrado` TINYINT,
	PRIMARY KEY (`id_campo`),
	INDEX `FI_campo_empresa` (`id_empresa`),
	CONSTRAINT `fk_campo_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- rel_campo_tabla
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rel_campo_tabla`;


CREATE TABLE `rel_campo_tabla`
(
	`id_campo` INTEGER  NOT NULL,
	`id_tabla` INTEGER  NOT NULL,
	PRIMARY KEY (`id_campo`,`id_tabla`),
	CONSTRAINT `fk_campo_rel_campo_tabla`
		FOREIGN KEY (`id_campo`)
		REFERENCES `campo` (`id_campo`),
	INDEX `FI_tabla_rel_campo_tabla` (`id_tabla`),
	CONSTRAINT `fk_tabla_rel_campo_tabla`
		FOREIGN KEY (`id_tabla`)
		REFERENCES `tabla` (`id_tabla`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- provincia
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `provincia`;


CREATE TABLE `provincia`
(
	`id_provincia` INTEGER  NOT NULL AUTO_INCREMENT,
	`pais` VARCHAR(2),
	`nombre` VARCHAR(45),
	PRIMARY KEY (`id_provincia`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- item_base
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item_base`;


CREATE TABLE `item_base`
(
	`id_item_base` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_campo` INTEGER  NOT NULL,
	`texto` VARCHAR(150),
	`numero_inferior` FLOAT,
	`numero_superior` FLOAT,
	`ayuda` TEXT,
	`texto_auxiliar` TINYINT,
	`orden` INTEGER,
	`es_responsable_fichero` TINYINT,
	`es_inconsistente` TINYINT,
	`borrado` TINYINT,
	PRIMARY KEY (`id_item_base`),
	INDEX `FI_campo_item` (`id_campo`),
	CONSTRAINT `fk_campo_item`
		FOREIGN KEY (`id_campo`)
		REFERENCES `campo` (`id_campo`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;


CREATE TABLE `item`
(
	`id_item` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_formulario` INTEGER  NOT NULL,
	`id_item_base` INTEGER  NOT NULL,
	`texto_corto` VARCHAR(255),
	`texto_largo` TEXT,
	`si_no` TINYINT,
	`texto_auxiliar` VARCHAR(255),
	`fecha` DATETIME,
	`numero` INTEGER,
	`id_tabla` INTEGER,
	`id_objeto` INTEGER,
	`anio` INTEGER,
	PRIMARY KEY (`id_item`,`id_formulario`),
	INDEX `FI_item_base_item` (`id_item_base`),
	CONSTRAINT `fk_item_base_item`
		FOREIGN KEY (`id_item_base`)
		REFERENCES `item_base` (`id_item_base`),
	INDEX `FI_item_formulario` (`id_formulario`),
	CONSTRAINT `fk_item_formulario`
		FOREIGN KEY (`id_formulario`)
		REFERENCES `formulario` (`id_formulario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- formulario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `formulario`;


CREATE TABLE `formulario`
(
	`id_formulario` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_tabla` INTEGER  NOT NULL,
	`id_usuario_creador` INTEGER  NOT NULL,
	`id_usuario` INTEGER  NOT NULL,
	`fecha` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id_formulario`),
	INDEX `FI_tabla_formulario` (`id_tabla`),
	CONSTRAINT `fk_tabla_formulario`
		FOREIGN KEY (`id_tabla`)
		REFERENCES `tabla` (`id_tabla`),
	INDEX `FI_usuario_formulario` (`id_usuario`),
	CONSTRAINT `fk_usuario_formulario`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`),
	INDEX `FI_usuario_creador_formulario` (`id_usuario_creador`),
	CONSTRAINT `fk_usuario_creador_formulario`
		FOREIGN KEY (`id_usuario_creador`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- notificaciones
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notificaciones`;


CREATE TABLE `notificaciones`
(
	`notid` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`soporte` VARCHAR(1)  NOT NULL,
	`tipo` VARCHAR(1)  NOT NULL,
	`tipo_noti` INTEGER(1),
	`id_fichero` INTEGER(11)  NOT NULL,
	`fecha` VARCHAR(8)  NOT NULL,
	`hora_proceso` VARCHAR(6)  NOT NULL,
	`procesado` INTEGER(4) default 0,
	`hay_que_parar` INTEGER(4) default 0,
	`modelo` VARCHAR(1)  NOT NULL,
	`titularidad` VARCHAR(1)  NOT NULL,
	`presentacion` VARCHAR(1)  NOT NULL,
	`forma` VARCHAR(1)  NOT NULL,
	`id_upload` VARCHAR(22)  NOT NULL,
	`pf_razon_s` VARCHAR(140)  NOT NULL,
	`pf_cif_nif` VARCHAR(9)  NOT NULL,
	`pf_nombre` VARCHAR(35)  NOT NULL,
	`pf_apellido1` VARCHAR(35)  NOT NULL,
	`pf_apellido2` VARCHAR(35)  NOT NULL,
	`pf_nif` VARCHAR(9),
	`pf_cargo` VARCHAR(70)  NOT NULL,
	`dec_razon_s` VARCHAR(70)  NOT NULL,
	`dec_direccion` VARCHAR(100)  NOT NULL,
	`dec_localidad` VARCHAR(50)  NOT NULL,
	`dec_cp` VARCHAR(5),
	`dec_provincia` VARCHAR(2),
	`dec_pais` VARCHAR(2)  NOT NULL,
	`dec_tel` VARCHAR(10),
	`dec_fax` VARCHAR(10),
	`dec_mail` VARCHAR(70),
	`dec_forma` INTEGER(1)  NOT NULL,
	`rf_nombre` VARCHAR(140),
	`rf_actividad` VARCHAR(3),
	`rf_cif` VARCHAR(9)  NOT NULL,
	`rf_domicilio` VARCHAR(100)  NOT NULL,
	`rf_localidad` VARCHAR(50)  NOT NULL,
	`rf_cp` VARCHAR(5),
	`rf_provincia` VARCHAR(2),
	`rf_pais` VARCHAR(2)  NOT NULL,
	`rf_tel` VARCHAR(10),
	`rf_fax` VARCHAR(10),
	`rf_mail` VARCHAR(70),
	`dr_nombreof` VARCHAR(70),
	`dr_cif` VARCHAR(9),
	`dr_dirpostal` VARCHAR(100),
	`dr_localidad` VARCHAR(50),
	`dr_cp` VARCHAR(5),
	`dr_provincia` VARCHAR(2)  NOT NULL,
	`dr_pais` VARCHAR(2),
	`dr_tel` VARCHAR(10),
	`dr_fax` VARCHAR(10),
	`dr_mail` VARCHAR(70),
	`tipo_solicitud` INTEGER(1)  NOT NULL,
	`ac_mod_responsable` INTEGER(1),
	`ac_mod_cif_nif_ant` VARCHAR(9),
	`ac_mod_servicio_unidad` INTEGER(1),
	`ac_mod_disposicion` INTEGER(1),
	`ac_mod_iden_finalid` INTEGER(1),
	`ac_mod_encargado` INTEGER(1),
	`ac_mod_estruct_sistema` INTEGER(1),
	`ac_mod_medidas_seg` INTEGER(1),
	`ac_mod_origen` INTEGER(1),
	`ac_mod_trans_inter` INTEGER(1),
	`ac_mod_comunic_ces` INTEGER(1),
	`ac_supr_motivos` VARCHAR(140),
	`ac_supr_destino_previsiones` VARCHAR(210),
	`ac_supr_cifnif` VARCHAR(9),
	`et_nombre` VARCHAR(140),
	`et_cif` VARCHAR(9),
	`et_dirpostal` VARCHAR(100),
	`et_localidad` VARCHAR(50),
	`et_cp` VARCHAR(5),
	`et_provincia` VARCHAR(2),
	`et_pais` VARCHAR(2),
	`et_tel` VARCHAR(10),
	`et_fax` VARCHAR(10),
	`et_mail` VARCHAR(70),
	`idn_nombre` VARCHAR(70),
	`idn_descripcion` TEXT,
	`idn_finalidades` VARCHAR(23),
	`indica_inte` INTEGER(1),
	`indica_otras` INTEGER(1),
	`indic_fap` INTEGER(1),
	`indic_rp` INTEGER(1),
	`indic_ep` INTEGER(1),
	`indic_ap` INTEGER(1),
	`op_colectivos` VARCHAR(17),
	`op_otroscol` VARCHAR(100),
	`ind_ide` INTEGER(1),
	`ind_as` INTEGER(1),
	`ind_r` INTEGER(1),
	`ind_c` INTEGER(1),
	`ind_re` INTEGER(1),
	`ind_sal` INTEGER(1),
	`ind_sexo` INTEGER(1),
	`ind_nif` INTEGER(1),
	`ind_ss` INTEGER(1),
	`ind_n_a` INTEGER(1),
	`ind_ts` INTEGER(1),
	`ind_dir` INTEGER(1),
	`ind_tel` INTEGER(1),
	`ind_huella` INTEGER(1),
	`ind_img` INTEGER(1),
	`ind_marcas` INTEGER(1),
	`ind_firma` INTEGER(1),
	`td_otrosprotegidos` VARCHAR(100),
	`td_otrostipificados` VARCHAR(17),
	`td_otrostiposdatos` VARCHAR(100),
	`td_tratamiento` VARCHAR(1),
	`seguridad` VARCHAR(1),
	`cd_destinatarios` VARCHAR(17),
	`cd_otrosdestinatarios` VARCHAR(100),
	`paises_destina` VARCHAR(14),
	`cat_destina` VARCHAR(11),
	`otro_pais_destina` TEXT,
	PRIMARY KEY (`notid`),
	INDEX `FI_fichero` (`id_fichero`),
	CONSTRAINT `fk_fichero`
		FOREIGN KEY (`id_fichero`)
		REFERENCES `formulario` (`id_formulario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- paises
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `paises`;


CREATE TABLE `paises`
(
	`pid` INTEGER  NOT NULL AUTO_INCREMENT,
	`pais` VARCHAR(80),
	PRIMARY KEY (`pid`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula1
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula1`;


CREATE TABLE `taula1`
(
	`t1id` VARCHAR(3)  NOT NULL,
	`actividad` TEXT,
	PRIMARY KEY (`t1id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula2
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula2`;


CREATE TABLE `taula2`
(
	`t2id` INTEGER  NOT NULL,
	`descripcion` TEXT,
	PRIMARY KEY (`t2id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula3
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula3`;


CREATE TABLE `taula3`
(
	`t3id` VARCHAR(3)  NOT NULL,
	`descripcion` TEXT,
	PRIMARY KEY (`t3id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula4
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula4`;


CREATE TABLE `taula4`
(
	`t4id` INTEGER  NOT NULL,
	`descripcion` TEXT,
	PRIMARY KEY (`t4id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula5
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula5`;


CREATE TABLE `taula5`
(
	`t5id` VARCHAR(5)  NOT NULL,
	`descripcion` TEXT,
	PRIMARY KEY (`t5id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- taula7
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `taula7`;


CREATE TABLE `taula7`
(
	`t7id` VARCHAR(5)  NOT NULL,
	`descripcion` TEXT,
	PRIMARY KEY (`t7id`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- tarea
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tarea`;


CREATE TABLE `tarea`
(
	`id_tarea` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_empresa` INTEGER  NOT NULL,
	`id_estado_tarea` INTEGER  NOT NULL,
	`id_usuario` INTEGER  NOT NULL,
	`avisar_email` TINYINT,
	`avisar_email_fin` TINYINT,
	`es_evento` TINYINT,
	`fecha_inicio` DATETIME,
	`fecha_vencimiento` DATETIME,
	`resumen` VARCHAR(255),
	`descripcion` TEXT,
	`id_campo` INTEGER,
	`id_formulario` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id_tarea`),
	INDEX `FI_tarea_formulario` (`id_formulario`),
	CONSTRAINT `fk_tarea_formulario`
		FOREIGN KEY (`id_formulario`)
		REFERENCES `formulario` (`id_formulario`),
	INDEX `FI_tarea_campo` (`id_campo`),
	CONSTRAINT `fk_tarea_campo`
		FOREIGN KEY (`id_campo`)
		REFERENCES `campo` (`id_campo`),
	INDEX `FI_tarea_usuario` (`id_usuario`),
	CONSTRAINT `fk_tarea_usuario`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`),
	INDEX `FI_tarea_parametro` (`id_estado_tarea`),
	CONSTRAINT `fk_tarea_parametro`
		FOREIGN KEY (`id_estado_tarea`)
		REFERENCES `parametro` (`id_parametro`),
	INDEX `FI_tarea_empresa` (`id_empresa`),
	CONSTRAINT `fk_tarea_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- documentos
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `documentos`;


CREATE TABLE `documentos`
(
	`id_documento` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_empresa` INTEGER,
	`nombre` VARCHAR(250),
	`id_item` INTEGER,
	PRIMARY KEY (`id_documento`),
	INDEX `FI_umento_empresa` (`id_empresa`),
	CONSTRAINT `documento_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`),
	INDEX `FI__item` (`id_item`),
	CONSTRAINT `rel_item`
		FOREIGN KEY (`id_item`)
		REFERENCES `item` (`id_item`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- historico_documentos
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `historico_documentos`;


CREATE TABLE `historico_documentos`
(
	`id_documento` INTEGER  NOT NULL,
	`version` VARCHAR(50)  NOT NULL,
	`id_empresa` INTEGER,
	`id_usuario` INTEGER,
	`nombre_fich` VARCHAR(250),
	`tamano` INTEGER,
	`fecha` DATETIME,
	`mime` VARCHAR(100),
	PRIMARY KEY (`id_documento`,`version`),
	INDEX `FI_t_documento_empresa` (`id_empresa`),
	CONSTRAINT `hist_documento_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`),
	CONSTRAINT `docu_docu`
		FOREIGN KEY (`id_documento`)
		REFERENCES `documentos` (`id_documento`),
	INDEX `FI_t_documento_usuario` (`id_usuario`),
	CONSTRAINT `hist_documento_usuario`
		FOREIGN KEY (`id_usuario`)
		REFERENCES `usuario` (`id_usuario`)
)Type=MyIsam;

#-----------------------------------------------------------------------------
#-- clientes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;


CREATE TABLE `clientes`
(
	`id_cliente` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_empresa` INTEGER,
	`nombre` TEXT,
	`razon_social` TEXT,
	`cif` VARCHAR(10),
	`contacto` TEXT,
	`telefono` VARCHAR(12),
	`fax` VARCHAR(12),
	`movil` VARCHAR(12),
	`domicilio` TEXT,
	`poblacion` VARCHAR(50),
	`codigo_postal` VARCHAR(9),
	`provincia` VARCHAR(150),
	PRIMARY KEY (`id_cliente`),
	INDEX `FI_entes_empresa` (`id_empresa`),
	CONSTRAINT `clientes_empresa`
		FOREIGN KEY (`id_empresa`)
		REFERENCES `empresa` (`id_empresa`)
)Type=MyIsam;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
