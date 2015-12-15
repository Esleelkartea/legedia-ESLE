/*********************** VARIABLES GLOBLALES ************************/
var descargar_fichero=false;
var cargando=true;
var sepuedeenviar=true;

//Elementos cargados mediante la funcion loadobjs
var loadedobjects="";

//Que navegador es
var DOMsupported = 0;
var standardDOMsupported = 0;
var ieDOMsupported = 0;
var netscapeDOMsupported = 0;

if (document.getElementById) {standardDOMsupported = 1; DOMsupported = 1;}
else {browserVersion = parseInt(navigator.appVersion); if ((navigator.appName.indexOf('Netscape') != -1) && (browserVersion ==4)) {netscapeDOMsupported = 1; DOMsupported = 1;}}
if (document.all) {ieDOMsupported = 1; DOMsupported = 1;}

//Evento enviar formulario para controlar que no se envie cuando pulsas enter para pasar de campo
//onsubmit=enviar;

//Evento Teclado para mirar si es enter o flecha para atras para pasar de campo
//document.onkeydown = keyDown;
//if (document.layers) document.captureEvents(Event.KEYDOWN);

//Eventos de carga y empezar descarga de la p?gina para mostrar la capa transitoria de carga
/*Ana: Comento porque nosotros no lo utilizamos y da problemas en el explorer.
addLoadEvent('acabarCarga');
addUnLoadEvent('empezarCarga');
addOnBeforeUnLoadEvent('empezarCarga');
onbeforeunload=empezarCarga
*/
				
var YY=0;
var XX=0;
var delay_time=500;

/***************** FIN  DEFINIMOS EVENTOS **************************/
/*******************************************************************/
/***************** FUNC. RELACIONADAS CON EVENTOS ******************/

//Llamada onsubmit
function enviar(evt){
    var evt  = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    
    if (sepuedeenviar) return true;
    else return false;
}

//Llamada onkeydown (Mira si es enter o flecha izquierda y pasa al campo)
function keyDown(evt) {

    sepuedeenviar=false;

    var evt  = (evt) ? evt : ((event) ? event : null);
    var tecla = (evt.which) ? evt.which : evt.keyCode;
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    
    if (node.form){
        for (i=0,n=node.form.elements.length;i<n;i++){
            if (node.form.elements[i]==node)
                break;
        }

        /*
        if (tecla==13){
        //Pa alante
            setTimeout("restablecer()",1500);
            for (j=0; j < node.form.elements.length; j++){
                if (node == node.form.elements[j])
                    break;
            }
            for (h=j+1;h<node.form.elements.length; h++){
              if (node.form.elements[h].type!="hidden")
                    break;
            }
            if (h<node.form.elements.length){
                z = h % node.form.elements.length;
                if ((node.form.elements[z].type != "hidden") && (!node.form.elements[z].disabled)){
                    node.form.elements[z].focus();
                    if (node.form.elements[z].type=="text" || node.form.elements[z].type=="password" || node.form.elements[z].type=="textarea"){
                      node.form.elements[z].select();
                    }
                }
                sepuedeenviar=false;
                return false;
            }
            else {
                sepuedeenviar=true;
                return true;
            }
        }
        else if (tecla==37){
        //Pa atras
            //Restablecemos
            sepuedeenviar=true;
            for (cc=0; cc < node.form.elements.length; cc++){
                if (node == node.form.elements[cc])
                    break;
            }
            for (zz=cc-1;zz>=0; zz--){
                if ((node.form.elements[zz].type!="hidden")&&(!node.form.elements[zz].disabled))
                    break;
            }
            hh = zz % node.form.elements.length;
            
			      node.form.elements[hh].focus();
            if (node.form.elements[hh].type=="text" || node.form.elements[hh].type=="password" || node.form.elements[hh].type=="textarea") node.form.elements[hh].select();
			     return false;
        }
        */
        //else {
            //Restablecemos
            sepuedeenviar=true;
            return true;
        //}
    }
  }

function restablecer(){
    sepuedeenviar=true;
}

//Llamada onload (Oculta la capa de cargando)
function acabarCarga(evt){
    //Ocultar capa Cargando
    //var evt  = (evt) ? evt : ((event) ? event : null);
    //var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    
    cargando=false;
    
    input=encontrarObjeto('elcampoC');
    if (input) input.value="|";
    
    hideAd('cargar');
}

//Llamada onbeforeunload y onunload (Ense?a la capa de cargando)
function empezarCarga(){
    //Mostrar Capa Transfieriendo datos
    if (!descargar_fichero){
        cargando=true;
        input=encontrarObjeto('elcampoC');
        if (input) input.value="|";
            
        showAd('cargar');
        
        setTimeout("anadir('elcampoC','|')", 500);
    }
}

/*************** FIN  FUNC. RELACIONADAS CON EVENTOS ****************/
/*******************************************************************/
/*********************** FUNCIONES VARIAS **************************/


function reloc(capa){
var ch=0;
var oh=0;
var cw=0;
var ow=0;

	lacapa=findDOM(capa);

  if ((ieDOMsupported)&&(document.documentElement && document.documentElement.clientHeight)) {ch=document.documentElement.clientHeight;oh=lacapa.offsetHeight;cw=document.documentElement.clientWidth;ow=lacapa.offsetWidth;}
	else if(ieDOMsupported){ch=document.body.clientHeight;oh=lacapa.offsetHeight;cw=document.body.clientWidth;ow=lacapa.offsetWidth;}
	else if(netscapeDOMsupported){ch=window.innerHeight;oh=lacapa.clip.height;cw=window.innerWidth;ow=lacapa.clip.width;}
	else if(standardDOMsupported){ch=self.innerHeight;oh=lacapa.offsetHeight;cw=self.innerWidth;ow=lacapa.offsetWidth;}

  if (YY!=((ch/2)-(oh/2))){
    YY=((ch/2)-(oh/2));
	}

  if (XX!=((cw/2)-(ow/2))){
    XX=((cw/2)-(ow/2));
	}
	
  if ((ieDOMsupported)&&(document.documentElement && document.documentElement.scrollTop)){lacapa.style.top=YY+document.documentElement.scrollTop;lacapa.style.left=XX+document.documentElement.scrollLeft;}
	else if(ieDOMsupported){lacapa.style.top=YY+document.body.scrollTop;lacapa.style.left=XX+document.body.scrollLeft;}
	else if(netscapeDOMsupported){lacapa.pageY=YY+window.pageYOffset;lacapa.pageX=XX+window.pageXOffset;}
	else if(standardDOMsupported){lacapa.style.top=YY+self.pageYOffset+"px";lacapa.style.left=XX+self.pageXOffset+"px";}
}
       
function mostrar_ventana(enlace,id){
  
	eval("var win"+id+" = new Window('capadatos"+id+"', {url: '"+enlace+"', options: {method: 'get'}},  {className: 'MacShadow ', title: 'Datos Calendario', width:400, height:400, zIndex:0, opacity:1, resizable: true, draggable:true})");
  eval("win"+id+"._center()");
  eval("win"+id+".show()");
  eval("win"+id+".setZIndex(0)");
  myObserver = {
    onEndMove: function(eventName, win) {
      win.setZIndex(0);
    }
  }
  Windows.addObserver(myObserver);
}

function loopfunc(){
	reloc('cargar');
	//relocTop('capadatos');
	setTimeout('loopfunc()',delay_time);
}

function parar(){
    if (document.all) {alert("NO ES POSIBLE CANCELAR EN IE");acabarCarga();}
    else window.stop();
}

function anadir(campo,cosa){
    if (cargando){
        input=encontrarObjeto(campo);
        
        if (input.value.length>=30) input.value="";
        
        input.value=input.value+cosa;
        
        setTimeout("anadir('"+campo+"','"+cosa+"')", 500);
    }
}

/*********************** FUNCIONES VARIAS **************************/
/******************************************************************/
/******************** FUNCIONES GENERALES VARIAS ******************/

//Encontrar Objeto en el HTML solo con el nombre
function findDOM(objectId, withStyle) {
	if (withStyle) {
		if (standardDOMsupported) {return (document.getElementById(objectId).style);}
		if (ieDOMsupported) { if (document.all[objectId]) return (document.all[objectId].style);}
		if (netscapeDOMsupported) {return (document.layers[objectId]);}
	} 
	else {
		if (standardDOMsupported) {return (document.getElementById(objectId));}
		if (ieDOMsupported) {if (document.all[objectId]) return (document.all[objectId]);}
		if (netscapeDOMsupported) {return (document.layers[objectId]);}
	}
}

//Encontrar Objeto en el HTML solo con el nombre (OTRA)
function encontrarObjeto(n, d) { 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

//Muestra una capa
function showAd(objectID) {
 objStyle = findDOM(objectID,1);
 objStyle.visibility = 'visible';
}

//Oculta una capa
function hideAd(objectID) {
 objStyle = findDOM(objectID,1);
 objStyle.visibility = 'hidden';
}

//Abre POPUP con las paradas y averias
function popUp(URL) {
    day = new Date();
    id = day.getTime();
    
    screen_height = window.screen.availHeight; 
    screen_width = window.screen.availWidth;
    
    width=680;
    height=500;
    left=parseInt(screen_width/2)-(width/2);
    top=parseInt(screen_height/2)-(height/2);
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=" + width + ",height=" +  height + ",left = " + left + ",top = " + top + "');");
}

function trim(sString) {
    if (sString == undefined)   return undefined;
    else {
	while (sString.substring(0,1) == ' ') {
            sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' ') {
            sString = sString.substring(0,sString.length-1);
	}
	return sString;
    }
}

function replaceAll( str, from, to ) {
    var idx = str.indexOf( from );


    while ( idx > -1 ) {
        str = str.replace( from, to );
        idx = str.indexOf( from );
    }

    return str;
}

//AutoSelecciona un select dado lo que se va escribiendo en un campo de texto.
function autoComplete (field, select, property, forcematch) {

	var found = false;
    var campos=new Array();
	for (var i = 0; i < select.options.length; i++) {
        campos=select.options[i][property].split(") ");
        if (campos[0].substring(0,1)=="(")
            var abuscar=campos[0].substring(1,campos[0].length);
        else var abuscar=campos[0].substring(0,campos[0].length);
        if (trim(abuscar.toUpperCase()).indexOf(field.value.toUpperCase()) == 0) {
            found=true; break;
        }
	}
	if (found) { select.selectedIndex = i; }
	//else { select.selectedIndex = -1; }
    if (forcematch && !found) {
            field.value=field.value.substring(0,field.value.length-1); 
            return;
    }
    if (field.createTextRange){
        var cursorKeys ="8;46;37;38;39;40;33;34;35;36;45;";
        if (cursorKeys.indexOf(event.keyCode+";") == -1) {
            var r1 = field.createTextRange();
            var oldValue = r1.text;
            var newValue = found ? abuscar : oldValue;
            if (newValue != field.value) {
                field.value = newValue;
                var rNew = field.createTextRange();
                rNew.moveStart('character', oldValue.length) ;
                rNew.select();
            }
        }
    }
}

/*
function autoComplete (field, select, property, forcematch,evt) {
    
	var found = false;
    var campos=new Array();
    
   
   switch (evt.keyCode) {
       case 38: //up arrow  
       case 40: //down arrow
       case 37: //left arrow
       case 39: //right arrow
       case 33: //page up  
       case 34: //page down  
       case 36: //home  
       case 35: //end                  
       case 27: //esc  
       case 16: //shift  
       case 17: //ctrl  
       case 18: //alt  
       case 20: //caps lock
       //case 8: //backspace  
       //case 46: //delete
           return true;
           break;
       case 13: keyDown(evt);break;//enter  
       case 9:  keyDown(evt);break;//tab  
       default:
            //Creamos el customarray total
            if (customarray.length==0){
                for (var i = 0; i < select.options.length; i++) {
                    campos=select.options[i][property].split(") ");
                    if (campos[0].substring(0,1)=="(")
                        customarray[i]=campos[0].substring(1,campos[0].length);
                    else customarray[i]=campos[0].substring(0,campos[0].length);
                }
            }
            //Buscamos en el select
            for (var i = 0; i < select.options.length; i++) {
                campos=select.options[i][property].split(") ");
                if (campos[0].substring(0,1)=="(")
                    var abuscar=campos[0].substring(1,campos[0].length);
                else var abuscar=campos[0].substring(0,campos[0].length);
                if (abuscar.toUpperCase().indexOf(field.value.toUpperCase()) == 0) {
                    found=true; break;
                }
            }
            if (found) {
                select.selectedIndex = i; 
                
                var iLen=field.value.length;
                field.value=abuscar.toUpperCase();
                textboxSelect(field, iLen, field.value.length);
                
                actb(field,evt,customarray);
            }
            else { select.selectedIndex = -1; }
            if (forcematch && !found) {
                    field.value=field.value.substring(0,field.value.length-1); 
                    return;
            }
        break;
    }
}
var customarray=new Array();
*/


function textboxSelect (oTextbox, iStart, iEnd) {

   switch(arguments.length) {
       case 1:
           oTextbox.select();
           break;

       case 2:
           iEnd = oTextbox.value.length;
           /* falls through */
           
       case 3:          
           if (ieDOMsupported) {
               var oRange = oTextbox.createTextRange();
               oRange.moveStart("character", iStart);
               oRange.moveEnd("character", -oTextbox.value.length + iEnd);      
               oRange.select();                                              
           } else if (standardDOMsupported){
               oTextbox.setSelectionRange(iStart, iEnd);
           }                    
   }

   oTextbox.focus();
}

//Redondea un numero
function RounDecimal(nro,d) { 
    var num_dec=0;
    var poner_todos_decimales = arguments[2] ? arguments[2] : false;
    var m = Math.pow(10,d); 
    var nro2 = nro * m; 
    nro2 = Math.round(nro2) / m;

    if (poner_todos_decimales){
        nro2 = nro2.toString();
        
        if (nro2.indexOf('.')==-1)
            num_dec = d;
        else
            num_dec = d - (nro2.substring(nro2.indexOf('.')+1,nro2.length).length);
        
        if ((nro2.indexOf('.')==-1)&&(d>0))
            nro2 = nro2 + ".";
            
        for (i=1;i<=num_dec;i++){
            nro2 = nro2 + "0";
        }
    }
    
    return (nro2) ; 
}

/********************** FIN FUNCIONES GENERALES VARIAS ***********************/
/*****************************************************************************/
/************ FUNCIONES DE TRATAMIENTO DE CAMPOS DE TEXTO ********************/

//trata un campo como entero, convirtiendolo en entero si es decimal y en 0 si no es numero
function tratar(campo){
    campo.value=campo.value.replace(',','.'); 
    if ((campo.value=="")||(!parseFloat(campo.value))){
        campo.value=0;
    }
    else if (parseFloat(campo.value)){
        while (campo.value.substring(0,1)==0)
          campo.value=campo.value.substring(1,campo.value.length);
        
        campo.value=eval(campo.value);
        campo.value=RounDecimal(campo.value,0);
    }
}

//trata un campo como decimal, redondeandolo a 2 si es decimal y en 0 si no es numero
function tratar_decimal(campo){
    campo.value=campo.value.replace(',','.'); 
    if ((campo.value=="")||(!parseFloat(campo.value))){
        campo.value=0;
    }
    else if (parseFloat(campo.value)){
        while (campo.value.substring(0,1)==0)
          campo.value=campo.value.substring(1,campo.value.length);

        campo.value=eval(campo.value);
        campo.value=RounDecimal(campo.value,2);
    }
}

//Mira si el campo es una fecha con formato correcto y si no devuelve el error
function tratar_fecha(campo){
    if ((campo.value!='')&&(!(/([0-9]{1,2})[\/.-]([0-9]{1,2})[\/.-]([0-9]{4})/.test(campo.value)))){
        alert("El campo " + campo.name + " tiene un formato INCORRECTO. Debe ser del tipo: dd-mm-aaaa o dd/mm/aaaa.\nLe aconsejamos que apriete el bot?n del selector de fechas para una correcta utilizaci?n.");
        return false;
    }
    return true;
}

//Ana: Funcion que te devuelve la fecha en ingles.
function splitDateVal(dateval) {
	var datesep;
	var dateelements = new Array(3);
	
	if (dateval.indexOf("-")>=0) datesep="-"
	else if (dateval.indexOf(".")>=0) datesep="."
	else if (dateval.indexOf("/")>=0) datesep="/"
	

	dateelements[0]=dateval.substring(0,dateval.indexOf(datesep))
	dateelements[1]=dateval.substring(dateval.indexOf(datesep)+1,dateval.lastIndexOf(datesep))
	dateelements[2]=dateval.substr(dateval.lastIndexOf(datesep)+1,dateval.length)
	
	
	
	return dateelements;
}





/************ FIN FUNCIONES DE TRATAMIENTO DE CAMPOS DE TEXTO ****************/
/*****************************************************************************/
/************ FUNCIONES DE IMAGENES ********************/

function restaurarImagen() {
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function cambiarImagen() {
  var i,j=0,x,a=cambiarImagen.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=encontrarObjeto(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function toggle_visibility(id){
	if(document.getElementById(id).style.display == "block") {
		document.getElementById(id).style.display = "none";
	} else {
		document.getElementById(id).style.display = "block";
	}
}

/************ FIN FUNCIONES DE IMAGENES ****************/
/*****************************************************************************/
/************ FUNCIONES DE CARGAR EVENTOS DE CARGA/DESCARGA DE PAGINAS ********************/

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = eval(func);
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function addUnLoadEvent(func) {
  var oldonunload = window.onunload;
  if (typeof window.onunload != 'function') {
    window.onunload = eval(func);
  } else {
    window.onunload = function() {
      oldonunload();
      func();
    }
  }
}

function addOnBeforeUnLoadEvent(func) {
  var oldonbeforeunload = window.onbeforeunload;
  if (typeof window.onbeforeunload != 'function') {
    window.onbeforeunload = eval(func);
  } else {
    window.onbeforeunload = function() {
      oldonbeforeunload();
      func();
    }
  }
}

function addErrorEvent(func) {
  var oldonerror = window.onerror;
  if (typeof window.onerror != 'function') {
    window.onerror = eval(func);
  } else {
    window.onerror = function() {
      oldonerror();
      func();
    }
  }
}

function addEvent(el, evname, func) {
	if (el.attachEvent) { // IE
		el.attachEvent("on" + evname, func);
	} else if (el.addEventListener) { // Gecko / W3C
		el.addEventListener(evname, func, true);
	} else {
		el["on" + evname] = func;
	}
}

function removeEvent(el, evname, func) {
	if (el.detachEvent) { // IE
		el.detachEvent("on" + evname, func);
	} else if (el.removeEventListener) { // Gecko / W3C
		el.removeEventListener(evname, func, true);
	} else {
		el["on" + evname] = null;
	}
}

/************ FIN FUNCIONES DE CARGAR EVENTOS DE CARGA/DESCARGA DE PAGINAS ****************/
/*****************************************************************************/
/************ FUNCIONES DE CARGAR OBJETOS EN LA PAGINA Y EN CAPAS ********************/

function loadObjs(){
  if (!document.getElementById) return ;

  for (i=0; i<arguments.length; i++){
    var file=arguments[i];
    var fileref="";
    if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
      if (file.indexOf(".js")!=-1){ //If object is a js file
        fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", file);
      }
      else if (file.indexOf(".css")!=-1){ //If object is a css file
        fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", file);
      }
    }
    if (fileref!=""){
      document.getElementsByTagName("head").item(0).appendChild(fileref)
      loadedobjects+=file+" " //Remember this object as being already added to page
    }
  }
}

function addDivElement(divNum,parentDiv,htmlDiv) {
  var ni = document.getElementById(parentDiv);
  if (ni){
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id',divNum);
    newdiv.innerHTML = htmlDiv;
    ni.appendChild(newdiv);
  }
}

function removeDivElement(divNum,parentDiv) {
  var d = document.getElementById(parentDiv);
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

/************ FIN FUNCIONES DE CARGAR OBJETOS EN LA PAGINA Y EN CAPAS ********************/

function Posicionar(enlace,capa){
  d = findDOM(capa,false);
  oLink = findDOM(enlace,false);
  w = d.style.width;
  if( oLink.offsetParent ) {
    for( var posX = 0, posY = 0; oLink.offsetParent; oLink = oLink.offsetParent ) {
      posX += oLink.offsetLeft;
      posY += oLink.offsetTop;
    }
    mx = posX;
    my = posY;
  } else {
    mx = oLink.x;
    my = oLink.y;
  }
  
  d.style.left = (mx-35) + 'px';
  d.style.top = (my+15) + 'px';
  if (window.innerWidth && ((mx+w) > window.innerWidth)) {
      d.style.left = (window.innerWidth - w - 25) + "px";
  }
  if (document.body.scrollWidth && ((mx+w) > document.body.scrollWidth)) {
      d.style.left = (document.body.scrollWidth - w - 25) + "px";
  }
}

function formatearPorTiempo(ctexto){
  texto = ctexto.value;
  texto = replaceAll(texto,':','');
  while (texto.length<8){
    texto = texto + "0";
  }
  ttexto = "";
  for (i=0;i<texto.length;i++) {
    if (((i % 2)==0)&&(i!=0)) ttexto = ttexto + ":";
    ttexto = ttexto + texto.substring(i,i+1);
  }
  ctexto.value = ttexto;
}

//Aritz: Funcion para ocultar o mostrar una capa.
function mostrarDiv (div,ruta) {
	var x=document.getElementsByName("div-"+div);
	for (i=0;i< x.length;i++){
	  if(x[i].style.display=="block")
	  	 x[i].style.display = "none";
     else
       x[i].style.display = "block";
   } 	

   if(x[0].style.display=="block")
     cambiarImagen("img_"+div,"",ruta+"/images/icons/arrow_up.png");
   else
     cambiarImagen("img_"+div,"",ruta+"/images/icons/arrow_down.png");
}

//Aritz: Funciones para quitar/poner el disabled a un grupo de elementos del mismo tipo

//Sirve para que el usuario no pueda modificar algunos campos, y luego se envien correctamente 

function quitarDisabled(){
  for (i=0; i < arguments.length; i++){
    var elementos=document.getElementsByTagName(arguments[i]);
    for (x=0; x < elementos.length; x++) {
     elementos[x].disabled=false;
    }
  }
}

//Por si acaso ha habido algun error y hace falta volver a poner disabled, porque no se ha hecho submit y el usuario puede hacer cambios de nuevo
//no se si se usara, pero era tan facil hacerlo...
function ponerDisabled(){
  for (i=0; i < arguments.length; i++){
    var elementos=document.getElementsByTagName(arguments[i]);
    for (x=0; x < elementos.length; x++) {
     elementos[x].disabled=true;
    }
  }
}

function getElementsByClassName(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
        oElement = arrElements[i];
        if(oRegExp.test(oElement.className)){
            arrReturnElements.push(oElement);
        }
    }
    return (arrReturnElements)
}

function openPopup(title, width, height, control_name, href, val_sel){  
  if (val_sel) {
    control_name = replaceAll(control_name,'[','_');
    control_name = replaceAll(control_name,']','');
    href = href+"&valor_sel="+document.getElementById(control_name).value;
  }

  myLightWindow.activateWindow({type: 'external', rel: 'tablaVal', title: title, width: width, height: height, resizeSpeed: 10, href: href});return false;  
}

// Para imprimir un elemento HTML exacto
jQuery.fn.extend({
    print: function() {
        // first of all, we asign the class "lda-noprint" to all the children of body
        var cache = jQuery('body>*').addClass('lda-noprint');
            // "this" are the elements we want to print, so we clone them and
            // wrap them up within a <div id="lda-print" /> to hide them from
            //screen but show them on the page
        this.clone().appendTo('body').wrapAll('<div id="lda-print"></div>');
        window.print();
        // once printed, we remove the classes from cache and destroy
        // #lda-print BUT we have wait until the printer has received
        // the info so we use a timeout of two seconds before doing so
        setTimeout(function() {
            cache.removeClass('lda-noprint');
            jQuery('#lda-print').remove();
        }, 2000);
        // finally, we return "this" as normal for jQuery methods
        return this;
    }
});

/************** CAMBIAR COLORES ********************/
function cambiar_colores(
  colorFondo, colorFondoActual, colorPrimario, colorPrimarioActual, colorSecundario, colorSecundarioActual, colorFondoTablas, colorFondoTablasActual,
  colorletra1Actual, colorletra1, colorletra2Actual, colorletra2, colorletra3Actual, colorletra3, colorletra4Actual, colorletra4
  ){

  for (i =0 ; i < document.styleSheets.length ; i++) {
    estilos = (navigator.appName.indexOf("Microsoft")!=-1) ? document.styleSheets[i].rules : document.styleSheets[i].cssRules;
    for (j =0 ; j < estilos.length ; j++) {
      if (typeof estilos[j].style != 'undefined'){
        //if (typeof estilos[j].style.backgroundColor != 'undefined'){
          if (estilos[j].style.backgroundColor != "" && typeof estilos[j].style.backgroundColor != 'undefined'){
            colorRGB = toRGBHex(estilos[j].style.backgroundColor.substring(4,estilos[j].style.backgroundColor.length-1));

            if (colorFondo != "" && colorRGB == colorFondoActual) estilos[j].style.backgroundColor = colorFondo;
            if (colorFondoTablas != "" && colorRGB == colorFondoTablasActual) {
              //alert(estilos[j]+"-"+estilos[j].cssText);
              estilos[j].style.backgroundColor = colorFondoTablas;
            }
            if (colorPrimario != "" && colorRGB == colorPrimarioActual) estilos[j].style.backgroundColor = colorPrimario;
            if (colorSecundario != "" && colorRGB == colorSecundarioActual) estilos[j].style.backgroundColor = colorSecundario;
          }
          if (estilos[j].style.borderColor != ""){
            colorRGB = toRGBHex(estilos[j].style.borderColor.substring(4,estilos[j].style.borderColor.length-1));

            if (colorFondo != "" && colorRGB == colorFondoActual) estilos[j].style.borderColor = colorFondo;
            if (colorFondoTablas != "" && colorRGB == colorFondoTablasActual) estilos[j].style.borderColor = colorFondoTablas;
            if (colorPrimario != "" && colorRGB == colorPrimarioActual) estilos[j].style.borderColor = colorPrimario;
            if (colorSecundario != "" && colorRGB == colorPrimarioActual) estilos[j].style.borderColor = colorSecundario;
          }
          if (estilos[j].style.color != ""){
            colorRGB = toRGBHex(estilos[j].style.color.substring(4,estilos[j].style.color.length-1));

            if (colorPrimario != "" && colorRGB == colorPrimarioActual) estilos[j].style.color = colorPrimario;
            if (colorSecundario != "" && colorRGB == colorSecundarioActual) estilos[j].style.color = colorSecundario;

            if (colorletra1 != "" && colorRGB == colorletra1Actual) estilos[j].style.color = colorletra1;
            if (colorletra2 != "" && colorRGB == colorletra2Actual) estilos[j].style.color = colorletra2;
            if (colorletra3 != "" && colorRGB == colorletra3Actual) {estilos[j].style.color = colorletra3;}
            if (colorletra4 != "" && colorRGB == colorletra4Actual) {estilos[j].style.color = colorletra4;}
          }
        //}
      }
    }
  }
}

function toRGBHex(num)
{
  var decToHex="";
  var arr = new Array();
  var numStr = new String();
  numStr = num;

  arr = numStr.split(",");

  for(var i=0;i<3;i++)
  {
  var hexArray = new Array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F" );
  var code1 = Math.floor(arr[i] / 16);var code2 = arr[i] - code1 * 16;
  decToHex += hexArray[code1];
  decToHex += hexArray[code2];
  }
  return (decToHex);
}