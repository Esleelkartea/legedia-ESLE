<?php use_helper('Date'); ?>
<script type="text/javascript"><!--
    function redi() {<?php if (isset($tipo)) { ?>jQuery('input.origen').each(function() { jQuery(this).readonly(true); });<?php } ?>
        jQuery('.mayus').blur(function() { jQuery(this).val(str_replace("Á", 'A', str_replace("É", 'E', str_replace("Í", 'I', str_replace("Ó", 'O', str_replace("Ú", 'U', str_replace("À", 'A', str_replace("È", 'E', str_replace("Ì", 'I', str_replace("Ò", 'O', str_replace("Ù", 'U', jQuery(this).val().toUpperCase()))))))))))); });<?php
        if ($hook == 'Inscripcion') { ?>
            if (!jQuery('#persona').is(':hidden')) {
                jQuery('#persona').find('.required').each(function() {
                    jQuery(this).removeClass('required');
                    jQuery(this).addClass('not_required');
                });
                jQuery('#persona').hide();
            }<?php
        } elseif ($hook == 'Modificacion') { ?>pais_change(jQuery('#pais0'));<?php } ?>
        funzion();
	jQuery('#chk_0').click(function() {
            if (jQuery(this).attr('checked')) {
                if (confirm("<?php echo __('De conformidad con lo establecido en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, solicito la inscripción en el Registro General de Protección de Datos del fichero de datos de carácter personal al que hace referencia el presente formulario de notificación.'); ?>\n<?php echo __('Asimismo, bajo mi responsabilidad minifiesto que dispongo de representación suficiente para solicitar la inscripción de este fichero en nombre del responsable del fichero y que éste está informado del resto de obligaciones que se derivan de la OLPD.'); ?>\n<?php echo __('Igualmente, declaro que todos los datos consignados son ciertos y que el responsable del fichero ha sido informado de los supuestos legales que habilitan el tratamiento de datos especialmente protegidos, así como la cesión y la transferencia internacional de datos.'); ?>\n<?php echo __('La Agencia Española de Protección de Datos podrá requerir que se acredite la representación de la persona que formula la presente notificación.'); ?>")) {
                    jQuery('#data_01').val("<?php echo date('d'); ?>");
                    jQuery('#data_02').val("<?php echo ucfirst(trim(str_replace(date('d'), '', format_date(date('M'), 'm', 'es')))); ?>");
                    jQuery('#data_03').val("<?php echo date('Y'); ?>");
                } else  jQuery(this).removeAttr('checked');
            } else {
                jQuery('#data_01').val('');
                jQuery('#data_02').val('');
                jQuery('#data_03').val('');
            }
        });
	jQuery('select.prov').each(function() {
            if (jQuery(this).val() !== '0') {
                var pais_elem_id = str_replace('provincia_', '', jQuery(this).attr('id'));
                jQuery('#' + pais_elem_id).val('55');
            }
	});
	jQuery('input.otros').each(function() {
            if (jQuery(jQuery(this).attr('id') + ':checked').val() === null)    jQuery('#text_' + jQuery(this).attr('id')).hide();
            jQuery(this).click(function() { jQuery('#text_' + jQuery(this).attr('id')).toggle('fast'); });
	});
        if (jQuery('#otros').attr('checked') === false)     jQuery('#text_otros').hide();
        if (jQuery('#otros2').attr('checked') === false)    jQuery('#text_otros2').readonly(true);
        jQuery('#otros2').click(function() {
            if (jQuery('#otros2:checked').val() !== null)       jQuery('#text_otros2').readonly(false);
            if (jQuery('#otros2').attr('checked') === false)    jQuery('#text_otros2').readonly(true);
        });
        if (jQuery('#otros3').attr('checked') === false)    jQuery('#text_otros3').hide();
        if (jQuery('#otros4').attr('checked') === false)    jQuery('#text_otros4').hide();
	jQuery('select.next').each(function() {
            if (jQuery(this).val() !== '0')     jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).readonly(false);
            else if (jQuery(this).val() == '0') {
                jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).val('');
                jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).readonly(true);
            }
	});
        if (jQuery('#otros5').val() == '0') jQuery('#text_otros5').readonly(true);
        jQuery('#otros5').change(function() {
            if (jQuery(this).val() !== '0')     jQuery('#text_otros5').readonly(false);
            else if (jQuery(this).val() == '0') {
                jQuery('#text_otros5').val('');
                jQuery('#text_otros5').readonly(true);
            }
        });
        jQuery('#add_finalidades').click(function() {
            jQuery('#finalidades1 option:selected').remove().appendTo('#finalidades2');
            return !jQuery('#finalidades2 option').removeAttr('selected');
        });
        jQuery('#remove_finalidades').click(function() {
            jQuery('#finalidades2 option:selected').remove().appendTo('#finalidades1');
            return !jQuery('#finalidades1 option').removeAttr('selected');
        });
        jQuery('#add_colectivos').click(function() {
            jQuery('#colectivos1 option:selected').remove().appendTo('#colectivos2');
            return !jQuery('#colectivos2 option').removeAttr('selected');
        });
        jQuery('#remove_colectivos').click(function() {
            jQuery('#colectivos2 option:selected').remove().appendTo('#colectivos1');
            return !jQuery('#colectivos1 option').removeAttr('selected');
        });
        jQuery('#add_datos').click(function() {
            jQuery('#datos1 option:selected').remove().appendTo('#datos2');
            return !jQuery('#datos2 option').removeAttr('selected');
        });
        jQuery('#remove_datos').click(function() {
            jQuery('#datos2 option:selected').remove().appendTo('#datos1');
            return !jQuery('#datos1 option').removeAttr('selected');
        });
        jQuery('#add_medidas').click(function() {
            jQuery('#medidas1 option:selected').remove().appendTo('#medidas2');
            return !jQuery('#medidas2 option').removeAttr('selected');
        });
        jQuery('#remove_medidas').click(function() {
            jQuery('#medidas2 option:selected').remove().appendTo('#medidas1');
            return !jQuery('#medidas1 option').removeAttr('selected');
        });
        jQuery('input.cif').blur(function() { if (!valida_nif_cif_nie(jQuery(this).attr('id')))   focus_me(jQuery(this).attr('id')); });
        jQuery('input.cp').blur(function() {
            var value = trim(jQuery(this).val());
            var pais_elem_id = str_replace('cp_', '', jQuery(this).attr('id'));
            var prov_id = value.substring(0, 2);
            var PostalCodeInit = new Array();
            PostalCodeInit[0] = '01'; //Primeros digitos del codigo postal de Álava
            PostalCodeInit[1] = '02'; //Primeros digitos del codigo postal de Albacete
            PostalCodeInit[2] = '03'; //Primeros digitos del codigo postal de Alicante
            PostalCodeInit[3] = '04'; //Primeros digitos del codigo postal de Almería
            PostalCodeInit[4] = '33'; //Primeros digitos del codigo postal de Asturias
            PostalCodeInit[5] = '05'; //Primeros digitos del codigo postal de Ávila
            PostalCodeInit[6] = '06'; //Primeros digitos del codigo postal de Badajoz
            PostalCodeInit[7] = '08'; //Primeros digitos del codigo postal de Barcelona
            PostalCodeInit[8] = '09'; //Primeros digitos del codigo postal de Burgos
            PostalCodeInit[9] = '10'; //Primeros digitos del codigo postal de Cáceres
            PostalCodeInit[10] = '11'; //Primeros digitos del codigo postal de Cádiz
            PostalCodeInit[11] = '39'; //Primeros digitos del codigo postal de Cantabria
            PostalCodeInit[12] = '12'; //Primeros digitos del codigo postal de Castellón de la Plana
            PostalCodeInit[13] = '51'; //Primeros digitos del codigo postal de Ceuta
            PostalCodeInit[14] = '13'; //Primeros digitos del codigo postal de Ciudad Real
            PostalCodeInit[15] = '14'; //Primeros digitos del codigo postal de Córdoba
            PostalCodeInit[16] = '15'; //Primeros digitos del codigo postal de Coruña, A
            PostalCodeInit[17] = '16'; //Primeros digitos del codigo postal de Cuenca
            PostalCodeInit[18] = '17'; //Primeros digitos del codigo postal de Girona
            PostalCodeInit[19] = '18'; //Primeros digitos del codigo postal de Granada
            PostalCodeInit[20] = '19'; //Primeros digitos del codigo postal de Guadalajara
            PostalCodeInit[21] = '20'; //Primeros digitos del codigo postal de Guipúzcoa
            PostalCodeInit[22] = '21'; //Primeros digitos del codigo postal de Huelva
            PostalCodeInit[23] = '22'; //Primeros digitos del codigo postal de Huesca
            PostalCodeInit[24] = '07'; //Primeros digitos del codigo postal de Illes Balears
            PostalCodeInit[25] = '23'; //Primeros digitos del codigo postal de Jaén
            PostalCodeInit[26] = '24'; //Primeros digitos del codigo postal de León
            PostalCodeInit[27] = '25'; //Primeros digitos del codigo postal de Lleida
            PostalCodeInit[28] = '27'; //Primeros digitos del codigo postal de Lugo
            PostalCodeInit[29] = '28'; //Primeros digitos del codigo postal de Madrid
            PostalCodeInit[30] = '29'; //Primeros digitos del codigo postal de Málaga
            PostalCodeInit[31] = '52'; //Primeros digitos del codigo postal de Melilla
            PostalCodeInit[32] = '30'; //Primeros digitos del codigo postal de Murcia
            PostalCodeInit[33] = '31'; //Primeros digitos del codigo postal de Navarra
            PostalCodeInit[34] = '32'; //Primeros digitos del codigo postal de Ourense
            PostalCodeInit[35] = '34'; //Primeros digitos del codigo postal de Palencia
            PostalCodeInit[36] = '35'; //Primeros digitos del codigo postal de Palmas, Las
            PostalCodeInit[37] = '36'; //Primeros digitos del codigo postal de Pontevedra
            PostalCodeInit[38] = '26'; //Primeros digitos del codigo postal de Rioja, La
            PostalCodeInit[39] = '37'; //Primeros digitos del codigo postal de Salamanca
            PostalCodeInit[40] = '38'; //Primeros digitos del codigo postal de Santa Cruz de Tenerife
            PostalCodeInit[41] = '40'; //Primeros digitos del codigo postal de Segovia
            PostalCodeInit[42] = '41'; //Primeros digitos del codigo postal de Sevilla
            PostalCodeInit[43] = '42'; //Primeros digitos del codigo postal de Soria
            PostalCodeInit[44] = '43'; //Primeros digitos del codigo postal de Tarragona
            PostalCodeInit[45] = '44'; //Primeros digitos del codigo postal de Teruel
            PostalCodeInit[46] = '45'; //Primeros digitos del codigo postal de Toledo
            PostalCodeInit[47] = '46'; //Primeros digitos del codigo postal de Valencia
            PostalCodeInit[48] = '47'; //Primeros digitos del codigo postal de Valladolid
            PostalCodeInit[49] = '48'; //Primeros digitos del codigo postal de Vizcaya
            PostalCodeInit[50] = '49'; //Primeros digitos del codigo postal de Zamora
            PostalCodeInit[51] = '50'; //Primeros digitos del codigo postal de Zaragoza
            if (value.length != 5 || !isUnsignedInteger(value)) alert(Messages('cp1'));
            else if ((jQuery('#' + pais_elem_id).val() == '55' || jQuery('#' + pais_elem_id).val() == '0') && !array_search(prov_id, PostalCodeInit))   alert(Messages('cp2'));
            else {
                var prov_elem_id = str_replace('cp', 'provincia', jQuery(this).attr('id'));
                jQuery('#' + prov_elem_id).val(prov_id);
                if (jQuery('#' + prov_elem_id).val() !== '0')   jQuery('#' + pais_elem_id).val('55');
            }
        });
        jQuery('select.prov').change(function() {
            if (jQuery(this).val() !== '0') {
                var pais_elem_id =  str_replace('provincia_', '', jQuery(this).attr('id'));
                jQuery('#' + pais_elem_id).val('55');
            }
        });
        jQuery('select.pais').change(function() { pais_change(jQuery(this)); });
	jQuery('select.next').change(function() {
            if (jQuery(this).val() !== '0')     jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).readonly(false);
            else if (jQuery(this).val() == '0') {
                jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).val('');
                jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).readonly(true);
            }
	});
        jQuery('#sf_notis_form').submit(function() {
            jQuery('.mayus').each(function() { jQuery(this).val(str_replace("Á", 'A', str_replace("É", 'E', str_replace("Í", 'I', str_replace("Ó", 'O', str_replace("Ú", 'U', str_replace("À", 'A', str_replace("È", 'E', str_replace("Ì", 'I', str_replace("Ò", 'O', str_replace("Ù", 'U', jQuery(this).val().toUpperCase()))))))))))); });
            funzion();
            var not_required = true;
            jQuery('#derechos').find('input, select').each(function() {
                var v = trim(jQuery(this).val());
                var id = jQuery(this).attr('id');
                var v1 = jQuery('#pais1').val();
                if (id == 'txt2' && v !== '')    not_required = false;
                else if (id == 'cif_pais2' && v !== '')     not_required = false;
                else if (id == 'domicilio2' && v !== '')    not_required = false;
                else if (id == 'localidad2' && v !== '')    not_required = false;
                else if (id == 'cp_pais2' && v !== '')    not_required = false;
                else if (id == 'provincia_pais2' && v !== '0')    not_required = false;
                else if (v1 !== '0' && v1 !== '3' && v1 !== '12' && v1 !== '19' && v1 !== '28' && v1 !== '38' && v1 !== '46' && v1 !== '157' && v1 !== '54' && v1 !== '55' && v1 !== '57' && v1 !== '62' && v1 !== '63' && v1 !== '69' && v1 !== '80' && v1 !== '85' && v1 !== '92' && v1 !== '102' && v1 !== '107' && v1 !== '108' && v1 !== '115' && v1 !== '136' && v1 !== '143' && v1 !== '144' && v1 !== '147' && v1 !== '149' && v1 !== '158' && v1 !== '176')    not_required = false;
                else if (id == 'pais2' && v !== '0' && v !== '55')    not_required = false;
                else if (id == 'tel2' && v !== '')   not_required = false;
                else if (id == 'fax2' && v !== '')   not_required = false;
                else if (id == 'mail2' && v !== '')  not_required = false;
            });
            if (!not_required) {
                jQuery('#derechos').find('input, select').each(function() {
                    if (jQuery(this).attr('id') == 'tel2' || jQuery(this).attr('id') == 'fax2' || jQuery(this).attr('id') == 'mail2') {
                        //jQuery(this).removeClass('required');
                        jQuery(this).removeClass('not_required_unless_one_filled');
                        jQuery(this).addClass('not_required');
                    } else if (!jQuery(this).is(':hidden')) {
                        //jQuery(this).removeClass('not_required');
                        jQuery(this).removeClass('not_required_unless_one_filled');
                        jQuery(this).addClass('required');
                    }
                });
            }
            var not_required2 = true;
            jQuery('#encargado').find('input, select').each(function() {
                var v = trim(jQuery(this).val());
                var id = jQuery(this).attr('id');
                if (id == 'txt4' && v !== '')   not_required2 = false;
                else if (id == 'cif_pais4' && v !== '')     not_required2 = false;
                else if (id == 'domicilio4' && v !== '')    not_required2 = false;
                else if (id == 'localidad4' && v !== '')    not_required2 = false;
                else if (id == 'cp_pais4' && v !== '')  not_required2 = false;
                else if (id == 'provincia_pais4' && v !== '0')    not_required2 = false;
                else if (id == 'pais4' && v !== '0' && v !== '3' && v !== '12' && v !== '19' && v !== '28' && v !== '38' && v !== '46' && v !== '157' && v !== '54' && v !== '55' && v !== '57' && v !== '62' && v !== '63' && v !== '69' && v !== '80' && v !== '85' && v !== '92' && v !== '102' && v !== '107' && v !== '108' && v !== '115' && v !== '136' && v !== '143' && v !== '144' && v !== '147' && v !== '149' && v !== '158' && v !== '176') {
                    jQuery('select.next').each(function() { jQuery(this).addClass('required_at_least_one'); });
                    not_required2 = false;
                }
                else if (id == 'pais4' && v !== '0')    not_required2 = false;
                else if (id == 'tel4' && v !== '')      not_required2 = false;
                else if (id == 'fax4' && v !== '')      not_required2 = false;
                else if (id == 'mail4' && v !== '')     not_required2 = false;
            });
            if (!not_required2) {
                jQuery('#encargado').find('input, select').each(function() {
                    if (jQuery(this).attr('id') == 'tel4' || jQuery(this).attr('id') == 'fax4' || jQuery(this).attr('id') == 'mail4') {
                        //jQuery(this).removeClass('required');
                        jQuery(this).removeClass('not_required_unless_one_filled_2');
                        jQuery(this).addClass('not_required');
                    } else if (!jQuery(this).is(':hidden')) {
                        //jQuery(this).removeClass('not_required');
                        jQuery(this).removeClass('not_required_unless_one_filled_2');
                        jQuery(this).addClass('required');
                    }
                });
            }
            if (trim(jQuery('#txt05').val()) == '' && jQuery('#pais0').val() != '55')   jQuery('#txt05').val('-');
            var resul = true;<?php
            if ($hook == 'Inscripcion' || $hook == 'Modificacion') { ?>
                if (jQuery('select.required_at_least_one').length > 0) {
                    var not_required3 = true;
                    var empty = 4;
                    var incomplete = 4;
                    jQuery('select.required_at_least_one').each(function() {
                        var this_id = jQuery(this).attr('id');
                        var this_value = jQuery(this).val();
                        var pais_field_id = str_replace('pais_10_', '', this_id);
                        if (this_value !== '0' && jQuery('#cat-destina_10_' + pais_field_id).val() !== '0') {
                            incomplete --;
                            empty --;
                        }
                        else if (this_value !== '0' && jQuery('#cat-destina_10_' + pais_field_id).val() == '0') empty --;
                        else if (this_value == '0' && jQuery('#cat-destina_10_' + pais_field_id).val() == '0')  incomplete --;
                    });
                    if (empty == 4 && jQuery('#otros5').val() == '0')   not_required3 = false;
                    else if (jQuery('#otros5').val() !== '0' && trim(jQuery('#text_otros5').val()) == '')   incomplete ++;
                    if (!not_required3) {
                        alert(Messages('cat_inter'));
                        resul = false;
                    }
                    else if (incomplete > 0) {
                        alert(Messages('cat_int_incomp'));
                        resul = false;
                    }
                } else {
                    jQuery('select.next').each(function() {
                        if (jQuery(this).val() !== '0' && jQuery('#cat-destina_10_' + str_replace('pais_10_', '', jQuery(this).attr('id'))).val() == '0')   resul = false;
                        else if (jQuery('#otros5').val() !== '0' && trim(jQuery('#text_otros5').val()) == '')   resul = false;
                        if (!resul) {
                            alert(Messages('cat_int_incomp'));
                            return resul;
                        }
                    });
                }
                if (!resul)     return resul;
                /////////////////////// Finalidades
                var id_f = 'finalidades2';
                var value_f = [];
                var items_f = 0;
                jQuery('#finalidades2').children('option:').each(function(i_f, choice_f) {
                    if (jQuery(choice_f) !== null) {
                        value_f[i_f] = jQuery(choice_f).val();
                        items_f ++;
                    }
                });
                var words_f = value_f.toString().split(',');
                if (items_f == 0 || items_f > 6) {
                    alert(Messages(id_f));
                    resul = false;
                }
                if (!cualquier_nivel()) {<?php
                    if (sfConfig::get('app_tipo_titularidad') == '2') { // Titularidad Privada (La Pública sería '1') ?>
                        for (i = 0; i < words_f.length; i ++) {
                            if ((words_f[i] == '404' || words_f[i] == '405' || words_f[i] == '406') && jQuery('input.nivel_seg:checked').val() == '22') {
                                alert(Messages('medidas1'));
                                id_f = 'nivel_seg';
                                resul = false;
                                return resul;
                            } else if (words_f[i] == '419' && jQuery('input.nivel_seg:checked').val() !== '24') {
                                alert(Messages('medidas2'));
                                id_f = 'nivel_seg';
                                resul = false;
                                return resul;
                            }
                        }<?php
                    } ?>
                }
                if (!resul) {
                    jQuery.scrollTo(id_f + '_div');
                    focus_me(id_f);
                    return resul;
                }
                /////////////////////// Colectivos
                var id_c = 'colectivos2';
                var value_c = [];
                var items_c = 0;
                jQuery('#colectivos2').children('option:').each(function(i_c, choice_c) {
                    if (jQuery(choice_c) !== null) {
                        value_c[i_c] = jQuery(choice_c).val();
                        items_c ++;
                    }
                });
                if ((items_c == 0 || items_c > 6) && trim(jQuery('#text_otros').val()) == '') {
                    alert(Messages(id_c));
                    resul = false;
                }
                if (!resul) {
                    jQuery.scrollTo(id_c + '_div');
                    focus_me(id_c);
                    return resul;
                }<?php
            } ?>
            var items_d = 0;
            jQuery('#datos2').children('option:').each(function(i_d, choice_d) { if (jQuery(choice_d) !== null)  items_d ++; });
            if (items_d > 6) {
                alert(Messages('datos2'));
                resul = false;
            }
            var items_m = 0;
            jQuery('#medidas2').children('option:').each(function(i_m, choice_m) { if (jQuery(choice_m) !== null)  items_m ++; });
            if (items_m > 6) {
                alert(Messages('cesion'));
                resul = false;
            }<?php
            if ($hook == 'Inscripcion' || $hook == 'Modificacion') { ?>
                var a = 0, b = 0;
                var sist_tratam_checked = false;
                var med_seg_checked = false;<?php
            } ?>
            jQuery('.required').each(function() {
                var id = jQuery(this).attr('id');
                var value = trim(jQuery(this).val());<?php
                if ($hook == 'Inscripcion' || $hook == 'Modificacion') { ?>
                    if (jQuery(this).hasClass('chk1') && jQuery('#' + jQuery(this).attr('id') + ':checked').val() !== null && a == 0)   a ++;
                    if (jQuery(this).hasClass('chk2') && jQuery('#' + jQuery(this).attr('id') + ':checked').val() !== null && b == 0)   b ++;
                    if (jQuery(this).hasClass('sist_tratam') && jQuery(this).attr('checked') === true && !sist_tratam_checked)  sist_tratam_checked = true;
                    if (jQuery(this).hasClass('med_seg') && jQuery(this).attr('checked') === true && !med_seg_checked)  med_seg_checked = true;<?php
                } ?>
                if (jQuery(this).hasClass('text') && (value == '')) {
                    alert(Messages(jQuery(this).attr('id')));
                    resul = false;
                } else if (jQuery(this).hasClass('list') && (value == '0')) {
                    alert(Messages(jQuery(this).attr('id')));
                    resul = false;
                } else if (jQuery(this).hasClass('cif') && (value == '')) {
                    alert(Messages('cif'));
                    resul = false;
                } else if (jQuery(this).hasClass('cif') && !valida_nif_cif_nie(jQuery(this).attr('id')))    resul = false;
                else if (jQuery(this).hasClass('chk0') && jQuery(this).attr('checked') === false && !jQuery('#persona').is(':hidden')) {
                //else if (jQuery('#chk_0:checked').val() !== null && !jQuery('#persona').is(':hidden')) {
                    alert(Messages('chk_0'));
                    resul = false;
                }
                if (!resul) {
                    jQuery.scrollTo(id + '_div');
                    focus_me(id);
                    return resul;
                }
            });
            if (resul && a == 0) {
                alert(Messages('chk1'));
                jQuery.scrollTo('origenes');
                resul = false;
            } else if (resul && b == 0 && trim(jQuery('#text_otros2').val()) == '') {
                alert(Messages('chk2'));
                jQuery.scrollTo('identificativos');
                resul = false;
            } else if (resul && jQuery('#otros').attr('checked') === true && trim(jQuery('#text_otros').val()) == '') {
                alert(Messages('otros'));
                jQuery.scrollTo('text_otros');
                resul = false;
            } else if (resul && jQuery('#otros2').attr('checked') === true && trim(jQuery('#text_otros2').val()) == '') {
                alert(Messages('otros2'));
                jQuery.scrollTo('text_otros2');
                resul = false;
            } else if (resul && jQuery('#otros3').attr('checked') === true && trim(jQuery('#text_otros3').val()) == '') {
                alert(Messages('otros3'));
                jQuery.scrollTo('text_otros3');
                resul = false;
            } else if (resul && !sist_tratam_checked) {
                alert(Messages('chk4'));
                jQuery.scrollTo('chk4');
                resul = false;
            } else if (resul && !med_seg_checked) {
                alert(Messages('chk5'));
                jQuery.scrollTo('chk5');
                resul = false;
            } else if (resul && jQuery('#otros4').attr('checked') === true && trim(jQuery('#text_otros4').val()) == '') {
                alert(Messages('otros4'));
                jQuery.scrollTo('text_otros4');
                resul = false;
            } else if (resul) {
                if (!cualquier_nivel()) {
                    jQuery('input.checkboxes:checked').each(function() {
                        if (isUnsignedInteger(jQuery(this).val()) && jQuery('input.nivel_seg:checked').val() !== '24') {
                            alert(Messages('medidas3'));
                            jQuery.scrollTo('nivel_seg_div');
                            focus_me('nivel_seg_div');
                            resul = false;
                            return resul;
                        }
                    });
                }
                jQuery('.not_required').each(function() {
                    var id = jQuery(this).attr('id');
                    var value = trim(jQuery(this).val());
                    if (jQuery(this).hasClass('tel') && (value !== '') && (!(/^\d{0,10}$/.test(value)))) {
                        alert(Messages('tel'));
                        resul = false;
                    } else if (jQuery(this).hasClass('fax') && (value !== '') && (!(/^\d{0,10}$/.test(value)))) {
                        alert(Messages('fax'));
                        resul = false;
                    } else if (jQuery(this).hasClass('mail') && (value !== '') && (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)))) {
                        alert(Messages('mail'));
                        resul = false;
                    }
                    if (!resul) {
                        jQuery.scrollTo(id + '_div');
                        focus_me(id);
                        return resul;
                    }
                });<?php
                if ($hook == 'Inscripcion') { ?>
                    if (resul && jQuery('#persona').is(':hidden')) {
                        jQuery('#persona').find('.not_required').each(function() {
                            jQuery(this).removeClass('not_required');
                            jQuery(this).addClass('required');
                        });
                        jQuery('#persona').show();
                        var same_height = 0;
                        jQuery('fieldset.same_height').each(function() {
                            if (jQuery(this).height() > same_height)    same_height = jQuery(this).height();
                            else    jQuery(this).height(same_height);
                        });
                        jQuery.scrollTo('persona');
                        jQuery('#txt00').readonly(true);
                        jQuery('#txt01').readonly(true);
                        jQuery('#txt02').readonly(true);
                        jQuery('#data_01').readonly(true);
                        jQuery('#data_02').readonly(true);
                        jQuery('#data_03').readonly(true);
                        jQuery('#boton').hide();
                        jQuery('input.pais').each(function() {
                            var div_id = jQuery(this).attr('id') + '_div';
                            jQuery('#cif_' + div_id).show();
                            jQuery('#cp_' + div_id).show();
                            jQuery('#provincia_' + div_id).show();
                        });
                        jQuery('#txt01').val(jQuery('#txt1').val());
                        jQuery('#txt02').val(jQuery('#cif_pais1').val());
                        jQuery('#finalidades0_div').hide();
                        jQuery('#finalidades1_div').hide();
                        jQuery('#colectivos0_div').hide();
                        jQuery('#colectivos1_div').hide();
                        jQuery('#datos0_div').hide();
                        jQuery('#datos1_div').hide();
                        jQuery('#medidas0_div').hide();
                        jQuery('#medidas1_div').hide();
                        jQuery('#cuerpo').find('input, textarea, select, radio, checkbox, submit, buttom, a').each(function() { jQuery(this).readonly(true); });
                        resul = false;
                    } else if (resul && !jQuery('#persona').is(':hidden') && trim(jQuery('#txt06').val()) !== '' && !valida_nif_cif_nie('txt06')) {
                        jQuery.scrollTo('txt06');
                        focus_me('txt06');
                        resul = false;
                    } else if (trim(jQuery('#tel0').val()) !== '' && !(/^\d{0,10}$/.test(jQuery('#tel0').val()))) {
                        alert(Messages('tel'));
                        jQuery.scrollTo('tel0_div');
                        focus_me('tel0_div');
                        resul = false;
                    } else if (trim(jQuery('#fax0').val()) !== '' && !(/^\d{0,10}$/.test(trim(jQuery('#fax0').val())))) {
                        alert(Messages('fax'));
                        jQuery.scrollTo('fax0_div');
                        focus_me('fax0_div');
                        resul = false;
                    } else if (trim(jQuery('#mail0').val()) !== '' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(trim(jQuery('#mail0').val())))) {
                        alert(Messages('mail'));
                        jQuery.scrollTo('mail0_div');
                        focus_me('mail0_div');
                        resul = false;
                    } else if (resul) {
                        jQuery('select.multiple_list').each(function() {
                            jQuery(this).each(function() { jQuery('#' + jQuery(this).attr('id') + ' option').attr('selected', 'selected'); });
                        });
                    }<?php
                } elseif ($hook == 'Modificacion') { ?>
                    if (resul) {
                        jQuery('select.multiple_list').each(function() {
                            jQuery(this).each(function() { jQuery('#' + jQuery(this).attr('id') + ' option').attr('selected', 'selected'); });
                        });
                    }<?php
                } ?>
                return resul;
            }
            return resul;
        });
    }
    function Messages(theId) {
        if (theId == 'txt03')           return "<?php echo __('Rellena el campo \"Nombre\" del declarante'); ?>";
        if (theId == 'txt04')           return "<?php echo __('Rellena el campo \"Primer Apellido\" del declarante'); ?>";
        if (theId == 'txt05')           return "<?php echo __('Rellena el campo \"Segundo Apellido\" del declarante'); ?>";
        if (theId == 'txt07')           return "<?php echo __('Rellena el campo \"Cargo\" del declarante'); ?>";
        if (theId == 'txt08')           return "<?php echo __('Rellena el campo \"Apellidos y Nombre o Razon social\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'domicilio0')      return "<?php echo __('Rellena el campo \"Dirección Postal\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'localidad0')      return "<?php echo __('Rellena el campo \"Localidad\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'cp_pais0')        return "<?php echo __('Rellena el campo \"Código Postal\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'provincia_pais0') return "<?php echo __('Rellena el campo \"Provincia\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'pais0')           return "<?php echo __('Rellena el campo \"País\" de la dirección a efectos de la notificación'); ?>";
        if (theId == 'chk_0')           return "<?php echo __('Señala la casilla correspondiente al conocimiento de los deberes del declarante'); ?>";
        if (theId == 'data_00')         return "<?php echo __('Rellena la localidad correspondiente a la firma'); ?>";
        if (theId == 'txt1')            return "<?php echo __('Rellena el campo \"Denominación social del responsable del fichero\"'); ?>";
        if (theId == 'list1')           return "<?php echo __('Selecciona una \"Actividad\"'); ?>";
        if (theId == 'cif')             return "<?php echo __('Rellena el campo \"CIF/NIF/NIE\"'); ?>";
        if (theId == 'tel')             return "<?php echo __('El campo \"Teléfono\" no es válido'); ?>";
        if (theId == 'fax')             return "<?php echo __('El campo \"Fax\" no es válido'); ?>";
        if (theId == 'mail')            return "<?php echo __('El campo \"Correo electrónico\" no es válido'); ?>";
        if (theId == 'domicilio1')      return "<?php echo __('Rellena el campo \"Domicilio social\"'); ?>";
        if (theId == 'localidad1' || theId == 'localidad2' || theId == 'localidad4')
                                        return "<?php echo __('Rellena el campo \"Localidad\"'); ?>";
        if (theId == 'cp1')             return "<?php echo __('El campo \"Código Postal\" consta de 5 dígitos'); ?>";
        if (theId == 'cp2')             return "<?php echo __('El campo \"Código Postal\" es incorrecto'); ?>";
        if (theId == 'cp_pais1' || theId == 'cp_pais2' || theId == 'cp_pais4')
                                        return "<?php echo __('Rellena el campo \"Código Postal\"'); ?>";
        if (theId == 'provincia_pais1' || theId == 'provincia_pais2' || theId == 'provincia_pais4')
                                        return "<?php echo __('Selecciona una \"Provincia\"'); ?>";
        if (theId == 'pais1' || theId == 'pais2' || theId == 'pais4')
                                        return "<?php echo __('Selecciona un \"País\"'); ?>";
        if (theId == 'txt2')            return "<?php echo __('Rellena el campo \"Nombre de la oficina o dependencia\"'); ?>";
        if (theId == 'domicilio2')      return "<?php echo __('Rellena el campo \"Dirección postal/Apdo. de Correos\"'); ?>";
        if (theId == 'txt4')            return "<?php echo __('Rellena el campo \"Denominación social del encargado del tratamiento\"'); ?>";
        if (theId == 'domicilio4')      return "<?php echo __('Rellena el campo \"Dirección postal\"'); ?>";
        if (theId == 'txt5')            return "<?php echo __('Rellena el campo \"Nombre del fichero o tratamiento\"'); ?>";
        if (theId == 'txt6')            return "<?php echo __('Rellena el campo \"Descripción detallada de la finalidad y usos previstos\"'); ?>";
        if (theId == 'finalidades2')    return "<?php echo __('Introduce al menos una finalidad tipificada hasta un máximo de seis. Escoja aquellas que mejor determinen la finalidad y usos del fichero'); ?>";
        if (theId == 'medidas1')        return "<?php echo __('Con la(s) finalidad(es) seleccionada(s), el nivel de seguridad solo puede ser \"Medio\" o \"Alto\"'); ?>";
        if (theId == 'medidas2')        return "<?php echo __('Con la(s) finalidad(es) seleccionada(s), el nivel de seguridad solo puede ser \"Alto\"'); ?>";
        if (theId == 'medidas3')        return "<?php echo __('Con el/los dato(s) protegido(s) seleccionado(s), el nivel de seguridad solo puede ser \"Alto\"'); ?>";
        if (theId == 'chk1')            return "<?php echo __('Marque al menos una de las casillas correspondientes al origen de los datos de carácter personal del fichero'); ?>";
        if (theId == 'colectivos2')     return "<?php echo __('Seleccione al menos un colectivo o categoría de interesados, o bien cumplimenta el campo \"Otros colectivos\" con una descripción del mismo'); ?>";
        if (theId == 'chk2')            return "<?php echo __('Debe señalar al menos una de las casillas correspondientes a \"Datos de carácter identificativo\" o bien cumplimentar el campo \"Otros datos de carácter identificativo\"'); ?>";
        if (theId == 'otros')           return "<?php echo __('El campo \"Otros colectivos\" no se puede dejar en blanco una vez seleccionado'); ?>";
        if (theId == 'otros2')          return "<?php echo __('El campo \"Otros datos de carácter identificativo\" no se puede dejar en blanco una vez seleccionado'); ?>";
        if (theId == 'otros3')          return "<?php echo __('El campo \"Otros tipos de datos\" no se puede dejar en blanco una vez seleccionado'); ?>";
        if (theId == 'datos2')          return "<?php echo __('Solo se permiten seis selecciones de \"Otros datos tipificados\"'); ?>";
        if (theId == 'chk4')            return "<?php echo __('Debe señalar la casilla que corresponda con el tipo de \"Sistema de tratamiento\" que se aplicará al fichero'); ?>";
        if (theId == 'chk5')            return "<?php echo __('Debe señalar la casilla que corresponda con el nivel de \"Medidas de seguridad\" que se aplicará al fichero'); ?>";
        if (theId == 'otros4')          return "<?php echo __('El campo \"Otros destinatarios de cesiones\" no se puede dejar en blanco una vez seleccionado'); ?>";
        if (theId == 'cesion')          return "<?php echo __('Solo se permiten seis selecciones de \"Categorías de destinatarios de cesiones\"'); ?>";
        if (theId == 'cat_inter')       return "<?php echo __('Indique al menos el país del encargado y la categoría correspondiente a éste, bien sea utilizando una categoría tipificada o bien mediante una descripción breve si la categoría no se ajusta a las tipificadas. Sección \"Transferencias internacionales\"'); ?>";
        if (theId == 'cat_int_incomp')  return "<?php echo __('Cumplimente la categoría correspondiente al país del encargado. Sección \"Transferencias internacionales\"'); ?>";
        if (theId == 'codinsmod')       return "<?php echo __('\"Código de Inscripción\" incorrecto'); ?>";
    }
    function cualquier_nivel() {
        var resul = false;
        var value = [];
        jQuery('#finalidades2').children('option:').each(function(i, choice) { if (jQuery(choice) !== null)  value[i] = jQuery(choice).val(); });
        var words = value.toString().split(',');<?php
        if (sfConfig::get('app_tipo_titularidad') == '2') { // Titularidad Privada (La Pública sería '1') ?>
            var j, k = 0, l = 0, m, n = 0;
            for (j = 0; j < words.length; j ++) { if (words[j] !== '417' && words[j] !== '418' && words[j] !== '419')    k ++; }
            jQuery('input.checkboxes:checked').each(function() { l ++; });
            for (m = 0; m < words.length; m ++) { if (words[m] == '401' || words[m] == '402')  n ++; }
            var ind_as = jQuery('#ind_as:checked').val();
            var ind_sal = jQuery('#ind_sal:checked').val();
            var sist_tratam = jQuery('input.sist_tratam:checked').val();
            if (j !== k || l == 0 || sist_tratam !== 20)    resul = false;
            else if (j == k && l > 0 && sist_tratam == 20)  resul = true;
            else if (ind_as == undefined && ind_sal == undefined && n == 0) resul = false;
            else if ((isUnsignedInteger(ind_as) || isUnsignedInteger(ind_sal)) && n > 0)  resul = true;<?php
        } ?>
        return resul;
    }
    function pais_change(dis) {
        var id = dis.attr('id');
        var v = dis.val();
        if (id == 'pais2' && v !== '55' &&  v !== '0') {
            jQuery('#pais2').removeClass('required');
            jQuery('#pais2').removeClass('not_required');
            jQuery('#pais2').addClass('not_required_unless_one_filled');
            jQuery('#cif_pais2').removeClass('required');
            jQuery('#cif_pais2').removeClass('not_required_unless_one_filled');
            jQuery('#cif_pais2').addClass('not_required');
            jQuery('#cp_pais2').removeClass('required');
            jQuery('#cp_pais2').removeClass('not_required_unless_one_filled');
            jQuery('#cp_pais2').addClass('not_required');
            jQuery('#provincia_pais2').removeClass('required');
            jQuery('#provincia_pais2').removeClass('not_required_unless_one_filled');
            jQuery('#provincia_pais2').addClass('not_required');
        } else if (id == 'pais2' && (v == '55' || v == '0')) {
            jQuery('#pais2').removeClass('required');
            jQuery('#pais2').removeClass('not_required_unless_one_filled');
            jQuery('#pais2').addClass('not_required');
            jQuery('#cif_pais2').removeClass('required');
            jQuery('#cif_pais2').removeClass('not_required');
            jQuery('#cif_pais2').addClass('not_required_unless_one_filled');
            jQuery('#cp_pais2').removeClass('required');
            jQuery('#cp_pais2').removeClass('not_required');
            jQuery('#cp_pais2').addClass('not_required_unless_one_filled');
            jQuery('#provincia_pais2').removeClass('required');
            jQuery('#provincia_pais2').removeClass('not_required');
            jQuery('#provincia_pais2').addClass('not_required_unless_one_filled');
        }
        if ((id == 'pais1') && (v !== '0') && (v !== '3') && (v !== '12') && (v !== '19') && (v !== '28') && (v !== '38') && (v !== '46') && (v !== '157') && (v !== '54') && (v !== '55') && (v !== '57') && (v !== '62') && (v !== '63') && (v !== '69') && (v !== '80') && (v !== '85') && (v !== '92') && (v !== '102') && (v !== '107') && (v !== '108') && (v !== '115') && (v !== '136') && (v !== '143') && (v !== '144') && (v !== '147') && (v !== '149') && (v !== '158') && (v !== '176')) {
            alert("<?php echo __('Ha señalado en el apartado 1 que el responsable del fichero se encuentra establecido fuera de la Unión Europea. Cuando el responsable del fichero no esté establecido en el territorio de la Unión Europea y utilice en el tratamiento de datos medios situados en territorio español, deberá designar, salvo que tales medios se utilicen con fines de tránsito, un representante en España, sin perjuicio de las acciones que pudieran emprenderse contra el propio responsable del tratamiento. En este caso, deberá cumplimentar obligatoriamente los datos de su representante en España en el apartado 2. Derechos de oposición, acceso, rectificación y cancelación'); ?>");
            jQuery('#pais2').val('55');
            jQuery('#pais2').readonly(true);
            pais_change(jQuery('#pais2'));
            jQuery('#cif_' + id + '_div').hide();
            if (!jQuery('#cif_pais1').hasClass('not_required'))   jQuery('#cif_pais1').removeClass('required');
            jQuery('#cp_pais1_div').hide();
            if (!jQuery('#cp_pais1').hasClass('not_required'))   jQuery('#cp_pais1').removeClass('required');
            jQuery('#provincia_pais1_div').hide();
            if (!jQuery('#provincia_pais1').hasClass('not_required'))   jQuery('#provincia_pais1').removeClass('required');
            jQuery('#cif_pais1').val('00000000T');
            jQuery('#cp_pais1').val('');
            jQuery('#provincia_pais1').val('0');
            return;
        } else if (id == 'pais1') {
            jQuery('#cif_pais1').val('');
            jQuery('#pais2').val('0');
            jQuery('#pais2').readonly(false);
            pais_change(jQuery('#pais2'));
        }
        if (v !== '0' && v !== '55') {
            jQuery('#cif_' + id).val('');
            jQuery('#cif_' + id + '_div').hide();
            if (!jQuery('#cif_' + id).hasClass('not_required'))   jQuery('#cif_' + id).removeClass('required');
            jQuery('#cp_' + id).val('');
            jQuery('#cp_' + id + '_div').hide();
            if (!jQuery('#cp_' + id).hasClass('not_required'))   jQuery('#cp_' + id).removeClass('required');
            jQuery('#provincia_' + id).val('0');
            jQuery('#provincia_' + id + '_div').hide();
            if (!jQuery('#provincia_' + id).hasClass('not_required'))   jQuery('#provincia_' + id).removeClass('required');
        }
        else if (v == '0' || v == '55') {
            jQuery('#cif_' + id + '_div').show();
            if (!jQuery('#cif_' + id).hasClass('not_required') && id !== 'pais2')   jQuery('#cif_' + id).addClass('required');
            jQuery('#cp_' + id + '_div').show();
            if (!jQuery('#cp_' + id).hasClass('not_required') && id !== 'pais2')   jQuery('#cp_' + id).addClass('required');
            jQuery('#provincia_' + id + '_div').show();
            if (!jQuery('#provincia_' + id).hasClass('not_required') && id !== 'pais2')   jQuery('#provincia_' + id).addClass('required');
        }
    }
    function isUnsignedInteger(s) {
        return (s.toString().search(/^[0-9]+$/) == 0);
    }
    function focus_me(me) {
        jQuery('#' + me).focus();
        if (!jQuery('#' + me).hasClass('list')) jQuery('#' + me).select();
    }
    function not_required() {
        Obj.readonly(true);
        Obj.removeClass('required');
    }
    function funzion() {<?php
        if ($hook == 'Inscripcion' || $hook == 'Modificacion') { ?>
            jQuery('#derechos').find('input, select').each(function() {
                jQuery(this).removeClass('required');
                jQuery(this).removeClass('not_required');
                if (!jQuery(this).hasClass('pais')) {
                    jQuery(this).addClass('not_required_unless_one_filled');
                } else if (jQuery(this).hasClass('pais') && jQuery(this).val() == '0') {
                    jQuery(this).addClass('not_required');
                    jQuery(this).removeClass('not_required_unless_one_filled');
                }
            });
            jQuery('#encargado').find('input, select').each(function() {
                jQuery(this).removeClass('required');
                jQuery(this).removeClass('not_required');
                if (!jQuery(this).hasClass('pais')) {
                    jQuery(this).addClass('not_required_unless_one_filled_2');
                } else if (jQuery(this).hasClass('pais') && jQuery(this).val() == '0') {
                    jQuery(this).addClass('not_required');
                    jQuery(this).removeClass('not_required_unless_one_filled_2');
                }
            });<?php
        } else if ($hook == 'Supresion') { ?>
            jQuery('#derechos').find('input, select').each(function() { not_required(jQuery(this)); });
            jQuery('#encargado').find('input, select').each(function() { not_required(jQuery(this)); });
            jQuery('#denom_fichero').find('input, textarea').each(function() { not_required(jQuery(this)); });
            jQuery('#finalidades').find('select, a').each(function() { not_required(jQuery(this)); });
            jQuery('#origenes').find('input').each(function() { not_required(jQuery(this)); });
            jQuery('#colectivos').find('select, a').each(function() { not_required(jQuery(this)); });
            jQuery('#identificativos').find('input').each(function() { not_required(jQuery(this)); });
            jQuery('#nivel_seg_div').find('input').each(function() { not_required(jQuery(this)); });
            jQuery('#tratamiento').find('input').each(function() { not_required(jQuery(this)); });
            jQuery('#cesion').find('select, a').each(function() { not_required(jQuery(this)); });<?php
        } ?>
    }
    function valida_nif_cif_nie(a) {
    // Validación automática de CIF, NIF y NIE según la última legislación.
    // Recibe el 'id' del elemento HTML para proceder a la validación, si es correcta devuelve 'true' y sino saca un alert y devuelve 'false'
        var resul = true;
        var temp = trim(jQuery('#'+a).val()).toUpperCase();
        var cadenadni = "TRWAGMYFPDXBNJZSQVHLCKE";
        if (temp !== '') {
            //algoritmo para comprobacion de codigos tipo CIF
            suma = parseInt(temp[2]) + parseInt(temp[4]) + parseInt(temp[6]);
            for (i = 1; i < 8; i += 2) {
                temp1 = 2 * parseInt(temp[i]);
                temp1 += '';
                temp1 = temp1.substring(0,1);
                temp2 = 2 * parseInt(temp[i]);
                temp2 += '';
                temp2 = temp2.substring(1,2);
                if (temp2 == '') {
                    temp2 = '0';
                }
                suma += (parseInt(temp1) + parseInt(temp2));
            }
            suma += '';
            n = 10 - parseInt(suma.substring(suma.length-1, suma.length));
            //si no tiene un formato valido devuelve error
            if ((!/^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$/.test(temp) && !/^[T]{1}[A-Z0-9]{8}$/.test(temp)) && !/^[0-9]{8}[A-Z]{1}$/.test(temp)) {
                if ((temp.length == 9) && (/^[0-9]{9}$/.test(temp))) {
                    var posicion = temp.substring(8,0) % 23;
                    var letra = cadenadni.charAt(posicion);
                    var letradni = temp.charAt(8);
                    alert("La letra del NIF no es correcta. " + letradni + " es diferente a " + letra);
                    jQuery('#'+a).val(temp.substr(0,8) + letra);
                    resul = false;
                } else if (temp.length == 8) {
                    if (/^[0-9]{1}/.test(temp)) {
                        var posicion = temp.substring(8,0) % 23;
                        var letra = cadenadni.charAt(posicion);
                        var tipo = 'NIF';
                    } else if (/^[KLM]{1}/.test(temp)) {
                        var letra = String.fromCharCode(64 + n);
                        var tipo = 'NIF';
                    } else if (/^[ABCDEFGHJNPQRSUVW]{1}/.test(temp)) {
                        var letra = String.fromCharCode(64 + n);
                        var tipo = 'CIF';
                    } else if (/^[T]{1}/.test(temp)) {
                        var letra = String.fromCharCode(64 + n);
                        var tipo = 'NIE';
                    } else if (/^[XYZ]{1}/.test(temp)) {
                        var pos = str_replace(['X', 'Y', 'Z'], ['0','1','2'], temp).substring(0, 8) % 23;
                        var letra = cadenadni.substring(pos, pos + 1);
                        var tipo = 'NIE';
                    }
                    if (letra !== '') {
                        alert("Añadido la letra del " + tipo + ": " + letra);
                        jQuery('#'+a).val(temp + letra);
                    } else {
                        alert ("<?php echo __('El CIF/NIF/NIE tiene que tener 9 caracteres'); ?>");
                        jQuery('#'+a).val(temp);
                    }
                    resul = false;
                } else if (temp.length < 8) {
                    alert ("<?php echo __('El CIF/NIF/NIE tiene que tener 9 caracteres'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                } else {
                    alert ("<?php echo __('CIF/NIF/NIE incorrecto'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                }
            }
            //comprobacion de NIFs estandar
            else if (/^[0-9]{8}[A-Z]{1}$/.test(temp)) {
                var posicion = temp.substring(8,0) % 23;
                var letra = cadenadni.charAt(posicion);
                var letradni = temp.charAt(8);
                if (letra == letradni) {
                    return 1;
                } else if (letra != letradni) {
                    alert("La letra del NIF no es correcta. " + letradni + " es diferente a " + letra);
                    jQuery('#'+a).val(temp.substr(0,8) + letra);
                    resul = false;
                } else {
                    alert ("<?php echo __('NIF incorrecto'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                }
            }
            //comprobacion de NIFs especiales (se calculan como CIFs)
            else if (/^[KLM]{1}/.test(temp)) {
                if (temp[8] == String.fromCharCode(64 + n)) {
                    return 1;
                } else if (temp[8] != String.fromCharCode(64 + n)) {
                    alert("La letra del NIF no es correcta. " + temp[8] + " es diferente a " + String.fromCharCode(64 + n));
                    jQuery('#'+a).val(temp.substr(0,8) + String.fromCharCode(64 + n));
                    resul = false;
                } else {
                    alert ("<?php echo __('NIF incorrecto'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                }
            }
            //comprobacion de CIFs
            else if (/^[ABCDEFGHJNPQRSUVW]{1}/.test(temp)) {
                var temp_n = n + '';
                if (temp[8] == String.fromCharCode(64 + n) || temp[8] == parseInt(temp_n.substring(temp_n.length-1, temp_n.length))) {
                    return 2;
                } else if (temp[8] != String.fromCharCode(64 + n)) {
                    alert("La letra del CIF no es correcta. " + temp[8] + " es diferente a " + String.fromCharCode(64 + n));
                    jQuery('#'+a).val(temp.substr(0,8) + String.fromCharCode(64 + n));
                    resul = false;
                } else if (temp[8] != parseInt(temp_n.substring(temp_n.length-1, temp_n.length))) {
                    alert("La letra del CIF no es correcta. " + temp[8] + " es diferente a " + parseInt(temp_n.substring(temp_n.length-1, temp_n.length)));
                    jQuery('#'+a).val(temp.substr(0,8) + parseInt(temp_n.substring(temp_n.length-1, temp_n.length)));
                    resul = false;
                } else {
                    alert ("<?php echo __('CIF incorrecto'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                }
            }
            //comprobacion de NIEs
            //T
            else if (/^[T]{1}/.test(temp)) {
                if (temp[8] == /^[T]{1}[A-Z0-9]{8}$/.test(temp)) {
                    return 3;
                } else if (temp[8] != /^[T]{1}[A-Z0-9]{8}$/.test(temp)) {
                    var letra = String.fromCharCode(64 + n);
                    var letranie = temp.charAt(8);
                    if (letra != letranie) {
                        alert("La letra del NIE no es correcta. " + letranie + " es diferente a " + letra);
                        jQuery('#'+a).val(temp.substr(0,8) + letra);
                        resul = false;
                    } else {
                        alert ("<?php echo __('NIE incorrecto'); ?>");
                        jQuery('#'+a).val(temp);
                        resul = false;
                    }
                }
            }
            //XYZ
            else if (/^[XYZ]{1}/.test(temp)) {
                var pos = str_replace(['X', 'Y', 'Z'], ['0','1','2'], temp).substring(0, 8) % 23;
                var letra = cadenadni.substring(pos, pos + 1);
                var letranie = temp.charAt(8);
                if (letranie == letra) {
                    return 3;
                } else if (letranie != letra) {
                    alert("La letra del NIE no es correcta. " + letranie + " es diferente a " + letra);
                    jQuery('#'+a).val(temp.substr(0,8) + letra);
                    resul = false;
                } else {
                    alert ("<?php echo __('NIE incorrecto'); ?>");
                    jQuery('#'+a).val(temp);
                    resul = false;
                }
            }
        }
        if (!resul) {
            focus_me(jQuery('#'+a).attr('id'));
            return resul;
        }
    }
    function str_replace(search, replace, subject, count) {
        var i = 0, j = 0, temp = '', repl = '', sl = 0, fl = 0,
            f = [].concat(search),
            r = [].concat(replace),
            s = subject,
            ra = r instanceof Array, sa = s instanceof Array;
        s = [].concat(s);
        if (count) {
            this.window[count] = 0;
        }
        for (i=0, sl=s.length; i < sl; i++) {
            if (s[i] === '') {
                continue;
            }
            for (j=0, fl=f.length; j < fl; j++) {
                temp = s[i]+'';
                repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
                s[i] = (temp).split(f[j]).join(repl);
                if (count && s[i] !== temp) {
                    this.window[count] += (temp.length-s[i].length)/f[j].length;}
            }
        }
        return sa ? s : s[0];
    }
    function array_search( needle, haystack, argStrict ) {
        var strict = !!argStrict;
        var key = '';
        for(key in haystack){
            if( (strict && haystack[key] === needle) || (!strict && haystack[key] == needle) ){
                return key;
            }
        }
        return false;
    }
--></script>