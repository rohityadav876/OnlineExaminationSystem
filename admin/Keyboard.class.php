<?php

/**
 *
 * Classe qui permet de générer le code html d'un clavier visuel
 *
 * @author  Cédric Montoya / Renaud CAMPO
 * @date    19/05/2009
 * @maj     28/07/2009
 * @version 1.2
 *
 */

header("Content-type: text/html; charset=utf-8");

class Keyboard
{
  /*******************************************************************************************/
  /*  Propriétés                                                                             */
  /*******************************************************************************************/
  
  private $start_hidden;
  
  private $width;
  private $height;
  
  private $key_length;
  private $line_height;
  private $line_height_image;
  private $close_width;
  private $space_around_key;
  private $marge_around_keyboard;
  
  private $mode_inactive;
  private $majmin_inactive;
  
  private $mode;
  private $majmin;
  private $constraint;
  private $constraints = array("none", "alpha", "num", "float", "alphanum");
  
  private $zindex;
  
  private $div;  
  private $script;
  
  private $use_only_in_cs;
  private $var_name_in_cs;
  
  private $btn_chr1 = array(
                        array("btn_1", "1"),
                        array("btn_2", "2"),
                        array("btn_3", "3"),
                        array("btn_4", "4"),
                        array("btn_5", "5"),
                        array("btn_6", "6"),
                        array("btn_7", "7"),
                        array("btn_8", "8"),
                        array("btn_9", "9"),
                        array("btn_0", "0"),
                        
                        array("btn_a", "a"),
                        array("btn_z", "z"),
                        array("btn_e", "e"),
                        array("btn_r", "r"),
                        array("btn_t", "t"),
                        array("btn_y", "y"),
                        array("btn_u", "u"),
                        array("btn_i", "i"),
                        array("btn_o", "o"),
                        array("btn_p", "p"),
                        array("btn_q", "q"),
                        array("btn_s", "s"),
                        array("btn_d", "d"),
                        array("btn_f", "f"),
                        array("btn_g", "g"),
                        array("btn_h", "h"),
                        array("btn_j", "j"),
                        array("btn_k", "k"),
                        array("btn_l", "l"),
                        array("btn_m", "m"),
                        array("btn_w", "w"),
                        array("btn_x", "x"),
                        array("btn_c", "c"),
                        array("btn_v", "v"),
                        array("btn_b", "b"),
                        array("btn_n", "n"),
                        
                        array("btn_espace", "key_space.png", " ", "", "", true),
                        array("btn_point", "."),
                        array("btn_virgule", ","),
                        array("btn_slash", "/")
                      );
                      
  private $btn_chr2 = array(
                        array("btn_etcom", "&"),
                        array("btn_euro", "€"),
                        array("btn_dollar", '$'),
                        array("btn_inf", "&lt;", "<"),
                        array("btn_sup", "&gt;", ">"),
                        
                        array("btn_circ", "^"),
                        array("btn_num", "°"),
                        
                        array("btn_egal", "="),
                        array("btn_etoile", "*"),
                        array("btn_plus", "+"),
                        
                        array("btn_pouverte", "("),
                        array("btn_pfermee", ")"),
                        array("btn_couvert", "["),
                        array("btn_cferme", "]"),
                        array("btn_pipe", "|"),
                        
                        array("btn_dguillemet", "\""),
                        array("btn_pourcent", "%"),
                        array("btn_diese", "#"),
                        array("btn_antislash", "\\"),
                        array("btn_tilde", "~"),
                        
                        array("btn_ag", "à"),
                        array("btn_ac", "â"),
                        array("btn_at", "ä"),
                        array("btn_cc", "ç"),
                        array("btn_ea", "é"),
                        array("btn_eg", "è"),
                        array("btn_ec", "ê"),
                        array("btn_et", "ë"),
                        array("btn_ic", "î"),
                        array("btn_it", "ï"),
                        array("btn_oe", "œ"),
                        array("btn_oc", "ô"),
                        array("btn_ot", "ö"),
                        array("btn_ug", "ù"),
                        array("btn_uc", "û"),
                        array("btn_ut", "ü"),
                        
                        array("btn_2points", ":"),
                        array("btn_pvirgule", ";"),
                        array("btn_pointe", "!"),
                        array("btn_pointi", "?")
                      );
  
  /*******************************************************************************************/
  /*  Getters et Setters                                                                     */
  /*******************************************************************************************/
  
  function getStartHidden()
  {
    return $this->start_hidden;
  }
  function setStartHidden($start_hidden)
  {
    $this->start_hidden = $start_hidden;
  }
  
  function getWidth()
  {
    return $this->width;
  }
  function setWidth($width)
  {
    $this->width = $width;
  }
  
  function getHeight()
  {
    return $this->height;
  }
  function setHeight($height)
  {
    $this->height = $height;
  }
  
  function getKeyLength()
  {
    return $this->key_length;
  }
  function setKeyLength($key_length)
  {
    $this->key_length = $key_length;
  }
  
  function getLineHeight()
  {
    return $this->line_height;
  }
  function setLineHeight($line_height)
  {
    $this->line_height = $line_height;
  }
  
  function getLineHeightImage()
  {
    return $this->line_height_image;
  }
  function setLineHeightImage($line_height_image)
  {
    $this->line_height_image = $line_height_image;
  }
  
  function getCloseWidth()
  {
    return $this->close_width;
  }
  function setCloseWidth($close_width)
  {
    $this->close_width = $close_width;
  }
  
  function getSpaceAroundKey()
  {
    return $this->space_around_key;
  }
  function setSpaceAroundKey($space_around_key)
  {
    $this->space_around_key = $space_around_key;
  }
  
  function getMargeAroundKeyboard()
  {
    return $this->marge_around_keyboard;
  }
  function setMargeAroundKeyboard($marge_around_keyboard)
  {
    $this->marge_around_keyboard = $marge_around_keyboard;
  }
  
  function getModeInactive()
  {
    return $this->mode_inactive;
  }
  function setModeInactive($mode_inactive)
  {
    $this->mode_inactive = $mode_inactive;
  }
  
  function getMajminInactive()
  {
    return $this->majmin_inactive;
  }
  function setMajminInactive($majmin_inactive)
  {
    $this->majmin_inactive = $majmin_inactive;
  }
  
  function getMode()
  {
    return $this->mode;
  }
  function setMode($mode)
  {
    $this->mode = $mode;
  }
  
  function getMajmin()
  {
    return $this->majmin;
  }
  function setMajmin($majmin)
  {
    $this->majmin = $majmin;
  }
  
  function getConstraint()
  {
    return $this->constraint;
  }
  function setConstraint($constraint)
  {
    $this->constraint = $constraint;
  }
  
  function getConstraints()
  {
    return $this->constraints;
  }
  
  function getZindex()
  {
    return $this->zindex;
  }
  function setZindex($zindex)
  {
    $this->zindex = $zindex;
  }
  
  function getDiv()
  {
    return $this->div;
  }

  function getScript()
  {
    return $this->script;
  }
  
  function getUseOnlyInCS()
  {
    return $this->use_only_in_cs;
  }
  function setUseOnlyInCS($use_only_in_cs)
  {
    $this->use_only_in_cs = $use_only_in_cs;
  }
  
  function getVarNameInCS()
  {
    return $this->var_name_in_cs;
  }
  function setVarNameInCS($var_name_in_cs)
  {
    $this->var_name_in_cs = $var_name_in_cs;
  }
  
  function getBtnChr1()
  {
    return $this->btn_chr1;
  }
  
  function getBtnChr2()
  {
    return $this->btn_chr2;
  }
  
  /*******************************************************************************************/
  /*  Méthodes                                                                               */
  /*******************************************************************************************/

  public function __construct($start_hidden = true, $width = 915, $height = 315)
  {
    $this->start_hidden = $start_hidden;
    
    $this->width  = $width;
    $this->height = $height;
    
    $this->key_length            = 68;
    $this->line_height           = 60;
    $this->line_height_image     = 8;
    $this->close_width           = 28;
    $this->space_around_key      = 1;
    $this->marge_around_keyboard = 16;
    
    $this->mode_inactive   = false;
    $this->majmin_inactive = false;
    
    $this->mode       = 1;
    $this->majmin     = 1;
    $this->constraint = "none";
    
    $this->zindex = 10000;
    
    $this->div    = "";
    $this->script = "";
    
    $this->use_only_in_cs = false;
    $this->var_name_in_cs = "WebGenius";
  }
  
  private function buildButton($id, $value, $return, $special = "", $type = "", $is_image = false)
  {
    $style = "display:block; position:relative; text-decoration:none; margin:".$this->space_around_key."px; width:".$this->key_length."px; height:".$this->key_length."px; ".
             "cursor:pointer; ".($is_image ? "line-height:".$this->line_height."px; " : "line-height:".$this->line_height."px; ")."text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:30px;";
    
    $action = "";
    switch($special) {
      case 'majmin' :
        $action = "clickMajmin(this.name);";
        break;
      
      case 'mode' :
        $action = "clickMode(this.name);";
        break;
        
      default :
        $action = "clickButton(this.name);";
        break;
    }
    
    switch($type) {
      case 'inactive' :
        $button = "<a name='".$return."' id='".$id."' style='".$style." color:#555555; background:transparent url(./images/buttons/inactive.png) no-repeat 2px 0;'>".$value."</a>";
        break;
        
      case 'switch' :
        $button = "<a name='".$return."' id='".$id."' style='".$style." color:#000000; background:transparent url(./images/buttons/".($return == 2 ? "pressed" : "normal").".png) no-repeat 2px 0; position:relative;'".
                  " onmousedown='stopEvent(event);' onclick=\"clickToggle(this.id);".$action."\">".$value."</a>";
        break;
        
      default :
        $button = "<a name='".$return."' id='".$id."' style='".$style." color:#000000; background:transparent url(./images/buttons/normal.png) no-repeat 2px 0; position:relative;'".
                  " onmousedown='clickDown(this.id, event);' onmouseout='clickUp(this.id);' onmouseup='clickUp(this.id);' onclick=\"".$action."\">".$value."</a>";
        break;
    }
    
    return $button;
  }
  
  private function buildDiv()
  {
    $globalKey = $this->buildGlobalKey($this->constraint);
    
    $this->div = "<div id='keyboard' onmousedown=\"posCursor($(idElmFocus));\" style='display:none; z-index:".$this->zindex."; position:absolute; top:0; left:0; width:".$this->width."px; height:".$this->height."px; background:transparent url(./images/buttons/keyboard.png) no-repeat top left; cursor:move;'>\n".
                 $globalKey.
                 "</div>\n";             
  }
  
  private function buildScript()
  {
    $var_restriction = "";
    if($this->use_only_in_cs) {
      $var_restriction = "  restriction = (typeof(window.external) != 'undefined' && window.external.".$this->var_name_in_cs." && window.external.".$this->var_name_in_cs." != '' ? false : true);\n";
    }
    
    $this->script = "<script type='text/javascript'>\n".
                    "  var restriction = false;\n".
                    $var_restriction.
    
                    "  var inKeyboard = false;\n".
                    "  $('keyboard').observe('mouseover', function(event) {\n".
                    "    var elm = (event.relatedTarget ? event.relatedTarget : event.fromElement);\n".
                    "    if(elm && elm != $('keyboard') && !elm.descendantOf('keyboard')) {\n".
                    "      inKeyboard = true;\n".
                    "    }\n".
                    "  });\n".
                    "  $('keyboard').observe('mouseout', function(event) {\n".
                    "    var elm = (event.relatedTarget ? event.relatedTarget : event.toElement);\n".
                    "    if(elm && elm != $('keyboard') && !elm.descendantOf('keyboard')) {\n".
                    "      inKeyboard = false;\n".
                    "    }\n".
                    "  });\n\n".
                    
                    "  var idElmFocus = '';\n".
                    "  function saveElmId(idElm)\n".
                    "  {\n".
                    "    idElmFocus = idElm;\n".
                    "  }\n\n".
                    "  function clearElmId()\n".
                    "  {\n".
                    "    idElmFocus = '';\n".
                    "  }\n\n".
                    
                    "  var inKeyboard = false;\n".
                    "  function inKeyboard()\n".
                    "  {\n".
                    "    inKeyboard = true;\n".
                    "  }\n\n".
                    
                    "  function moveKeyboard(w, h)\n".
                    "  {\n".
                    "    $('keyboard').style.top = h + 'px';\n".
                    "    $('keyboard').style.left = w + 'px';\n".
                    "  }\n\n".
                    
                    "  var constraintElmFocus = '".$this->constraint."';\n".
                    "  function openKeyboard(idElm, constraint, w, h)\n".
                    "  {\n".
                    "    if(restriction) return;\n".
                    "    if(idElmFocus != idElm) {\n".
                    "      if(typeof(constraint) != 'undefined') {\n".
                    "        if(constraint != '' && constraint != constraintElmFocus) changeKeyboard(constraint);\n".
                    "      }\n".
                    "      if(typeof(w) != 'undefined' && typeof(h) != 'undefined') {\n".
                    "        moveKeyboard(w, h);\n".
                    "      }\n".
                    "      clickMajmin($('btn_majmin').name);\n".
                    "      if(idElm != '') saveElmId(idElm);\n".
                    "      if(!$('keyboard').visible()) $('keyboard').show();\n".
                    "    }\n".
                    "    $(idElmFocus).focus();\n".
                    "  }\n\n".
                    "  function closeKeyboard(force)\n".
                    "  {\n".
                    "    if(!inKeyboard || force) {\n".
                    "      clearElmId();\n".
                    "      $('keyboard').hide();\n".
                    "    }\n".
                    "  }\n\n".
                    
                    "  var pStart = 0;\n".
                    "  var pEnd   = 0;\n".
                    "  var oneCR  = 0;\n".
                    "  function posCursor(elm)\n".
                    "  {\n".
                    "    if(!elm || elm == '') return;\n".
                    "    var v = (typeof(elm.value) != 'undefined' ? elm.value : elm.innerHTML);\n".
                    "    if(document.selection) {\n".
                    "      elm.focus();\n".
                    "      var l = document.selection.createRange().text.length;\n".
                    "      var s = elm.createTextRange();\n".
                    "      s.moveToBookmark(document.selection.createRange().getBookmark());\n".
                    "      s.moveEnd('character', v.length);\n".
                    "      pStart = v.length - s.text.length;\n".
                    "      pEnd   = pStart + l;\n".
                    "      oneCR  = (v.charAt(pStart - 1) == '\\n' ? 1 : 0);\n".
                    "    } else {\n".
                    "      pStart = elm.selectionStart;\n".
                    "      pEnd   = elm.selectionEnd;\n".
                    "    }\n".
                    "  }\n\n".
                    
                    "  function nbCR(str)\n".
                    "  {\n".
                    "    var n = 0;\n".
                    "    var p = str.indexOf('\\r\\n');\n".
                    "    while(p > -1) {\n".
                    "      p = str.indexOf('\\r\\n', p + 2);\n".
                    "      n++;\n".
                    "    }\n".
                    "    return n;\n".
                    "  }\n\n".
                    
                    "  function clickButton(c)\n".
                    "  {\n".
                    "    if($(idElmFocus) && $(idElmFocus) != '') {\n".
                    "      var pos = pStart - oneCR - (pStart == pEnd && c == '' ? 1 : 0);\n".
                    "      var v   = (typeof($(idElmFocus).value) != 'undefined' ? $(idElmFocus).value : $(idElmFocus).innerHTML);\n".
                    "      var nbCRAvant = nbCR(v.substring(0, pos));\n".
                    "      var val = v.substring(0, pos) + (c == '#n#' ? '\\r\\n' : (c == '#q#' ? '\'' : c)) + v.substring(pEnd, v.length);\n".
                    "      if(typeof($(idElmFocus).value) != 'undefined') {\n".
                    "        $(idElmFocus).value = val;\n".
                    "      } else {\n".
                    "        $(idElmFocus).innerHTML = val;\n".
                    "      }\n".
                    "      $(idElmFocus).focus();\n".
                    "      pos += (c == '' ? 0 : (c == '#n#' || c == '#q#' ? 1 : c.length));\n".
                    "      if(document.selection) {\n".
                    "        var t = $(idElmFocus).createTextRange();\n".
                    "        t.moveStart('character', pos - nbCRAvant);\n".
                    "        t.collapse();\n".
                    "        t.select();\n".
                    "      } else {\n".
                    "        $(idElmFocus).setSelectionRange(pos, pos);\n".
                    "      }\n".
                    "      if($(idElmFocus).fireEvent) { // Spécial IE\n".
                    "        $(idElmFocus).fireEvent('onkeydown');".
                    "      } else {\n".
                    "        var evtSimulated = document.createEvent('KeyboardEvent');\n".
                    "        evtSimulated.initEvent('keydown', true, true);\n".
                    "        $(idElmFocus).dispatchEvent(evtSimulated);\n".
                    "      }\n".
                    "    }\n".
                    "  }\n\n".
                    
                    "  function clickMajmin(option)\n".
                    "  {\n".
                    "    var arr = $('mainkey').getElementsByTagName('a');\n".
                    "    var expr = new RegExp('^[a-zA-ZàâäçéèêëîïœôöùûüÀÂÄÇÉÈÊËÎÏŒÔÖÙÛÜ]+$');\n".
                    "    for(var i = 0; i < arr.length; i++) {\n".
                    "      if(expr.test(arr[i].innerHTML)) {\n".
                    "        arr[i].name = arr[i].innerHTML = (option == '1' ? arr[i].innerHTML.toLowerCase() : arr[i].innerHTML.toUpperCase());\n".
                    "      }\n".
                    "    }\n".
                    "    if($(idElmFocus) && $(idElmFocus) != '') $(idElmFocus).focus();\n".
                    "  }\n\n".
                    
                    "  function clickMode(mode)\n".
                    "  {\n".
                    "    new Ajax.Updater('mainkey', './Keyboard.class.php', { \n".
                    "      parameters: 'build=main&line_height_image=".$this->line_height_image."&mode=' + encodeURIComponent(mode),\n".
                    "      onComplete: function() {\n".
                    "        clickMajmin($('btn_majmin').name);\n".
                    "        if($(idElmFocus) && $(idElmFocus) != '') $(idElmFocus).focus();\n".
                    "      }\n".
                    "    });\n".
                    "  }\n\n".
                    
                    "  function changeKeyboard(constraint)\n".
                    "  {\n".
                    "    new Ajax.Updater('keyboard', './Keyboard.class.php', { \n".
                    "      asynchronous: false,\n".
                    "      parameters: 'build=global&width=".$this->width."&mode=' + $('btn_mode').name + '&majmin=' + $('btn_majmin').name + '&constraint=' + encodeURIComponent(constraint) + \n".
                    "                  '&line_height_image=".$this->line_height_image."&close_width=".$this->close_width."&marge_around_keyboard=".$this->marge_around_keyboard."&mode_inactive=".$this->mode_inactive."&majmin_inactive=".$this->majmin_inactive."'\n".
                    "    });\n".
                    "    constraintElmFocus = constraint;\n".
                    "  }\n\n".
                    
                    // deselect() -> inutile pour le clavier mais à conserver pour d'autres programmes
                    //   - rajouter pour IE la vérification que la sélection concerne l'élément souhaité
                    //     (car sous IE la sélection est unique et globale pour chaque page et non pas indépendante comme pour les autres navigateurs)
                    "  function deselect()\n".
                    "  {\n".
                    "    if(document.selection) {\n".
                    "      document.selection.empty();\n".
                    "    } else {\n".
                    "      window.getSelection().removeAllRanges();\n".
                    "    }\n".
                    "  }\n\n".
                    
                    "  function stopEvent(evt)\n".
                    "  {\n".
                    "    Event.stop(evt);\n".
                    "  }\n\n".
                    
                    "  function clickUp(idKey)\n".
                    "  {\n".
                    "    $(idKey).style.backgroundImage = 'url(./images/buttons/normal.png)';\n".
                    "  }\n\n".
                    "  function clickDown(idKey, evt)\n".
                    "  {\n".
                    "    if(typeof(evt) != 'undefined') stopEvent(evt);\n".
                    "    $(idKey).style.backgroundImage = 'url(./images/buttons/pressed.png)';\n".
                    "    posCursor($(idElmFocus));\n".
                    "  }\n\n".
                    "  function clickToggle(idKey)\n".
                    "  {\n".
                    "    expr = new RegExp('normal')\n".
                    "    if(expr.test($(idKey).style.backgroundImage)) {\n".
                    "      clickDown(idKey);\n".
                    "    } else {\n".
                    "      clickUp(idKey);\n".
                    "    }\n".
                    "    $(idKey).name = ($(idKey).name == '1' ? '2' : '1');\n".
                    "  }\n\n".
                    
                    "  new Draggable('keyboard', {\n".
                    "    zindex: ".$this->zindex.",\n".
                    "    starteffect: function() { new Effect.Opacity('keyboard', { from: 1 }); },\n".
                    "    endeffect: function() { new Effect.Opacity('keyboard', { from: 1 }); },\n".
                    "    onEnd: function() {\n".
                    "      if(document.selection && $(idElmFocus) && $(idElmFocus) != '') {\n".
                    "        var l = (typeof($(idElmFocus).value) != 'undefined' ? $(idElmFocus).value.length : $(idElmFocus).innerHTML.length);\n".
                    "        $(idElmFocus).focus();\n".
                    "        var t = $(idElmFocus).createTextRange();\n".
                    "        t.moveStart('character', pStart);\n".
                    "        t.moveEnd('character', pEnd - l);\n".
                    "        t.select();\n".
                    "      }\n".
                    "    }\n".
                    "  });\n\n".
                    
                    "  var hBase = document.documentElement.clientHeight - ".$this->height." - 10;\n".
                    "  var wBase = Math.round((document.documentElement.clientWidth - ".$this->width.") / 2);\n".
                    ($this->start_hidden ? "  moveKeyboard(wBase, hBase);" : "  openKeyboard('', '', wBase, hBase);\n").
                    "</script>\n";
  }
  
  public function buildGlobalKey()
  {
    $lnk_fermer = "<a id='btn_close' href='javascript:void(0);' title='Fermer' onclick='closeKeyboard(true);' onmousedown='stopEvent(event);'".
                  " style='position:absolute; top:".$this->marge_around_keyboard."px; left:".($this->width - $this->close_width - $this->marge_around_keyboard - 2 * $this->space_around_key)."px; margin:".$this->space_around_key."; outline:0;'>".
                    "<img src='./images/buttons/close.png' alt='Fermer' border=0 />".
                  "</a>\n";
    
    $btn_guillemet = $this->buildButton("btn_guillemet", "'", "#q#");
    $btn_arobase   = $this->buildButton("btn_arobase", "@", "@");
    $btn_trait     = $this->buildButton("btn_trait", "-", "-");
    $btn_unders    = $this->buildButton("btn_unders", "_", "_");
    
    $btn_majmin = $this->buildButton("btn_majmin", "<img src='./images/buttons/key_capslock.png' style='margin-top:".$this->line_height_image."px; border:0;' />", ($this->majmin_inactive ? "1" : $this->majmin), ($this->majmin_inactive ? "" : "majmin"), ($this->majmin_inactive ? "inactive" : "switch"), true);
    $btn_mode   = $this->buildButton("btn_mode", "<img src='./images/buttons/key_symbole.png' style='margin-top:".$this->line_height_image."px; border:0;' />", ($this->mode_inactive ? "1" : $this->mode), ($this->mode_inactive ? "" : "mode"), ($this->mode_inactive ? "inactive" : "switch"), true);
    $btn_suppr  = $this->buildButton("btn_suppr", "<img src='./images/buttons/key_return.png' style='margin-top:".$this->line_height_image."px; border:0;' />", "", "", "", true);
    $btn_entree = $this->buildButton("btn_entree", "<img src='./images/buttons/key_enter.png' style='margin-top:".$this->line_height_image."px; border:0;' />", "#n#", "", "", true);
    
    if(in_array($this->constraint, $this->constraints) && $this->constraint != "none") {
      $btn_guillemet = $this->buildButton("btn_guillemet", "'", "#q#", "", "inactive");
      $btn_arobase   = $this->buildButton("btn_arobase", "@", "@", "", "inactive");
      $btn_trait     = $this->buildButton("btn_trait", "-", "-", "", "inactive");
      $btn_unders    = $this->buildButton("btn_unders", "_", "_", "", "inactive");
      
      $btn_entree = $this->buildButton("btn_entree", "<img src='./images/buttons/key_enter.png' style='margin-top:".$this->line_height_image."px; border:0;' />", "#n#", "", "inactive", true);
      $btn_mode   = $this->buildButton("btn_mode", "<img src='./images/buttons/key_symbole.png' style='margin-top:".$this->line_height_image."px; border:0;' />", "1", "", "inactive", true);
      
      if(in_array($this->constraint, array("num","float"))) {
        $btn_majmin = $this->buildButton("btn_majmin", "<img src='./images/buttons/key_capslock.png' style='margin-top:".$this->line_height_image."px; border:0;' />", "1", "", "inactive", true);
      }
    }
    
    $key = $this->buildMainKey();
    
    return $lnk_fermer.
           "<table cellspacing=0 cellpadding=0 style='position:absolute; top:".$this->marge_around_keyboard."px; left:".$this->marge_around_keyboard."px;'>\n".
           "  <tr><td>".$btn_guillemet."</td><td rowspan=4 id='mainkey'>".$key."</td><td>".$btn_suppr."</td></tr>\n".
           "  <tr><td>".$btn_arobase."</td><td>".$btn_trait."</td></tr>\n".
           "  <tr><td>".$btn_majmin."</td><td>".$btn_unders."</td></tr>\n".
           "  <tr><td>".$btn_mode."</td><td>".$btn_entree."</td></tr>\n".
           "</table>\n";
  }
  
  public function buildMainKey()
  {
    $reg = "";
    $arr = array();
    switch($this->constraint) {
      case "alpha" :
        $reg = "^[[:alpha:]]$";
        $arr = $this->btn_chr1;
        break;
      
      case "num" :
        $reg = "^[[:digit:]]$";
        $arr = $this->btn_chr1;
        break;
      
      case "float" :
        $reg = "^[[:digit:]]|,$";
        $arr = $this->btn_chr1;
        break;
      
      case "alphanum" :
        $reg = "^[[:alnum:]]$";
        $arr = $this->btn_chr1;
        break;
        
      default :
        $arr = $this->{"btn_chr".($this->mode_inactive ? "1" : $this->mode)};
        break;
    }
    
    $main_key = "<table cellspacing=0 cellpadding=0>\n  <tr>";
    
    $i = 0;
    foreach($arr as $r) {
      if($i != 0 && $i % 10 == 0) {
        $main_key .= "</tr>\n  <tr>";
      }
      
      if($reg != "" && !eregi($reg, (isset($r[2]) ? $r[2] : $r[1]))) {
        if(isset($r[5])) {
          $main_key .= "<td>".$this->buildButton($r[0], "<img src='./images/buttons/".$r[1]."' style='margin-top:".$this->line_height_image."px; border:0;' />", $r[2], "", "inactive", $r[5])."</td>";
        } else {
          $main_key .= "<td>".$this->buildButton($r[0], $r[1], (isset($r[2]) ? $r[2] : $r[1]), "", "inactive")."</td>";
        }
      } else {
        if(isset($r[5])) {
          $main_key .= "<td>".$this->buildButton($r[0], "<img src='./images/buttons/".$r[1]."' style='margin-top:".$this->line_height_image."px; border:0;' />", $r[2], "", "", $r[5])."</td>";
        } else {
          $main_key .= "<td>".$this->buildButton($r[0], $r[1], (isset($r[2]) ? $r[2] : $r[1]))."</td>";
        }
      }
      
      $i++;
    }
    
    return $main_key."</tr>\n</table>";
  }
  
  public function draw()
  {
    $this->buildDiv();
    $this->buildScript();
    
    return $this->div."\n".$this->script;
  }
}

if(isset($_POST['build'])) {
  if($_POST['build'] == "main") {
    $clavier = new Keyboard();
    
    $clavier->setMode($_POST['mode']);
    $clavier->setLineHeightImage($_POST['line_height_image']);
    
    // Inutile car on considère que si on peut changer de mode
    // c'est que le clavier peut afficher toutes les touches
    //$clavier->setConstraint($_POST['constraint']);
    
    echo $clavier->buildMainKey();
  } else if($_POST['build'] == "global") {
    $clavier = new Keyboard();
    
    $clavier->setWidth($_POST['width']);
    
    $clavier->setMode($_POST['mode']);
    $clavier->setMajmin($_POST['majmin']);
    $clavier->setConstraint($_POST['constraint']);
    
    $clavier->setLineHeightImage($_POST['line_height_image']);
    $clavier->setCloseWidth($_POST['close_width']);
    $clavier->setMargeAroundKeyboard($_POST['marge_around_keyboard']);
    
    $clavier->setModeInactive($_POST['mode_inactive']);
    $clavier->setMajminInactive($_POST['majmin_inactive']);
    
    echo $clavier->buildGlobalKey();
  }
}

?>