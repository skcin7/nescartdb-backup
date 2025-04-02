<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.17.1
*/$ca="4.17.1";function
adminer_errors($cc,$dc){return!!preg_match('~^(Trying to access array offset on( value of type)? null|Undefined (array key|property))~',$dc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$sc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($sc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$yg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($yg)$$X=$yg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$h;return$h;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($t){if(!preg_match('~^[`\'"[]~',$t))return$t;$wd=substr($t,-1);return
str_replace($wd.$wd,$wd,substr($t,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Le,$sc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($Le)){foreach($X
as$od=>$W){unset($Le[$x][$od]);if(is_array($W)){$Le[$x][stripslashes($od)]=$W;$Le[]=&$Le[$x][stripslashes($od)];}else$Le[$x][stripslashes($od)]=($sc?$W:stripslashes($W));}}}}function
bracket_escape($t,$Fa=false){static$jg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($Fa?array_flip($jg):$jg));}function
min_version($Jg,$Gd="",$i=null){global$h;if(!$i)$i=$h;$tf=$i->server_info;if($Gd&&preg_match('~([\d.]+)-MariaDB~',$tf,$_)){$tf=$_[1];$Jg=$Gd;}return$Jg&&version_compare($tf,$Jg)>=0;}function
charset($h){return(min_version("5.5.3",0,$h)?"utf8mb4":"utf8");}function
script($Bf,$ig="\n"){return"<script".nonce().">$Bf</script>$ig";}function
script_src($Cg){return"<script src='".h($Cg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($A,$Y,$Ua,$sd="",$he="",$Xa="",$td=""){$G="<input type='checkbox' name='$A' value='".h($Y)."'".($Ua?" checked":"").($td?" aria-labelledby='$td'":"").">".($he?script("qsl('input').onclick = function () { $he };",""):"");return($sd!=""||$Xa?"<label".($Xa?" class='$Xa'":"").">$G".h($sd)."</label>":$G);}function
optionlist($B,$mf=null,$Fg=false){$G="";foreach($B
as$od=>$W){$me=array($od=>$W);if(is_array($W)){$G.='<optgroup label="'.h($od).'">';$me=$W;}foreach($me
as$x=>$X)$G.='<option'.($Fg||is_string($x)?' value="'.h($x).'"':'').($mf!==null&&($Fg||is_string($x)?(string)$x:$X)===$mf?' selected':'').'>'.h($X);if(is_array($W))$G.='</optgroup>';}return$G;}function
html_select($A,$B,$Y="",$ge=true,$td=""){if($ge)return"<select name='".h($A)."'".($td?" aria-labelledby='$td'":"").">".optionlist($B,$Y)."</select>".(is_string($ge)?script("qsl('select').onchange = function () { $ge };",""):"");$G="";foreach($B
as$x=>$X)$G.="<label><input type='radio' name='".h($A)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$G;}function
confirm($Od="",$nf="qsl('input')"){return
script("$nf.onclick = function () { return confirm('".($Od?js_escape($Od):lang(0))."'); };","");}function
print_fieldset($Wc,$yd,$Mg=false){echo"<fieldset><legend>","<a href='#fieldset-$Wc'>$yd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$Wc');",""),"</legend>","<div id='fieldset-$Wc'".($Mg?"":" class='hidden'").">\n";}function
bold($Ma,$Xa=""){return($Ma?" class='active $Xa'":($Xa?" class='$Xa'":""));}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
ini_bool($fd){$X=ini_get($fd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$G;if($G===null)$G=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$G;}function
set_password($Ig,$L,$V,$D){$_SESSION["pwds"][$Ig][$L][$V]=($_COOKIE["adminer_key"]&&is_string($D)?array(encrypt_string($D,$_COOKIE["adminer_key"])):$D);}function
get_password(){$G=get_session("pwds");if(is_array($G))$G=($_COOKIE["adminer_key"]?decrypt_string($G[0],$_COOKIE["adminer_key"]):false);return$G;}function
q($P){global$h;return$h->quote($P);}function
get_vals($E,$e=0){global$h;$G=array();$F=$h->query($E);if(is_object($F)){while($H=$F->fetch_row())$G[]=$H[$e];}return$G;}function
get_key_vals($E,$i=null,$wf=true){global$h;if(!is_object($i))$i=$h;$G=array();$F=$i->query($E);if(is_object($F)){while($H=$F->fetch_row()){if($wf)$G[$H[0]]=$H[1];else$G[]=$H[0];}}return$G;}function
get_rows($E,$i=null,$n="<p class='error'>"){global$h;$kb=(is_object($i)?$i:$h);$G=array();$F=$kb->query($E);if(is_object($F)){while($H=$F->fetch_assoc())$G[]=$H;}elseif(!$F&&!is_object($i)&&$n&&(defined("PAGE_HEADER")||$n=="-- "))echo$n.error()."\n";return$G;}function
unique_array($H,$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$G=array();foreach($u["columns"]as$x){if(!isset($H[$x]))continue
2;$G[$x]=$H[$x];}return$G;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$_))return$_[1].idf_escape(idf_unescape($_[2])).$_[3];return
idf_escape($x);}function
where($Z,$p=array()){global$h,$w;$G=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$e=escape_key($x);$G[]=$e.($w=="sql"&&$p[$x]["type"]=="json"?" = CAST(".q($X)." AS JSON)":($w=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($w=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$x],q($X)))));if($w=="sql"&&preg_match('~char|text~',$p[$x]["type"])&&preg_match("~[^ -@]~",$X))$G[]="$e = ".q($X)." COLLATE ".charset($h)."_bin";}foreach((array)$Z["null"]as$x)$G[]=escape_key($x)." IS NULL";return
implode(" AND ",$G);}function
where_check($X,$p=array()){parse_str($X,$Sa);remove_slashes(array(&$Sa));return
where($Sa,$p);}function
where_link($s,$e,$Y,$je="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$je:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$J=array()){$G="";foreach($f
as$x=>$X){if($J&&!in_array(idf_escape($x),$J))continue;$ya=convert_field($p[$x]);if($ya)$G.=", $ya AS ".idf_escape($x);}return$G;}function
cookie($A,$Y,$Ad=2592000){global$aa;return
header("Set-Cookie: $A=".urlencode($Y).($Ad?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ad)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($yc=false){$Eg=ini_bool("session.use_cookies");if(!$Eg||$yc){session_write_close();if($Eg&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ig,$L,$V,$l=null){global$Mb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Mb))."|username|".($l!==null?"db|":"").session_name()),$_);return"$_[1]?".(sid()?SID."&":"").($Ig!="server"||$L!=""?urlencode($Ig)."=".urlencode($L)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($_[2]?"&$_[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Cd,$Od=null){if($Od!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Cd!==null?$Cd:$_SERVER["REQUEST_URI"]))][]=$Od;}if($Cd!==null){if($Cd=="")$Cd=".";header("Location: $Cd");exit;}}function
query_redirect($E,$Cd,$Od,$Te=true,$hc=true,$mc=false,$Yf=""){global$h,$n,$b;if($hc){$Hf=microtime(true);$mc=!$h->query($E);$Yf=format_time($Hf);}$Ef="";if($E)$Ef=$b->messageQuery($E,$Yf,$mc);if($mc){$n=error().$Ef.script("messagesPrint();");return
false;}if($Te)redirect($Cd,$Od.$Ef);return
true;}function
queries($E){global$h;static$Oe=array();static$Hf;if(!$Hf)$Hf=microtime(true);if($E===null)return
array(implode("\n",$Oe),format_time($Hf));$Oe[]=(preg_match('~;$~',$E)?"DELIMITER ;;\n$E;\nDELIMITER ":$E).";";return$h->query($E);}function
apply_queries($E,$S,$ec='table'){foreach($S
as$Q){if(!queries("$E ".$ec($Q)))return
false;}return
true;}function
queries_redirect($Cd,$Od,$Te){list($Oe,$Yf)=queries(null);return
query_redirect($Oe,$Cd,$Od,$Te,false,!$Te,$Yf);}function
format_time($Hf){return
lang(1,max(0,microtime(true)-$Hf));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($xe=""){return
substr(preg_replace("~(?<=[?&])($xe".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($C,$yb){return" ".($C==$yb?$C+1:'<a href="'.h(remove_from_uri("page").($C?"&page=$C".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($C+1)."</a>");}function
get_file($x,$Bb=false){$qc=$_FILES[$x];if(!$qc)return
null;foreach($qc
as$x=>$X)$qc[$x]=(array)$X;$G='';foreach($qc["error"]as$x=>$n){if($n)return$n;$A=$qc["name"][$x];$fg=$qc["tmp_name"][$x];$pb=file_get_contents($Bb&&preg_match('~\.gz$~',$A)?"compress.zlib://$fg":$fg);if($Bb){$Hf=substr($pb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Hf,$Ue))$pb=iconv("utf-16","utf-8",$pb);elseif($Hf=="\xEF\xBB\xBF")$pb=substr($pb,3);$G.=$pb."\n\n";}else$G.=$pb;}return$G;}function
upload_error($n){$Ld=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?lang(2).($Ld?" ".lang(3,$Ld):""):lang(4));}function
repeat_pattern($Ae,$zd){return
str_repeat("$Ae{0,65535}",$zd/65535)."$Ae{0,".($zd%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$zd=80,$Mf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$zd).")($)?)u",$P,$_))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$zd).")($)?)",$P,$_);return
h($_[1]).$Mf.(isset($_[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Le,$Zc=array(),$Ge=''){$G=false;foreach($Le
as$x=>$X){if(!in_array($x,$Zc)){if(is_array($X))hidden_fields($X,array(),$x);else{$G=true;echo'<input type="hidden" name="'.h($Ge?$Ge."[$x]":$x).'" value="'.h($X).'">';}}}return$G;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$nc=false){$G=table_status($Q,$nc);return($G?$G:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$G=array();foreach($b->foreignKeys($Q)as$Bc){foreach($Bc["source"]as$X)$G[$X][]=$Bc;}return$G;}function
enum_input($T,$Aa,$o,$Y,$Xb=null){global$b,$w;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Id);$G=($Xb!==null?"<label><input type='$T'$Aa value='$Xb'".((is_array($Y)?in_array($Xb,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Id[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$G.=" <label><input type='$T'$Aa value='".($w=="sql"?$s+1:h($X))."'".($Ua?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$G;}function
input($o,$Y,$r){global$U,$Jf,$b,$w;$A=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$wa=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$wa[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$wa);$r="json";}$Ze=($w=="mssql"&&$o["auto_increment"]);if($Ze&&!$_POST["save"])$r=null;$Hc=(isset($_GET["select"])||$Ze?array("orig"=>lang(8)):array())+$b->editFunctions($o);$Jb=stripos($o["default"],"GENERATED ALWAYS AS ")===0?" disabled=''":"";$Aa=" name='fields[$A]'$Jb";if($w=="pgsql"&&in_array($o["type"],(array)$Jf[lang(9)])){$ac=get_vals("SELECT enumlabel FROM pg_enum WHERE enumtypid = ".$U[$o["type"]]." ORDER BY enumsortorder");if($ac){$o["type"]="enum";$o["length"]="'".implode("','",array_map('addslashes',$ac))."'";}}if($o["type"]=="enum")echo
h($Hc[""])."<td>".$b->editInput($_GET["edit"],$o,$Aa,$Y);else{$Oc=(in_array($r,$Hc)||isset($Hc[$r]));echo(count($Hc)>1?"<select name='function[$A]'$Jb>".optionlist($Hc,$r===null||$Oc?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Hc))).'<td>';$hd=$b->editInput($_GET["edit"],$o,$Aa,$Y);if($hd!="")echo$hd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Aa value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Aa value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Id);foreach($Id[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ua=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$A][$s]' value='".(1<<$s)."'".($Ua?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$A'>";elseif(($Uf=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($Uf&&$w!="sqlite")$Aa.=" cols='50' rows='12'";else{$I=min(12,substr_count($Y,"\n")+1);$Aa.=" cols='30' rows='$I'".($I==1?" style='height: 1.2em;'":"");}echo"<textarea$Aa>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Aa cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Nd=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$_)?((preg_match("~binary~",$o["type"])?2:1)*$_[1]+($_[3]?1:0)+($_[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($w=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Nd+=7;echo"<input".((!$Oc||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Nd?" data-maxlength='$Nd'":"").(preg_match('~char|binary~',$o["type"])&&$Nd>20?" size='40'":"")."$Aa>";}echo$b->editHint($_GET["edit"],$o,$Y);$tc=0;foreach($Hc
as$x=>$X){if($x===""||!$X)break;$tc++;}if($tc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $tc), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;if(stripos($o["default"],"GENERATED ALWAYS AS ")===0)return
null;$t=bracket_escape($o["field"]);$r=$_POST["function"][$t];$Y=$_POST["fields"][$t];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$qc=get_file("fields-$t");if(!is_string($qc))return
false;return$m->quoteBinary($qc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$G=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$A=bracket_escape($x,1);$G[$A]=array("field"=>$A,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$m->primary),);}return$G;}function
search_tables(){global$b,$h;$_GET["where"][0]["val"]=$_POST["query"];$pf="<ul>\n";foreach(table_status('',true)as$Q=>$R){$A=$b->tableName($R);if(isset($R["Engine"])&&$A!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$F=$h->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$F||$F->fetch_row()){$Je="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$A</a>";echo"$pf<li>".($F?$Je:"<p class='error'>$Je: ".error())."\n";$pf="";}}}echo($pf?"<p class='message'>".lang(10):"</ul>")."\n";}function
dump_headers($Xc,$Sd=false){global$b;$G=$b->dumpHeaders($Xc,$Sd);$te=$_POST["output"];if($te!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Xc).".$G".($te!="file"&&preg_match('~^[0-9a-z]+$~',$te)?".$te":""));session_write_close();ob_flush();flush();return$G;}function
dump_csv($H){foreach($H
as$x=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$H[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$H)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$G=ini_get("upload_tmp_dir");if(!$G){if(function_exists('sys_get_temp_dir'))$G=sys_get_temp_dir();else{$q=@tempnam("","");if(!$q)return
false;$G=dirname($q);unlink($q);}}return$G;}function
file_open_lock($q){$Fc=@fopen($q,"r+");if(!$Fc){$Fc=@fopen($q,"w");if(!$Fc)return;chmod($q,0660);}flock($Fc,LOCK_EX);return$Fc;}function
file_write_unlock($Fc,$zb){rewind($Fc);fwrite($Fc,$zb);ftruncate($Fc,strlen($zb));flock($Fc,LOCK_UN);fclose($Fc);}function
password_file($tb){$q=get_temp_dir()."/adminer.key";$G=@file_get_contents($q);if($G||!$tb)return$G;$Fc=@fopen($q,"w");if($Fc){chmod($q,0660);$G=rand_string();fwrite($Fc,$G);fclose($Fc);}return$G;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$o,$Wf){global$b;if(is_array($X)){$G="";foreach($X
as$od=>$W)$G.="<tr>".($X!=array_values($X)?"<th>".h($od):"")."<td>".select_value($W,$z,$o,$Wf);return"<table>$G</table>";}if(!$z)$z=$b->selectLink($X,$o);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$G=$b->editVal($X,$o);if($G!==null){if(!is_utf8($G))$G="\0";elseif($Wf!=""&&is_shortable($o))$G=shorten_utf8($G,max(0,+$Wf));else$G=h($G);}return$b->selectVal($G,$z,$o,$X);}function
is_mail($Ub){$za='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Lb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Ae="$za+(\\.$za+)*@($Lb?\\.)+$Lb";return
is_string($Ub)&&preg_match("(^$Ae(,\\s*$Ae)*\$)i",$Ub);}function
is_url($P){$Lb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Lb?\\.)+$Lb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($Q,$Z,$ld,$Ic){global$w;$E=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ld&&($w=="sql"||count($Ic)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Ic).")$E":"SELECT COUNT(*)".($ld?" FROM (SELECT 1$E GROUP BY ".implode(", ",$Ic).") x":$E));}function
slow_query($E){global$b,$hg,$m;$l=$b->database();$Zf=$b->queryTimeout();$zf=$m->slowQuery($E,$Zf);if(!$zf&&support("kill")&&is_object($i=connect())&&($l==""||$i->select_db($l))){$rd=$i->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$rd,'&token=',$hg,'\');
}, ',1000*$Zf,');
</script>
';}else$i=null;ob_flush();flush();$G=@get_key_vals(($zf?$zf:$E),$i,false);if($i){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$G;}function
get_token(){$Re=rand(1,1e6);return($Re^$_SESSION["token"]).":$Re";}function
verify_token(){list($hg,$Re)=explode(":",$_POST["token"]);return($Re^$_SESSION["token"])==$hg;}function
lzw_decompress($Ka){$Ib=256;$La=8;$Za=array();$bf=0;$cf=0;for($s=0;$s<strlen($Ka);$s++){$bf=($bf<<8)+ord($Ka[$s]);$cf+=8;if($cf>=$La){$cf-=$La;$Za[]=$bf>>$cf;$bf&=(1<<$cf)-1;$Ib++;if($Ib>>$La)$La++;}}$Hb=range("\0","\xFF");$G="";foreach($Za
as$s=>$Ya){$Tb=$Hb[$Ya];if(!isset($Tb))$Tb=$Vg.$Vg[0];$G.=$Tb;if($s)$Hb[]=$Vg.$Tb[0];$Vg=$Tb;}return$G;}function
on_help($fb,$xf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $fb, $xf) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$p,$H,$Ag){global$b,$w,$hg,$n;$Qf=$b->tableName(table_status1($Q,true));page_header(($Ag?lang(11):lang(12)),$n,array("select"=>array($Q,$Qf)),$Qf);$b->editRowPrint($Q,$p,$H,$Ag);if($H===false){echo"<p class='error'>".lang(13)."\n";return;}echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".lang(14)."\n";else{echo"<table class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$A=>$o){echo"<tr><th>".$b->fieldName($o);$Cb=$_GET["set"][bracket_escape($A)];if($Cb===null){$Cb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Cb,$Ue))$Cb=$Ue[1];}$Y=($H!==null?($H[$A]!=""&&$w=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($H[$A])?array_sum($H[$A]):+$H[$A]):(is_bool($H[$A])?+$H[$A]:$H[$A])):(!$Ag&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Cb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$A]:($Ag&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ag&&$Y==$o["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}if($o["type"]=="uuid"&&$Y=="uuid()"){$Y="";$r="uuid";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(15)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ag?lang(16):lang(17))."' title='Ctrl+Shift+Enter'>\n",($Ag?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(18)."…', this); };"):"");}}echo($Ag?"<input type='submit' name='delete' value='".lang(19)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$hg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7�����i2\r�1��-�H������GF#a��;:O�!�r0���t~�f�':��h�B�'c͔�:6T\rc�A�zrc�XK�g+��Z�Xk���v��M7����7_�\"��)�����{���}��ƣ���-4N�}:�rf�K)�b{�H(Ɠєt1�)t�}F�p0��8�\\82�D�>��N�Cy��8\0惫\0F��>���(�3�	\n�9)�`v�-Ao\r��&���X������n������*A\0`A�\0��q\0oC��=σ��\r��\\��#{����Ȍ�2��R�;0dBHL+�H�,�!oR�>��N�A�|\"�Kɼ�0�Pb�Jd^�ȑ�d��Р�=<���:J#�¶�ڮ��a�Б��>�Te�F�k�j�#�K6#��9�ET��1K��Ŵ��+C�F�I�	(��L|���jP��pf��EuLQG���Z����2�Υ�2�!sk[:�1�k���6%�Ypkf+W[޷\rr�L1���\0ҝ��8�=�c��T.���-�~����#sO��vG�+�y�O{�J�9C�O��ײ|`�+(�M�r\r�O�5\n�4��8��(	�-l�Cj�2[r5yK�y�)�¬�+A�k������2�g߳3iĔ���HS>��W��<�f�}���jfMiBϹ��84u�L��ZCI\$�2P�\r��߅\"+�2�n-�~C�24����:��2��,��:�ܑ�gcwGҨ��ǃ����h�V���] \\����6`�R�4=#x�^�1��\0�P�م��:�-�8�o��~�o�v>ƣmط�����'��|����C��<�������:G)M&W�YQQi=��\\[ya\r����B�e�\\��B���7Ne}:��l���k\$44r�q}\rP���ALa�C5�s��m\r����Y���έ&��(� � ��\n�\$�jE%�^qx\r����hW�0FuR�m�J:��z@:r�j7F5,wr��\n' ��iP|>�8�W�fm2 9H�@�\$M�\$qX�Թ!��\r��9�0ΣR�:\"��7D� ���r�0�uĢ�܌Jꉼ��FF�<��P�Y�e��^)	8n�Lo2Eʔ�\r�1�伸˩�Cf�,q]N\0�8d8b*4�J���\\Mͺ��4�Hl���R�d̯!a�J	��.�e�5ˀ��I0ђQ\nC��Q.n^���0I������F���7<R3woMѦweD���4�b7+���F���>g�6�4Jj�`�t!�F���x�;��m����d8o�7B�j]�=Sj�¨�*��0A�;���R���QFD1��\"O��n�ɼ�Ϩ4Ê�4e���q\nK�*;9H��9@�Չ#ƹ'�Y���S�cl�an�.Ͷk:h�\$���9����d9�\r��1�P��qʃDy%���sba�Ɵ���ʜ\r����Z�RH���_%\0@S�������w��77ER��jw��M�P��2@\n.�a�W~����JH,��n��J��`o����@zõoN|�L�ڨVK �x	u��3*�qK��`�]����AG���iU����a��ȳ�Qre\$[W\"@b��ĸU�\r���=.E�E�\0��}r��DH�\"Imǌ���utϮGP�P�̗8�\0p�D �;��V�s���(�#���R�uʖ�\$��˖\0c�E��B�\n̎g��\0004��	+�އ��2c��n�f!>��ǟ3�]�J35|G�tTaU �Hi'�K���Zg��	�#����iV��υ���4TW���\0�\"1�ݕQ�Ժ�_>�}��>Q�qr��m�V�!<��d��������9S��,v����'�u��ykb]p���M�y�I��[&���\\���9Gv��i���u7��E��k�^[�%A�a;�H#t,�k�[���Xݑ��5Q^y�I}ۧ�U�(b\rex�%K����\\��œ���+!Y�_�)�e�F`�[[nZ��=�wn��_�\$+\$��#F�Fj��ic̕l��k���6[�Y���m����t\rQ�x��W%�A�z�@������t\r��4\"n�,�4��C�fa�|����va�G��tż���ń�t\$?�Y9�������Ht���y0G�O��(���������<����G�W����j���W�R/��_'� \\z%>j����{���Zs����?����������e�V/�@�0:�h����.�F�Q��4j^/g�]`�	F=n�&�&&��je @p� �����On����H��X*+�5J���\n�����P�uf&�KZ�O��O��̌���PX�f�l(����@ړ����������pH{/��d�K��0����P�������&��&�|�\0οPd�&���NL�M��P��m�	������NU*)h��E�ER��@�	�");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO�G#�X�VC��s��Z1.�hp8,�[�H�~Cz���2�l�c3���s���I�b�4\n�F8T��I���U*fz��r0�E����y���f�Y.:��I��(�c��΋!�_l��^�^(��N{S��)r�q�Y��l٦3�3�\n�+G���y���i���xV3w�uh�^r����a۔���c��\r���(.��Ch�<\r)�ѣ�`�7���43'm5���\n�P�:2�P����q ���C�}ī�����38�B�0�hR��r(�0��b\\0�Hr44��B�!�p�\$�rZZ�2܉.Ƀ(\\�5�|\nC(�\"��P���.��N�RT�Γ��>�HN��8HP�\\�7Jp~���2%��OC�1�.��C8·H��*�j����S(�/��6KU����<2�pOI���`���ⳈdO�H��5�-��4��pX25-Ң�ۈ�z7��\"(�P�\\32:]U����߅!]�<�A�ۤ���iڰ�l\r�\0v��#J8��wm��ɤ�<�ɠ��%m;p#�`X�D���iZ��N0����9��占��`��wJ�D��2�9t��*��y��NiIh\\9����:����xﭵyl*�Ȉ��Y�����8�W��?���ޛ3���!\"6�n[��\r�*\$�Ƨ�nzx�9\r�|*3ףp�ﻶ�:(p\\;��mz���9����8N���j2����\r�H�H&��(�z��7i�k� ����c��e���t���2:SH�Ƞ�/)�x�@��t�ri9����8����yҷ���V�+^Wڦ��kZ�Y�l�ʣ���4��Ƌ������\\E�{�7\0�p���D��i�-T����0l�%=���˃9(�5�\n\n�n,4�\0�a}܃.��Rs\02B\\�b1�S�\0003,�XPHJsp�d�K� CA!�2*W����2\$�+�f^\n�1����zE� Iv�\\�2��.*A���E(d���b��܄��9����Dh�&��?�H�s�Q�2�x~nÁJ�T2�&��eR���G�Q��Tw�ݑ��P���\\�)6�����sh\\3�\0R	�'\r+*;R�H�.�!�[�'~�%t< �p�K#�!�l���Le����,���&�\$	��`��CX��ӆ0֭����:M�h	�ڜG��!&3�D�<!�23��?h�J�e ��h�\r�m���Ni�������N�Hl7��v��WI�.��-�5֧ey�\rEJ\ni*�\$@�RU0,\$U�E����ªu)@(t�SJk�p!�~���d`�>��\n�;#\rp9�jɹ�]&Nc(r���TQU��S��\08n`��y�b���L�O5��,��>���x���f䴒���+��\"�I�{kM�[\r%�[	�e�a�1! ���Ԯ�F@�b)R��72��0�\nW���L�ܜҮtd�+���0wgl�0n@��ɢ�i�M��\nA�M5n�\$E�ױN��l�����%�1 A������k�r�iFB���ol,muNx-�_�֤C( ��f�l\r1p[9x(i�BҖ��zQl��8C�	��XU Tb��I�`�p+V\0��;�Cb��X�+ϒ�s��]H��[�k�x�G*�]�awn�!�6�����mS�I��K�~/�ӥ7��eeN��S�/;d�A�>}l~��� �%^�f�آpڜDE��a��t\nx=�kЎ�*d���T����j2��j��\n��� ,�e=��M84���a�j@�T�s���nf��\n�6�\rd��0���Y�'%ԓ��~	�Ҩ�<���AH�G��8���΃\$z��{���u2*��a��>�(w�K.bP�{��o��´�z�#�2�8=�8>���A,�e���+�C�x�*���-b=m���,�a��lzk���\$W�,�m�Ji�ʧ���+���0�[��.R�sK���X��ZL��2�`�(�C�vZ������\$�׹,�D?H��NxX��)��M��\$�,��*\nѣ\$<q�şh!��S����xsA!�:�K��}�������R��A2k�X�p\n<�����l���3�����VV�}�g&Yݍ!�+�;<�Y��YE3r�َ��C�o5����ճ�kk�����ۣ��t��U���)�[����}��u��l�:D��+Ϗ _o��h140���0��b�K�㬒�����lG��#��������|Ud�IK���7�^��@��O\0H��Hi�6\r����\\cg\0���2�B�*e��\n��	�zr�!�nWz&� {H��'\$X �w@�8�DGr*���HV��w8�J�\nm@�O�#P��@�Yp��öw����P\r8�X�\$X� P�d�	�Q\0Rx1\"T]\"�����	��Q����bR`M���-�RSE8Go0��	�d�B^�\0��\":�mN.�j%�@�3(�x �l ���	��W����\n�:\r\0}�@�qm;@�-���Z�g.zF�f@�\r��W��ck�� �<	�0���z'4\r�\0�jELY��(�%�\nM���D��oF�B�q��Kg��#�Z�����\"�\n��Ю��h���2-n�\"jy\"������\"��g�!,�*�T��x����P��5%L���`�L�M��@� Z@����`^Q0R%9&jv�h�X �o����G#���D��H�K¼lX���-��2hWli+�&��s'rz���(�҈��%tK�6�r��r���K�.*�,*v�bgj�#���LȮv�Z��Q\$p܏n*h���v�B����\\FJ�X%x f\$�A4K74�a#��3\n�(|�Z,�e2�l\r|�K�0����W2-m)	)��Z'%��	��7�.�*�*\0O;��C�*��\$�A;�V���(���l��t�K�.Dƛ_>�:�v�3�=d�\$R擠�Sl�7��B[�!@�]�[63zS�e>s�r�Dz��;T0�S�*�C�+o�\\\0��{D��k��z@�= ���D�4V炏ʕ*\0W���t��v��yD�-�5C��3�����D��t��!�_�U�XL�]F�Fn�F��&@%b>c��P��I�)3<�@ `�\r�55�%�/3Q��@G�5\r��ѱT���,��E�N�&j\0�h̾\$��� �353�T�B'FL���'D���U#�Lэ�Pm*Ѡ\\\r@��@�)��E��UUU�]V����`�M���RD�FV�{4�`3U4��5���#�T`�Q(�ߵq7M�*@SVM�Ģ#�~�2 մ�jl�@�\\ �.J|2�U�\\�� �v���\\b;^\0�6x�·]�^u���UL�Z��MP֙�4H�9�\$0�3�'VuT�@�KW�|���/\$J�*D��]�	X��_p���ޕ�ѥ�ղu��I�܅z䢮��r��\n��%�8��i^��U�1�5�n;I\n�R��3��QU45�5`z�ac��b�`qOt�Nu�6)�T���j��X��Re�#�J-�S@�\"U�����C�UU�8��6�-ki�/Y�� R\$�!�\rn�[6Vݭ�qՀ��.��B����cp�pps!\0�Ow\"�ngs�X�wGi�{Z\0Su*k`�Ξ�a!Qo'd �x Ca����c�!���60P�\rʂ�T�Ҝ�����,j�&�@ʃ( OA��P�T�j��Ghλb���\"%�\n�qX�z %������m~@�~�r��JnW�~ �	�]RX�F��r��xNmHp �+@�kl#��\0ˁ�v�X&��,i��d�z��\0�N��~w��������\0�Wၷ��\0�KN�m�	0��p��Bץ�'X)�`Y�e��XyI: �`dѠt�\n�('N\r��HGuK�e�\0���*3��)n3ͤ o�V�}v�����N\\��؍��1i)\".�`t�>\r��c�ߏ�f��oA��\"׭�� � OyY�F�\r�[5B�o*/t�(��%��R[<��8V��\$AM���5��9'*�X������܅�\\��\"jrD�\re���X|��^�n#�dͥl��n����M��t�~\\�͛\0��@ᛂg=�2���.�*\0�@�'9��y� �ߞ9� d�	�zq�6�]�P~\n��P�:��<����DY�:]5[[�'I���F�����\$B�<�P�P�@N�0/E�:^�D�Jw���\0�_Cdz#�zFW4(K�{�U[��{�>\0^�%�M@XSڇ�Z�SlW����wY�� ޔ\"B*R`�	�\n������QCF�*����Y�ͧe���+�H�j�\$�Q �^\0Zk`��V�B%�(X**2�ͺ������N`���| ���-�����~8Z� ƇRz2\"�	J�4�S~J�&t��e�m�V�}��N�ͳ'��r�5f.&1����j������K��m�{��`��w �!�^#5�TK���E�hq��\$��k�x|�m�:sD�d�zA�ڋ?�����[�L�ȬZ�X��:����[(!�k�X��V�y��� ���\$\0C�9�dSi�in��{�`�\n`�	��|K ��:�5���# t}x�N���{�[�)��C��FKZ�j�PFY�B�pFk��0<�@�D<JE��i0�5�����T\"��Vh�����Ň�H�WDeSs���N��\0�xD��L1���<!��\r3���qd��K3�P��y���E/`��Pz���\n���dYϼ���5X��8W��I8�w[7��`�\n@���ۻCp���P����=V\r�Z{*�q��\$ R��֓��eqЬ�+U`�B��Of*�C�L�MC��`_ ����˵O\n�T�5�&C׽�@��\\W�e&_X�_ܻ.��8�4d Yü����p\$ezA��[\$]�<]�|`,\r�ul\r5�qp�du ����������Yi@���z\n��7��;�Ȁ����ܝ7�b'�dmh��@q���Ch�+6.J��W��c��e�]��e�kZ�0�����Z_y���f�pc8&���͂��z\0�E�Ν�7�0�	��\"�\$��=����!>�怂g7B-QƐ/e&�Ƈ�6a��p\r�e3�c�NIjn-�\$*x�-WV�j��@oΏ#w�5�'O�.���M�و\0�H�C�9���-m�P��8S�v!��;gtL�5,	�#�n#��ޏ���x-7�f5`�#\"N�b��g���� �e�b���,7S���Gj��oՋF�?�T�6����m��s����-��m6��q��;�dl����0fE�8�]P'X\n���MG\0��x��\0�5�����*�#�*�1>*]ȖWs\r��,������\0�O�,q2�j��+H ��FG���E�>d@b����Iz�aR��8@7�LB����H� ��A�˳�p�p@�	�d�k�z4E�A�	���߉��WA1\"�2bGk\"�\0��d�h�RD�p�!fPs3`F���e	OkLA���C�/��a@|@���:!���ᘂ��o�T/b������lL8�Djʄ��@2���κ���EN�\"�1��zq�,\\^��)8V��q���1	�<��'4�������C!�F���4��f��t�c�����\r�m�z�*M��(��A������2�)�Pr�Ɗಈ�45	��\0Z[d�9�hY�����t1e�E�\$o`�X� ��g�Ud\0G�~DR<��hUp�y��=�T(�DZ-bH�ȏ���ya�H���lb�b(��HL��8e�sC���e�I�=D��{����]�<��a✊Q=T�\$!C�Oِ�U�G��)��Q�V�Tb\".\r��@<)�o�`�V\r0q�j�s�X��F\"*�bI�ڢ|��A� hp\\	��X�j#�b�#����O>5w�?T���;���l�1�a�c\"t5v�Į��`�x\\CM=�ib��!.�HL�m�H���Ҭ���%+���D4F�ڼ��C��[KX}P� ��>e:V�t�;�#Ѧ��&�R���ȴp�,a�˘�H�Ɯ���Dt\0�\$q����/t���~�J�����`��,㺼��]��`�%3�>ގ��@N��x1,����r�xr)�:�8������0����B�,E�A������B�0(���E��8@��n[	(���h�dD�	HR�Q��^�!� �v<� ����6����E�\"��&����V(GB��U���_���H��s�@�*BN)QH���vTG��0��h�R٥ن+�-�&T�C�?��zd\0\$�bSڡ<��܏�Q���@��P��dpO�>+�>x|�	�Me�E���R�4��k(W{�*-�G\$���	'�j\0��H����	(�љ>A%�Y���ʴ�6�v����^�K� G%2�Ed�͔<�J�#�DE{0\$�T+�2T%�#&��W2�e��\nS䧆L�c�d����h�=��|e�\"' �[���a2#%=�u�k�:6�,��K�\\��d�ȗYGr;·��=�� ���LɴX�yV��h*���O *��F����-bK*�#���:.<�RY\"EU'x3eQ�������q�@>�bK���+��o\$��mT��#�)�SB�Ŷ25���7�Bt�[*�P��3MN��&�cst\"�|nG�D�t���bA���w���1��ScH,4E��U9���uë��6B��S�(�SƦ5Q���\r��uUZ<�/�W�x\$���0�9	ͪ03��!W�|�g�͂r}z4�4\\!�&!�l5������<�`(�zC�\\A:HaN:l�qC�&���`�bn��!Q�L�X����\$I�Qj��^�\0b�ތ)�f�J�	js]G����)��P�`'s�B:��V��j{\n�Uеŏ�QN�|S�����U���m��B��\nAY�N�m�����r�UB�w���x��ԩử�Ӛ\n|��9��THc�8��9E�U!�LF� �M_�\\4�r�)��5�VH����4S\";~�uN\"�ё���\0( ");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Fc=file_open_lock(get_temp_dir()."/adminer.version");if($Fc)file_write_unlock($Fc,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$h,$m,$Mb,$Rb,$Zb,$n,$Hc,$Lc,$aa,$gd,$w,$ba,$vd,$fe,$Ce,$Jf,$Pc,$hg,$lg,$U,$_g,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$ye=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$ye[]=true;call_user_func_array('session_set_cookie_params',$ye);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$sc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$vd=array('en'=>'English','ar'=>'العربية','bg'=>'Български','bn'=>'বাংলা','bs'=>'Bosanski','ca'=>'Català','cs'=>'Čeština','da'=>'Dansk','de'=>'Deutsch','el'=>'Ελληνικά','es'=>'Español','et'=>'Eesti','fa'=>'فارسی','fi'=>'Suomi','fr'=>'Français','gl'=>'Galego','he'=>'עברית','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'日本語','ka'=>'ქართული','ko'=>'한국어','lt'=>'Lietuvių','lv'=>'Latviešu','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'Português','pt-br'=>'Português (Brazil)','ro'=>'Limba Română','ru'=>'Русский','sk'=>'Slovenčina','sl'=>'Slovenski','sr'=>'Српски','sv'=>'Svenska','ta'=>'த‌மிழ்','th'=>'ภาษาไทย','tr'=>'Türkçe','uk'=>'Українська','vi'=>'Tiếng Việt','zh'=>'简体中文','zh-tw'=>'繁體中文',);function
get_lang(){global$ba;return$ba;}function
lang($t,$ae=null){if(is_string($t)){$Ee=array_search($t,get_translations("en"));if($Ee!==false)$t=$Ee;}global$ba,$lg;$kg=($lg[$t]?$lg[$t]:$t);if(is_array($kg)){$Ee=($ae==1?0:($ba=='cs'||$ba=='sk'?($ae&&$ae<5?1:2):($ba=='fr'?(!$ae?0:1):($ba=='pl'?($ae%10>1&&$ae%10<5&&$ae/10%10!=1?1:2):($ba=='sl'?($ae%100==1?0:($ae%100==2?1:($ae%100==3||$ae%100==4?2:3))):($ba=='lt'?($ae%10==1&&$ae%100!=11?0:($ae%10>1&&$ae/10%10!=1?1:2)):($ba=='lv'?($ae%10==1&&$ae%100!=11?0:($ae?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ae%10==1&&$ae%100!=11?0:($ae%10>1&&$ae%10<5&&$ae/10%10!=1?1:2)):1))))))));$kg=$kg[$Ee];}$wa=func_get_args();array_shift($wa);$Dc=str_replace("%d","%s",$kg);if($Dc!=$kg)$wa[0]=format_number($ae);return
vsprintf($Dc,$wa);}function
switch_lang(){global$ba,$vd;echo"<form action='' method='post'>\n<div id='lang'>",lang(20).": ".html_select("lang",$vd,$ba,"this.form.submit();")," <input type='submit' value='".lang(21)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($vd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($vd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Id,PREG_SET_ORDER);foreach($Id
as$_)$qa[$_[1]]=(isset($_[3])?$_[3]:1);arsort($qa);foreach($qa
as$x=>$Ne){if(isset($vd[$x])){$ba=$x;break;}$x=preg_replace('~-.*~','',$x);if(!isset($qa[$x])&&isset($vd[$x])){$ba=$x;break;}}}$lg=$_SESSION["translations"];if($_SESSION["translations_version"]!=3122013118){$lg=array();$_SESSION["translations_version"]=3122013118;}function
get_translations($ud){switch($ud){case"en":$g="A9D�y�@s:�G�(�ff�����	��:�S���a2\"1�..L'�I��m�#�s,�K��OP#I�@%9��i4�o2ύ���,9�%�P�b2��a��r\n2�NC�(�r4��1CdH�e9,�\nH(�:Eb�9A�i:�&�y�w��{�(�'h,@p���zM�52N��D��z2�\ny3(+W���&3y��k:���\rv�c!��i��~_k3���X��L0���Srݭ���gsu8�9J�(��� ��it�A��g��<�3���((E��#��j�\r��47C�F�\r-�|�(j*���h�:-��%���m~�%�h���#��'���9\r`P�2��lSK�\0���)B����x޵\r���6�#+l#�\"�2��\0����<�`HK+K��`PH�� g2��p��c@�#���σ�����۶�R/=ơl��B36�è�5�\0�:/3ld�B✕ �ju0�̋�CRR%*R�B2�i2|�6����C�	@t&��Ц)�B��_�\"�6��\$�KO�kB��I�P���:��\"��ZV��%pK�	��\"\r���D�\0�3\r�[S5L��!�+*\r�Ԑ7(�:�c�9�è�&HnX�D��N;�Z~����F7��8_�F��<��a�뫈JN�3��ëFƉ����`�@��\r�Z|3ZO�#&X�am�2.\0x����CE 8a�^���\\�h�\n�3��P^������A���9�^0��VoA�Ҁ��Z;5�����iBT�鯖o o;�jiچ��jæ��k���wlC�ɳ[pCk�(�\"���n��A@czB���֞>2<�X�Y�����7^���զ�>�Vv�3��;��?��Z\0�\$#�Ѯ8�m�dXK��@k���1�@1� �0��k�۳���[��>	�@@PA���@@\n\n\0)\$D�e8\rA(f��<�g���3o���R�a1&n<���M��6Ͻ����O	�#gɁ2��Oppe�]�`@��Jmu奫*H@�a?����p�HBS\nA�;p�����䐳�	�I+%��2�چ���F-�S�	�O`D�ǿ��y�[�pXƄ� A1\$'�QŤi�q7%D�(v�ќ�7;���yO���gK�P��T=��\"j�\"<�/+`�ǒ~���iD��&�mOC�y�P��\rN�#Ā�I���Q	���F��:'\0��SC4�0�Ȕ�FL�>UǠ�\"�I7�\n��A�QE9��ל1Q�h�J�Js�O�7��l�c�o��}?�]��\r\n�W%\"k[Bssk�\r!�~�N	t�x�H*�@�A��6����2b���d���LbL]U����S\r	��v��dŲ�IM��)�6l�@\n��A�!sv`B���0��'iFK�|ƚ�.�c1(�Ya�!\n����* (+���N	\\�V�zoL��Od�2<q�x��\n�d��k�����QT��|�E�~��˟�O	t�ٲ�gl�c����";break;case"ar":$g="�C�P���l*�\r�,&\n�A���(J.��0Se\\�\r��b�@�0�,\nQ,l)���µ���A��j_1�C�M��e��S�\ng@�Og���X�DM�)��0��cA��n8�e*y#au4�� �Ir*:���������C#�%<U[VD��������XT\nh����1�b1Y���M7��M�Q��v2�\r����i;M�S9�� :m�!��:\r;�Ż��e\r��^k�\\B�U�eP�e2թOf��B3v�ꃥ���z�I���ߕ�	u�tl+���/��*��[f;��\0�9Cx䙈�3�0�m��7�͐�:#n�	D�09��ȧ�+�b�)L���0jrl����	��1��8�)�bx�*���+%z�Y�+d�B&�' ����Ҥ��\\�=����I�V̴ʬ�B!\0#�\n���\\Z���ycJ,¾Ff�j�\"	�?��:�=���pʻ댄W+%G#��Ҍ{� ��T̖��n�\"H�Ȃ\n?2�-�فA j���p��jlU�H��E*�vC&��^ã�Bh�K/r���d�Y��IU�:>W�1�\\��T��!�<�t�%���I`��&ʆT���^�@�Lo}@k��U���|KF�Eu	@t&��Ц)�CP���h^-�8��.��^[\\3r?c�`P���ږ��Ppݖ�*`A���(��Ø�7穝��	\nC��5M`�96#x�3\r���#.L�W�T��H\\,��B���\r��<��z:�c|9�è�\r�x���ac�9m��0��\n�ck�:��@��1��G�O��U�������A-�͘����#'7A��Ǡg�\$�[���D4���9�Ax^;��p��jМ\$3��(��y����}�Ϩ��}|��p���l����7r|A���CpQ��+IS�����Î��'E!�U���Z�+v��4;�t���xO;�g��Pry�9泷�Ϛ\0/E0��\r�my���=�^!Q�\r���\0�͈iD�=����\nx�.�@В���ȸ(	��>VB\\�h6!�1�6���n�؇�Ô*Ua�3?�B�[�un�彠زrNR#a�\0�aXi!�9�d~���*�|���`�WK�8��B1�4T�\"�!IjK+dM�6��\"��8���to*�Dm\$ߜ�<�#�y򤧲b�Ba\n<�OIiA*�&�!Ϡ�roݰsD��� ӓCppq�9��UPc\r�4�wx\"�q6!�0�V�M	9\r@�!�0���%��^�C*�)/�[|�E���qЉ�C~�I͕�d���1G��2�Q���O��V��^���2�fH�y5`�2�Vl�\r�����C��D���Qݜ�A������+�1�hD6!&\$\n�O\naP��m@L\\���&*�F��������N��@��7WF��*�mC�3+%!y(XJ\n���r�A\0P	@�ҹȃNyx���)��Q	��3Jp@n]�F\n�B�S7\r	�#��t��`��J7&����(�B(�r10�?52�J\r�(���ϒ&�I��V� �'�k�E�\$���@�K&a: �\n� ia����l��9�p�����!�3�X6�TA8\\(U\n���d��i����Q��!~�����&H�Yl[����PM����ˊ�|kI@(r�d�{n�!=\\7V�p@�\\R\0����=9\" 	���t\0L�`o�a�	!�,���{DТ����R������@�2����<�e7qVT�t+���D�-���U��o���#P�4��ƊelɊm�d";break;case"bg":$g="�P�\r�E�@4�!Awh�Z(&��~\n��fa��N�`���D��4���\"�]4\r;Ae2��a�������.a���rp��@ד�|.W.X4��FP�����\$�hR�s���}@�Зp�Д�B�4�sE�΢7f�&E�,��i�X\nFC1��l7c��MEo)_G����_<�G�R��zo:�ʢuF���C���Ea�l*:�E\r��,Z�\"(��NtV��	Q��v�m��Y�_a��ޗZ��9:xn^���S��I�C�Y�V���F������nB>�*/�\"��	��8��|ב���א0\"��Pt9�Q�L*MZ����*�%��?2�s6@B��5��x�7(�9\r㒈\"#��1#���x�9��莎����c��9���ȸ���v��\$H�KQ\$B\\�\rAz�&.�P͐P2p��D��{t-ˊ洫��N�<+��*��A���^��>S�y`�����&���hR����&�[fh�al�#���j��6���(�V���U_9��B(�u�,��4��I\$*�ZB�J�V�m�B趍2د�j��\"�-(��ϝ­��\"?j��Zwxj��K�\0�+����M��E\r+��5W����U��Q���2Pɺ��.�b�C6�����6#���hK�\\3�rf��(O/��qj\\�d0��o����̻)KW��]qܰ����Qi.c��J%��ԁNT�&��� P���������ن�+�LY�޲aouD�H����G1�ݼoRF������2�Ø�7�+��/��f6������4֟Ϧ��^�׳ֻŐ�;e;;I>�b��0��oS=��)��gs���N;˦0]F.���2��/3���ʱ[h:���]b��)݃0���ۤ�׊���\$���>'y�x����yh|�{KF�1C��'5��O���w%8�@�QzH��:����\0A��4��l�C�qA�\0xA\0hA�3�D�t��^�.0N\n�`\\�C8/q\0�\"�����p/@���*��/ �����A*m�� v���\\!���!�ܮ�ڞ.*�IBx��13X��-�&X���6L,��=!\$�ТB�]�2��YC�u\\+�q1!�|�I\"@�\$Ĵ�\r®Yo�ӈO�ye@'����^ȡ�6�.:�'R�HA�T�]K�E�RH��:�����^���e\\��PА�c��0v>\0bHa�@��C*�!�Ç\$��Ga�:�\0��<���:�A;Rw�\0�1�88��a\r���C����V5��Q0�B@�I�M��W�GD��r�<!@\$\n\0�S��TF���\nK�p4�P����d�Qw��@�i�|2�y�K҂Hn�\$7���9ü�QEa�3J��b,\n�2�V�LP+q%-D@dl��� iJp�	�<*�n�(�4���w\r�1��(�D�Hu�1�jr4�`�Q�K�i3\$6*�M#�jx�4��(�Tb�N2���9�VsB[N�Uݛ��*�h�)�ѹBkl���b(\$�Ĩ��)d����`�9�Ph���>\$s�/Ni��&�K͑�M�1��Uk�\0��2�������>F]ʆkϳ�fM��W�Xu�u웇dJ��r84����o�:i©J�J��M�6&��<��`��Q��:�\\r�iS�`8ļ�������q�!KZ\$j��, �)��Yˡk&���`�E�d�{�x��v\r@�;�M��'HaH�#��i3����b�^V��&L���w)������]vD6�ڄ첓��`�3�����PM����f�g�+Cf�\rl榘,ZV`���g�.);�\r�����b��x�s*����V��L��r�*Ǳ)S�)72����%/�� \n�P#�qa^8Q�\\�3S���45(�-��䷎�w�-2�cmk0j� {đ�P+ژa��	�M��yx0s(�b���֢�D�N��̍\0a�/g��k���ӫ/g�x���xA�ANH�+�tf�i����>~V`T����͐��}�N�YSp�(jUAkS�x���S(`�7��fM�����Z4N:�wU��|M�F�\rDe!�kA��dk��53�(��S��(�3{�������+#����ڒ�}�H";break;case"bn":$g="�S!�\n��\0�@�xJ��_��:6\0�����P�\\33`��\0��!�(l	MS,����S,\$���]�)��d5s�@qD<6(R�\$�i�撦VI�\nxʙ+\rB�b���\0���!�e4�M*��+V�p@%9���;e��2S'�	��`�Ob��M^�bS�%UP�H��)�x2�S�)��zʞ������4��\0���h3��Q��h*�\$�m�m'�Fs\r�U��:�-O4��0Y�BWN���X�.._s�C��:�\n���`��2����B,_�(�o:�\r��@7\r�\0�9\r#��6�8�9��:� �:?à�4����1A۸S<�S����Fª�:ȇ<�B�*�+�'QR\n�����*\n`�<*z�>\r{΀�b�>D[8(Tc���6��R����\0��/C�NJ��S��4��:���j[\"���Z���\n��ʯ&KM��\n�p�\0�p@2�C��9/b\$'\r�#��2\r�[�7�� 8Q���J�c�2Cͫ������-�Ĥ�*�����l:���R:��.l\$�3�L�J��M&I.�M9>���j�'�-k�&O�c���e_��|^Oϣ�� �:�V��`�䪧2[k�~���!'Ǩ��*k��[�u�͊��E=av;�\n���L�*�*��K�n1�E���U�Ӎ�#.,h��^Y�n���C�LB\\�C�@\0PH� i��-c\r���Ц�n��i(8���I�tɭ��iN@,�k��\\\\��n4j��Kt�'D��8Z�IZ��Y�qt�h�?lH�DGo8��P�l8�P.rvp��\rN�����L����^vu�p*9�r���HYs�7?;\"\$�t�s;��QMf�]�V�/X�\$Bh�\nb�:�h\\-�^��.�w�\0ݻ�ߝ)bq�`P�CpB�Q�X������]���(7cH��J�-�3'����?\0�0�#��0f\r��2����\n\nzPnጐ\0��\n\n��\0����� ��:�0ƂØf�����`s�49B���\nl	ˆ��P�(`�,rb�K��j�=�]��d�:�@�~�2��:���d���FC�����dQ����0=A�:@���/��B�����Q��P������G� }\$P�l���}Vr�]���'��O��!�MgwQ)�RЇqY�0��U�4N���*��T��937�LU�;����~�\nBy\r\"#d�R2GH��#��������C�\r�8:I�<���B������CY�\r*�FBh���b.�s%�\0֚�UKU~,�t�e�䕆�)E���c�o�t\r�\n21�)���f�\nzCe\r!�8QTy �.H���eN��C`sU'9�.7B���W.����QB�H\n�f�q�Q\0U�Z��p��AxwG|�1&���Ya���7�(ԚA��T�C+3T�: �0���@��޼��N��bz1WXT����H2;5G��B��7�0���T�u�0�<CHg�����c��e��L���N\"\n� aL)bt΃�X�dSʪ�Ձ�ː�X�x�l}�2�ԝ�V��r�U�H��q+et�������\0����Tsh+��ss��.�KjgQ[����Т�B�����S��rnS�d��B`Xd\r,�\0)�,��A�88�T�C2�\r��lG;6��6R�ڿ�4�V�+1�P��@xS\n�7�'c��s���Y�B�l���x�ڵ��S1-�6��4�C�qW34\r�`2�U�FJ�G��(�!\r�<���0�\0f���G`�*�'fa�t*��1\"Q��H8B\0��Ze�1JYv���0�-T��}t0��WE���+�k����E��.�:��袮��YUg��08�ƙpU�T�0���f��M��_��h���d�O���\np 6�RCkr;j����񞁤3B��^�6s\r��N�؄B�F���F�\$�K��0\$1�� �u�g���쓡UkRf6��]�ȸun��'��\0wx�l����~�xf���}��\\[jQ;׈S7:�❵���W\0����+g���^P��.WKנ����f�ſG5�����iKUUJ9l����g�	�����˴Qr(+�°]�	��4���Ԙ\n�rM0콦���I���0�o�Q��E��'ᙗYB��x�⹅;?AL2��5^y�vUi;���\r�Γ�f�=-�܄S{����\0�0_�a^������M�OKN�'��!�eJ�)�";break;case"bs":$g="D0�\r����e��L�S���?	E�34S6MƨA��t7��p�tp@u9���x�N0���V\"d7����dp���؈�L�A�H�a)̅.�RL��	�p7���L�X\nFC1��l7AG���n7���(U�l�f��:�k�\r5���B2��C	�Va�OF�L�U6�N��>\$@r2��\0Qd�u31�Al4�M�S9��7���A��|��vr♆�uњ��do\"b �O�ڸ\$2h�2�̼�?'�'�G3pC�8d�!�|\\)��\n���U��4��7�6\\�5�����乪�0�h���5�\n\n:�\n��:5�`�;�c\"\\&��H�\ro���:4\r�#[1��)�J��i�^��\n�\\**h3�J������3,:솮\"k@b��#��{2:Ir�����b�?k��4���D퉉ʊ�B��сB��5(̀����p�Ѡ�����b:4 AC\rLeB�����J��pH�A�]93Kh�+CJX�\"98�n�c+��p�+#X���̓��(�Go�	�\"_%���%��(\r��\"1t,:�i]��XJZ���,`]G�c���[V	CmB���-�EZ��uE	5�p��P�0��@�	�ht)�`P�\r�h\\-�8��.�#�v�GjBF�㄄)�`�'�g6�Q8�9�#~^�	��\r��JӄA�2�8�*f9X�T�:���ڍ)>^:�cl9�è؁\r�:�9��X娌5��@tS(7�8P9�)p�������m~�?�͕%\n(�#&��#e�=x��\r\0��C@�:�t��<`8�.c8^���~�fAxDuH��|�\n�\r�����R�fʚ3��N��o�	�?@���\rù`�4��Aǵ<�)�s�9����� ��u.Z��hD���H�86l��:v��W-�kpy#:`�&�U��.k�ֺI�i0Ld9@�j��fq�����bꙭ��^�[�4,�3vF�Z�Wk-l�5�E�A�\r!��@ީ�0E�9��b��H)�'SB���X�U*��r@P(�#2J��2#D�!�\"��6��B�,\r��.`����hIpN��*�N���N�ퟜJ`��@f�E��rE��߆8re;�Qf����J\$z�����@�FD��`'%��\$y	���T��i����كO\r�9E�H� 	��\r0�� Dg ��vAO�,�X����r.7�\0��m��f@�º(u/C,A���� �A?\$(��]X����<A`9\\EJ.����6Q�!%K�A�Xn�(�A�bU�;�*f�#Vvj�B���3�B�\0S\n!0Q�NaHF\n�h�\"�E�5�n�94s���	&\r!��1�Q�Z3�FN'��E�C+\$�\"^UutõR��P�=B4d%`�K���B�W�iPD�;�}YU��ip6��@�Z/T��t1jY�;2�eLB%��͜*�@�A�\$qR����e�ԏ��y��!�E���=r=U%hI��_��\0@�@j[�����O��'�l7�b<���i4\\�X��a��f�d�=A�qU	�O�Q%�W@PU(pI>\"0ԴE\r1���DbCmXV)Y}�d��Y3�%���o�d��?�%rŏ�.!��c�d��z�8Ee��A(`t�F�ޘ���U�AHЩ kv1f";break;case"ca":$g="E9�j���e3�NC�P�\\33A�D�i��s9�LF�(��d5M�C	�@e6Ɠ���r����d�`g�I�hp��L�9��Q*�K��5L� ��S,�W-��\r��<�e4�&\"�P�b2��a��r\n1e��y��g4��&�QP�p:ӣ��>�%4����A�@h��'��l0���L�9X�f;  �e47��bY7�q��v� 8]�Ƙជ��N��t鍂�#fY����Q�<'E'��\$`���y�u��V���)�/&pQO�v�Xby�|�U:o%���T�5�c�ܓ�C���.P� �߫c��\"Ô\$8Ac�����0-�0:��\0�����h�(�~2�+>4����9������I�`4��\nb!��:��\r�B9��K�Ǯ�脼�\0P����2��(�3�+���k\n9��!Ʋ��,�7\r#Қ32���e��=�3�p��#s�:4��P2�N�J2��4}#I��̎��A j���@�i{\$&��6 �ޔ��`�1�Bx�/I��V��@�1�����X�s6@�-bK�e:V�p ��*��iE;F�`�77l���=�	R����c(�f��\\�l�sN�E!uY1\rw�Vu�U�:\$	К&�B��� ^6��x�0��a����Ȳ`� .\\n.�:��*9BM���3n�\"dR�Ƀd�6\r�J���0����^��Ó���Cu\rw���ޮ'�p�3㭁=�̸AY/�K/���0�.�K&�tN2��R�鑭�PW�C�&\"��5��6R��a\0�2m�|K��*2L&�CB3��:����x�υ���.�8^��r��ơxDuPK��}���:1@�m��8\r80鱮���hN�[Ck�&�n*M#�o��#,:r'����7���C�/)x]���wO����*!�(8#�h��v�:�q�z��P0��:Krj�!��@���C?\$\$�0�A0��������+�c\0�o	Hb#�Y�@��G�3�Bml�5�`�&%��ʆ�:Q\n�4*������1~.���LdL�\rE�%#5��H\nM\n�B�AAAQ(5 d�r�v]��7s�n\rѼ!�.�T�V�z/j�;����:v�ͨ;4S��>4'L���0�:8�D�!t2���w1��`��ԉƇƠ0��_C|@a)� �!\$17���'�ʗ	&(�6�s��!4C*�r��dY:�6�)HEQ� Na�п�hTI�I\"!���E �S�n�G  @IR������j�8���jo��_�<)�B�P>#�3�c?,��\\��B�T�Q�<W�	�-5ԕ���]��g�t� 3����R%�0�\nA�`��*�'�t� �:��r6�����| A�Qo�`xFZ*BU)��ʊi�/\$�LԵH��9�!���%�I�#^u���:ʂJ���č�c~H�\0CK��4R�Ux�*�镐�[��%�Ș�h�ML\n�M�P��h8eK���ښw��u�u�r�����b��(��*्]�Isfл�LA�#\$�|�c0��pyb\r0��@BL�I�h�tP���]\r��0�1N��e �\$��\"Lg:�h��Sa�Y�3�2�Y��¹'%�J��e�M���ai�heR�B��������Y+��\"�r�(X΄5LQh|VR����L��Ɉ���W t";break;case"cs":$g="O8�'c!�~\n��fa�N2�\r�C2i6�Q��h90�'Hi��b7����i��i6ȍ���A;͆Y��@v2�\r&�y�Hs�JGQ�8%9��e:L�:e2���Zt�@\nFC1��l7AP��4T�ت�;j\n*�WƓ���A9��j���p<�����t0����Y�VU���'@QZ3z�ⱊp�-����p�lP���D��le2f���!��t�d2YC�_?{�x���no5������~ �f�&3M�\$���������Mf�l�6\n)�L'��(��<��8�I�XcC�0�b\"�ȭ��܈�h���@�9�)X�9(���玭\0Կ���ܦA�7m��5�\n����N´�+�Q02����1��Q�F&���AM�>�:c\n!\r)���>	��R�B8�7����4�\"+r�K�@�( P�� P��\r#C�P�n`� �����0���9\$O:x����܉8�\\���\0�0�`MGR5%F���#p�A�PH� iR�/���>�X��K��2���	��B �r�8o���H�'��j6/�L�L�kh�Y�X�X�M��C��\"sbD7F4h�b(�\\ۣ`�p[W�I��-�uݨ��\\h��t#�V���|�\$Bh�\nb�2�h\\-�X��.��\nH�2\0P�0�K�H�*�C����\$8=<��F#�Kj��\0�#k�̢R���2�����2���ڥj��m<4#H��:�k�������\0����*5\0�qC�I���~�:n��jV���k֫��%\rV�;�8<;mW.��0�^�4�����ָ��Z�k��&���;g��:��� #x��NH����&������\"Q���ɶ��^�9�\0�3��:�\0t�㿤V��%#8^1�ax�7�à���}?\"���Dc(x�!�:�e�r5fÜ��'�8䠖ca}	�ftH�ɺYB�����ڞ(�Uf\"j�вF�\0 �@��rx�%����ދ�z�E뽗��J�\r��7>R��Hm�.��p_�{�j(��� �L��e����L�+���%.@�\\�Xw����BpN��%j� (���@U�x��.�Q�<���72���gᨚ����!'T1�����\rA����[-�Y����y\n)�`�H�؎xdBGV>�P@@PD�I6^�AP(i8 ԡ�0F����#����:4>��A��\nx�#'��e�B�h�\"��nC��>!��\\�����:6N��\"��\n��8�C�GAZ%�H�كY<)� ���V����@�JCi�P\"e�6�V�\\�/C�N}\"^k	�����{�*)��5�h;�GLC��77��,2p�H�+b�ʹH�\nP;�@�	�F�bC.Z���P��A2�܁>(P�\0�¡�At��\$H�rd���t*D��EO�3��N��f���IY�+\n���@L\$���M�_8Q!\$����5A\0F\n���\$p\r�glDq;�b����o/J)G-�ϐz\\s�(ZFs��9��:�����\n\$0�Kb�	��'�Έ��l����B��1%ط�}�/��گ5r�i���ep+����-�z����lg���K�)�:e��f�'�*@D��iS6��\"5�0-GEӮ`���ˍ�P��h8��xYi�nnU�g+��aXu��\\��͋\r3�9w0�r��������\"�^�@�J���2m]�_��hS�[�f�·� ���Ƅ%������0n���a�\"D�ME\"��@�Xt5A��V7m��Zc�;2�jrw>�q���QI�v�(!��Oߪ7��(�b��Z�4�=����Z�	��\0�ˇXA�ˀ�s�B�yUls5\ndq�\"@�(*j�(��(�5\nl%��N���\"uN�d";break;case"da":$g="E9�Q��k5�NC�P�\\33AAD����eA�\"���o0�#cI�\\\n&�Mpci�� :IM���Js:0�#���s�B�S�\nNF��M�,��8�P�FY8�0��cA��n8����h(�r4��&�	�B9L���\nM�:Y��b�!Rr���i�^��6��y�҄,l#\n\"A\r��\n=:LL�5\nblN�i��=�R����'#�l��y�� 3YΘ�vO\r��^�[��3��j��ڇ/tm��X��德�Lࢩ��n7��p���ND�_�4��sz5g8�Ä��;��\"N�.A\0�\r�Jp�)c\n\"�0Mr|�M����*ZIi8�:'��'%����5C{�ߦ#\"޵��X�2���j5��\$p�L+��/\"-��܉��\n	�r�\nS6���Z>�Ibp�շH�2�2�!,�3&��5 R.5A l���@ P��<c@쳎k#H����&\r#h�ǉ���B�6<b(Zͤ�P�9N\"��B�41�3��FSR�N5\n\\:�L��)�VV���	@t&��Ц)�C ^��fKgZ(�R������\nz��(o��[h�7�<&�r7�I=�EcdH#z0�x�3R����Aq\\�ߎ���7�Ҹ�]C��1���:���9���兌#=r��j�G\rêjaM��BPS<���43�[�o��2�#&H�c#؃\$Hx0�Bz3��Ў�t�㾬\$9�ܳ��z���cT4݁xDl+bb���x�DX��,)�\n6'LV�\\7A�<)�+�N��h�&��,q���������zn�:j:����+[�k�v�t)W_L(��6��Ҕ��[n��Ƒf�+��-P@3�M�Dծ㔯��#�T�����5��Tj�{�KǴ�>f�#cv�e2�O��L��i�a��'����:\r	�H��.�@��\"K!��� _�v\r\$���Xd�k�\"���BiA\0P	@�X� �N�1�p+�!��.��Z0E�x4��\\�!�G����jCa���P�CbC#	l�@�G��s\r��˽�`S�I@,@翢0ZÃ&@	\$��@io�G3V`\"��,�Dh���XC\naH#��BJ[|71L�*�zvs�%D�����C1>�\$ن����o������+؁@���܆`���}�Xf;佞���R�>��� �\"��P	�L*#��\$�\n��Z�Êm5���\"���L�%\nNARvO`k [�)v@�U�K��=B�GH�!(%,�-�B`-B�*\0��/#.�E<c%,�B`&�P�E�{(����D&@p�F�P�ʹ���Jd�W&ҳ�Pr!*�[*�.@C�(\r4��\0���`+\rh45���Ц���ޚ�VkMy�Hq\n�W�j*WT*`q�(g<�6�D�e1�r\n6;G)Kk� %J�C�8I�Y�#5����0_��IcC�z�1m�D� ��ƻ�9�ؤ�T�=x�B��lH���&����)��*�Kb�C��sD:� ��z��G	�əRZ-�x\nŴ3��G�XE%u����h����i�dV\r�n\nS����]˰e";break;case"de":$g="S4����@s4��S��%��pQ �\n6L�Sp��o��'C)�@f2�\r�s)�0a����i��i6�M�dd�b�\$RCI���[0��cI�� ��S:�y7�a��t\$�t��C��f4����(�e���*,t\n!G�C�26f�֎T�����1P�b2�-�+���r�d��Qfa�&8�\\�n9�ԗ�,�\n 4c�^�@R2¤����s��Pc��@a5���n\n9��ס�F�`B��Hrd2���+�%뜣���U\n�l�z\r#��9s�㤣�����B�9��RT�\n�s 5�#s��2R��J���\$h���n�&9)�\n����@(#�7�i���(-*:��\n�4�6j�½5��t�������B@��OB76���-0[8���lD�ɬ����C�'��9\r`P�2��lʺ?B+|:F�ܽ��Y��	�x΀�S�^����Lc(�\n4�F=!��<��HKKS	h5 SB��\\�8b���8�\r��Ģ�C���3�ʌ�8�p��#J@4����h�8\"����6B�������3@�p��W�Ђ1I(Kj�Sa�g'lzYp�nH]M w8�g�n8�u�W�Ọ��\$	К&�B��,h\\-�Xh�.ؐ�:0��II+X���;9��_\r�Ï��\$6� �(��Hc����C\n*)��\"�e��ChC�7����!���o��b6�N68Ƞ�`�7�c`��\r7��9ըX\\Fr�\r\0���ٵ�hA\\�j���r.4'�\nr6]�j<�-���꺺\r� :��\$i��[NK�޻��N��A�![�ݽ�zC\"2e�	]�ʤ@2��\$[z���6�0�c<)� ����Z��D������x����h�C1���~�@��Cp^�:َ�x�5ͳp���x�g��^9��{�u28�P77����1�ێ���b+Ԛ��T2}Q	{�|���x�3<'��C�y�9ڽ��ިel��TA�I\r����d���s�}l��2�bjeIDl�%�x�L8r'*ড়P@NUq3A�}��z�9�<@\$\0Z�l%5�S���z�8\r`��I�\r*�͠6�Ԛ��= � ���]�Oig\0006;���ۮsLP9�����v�����\\�H�)��X��c\r�;Q0:\"e�l�VeL���f\n\n�)m�8�#b��k�`��E|��2\r,p��2�(󕕅t�8\"|P\"R�4,�dG��F�hI\r�N!=�A\0�*�Pe�5���:�m�h�+�d|\n����6Q\$n ь������!3aL)`@z�DA�e�`���)A����FU��8���ظ�,G&���Lf(P#0nIT��\$,Ґ�4&A��ٝ�	 ���-�l�ɘW#�y���B�,sex������� ]dp���d�9+E)�S�ZA��-&a@'�0�V+> q����äNN�\0�Q�IK��4h?\\*�ꆒd�ӥ��S\"	d��pꀒ2Kg�{d\$|�]e��(����I4AB�P(�FZZ[7�D�����v�a�?1�U	�ܰ�n���Wڑ�!�ِbX�ŹbJH�#�x����Ƅ3���Li6���-V�\0PCZ����b�e�Z/'�G#v�_� s�)�\"�@B�F���2�A�Y3\\��[+�j�i[]��ᚣY�	8��G V+I\$��1�����T�	Q01B=�E�!1�(���\0Q�3�;'��\rM�7J��lV�Q�>^����8s\"㚴 &��VI!n_�%5� �w�`b+��J�9q���ƣ�!C+%Y&�Mu�0\\/?&rf�:��o#�Lș0���t�-#\$�E!��NR�hC3�dYව";break;case"el":$g="�J����=�Z� �&r͜�g�Y�{=;	E�30��\ng\$Y�H�9z�X���ň�U�J�fz2'g�akx��c7C�!�(�@��˥j�k9s����Vz�8�UYz�MI��!���U>�P��T-N'��DS�\n�ΤT�H}�k�-(K�TJ���ח4j0�b2��a��s ]`株��t���0��;=U�ӡHx�9]P���\nyζg�Z���QwJ�+��R?A�\$&R���U�=�So\n�⵪ص�)��w/�L����@�2�m~[X�բ/>���D��T~�!J�t��%��H���W=\n�\$�IgApj\"���+T���ġ)B���\"��&NJ֟�I�B��/C/J�!n{����F+����kz`��)t^��)�gB.�C\"���H�qvg�ʃ��5���(B��5��x�7(�9\r㒌\"#��1#���x�9�H����8�c��9��Ȼ����dsV֧�LB��mLB��B���~���:`�+��b�;5J�9���о/�\n�1�@��KT����s[������Z��e��ƲL�֖)(��,CW��W4�gH��g4�P�đ3Z��-|ZgH\"^���C�N���47�F�+��\$⸓�r�]���Ja��霦=���J�����\0�<��(�d�D��7e�8�(9�H�� g��1s�g�rcL̍BR^�-2����� Z)�@�\"�\r΀���P�]�Q�mLx�h�0�#e���7}�<:��IZ��mh�\n�KYJ2��@شU�	Y���vW��;O	���Dr�(�Ļ*�I�T�Fq7�s��(�ZE�^���x��+�h�x*��_?2��Zz��H�;����N3h��xT�ጣ�R7cH��.����h�:I\$�!q���թ�l� ��O�'n��)�˚����!���\\ɯ*�<@�C�{\$������K�j'�t�?ux���;!��t�E�a.w���jq�;\n��Ҵ��S�=\$��6�X`)=�j��uru�cz�啮A\"�����Pd��3U	�~�	[' ���8�`�@�ԕ�F�h�J+(�P4Π3��D7p@C m\r!�7A���ވdM��@�e�����s@��y�q�i�'��(n���G�&�>���9�px�>.�^	�2�Iq�)����2і��%*VVňxz�<J�qP��\0��qz`&���b\\�W[\\v>G� �\$��*FH��\$\$�tNRZLI���ދ�����QB�?��IO*U@�Te0���p��qJd��*��aC���q��u8��\$F�a3�B�D0��7B]>���^�Z�+���K�PFD�C�z`�;����pMѤ9���Cfe!�B0ƟØf�6���i��U4���� r=�<Cb�\$����\n�b�E/��Ω���)�����cI�\\���U@g��r�\n (\0P]L<UX��YN�%�\$7�)�����\0�C�i�������\r��T��O�PJ��QD�L��IB����\rKCBnOv�?5Q�P��\$7\0�TZ�L�;����r��'���k��+��%Q�D3���0��0.bg��%��>HQ4j��D�O1p�5\rhg*�>��T%CR�z�lV�d�Q�ey�]b���\"OҬ�KIp��Y�}ˢ@�	��L��2?UĨ�Blo�Ƈ�7��M131D�>3��/Łl%��[�<j[a�N�\"�TDxS\n�tN@�u����p�4�Ơ`��ħ�&��\n�� �5v+�Nk�,6+����r�*�!��h���4w4ײ��	z�\$����Bd�*\$`�aqDX��Xݭp?�����2����-�}l2\$zy�� �!+�#{���d)_[��賋�����l<Cu�Ą�h��Yl�*'��c�z\\�.���B��U��B۩CFY���Vco�'�\"~�\r��1�ˮ��%t��o@�M���O*4дV�izHī�rwa��;�\\�u]4O>�Be��O��0-2[SȦSڍk��9}��_j��������Ź��FIK�HbP���y�:,�4�6+NHԆp���%�ܳ�G��{��j��i�9C9~�{\$�8~m!8����0i�8����~{xR�>>y�=����d�WqLht9�F�p�iG��S�5-ݤa�Aִ3���9��,�y���6������J��T�T��8,{�.V<�]��Uȡ�^����B���Kxo��Jr�:]m�w矤t��h&���6�|���b���ђ�R=F-�dq�H�S𜏷1\"pi��";break;case"es":$g="�_�NgF�@s2�Χ#x�%��pQ8� 2��y��b6D�lp�t0�����h4����QY(6�Xk��\nx�E̒)t�e�	Nd)�\n�r��b�蹖�2�\0���d3\rF�q��n4��U@Q��i3�L&�QP��P�֓I�;�J�S��Ri7�j�s��� �H'9�4�d4��r�Q�r��\"ьf8A����@Qd�u'iR7o;d&x�B.u88܄�5����c��\n��y�Ȁ�o7-<��bPn�t9�9�'���SN;\n)��&y��Ir�s��(�9����5���2�H`���12i�ު���\$а�Ɏc��2&��36kpX���0�\n@62m#7#��z�)�J��:�b�4�	��0�qZ*a�Cl��B0ʗŎ�з P��1\0P�2��������a�����-��\nñ\"�1B)ܪ&\r���:OK��S�c*�èʣ�mL�Ą� @1,hD�tj24���xH�A�7<H�4�e��<	*��k�	��� �uK;��S8\"�-�\"��\n�\"�5� 暍��9H��X�Y��]G�V���#V��\"#���)ϠP�\$Bh�\nb�2�x�6����{�\"�+H3�=OS{��\"\$��!�05z@�al�Fq�h�V(&\r�Zץ�3ϰܬ�Cr�9�>�HB=[��zz0�έ��֨��3�`�:��<��#=�ǭ8U6�lhP9�)���ԕ0@��w��Oa�T��f��P430,#�XچN9D��<��A�X440z\r��8a�^��H]\"nP@\\��{�7�}ʻKPx�!���V:�nN�kq*T��k|!�уi��dʲljU\r�p�>�KA�c������H�Ō�l�r\\�(�b�ʔ	)*C%;<�C�#RP�)�[0@��o,5'9;��L��	Sd��i%�#4̜�&�P4@�v�� ��?�6�`rIJ(0�g|����h\r	��&��*�)(�<sܷ�a�4f�꽴h�S�N>k%\"����	#A@\$��_#@����A1�dp�0�v<m�8�tBR�\$�i *KCcC�p��b�/\"��!(��-']��Q�k\"���)��H�{�<��8T4��͂D������TY\"�N��2��߉�aL)i�)�Z��+( ��b>Y�|�42�p��C%�d6��SC�x3	�pv�O'��#6IK�p~�	�@@��R\$&D�0�W�q�\n	\$L<�	��z!���S@Tkd06��ZPD)1�Ўɣ�F�K(\n<)�DZ���9#ˀ�pP�p Ka�:��6`��:'�0����H��-x����Ӭv�\nO�٭N\\lُ8\r\r\"�\\\0S\n!1���@��\0F\n���9�I��Ѓ����J@P�����T1}�\\̪%�M-R!�,� ��փ�=�^�꾶	Zѭdj����kb\r��:*(��e%�����R���)hd�#S�{<��M\n�P#�pFq�3��)QX��G��^�UT_�\$I/�Ȫ���G�I\$*�˞�Br��3�<��`c����Q�e�j�@'h�H{f.\$v;��P�i�)s\r,\0�L�\0�@Rt��!�\"QxCzD>`((T�RC(5@±�u�aQ\n*��z�T:�j��ƥІ��Y���\$��Dg�3d���MnXTa	V��u����l֬";break;case"et":$g="K0���a�� 5�M�C)�~\n��fa�F0�M��\ry9�&!��\n2�IIن��cf�p(�a5��3#t����ΧS��%9�����p���N�S\$�X\nFC1��l7AGH��\n7��&xT��\n�P��Q�ȼ��&@QP�b�����F�U�P̆QL�s2��x�~@�a���X���I5,�΢A��)7�V��h�gȈ����t��,�+��5)̴�,g�ù�.����hgI>K���yt1Hr3��}i��p�T�d�,6�:�ʦ�^��nNG+LԈ�/�\nR2\r�R:\"��V9A�9��K(&C��ˮN��\$CHʅ�.�@�)j�:�N�ʜ����4�I���K�'�hĵ((3�ڹ�(��;�Z�-x!-��\n�x�5�Bz:B2�R�(�6�����\nH2p����3	2�\n?� &\r�b*ʌ�P��/0!�d��ȣH�5O!*�@MQ���<� SR��\\��b	�t3�@���j�-@P�4��df��3��B(Z���`؂���\\2�HMZ���4|ऎ*F�0�E5��F�\r��<�	@t&��Ц)�J��c��<���F�\$��#|��������KN\0��\r�ܝ\r�:j&E���'�-����0̍��������b꾍�P��!,�c\"9�è��ΨP�6C�R0�����Z����@����B����Ĕ��rz�(ѓJ� C6�!C8@ �I@�xJt�_a�4C(��C@�:�t���\$�x�-#8_��%�Ia!xDp˶��}�xF��H�*��6B٢��eC���'\\�ʚ����A��<2SI�����������\\�����HD��H�8 �\0�:r�07Czٺ)�R�%O�N����,7/+L� ~���E,>���#���f`(rkA�0p����e��ʳf�Kc�*A��*b*S\0 m��=p�L��5�@��:��!�1�m�\"V��ٯ#��S�b��H\n�Bd��Hi\0(!��z���5A���`A�Z�< p@L�hwv������CZ�3K��v���h9�E3�n�n��9Wd�fpP��v�\r�a�e\0�^�9S)� �琩�W�H��@�ZCk�t�NO	i�dD��\$�G�)s~��H���\n��� (\$�@�h�% �X��+hqt�\0003�2��C�i��	��5\n<)�@[9)d��ˑ�>�es����2LB�W!k̃��a8e��_!�4\0Zd% t4�A��j�_��/Mx)��1���`�׌Szj�)����Ȭ,o硪6�GE�R;-TWM:(�QjeNY���W˗ ��������/Z���e^ֲ�i'4�ŔtN��F�-1�Vɛ�H�4�У� @\n�P#�p�)%<��� �J��	j1hȿ��8g�����R2,^�i��v�����\nix�äUcJ���mT�R��k��걂��{�\r����fk�	��S�Py�i1<aP��g\rʛ�YE�G֣�`_�>	m5���sY�=eBE�P���X��d�Ԭ\"�`xR/a��؂K�I	";break;case"fa":$g="�B����6P텛aT�F6��(J.��0Se�SěaQ\n��\$6�Ma+X�!(A������t�^.�2�[\"S��-�\\�J���)Cfh��!(i�2o	D6��\n�sRXĨ\0Sm`ۘ��k6�Ѷ�m��kv�ᶹ6�	�C!Z�Q�x=�V�R�iY�b�,u����U��D��X��01;J�\r[��X��Ϡ�İ+H\"�����t6\r5u���͡,�\"���g��b^��B�=~����@*�X��w��`����R�\\İ�3	��n3�h�\n�d�*3�J�BW�B��5��x�7(�9\r㒀\"#��1#���x�9�h荎���\n��:9��ȭ��\"\nRd��HI|�3\$30��΂���NBT'-�\n�(C����(I\n�3��U:�Ih�*�\$��\r�%sت 0Vά����S��:E���::Zʪ*�\nȩm(��s��;ςL�-\"F��E��� �+Q'p-���,2=�B��\$N�)=C�.����Zu�j�@����e�\$˔����2c\$� �1���-X�<D\"v��Ld�\$�rZ;�r9�I4����R:�-2�?;��	l�0�|�,7\n�@wkBTnJ�Bʬ��'�TUMB���;�/��<�CH P�\$Bh�\nb�-�9(�.��h���%�3۩2K2�B �9�cd>���\"7g9�I�g�(�:�p�4��Th����:\r��z��J�n���v�\$+�#���3*�l�u!8H���A3\$\n<����{g�Db�UAlA%���\$�,k�ɳl居�Nֲ�mBϸ9ۑ�5;����y�=��5�L;�ī��Z�Jۏ>��I.b�a]P�40\\H3gî���6��Xzn�2BA\0x0�@�2���D4���9�Ax^;�p�����*3��H_���7�}�C/���|��R���2G� Rޚ�*�x��&w�r�,�8����w1i\0#f�	!K`���c��3�z/M�w�����|/���\$�;�~\r�4���J>^�]!�VTȃ�Jܠ��R+Y9f����2��9r���:�\"�:;\$(�����Z��&j9�XH���C�1���i\r��\$>��A�2�@��@rE�1�0���|\r��3�x�C�he�����\rϸ0�Ĥ���\"NL���:9!H��ƑɡT\\鄮�\0��>���0.�K�((`�֖k*�koPt�\$&*�l6���M��@�i>��3�Y��#7D���Y&�)�\$2��D���cn0�z�bP#����4]#h��\$8TZ�шrT��4��&� g{�а�]�e()� �7C[I���3��C�!͞����d��Sx4H��d��	Y�%e!���\n��K�8�0�IQ�(��\\�c���PI#A�7�T@U\"&#m%RI���ÈuDh�3!@��_\$6�Rq9&���D��r�R�X��4Q�E��r,�m/K�n�ETJ�P!u^'%�\0�a�#���U'X{Q�9)e���h�W����*����צ�,(�%B�N�Q	�0�)��-��+�\\#I�=S���G��.h���	\$�15��r��\0sg�@�rԦ���P�9���i4ء@�a0Xr+.�U-b�2	\nc��,2�]��@o�=�'VTd�y�ʇ��U�ٲ`��r\r���Q`֡#[]��5����U\n���Jq�U�'���[;�S��+)�L�`2:G�;�\$�\r\$\$�d��8�(QAT�jH�B�F*��T@��b�� �8ȵ���)G��c߂2�Gt�p�Y��b�4E�Z�;��\r�t��l9����#x������bI��;C`Q6���[g�b�`H�R&E��´�������J�V.ƫ,� #����;�QV{u�M��`�Ke,��ia ";break;case"fi":$g="O6N��x��a9L#�P�\\33`����d7�Ά���i��&H��\$:GNa��l4�e�p(�u:��&蔲`t:DH�b4o�A����B��b��v?K������d3\rF�q��t<�\rL5 *Xk:��+d��n퇚�֤�Z'I�E�JN�é��5&�i�	�L4���<�u.��Js�\\�= 7�if�Y��@�]N�S�mIC�mv��f>)>����N�� �r08�\$k�M��N���Gy3Ғ����~�`���\n(�X��^o{����t2£s͙��2�(�6�>�:���L9�.|���5\r�Jv)�jL0�N�5�n�|�(�ږ�5/��9�����\r0��\n�Bp�Q���/c��-c,!'m�t��^�B8�7�C�t��#\n7�O�\"����ܘ�)�Y��p�91è�:�BBX:��\0�<�c˾5��J��찪:�*!�\"�0�è��M�\rcˮ�#�PH�� gL�3h�2�L�Y<%���6�}@)C�D�\r� �P\n�c\n9��Z8*���?���#K�ˍ5J��8�V\0�a���44�c-�k�!uh��E�j׶Ͷ�۷*�-	�ܾM�@t&��Ц)�C��:p�;`���V��p%����j#N��C�	N\"������Cp�@C�-���d�%��)H���2`�\$�B�X�f���0�J��L�6����8-�d��>�~5��`�<M\"��Ω�ъ��f\"�#�RqY���:crp�'���N1�'�d\n�j&��j��\$̶�ކ�����N��̤�0N�m%;u\r��p��o P�6#:����>���)��+�|���e �#&⹍+f�;\$]�x����3�Р�t�㿤\$���K8^���Ä�)�xD?@�n+W��\nٲ�x�&�N����8����/&��X r�\\2�s ���r�1�SNVIw6Ą���Z x�估��^{�zoT�=w���s��7\"��p>\n�T�����(-J!�+Mk`�\n9�P�[�O�=����9XQ���\nE&)\n��'h�9�&�z��9�6���Diun�����zI�L\r'\\��\"�n��{nQ&:@\$��I51\0������i�q%\r��V @PCFU�G��ƁAN0=�B��a�E������Cʳv���j�\$phB��92Ō���Gv�A�c��VL�����f��Z�L: �Cq�x�>�U��ӡ�AI��\"�:�H9���;c�����\\���F����`��]��B%\0�kc򳀐��r�E�������]C����۩#\n� 	h������N&�(Ԑn�V	�^n��Q\$�3Ϻ�w��&�Cb7��\"�VLa'�\0� -a�H�QI�(A�;�4��s(����q��p��Hg'\$�s�B�Q���x2���;I�wL(��rQJ�L*\0t�Z�9%V��Ya<%d���^JP�A*��/���A�fʋ�rwfPC;��Y���3�\$\r��Y��l�		v�+5KV�TW!� �\n��k�h9R���� [Q)W�ܖ�yX4�T*O q��Fg��Ϡt+e��[�ݙ+Kf\r��N>i�����5�X�p�=\n!6��e��&eR�6���T4Nс�9�X�ܥn��[7ʝ��GXen2ʞ��F�@Q��ӶӔ�����6j-C]�8�L)�/.��`	�A�T2S�O ����R\"�&0+�g�ց�i9i�n�HA�d�G2BSA�L�2\nJC�An0a�<g��c�zH;�Jhy�0r{Op����#�&�2�n�\0";break;case"fr":$g="�E�1i��u9�fS���i7\n��\0�%���(�m8�g3I��e��I�cI��i��D��i6L��İ�22@�sY�2:JeS�\ntL�M&Ӄ��� �Ps��Le�C��f4����(�i���Ɠ<B�\n*N��Ҁi9�`GS�(�u1�M҈u�tM7�\r3Hdx�sa�NY�~D� 9hNgSd8�:+A�&�9��e=L�d��N��0@m2�,R��@j��a|���O:\"��wӟ/�9���݆7f��\n�x�6��G]8X���wô2��[��0�0�ljx7�P*��cΈ��F�\"(���z17�B����sB�2h��8\$(kt�&*P�7�j�^�â��:�	;r°�`6�D���ύ/2�*�ʘ�+�+��B�0�es&���x�14h��%���`P��\r3()5C(�:�B;C14+pdK�6A��41�S0��m�p�0�[�ͦ�T����\$�+T���!�&�ó�ۍ�B640苌�\0�1�C��5�j���H7=� j�����c*l�Ylkh�E�da�,\0�'ic��5�.\nu]��Cl����(���:�NH(\r&P��.���0���:Č�B{>�*��4!uoX�	Â�/2��8VT�i҇}��\$	К&�B��\rCP^6��x�0���@�d���,O35PC۫��d:�Ӣ2]���P�&Iʻ�#�kءQU�B\\ޯ��t)���\"40�&����8F�t�K�;n�:��b��_�˚X<����\"*��C~��ۃ?U)����OU9�+o;�<V��=:�tǵ*\r8�-��Z3i�B 3��6�f�\r\$�J�'�CF3����t�㿬=����8_����Cr�}�R�`x�!�ρ���8�����\r���֦���tN(�th��rBi/��\n����y�<:=��^��xM�'��JK\$���@|GÂ�*��>��LI�mO���`�M\r:#&F�7P`Ò�����rҚa�#��������R�HAȞ���aQ;I?+؄�0N0���!H�q��l���	�B���D6�۬dr�a�5CNXK�:�p�\$b��ax@\$T�	pt�\0��ChW��s\$!���t=�+�i!�<�q�w�E��8@NW�t����\n���Tڔjxӷ�7+��IU!��&�n�[�r�\n��y���c!�I�\nk�.��T\r᭩�\0�F>��	�Ď��A0�3�fK�i�!����E�!����@S��)40%��	���g����\0��������T�66B�y(4s20-\"��	w�m�4���ɚ�'Mi�\nN�#>��\$(�	�s�*C�x��������zO�T�Ț��z\r�FE6#f��f=CD��Eȍ� P6D�t\nC{�&��\"�VɀS\n!1�Ќ\$1�jf�m�VKIy]��İ�ڏ	;��*��\$9�%�6�*�Z��x��Le��iee����9�6}%l�'L�B�0���	��Q���1h�;<����h�	�C,A��4%3ɫ+��rUS�Wj��3�\$�;t�S�#K�v153�%,�\n�P#�qjՊ��Zu�\"Q;`7�/�+wd/y\rg�䖒9*����[ђ�Tx����\\�*�9��Đ R]RЎ�%��\rE%Jn�,,C�+�|�Q��I�e�Kpx�B����L_�h0��\\�ؚx�Q{&ڂj�i�aF�^��m��_���.5/��@s)f�������\$��%��f�)FT�29�om��W\"	z7�� 1��7'QB7芙��њ���2�� �+�y�A�=G���ڃ������Hw%���0}���+\r�� �H\\��";break;case"gl":$g="E9�j��g:����P�\\33AAD�y�@�T���l2�\r&����a9\r�1��h2�aB�Q<A'6�XkY�x��̒l�c\n�NF�I��d��1\0��B�M��	���h,�@\nFC1��l7AF#��\n7��4u�T4��u3,��O�F���Y��u�M�3)�n4f�3��4\"�)��Q\$����f�,r2�͒z��):lcW���A@Ĝ%�	��6OR�5P�L �<�ɤꜺ�4u�XtRsuC���s\$&�=+��{7=N��˓!^NZBg�銣�H*��Z�;��R9&� ����+�\n:�	,,�c��������1���3N��7-8�a�m:�9�)b\\�)�4�\r+\"h!�*�'5�j��PrN��B��Oc\"ɊC*�(�%���V�m\n���P��B+0�(��6M����4�����Ӻ�s���\"�:ICp�Ʉ� @1-�F��b#�R�7A j���@�B1�����Gɫ�ʿ����#�ƠP�2��\$��B*r�I�( ��S& ���WE�`P�77�%(2�cb�j\r2(�Rtu�0��}�oG\0P�3�`P�\$Bh�\nb�2�x�6�����\"�u^N��*�:��� �(�B�%IMa�F��+2��+t��u�ٵM�n�P3�S���ު\rT����2;�X��;t\$TS+h0��ơfs��B��̪�G)�p�E�\"%Ǜ�坱*�K e�E:0A�%zU)���f_)E!5�W�J��*�\n��\n���D�3�f��hY*:��!�4460z\r��8a�^���]\"�pb�3��^�/�r*�A�I���^0���:�#���fz���4H�r�[���<s����ݽ���mU'h7��pA�J<o��|�/̎���΅��B7t#�c�}�	)%��=w`�	�SE���~�+�1�\$��fvYV9�n���0�ҍ�'%&d1�F���0m�_�\0�o������������v��`권`g=�x���o�JP�����K\"F%��1��D��+3%M8�G��LP	@���4�bh(*�����H�;#ā!�T��7%a���	��V0hU����C��U[�C\nrkl���3�~�Pl���;3��`�J=f\r��'��a��\r�����⇑\r������Ty!�iT\"���[JaL)fs#E�[��i��ZHJ�d%P5��W	l/J�<<Du��nI)-����UA\$8)즘�p�wĤ0�UnQ�4Wm��U�Q�y�)%9[��yI	+pG�?����K�&h8Mb��f,Q	�L*Fl�_�g?s�o���r�Lg�r�rB�I�w)����bZB��F��\"2���%(�b��Q	���bnI�;%r��`�\\�\$�գO��jbh�%��C��_��&�47�\"�U�ʇ[\r`�cP��mX�k(�E�VT\\'�KypV���f�rA6��\n��qT1�Ia)�����rV�9+�a�:�JT\r^%�zC\0�0-5G��f�W:��қ�jKɴN&ب���	W�`;s�t�U\\�J��R��>�\nK6�[�p���@4|��C��*�B�k�j�i(���^]�r�䤟\n�F�bD�G��\nt�i�(7(���hJ���.�#�N�p2q`v�#�3��x����5J��E	[fl���A�-��@";break;case"he":$g="�J5�\rt��U@ ��a��k���(�ff�P��������<=�R��\rt�]S�F�Rd�~�k�T-t�^q ��`�z�\0�2nI&�A�-yZV\r%��S��`(`1ƃQ��p9��'����K�&cs��΅>�B/��n���C��x��7�DT�eQ���Z����\r���	�r�/��s��MNq��G��ܞ\n`��%��~����^.h�q/�jv�l]�l��G7�~\r+��2����/l��&1�|'~\n*��f�y�� 2��F�D0�&#	�� 2̧1�茎����?��9��`��\$�jJ����ߡh;�I����'nҴ�#Iʠk�1��-����6L,S�k��.c���Ģ6�'�\\h�-+�.� �p�F��:�-N*^��p�\\��i�q% (K��1(C-A�B`S/	�7/��jL м����5�ڀ��Zs�j����S���2��+\$�&l6�#ȂAA������D����6��\$�6���\$>�L��=D��.�N(� ��(B\rL T��U�Q*����\$	К&�B��c͜<��h�6�� �BR�R�:@�4�o����a��\r���\\�(�<�(�9�#}�3�[l�C���G��`HP�2 O�+S/,��IN���+o���x��%��w�imzJ����1��\rZ��oR�-�u�92\$	�%L�#HK��# �4��NM �}C�@4C(��C@�:�t���h�>����8_y���:^�p^ɂ.���^0��b(6I�'�M2Z����d5K�j�*:+�D� �ܐ�;I�a��z����z�{.���N׹]����j^�\$��Ν�{������Wɹ���rm�\"�;�^-@D~:9H-uߒ�������@�4>�Ǹ^�\0�4��`@1>��3=�h�8�#5�9@���c0��\r�x��i��@3�_p mT2/&�C`sA���;q�(��JXQ�\0�� ,���i/}�x\n�\0pA�;>@��|1@��p������&�O�`K�Y�2 ����='�� 恟� �-��P*A!�8�p�Ch᝭>s�a��2'zC!�]ɻ�L�D�W�\\��c�(\\q*1%���%��ɛ㆏r!�<��fMU�\$E,ȥ��\$�f�l��pZZ3�~�q���I�� 'q9���&5̛�E,T��i?.��b�jA�0�T�\$p���'(�!�ySY#;1�Dٓ�)��P[)rf�\r�D�D�KZP �#HBI����-�R���yaF2#��c���a�=��x��k����Y:�ig�2�\n��;)-_��J^�r|��vrz��%�4�%ӂb�p�uD^Z�D����F\0�A°�3��1��lԩkaFt�E��!�f���Y\"�LQ���ԭ��lc�BAŬ���9N%��/(�ޒ^��ح���<d��ܤ,lǸTdC���F�I�,I��-Wl0�&CB���m��~��CrKNМb^�Z8���V�V���/kRU�K�^�1\"";break;case"hu":$g="B4�����e7���P�\\33\r�5	��d8NF0Q8�m�C|��e6kiL � 0��CT�\\\n Č'�LMBl4�fj�MRr2�X)\no9��D����:OF�\\�@\nFC1��l7AL5� �\n�L��H(�(4Ng�tR���ʕ����i7ಥ	��a���Q�Y��t�Ǧ���b�FS9�Qa�N��K\" ��(���ܲo:�/'c-L� 8�'cI�I���Χ!��!4Pd&q�nM�J�6������oyL�~do6N����\n���\"髝��s�3�3�B�V9*��:<��\$/K��\n�p�7\r���C��9&�#��/M�H�B�P��ڔ8/C��\r���������R���XҬ�M3.���zd�\r�\n��j��%m�(#h\"\"�@��##\\̱�����Y�Np#��*��=�����ؼƓ1f	IB�3�)B�8< P�6����=�)+d�Ԑ���؆��2h:!-21St�?M�PB�\nA l��X�BZ�9еB9\rD�\r�I��7.l�5�j�B�	�)b�8�����k���h�0���P0��[���!��؟6���6[�5<�Z�Ē�\rwX����k����z��e�}���z^��6����3�C��\r���<�Ⱥ\r�p�\0�#��6\$����8��A\r�vPީ�X��²7cHߜ&�b���IK>۷9z7��2��2,���3�|B@ ����@:���1�Ø�:�9 ��abB9)��lB�B�L��@ꬅ�Rȫ��Ajo\nn*/0���0�@�-��mCw��y�x��\n@��C@�:�t��L[��Cc8^��&\\:gCp^ݓ���x�:���0��B�%�T�:mM3��QTb�CP��>Ԁ�E�x�L检ҤF!.�s\\�=�t]'L;�wVu�m����w۩��C��x�y޻�T�MY9\$�ʂ~p�Y;)6�'�����7���Q��ȫ���o�(l� 7���Ma0nѝ�\0�qRK�#!�3!���Cf{h�����C{gB��՝z{�( o�손��70�%��4����f��6�Q�`t5�Q*ē��� \n (7���O)�1�2>M�;!P��@��p�)�S(��S��I�ld�ܹq�\"ZyW6�X��@�s�.08���B�ޘ����0��D1��\$C;�?:)伙2lӡp�F&靐CRJ��.-{)����X YH0���N	�<'�\0��P�k��m)Q��IP@��(n���3*�<&�\$���p\"]7Ș�)�Vt�@q�X�d4Hk�#Q9�6I���E����ԒE��1\n<)�I<s� \\��5�S���[�ܣ���\0v+����LQ/�X�پ�%�9l�nT\0�.\0S\n!0�H�s�\0F\n��0�\0T��<G�F�57%\nP[(�X�jI48��CT�r?	��S�n���W8Gx��U�`J9�+.}|�+Z����\0: @WE�Hc��ԘӠ�B�[�!����n��e)� �0-��P�_��fd�F��_�պ����\\�p��*��`�DI	>�D���^LLa�K'����H�U,��|)(!B�J�<a�ʙt�Q�?��:���n��X�p�γ&��ڃ�LY�J�Ȣ�L�7��R(A3�d\0zj�n�Z'��%��� ��ٞ�\$��a=�\r�[�٧�e�X��(�0x��)��B~{U��>w`�]�B��n@9ǫ�4�^ �U��G��@";break;case"id":$g="A7\"Ʉ�i7�BQp�� 9�����A8N�i��g:���@��e9�'1p(�e9�NRiD��0���I�*70#d�@%9����L�@t�A�P)l�`1ƃQ��p9��3||+6AD��np���J���Ά9�ZS��,�;q��@�Ejp3��-,�΢A��e�����v4��y�?6u8@������O�h��ld�\n�mg1}��j:����g�m6��	�����ƾ�S�q�D�	��!I%wR<�\r9MƼ�ރ(9�R�\$j�+�\r�\\�l���6��c����k�9;���\n���#�&2�c�V79�:X�&�s��\$���:3�2\0003�H�r�BN`@;�в\\�1�[��8�7��B�\"��H��B���	̊	�X�5��,�Cjr�B(�!\$ɐꅌ�4���)��A b�����Bs\"����6���\n���h!\$�#H�����6O�<��� �H	�j4����N6�\"!F���ʹ�bv���jZ��b@t&��Ц)�B��]�\"�Z6��h�2QJJ�.�\"�س\n@@���Y靜2�ۜ���̽�@P�L�&�3x�3-#pʿ���%��d�\r�ܴ�	�1�i��3R�\0�7��@�)��\$h@A��(ڄ8#(P9�*ZQT4!\0�z�Ih�ʽi��h;�8@ ����9a���%\0x��p��C@�:�t�㾔(y�P>C8^����,�xDj�ӎ�}xC��ķa�L!<�貋����5���4h��82�9�y�h��iP�f(F���cv�l���)�ڴN�lV��4\r�,�<�x��_h���Ji\nF�K)1&��3d�C00�z;�5RN�%\\��(V�s�0.	U`�O#\$�k0���\0�G�P�	C�,3mvJ��˿#�\n@��'R-,�'AB�����k-��Ys�3�|К7��C�t&��� ��û|%��W�T��hw\$�����be�B3���[vI�;���IX�ghDЧ���N��_���0��3�1Pd>�W�����.���(Ɖ��p�P� O�9-!�i߄KH��������it\r!��!�ZHxy2D�2���G��&�88�R`F�1�\r��ĳ8jG�����ב�H}� \n<)�B�J\n(l2d���8��Q{�Y��4�'	�;Q������0i\$1��!��5��\$�Q	�2�@@�0T}�9��T�d�\"ŧ�Ծg�3 UIʝ��5ݑқD�S� �KR�BYӈ���s�q�\rĵ���%ÑpG��\r'TPXc-!��Y|��~4�qлv��hF��9\rCF\$B�F��{3d�G�e1�x���RN�Q�%�0�5TGX��6�(P��@Q�Q��%;@Q�K�h�H�gS�ETu\r���q�4���B]���(&�zO��>�r�Q�w\n*�F��\\�B�����T�*F[����\0�X��C�	!����c��{7�����]M\r\$=5P���";break;case"it":$g="S4�Χ#x�%���(�a9@L&�)��o����l2�\r��p�\"u9��1qp(�a��b�㙦I!6�NsY�f7��Xj�\0��B��c���H 2�NgC,�Z0��cA��n8���S|\\o���&��T4�\r3��Ws2[M�s�R,e�C	�7 ��M�CLx�af�X��Ӂ��ζ�1��a�द�\r��p���6��( 0��V�a�Bq:�p�&�l��vӶC�l��9!��u�q&Y�(i�3{a�	��a6S`Q�2��	��?@U9��(&�̑實��r�ާI\nF��C��7c�t9��@Ȗ�	�6�#M�B�\"��H���J���\n��-F@��n��40p�\" P�0�i\n��OLb)��#��z)>Lb.9=��|(Aph�2B\n����x��\r�\0�7�I+\\9'2������0�������\0�<��L�7N\n���I�xH����1�:�77\0�'�)s�2�n�M����?2{e��,Ϲ̈��2��L����T0�t�6�t�]S�1��(�v�	@t&��Ц)�C ���h^-�6��.�B���<���\nF����0��V�(�1p����7��Cr�	��4��Z��;�@�2���,��C(;2�+,���2�%[�P@��Ò�:,��b\r���!�;l���P7���֢ͣk��\"��7���\r؎'�߸�47c��P2�c;�䮢K9�Cr�z=�j3��ݿ`�1�l�ޖ�� �5�h���&�p�#&��c��j�A\0x�\r\r���C@�:�t��W�X�-8^���\"In��xDq�c���x�`Iܰ��5��0���\"C�-�iY&��&Rw'M�B֕AJi�T��c�n���o����&Ե��@��%|X�CCw\$��H�8\$R 2�<ڋ����A!�hľ�\"���ֲ��]��3y��2G�ϵиʢ�&�K}�D-\0:�22���c)tS��YO)�ܝ��m��nJ嵦U�NK���:�0NЙ>Bȅ�?���V@�!]\0PQ�I1h�\"��B\r��b�	�5D��C���Ld��8@Ea�PV�[	��#3db!�BlH�;�Aa��0�&DZ�,5���#��!}�<���Y)� ��iq��#�^�X�0\"!�4�u!�ys1�mz\0�k�0aL���#�T�c4��X0�&L윓�L��&J�ipƴ�J):[���IvP.�`˚���<)�I(��d�en�ca+H�ߗ0�7��rZ�#Ǵ9F�n��hP��,�:�Bv�<�\r�h�ЦBa�����`�C*m&E�9@��f��3�Ԩ��;IF���&�.l��tV�`޹N��%��Ι��F�R\"h̠�QjL��U-�����L�U69Ĵ#Yw�`+g�1���v�,-D׆�c]KC�����l <��8�P��h8%�̴�\n��3��=V��� ��������;N2(�VE���k�H��)c/U�)i���v����VbȘ��J��Fؖ��6�CH�SqR�b\$���L��*���r����T��V�<k�iE�R�%�6C�ʗ�����r1����,[�,q�fz�c\n��";break;case"ja":$g="�W'�\nc���/�ɘ2-޼O���ᙘ@�S��N4UƂP�ԑ�\\}%QGq�B\r[^G0e<	�&��0S�8�r�&����#A�PKY}t ��Q�\$��I�+ܪ�Õ8��B0��<���h5\r��S�R�9P�:��a[L 	�:�R�O\"�k�\r-\$�AP((�*qe���+��P�M������J\n��YDZ�9���&��a;D�x��r4��&�)��s7�S���t�\r�A��b��NE�v����{�2�ζL��^�r�t/׮TR���r.��J)�L��AP@Q<헥��J\0P�7\rm��7(�9\r㓴\"9��9�C ��cx�n`���>9����� �\"M#���1P���js(^��\$�o*G���\$\"�9��򬣲	s�IU��������zK��.r��zJ�rzK��12�#����eR���iYD#�z�A+LJ6A�T�\$4:8U1R>�d:?&�E��E��) F���>\\�,i�%�`��i�`\\=G95Lh�cY˄jt�)�M���N�A ������EJ��y^Z� b�����!8s���]�g1G��A����[]\"�E��Xt�%��E@��U�%�\\r����]/J	SU1n]���0�KJ2��\$�6��Aҷ��Id9~��\r~b���y}3G��=���u8��0�cΌ<��p�6�� ȪSך?Q����J�3\n�ڻt��C��2���9�#~�P5Z9j�����6�\0�97Cx�3\r�H�2Ɗ[g������K��*\r���0���@:���1���:��\0�7����9#�\$0���ua-�6�ë�aN�_��j��� ����\r�8@ ����9t�մ��@-��3��:����x�����B�t23��(��Z����}������|�E�*#�܎1f�D��?�A8)�ALۅVJа�qhy	~)@@�!��MC�A�\"����4��f�ިhz�e�׾�_w|��徠��s�l���6�^��>	!�8@������f'� ޴NP q���Z��{\r��\0@!\$��D�EX�Y���z\0�zn�c~m�s��C�Y��(��Cf����9�N���t(R?#�\r�s1<8]Ha\r���#䀐�\"FI	x��\\Y1<\n (3�~�RE	����Cɜ�PB��s1DbKFJ\r+�`lBjo����zo�	�8��h���A�D��Q9��7����V����s�V��L7�Xr�sE�a�!C�CppvF���C��a�-��������1���ظ�s��\n��F��IF�f�(����A��R�5/\"��a�#�|��b�����&C�:a�-�r�fE�O���	0�D A+��K��1J�8�,[�d\r+D�\"t@���9\r�8�S���2\r�=)���D^q\"�v��O\naP�5b�L�A&��� Dri��E��>S��UDXAĩ`�GbE���*i��4��\$�]k���F���T(s��n�F�\0�B` �h'���Pnա�D�X�+�rEXܡ���V:�BHr���Hىd��]c,��&Š������\"TV%�BHsCM/��F�ޛ�~/p\nm�6��CkkHQ�iE[��Z��39(�v�5�\r�\r�'VB�F��<���NӮ��AA'LmJ,W�@�8c��2m�0&M	���'����&iX�4C�K\n#�g9�4�K�b>���Q3愅��z�\r�@��@���/��e5�2fl�A���?dqRApOI���p�\n��\$0���ԯ�����W+�\\r�TލJ��R >��:1N�Xֹ�Bb�*hA��c�I� �X'qD`�(��";break;case"ka":$g="�A� 	n\0��%`	�j���ᙘ@s@��1��#�		�(�0��\0���T0��V�����4��]A�����C%�P�jX�P����\n9��=A�`�h�Js!O���­A�G�	�,�I#�� 	itA�g�\0P�b2��a��s@U\\)�]�'V@�h]�v���t����k�̣������^\$��:�%Ġ���V�'HX�z�*c\n�ɨ\n�m!Î@�Y���U�n�齄gD�^d�.N�r�Ѥ�KG=1����/��NyR}'�\0��>}i�BJ�\$Ϋ���Χ����Ai�V�@�;��<�d���B��@pBJ�)Jr��?(�������K��1Qr�(#b�.���\n7��\0� m�T����v�#��6�-�:8V�\r�	#��R쵷P[��)�z�,�*r���l������1K2����t�\$���)�(�K�z�G*kt�1�t�(�;	\n\0����4I\nyL�˔�JQ�زJj��\r�U>��MA�	;�S�ͣ-.3.2�Ш�*Ҳ�0ݼ\ns��E*r<�T�ʣH�j�?Q��&Jp������J2\$��SӤ�]6�PH�� gt�*?�0�MxA�=1ϐ;\$�\r�X�U\ri+�P��,�<ͧ0�I��(`\\��K��i\$�a�J�eZJJ=e�U�\$�-x��@�ה�����Y~h�&n d��!n�9b1�xu��Zb�Ձu(��zs�������F���#�).�s�9kR�_�l�f��Ί�݁��Ռ�\r���'OT�Xj\"O���M2�g���[4&��)���]��[��W�),KQǜ���V��QU�͛\rW��|����b���]����\"�#K(�øj��Cw�d��r�N7YD\0�P1��4�=��# �4��(�3)�#��������c���i�M)9cB!\0�9�0z�@t��9��^ü	���=Ǽ�xr�2��^xn!�4��^��<d�e��v��#�\0��|�\r�wC�l��Y��yJA>;�<�N��m�]T&8�O�\0M,u�B���JQ�#��wH�Y��%u�Uנ���3<����@����@H\r T{ot9A% �e�\n�8;�_�,�-<��{򅐹�?\$���\$BU\r\r,yy&&���H�\nOy�m\$\$s�r�i%��r/*��j\\�ǁ�§<�J�(���U5�<�\$j�4������ʫ(y�R��<��{��G��j\$��Jn*���D��M�|'b�17\$ҭT��i@�B����dK��>���@���Rn��O���_2��Cb��T�a�4』�2�\$��8����8��h\$w:&\"�uM��E�P���\0J�#OY�!!�M.�X�I\$K>Y����/K5�%�,\\BHF{�ty�>~*D!�0��\\HU����N�\0\\dzZ�Y�7\"=�l�¯8�V3B��M\rN�*�&jz�/��TU\\��<Jg��	U!M5}�t�Ɯ��:��سJf�f�f=�Y��AG=l4#�-ĳvt� lt|p��)�i+冫�zm��98q?\n<)�Iz����#�MI�7+[Z����ج{!m�x�aR��Oei�Pb2ԣ�;km�U�U��W[�Dj�a�5�I���Cʸim�iL�eIT���&���P|\r��KszRf��O.<J� �ⱉ�W�-�9�D<�V�P��AO7����%�d̜��2�,GG'i+���Z|7��8�<��!��ݹ\$ G����J�&�ރ`+R���8����Zh���Zּ�]���q�g�A��-\n�R��u:�>	*��T�v/�ѱ:�����*�v �o���&�\r�'��c3��WD[�B��k9�^�z*�Z�����)���`iz%|n)�F�2�ȉ~�!'�F�D�b!w,U2i#�fh]]p�M���il��+k�>����J��7K�%��z��Xܜ�R��R��Ȝ�����i�J�9f���k�n��=�ȞcwvڧVH\0";break;case"ko":$g="�E��dH�ڕL@����؊Z��h�R�?	E�30�شD���c�:��!#�t+�B�u�Ӑd��<�LJ����N\$�H��iBvr�Z��2X�\\,S�\n�%�ɖ��\n�؞VA�*zc�*��D���0��cA��n8��k�#�-^O\"\$��S�6�u��\0����r')�D��-k��jui�@h.�r�اH�PK��E�;󸅪مN�ݹ��o:��l��Յiڊ\\A�Υ�2�����@���z݄���Y��w�26\r�Ӥ{��g��O�{\$�yl�u,\0����4��;TV��8�2���a4T��p�7\r��1��9(\" �:#�� �ʄ��c��8CqX��c�624d�*�c�<R)�0u�RJ^#��HE�����ru���<��m��V4�� ��)U��(?\$#p��q�B NC�)�10J�J�`�OS��u����BdT�-�M9/�[�u�DA�L1ir[���v	�Z��v��4���U8�1h9Zu�EK�S���I?###�X7壏L΀T(��ZvXk>�N�D�EQP���*u�c����ց �)P�:�-�x�l�-�Q�O0�*aZ����[)��w�7�i^�#�wl��>7��A�M�C)�����M��܅GYlBH�B-�9H�.��h���\"��8�A�#��=�Nɤ\\�(�b �9�#`���07h�:���x�<�(�9�#~��օJ]u������Gi(Bj�<ֶΩ�B&��V���M�`P�7��\0�0���@:���1����:��\0�7��\0�2#�0��\0sxN�\0��P9�:���n�1��%��Z�x�z�Jb���\rq�ͥ��# �\0001��ǭk#�@4C(��C@�:�t�㿼>�Cc8_��6�:k#p^�T?\0��^0�����Kr��ȣW\"@��wd�J� \$)V)�:rHBN!J�)��F�L�3h����K�G1�=����{Oq�w���q�ϕ���Z��}�P��0mj���?����h\r��:7���8iFF=���Є��d���K\$�	UT�	�^b��4p��cZ�4���9�N�9D%|C4E��A��\\{�B��\$����\$B�D0�C`sG(��h�͸P	@�#��\n\n�)6)�v���[+���ΗN�CkP�8?C\"�C�r\r'��pʯ��r�����ފ�Ï��	�*���1ӫ�#ދ�G�89�7��I�!�8:A��rW��4���gz��<H����Vk͙�S\nA�e� N(�%��\nH�R!^d��A4���;(�����\"��&e �0�LiY8f�!�x�e�	*�����f|DRC�6��(PBI!�:�Pү�R,j�2z��C��Ea�\rׁ\\�B�ǢH�3Q��(!@'�0�|Y��P��Z�a�\"���qk��)�<����)�B�X\$Br��}�.���*���9\"�\0�)��A�j)�*\n~;D3��\"\\V�ZK�M��帗�.�ۅ\$?H�	�Z;	�[��	Uf�]b�@��1ghh�3]u��X��%��#(�Y](�j�m͔U���iq�c��Z�W��lu�{����pv�f_��C3��E#GV�]�+��l*�@�A�Kx���,	�7N݊�&L��6��̛�ΗQ�&��b&�N*��D q�-�MƐ���n������-�H�M��5\n�@�ҝa�R�g�b��1(��q&)����+ȩ0�`�03s4\"���5&��'�:�<��j+E�\$�X����w�|2�[z�]ShT/j��Ђ3LKE+�Ko�RW��ޙ�㢫�5*D1i-M(���Z�\\��kh=";break;case"lt":$g="T4��FH�%���(�e8NǓY�@�W�̦á�@f�\r��Q4�k9�M�a���Ō��!�^-	Nd)!Ba����S9�lt:��F �0��cA��n8��Ui0���#I��n�PEc	��o����1v\"i�1�1��n:F�79!H�d0��1�S]�q����1�P�E�y�@h�D���v4ߌ�Y}�@u8b07SD��a1_������u3�/����NWV\"d��������q8��*.��d�ƳIӮ\n)�M�pQRɀ��+	;~d����^��7(�9,i �0���?\rcF�!��౎�\"9�c��2\$����<��P���J�\r��:70k�t���z��9�J��\n�*Q���ւ+���.K�6 ��\"�(�2�+:l���\\����(�6�\"�0�@ַ��rֶ���)��b��zj��\"R5�[((x�BӰ�<=iR�)i{.0��PJ2�ʠ4}\"��%+HRC��-`�A b���P�#*����@�:�S4�k���Rhh�2�#�V��#��1�(�B�aC!�H ���K�S����Z�m�'4����2P\\�W=K\\�z	uݫ��0ܫ�	W�LC�Z�@t&��Ц)�B��\"�Z6��h�2Zv4���L�Ii�p�')z�\0�\r�D�P2�ܔ��zH)���#��8�-��3�b�2�p�;b���3���ދ%cp�����1����:���޳e�b�9jn�����ڳ��P9�) �b�i|�=qSD7)(b�2��x�4�^3dir�3�ɵ�C��1�)H���4:C0z\r��8a�^��H\\0���,c8^����Ў�!xDv�G�}���AL�JU��C:��ٖ���WCFߍIK>��3\r�#���0�g4���C���?R;�}o#�]�i�eـ��'A�C�~ca��<&B�t\r	Ⱥ�N�P�p@MD��G��˚�\\�<�2��bn�@�(F�P!�!�� \0�jZ�b4PH98���a��6��Z�]\$M�B�m\r�K��1�'.|	c�/%�|@TCHo�e��Fi0��I%-����(����t�@PCf%\n8��CI�5F!B^m�\"%��;�R�)P��g�[/��)@Ѐ��v!�E�6����mY�a\r% ͨc\r ��\"h�Q�f�9�I`I��(\0�!�0��i- ����o���CgK�6� ���u� V9FEr�P��i//��2'�`�5\r�I�A�Ȏ���u��*�VO�I&vHND�e��6����k�f@��ƿ'1,P\0c\$Rց��\"j� Ps �\0�T�h��@@é+���{R9\$�r�\rd`��I�5��̊���Y[�j\r�7�� �%E�n~K4\0l	���D��p���4F�|`�f:�%HL��B�cF@D��3h�W���4Ǭ�vDH�G�u��6P��Z�G�fע^��Z�p`%>W���lH�^v2¯{�,��k6�\$Cke(|bYA㻁&����R{V�A.B��OP��h8d�R�rIb};�h��6wٱ#����f ��#h%�R0�R��A��\0F�y%NA��\0�T/��j%DX:Z`��\0y+�D��Hqc/F!���b�A� %p6�׮��|ʾ�d�H��XӔ�A07�'t��,8Ry���K�jSB��9�o�y�Mq��_n=�SX��)�F�,,0�(%�,c)(��A��2�Ur�9F��K�`QH���N\n��_i�'@�p";break;case"lv":$g="V0�DC���s�����e1�Mг��~\n��fa�N2�OFC)�sC͐�#&t�&�)��2��ӓ�F��D�	�m�� 2�!&r�8�	A\0��B�P\r&�A��e�NgIt�@\nFC1��l7AGC������F�\"�%I�!�C}�j��\r'H(�a��g�p��a;��i>)L����\n\$�pxX�`A{7��A����W�FE(Ņ]����{f\n)�L��#��@�����匉�u�-&����E9N�˄�vMfi��л�r��N�\n�\r�C+�\0���* @5���U���Ȳc+,2�®3a\0�0�Cz�	#҈�\r�S��(���c������6�����������9\rj�<)�cJ�^1�x��<n��4��P�/c(*�X֮F!D2��kν�`SB�\rl\"��5l0ԏ\n�=+5, ��r�!�B�71�P�驉⌊� AHØ�TcG�(	HZ>�A j��@�Bj���o��5���!a\0���BZ90�S��\r�k2E\\,�I1'T1H8\"�k<'=��&�B�U(Ilh���[Ohv䲊��P�f��pp\\V�H �@�u]���w�ג|͌��	@t&��Ц)�C �\r�h\\-����.ؖ5�>����86BJ�@� ̸ŐF�唌���2��@ߘ��H䢬lh�:T��tX�=m▲y�r��h�C;Z�:B�/�N����c%����rCyZ2��\0���N�cʡ�V�uj9|�Uj�v�춺l!ǲ���@<��]�^��qZ{�������渎���9�%M�ʹm\\N��Q\\w!�g�ZP����U�)H�3�cS�����F֬.Ѡ�d�)��	��'>0��Iv���i�x�\r��3��:����x������9����xə�Nf�A�h�+\\��0��B\rٽ %����HC#�oܴP���:e	��O�i�e����e�q\$Ie~��@���{��W��_Xw}�<������e�������\n�>	!�T��B&<��4\0hѫ�I�x�B�hAN�ed=��2\n��!����*����@�%�yC���m���P��v.z���P�;On��!�&�ک�%t��O�q�(�0�4�	�f�(��e�oC�0�\$h�Qx�kj�'\0PU�L(3&�2��lO�����Y����%�p/K%s2dJ�3ras��B�\0M�����ޤ&d92��]Y��'\\4�c�8!Y/ ��oM��5!T,%)� �pE�\0f��z��`��m �YY��A^�\"^g89������i��>V���A9\r�<b��/�qpn��b|����^®:�nC�eK-�T<�xW���3j(��Rr�ոlAg����qO\naR+F�#�=:��,�I�Ԙ\\�pn�<S*P�	�52�&C�ɼ�nm��4�V���jO�7&��i�M\0S\n!0��2jMÛK'�4�(�52�ņ0��C,�2�:�5ur4���f����C��h��5�J�dg��Bm�So�V�u[������a1�<��]�O[�u�<��p�<\r�����U�ܐ�މ����#��&T*`Z+�-f��\"�2�1B^����fI|��dH�#k�fA��\n*��|)J�Uba-K�pI[,a�&f�B��Ox��r^�-��6eaP�?k���h��,.���%b�\nƃ�N���+\\�6�e��9�����Q؆(k�!����:�W�2\0PK?DO�R��u�Q\n�-٬\"IҾ?�K,���М��8R6��o8�,/{�y�>'���C�}�����\":�aܽH����G�,5���B���\$���� 0";break;case"ms":$g="A7\"���t4��BQp�� 9���S	�@n0�Mb4d� 3�d&�p(�=G#�i��s4�N����n3����0r5����h	Nd))W�F��SQ��%���h5\r��Q��s7�Pca�J�NpI��u����\$�D�IES%:��&��� �RX>�.�M���� 5�nP�i��a�^����55�M���� �d�9���РF聄�b�NN�SD�{¡KNx�\\@�t2���3t�%><���B��� �=��U7����r7���H��\n9����2�o�,��� ���;�*���\$s��)�*:��;��)JjV�����:2KP�7����0�CZ�᥏S��Fp����\n���,X�@P����p�� c�껯\"[�(�b(�	�zr�1 T�-��B���P��&��ꅌ����!,�1M� �2�X!hH���!� Rw�jZ��n��	\n  ��p�4��h��̯�F�CP�=	�0�4�I� �����3C*>�C	��4U��K\0(5J�\$	К&�B��c͔<��P��� K�)�����6@*P@����n)+��o�ð7&H�ݧт2\r�E&��p����0̶��*J(VC\nm,KMd�Kӳ*Ì+��IÐ�� لˈ���)X�S.�ʉ>��Ѭ4�ͣkr:\$��+F�����(��(��)\r\r|���Ġ�(Bə`#�G����zԍ�Z6 c@�2���D4���9�Ax^;�r��;!s�3���^2-(�Ҵ��}����Z�}x&h�ʃ�8:di�)�����0�jK)U�Np��j[�`�D�ǅ��k�Ųl�Fն�v��n;��7n�R}v���=���p�\0�y\\�T�i#=F0��^&ݍ�2p�@N++V�r31y��\0�#���0�����3?-,�0�����Ɓ�f�}�'�C�H�(\rW���Y/��w����NC�7���@P&����\nU�h{D�<�ҨU����|���87��bI�='�I���IQ8����\\� ���H\\y �=���CHfA��3���Pa;l�=�|S\nA\$D�5�B�ᬳ��~a\"�z�|�st��43(���%dC�3��6��m���,�\$���!-�h��s-L�я����V��J�Z�H4���ܔ?t.9�=D�q\r��Ja@'�0���gHh�\0�C�:�	Ο�8B\$�:�aV���e��\r�r1B,F�*S�(��rNI��3,@τ`�����\nq�S>��3\$���:EjN�)\r��I��	�6&΁���C������&��Ң/�T!���\n�mdn��3fQ���#f��\$E:�,<Z��\$�\\Y��U\n���KG�P��}&h��ҘV�ڛxZOC�<=j]|\0��Nь	.\0�0s^*M�J��ǜ�^�Q�4���Y�J\"T�\n�k*Լ�!�ꮞ*�]�l�q�l�\0���|U�\$������\n	ll�R^��rf3h-A���@�a4��P��Xz�0�1Q0�";break;case"nl":$g="W2�N�������)�~\n��fa�O7M�s)��j5�FS���n2�X!��o0���p(�a<M�Sl��e�2�t�I&���#y��+Nb)̅5!Q��q�;�9��`1ƃQ��p9 &pQ��i3�M�`(�e1���aʔe��F��2�NK��&��.S@Ud�\r5����\rg���.� (�F7@��)��c4/�|�e\n�s\"�U,8Ng=i<�s�I����Rv��h��0���qz�[	�9c�t�TV����#���ž��8=bF�20�:��P���NRX�>�(�:�(2;���J�:&����@;8�+���9�Øt�j´�(�+����Db�!i+*�3M<:'�R�\rC#:�#K�#�f�	��Я�����P�2\r#��ʿl\"9��(�\n����P�����d�H�Ԋ<H��6IBr�:��W5��H�<�`M�Q���0�K�N�hH�A�-'����C\n�)��[�<���#t�	ql���J�+:H���Xԡ=���,n�2�h�����Q�M�\\���IiY)��:�B@�	�ht)�`P�2WhZ-�W��.���ܩ���d���p0��z��L!����Jqla�\"���������6�3�����hmIX���;�A@���N�����O8X\nbF�\r�gB\$K�����j�:��p*=K�_�y�ŕf��ݝg��9`�B�Z3S��j&H:�cH9�� �?Nɨ�4\$�Z�l�Y��ɥ/c�v1�Qc��\n����D܎�xt��4&<\".�8^���\"ġ�+^�4��ka�^0�ɨ�B��Z���Hj^ɦ���j;�B�N8A�5���B���%5'~�q�p��r\\�-�sC�9��\\�Cэ�{�?HD���Hڗ6��V��]�@�`s��y�7�H���l��P6�y�6�F��#���2�2BH�����AGv�3����t.�MJi��U�6���{WNƥ�?�8GC1�#��u�E���E(����PS@\$	\"571V�\n\n�)&����s\nb�PU��;+��W��<C�gI�FĜ����^	d;C��(��MB+`�d�S��ʉE �\r�g��СiG.)��]�\0w�խ�b�S\nA�@�@��+Ll-��\"v�Ax�ԛ��vOO@Z\n\0Ԓ3�a�!�\0��jV���uY;�ވ�K�pNzU�G!�ge��~rZq�d˒à`�P\n\n<)�@[6I4m*,���ˑz����IL�q�}h)���q��p�U����HY�S�\0S\n!0�4l��.&	�h8��\"q���雇%Tu��9��RP���)�I&>�S���NRT�ڰ4�i�Xd&�=0�Vi'NI%i�1C�:TjCcA�τ@�R1�B��0c}\r�Q#J�\$�<R	L�D *�@�A�F\r� �3�0�+A�K֨�V�)#�W�5R��R�5D~���le���BN��H	�*�2��V�	=Q9�| ��L�PR#���V�@�#��dD�[c��4�%����\nt���	�}���P�Zs�D\"�p�8RaqF�8���MQ\$�e�Rj쑫4���/���	m�5/�[K������jg���0�\":���U���\0";break;case"no":$g="E9�Q��k5�NC�P�\\33AAD����eA�\"a��t����l��\\�u6��x��A%���k����l9�!B)̅)#I̦��Zi�¨q�,�@\nFC1��l7AGCy�o9L�q��\n!������p��&�=.da1O͐�IH�d�^JfY�f-z�_�F&D�L7�}6�1�����2�_r[@��������./��0f�I0�g���		�Yu��u�	�\"����\r�nI�L��x[���S�ͻ����p�yʦ�Y��w�B�V�I�t�G�Cy�V�:Øꑭ���c��2%\"�l6-H�@1=-�@0���vʨ\r\"�9�\nR��\"��R)��K�	ɀڼ�� @�CHȸ-�L���`�;!O8�2��b�0�r��B�-���\nD�:n2�)�S4��ΰ�魑`��2�h�	�)\0�c��CP�\"�H�xH b�o8�;-\r0��(���C[&��P�͌���A�d�\"���ޏ�B3&\n�Jl�ӌ;3ɬ[e5)�\$��C�]7�c-l� 5��]O\r},\$Bh�\nb�2鈶�څ+^.մ����\"��0p�f��w0��w�<\$r7���`R���jf6�Bv<�\"�ނ.��3SJ���H�,��*\r�xA/��1�o��3�b92]�cQ3��\n��(�XڶbC(P9�)H�:Lu��H\r��1�H�43ik�����@ ��z.9d���2�x0�B|3�Л�t���2�s��z���jgx�}���`x�!�Ra�[��\r�������X��X�6؉Z�9T2��^�<'\r]�������{.ϴ��X���]�w�۪�	#h����\n�ﰴ^�2�=�35�X�5'm�+K�ڗbpZ�^.���h9�C��5�%.��B���&�/��9E�X�3X(�c�D�Y[����>��Qx g5醒܈�})�H;#b~P`�~CԂ�Bv��(P	@�H,�M�((�������Y}B���5�E�S;FG�4�U^a܂5e@ .n�y�f��<��Ғ�9-f��?34�R�|�H�����;e����Ĝ�ANlp�Ceᝯ��\nFa�%�؞q�S\nA}�SJ�Mn=���f�a���\\L�a-̈3��J`oa��8���P�|���\"XF�7����D'��:����1i��\"��A���EJkH���qކw�H(k��A�\$��P����T72cP�[�'�\\�>T>CZ�\$��:�8���A>pP���r��#�ܑB�4HS\n!0�fEZ�F\n�A��t�q~�}�)(��~(a���H'\$-Fd�p��NeE#>�Y-����!���Ȅ��yN\n�t����\n�Z!@��b=M6TfJ�v�̓�Gq�P���������M�Y�s�f��Z\\��j(eN����	TqJx��rn�PE�jU�Hs*�	��-<�w��s9�ǂ�w5���5��[�DJ��i)f���y��ۗ;�Xc�	�'�6�L�+U?�Gx+�Σ�ZcJa��\"�^����s��M��9��T0	\$R�`��}.�";break;case"pl":$g="C=D�)��eb��)��e7�BQp�� 9���s�����\r&����yb������ob�\$Gs(�M0��g�i��n0�!�Sa�`�b!�29)�V%9���	�Y 4���I��0��cA��n8��X1�b2���i�<\n*N#���t���(��7d؊d��M@�!��a���\"���r20�gy�j�u8GpP�*@d��r3Q�A5m�tCH(�a8VnWK����p�j1��y7rB\r��h�L�8';��a��� ݃��Y<����QT�}B�]�	�4y1C�G�i��7\r��9Cx��1#��׍�*X7���P8@Ш��c�2*p+���x<�(d7�:V�@�Ӹ2�hA\n����q3��!���� �\n�'�lh�Qc)(-��=A�0ҠRp��� P�2��P�9.�S���j��@,\$A�H��\r�x��cK��+���70p�5Obt�3��ȉ��30:!-\rN}#I���1O�Z��\\�b\nc���2c8�=!�0ء�2�B`Һ��R\0�@L�0�����H�	�.;�l(��ANBRb��ފ�A6�2v�攣�}2�\r�7�\0G7=�e&�h�q�W-��^il�����\$Bh�\nb�\r�p�@��(\r�)xף�p���cd�3��X�r9�#�N�8�<��zm] �8�1�H*��#0̑E���&���:��~���ZZ:��0�4!c�D1D��!b0���1\0005p|�}�����]�Xɦ��.��:ڦ�Y��ԏ����lY�ڐl��A���~ڠ�鎜��z���3���kÞ�1p;\"Z��<7:&���}Cm����E`�\$�'U�D����#&�o��Ԙ�|FL��43�0z\r��8a�^���]gwp<3����\n\0�4�!xD6S�L��x�hH(Ԡ����8�:���O׈��5#A����R�C�(!����X����@��w���k�z/M�G��Ѡ.{ou�VZD�n|�@�v��q�I����n[2��ȉ\n�^1e���H!,(1��%�O_�@ED��%�_�~F�;�\0��6\n�����ىBYA�� ��2IJ40�f\0��c ��3X���j�RA���Pxc3��`��)�3���i%��\n��g\"��\$䬗F�z0\"R^LI�vP�e���` ��S\"�<�B��;j2�\0R�b�6�L�X1D����J���%5\$�1����i�����<�Z\n�!�#�Ȝ���Ν�F(�gQ� �hn=��m�\$�-hi!�@P�@ijn4�w�gĉ%���j�4� E85�\0@R�P)����W�aE1�9��Oܮsε��PցR��p�䝓��SH�8#�G\$�#�rLM��~�yrD�xn�cf\$�;���R�m?�ܔ�B�z!�ԅx�O0���jpP-Ҷw\"��%9a���`uky�TB�]H�:���j\nH�c!��2wK_Q�K\rf�)���ɀ� ��;��DR��MWM2�0T\n\rVK(ԩ�˗!�4#<�˛�1D���>���6��*����\\3'��=M��m� ��K�m[Hy�ND���`.��@�]���/����M`���`+\reT����3�9I�D��ó�S�QI&�,�[(�UI-&O\$���b�s1A�H*�@�A�6�w�ۻ�k�j�\r��s9y*����\n�.�Cl[���h~h��V��v\"�\rҵ�\$�ӑҸ1�S]��7����M�,�i����A\0U�WT���I��6���If�[[ľ���T�_��j;���r5��{�-�N�\0���>��K�#�����f�^�!�o\"�9	63\\Ԝ\rF2a�c�q|�>�qU���9�t%ef�^\r�VW4\n���ģ9��";break;case"pt":$g="T2�D��r:OF�(J.��0Q9��7�j���s9�էc)�@e7�&��2f4��SI��.&�	��6��'�I�2d��fsX�l@%9��jT�l 7E�&Z!�8���h5\r��Q��z4��F��i7M��Lx� 2f�M\"�p��N�CI������=v:LRS	�pM7�\r3�I7��\\�c*i�@D#-޽�M�Q��\$�FNYQ�je��1G!� :6�pG:�9�.�jY'�����wf[2�jz�+�r��/���vt��{���\"��j��	-ޞB���\n�p�7\r�ܓ�I���s4Ό�\0��8#�&:�����������3�P@:��:ʡ-I�Z�\n�����\0ԡ5�p!�,\nVɗCj��P�2�'��K��B��2��,2�x��9L��3��Ʊ�j��%\r����L������Ή�2��;#3l�!� @1(H�Ԃ�.@A j���@�B�l1���8�#eX��`�үb{��4�b�4� P�����J2�k����jx�ʳ ���� ���\"�)[%J\$�ZL�%S�]I���Ư�V�'κKb@�	�ht)�`P�2�h��c0��Íb�N���J����	r[\\N2������v3<WJ�:\r���7�d:7��3j��2)�X�\"@���z���1�R:�h2@3�5d��!c�9h7u�	�\n}�1c(P9�9�����H�I� ��z0曧-���Ѧ:7�\0�2g>���,-` �Ch3��:����x�ǅ�n���8^��B��<AxDsNs��}�gmr�8&�.�F1�'>C��D3���\$[�����Zp\r����O���#�/8]���w.<c�7<��H�88ғ��tظA):-���p�x����P:'~t���� NC2y�anc�P��0���w1��Ϳ\0��[� a�݇6�ښCJ\r�0@��t *JD�?2V�5��\$1�P��NO(�����!z?D@\$F���6\0���NW�A�dx�@ؒ�Հ����ӈcN:����D^��w=\$��cHV�/ء�N !}���D��A�U:/�7�R,��H�>r���z�d0�P�{�Ba)� �ILm0��-��}��t\r�\$�nNߜ�AD�3\n�P�A(e��J���@F0�Rh�` E�(�Ύ%K��H<��\0aQ\n�\r�8�3h���1&�	��8@J*�F�Tî�TxS\n��+�x�S� �ji��@�� u!d���|Fft�|G>�T�Krq<!��uSa�HL�gT&��M j<�\0�Bb1�\0�p�\0�!�=Q� G�D�ڄfoH(�`r�:@e �Scn��	�&+���Zn؉�5t�F��dC2h\\K���'T�`\ng�6��c�}\$!H���#i?r�%�����Aj�HlZQ͘�B�T��p���t'p�(�3K�A&�R��x�.Bv�&P��;�#X�|��6٠4A�<���m�<i�1Z��@QF�u�Sc��+V%�5�fik]m l����p}(՜晖Arl	�\n	�%��.�)EL'!�أ���2�������r���`�\$2U�d���x��?�Jrc%�.\\���g������b(C��G1�MS�";break;case"pt-br":$g="V7��j���m̧(1��?	E�30��\n'0�f�\rR 8�g6��e6�㱤�rG%����o��i��h�Xj���2L�SI�p�6�N��Lv>%9��\$\\�n 7F��Z)�\r9���h5\r��Q��z4��F��i7M��L�� 2L�\n��A(�NgZ���ʬ�hA��b�Ns�)��/M�8Y���f�6h8��e�َR)�d�u2{:�-6n�s�D�d0�����?ɜ��Wmh�ܕBM�ꙸ�/�i���H+��2�0���~t���x8(����^\$��zz\n��P*��X�7��rT97c�r\":,�D��.[�:\"è����D9���Ȝ��@38qs\$�����3H3Va��򰭫�h@5(m�h��.��Cj�?�� C!0��\nC+�,\r\0���J�/�C'-/B�V�B+�*��`޿�Jx䞍�Z�\r���ܿ�J2�4=E�`P�H��PH�� gL� P�݌c��&�h��b�Bx�İ3����P�a���\0k�c8��������F:��Ѓ>��䖵r0�qx�4�Ib\\���mi�l8̾'�͠��`P�3܀P�\$Bh�\nb�2�x�6�����\"�v�ׯ��]�f�*�b�%x`A�E�r�u��&6l�.6?\0S|�%��3�c\0002�(ZZ����^*\r�\n|<�C&1�I�:�5T�9��(�]v�\$�btB�� �@��#\nJ�Q-�w/*�\nr*8Pm�c#p�#&���ǌ�)�x0�-���C@�:�t��;VW/�8^���K��axDq΋��}��m��85�(âđ|b�hC����*�'<�`&�H2`8D�M^�t\r�Vn{��o[���pC�	�O�@��q��W��!�	#h����1�bl<�:(C�'�[�1��}?;1��n�g;��K���N>��:�'A������wXd��>�ƞ�� !��\"xrÛ?h)ݦ@��tϊ\nI�%�'�\\I�#��\"�#V���oF���x\\I� \n (\"Hg�� `��̑M0s\$%���r�}�����bl��R�����@`�PwK��Bcڲ�3&\0;6Tt�6��ÿWpB��|��7\0��#wJ ;�@�A~oMf���o}HH!�0���m1���K���Om6:�x���Q<瑮���P�*6�ѡ���TJ��3D(�.�]�r0&��G���BI&��D>E�[�:�۪r̋��m-��G�\$�S�|�U�wdxS\n������\\)�T�2�@�C u!���'LY\"5�Jf�r�]�q�\r�,3�(�lQ�\"���	\"%T�h b/��)����� Z\0�#HzO�AF���i�4�'Bʶ{��:nֲ�1'& �h��\\k`�vTC�O��ݰ�O��'*9Z����[�Q�J%�V)��g�6��U9\r�9��쪝�/n�p��TNB5!\r�I@֘B�F��l��L٪��6�2�-s�-HeZ[�ڛ��-*~s��<H	\$����0E|z�;4�+��i�0y^�1�p�B��\\4*�)�ʝGdʤ���i�U}�4�s���o/��;Q��΁�WVßРP��Vb�b��L� �'��S�\rb����v.��t��0dA\rU+��!��{8ׄ#%	�1��ڣBE�u��V0��P�Ѵl��H";break;case"ro":$g="S:���VBl� 9�L�S������BQp����	�@p:�\$\"��c���f���L�L�#��>e�L��1p(�/���i��i�L��I�@-	Nd���e9�%�	��@n��h��|�X\nFC1��l7AFsy�o9B�&�\rبi�^DIĄ�l4��'K���G�#+82b�D�t0����,�d4���Q\$�s��uh8�l瞒I�f;���=,��f��o��N�s)�� ����h��4:I�N�;ق���� �A�f����2�4-����� �!������9cp��99�P��2�P��A���5��x��&c�𞈌[B0����*�n8´8D����茺��J\n��)cP�!�j�/�H,H^4��l�(I�Ħ��;5)�4��%c��1�c+k!c���:)	��2k܊\nH!6���(�6���z4�J�3�,��1Ld�(H���֠C�X&\r�<��	��7�X�5��͸M`J2|�@�5][W�`P�P��pH���!��\r6��(�E�<�����30�ь�{�(\r��lL���4�\r���\r���P�C�}(>��@�3@P���0���,����J+\"\n63_����/�����1��h\$	К&�B�����6����\"��p5O�֦�i¥V��b����q\$R�i����e8(�7V��3P;��f֠���{\r�E><�Mx�1���3(ce3\0�V�0�K�A�`/raJ����S06����\$.�a\n����\0���i����l\"�%�C�3��:����x�х�R�PAr�3��^2=�X���}�/���}�N*`��2b9�����:��?!l�h3�C#�z&ĐZ?�c�X�y/�jr�,2��9�tI�q�OW֍�n{P���DT��I\r���(��;P�4�XtJ(k'\r�N�%>���\\iAP�I��?D�N��@�\0h'	�8�@�964D�98U\0�f{�ݰ���[9��0듀�GI��>+�4�ւmRCDg���E�u�,MF�0�A�BI���Ԫ~�ARn��*�^�q�(��X�C�t)�e���ك��'�i@\$t�a�a�gQ��<�b������xRl[yN%��v�d�d\rā�i��c\r�9�&N%\n`.Ҭ0��1�\r�H�'rb�l��<�\"�jI�6K)���2�Q��_\$��ޥ⚋W��k�\$0��j/��\$�ZE���z�>�\0���N>��:�rZ���t��\"� �ّ,;(��=��CQC\n<)�I\"��>�\r{�r���P34B%�D%\$��H萻I��%�-1#��A�A���&���,�\r�)�ŷ�L+i���������V�4�'!ȝ��dO�gJ��x��7V�A̲�p�Vj�K��&i��SYU%h+5p�3:�7P31u�}��`pi%Į3�Y4���4����\0j,VV!S�z�ls�r�n�A\0v/��x��*ҭ��K�e��\\9Z�m�*�@�A�H\$��d������ŰKpX�L��E;F�*e�����h��M�!�<����CP��t��|MJ�\n֍���>K�%۵�1����1��6B\0@0�]��d<a��N�e�^'UI���\0R��E�T�QZ�Z>���jD�9����X��WLr�4��2,6̨E,����k���N뭅�hMf�8�B#�y�`t";break;case"ru":$g="�I4Qb�\r��h-Z(KA{���ᙘ@s4��\$h�X4m�E�FyAg�����\nQBKW2)R�A@�apz\0]NKWRi�Ay-]�!�&��	���p�CE#���yl��\n@N'R)��\0�	Nd*;AEJ�K����F���\$�V�&�'AA�0�@\nFC1��l7c+�&\"I�Iз��>Ĺ���\r�Yy��&K�\"�k\r��j����ce�4#������� ���G4C]T�B���C6�������(�N�f7ʙHW�:f�suQʻ�nL�U��A�8��|��|Ֆ�!۶��n歎���)#����c�hB))\n,\"n���h���m&�ۄ�6����C�J3�o�������D<��DJ��P�l��q�0ۭ\n.W�j�t�,E�);��ե�B�'ͱ�\$�B�ߗI꯫)�W\n��B���W&��\\`�=m���%�0�=q*�� �̙2Eo�U.@�k��6�<�@Jj��.�\"�]���O�d\nö�����4��N�(+�2J\$]���xh�����&�:±ŭd��%�&���=\\�X&���:��\$@#\$`>��,Kt�ڤ�s?�-��E;�=\$/����oҘ�Ɋt���T�=U�����t��8F��xnh7����E��'A j��@�7U��Jo�\0Gb��x�ZL�k\"\$�%?��i�M��{�a=��}% 2����]p��<y&�J��F�>��j]zת*���T���@y,%Zܹ�\"�\$e��ۿ��m�s_~6Jy|&�ֱm�{�޻��={��Xo��ؽ�\\8�7;���/j���TU�J�F�N\nI9�B%\n2���u�^���Y�b쩊h�����*�h��\"8�Q�k��e~,�+/F������n�Bf\r���*91��B��O��4q�&��_ox{p�h��M��n���9�.��Za� H �#�қ�[V/-��%e��a�6�c\$�t-ܻ�5d=Sa�P��~�!���\$��>!Dy\\�h\0�`����D�J�4O�8�����(�67f|T��o���?V\\�!;��O��'\rl3����C����\\�����\\_�l���gMy\\r��XD����� �a>��Z��\"�P�����P(A��4����b�0e�-7��A�,�����M��a�9P�Ah��80t�xw�@�0ȹ#�poA��P�� o\r��:���>�\n���2mP����0��Z��Qh&y.�\$�j:`�د��#��{�+��L��8��d_��o��Y���?HIb\n��ir�Q�YO*e\\����Y�Y#����r�_�P�%�s���)��ʁMQ�sM9��a�z�E�@D�@�d�-�u��P��%��9��8\r\\�D��N�#}\0���w�E��R�]U��U%5:Cɴ}�S�6	�9�R�nH샎QE���pϔ�3Ԡ����T�T���}6Ik_,L���s�Ա�ki\$�%�����=j9��J^i���jbh��!dCO3B=C#�\n�).��Ժ��*�*��覴7*�t��E:�3c��ӝx6�qS�HVa'��CƠ\r�N��_���lM��_���x��	�x�y;��qu��tK�aóqK;�f*��M�X�6O�a��yk��SҬR������c��婚�ĂW��+� ��8��!)e��^S�,L1�DZ��|��?��Oب���y\r=�Q�E�{p�Qjp��Z�\\Q��T���\nB����r,����H����>s�C����\$�-4*����Q:��\r��2	Q�XE50@xS\n���ף�Y4#�Q� \"Qd��\"*�ی�� &7rc�?��&Ŧ2rj�z�y���C���Ŕ[I�c�Q���I�+[��Mf��50�0#b*��:�\0���=+��aڽm�켄6Ȉ��\"�#\"_&�bS	�L%�j0V��+�M[Oj���K�;3�mn7���\\ϵq0Ƭ��I8�q���R-�\n��ܫ�}�����>�/m�{�Ld]Z,0\$h�1�7�X�&��KV��]�B9�d�GS�����9���]M����N��uQE��s�J��bQJ\n�S����;7����0�>��S}[�?�����;	���X8ަ�fnɶ\\/�P_}�	�m�\r \\��v^���.4��[�1[�˄�Ft�U���G5'�2�&�-���R�{�~*�d�0L�?38-긨��\$�B�yw\"��`������.��-%�؃�~J�RB5�86\r�H}�1%���飧�^m�������kt�ؠ��ӻ7\\\$K.�?�.>�[���+\$~�FD�l�݊�4��Pz�{�m���Oo�Ov9ǳ�v�A��\$�����InG³�(k6Oj�Ŋ\0�KTa�dN��d�7�.\\)�P��*��L�	T��\\�	d�h�� �Ix��^\0�`��t������ox�',j��ӊ��ɬ";break;case"sk":$g="N0��FP�%���(��]��(a�@n2�\r�C	��l7��&�����������P�\r�h���l2������5��rxdB\$r:�\rFQ\0��B���18���-9���H�0��cA��n8��)���D�&sL�b\n*�W�5i��t�/�f��@t<� �*��a����~k<�J��	��'������F�bRN2��8��0;F\rƚd�@a5֌&�I�`c4�p���'���o5���o�Q&��\\���7ߨ�aC8v�:��.�y�҈��C|�͙	���Ch�T<�m�1\$�`=.�@1�X���(����42#JB�\r(�%\"��/�jy���h���H�(#p��Z�9�*2���*ʶ2�\"�ʓ�c��b���\"`�Eȳ�0���K���48�7��(��B(�4���(\r���/�~	2A9��@ؘo��\n���A��X�AP��x	�\nv�:�[���\0Ă�M9OT�EN��c�&p�7rxH� iZ�0PП�	3L5��*����H�7�m���	�t�#[����L�_M�l��Bxȡ7���_P(�4����B��*4n����t^����m(�\\�N%�^�-�_v����	�B���\r�\n`�M���K\0��S��	�ht)�`P�\r�p�9e�����2J����&�h�7��\$&�z~�Ec��T���8c.~�%6< 0��X�5�͠�3�\"0��)��oR\r\n�EW[>P���5������\r�iAb�J�\$��\n,���j�:�W��V����^h�㹤4v�9�;�!�0�\\�%G�\r�F��b{�#[���r��#X�L6�9�?����]�Nɻ����B�D,xɸ%\"���w��콯��x7:����x�\$�(��C@�:�t���2\$b\"c8^1�a}�Lài\r�� |���p�02��^A�\"'�^�`�����h���c�[Ӗx���7TX+Qs�/ȥq*�{T�'B�4J� �r���ƉK�}/������߫�O�9?��ʹ�\r�j\"��Hm�4�� t�����ތ�yh���\0��o�Q���gۉ�S��4q�J�ZdU��.H\\�\n>ʹB'f_a�<\$����Ty�u�1���yE�\rN��לj�+G�%X�G���yZ�������!pLL4I&�}�Y9�\0���RG��Kx��G�p����L�猈���&����\r��90�J\$�h]\n����?�F�C zF0�'vKšz)��>�n+N�uN�r-����CY9)� �V��&)��b&C�w\"�������B�	| \"Zl��j#G}59m�S����/O��-p�5�wy?!�����5-H�6G�a�%F����\$�聇Bl���w%d�\n��S�mn<�0`�T�١p@�I�������֜�)�9)�Է����C1s�z����ZI�O��c%A\0S\n!0�'R���ɨޒ4?�@oGe\$#@�{�r!9��8B�T�E,8�)�<MȰv(��kf�H�?f���S�qf����`�yp��ԘW(���1s�\$�;E��ni\"%!\r5��V~�Hk7f��S:\0#Jz8\$M�!D�m�]4���J0��<h�a�5�_�ЭT*`Z	M�3Rh��Fq�Se,5�a4e4L6-�ͪ��Hp��bT�^�,3�	)\n�P��	P�#��3#M\\\r٠E\nY\0�х)#1a��dU-��ʁn�*���#Zy�d�Jg�9�'|�2���er)��ɩL�#s)�\"�)��Z��S\\��0ʠ��7D��]SV����S*3X��XOjt����H٠���\0���V������S�s�(QDcC.�3:��[��(";break;case"sl":$g="S:D��ib#L&�H�%���(�6�����l7�WƓ��@d0�\r�Y�]0���XI�� ��\r&�y��'��̲��%9���J�nn��S鉆^ #!��j6� �!��n7��F�9�<lN�	��P���S��-{��M���~+U��t��r�Lr�ɼ� 4fq�|�iś�s)�A*N���i�.�)yL�r�߶ۈ`��0�\r����@z��f��1����ӌU�>���pQ\$�b��/ģ)�wq��W⩸�h;�̧#�j�)��Np#!�J�'�T����9���ȗ���4��cR���\"2�:n7��<8����@�>�R�*J�l���0b�B0�J`�:����B�0�H`&���#��x�2���!0�*�;#�`��.��Ҽ'���I�@A�JlŢ�(*7R<�L��h'\r�2��X�ãb:!,�?�4\r5\$�0A?Q�<��R���\\��b�J�5�Òx�9��K6�Bd �F�\$��������(Z6�#J�'��P������Ϯot�(\$%��Y�����[�,f��Zn�Dv��]*ֺ{l���;A�q]\r!u�g!�E�n�6�@;%��P5B@�	�ht)�`T6��������Z p��ƭ�f����ҏMG��X��< #t7�ͫʏ\r���&�L�/ *#0̝*\r��2��=y3����7����<�90�1�m(�3�`@�-�4%&�4߷�FZ7�P9�0c?3���8g�\n<�����������>p�ǔA�#���n2���D4���9�Ax^;�s���ar43���^���.P�A�@��a�^0��Rmy�ie�j{\r�:�L� )x�� 99�VF��ݧ\n� �O����'������\\�<2��N7t�@|\$���E%�çU�dS��4�(¢\$��C����[iH�EI	2J\r�7��0U�Xh A�1�#���Ra��97P���a��4����Rj��E��s),3�CId�!S�Mb!\"�I\"�:\\�!\$�� \"�\0��H\n\0��RGI2o����^�AP����sBh��A��\0� ��,�ʁ�;M5�A\"\no�2�@�4��[��a h�\$:�xc^L�3��@��5-��h�p��E%D��0��3�Y�e��<Z�@���p���2&�4�K1B��ѝ?�lᡀҼ���v��\$1��w�:˴��	xI\"a��p҇KBCvF�\nC��'������0:a���]�1�l�|��ؑ�z&�@'�0���F\rE�k��H�A��|�2f��A#�UEH�f�cY樐��8 \naD&\0̮��&�*E2�P�7Ӯv���L���O	�y���g�n�i�&;z�\n�ũU\n�B��ñ��F�;�t���N�Uw:��*��6Kұ���Y��h��Qs�s��h	���Le�Xk�CI��/���\n�Y:\rg\0�b�O��u9J�N�j`%���f�*�@�A�o�7s	�ro�4��%�m@��kqt�[^m�!�Q�s/KlIc�	�6�c�;jd.u�j���\r9�4I\r��K!�&04F���`��fe�Y\$�{��5�����,yePmdl�^�1Llq=\$��&�LFc��F�������HZ�8'13\r�zj&�=�{Z�p��\r**ߙ ˇ.A�9�2�T��Y !���E�]nQpIS�v��\\�[!�5�\$h�c9��ޗ�";break;case"sr":$g="�J4��4P-Ak	@��6�\r��h/`��P�\\33`���h���E����C��\\f�LJⰦ��e_���D�eh��RƂ���hQ�	��jQ����*�1a1�CV�9��%9��P	u6cc�U�P��/�A�B�P�b2��a��s\$_��T���I0�.\"u�Z�I*�M�1��F�4�LrS�uq\$H̖�j�����-s����(�e��9��Bc9n�B,�΢A��e�����v4��s)�@t�NC	Ӡt4{�C	��k�W��Z�}1\$�羔��+��!(��h�JBTZ�	C�A�����jB�\"	;��)P`��\r#pΒ6�{Α\r���j�\$]2�s\"�4@P�7\rn��7(�9\r㒄\"<�h�9� ��#x�<C��'�8�;�#\"�N)�;\$^ ��2��L�Ą�ƂZ��\"�Z ��h־�\"�-h\n��,S������Nkrr\\-ed]NmC�>�d��L<��,m��NH�4��0h�HI�Jsx�D��`��B\$�3ьƞ3���_?Ьh)Jt\\�.)!?V�-s��LS�\0PvDS\n#��жT쎌�#`�!�HKn��*bX\\W%��,�I5����pH����c������+\$� ��ԇXђ���=�\\�֡ ��8�;dČc\\�7��HJ��u�:HOMJP��\n����TO�B���y �.(\"�]�K�a�����Be�ket�H�x���\r	�'HY��3�i��g����-�Bk�\$�҂'�qh	@t&��Ц)�C\$�6��p�<�Ⱥ��W.;KhX>��A�#���A�H1���:�+Ɍ���7cH��-jTȷ�C`�9NK�0�N��3�dB2�\nB1@\"�<�W] �鍣�<��@:�c�9�è�\r�x��ac�9y�0�!Ü�����R��i�|��*�Zx�*9�ü3r��B��\0A��7#�������s�f��4@��:�;��\\`�HI3����zJr���B�D�Q�D!����[(�lzDX�Kh��B������[I���t����k	��#����r[�t8�b��l\rF	�X/`��~�XF�,'��z�F�h�\$6��a8t�����\0zz�<\0�↳�R�>x�7D��tUIt�gLh�ӿ�5v4�a�7,��4\0��c���0�t�>��@-����Py�=�7����=~V� � \0c��4���Y�E�17����eQ2Mde7&�B�¥M��B�\0���qK�?h�]*s>��6 ���,��g|�S�vN�e[�H9C�z�jO��T;Т�Q�T�p��ST�ԬG�<�@��^s�G��G�����sJ�fY���\$`i�TKy�ta��Q��T\n�aL)d���\n�.�i��Ə��R!\"��*���+�rD4*k�d@��\"b0�'�P*CD�5s;Z�T6D.��У�)K�3��Iy9@�2��t�zH\r�(���bC��I� �`e,G��꤉�D�ܬ�3�\$h'pO\naRs��t�k��l�)�\"RM�;�Ms�]+��(l�\"�Q��>��yN�F�);n��X���(�d��9.�����a\0 �ኝ\0�B` � ����x�t4�Ԧ��ݝ\$H��#�=\n;=��H�ZDgY�����\"̯M�\n6�H������5�f��3��V0Vq,� ��q�f'¤=JcHd�i��s %�l+67Ŋ������`+,�����Tni����a��W�PF����\$�|�B�T��9hcQ%[�5�cD �(�vǙ��&� El	2�9�)�Vp�:���۶��]\r�N��{�9XMf�'�T�C0y1�շ.i<��(��L��U}=�����猩�5=Ӕ��\\�딓+�WQ1m��^Z�kU�j>ҷ����l=j6�q-�ʧ?\"��.�9[�U5cn�16�Z�()�S�,(Q\$��/[�\"�i\0�71D������)�����f�\"�͍gY�J�0A���}�����z";break;case"sv":$g="�B�C����R̧!�(J.����!�� 3�԰#I��eL�A�Dd0�����i6M��Q!��3�Β����:�3�y�bkB BS�\nhF�L���q�A������d3\rF�q��t7�ATSI�:a6�&� �(9'X(�n3�&#)�br���Kl,�~7���@r�B�H)���JN#Iڣn�˦�#	�/+8J#��H�JN�i�Цp������h�QN�u&�C�9b�Wi��GrYct\"u��f@��������F����d�wh������':��n2\rMJ��'��7(�\"h+.�c7\$/qH��\n��;*i�&20���\nb���	xܪ��X����0/�:��j�\"5����#K�!#�P�	�@�;!o`�2�(�H1L`��:/j�\r���7Bbo�2�&�#�P����Zd���d�7#�<�<������3�A=#�51�p�5A b������؛��\r!�nSC(��c���F\n:#% ��A� �D�J`�yK. ��N&΢��X�1�l|�2�C`@� C�\"㝅b5�t��Y\nae����4�6��&�pꚉК&�B��7��ơjFU�z�ű�C)��x�9�p��D*�\n��1���X&\r*#�6EȢ\n�\r�0�P��J�X�R:�b3V\r��C�b���<ڐ�7M؍G��Ql9 岑��lB�\r��QkeY�Y�2�H�f�A6��?���^���Z.��\\͛7��A̕��<�\r��5�r	��R ��M9g����î��R�KZ���H����D45À��x�ͅ���(�8^�� ޡ'�8^�6�0��x�dZ���ۈ\n85��rR����h\$���2@�V�w)*o�m�pA��|�%���1�s��;�]H2���ۍ�Z�	#h�������xj�-	&�ӜY5d�r��J�#�����A�+�t楖�RtH��`┚*ePR��\re�7Wz���\n��\n�f�Y�ngl�ŧTj���Y0���Vf���'�<R1*JP��@\$\0[��?���C�U�AL%%��R`a&�͙2�g�4��4��lR�7\r��JGá4	幌�q��<%���G���A\"���\"�d����@���gLQX�B�DVLC#;7��>��S\nA'��L�\0S\\D��@�ꆎ�lx�ԛ��vڑ�%��5�\\E�Éh��@W��Y�D6��50��ћ�tZK\r�B�����D��7�>�D� d�!3-VY�h��@�T^���QJ+�	�ui@G���LӚ�1{����H�,hN�LH�9,��ZX��Iz�4Ĥ#@�����SF������E�4��I�n9i��Jh�JB̋����|��\rB����IM�\n�YѬ����fRר&�-���깙&�\r�V�rԍ,\"E���|�&։�`�n8��P�+� (������CM*/&:�U��W�6f�9�@�ᙴtJ���b�%D1��f��)�}���%6\\��\$��N@���+�ήu�g%�NJf�1�2ߞ0�=\0T�'D�Ԣ�x�\ri��\\�X�2x±p>-7 C�p�gQ��+&�Z�����P��yl�P��ІCh^��";break;case"ta":$g="�W* �i��F�\\Hd_�����+�BQp�� 9���t\\U�����@�W��(<�\\��@1	|�@(:�\r��	�S.WA��ht�]�R&����\\�����I`�D�J�\$��:��TϠX��`�*���rj1k�,�Յz@%9���5|�Ud�ߠj䦸��C��f4����~�L��g�����p:E5�e&���ܡ�굥]W^�j兪�V��\"�e��Y\0�B9���-�ֹJ�~\r]nW��������J{�֭��Ay�.�;�^,�΢A��e�����;\r#`�3���@:?j�0����4\r00�0�P��&Ț̯�	����\"�����v�Q��n�d���T���ν�Ɂ&���𭫋|���J�5�I��*�b�%r[��Ɏ��\no��7��W�\"S+�hZ j��*ʣ\n��b��5�C�����7�J��B����|\n���@���8PC��>��Dݪ���M��1*A\$�7�ꐬC�B�TH�[\0ҏh�9�#xܣ�ZU6�N�>��qĨ�%���%iL��WN+��FL/�q�~)����ՠr\0�:h�wgGr�l�,�A\\�'��)Z���\n�t�KC�4�H;@�+�iR�n3ʹ��3wV6�����(�6���T���Q�H��R`��0�����#��9[��wan򔔩Q�a~�sBY/-��w/�V�#\r7�K�tDa��s��2d?Lٙ�d͙|������%\0N��_8�a���0(�A j������jī��\\L��n���5���}��y��߷|[G���◦���c�`5�˩�5V�eJ�O.�~B����[)6�%��\"��\\c;�Ksՠow�;�}��3w�:k��u����\"1~Δ���lZy=?S��.'��j�\$�a����m�s;��	@t&��Ц�Pd��6��^��	!u�����^�9M��:S[XDB(Q���n���W�^U�eVj�Y�g���qoS.d6-�|O�aG�7�`��e:�(��B��	Z�����<���SoK�@�~�ha\r��UfCc@��3P�\ngKa� p�g)lGF�R�uA��9���\r\n�-���,G�R9�)9�C�9TD�9w��}S�Ѐ:�D�d��<��ƭ��dO ���0=A�:@���/��^�(��.O�� ^�at���鐃�g��0��/ �\$�*��I�g�M%H�>ّ�NZK���\\��O�m\$�4�0U琍+�5A ����Mv\0�Ԭ����XK)i-�ĺ���_J(��f�\r�µm3\0>	&�1@�&�Ճ��� ���PE,!����b̤��]�M�v��iH4%R,\$RT��}k(��2��\nrJrrX4���R��\0�p�~�y�aɊ5����1�2�x�*�@�T�(�S(0����K	T �+ �tEr�|!\\\n�V�X\n\n (T\$��j2�q�}M�5�O�A���<�Pմ��E����\n�uF� 聐��QU���{f�܌2d�)��b��,HX6~m�C�Wb�U�q�J��#uN�>�����\0sRJR��\0�)`i��U��~a��\nӅ0��A�0�����+R���,��JǬ������<�z/��3����^�_ԣv�k�Df�tw}�Cθ�Md����)�o�>w�7�\"`'U-�����P���\\��9���D*�W���%'�+��H5��_.�3��>O� �������u0B��TPfOa�PQiI?��we\rA�;r�!�tw�\$N�����@'�0�R*#.SN��d3��^�FLn@�����V|�P����\\�>a+ٯ�4ZKAD�\r���P�4*�c�v���ֈN��F�p�0��PJE�1^�@L��	\\����Mt4�us�s\$2`������`],�wi�N������Y]*]Ѽ5V�wiH��I�����\\囼�����m�t����Cm�C�&\$��uV���H���]�xW�B�vHu�JQ3C}��5,\n�Z�����bg�6����ە���Oߍ�[!����X �R�;W��kie/\r!�.Sb���,��*�G@�0-�S�4�W�6�d|�#\"m�S,\"Xs�p�m���S��oE���0`��j�|�a7�<W\r�H�t�.����x�8'��g��	��W�n�-�j9ފsT4iH�54p���ga7�uGo�����D�);�sq8Gp�����P�(l�\n͖�����\nM*9;�\\s�M&����FԪƹ��.�\$GЌ��/M��qoM��aDk��>(E\0��E�&��ܷmm�t �6�i�Gt�g��lr��r����Ts��N��/\n_/8��� ʫfK�0\")�(iHe��nPG.�����\\��~���F�pH���(\"/�t/`7�\$�����cvw#<����v��gtHU,���";break;case"th":$g="�\\! �M��@�0tD\0�� \nX:&\0��*�\n8�\0�	E�30�/\0ZB�(^\0�A�K�2\0���&��b�8�KG�n����	I�?J\\�)��b�.��)�\\�S��\"��s\0C�WJ��_6\\+eV�6r�Jé5k���]�8��@%9��9��4��fv2� #!��j6�5��:�i\\�(�zʳy�W e�j�\0MVh����\\(-˄�\0��߰�Mz�1�N�	���Ο�P����|�ֺ��S��t&x�|�k��\$��3�w��+�y�@4#��\r�x@8CH�4��(�2�a\0����0���4\r0��0�Pkڶ�p��\0@�-�p�D�DT�>\nQp�;��,�jCb�2�α>��Ѕ�\$3��\$�^��Q\\k\"6-+Ȕ.	��\\R���(2z��`P�\0�#pά�����9�JV�9+�b槤�*��\\\n;��\0�9Cx���@0�p�7� �:�*8PԠ�Fc�2Do�~� ��N͢p�#\r�R�'�L� K�C��G�D)1qU��l��'\r���\rl�(��� ��8�����D�}s.8�3����<F��l�>3�|�Ĳ�lA4�,��ͱÁVͭsw���H;ƀ&i����(}eK������KY�ˋ!8�t��B:�H���N�\\��+)�51X�-m�_o�b�ع���\$܈+�J\0Y���9W�M�in���:�l���s*6�˱��S�[ؐ��3�%ʈ<�\0T\n��^{Xb��M����Q:);��сf)��n>�!q�-�s�pr�`J+*g�+�����Xt���c�m8	�*��ֳv�N\\��:�=~�o�	j���c�uU��!�6�������Wg�+��	@t&��Ц)�3�[D@_�����mYpZ���?�1�i 'rJ��A�A\rA\rߜ�~×�C�\r��4�����Ur�l���Q�?��9 0��0lM!��P�\"�jm����OUJgF�*�Cn �:�0��a�:��@xgM!�! ��g)�D�J�Cji�d0R��&g�:�v��K{�E�\r������X\n�>���ìM@� �H��EpE�a?�T3�D�t��^�.1�\r�u�xe\r��G���d�\"�u&��xa�`)é@���=H���E���]T��>���K�8��bX���|X)�N�`&��2���sS�}A��`���4HI\r\"\$T���@;�))\$�r�jL�5 0/F ��hm�A�TJ��>��ok�LC\0ր�J�Pp�<���1�h��YVJ��p��iJ�ar~\0�!�b@a�A���>��a�=J�xs4��>�	@�t6���3�9�>�Ha\r�L�#�yQs�	��UbN�i�=Uת�p���H%m��\0��  ��\\)='m	0�R���S*�\\8\r)�BH ���+]S�:!:���J��Ģ9|��iP=e�ݥ�aNePt!� ���MP(n����:�S�ɮ�t8�E\r!�D\nUPc1�0�.9�9���+��Fk�l�Y֭g�R��G6˾Ì�L�a�V�m۠g�Ϊ:�0�V)lqՑߖd�J��Ht�c�l/	�8��K��.�2WX�m��VI%'�@��P*�Q�����#C�uB\nP3(P�'<��1�P,z�A�Z���p��eol���(�V��=��<�-��\n�&x\"����P�\n<��k�\\�z9u��?[��or�1�6�e�ɯ*�?xR�(+\$� �A��Ѱ�\0f���� �+L1k��{����12�Ph	C����k\r�xh�[�TFn��0E�a���\r�\\+P����-5\0�wW|��\$��&�|n�_i�����=hC\$93�4�Y>+D!���\n�hia�(��r^98�̭�ZV6{\r��J[��B�F���G�,���Ok��0��r����ǻQՓ�Z��_>M˼ﾕ��`(&� ���Y�mᨫ�@(����+�T`WDê:ki���Ǎ�mVG5�������٢�g�ŦN�F���2�^_+07�ڡ�r�\\�I�b���CFM�ܵ_-T�C}��)���Pm#�%e8H>lE�Y�p�����]+3�-�g�ưWN�O;O��7]j�wF��j;���`�";break;case"tr":$g="E6�M�	�i=�BQp�� 9������ 3����!��i6`'�y�\\\nb,P!�= 2�̑H���o<�N�X�bn���)̅'��b��)��:GX���@\nFC1��l7ASv*|%4��F`(�u64���ta�R�(�a1\r�	!��y=Ld �)�K0�g�L!�\n!O��1y7̷�� 4����ɔ�k����|��:t�dv��-G���j4�	�A����ȁ��r0�\rƞ>8�\n)I�Hr�H\"^+}��\n*��f�y�9Iiو�s��̧1�(9���������9��(ȓ��\0�=.c�|�(I�ȹ��J>�Z�.�r��\"��蘠�j�:)@��,�c\n/�\n>49����-��4�B\n��(ަ��ߍ��4�r�'˱b\n�޹H��Ҳ�	��4>��,�P�\"ɡc\"lȎ�HK7>��p��\$d���\\��c �\0P�Ԕ�4�#�밠��&\r(p������S�c�7\"#H�<���p��:�\0�R������6ϣu�@�Ӕ�0�c-kQ\"��r�����Ү�)�B �h��<�Ⱥ�#Z3��P����N�l�{��8�u(������N7 �p�ҕF�Cd�d:����\"|��Ú|�I8�:�ê����ׅ��+,���zv9�0��Gn�Ҡ� �8BxQc^�b#�4�h���:N5��\\2��\"	�>S7���|<������8�2 9~�<��|����eD%�:��\rkΌ��x����3��:����x�������(��!zgw��K��A��+.d8Gq�|^,�@�|�飮P�{s��&vH�b�:�F����4�f���w�`ͻ:hZ�uꌶ2�p@�\r���-�xqb�5If�n��������.��qW7q��c|��A�bg�b�'L�P�sab:����5�I���v�E�6\$ĠX)�D��tC�U�u90#�Pޟf��Z�dΩ���N�XћyMb��Ti�	er\$|�� ��8UB�	=�\nD��C\$,���\0��Kr%���\n\n()|\n!E�RS��R*����*�c�	����L��B�<��q>��!��C�F|�\"�#��\0�P� �A���@Щ�A�g���\$|�A-T�pwP���ɱ���4S�I�,7R��F�A��*���(m3F��C�I�I+ q����YR/)5��Fmd�n�H\r�Dz*!�mP�\"3�4���ۇ@�++�L���?\r(���Y�g�\"Φ=��y/&�(�\r� ��f\$���fED���\"��\"�#ȼ�!��C;���蹴&�\nA*E	�I� b�4-�`�Bc�)S^�ìk`��%�A�1`���7�D͝\n�,͉'6�L��9#M\\#\"�К8���ر���U����22�.f��}6\r�q��ҳ�\0���^�I|Oò�i�A7�lބ4�\\E1�Vu�jB�F�����\\��B�6��%[�Ur{��rUF�6��8W��j�J��rY6��~�;i%���N�A��X#�ʏ�\0dI�,\"R��,:CVՒ˥q�L��������TxDH0�F@ș\$̤5Ņ���%;E����_�ˬUJyYת�]�����)�ev��xp\"�p\"1�_<!�6����2x��B���R�z`�\rjF�Q���n�r";break;case"uk":$g="�I4�ɠ�h-`��&�K�BQp�� 9��	�r�h-��-}[��Z����H`R������db��rb�h�d��Z��G��H�����\r�Ms6@Se+ȃE6�J�Td�Jsh\$g�\$�G��f�j>���C��f4����j��SdR�B�\rh��SE�6\rV�(���C+���*(*|�#�ƣ��\$�a+X��hj=�A�J�zX2¥Ih�9}�n;*�4Q�\ne-��s�%���\\��.�H�h�ഹ*	 �� ��L�6�];	}t�c\$�|m~-����7i�p�?�K\0*K�_�)��&M�7	�vA��k��h@)� �NV�Bf�R���9?����JܶP����R4OC�K}5HtJ��꣐����dʖY\"��%�Ȗ�d*���mAh��*����l���(�d����b�7��D�+?0�OSJ\\�/;���E�(����,b�9�kjķ��\\���T���f�N��S�4J2m|Ȳd\r>���?TG����&�\$���\n��6�Tp�&\r4M2\rF�2d:4O��lҍuA�>H������;��Hq��*�\"�\n�P���\n&2 ��ė�!-��6��y�֜��@U��#Iq,��\\x8ce�CJ]#E�أ���j�6,�7�,���є5]���:R\n�n�b(Z6�#H��K��ugG�!����)��\\��S��H��\"N��T�e,\$���=Ike��x\\�:J��9�t��7�iI(��9Z޻iRޛ�i�\"ͳ2������ԫ!EU��I�F�K�p��B�)��]%�p��r��\0.�ʞ%��3�Z�B �9�#�2�a\0�9(����OWԌ����cH�7Q�Ę�NQ��:\\�Λ��z��5r�s7ժ�Km�v��6���q��h�K�3ñ'����r	��jn%Z��U�E��%W!T�����۞�`K�]z3u���3�G/��'�H����A����jA~	����JYU#�EMܛA7�~\nH��Ć�f��E��Kd(�=�N��PRA���ޓ�Em�?t>��c�\$���g�L[�*���p��J�J}K�t\"%��u��M!w;%E7�CHn��:\$�iJ\$A;P<��@r��� ��p`����#�pa���9��V�{��݆��p/@����΁�/ �� e���9+9�<�4�#�@M��R��U��'M\r0&��]b�05�=s���fP1Y+�<^���}R�E2���Q�|Z.�B>�� �,��2.F���\$d�rRX9I�4�]������E{\rB��s*Tʳ���	�Qq�2AQM�:3��C�a�:��%RV�	���˴��ԒJH2h!���c���u*j�I�dTg\nn���WT:,���;�Y�P�I����E�-���5\n���T�Fʩk5seA���h�IG#G=(�@P�eB�z�J�8 ��ƿN�\n�(t�GLZqN�1�Ґ��Z��z2���vFy(�aZG��!�h��vr��~K�h\nk�=5h�>�O�9�p)�TF�V�oH�1��2Q��K���F#���\$��>�:�M�l�DGZE}0����!)� �}Y�+��q��Kq1K�*�21��\0-�i�\\'.�5�A�ț'��B�	,�I�R7��,t1a��v<��4�1.�yuNk���ҡ��MŜ����Ci�3jwɱ���C���%k�AEh�'�uJ���?�4M���������,&0\r����p1[J�^\0�Tb��˾,x�	.a��	U�U!�k��L!�+�L���[&���y\nX�˺�|zASB�Ms�Mc2���ސ�^�\\�>���v�Q	��h����P>�X��0�cM6�V��žb^zB�8�NRF�Q�P�dQ�򃩍�K+x�U��Z�D	g�EͻN��a���s�5\0ݚ�\"���l8��榵��+\\-�׵���-a���pj�<o6�}n%������Wko-~{&��9�Kan��	��-M�o��֨P��h8'��\\���.��JҶkL#֠��b�9�� 7'���������gi�9�Y�P��h�)�1O���&Tш�>���!��L֩��!�c�\\�Ɓ�Kh咕0���8B�iL��̧9�Xn�7V�{����z҉a��!#ռ��.�yN�Lt\$���ۻ��ƎSh�5`��_F�y7Dv�Q��/]|���H�92���5K������N6:�D���ܴ�d��4ϟh���kf>�g�m�Y�����d���rsR4��x-\0";break;case"vi":$g="Bp��&������ *�(J.��0Q,��Z���)v��@Tf�\n�pj�p�*�V���C`�]��rY<�#\$b\$L2��@%9���I�����Γ���4˅����d3\rF�q��t9N1�Q�E3ڡ��L�u��D�,�3���V�����ҏn����9·\nT����h�\"\r20�X�\$�_)�ɯH\0�A)���|@q:�g!�+C�c�z�̸�6:����ڋ�����K;�.�ܮ@��F��ͽLS0��6��������kM�ʈ4�kaT�5��x����7�Ip�0���0�c+�7����7����8D28B���p���� ��1�#B\\�jpL�+@��=��W ��vO�IvL���:�J8楩�B�a�lJ!j�!��pK�/�vH�/�@<�;RN�Bl�\r�x�4�(�\n�|⽒1�^4�j�V������pN��a9���2��%K�b!�Ŕ\0#�-:�KS�QF���L��:3,�J21c��2��R3�Sf��A b�����Ec�5�%�6���Ɯ3��Q9,�tW���@Ӊ�6�E�\$(�����+7J/�d�!�0�#d�CtD��˲�pS���R���5�eC6#߈u`��֔���R��Ԑ��q�К&�B��c�L<��h�6�� �S��5\nk�\"\r20�6BJ@A^Ct�IY�墌��f7cLo%�P]�9�#@6-\0P�7��	\r�0�6=c*]53%�]��c�P��|�e�'z#�*H���j�=�.ݯdx�G2#���n��^Efu��0`��;��#�n3�cET5��6�:�@�2\r�(��zx�2@�\0x�����C@�:�t�㿔=�dA8^2��x���w�޾�:=c8x�!�\\(b�TP<oR����X_��G2S���L�yB��h��=)&\$�O*\\\$��;�|��x�!�w��rz��=G�Ҟ�MF��|f�\$Ȣ>���X	 L��g��_�B&G�Q3����D�V! ��7�z�����uA�6�U`C2�h��:�0��0u���7�b	�4BI*�V��s�!��ch���;G�!\$D�lq�<��n�B�H\n�d��<%��BJ\$�7��L���H|\$rJ�\0�OS<�Y�!�,�P��q�;�b�ށ|-��+�\n��ACh�/����n��F��wb�؆w��\0cH�E����]�h(a)� �-�PL��Q��I�.鰀����VJq����t�H�*J�\0P�N��hf�����T�_t�R~�ph��\\T�D�Q��%ؼ#!u;�I.	\$H<�����LA\r�=��f�n����cZ9z�2!���ALѲ3bB�J!,�@'�0�më�p��.G�N��X��1nNI��'�H��z�>�)�8a���\n&cO�%R�lcÍ#�V'���y��RE��9N��cP�2p�٧����	��}�Ms�zNH,ӞU� �94w=�#�&���'�v%R�NE���2��2�}�F�8�_a��;Nm:\$��Rk�m��]<�T�\n�P#�qhl<%\0��#IQ��3�ESW��̬�55Ix��3x�-�AD:��I�Q�;aE�,�o�C/����l-퍷��E�R�qY�2<&i���%xX �UG\r8��[ZK�u:�X~��	���!cBhӚ�b5U��EXKB�f��,`)�\n��c���x*26G��*�6��(�ic:���b:�";break;case"zh":$g="�A*�s�\\�r����|%��:�\$\nr.���2�r/d�Ȼ[8� S�8�r�!T�\\�s���I4�b�r��ЀJs!J���:�2�r�ST⢔\n���h5\r��S�R�9Q��*�eJ*ȅ��b�r���e��\\�t(jһ*�,�_\$e����\n����iU�����.W���:�t�Rd��H�t/�1�V,r/ӵ�ce�r�V�uڟx�s���Υ�[9���,e@k6�d�e[iD(4*@S�^�t*����q��Nt��ҔL�����Z\n�I���E{�@��ys�\n���#��r�\\��Xs%I�X��a4��)*�r��p���.s��22Y%��LȔ�q>s��K���tF5\$��D�)zH����C�Q*r�e��^�L+Ĝ��P�.K�F�0@����^����@���2��)v]ϫ.���LtJY0W�\$�L��\\tj����ZJ)9vs�zF���\\���itG��a&G')TAR1�@'1T���H\$\\����Jt�R0\\gIDڴ\$%hr��O0���@�5�}ؖ10�9X*���\$Bh�\nb�-�7(�.��h�� S�5\\���g9M4.*0�.d�W����D�)C)K��P�:Ij{g9t_���̓��Pʲ�Ҽ�FG5�%��ZF%b��5\$:bM!��^[��QC\$��H�I���2D?���O��E<ˈ�2\r�H�2�Y�t�L�*\"粗e`x0�@�2���D4���9�Ax^;�pìkZ�\\7�C8^2��x�7���4�xD2�X_!�A�E�)��P��I:Q!�Hx�!�\\��Ӽ��9�e�f����\"����]�8O�[^۷�;���;����:����?2��9�HD���F��?S����Y���,Wg1`\\��\nr���J_����\$q\$.�W���O����s	1�J�[%ͤ��>�`�b����r!(���ܤ���9��d�	�R�_!-����&x>�H\n�!��\0EC�(�ݑ�MI��ØG\nT~,8�}F|s��^��2I�DBFe��1L�A���)�/�H\\��9�\0�kƪ��z9����Z#q\\���f-i0PE�&\"\0C\naH#N)\"�+%h!�&Պ��p����l!^0&Q��t��0��͡�(�ʈP/�J)���p���_�q'�]�ţ&��\"	�s,Ѽ#�n}к2�xS\n��9QH*���f��G�\"�ϲ�l�YKF:D*�RÔH��v)#\n\r⼓��\0����P(�B(	�yaL(�O���%�y�%h�s*�;'mϋ�4f#�4��K\n;G�Ȳ9F4��q6+��Y2:6��\n#ļOI��r��2#J\n�\r�Ñ&�X�Q�|H�� #ؿp�؊��.P�=Õ�?�0\\B�T��,�ʽ3�O����F���UB��+sm���+�L�6ZD(�J� S�f8g���#�bGH��0���.k�O��E\n�/c��fs�9�K>G���t�(��`�	h���	9t��P�����ZE!PH	t^B�[L��5ѩD��Ei�\r�KμUr�^�";break;case"zh-tw":$g="�^��%ӕ\\�r�����|%��:�\$\ns�.e�UȸE9PK72�(�P�h)ʅ@�:i	%��c�Je �R)ܫ{��	Nd T�P���\\��Õ8�C��f4����aS@/%����N�@�t��ЀB�T)�*z��Y\$���K�f�s%�.�\n�W-s����}5,�r��������(�}5��`��%���s+Nd���t�.T/\r��c1��reSLqx�H��ι^9�H̎O*��r9�|�z>�����5�~��.��B�z�:I�⽹�i��S�>R�\$a^��+~М��V��ģ`G��)^C e�U���T;�)K��>V�-�sp�\nB��ABs��\"�9��rRr��Z�����.��Ji*\\G�i.R�d��L�GI,I�.�rY j0[GAn�%�\0J�����ʰr���L�Д(Q-G92]��*�X!rB�S�;;���PO��\\���\0�<��(P9�*i0�0!pH�A��H��re��B��^��1IA\$x���:\\E���9Y�%�PC�d��V�IZԅ��_�AU.%�LK�	�	d��yr���]�Vݺ��*cY�lҜ�y|�+@�	�ht)�`P�<߃Ⱥ\r�h\\2��|I��;��7�1K��?��X�'�ETYF\${�@P�:M1Pt�e\"M��Ҝ��t��S219ۖ��\0�e!bs��b��gIG(�F��C�1�H*��t��i�T�ѩ��X�ynƤ!>t���\r�# �4��(��-�\0A��)\\�f�A\"�!��\r��3��:����x�˅��n�p�9�x�7� �7#��Ӆ�|s��b_!�A�E�d�s��!�^0��p)����Սڤs��N�k�ko>ι��7B��e�I,\r�q\\g�r\\�-�s[��9s�E���7y}`D���:9E��xO�	arG���L�7��(��XҼ�����/\"��\n!V�X�uF��R\"�@����6A>�˨�iHBl9�0�Ei��Ŷև(��0�B2F�I/c���T\"U �K�5�Bj���H\nF\$��[#�)O�\"`k\rȣU�\"`9��\"�v��\"\"�8#�V��ji�DO�]�'Fg�)��s\nx��ɻ5�A��̤��Y�DJ���\r��l�n:Dh�%c�6)� ��o\rn�Ƿ����ȼ7\$�ƎQ,+�0�/-,��g!kF�բ��Qa��\0��j���B���L �0���ӝ�:a(����7d�.�1C�X�'�\"�H��8D�hH�H�F�(�\n7b�UMC9���(q���\$%��3Sjn1��L�i!X�NAPk�z�@\0M=\0��;\$B�j�L'6t��l�-'\r1?�aR��\$2�xtA�<{���{���u�fĪf\\��z�7N %\\���(c\\�A���t��~�DdP�<!���v��;�O��zo'�Y4c�_��.Q�&�iA�4]B�T��T*�WN�N\"GR6GZSa5�2[	a���Vbd�aTCJ�@M��'@�2�U1�X`*-ᔍ(�HE�i�:�%:�F�B���N��Y�~�Z<.����\0g�\$�Wu���5��������1zK��ݾ�:��B�H�ʁQ*h��D������_�";break;}$lg=array();foreach(explode("\n",lzw_decompress($g))as$X)$lg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$lg;}if(!$lg){$lg=get_translations($ba);$_SESSION["translations"]=$lg;}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$Ee=array_search("SQL",$b->operators);if($Ee!==false)unset($b->operators[$Ee]);}function
dsn($Pb,$V,$D,$B=array()){$B[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$B[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($Pb,$V,$D,$B);}catch(Exception$fc){auth_error(h($fc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($P){return$this->pdo->quote($P);}function
query($E,$tg=false){$F=$this->pdo->query($E);$this->error="";if(!$F){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error=lang(22);return
false;}$this->store_result($F);return$F;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result($F=null){if(!$F){$F=$this->_result;if(!$F)return
false;}if($F->columnCount()){$F->num_rows=$F->rowCount();return$F;}$this->affected_rows=$F->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($E,$o=0){$F=$this->query($E);if(!$F)return
false;$H=$F->fetch();return$H[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$H=(object)$this->getColumnMeta($this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=(in_array("blob",(array)$H->flags)?63:0);return$H;}}}$Mb=array();function
add_driver($Wc,$A){global$Mb;$Mb[$Wc]=$A;}function
get_driver($Wc){global$Mb;return$Mb[$Wc];}class
Min_SQL{var$_conn;function
__construct($h){$this->_conn=$h;}function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){global$b,$w;$ld=(count($Ic)<count($J));$E=$b->selectQueryBuild($J,$Z,$Ic,$ne,$y,$C);if(!$E)$E="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$Ic&&$ld&&$w=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$J)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Ic&&$ld?"\nGROUP BY ".implode(", ",$Ic):"").($ne?"\nORDER BY ".implode(", ",$ne):""),($y!=""?+$y:null),($C?$y*$C:0),"\n");$Hf=microtime(true);$G=$this->_conn->query($E);if($Je)echo$b->selectQuery($E,$Hf,!$G);return$G;}function
delete($Q,$Pe,$y=0){$E="FROM ".table($Q);return
queries("DELETE".($y?limit1($Q,$E,$Pe):" $E$Pe"));}function
update($Q,$M,$Pe,$y=0,$K="\n"){$Hg=array();foreach($M
as$x=>$X)$Hg[]="$x = $X";$E=table($Q)." SET$K".implode(",$K",$Hg);return
queries("UPDATE".($y?limit1($Q,$E,$Pe,$K):" $E$Pe"));}function
insert($Q,$M){return
queries("INSERT INTO ".table($Q).($M?" (".implode(", ",array_keys($M)).")\nVALUES (".implode(", ",$M).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$I,$He){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($E,$Zf){}function
convertSearch($t,$X,$o){return$t;}function
convertOperator($je){return$je;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($hf){return
q($hf);}function
warnings(){return'';}function
tableHelp($A){}function
hasCStyleEscapes(){return
false;}}$Mb["sqlite"]="SQLite 3";$Mb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($q){$this->_link=new
SQLite3($q);$Jg=$this->_link->version();$this->server_info=$Jg["versionString"];}function
query($E){$F=@$this->_link->query($E);$this->error="";if(!$F){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($F->numColumns())return
new
Min_Result($F);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->_result->fetchArray();return$H?$H[$o]:false;}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($q){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($q);}function
query($E,$tg=false){$Qd=($tg?"unbufferedQuery":"query");$F=@$this->_link->$Qd($E,SQLITE_BOTH,$n);$this->error="";if(!$F){$this->error=$n;return
false;}elseif($F===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($F);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->_result->fetch();return$H[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;if(method_exists($F,'numRows'))$this->num_rows=$F->numRows();}function
fetch_assoc(){$H=$this->_result->fetch(SQLITE_ASSOC);if(!$H)return
false;$G=array();foreach($H
as$x=>$X)$G[idf_unescape($x)]=$X;return$G;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$A=$this->_result->fieldName($this->_offset++);$Ae='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Ae\\.)?$Ae\$~",$A,$_)){$Q=($_[3]!=""?$_[3]:idf_unescape($_[2]));$A=($_[5]!=""?$_[5]:idf_unescape($_[4]));}return(object)array("name"=>$A,"orgname"=>$A,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($q){$this->dsn(DRIVER.":$q","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($q){if(is_readable($q)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$q)?$q:dirname($_SERVER["SCRIPT_FILENAME"])."/$q")." AS a")){parent::__construct($q);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($E){return$this->_result=$this->query($E);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){$Hg=array();foreach($I
as$M)$Hg[]="(".implode(", ",$M).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($I))).") VALUES\n".implode(",\n",$Hg));}function
tableHelp($A){if($A=="sqlite_sequence")return"fileformat2.html#seqtab";if($A=="sqlite_master")return"fileformat2.html#$A";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;list(,,$D)=$b->credentials();if($D!="")return
lang(23);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){global$h;return(preg_match('~^INTO~',$E)||$h->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($E,$Z,1,0,$K):" $E WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$K."LIMIT 1)");}function
db_collation($l,$bb){global$h;return$h->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($A=""){global$h;$G=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$H){$H["Rows"]=$h->result("SELECT COUNT(*) FROM ".idf_escape($H["Name"]));$G[$H["Name"]]=$H;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$H)$G[$H["name"]]["Auto_increment"]=$H["seq"];return($A!=""?$G[$A]:$G);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$h;return!$h->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$h;$G=array();$He="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$H){$A=$H["name"];$T=strtolower($H["type"]);$Cb=$H["dflt_value"];$G[$A]=array("field"=>$A,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~^'(.*)'$~",$Cb,$_)?str_replace("''","'",$_[1]):($Cb=="NULL"?null:$Cb)),"null"=>!$H["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$H["pk"],);if($H["pk"]){if($He!="")$G[$He]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$G[$A]["auto_increment"]=true;$He=$A;}}$Ef=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Ef,$Id,PREG_SET_ORDER);foreach($Id
as$_){$A=str_replace('""','"',preg_replace('~^"|"$~','',$_[1]));if($G[$A])$G[$A]["collation"]=trim($_[3],"'");}return$G;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$G=array();$Ef=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Ef,$_)){$G[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$_[1],$Id,PREG_SET_ORDER);foreach($Id
as$_){$G[""]["columns"][]=idf_unescape($_[2]).$_[4];$G[""]["descs"][]=(preg_match('~DESC~i',$_[5])?'1':null);}}if(!$G){foreach(fields($Q)as$A=>$o){if($o["primary"])$G[""]=array("type"=>"PRIMARY","columns"=>array($A),"lengths"=>array(),"descs"=>array(null));}}$Gf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$i);foreach(get_rows("PRAGMA index_list(".table($Q).")",$i)as$H){$A=$H["name"];$u=array("type"=>($H["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($A).")",$i)as$gf){$u["columns"][]=$gf["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($A).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Gf[$A],$Ue)){preg_match_all('/("[^"]*+")+( DESC)?/',$Ue[2],$Id);foreach($Id[2]as$x=>$X){if($X)$u["descs"][$x]='1';}}if(!$G[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$G[""]["columns"]||$u["descs"]!=$G[""]["descs"]||!preg_match("~^sqlite_~",$A))$G[$A]=$u;}return$G;}function
foreign_keys($Q){$G=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$H){$Bc=&$G[$H["id"]];if(!$Bc)$Bc=$H;$Bc["source"][]=$H["from"];$Bc["target"][]=$H["to"];}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$h->result("SELECT sql FROM sqlite_master WHERE name = ".q($A))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
check_sqlite_name($A){global$h;$lc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($lc)\$~",$A)){$h->error=lang(24,str_replace("|",", ",$lc));return
false;}return
true;}function
create_database($l,$d){global$h;if(file_exists($l)){$h->error=lang(25);return
false;}if(!check_sqlite_name($l))return
false;try{$z=new
Min_SQLite($l);}catch(Exception$fc){$h->error=$fc->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$h;$h->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$h->error=lang(25);return
false;}}return
true;}function
rename_database($A,$d){global$h;if(!check_sqlite_name($A))return
false;$h->__construct(":memory:");$h->error=lang(25);return@rename(DB,$A);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){global$h;$Dg=($Q==""||$zc);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Dg=true;break;}}$c=array();$se=array();foreach($p
as$o){if($o[1]){$c[]=($Dg?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$se[$o[0]]=$o[1][0];}}if(!$Dg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$A&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($A)))return
false;}elseif(!recreate_table($Q,$A,$c,$se,$zc,$Da))return
false;if($Da){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($A));if(!$h->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($A).", $Da)");queries("COMMIT");}return
true;}function
recreate_table($Q,$A,$p,$se,$zc,$Da=0,$v=array()){global$h;if($Q!=""){if(!$p){foreach(fields($Q)as$x=>$o){if($v)$o["auto_increment"]=0;$p[]=process_field($o,$o);$se[$x]=idf_escape($x);}}$Ie=false;foreach($p
as$o){if($o[6])$Ie=true;}$Ob=array();foreach($v
as$x=>$X){if($X[2]=="DROP"){$Ob[$X[1]]=true;unset($v[$x]);}}foreach(indexes($Q)as$pd=>$u){$f=array();foreach($u["columns"]as$x=>$e){if(!$se[$e])continue
2;$f[]=$se[$e].($u["descs"][$x]?" DESC":"");}if(!$Ob[$pd]){if($u["type"]!="PRIMARY"||!$Ie)$v[]=array($u["type"],$pd,$f);}}foreach($v
as$x=>$X){if($X[0]=="PRIMARY"){unset($v[$x]);$zc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$pd=>$Bc){foreach($Bc["source"]as$x=>$e){if(!$se[$e])continue
2;$Bc["source"][$x]=idf_unescape($se[$e]);}if(!isset($zc[" $pd"]))$zc[]=" ".format_foreign_key($Bc);}queries("BEGIN");}foreach($p
as$x=>$o)$p[$x]="  ".implode($o);$p=array_merge($p,array_filter($zc));$Tf=($Q==$A?"adminer_$A":$A);if(!queries("CREATE TABLE ".table($Tf)." (\n".implode(",\n",$p)."\n)"))return
false;if($Q!=""){if($se&&!queries("INSERT INTO ".table($Tf)." (".implode(", ",$se).") SELECT ".implode(", ",array_map('idf_escape',array_keys($se)))." FROM ".table($Q)))return
false;$rg=array();foreach(triggers($Q)as$pg=>$ag){$og=trigger($pg);$rg[]="CREATE TRIGGER ".idf_escape($pg)." ".implode(" ",$ag)." ON ".table($A)."\n$og[Statement]";}$Da=$Da?0:$h->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$A&&!queries("ALTER TABLE ".table($Tf)." RENAME TO ".table($A)))||!alter_indexes($A,$v))return
false;if($Da)queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($A));foreach($rg
as$og){if(!queries($og))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$A,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($A!=""?$A:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$He){if($He[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Lg){return
apply_queries("DROP VIEW",$Lg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Lg,$Sf){return
false;}function
trigger($A){global$h;if($A=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$qg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$qg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$h->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($A)),$_);$be=$_[3];return
array("Timing"=>strtoupper($_[1]),"Event"=>strtoupper($_[2]).($be?" OF":""),"Of"=>idf_unescape($be),"Trigger"=>$A,"Statement"=>$_[4],);}function
triggers($Q){$G=array();$qg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$H){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$qg["Timing"]).')\s*(.*?)\s+ON\b~i',$H["sql"],$_);$G[$H["name"]]=array($_[1],$_[2]);}return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ROWID()");}function
explain($h,$E){return$h->query("EXPLAIN QUERY PLAN $E");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($jf){return
true;}function
create_sql($Q,$Da,$Kf){global$h;$G=$h->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$A=>$u){if($A=='')continue;$G.=";\n\n".index_sql($Q,$u['type'],$A,"(".implode(", ",array_map('idf_escape',$u['columns'])).")");}return$G;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($j){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$h;$G=array();foreach(get_rows("PRAGMA pragma_list")as$H)$G[$H["name"]]=$h->result("PRAGMA $H[name]");return$G;}function
show_status(){$G=array();foreach(get_vals("PRAGMA compile_options")as$le){list($x,$X)=explode("=",$le,2);$G[$x]=$X;}return$G;}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$oc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$Mb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($L,$V,$D){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($D,"'\\")."'";$N=$b->connectSsl();if(isset($N["mode"]))$this->_string.=" sslmode='".$N["mode"]."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Jg=pg_version($this->_link);$this->server_info=$Jg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return
pg_escape_literal($this->_link,$P);}function
value($X,$o){return($o["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$G=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($G)$this->_link=$G;return$G;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($E,$tg=false){$F=@pg_query($this->_link,$E);$this->error="";if(!$F){$this->error=pg_last_error($this->_link);$G=false;}elseif(!pg_num_fields($F)){$this->affected_rows=pg_affected_rows($F);$G=true;}else$G=new
Min_Result($F);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$G;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=0){$F=$this->query($E);if(!$F||!$F->num_rows)return
false;return
pg_fetch_result($F->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($F){$this->_result=$F;$this->num_rows=pg_num_rows($F);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$G=new
stdClass;if(function_exists('pg_field_table'))$G->orgtable=pg_field_table($this->_result,$e);$G->name=pg_field_name($this->_result,$e);$G->orgname=$G->name;$G->type=pg_field_type($this->_result,$e);$G->charsetnr=($G->type=="bytea"?63:0);return$G;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($L,$V,$D){global$b;$l=$b->database();$Pb="pgsql:host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' client_encoding=utf8 dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'";$N=$b->connectSsl();if(isset($N["mode"]))$Pb.=" sslmode='".$N["mode"]."'";$this->dsn($Pb,$V,$D);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($hf){return
q($hf);}function
query($E,$tg=false){$G=parent::query($E,$tg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$G;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){global$h;foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ag)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
slowQuery($E,$Zf){$this->_conn->query("SET statement_timeout = ".(1000*$Zf));$this->_conn->timeout=1000*$Zf;return$E;}function
convertSearch($t,$X,$o){$Vf="char|text";if(strpos($X["op"],"LIKE")===false)$Vf.="|date|time(stamp)?|boolean|uuid|inet|cidr|macaddr|".number_type();return(preg_match("~$Vf~",$o["type"])?$t:"CAST($t AS text)");}function
quoteBinary($hf){return$this->_conn->quoteBinary($hf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($A){$Bd=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$Bd[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$A).".html";}function
hasCStyleEscapes(){static$Qa;if($Qa===null)$Qa=($this->_conn->result("SHOW standard_conforming_strings")=="off");return$Qa;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Jf;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){if(min_version(9,0,$h)){$h->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$h)){$Jf[lang(26)][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$h)){$Jf[lang(26)][]="jsonb";$U["jsonb"]=4294967295;}}}return$h;}return$h->error;}function
get_databases(){return
get_vals("SELECT d.datname FROM pg_database d JOIN pg_roles r ON d.datdba = r.oid
WHERE d.datallowconn = TRUE AND has_database_privilege(d.datname, 'CONNECT') AND pg_has_role(r.rolname, 'USAGE')
ORDER BY d.datname");}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){return(preg_match('~^INTO~',$E)?limit($E,$Z,1,0,$K):" $E".(is_view(table_status1($Q))?$Z:$K."WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$K."LIMIT 1)"));}function
db_collation($l,$bb){global$h;return$h->result("SELECT datcollate FROM pg_database WHERE datname = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT user");}function
tables_list(){$E="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support("materializedview"))$E.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$E.="
ORDER BY 1";return
get_key_vals($E);}function
count_tables($k){return
array();}function
table_status($A=""){$G=array();foreach(get_rows("SELECT
	c.relname AS \"Name\",
	CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\",
	pg_table_size(c.oid) AS \"Data_length\",
	pg_indexes_size(c.oid) AS \"Index_length\",
	obj_description(c.oid, 'pg_class') AS \"Comment\",
	".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\",
	c.reltuples as \"Rows\",
	n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($A!=""?"AND relname = ".q($A):"ORDER BY relname"))as$H)$G[$H["Name"]]=$H;return($A!=""?$G[$A]:$G);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$G=array();$va=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$H){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$H["full_type"],$_);list(,$T,$zd,$H["length"],$ra,$xa)=$_;$H["length"].=$xa;$Ta=$T.$ra;if(isset($va[$Ta])){$H["type"]=$va[$Ta];$H["full_type"]=$H["type"].$zd.$xa;}else{$H["type"]=$T;$H["full_type"]=$H["type"].$zd.$ra.$xa;}if(in_array($H['attidentity'],array('a','d')))$H['default']='GENERATED '.($H['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$H["null"]=!$H["attnotnull"];$H["auto_increment"]=$H['attidentity']||preg_match('~^nextval\(~i',$H["default"]);$H["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$H["default"],$_))$H["default"]=($_[1]=="NULL"?null:idf_unescape($_[1]).$_[2]);$G[$H["field"]]=$H;}return$G;}function
indexes($Q,$i=null){global$h;if(!is_object($i))$i=$h;$G=array();$Rf=$i->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Rf AND attnum > 0",$i);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Rf AND ci.oid = i.indexrelid",$i)as$H){$Ve=$H["relname"];$G[$Ve]["type"]=($H["indispartial"]?"INDEX":($H["indisprimary"]?"PRIMARY":($H["indisunique"]?"UNIQUE":"INDEX")));$G[$Ve]["columns"]=array();foreach(explode(" ",$H["indkey"])as$cd)$G[$Ve]["columns"][]=$f[$cd];$G[$Ve]["descs"]=array();foreach(explode(" ",$H["indoption"])as$dd)$G[$Ve]["descs"][]=($dd&1?'1':null);$G[$Ve]["lengths"]=array();}return$G;}function
foreign_keys($Q){global$fe;$G=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$H){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$H['definition'],$_)){$H['source']=array_map('idf_unescape',array_map('trim',explode(',',$_[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$_[2],$Hd)){$H['ns']=idf_unescape($Hd[2]);$H['table']=idf_unescape($Hd[4]);}$H['target']=array_map('idf_unescape',array_map('trim',explode(',',$_[3])));$H['on_delete']=(preg_match("~ON DELETE ($fe)~",$_[4],$Hd)?$Hd[1]:'NO ACTION');$H['on_update']=(preg_match("~ON UPDATE ($fe)~",$_[4],$Hd)?$Hd[1]:'NO ACTION');$G[$H['conname']]=$H;}}return$G;}function
view($A){global$h;return
array("select"=>trim($h->result("SELECT pg_get_viewdef(".$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($A)).")")));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$h;$G=h($h->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$G,$_))$G=$_[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($_[3]).'})(.*)~','\1<b>\2</b>',$_[2]).$_[4];return
nl_br($G);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$h;$h->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($A,$d){global$h;$h->close();return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($A));}function
auto_increment(){return"";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();$Oe=array();if($Q!=""&&$Q!=$A)$Oe[]="ALTER TABLE ".table($Q)." RENAME TO ".table($A);$qf="";foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$Gg=$X[5];unset($X[5]);if($o[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($e!=$X[0])$Oe[]="ALTER TABLE ".table($A)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";$rf=$Q."_".idf_unescape($X[0])."_seq";$c[]="ALTER $e ".($X[3]?"SET$X[3]":(isset($X[6])?"SET DEFAULT nextval(".q($rf).")":"DROP DEFAULT"));if(isset($X[6]))$qf="CREATE SEQUENCE IF NOT EXISTS ".idf_escape($rf)." OWNED BY ".idf_escape($Q).".$X[0]";$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}if($o[0]!=""||$Gg!="")$Oe[]="COMMENT ON COLUMN ".table($A).".$X[0] IS ".($Gg!=""?substr($Gg,9):"''");}}$c=array_merge($c,$zc);if($Q=="")array_unshift($Oe,"CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Oe,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($qf)array_unshift($Oe,$qf);if($gb!==null)$Oe[]="COMMENT ON TABLE ".table($A)." IS ".q($gb);if($Da!=""){}foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
alter_indexes($Q,$c){$tb=array();$Nb=array();$Oe=array();foreach($c
as$X){if($X[0]!="INDEX")$tb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Nb[]=idf_escape($X[1]);else$Oe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($tb)array_unshift($Oe,"ALTER TABLE ".table($Q).implode(",",$tb));if($Nb)array_unshift($Oe,"DROP INDEX ".implode(", ",$Nb));foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Lg){return
drop_tables($Lg);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Lg,$Sf){foreach(array_merge($S,$Lg)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($Sf)))return
false;}return
true;}function
trigger($A,$Q){if($A=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$f=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q)." AND trigger_name = ".q($A);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$H)$f[]=$H["event_object_column"];$G=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$H){if($f&&$H["Event"]=="UPDATE")$H["Event"].=" OF";$H["Of"]=implode(", ",$f);if($G)$H["Event"].=" OR $G[Event]";$G=$H;}return$G;}function
triggers($Q){$G=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$H){$og=trigger($H["trigger_name"],$Q);$G[$og["Trigger"]]=array($og["Timing"],$og["Event"]);}return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($A,$T){$I=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($A));$G=$I[0];$G["returns"]=array("type"=>$G["type_udt_name"]);$G["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($A).'
ORDER BY ordinal_position');return$G;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($A,$H){$G=array();foreach($H["fields"]as$o)$G[]=$o["type"];return
idf_escape($A)."(".implode(", ",$G).")";}function
last_id(){return
0;}function
explain($h,$E){return$h->query("EXPLAIN $E");}function
found_rows($R,$Z){global$h;if(preg_match("~ rows=([0-9]+)~",$h->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Ue))return$Ue[1];return
false;}function
types(){return
get_key_vals("SELECT oid, typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$h;return$h->result("SELECT current_schema()");}function
set_schema($if,$i=null){global$h,$U,$Jf;if(!$i)$i=$h;$G=$i->query("SET search_path TO ".idf_escape($if));foreach(types()as$x=>$T){if(!isset($U[$T])){$U[$T]=$x;$Jf[lang(9)][]=$T;}}return$G;}function
foreign_keys_sql($Q){$G="";$O=table_status($Q);$wc=foreign_keys($Q);ksort($wc);foreach($wc
as$vc=>$uc)$G.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($vc)." $uc[definition] ".($uc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($G?"$G\n":$G);}function
create_sql($Q,$Da,$Kf){$ef=array();$sf=array();$O=table_status($Q);if(is_view($O)){$Kg=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $Kg[select]",";");}$p=fields($Q);$v=indexes($Q);ksort($v);if(!$O||empty($p))return
false;$G="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($p
as$o){$ze=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$ef[]=$ze;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$Id)){$rf=$Id[1];$Df=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q(idf_unescape($rf)):"SELECT * FROM $rf"));$sf[]=($Kf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $rf;\n":"")."CREATE SEQUENCE $rf INCREMENT $Df[increment_by] MINVALUE $Df[min_value] MAXVALUE $Df[max_value]".($Da&&$Df['last_value']?" START ".($Df["last_value"]+1):"")." CACHE $Df[cache_value];";}}if(!empty($sf))$G=implode("\n\n",$sf)."\n\n$G";foreach($v
as$ad=>$u){switch($u['type']){case'UNIQUE':$ef[]="CONSTRAINT ".idf_escape($ad)." UNIQUE (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;case'PRIMARY':$ef[]="CONSTRAINT ".idf_escape($ad)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;}}$ob=get_key_vals("SELECT conname, ".(min_version(8)?"pg_get_constraintdef(pg_constraint.oid)":"CONCAT('CHECK ', consrc)")."
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname");foreach($ob
as$lb=>$nb)$ef[]="CONSTRAINT ".idf_escape($lb)." $nb";$G.=implode(",\n    ",$ef)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($v
as$ad=>$u){if($u['type']=='INDEX'){$f=array();foreach($u['columns']as$x=>$X)$f[]=idf_escape($X).($u['descs'][$x]?" DESC":"");$G.="\n\nCREATE INDEX ".idf_escape($ad)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$G.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($p
as$pc=>$o){if($o['comment'])$G.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($pc)." IS ".q($o['comment']).";";}return
rtrim($G,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$G="";foreach(triggers($Q)as$ng=>$mg){$og=trigger($ng,$O['Name']);$G.="\nCREATE TRIGGER ".idf_escape($og['Trigger'])." $og[Timing] $og[Event] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $og[Type] $og[Statement];;\n";}return$G;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(check|database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$oc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$h;return$h->result("SHOW max_connections");}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(26)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"macaddr8"=>23,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("char_length","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$Mb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($cc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($L,$V,$D){$this->_link=@oci_new_connect($V,$D,$L,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){$this->_current_db=$j;return
true;}function
query($E,$tg=false){$F=oci_parse($this->_link,$E);$this->error="";if(!$F){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$G=@oci_execute($F);restore_error_handler();if($G){if(oci_num_fields($F))return
new
Min_Result($F);$this->affected_rows=oci_num_rows($F);oci_free_statement($F);}return$G;}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=1){$F=$this->query($E);if(!is_object($F)||!oci_fetch($F->_result))return
false;return
oci_result($F->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($F){$this->_result=$F;}function
_convert($H){foreach((array)$H
as$x=>$X){if(is_a($X,'OCI-Lob'))$H[$x]=$X->load();}return$H;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$G=new
stdClass;$G->name=oci_field_name($this->_result,$e);$G->orgname=$G->name;$G->type=oci_field_type($this->_result,$e);$G->charsetnr=(preg_match("~raw|blob|bfile~",$G->type)?63:0);return$G;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($L,$V,$D){$this->dsn("oci:dbname=//$L;charset=AL32UTF8",$V,$D);return
true;}function
select_db($j){$this->_current_db=$j;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$I,$He){global$h;foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ag)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
hasCStyleEscapes(){return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT DISTINCT tablespace_name FROM (
SELECT tablespace_name FROM user_tablespaces
UNION SELECT tablespace_name FROM all_tables WHERE tablespace_name IS NOT NULL
)
ORDER BY 1");}function
limit($E,$Z,$y,$ce=0,$K=" "){return($ce?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $E$Z) t WHERE rownum <= ".($y+$ce).") WHERE rnum > $ce":($y!==null?" * FROM (SELECT $E$Z) WHERE rownum <= ".($y+$ce):" $E$Z"));}function
limit1($Q,$E,$Z,$K="\n"){return" $E$Z";}function
db_collation($l,$bb){global$h;return$h->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT USER FROM DUAL");}function
get_current_db(){global$h;$l=$h->_current_db?$h->_current_db:DB;unset($h->_current_db);return$l;}function
where_owner($Ge,$ue="owner"){if(!$_GET["ns"])return'';return"$Ge$ue = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($f){$ue=where_owner('');return"(SELECT $f FROM all_views WHERE ".($ue?$ue:"rownum < 0").")";}function
tables_list(){$Kg=views_table("view_name");$ue=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$ue
UNION SELECT view_name, 'view' FROM $Kg
ORDER BY 1");}function
count_tables($k){global$h;$G=array();foreach($k
as$l)$G[$l]=$h->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($l));return$G;}function
table_status($A=""){$G=array();$kf=q($A);$l=get_current_db();$Kg=views_table("view_name");$ue=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($l).$ue.($A!=""?" AND table_name = $kf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Kg".($A!=""?" WHERE view_name = $kf":"")."
ORDER BY 1")as$H){if($A!="")return$H;$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$G=array();$ue=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$ue ORDER BY column_id")as$H){$T=$H["DATA_TYPE"];$zd="$H[DATA_PRECISION],$H[DATA_SCALE]";if($zd==",")$zd=$H["CHAR_COL_DECL_LENGTH"];$G[$H["COLUMN_NAME"]]=array("field"=>$H["COLUMN_NAME"],"full_type"=>$T.($zd?"($zd)":""),"type"=>strtolower($T),"length"=>$zd,"default"=>$H["DATA_DEFAULT"],"null"=>($H["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$G;}function
indexes($Q,$i=null){$G=array();$ue=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($Q)."$ue
ORDER BY ac.constraint_type, aic.column_position",$i)as$H){$ad=$H["INDEX_NAME"];$eb=$H["DATA_DEFAULT"];$eb=($eb?trim($eb,'"'):$H["COLUMN_NAME"]);$G[$ad]["type"]=($H["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($H["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$G[$ad]["columns"][]=$eb;$G[$ad]["lengths"][]=($H["CHAR_LENGTH"]&&$H["CHAR_LENGTH"]!=$H["COLUMN_LENGTH"]?$H["CHAR_LENGTH"]:null);$G[$ad]["descs"][]=($H["DESCEND"]&&$H["DESCEND"]=="DESC"?'1':null);}return$G;}function
view($A){$Kg=views_table("view_name, text");$I=get_rows('SELECT text "select" FROM '.$Kg.' WHERE view_name = '.q($A));return
reset($I);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$h;return
h($h->error);}function
explain($h,$E){$h->query("EXPLAIN PLAN FOR $E");return$h->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=$Nb=array();$qe=($Q?fields($Q):array());foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");$pe=$qe[$o[0]];if($X&&$pe){$ee=process_field($pe,$pe);if($X[2]==$ee[2])$X[2]="";}if($X)$c[]=($Q!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$Nb[]=idf_escape($o[0]);}if($Q=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$Nb||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$Nb).")"))&&($Q==$A||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($A)));}function
alter_indexes($Q,$c){$Nb=array();$Oe=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$tb=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($Oe,"ALTER TABLE ".table($Q).$tb);}elseif($X[2]=="DROP")$Nb[]=idf_escape($X[1]);else$Oe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($Nb)array_unshift($Oe,"DROP INDEX ".implode(", ",$Nb));foreach($Oe
as$E){if(!queries($E))return
false;}return
true;}function
foreign_keys($Q){$G=array();$E="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($E)as$H)$G[$H['NAME']]=array("db"=>$H['DEST_DB'],"table"=>$H['DEST_TABLE'],"source"=>array($H['SRC_COLUMN']),"target"=>array($H['DEST_COLUMN']),"on_delete"=>$H['ON_DELETE'],"on_update"=>null,);return$G;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
apply_queries("DROP VIEW",$Lg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$G=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($G?$G:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$h;return$h->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($jf,$i=null){global$h;if(!$i)$i=$h;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($jf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$I=get_rows('SELECT * FROM v$instance');return
reset($I);}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$oc);}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(26)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$Mb["mssql"]="MS SQL";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($L,$V,$D){global$b;$mb=array("UID"=>$V,"PWD"=>$D,"CharacterSet"=>"UTF-8");$N=$b->connectSsl();if(isset($N["Encrypt"]))$mb["Encrypt"]=$N["Encrypt"];if(isset($N["TrustServerCertificate"]))$mb["TrustServerCertificate"]=$N["TrustServerCertificate"];$l=$b->database();if($l!="")$mb["Database"]=$l;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$L),$mb);if($this->_link){$ed=sqlsrv_server_info($this->_link);$this->server_info=$ed['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){$ug=strlen($P)!=strlen(utf8_decode($P));return($ug?"N":"")."'".str_replace("'","''",$P)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($E,$tg=false){$F=sqlsrv_query($this->_link,$E);$this->error="";if(!$F){$this->_get_error();return
false;}return$this->store_result($F);}function
multi_query($E){$this->_result=sqlsrv_query($this->_link,$E);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($F=null){if(!$F)$F=$this->_result;if(!$F)return
false;if(sqlsrv_field_metadata($F))return
new
Min_Result($F);$this->affected_rows=sqlsrv_rows_affected($F);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;$H=$F->fetch_row();return$H[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($F){$this->_result=$F;}function
_convert($H){foreach((array)$H
as$x=>$X){if(is_a($X,'DateTime'))$H[$x]=$X->format("Y-m-d H:i:s");}return$H;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$G=new
stdClass;$G->name=$o["Name"];$G->orgname=$o["Name"];$G->type=($o["Type"]==1?254:0);return$G;}function
seek($ce){for($s=0;$s<$ce;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($L,$V,$D){$this->_link=@mssql_connect($L,$V,$D);if($this->_link){$F=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($F){$H=$F->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$H[0]] $H[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){$ug=strlen($P)!=strlen(utf8_decode($P));return($ug?"N":"")."'".str_replace("'","''",$P)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($E,$tg=false){$F=@mssql_query($E,$this->_link);$this->error="";if(!$F){$this->error=mssql_get_last_message();return
false;}if($F===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($F);}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($E,$o=0){$F=$this->query($E);if(!is_object($F))return
false;return
mssql_result($F->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($F){$this->_result=$F;$this->num_rows=mssql_num_rows($F);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$G=mssql_fetch_field($this->_result);$G->orgtable=$G->table;$G->orgname=$G->name;return$G;}function
seek($ce){mssql_data_seek($this->_result,$ce);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($L,$V,$D){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$D);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$I,$He){foreach($I
as$M){$Ag=array();$Z=array();foreach($M
as$x=>$X){$Ag[]="$x = $X";if(isset($He[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$M).")) AS source (c".implode(", c",range(1,count($M))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Ag)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$vb=$b->credentials();if($vb[0]=="")$vb[0]="localhost:1433";if($h->connect($vb[0],$vb[1],$vb[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($E,$Z,$y,$ce=0,$K=" "){return($y!==null?" TOP (".($y+$ce).")":"")." $E$Z";}function
limit1($Q,$E,$Z,$K="\n"){return
limit($E,$Z,1,0,$K);}function
db_collation($l,$bb){global$h;return$h->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$h;$G=array();foreach($k
as$l){$h->select_db($l);$G[$l]=$h->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$G;}function
table_status($A=""){$G=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment
FROM sys.all_objects AS ao
WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$H){if($A!="")return$H;$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$hb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$G=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default], d.name default_constraint
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.object_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$H){$T=$H["type"];$zd=(preg_match("~char|binary~",$T)?$H["max_length"]/($T[0]=='n'?2:1):($T=="decimal"?"$H[precision],$H[scale]":""));$G[$H["name"]]=array("field"=>$H["name"],"full_type"=>$T.($zd?"($zd)":""),"type"=>$T,"length"=>$zd,"default"=>(preg_match("~^\('(.*)'\)$~",$H["default"],$_)?str_replace("''","'",$_[1]):$H["default"]),"default_constraint"=>$H["default_constraint"],"null"=>$H["is_nullable"],"auto_increment"=>$H["is_identity"],"collation"=>$H["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$H["is_identity"],"comment"=>$hb[$H["name"]],);}return$G;}function
indexes($Q,$i=null){$G=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$i)as$H){$A=$H["name"];$G[$A]["type"]=($H["is_primary_key"]?"PRIMARY":($H["is_unique"]?"UNIQUE":"INDEX"));$G[$A]["lengths"]=array();$G[$A]["columns"][$H["key_ordinal"]]=$H["column_name"];$G[$A]["descs"][$H["key_ordinal"]]=($H["is_descending_key"]?'1':null);}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$h->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($A))));}function
collations(){$G=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$G[preg_replace('~_.*~','',$d)][]=$d;return$G;}function
information_schema($l){return
false;}function
error(){global$h;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$h->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($A,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($A));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();$hb=array();$qe=fields($Q);foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$hb[$o[0]]=$X[5];unset($X[5]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($zc[$X[0]],16+strlen($X[0])):"");else{$Cb=$X[3];unset($X[3]);unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";$pe=$qe[$o[0]];if(default_value($pe)!=$Cb){if($pe["default"]!==null)$c["DROP"][]=" ".idf_escape($pe["default_constraint"]);if($Cb)$c["ADD"][]="\n $Cb FOR $e";}}}}if($Q=="")return
queries("CREATE TABLE ".table($A)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$A)queries("EXEC sp_rename ".q(table($Q)).", ".q($A));if($zc)$c[""]=$zc;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".table($A)." $x".implode(",",$X)))return
false;}foreach($hb
as$x=>$X){$gb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$gb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($Q,$c){$u=array();$Nb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Nb[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$Nb||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$Nb)));}function
last_id(){global$h;return$h->result("SELECT SCOPE_IDENTITY()");}function
explain($h,$E){$h->query("SET SHOWPLAN_ALL ON");$G=$h->query($E);$h->query("SET SHOWPLAN_ALL OFF");return$G;}function
found_rows($R,$Z){}function
foreign_keys($Q){$G=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q).", @fktable_owner = ".q(get_schema()))as$H){$Bc=&$G[$H["FK_NAME"]];$Bc["db"]=$H["PKTABLE_QUALIFIER"];$Bc["table"]=$H["PKTABLE_NAME"];$Bc["source"][]=$H["FKCOLUMN_NAME"];$Bc["target"][]=$H["PKCOLUMN_NAME"];}return$G;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Lg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Lg,$Sf){return
apply_queries("ALTER SCHEMA ".idf_escape($Sf)." TRANSFER",array_merge($S,$Lg));}function
trigger($A){if($A=="")return
array();$I=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($A));$G=reset($I);if($G)$G["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$G["text"]);return$G;}function
triggers($Q){$G=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$H)$G[$H["name"]]=array($H["Timing"],$H["Event"]);return$G;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$h;if($_GET["ns"]!="")return$_GET["ns"];return$h->result("SELECT SCHEMA_NAME()");}function
set_schema($if){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
support($oc){return
preg_match('~^(check|comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$oc);}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(26)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$Mb["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Bg,$B){try{$this->_link=new
MongoClient($Bg,$B);if($B["password"]!=""){$B["password"]="";try{new
MongoClient($Bg,$B);$this->error=lang(23);}catch(Exception$Qb){}}}catch(Exception$Qb){$this->error=$Qb->getMessage();}}function
query($E){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$fc){$this->error=$fc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($F){foreach($F
as$nd){$H=array();foreach($nd
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$H[$x]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$H;foreach($H
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);if(!$H)return$H;$G=array();foreach($this->_rows[0]as$x=>$X)$G[$x]=$H[$x];next($this->_rows);return$G;}function
fetch_row(){$G=$this->fetch_assoc();if(!$G)return$G;return
array_values($G);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$A=$qd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){$J=($J==array("*")?array():array_fill_keys($J,true));$Af=array();foreach($ne
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Af[$X]=($rb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$J)->sort($Af)->limit($y!=""?+$y:0)->skip($C*$y));}function
insert($Q,$M){try{$G=$this->_conn->_db->selectCollection($Q)->insert($M);$this->_conn->errno=$G['code'];$this->_conn->error=$G['err'];$this->_conn->last_id=$M['_id'];return!$G['err'];}catch(Exception$fc){$this->_conn->error=$fc->getMessage();return
false;}}}function
get_databases($xc){global$h;$G=array();$Ab=$h->_link->listDBs();foreach($Ab['databases']as$l)$G[]=$l['name'];return$G;}function
count_tables($k){global$h;$G=array();foreach($k
as$l)$G[$l]=count($h->_link->selectDB($l)->getCollectionNames(true));return$G;}function
tables_list(){global$h;return
array_fill_keys($h->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$h;foreach($k
as$l){$af=$h->_link->selectDB($l)->drop();if(!$af['ok'])return
false;}return
true;}function
indexes($Q,$i=null){global$h;$G=array();foreach($h->_db->selectCollection($Q)->getIndexInfo()as$u){$Gb=array();foreach($u["key"]as$e=>$T)$Gb[]=($T==-1?'1':null);$G[$u["name"]]=array("type"=>($u["name"]=="_id_"?"PRIMARY":($u["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($u["key"]),"lengths"=>array(),"descs"=>$Gb,);}return$G;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$h;return$h->_db->selectCollection($_GET["select"])->count($Z);}$ke=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Bg,$B){$Xa='MongoDB\Driver\Manager';$this->_link=new$Xa($Bg,$B);$this->executeCommand($B["db"],array('ping'=>1));}function
executeCommand($l,$fb){$Xa='MongoDB\Driver\Command';try{return$this->_link->executeCommand($l,new$Xa($fb));}catch(Exception$Qb){$this->error=$Qb->getMessage();return
array();}}function
executeBulkWrite($Wd,$Pa,$sb){try{$df=$this->_link->executeBulkWrite($Wd,$Pa);$this->affected_rows=$df->$sb();return
true;}catch(Exception$Qb){$this->error=$Qb->getMessage();return
false;}}function
query($E){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($F){foreach($F
as$nd){$H=array();foreach($nd
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$H[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$H;foreach($H
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);if(!$H)return$H;$G=array();foreach($this->_rows[0]as$x=>$X)$G[$x]=$H[$x];next($this->_rows);return$G;}function
fetch_row(){$G=$this->fetch_assoc();if(!$G)return$G;return
array_values($G);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$A=$qd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($Q,$J,$Z,$Ic,$ne=array(),$y=1,$C=0,$Je=false){global$h;$J=($J==array("*")?array():array_fill_keys($J,1));if(count($J)&&!isset($J['_id']))$J['_id']=0;$Z=where_to_query($Z);$Af=array();foreach($ne
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Af[$X]=($rb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$yf=$C*$y;$Xa='MongoDB\Driver\Query';try{return
new
Min_Result($h->_link->executeQuery("$h->_db_name.$Q",new$Xa($Z,array('projection'=>$J,'limit'=>$y,'skip'=>$yf,'sort'=>$Af))));}catch(Exception$Qb){$h->error=$Qb->getMessage();return
false;}}function
update($Q,$M,$Pe,$y=0,$K="\n"){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($Pe);$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());if(isset($M['_id']))unset($M['_id']);$We=array();foreach($M
as$x=>$Y){if($Y=='NULL'){$We[$x]=1;unset($M[$x]);}}$Ag=array('$set'=>$M);if(count($We))$Ag['$unset']=$We;$Pa->update($Z,$Ag,array('upsert'=>false));return$h->executeBulkWrite("$l.$Q",$Pa,'getModifiedCount');}function
delete($Q,$Pe,$y=0){global$h;$l=$h->_db_name;$Z=sql_query_where_parser($Pe);$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());$Pa->delete($Z,array('limit'=>$y));return$h->executeBulkWrite("$l.$Q",$Pa,'getDeletedCount');}function
insert($Q,$M){global$h;$l=$h->_db_name;$Xa='MongoDB\Driver\BulkWrite';$Pa=new$Xa(array());if($M['_id']=='')unset($M['_id']);$Pa->insert($M);return$h->executeBulkWrite("$l.$Q",$Pa,'getInsertedCount');}}function
get_databases($xc){global$h;$G=array();foreach($h->executeCommand($h->_db_name,array('listDatabases'=>1))as$Ab){foreach($Ab->databases
as$l)$G[]=$l->name;}return$G;}function
count_tables($k){$G=array();return$G;}function
tables_list(){global$h;$cb=array();foreach($h->executeCommand($h->_db_name,array('listCollections'=>1))as$F)$cb[$F->name]='table';return$cb;}function
drop_databases($k){return
false;}function
indexes($Q,$i=null){global$h;$G=array();foreach($h->executeCommand($h->_db_name,array('listIndexes'=>$Q))as$u){$Gb=array();$f=array();foreach(get_object_vars($u->key)as$e=>$T){$Gb[]=($T==-1?'1':null);$f[]=$e;}$G[$u->name]=array("type"=>($u->name=="_id_"?"PRIMARY":(isset($u->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Gb,);}return$G;}function
fields($Q){global$m;$p=fields_from_edit();if(!$p){$F=$m->select($Q,array("*"),null,null,array(),10);if($F){while($H=$F->fetch_assoc()){foreach($H
as$x=>$X){$H[$x]=null;$p[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$p;}function
found_rows($R,$Z){global$h;$Z=where_to_query($Z);$gg=$h->executeCommand($h->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$gg[0]->n;}function
sql_query_where_parser($Pe){$Pe=preg_replace('~^\s*WHERE\s*~',"",$Pe);while($Pe[0]=="(")$Pe=preg_replace('~^\((.*)\)$~',"$1",$Pe);$Tg=explode(' AND ',$Pe);$Ug=explode(') OR (',$Pe);$Z=array();foreach($Tg
as$Rg)$Z[]=trim($Rg);if(count($Ug)==1)$Ug=array();elseif(count($Ug)>1)$Z=array();return
where_to_query($Z,$Ug);}function
where_to_query($Pg=array(),$Qg=array()){global$b;$zb=array();foreach(array('and'=>$Pg,'or'=>$Qg)as$T=>$Z){if(is_array($Z)){foreach($Z
as$ic){list($ab,$ie,$X)=explode(" ",$ic,3);if($ab=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$_)){list(,$Xa,$X)=$_;$X=new$Xa($X);}if(!in_array($ie,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$ie,$_)){$X=(float)$X;$ie=$_[1];}elseif(preg_match('~^\(date\)(.+)~',$ie,$_)){$_b=new
DateTime($X);$Xa='MongoDB\BSON\UTCDatetime';$X=new$Xa($_b->getTimestamp()*1000);$ie=$_[1];}switch($ie){case'=':$ie='$eq';break;case'!=':$ie='$ne';break;case'>':$ie='$gt';break;case'<':$ie='$lt';break;case'>=':$ie='$gte';break;case'<=':$ie='$lte';break;case'regex':$ie='$regex';break;default:continue
2;}if($T=='and')$zb['$and'][]=array($ab=>array($ie=>$X));elseif($T=='or')$zb['$or'][]=array($ab=>array($ie=>$X));}}}return$zb;}$ke=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($t){return$t;}function
idf_escape($t){return$t;}function
table_status($A="",$nc=false){$G=array();foreach(tables_list()as$Q=>$T){$G[$Q]=array("Name"=>$Q);if($A==$Q)return$G[$Q];}return$G;}function
create_database($l,$d){return
true;}function
last_id(){global$h;return$h->last_id;}function
error(){global$h;return
h($h->error);}function
collations(){return
array();}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
connect(){global$b;$h=new
Min_DB;list($L,$V,$D)=$b->credentials();if($L=="")$L="localhost:27017";$B=array();if($V.$D!=""){$B["username"]=$V;$B["password"]=$D;}$l=$b->database();if($l!="")$B["db"]=$l;if(($Ca=getenv("MONGO_AUTH_SOURCE")))$B["authSource"]=$Ca;$h->connect("mongodb://$L",$B);if($h->error)return$h->error;return$h;}function
alter_indexes($Q,$c){global$h;foreach($c
as$X){list($T,$A,$M)=$X;if($M=="DROP")$G=$h->_db->command(array("deleteIndexes"=>$Q,"index"=>$A));else{$f=array();foreach($M
as$e){$e=preg_replace('~ DESC$~','',$e,1,$rb);$f[$e]=($rb?-1:1);}$G=$h->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$A,));}if($G['errmsg']){$h->error=$G['errmsg'];return
false;}}return
true;}function
support($oc){return
preg_match("~database|indexes|descidx~",$oc);}function
db_collation($l,$bb){}function
information_schema(){}function
is_view($R){}function
convert_field($o){}function
unconvert_field($o,$G){return$G;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){global$h;if($Q==""){$h->_db->createCollection($A);return
true;}}function
drop_tables($S){global$h;foreach($S
as$Q){$af=$h->_db->selectCollection($Q)->drop();if(!$af['ok'])return
false;}return
true;}function
truncate_tables($S){global$h;foreach($S
as$Q){$af=$h->_db->selectCollection($Q)->remove();if(!$af['ok'])return
false;}return
true;}function
driver_config(){global$ke;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$ke,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".lang(32)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($tb=false){return
password_file($tb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($L){}function
database(){global$h;if($h){$k=$this->databases(false);return(!$k?$h->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$k[(information_schema($k[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($xc=true){return
get_databases($xc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$G=array();$q="adminer.css";if(file_exists($q))$G[]=$q;return$G;}function
loginForm(){echo"<table class='layout'>\n",$this->loginFormField('username','<tr><th>'.lang(33).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" autofocus value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'),$this->loginFormField('password','<tr><th>'.lang(34).'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),"</table>\n","<p><input type='submit' value='".lang(35)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(36))."\n";}function
loginFormField($A,$Sc,$Y){return$Sc.$Y;}function
login($Dd,$D){return
true;}function
tableName($Pf){return
h($Pf["Comment"]!=""?$Pf["Comment"]:$Pf["Name"]);}function
fieldName($o,$ne=0){return
h(preg_replace('~\s+\[.*\]$~','',($o["comment"]!=""?$o["comment"]:$o["field"])));}function
selectLinks($Pf,$M=""){$a=$Pf["Name"];if($M!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$M).'">'.lang(37)."</a>\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Of){$G=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($Q)."
ORDER BY ORDINAL_POSITION",null,"")as$H)$G[$H["TABLE_NAME"]]["keys"][$H["CONSTRAINT_NAME"]][$H["COLUMN_NAME"]]=$H["REFERENCED_COLUMN_NAME"];foreach($G
as$x=>$X){$A=$this->tableName(table_status($x,true));if($A!=""){$kf=preg_quote($Of);$K="(:|\\s*-)?\\s+";$G[$x]["name"]=(preg_match("(^$kf$K(.+)|^(.+?)$K$kf\$)iu",$A,$_)?$_[2].$_[3]:$A);}else
unset($G[$x]);}return$G;}function
backwardKeysPrint($Ha,$H){foreach($Ha
as$Q=>$Ga){foreach($Ga["keys"]as$db){$z=ME.'select='.urlencode($Q);$s=0;foreach($db
as$e=>$X)$z.=where_link($s++,$e,$H[$X]);echo"<a href='".h($z)."'>".h($Ga["name"])."</a>";$z=ME.'edit='.urlencode($Q);foreach($db
as$e=>$X)$z.="&set".urlencode("[".bracket_escape($e)."]")."=".urlencode($H[$X]);echo"<a href='".h($z)."' title='".lang(37)."'>+</a> ";}}}function
selectQuery($E,$Hf,$mc=false){return"<!--\n".str_replace("--","--><!-- ",$E)."\n(".format_time($Hf).")\n-->\n";}function
rowDescription($Q){foreach(fields($Q)as$o){if(preg_match("~varchar|character varying~",$o["type"]))return
idf_escape($o["field"]);}return"";}function
rowDescriptions($I,$Ac){$G=$I;foreach($I[0]as$x=>$X){if(list($Q,$Wc,$A)=$this->_foreignColumn($Ac,$x)){$Yc=array();foreach($I
as$H)$Yc[$H[$x]]=q($H[$x]);$Fb=$this->_values[$Q];if(!$Fb)$Fb=get_key_vals("SELECT $Wc, $A FROM ".table($Q)." WHERE $Wc IN (".implode(", ",$Yc).")");foreach($I
as$Ud=>$H){if(isset($H[$x]))$G[$Ud][$x]=(string)$Fb[$H[$x]];}}}return$G;}function
selectLink($X,$o){}function
selectVal($X,$z,$o,$re){$G=$X;$z=h($z);if(preg_match('~blob|bytea~',$o["type"])&&!is_utf8($X)){$G=lang(38,strlen($re));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$re))$G="<img src='$z' alt='$G'>";}if(like_bool($o)&&$G!="")$G=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(39):lang(40));if($z)$G="<a href='$z'".(is_url($z)?target_blank():"").">$G</a>";if(!$z&&!like_bool($o)&&preg_match(number_type(),$o["type"]))$G="<div class='number'>$G</div>";elseif(preg_match('~date~',$o["type"]))$G="<div class='datetime'>$G</div>";return$G;}function
editVal($X,$o){if(preg_match('~date|timestamp~',$o["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(41),$X);return$X;}function
selectColumnsPrint($J,$f){}function
selectSearchPrint($Z,$f,$v){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(42)."</legend><div>\n";$qd=array();foreach($Z
as$x=>$X)$qd[$X["col"]]=$x;$s=0;$p=fields($_GET["select"]);foreach($f
as$A=>$Eb){$o=$p[$A];if(preg_match("~enum~",$o["type"])||like_bool($o)){$x=$qd[$A];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($A)."'>:",(like_bool($o)?" <select name='where[$s][val]'>".optionlist(array(""=>"",lang(40),lang(39)),$Z[$x]["val"],true)."</select>":enum_input("checkbox"," name='where[$s][val][]'",$o,(array)$Z[$x]["val"],($o["null"]?0:null))),"</div>\n";unset($f[$A]);}elseif(is_array($B=$this->_foreignKeyOptions($_GET["select"],$A))){if($p[$A]["null"])$B[0]='('.lang(7).')';$x=$qd[$A];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($A)."'><input type='hidden' name='where[$s][op]' value='='>: <select name='where[$s][val]'>".optionlist($B,$Z[$x]["val"],true)."</select></div>\n";unset($f[$A]);}}$s=0;foreach($Z
as$X){if(($X["col"]==""||$f[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$s][col]'><option value=''>(".lang(43).")".optionlist($f,$X["col"],true)."</select>",html_select("where[$s][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$s++;}}echo"<div><select name='where[$s][col]'><option value=''>(".lang(43).")".optionlist($f,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$s][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$s][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($ne,$f,$v){$oe=array();foreach($v
as$x=>$u){$ne=array();foreach($u["columns"]as$X)$ne[]=$f[$X];if(count(array_filter($ne,'strlen'))>1&&$x!="PRIMARY")$oe[$x]=implode(", ",$ne);}if($oe){echo'<fieldset><legend>'.lang(44)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$oe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".lang(45)."</legend><div>";echo
html_select("limit",array("","50","100"),$y),"</div></fieldset>\n";}function
selectLengthPrint($Wf){}function
selectActionPrint($v){echo"<fieldset><legend>".lang(46)."</legend><div>","<input type='submit' value='".lang(47)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Vb,$f){if($Vb){print_fieldset("email",lang(48),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(49).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(50).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$f,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(12)."'>\n";echo"<p>".lang(51).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Vb)==1?'<input type="hidden" name="email_field" value="'.h(key($Vb)).'">':html_select("email_field",$Vb)),"<input type='submit' name='email' value='".lang(52)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($f,$v){return
array(array(),array());}function
selectSearchProcess($p,$v){global$m;$G=array();foreach((array)$_GET["where"]as$x=>$Z){$ab=$Z["col"];$ie=$Z["op"];$X=$Z["val"];if(($x>=0&&$ab!="")||$X!=""){$ib=array();foreach(($ab!=""?array($ab=>$p[$ab]):$p)as$A=>$o){if($ab!=""||is_numeric($X)||!preg_match(number_type(),$o["type"])){$A=idf_escape($A);if($ab!=""&&$o["type"]=="enum")$ib[]=(in_array(0,$X)?"$A IS NULL OR ":"")."$A IN (".implode(", ",array_map('intval',$X)).")";else{$Xf=preg_match('~char|text|enum|set~',$o["type"]);$Y=$this->processInput($o,(!$ie&&$Xf&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$ib[]=$m->convertSearch($A,$Z,$o).($Y=="NULL"?" IS".($ie==">="?" NOT":"")." $Y":(in_array($ie,$this->operators)||$ie=="="?" $ie $Y":($Xf?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($x<0&&$X=="0")$ib[]="$A IS NULL";}}}$G[]=($ib?"(".implode(" OR ",$ib).")":"1 = 0");}}return$G;}function
selectOrderProcess($p,$v){$bd=$_GET["index_order"];if($bd!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($bd!=""?array($v[$bd]):$v)as$u){if($bd!=""||$u["type"]=="INDEX"){$Nc=array_filter($u["descs"]);$Eb=false;foreach($u["columns"]as$X){if(preg_match('~date|timestamp~',$p[$X]["type"])){$Eb=true;break;}}$G=array();foreach($u["columns"]as$x=>$X)$G[]=idf_escape($X).(($Nc?$u["descs"][$x]:$Eb)?" DESC":"");return$G;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$Ac){if($_POST["email_append"])return
true;if($_POST["email"]){$of=0;if($_POST["all"]||$_POST["check"]){$o=idf_escape($_POST["email_field"]);$Lf=$_POST["email_subject"];$Od=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Lf.$Od",$Id);$I=get_rows("SELECT DISTINCT $o".($Id[1]?", ".implode(", ",array_map('idf_escape',array_unique($Id[1]))):"")." FROM ".table($_GET["select"])." WHERE $o IS NOT NULL AND $o != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$p=fields($_GET["select"]);foreach($this->rowDescriptions($I,$Ac)as$H){$Ye=array('{\\'=>'{');foreach($Id[1]as$X)$Ye['{$'."$X}"]=$this->editVal($H[$X],$p[$X]);$Ub=$H[$_POST["email_field"]];if(is_mail($Ub)&&send_mail($Ub,strtr($Lf,$Ye),strtr($Od,$Ye),$_POST["email_from"],$_FILES["email_files"]))$of++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(53,$of));}return
false;}function
selectQueryBuild($J,$Z,$Ic,$ne,$y,$C){return"";}function
messageQuery($E,$Yf,$mc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$E)."\n".($Yf?"($Yf)\n":"")."-->";}function
editRowPrint($Q,$p,$H,$Ag){}function
editFunctions($o){$G=array();if($o["null"]&&preg_match('~blob~',$o["type"]))$G["NULL"]=lang(7);$G[""]=($o["null"]||$o["auto_increment"]||like_bool($o)?"":"*");if(preg_match('~date|time~',$o["type"]))$G["now"]=lang(54);if(preg_match('~_(md5|sha1)$~i',$o["field"],$_))$G[]=strtolower($_[1]);return$G;}function
editInput($Q,$o,$Aa,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Aa value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$Aa,$o,($Y||isset($_GET["select"])?$Y:0),($o["null"]?"":null));$B=$this->_foreignKeyOptions($Q,$o["field"],$Y);if($B!==null)return(is_array($B)?"<select$Aa>".optionlist($B,$Y,true)."</select>":"<input value='".h($Y)."'$Aa class='hidden'>"."<input value='".h($B)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($Q)."&field=".urlencode($o["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($o))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Aa>";$Tc="";if(preg_match('~time~',$o["type"]))$Tc=lang(55);if(preg_match('~date|timestamp~',$o["type"]))$Tc=lang(56).($Tc?" [$Tc]":"");if($Tc)return"<input value='".h($Y)."'$Aa> ($Tc)";if(preg_match('~_(md5|sha1)$~i',$o["field"]))return"<input type='password' value='".h($Y)."'$Aa>";return'';}function
editHint($Q,$o,$Y){return(preg_match('~\s+(\[.*\])$~',($o["comment"]!=""?$o["comment"]:$o["field"]),$_)?h(" $_[1]"):'');}function
processInput($o,$Y,$r=""){if($r=="now")return"$r()";$G=$Y;if(preg_match('~date|timestamp~',$o["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(41)))).'(.*))',$Y,$_))$G=($_["p1"]!=""?$_["p1"]:($_["p2"]!=""?($_["p2"]<70?20:19).$_["p2"]:gmdate("Y")))."-$_[p3]$_[p4]-$_[p5]$_[p6]".end($_);$G=($o["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$G:q($G));if($Y==""&&like_bool($o))$G="'0'";elseif($Y==""&&($o["null"]||!preg_match('~char|text~',$o["type"])))$G="NULL";elseif(preg_match('~^(md5|sha1)$~',$r))$G="$r($G)";return
unconvert_field($o,$G);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($Q,$Kf,$md=0){echo"\xef\xbb\xbf";}function
dumpData($Q,$Kf,$E){global$h;$F=$h->query($E,1);if($F){while($H=$F->fetch_assoc()){if($Kf=="table"){dump_csv(array_keys($H));$Kf="INSERT";}dump_csv($H);}}}function
dumpFilename($Xc){return
friendly_url($Xc);}function
dumpHeaders($Xc,$Sd=false){$jc="csv";header("Content-Type: text/csv; charset=utf-8");return$jc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Rd){global$ca;echo'<h1>
',$this->name(),'<span class="version">
',$ca,' <a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</span>
</h1>
';switch_lang();if($Rd=="auth"){$tc=true;foreach((array)$_SESSION["pwds"]as$Ig=>$uf){foreach($uf[""]as$V=>$D){if($D!==null){if($tc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$tc=false;}echo"<li><a href='".h(auth_url($Ig,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a>\n";}}}}else{$this->databasesPrint($Rd);if($Rd!="db"&&$Rd!="ns"){$R=table_status('',true);if(!$R)echo"<p class='message'>".lang(10)."\n";else$this->tablesPrint($R);}}}function
databasesPrint($Rd){}function
tablesPrint($S){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$H){echo'<li>';$A=$this->tableName($H);if(isset($H["Engine"])&&$A!="")echo"<a href='".h(ME).'select='.urlencode($H["Name"])."'".bold($_GET["select"]==$H["Name"]||$_GET["edit"]==$H["Name"],"select")." title='".lang(57)."'>$A</a>\n";}echo"</ul>\n";}function
_foreignColumn($Ac,$e){foreach((array)$Ac[$e]as$_c){if(count($_c["source"])==1){$A=$this->rowDescription($_c["table"]);if($A!=""){$Wc=idf_escape($_c["target"][0]);return
array($_c["table"],$Wc,$A);}}}}function
_foreignKeyOptions($Q,$e,$Y=null){global$h;if(list($Sf,$Wc,$A)=$this->_foreignColumn(column_foreign_keys($Q),$e)){$G=&$this->_values[$Sf];if($G===null){$R=table_status($Sf);$G=($R["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $Wc, $A FROM ".table($Sf)." ORDER BY 2"));}if(!$G&&$Y!==null)return$h->result("SELECT $A FROM ".table($Sf)." WHERE $Wc = ".q($Y));return$G;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$Mb=array("server"=>"MySQL")+$Mb;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($L="",$V="",$D="",$j=null,$De=null,$_f=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Uc,$De)=explode(":",$L,2);$N=$b->connectSsl();if($N)$this->ssl_set($N['key'],$N['cert'],$N['ca'],'','');$G=@$this->real_connect(($L!=""?$Uc:ini_get("mysqli.default_host")),($L.$V!=""?$V:ini_get("mysqli.default_user")),($L.$V.$D!=""?$D:ini_get("mysqli.default_pw")),$j,(is_numeric($De)?$De:ini_get("mysqli.default_port")),(!is_numeric($De)?$De:$_f),($N?(empty($N['cert'])?2048:64):0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$G;}function
set_charset($Ra){if(parent::set_charset($Ra))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ra");}function
result($E,$o=0){$F=$this->query($E);if(!$F)return
false;$H=$F->fetch_array();return$H[$o];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($L,$V,$D){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(58,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($L!=""?$L:ini_get("mysql.default_host")),("$L$V"!=""?$V:ini_get("mysql.default_user")),("$L$V$D"!=""?$D:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ra){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ra,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ra");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($E,$tg=false){$F=@($tg?mysql_unbuffered_query($E,$this->_link):mysql_query($E,$this->_link));$this->error="";if(!$F){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($F===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($F);}function
multi_query($E){return$this->_result=$this->query($E);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($E,$o=0){$F=$this->query($E);if(!$F||!$F->num_rows)return
false;return
mysql_result($F->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($F){$this->_result=$F;$this->num_rows=mysql_num_rows($F);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$G=mysql_fetch_field($this->_result,$this->_offset++);$G->orgtable=$G->table;$G->orgname=$G->name;$G->charsetnr=($G->blob?63:0);return$G;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($L,$V,$D){global$b;$B=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$N=$b->connectSsl();if($N){if(!empty($N['key']))$B[PDO::MYSQL_ATTR_SSL_KEY]=$N['key'];if(!empty($N['cert']))$B[PDO::MYSQL_ATTR_SSL_CERT]=$N['cert'];if(!empty($N['ca']))$B[PDO::MYSQL_ATTR_SSL_CA]=$N['ca'];if(!empty($N['verify']))$B[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT]=$N['verify'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$D,$B);return
true;}function
set_charset($Ra){$this->query("SET NAMES $Ra");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($E,$tg=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$tg);return
parent::query($E,$tg);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$M){return($M?parent::insert($Q,$M):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$I,$He){$f=array_keys(reset($I));$Ge="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$Hg=array();foreach($f
as$x)$Hg[$x]="$x = VALUES($x)";$Mf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Hg);$Hg=array();$zd=0;foreach($I
as$M){$Y="(".implode(", ",$M).")";if($Hg&&(strlen($Ge)+$zd+strlen($Y)+strlen($Mf)>1e6)){if(!queries($Ge.implode(",\n",$Hg).$Mf))return
false;$Hg=array();$zd=0;}$Hg[]=$Y;$zd+=strlen($Y)+2;}return
queries($Ge.implode(",\n",$Hg).$Mf);}function
slowQuery($E,$Zf){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$Zf FOR $E";elseif(preg_match('~^(SELECT\b)(.+)~is',$E,$_))return"$_[1] /*+ MAX_EXECUTION_TIME(".($Zf*1000).") */ $_[2]";}}function
convertSearch($t,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->_conn).")":$t);}function
warnings(){$F=$this->_conn->query("SHOW WARNINGS");if($F&&$F->num_rows){ob_start();select($F);return
ob_get_clean();}}function
tableHelp($A){$Fd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower("information-schema-".($Fd?"$A-table/":str_replace("_","-",$A)."-table.html"));if(DB=="mysql")return($Fd?"mysql$A-table/":"system-schema.html");}function
hasCStyleEscapes(){static$Qa;if($Qa===null){$Ff=$this->_conn->result("SHOW VARIABLES LIKE 'sql_mode'",1);$Qa=(strpos($Ff,'NO_BACKSLASH_ESCAPES')===false);}return$Qa;}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Jf,$Rb;$h=new
Min_DB;$vb=$b->credentials();if($h->connect($vb[0],$vb[1],$vb[2])){$h->set_charset(charset($h));$h->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$h)){$Jf[lang(26)][]="json";$U["json"]=4294967295;}if(min_version('',10.7,$h)){$Jf[lang(26)][]="uuid";$U["uuid"]=128;$Rb[0]['uuid']='uuid';}if(min_version(9,'',$h)){$Jf[lang(27)][]="vector";$U["vector"]=16383;$Rb[0]['vector']='string_to_vector';}return$h;}$G=$h->error;if(function_exists('iconv')&&!is_utf8($G)&&strlen($hf=iconv("windows-1250","utf-8",$G))>strlen($G))$G=$hf;return$G;}function
get_databases($xc){$G=get_session("dbs");if($G===null){$E=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$G=($xc?slow_query($E):get_vals($E));restart_session();set_session("dbs",$G);stop_session();}return$G;}function
limit($E,$Z,$y,$ce=0,$K=" "){return" $E$Z".($y!==null?$K."LIMIT $y".($ce?" OFFSET $ce":""):"");}function
limit1($Q,$E,$Z,$K="\n"){return
limit($E,$Z,1,0,$K);}function
db_collation($l,$bb){global$h;$G=null;$tb=$h->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$tb,$_))$G=$_[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$tb,$_))$G=$bb[$_[1]][-1];return$G;}function
engines(){$G=array();foreach(get_rows("SHOW ENGINES")as$H){if(preg_match("~YES|DEFAULT~",$H["Support"]))$G[]=$H["Engine"];}return$G;}function
logged_user(){global$h;return$h->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$G=array();foreach($k
as$l)$G[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$G;}function
table_status($A="",$nc=false){$G=array();foreach(get_rows($nc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($A!=""?"AND TABLE_NAME = ".q($A):"ORDER BY Name"):"SHOW TABLE STATUS".($A!=""?" LIKE ".q(addcslashes($A,"%_\\")):""))as$H){if($H["Engine"]=="InnoDB")$H["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$H["Comment"]);if(!isset($H["Engine"]))$H["Comment"]="";if($A!=""){$H["Name"]=$A;return$H;}$G[$H["Name"]]=$H;}return$G;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$G=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$H){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$H["Type"],$_);$G[$H["Field"]]=array("field"=>$H["Field"],"full_type"=>$H["Type"],"type"=>$_[1],"length"=>$_[2],"unsigned"=>ltrim($_[3].$_[4]),"default"=>($H["Default"]!=""||preg_match("~char|set~",$_[1])?(preg_match('~text~',$_[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$H["Default"])):$H["Default"]):null),"null"=>($H["Null"]=="YES"),"auto_increment"=>($H["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$H["Extra"],$_)?$_[1]:""),"collation"=>$H["Collation"],"privileges"=>array_flip(preg_split('~, *~',$H["Privileges"])),"comment"=>$H["Comment"],"primary"=>($H["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$H["Extra"]),);}return$G;}function
indexes($Q,$i=null){$G=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$i)as$H){$A=$H["Key_name"];$G[$A]["type"]=($A=="PRIMARY"?"PRIMARY":($H["Index_type"]=="FULLTEXT"?"FULLTEXT":($H["Non_unique"]?($H["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$G[$A]["columns"][]=$H["Column_name"];$G[$A]["lengths"][]=($H["Index_type"]=="SPATIAL"?null:$H["Sub_part"]);$G[$A]["descs"][]=null;}return$G;}function
foreign_keys($Q){global$h,$fe;static$Ae='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$G=array();$ub=$h->result("SHOW CREATE TABLE ".table($Q),1);if($ub){preg_match_all("~CONSTRAINT ($Ae) FOREIGN KEY ?\\(((?:$Ae,? ?)+)\\) REFERENCES ($Ae)(?:\\.($Ae))? \\(((?:$Ae,? ?)+)\\)(?: ON DELETE ($fe))?(?: ON UPDATE ($fe))?~",$ub,$Id,PREG_SET_ORDER);foreach($Id
as$_){preg_match_all("~$Ae~",$_[2],$Bf);preg_match_all("~$Ae~",$_[5],$Sf);$G[idf_unescape($_[1])]=array("db"=>idf_unescape($_[4]!=""?$_[3]:$_[4]),"table"=>idf_unescape($_[4]!=""?$_[4]:$_[3]),"source"=>array_map('idf_unescape',$Bf[0]),"target"=>array_map('idf_unescape',$Sf[0]),"on_delete"=>($_[6]?$_[6]:"RESTRICT"),"on_update"=>($_[7]?$_[7]:"RESTRICT"),);}}return$G;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$h->result("SHOW CREATE VIEW ".table($A),1)));}function
collations(){$G=array();foreach(get_rows("SHOW COLLATION")as$H){if($H["Default"])$G[$H["Charset"]][-1]=$H["Collation"];else$G[$H["Charset"]][]=$H["Collation"];}ksort($G);foreach($G
as$x=>$X)asort($G[$x]);return$G;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$h;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$h->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$G=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$G;}function
rename_database($A,$d){$G=false;if(create_database($A,$d)){$S=array();$Lg=array();foreach(tables_list()as$Q=>$T){if($T=='VIEW')$Lg[]=$Q;else$S[]=$Q;}$G=(!$S&&!$Lg)||move_tables($S,$Lg,$A);drop_databases($G?array(DB):array());}return$G;}function
auto_increment(){$Ea=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$Ea="";break;}if($u["type"]=="PRIMARY")$Ea=" UNIQUE";}}return" AUTO_INCREMENT$Ea";}function
alter_table($Q,$A,$p,$zc,$gb,$Yb,$d,$Da,$_e){$c=array();foreach($p
as$o)$c[]=($o[1]?($Q!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($Q!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$zc);$O=($gb!==null?" COMMENT=".q($gb):"").($Yb?" ENGINE=".q($Yb):"").($d?" COLLATE ".q($d):"").($Da!=""?" AUTO_INCREMENT=$Da":"");if($Q=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)$O$_e");if($Q!=$A)$c[]="RENAME TO ".table($A);if($O)$c[]=ltrim($O);return($c||$_e?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$_e):true);}function
alter_indexes($Q,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Lg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Lg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Lg,$Sf){global$h;$Xe=array();foreach($S
as$Q)$Xe[]=table($Q)." TO ".idf_escape($Sf).".".table($Q);if(!$Xe||queries("RENAME TABLE ".implode(", ",$Xe))){$Db=array();foreach($Lg
as$Q)$Db[table($Q)]=view($Q);$h->select_db($Sf);$l=idf_escape(DB);foreach($Db
as$A=>$Kg){if(!queries("CREATE VIEW $A AS ".str_replace(" $l."," ",$Kg["select"]))||!queries("DROP VIEW $l.$A"))return
false;}return
true;}return
false;}function
copy_tables($S,$Lg,$Sf){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$A=($Sf==DB?table("copy_$Q"):idf_escape($Sf).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $A"))||!queries("CREATE TABLE $A LIKE ".table($Q))||!queries("INSERT INTO $A SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$H){$og=$H["Trigger"];if(!queries("CREATE TRIGGER ".($Sf==DB?idf_escape("copy_$og"):idf_escape($Sf).".".idf_escape($og))." $H[Timing] $H[Event] ON $A FOR EACH ROW\n$H[Statement];"))return
false;}}foreach($Lg
as$Q){$A=($Sf==DB?table("copy_$Q"):idf_escape($Sf).".".table($Q));$Kg=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $A"))||!queries("CREATE VIEW $A AS $Kg[select]"))return
false;}return
true;}function
trigger($A){if($A=="")return
array();$I=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($A));return
reset($I);}function
triggers($Q){$G=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$H)$G[$H["Trigger"]]=array($H["Timing"],$H["Event"]);return$G;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($A,$T){global$h,$Zb,$gd,$U;$va=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Cf="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$sg="((".implode("|",array_merge(array_keys($U),$va)).")\\b(?:\\s*\\(((?:[^'\")]|$Zb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Ae="$Cf*(".($T=="FUNCTION"?"":$gd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$sg";$tb=$h->result("SHOW CREATE $T ".idf_escape($A),2);preg_match("~\\(((?:$Ae\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$sg\\s+":"")."(.*)~is",$tb,$_);$p=array();preg_match_all("~$Ae\\s*,?~is",$_[1],$Id,PREG_SET_ORDER);foreach($Id
as$xe)$p[]=array("field"=>str_replace("``","`",$xe[2]).$xe[3],"type"=>strtolower($xe[5]),"length"=>preg_replace_callback("~$Zb~s",'normalize_enum',$xe[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$xe[8] $xe[7]"))),"null"=>1,"full_type"=>$xe[4],"inout"=>strtoupper($xe[1]),"collation"=>strtolower($xe[9]),);return
array("fields"=>$p,"comment"=>$h->result("SELECT ROUTINE_COMMENT FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB)." AND ROUTINE_NAME = ".q($A)),)+($T!="FUNCTION"?array("definition"=>$_[11]):array("returns"=>array("type"=>$_[12],"length"=>$_[13],"unsigned"=>$_[15],"collation"=>$_[16]),"definition"=>$_[17],"language"=>"SQL",));}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($A,$H){return
idf_escape($A);}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ID()");}function
explain($h,$E){return$h->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$E);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($if,$i=null){return
true;}function
create_sql($Q,$Da,$Kf){global$h;$G=$h->result("SHOW CREATE TABLE ".table($Q),1);if(!$Da)$G=preg_replace('~ AUTO_INCREMENT=\d+~','',$G);return$G;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($Q){$G="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$H)$G.="\nCREATE TRIGGER ".idf_escape($H["Trigger"])." $H[Timing] $H[Event] ON ".table($H["Table"])." FOR EACH ROW\n$H[Statement];;\n";return$G;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$G){if(preg_match("~binary~",$o["type"]))$G="UNHEX($G)";if($o["type"]=="bit")$G="CONVERT(b$G, UNSIGNED)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"])){$Ge=(min_version(8)?"ST_":"");$G=$Ge."GeomFromText($G, $Ge"."SRID($o[field]))";}return$G;}function
support($oc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))).(min_version('8.0.16','10.2.1')?"":"|check")."~",$oc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$h;return$h->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Jf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(26)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(59)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$U+=$X;$Jf[$x]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Jf,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$jb=driver_config();$Fe=$jb['possible_drivers'];$w=$jb['jush'];$U=$jb['types'];$Jf=$jb['structured_types'];$_g=$jb['unsigned'];$ke=$jb['operators'];$Hc=$jb['functions'];$Lc=$jb['grouping'];$Rb=$jb['edit_functions'];if($b->operators===null)$b->operators=$ke;define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));function
page_header($bg,$n="",$Oa=array(),$cg=""){global$ba,$ca,$b,$Mb,$w;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$dg=$bg.($cg!=""?": $cg":"");$eg=strip_tags($dg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(60),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width">
<title>',$eg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.17.1"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.17.1");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
';foreach($b->css()as$xb){echo'<link rel="stylesheet" type="text/css" href="',h($xb),'">
';}}echo'
<body class="',lang(60),' nojs">
';$q=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($q)&&filemtime($q)+86400>time()){$Jg=unserialize(file_get_contents($q));$Me="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Jg["version"],base64_decode($Jg["signature"]),$Me)==1)$_COOKIE["adminer_version"]=$Jg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(61)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$w,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Oa!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$Mb[DRIVER].'</a> » ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$L=$b->serverName(SERVER);$L=($L!=""?$L:lang(62));if($Oa===false)echo"$L\n";else{echo"<a href='".h($z)."' accesskey='1' title='Alt+Shift+1'>$L</a> » ";if($_GET["ns"]!=""||(DB!=""&&is_array($Oa)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> » ';if(is_array($Oa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> » ';foreach($Oa
as$x=>$X){$Eb=(is_array($X)?$X[1]:h($X));if($Eb!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$Eb</a> » ";}}echo"$bg\n";}}echo"<h2>$dg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$wb){$Qc=array();foreach($wb
as$x=>$X)$Qc[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Qc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$Yd;if(!$Yd)$Yd=base64_encode(rand_string());return$Yd;}function
page_messages($n){$Bg=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Pd=$_SESSION["messages"][$Bg];if($Pd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Pd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Bg]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Rd=""){global$b,$hg;echo'</div>

<div id="menu">
';$b->navigation($Rd);echo'</div>

';if($Rd!="auth"){echo'<form action="" method="post">
<p class="logout">
',h($_GET["username"])."\n",'<input type="submit" name="logout" value="',lang(63),'" id="logout">
<input type="hidden" name="token" value="',$hg,'">
</p>
</form>
';}echo
script("setupSubmitHighlight(document);");}function
int32($Ud){while($Ud>=2147483648)$Ud-=4294967296;while($Ud<=-2147483649)$Ud+=4294967296;return(int)$Ud;}function
long2str($W,$Ng){$hf='';foreach($W
as$X)$hf.=pack('V',$X);if($Ng)return
substr($hf,0,end($W));return$hf;}function
str2long($hf,$Ng){$W=array_values(unpack('V*',str_pad($hf,4*ceil(strlen($hf)/4),"\0")));if($Ng)$W[]=strlen($hf);return$W;}function
xxtea_mx($Xg,$Wg,$Nf,$od){return
int32((($Xg>>5&0x7FFFFFF)^$Wg<<2)+(($Wg>>3&0x1FFFFFFF)^$Xg<<4))^int32(($Nf^$Wg)+($od^$Xg));}function
encrypt_string($If,$x){if($If=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($If,true);$Ud=count($W)-1;$Xg=$W[$Ud];$Wg=$W[0];$Ne=floor(6+52/($Ud+1));$Nf=0;while($Ne-->0){$Nf=int32($Nf+0x9E3779B9);$Qb=$Nf>>2&3;for($ve=0;$ve<$Ud;$ve++){$Wg=$W[$ve+1];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Xg=int32($W[$ve]+$Td);$W[$ve]=$Xg;}$Wg=$W[0];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Xg=int32($W[$Ud]+$Td);$W[$Ud]=$Xg;}return
long2str($W,false);}function
decrypt_string($If,$x){if($If=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($If,false);$Ud=count($W)-1;$Xg=$W[$Ud];$Wg=$W[0];$Ne=floor(6+52/($Ud+1));$Nf=int32($Ne*0x9E3779B9);while($Nf){$Qb=$Nf>>2&3;for($ve=$Ud;$ve>0;$ve--){$Xg=$W[$ve-1];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Wg=int32($W[$ve]-$Td);$W[$ve]=$Wg;}$Xg=$W[$Ud];$Td=xxtea_mx($Xg,$Wg,$Nf,$x[$ve&3^$Qb]);$Wg=int32($W[0]-$Td);$W[0]=$Wg;$Nf=int32($Nf-0x9E3779B9);}return
long2str($W,true);}$h='';$Pc=$_SESSION["token"];if(!$Pc)$_SESSION["token"]=rand(1,1e6);$hg=get_token();$Ce=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$Ce[$x]=$X;}}function
add_invalid_login(){global$b;$Fc=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Fc)return;$jd=unserialize(stream_get_contents($Fc));$Yf=time();if($jd){foreach($jd
as$kd=>$X){if($X[0]<$Yf)unset($jd[$kd]);}}$id=&$jd[$b->bruteForceKey()];if(!$id)$id=array($Yf+30*60,0);$id[1]++;file_write_unlock($Fc,serialize($jd));}function
check_invalid_login(){global$b;$jd=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$id=($jd?$jd[$b->bruteForceKey()]:array());$Xd=($id[1]>29?$id[0]-time():0);if($Xd>0)auth_error(lang(64,ceil($Xd/60)));}$Ba=$_POST["auth"];if($Ba){session_regenerate_id();$Ig=$Ba["driver"];$L=$Ba["server"];$V=$Ba["username"];$D=(string)$Ba["password"];$l=$Ba["db"];set_password($Ig,$L,$V,$D);$_SESSION["db"][$Ig][$L][$V][$l]=true;if($Ba["permanent"]){$x=base64_encode($Ig)."-".base64_encode($L)."-".base64_encode($V)."-".base64_encode($l);$Ke=$b->permanentLogin(true);$Ce[$x]="$x:".base64_encode($Ke?encrypt_string($D,$Ke):"");cookie("adminer_permanent",implode(" ",$Ce));}if(count($_POST)==1||DRIVER!=$Ig||SERVER!=$L||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($Ig,$L,$V,$l));}elseif($_POST["logout"]&&(!$Pc||verify_token())){foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(65).' '.lang(66));}elseif($Ce&&!$_SESSION["pwds"]){session_regenerate_id();$Ke=$b->permanentLogin();foreach($Ce
as$x=>$X){list(,$Wa)=explode(":",$X);list($Ig,$L,$V,$l)=array_map('base64_decode',explode("-",$x));set_password($Ig,$L,$V,decrypt_string(base64_decode($Wa),$Ke));$_SESSION["db"][$Ig][$L][$V][$l]=true;}}function
unset_permanent(){global$Ce;foreach($Ce
as$x=>$X){list($Ig,$L,$V,$l)=array_map('base64_decode',explode("-",$x));if($Ig==DRIVER&&$L==SERVER&&$V==$_GET["username"]&&$l==DB)unset($Ce[$x]);}cookie("adminer_permanent",implode(" ",$Ce));}function
auth_error($n){global$b,$Pc;$vf=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$vf]||$_GET[$vf])&&!$Pc)$n=lang(67);else{restart_session();add_invalid_login();$D=get_password();if($D!==null){if($D===false)$n.=($n?'<br>':'').lang(68,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$vf]&&$_GET[$vf]&&ini_bool("session.use_only_cookies"))$n=lang(69);$ye=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$ye["lifetime"]);page_header(lang(35),$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(70)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(71),lang(72,implode(", ",$Fe)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Uc,$De)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$De,$_)&&($_[1]<1024||$_[1]>65535))auth_error(lang(73));check_invalid_login();$h=connect();$m=new
Min_Driver($h);}$Dd=null;if(!is_object($h)||($Dd=$b->login($_GET["username"],get_password()))!==true){$n=(is_string($h)?nl_br(h($h)):(is_string($Dd)?$Dd:lang(74)));auth_error($n.(preg_match('~^ | $~',get_password())?'<br>'.lang(75):''));}if($_POST["logout"]&&$Pc&&!verify_token()){page_header(lang(63),lang(76));page_footer("db");exit;}if($Ba&&$_POST["token"])$_POST["token"]=$hg;$n='';if($_POST){if(!verify_token()){$fd="max_input_vars";$Md=ini_get($fd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Md||$X<$Md)){$fd=$x;$Md=$X;}}}$n=(!$_POST["token"]&&$Md?lang(77,"'$fd'"):lang(76).' '.lang(78));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=lang(79,"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.lang(80);}function
email_header($Qc){return"=?UTF-8?B?".base64_encode($Qc)."?=";}function
send_mail($Ub,$Lf,$Od,$Gc="",$rc=array()){$bc=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Od=str_replace("\n",$bc,wordwrap(str_replace("\r","","$Od\n")));$Na=uniqid("boundary");$_a="";foreach((array)$rc["error"]as$x=>$X){if(!$X)$_a.="--$Na$bc"."Content-Type: ".str_replace("\n","",$rc["type"][$x]).$bc."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$rc["name"][$x])."\"$bc"."Content-Transfer-Encoding: base64$bc$bc".chunk_split(base64_encode(file_get_contents($rc["tmp_name"][$x])),76,$bc).$bc;}$Ja="";$Rc="Content-Type: text/plain; charset=utf-8$bc"."Content-Transfer-Encoding: 8bit";if($_a){$_a.="--$Na--$bc";$Ja="--$Na$bc$Rc$bc$bc";$Rc="Content-Type: multipart/mixed; boundary=\"$Na\"";}$Rc.=$bc."MIME-Version: 1.0$bc"."X-Mailer: Adminer Editor".($Gc?$bc."From: ".str_replace("\n","",$Gc):"");return
mail($Ub,email_header($Lf),$Ja.$Od.$_a,$Rc);}function
like_bool($o){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$o["full_type"]);}$h->select_db($b->database());$fe="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Mb[DRIVER]=lang(35);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$J=array(idf_escape($_GET["field"]));$F=$m->select($a,$J,array(where($_GET,$p)),$J);$H=($F?$F->fetch_row():array());echo$m->value($H[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Ag=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$A=>$o){if(!isset($o["privileges"][$Ag?"update":"insert"])||$b->fieldName($o)==""||$o["generated"])unset($p[$A]);}if($_POST&&!$n&&!isset($_GET["select"])){$Cd=$_POST["referer"];if($_POST["insert"])$Cd=($Ag?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Cd))$Cd=ME."select=".urlencode($a);$v=indexes($a);$wg=unique_array($_GET["where"],$v);$Qe="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Cd,lang(81),$m->delete($a,$Qe,!$wg));else{$M=array();foreach($p
as$A=>$o){$X=process_input($o);if($X!==false&&$X!==null)$M[idf_escape($A)]=$X;}if($Ag){if(!$M)redirect($Cd);queries_redirect($Cd,lang(82),$m->update($a,$M,$Qe,!$wg));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$F=$m->insert($a,$M);$xd=($F?last_id():0);queries_redirect($Cd,lang(83,($xd?" $xd":"")),$F);}}}$H=null;if($_POST["save"])$H=(array)$_POST["fields"];elseif($Z){$J=array();foreach($p
as$A=>$o){if(isset($o["privileges"]["select"])){$ya=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$ya="''";if($w=="sql"&&preg_match("~enum|set~",$o["type"]))$ya="1*".idf_escape($A);$J[]=($ya?"$ya AS ":"").idf_escape($A);}}$H=array();if(!support("table"))$J=array("*");if($J){$F=$m->select($a,$J,array($Z),$J,array(),(isset($_GET["select"])?2:1));if(!$F)$n=error();else{$H=$F->fetch_assoc();if(!$H)$H=false;}if(isset($_GET["select"])&&(!$H||$F->fetch_assoc()))$H=null;}}if(!support("table")&&!$p){if(!$Z){$F=$m->select($a,array("*"),$Z,array("*"));$H=($F?$F->fetch_assoc():false);if(!$H)$H=array($m->primary=>"");}if($H){foreach($H
as$x=>$X){if(!$Z)$H[$x]=null;$p[$x]=array("field"=>$x,"null"=>($x!=$m->primary),"auto_increment"=>($x==$m->primary));}}}edit_form($a,$p,$H,$Ag);}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$v=indexes($a);$p=fields($a);$Cc=column_foreign_keys($a);$de=$R["Oid"];parse_str($_COOKIE["adminer_import"],$sa);$ff=array();$f=array();$Wf=null;foreach($p
as$x=>$o){$A=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$A!=""){$f[$x]=html_entity_decode(strip_tags($A),ENT_QUOTES);if(is_shortable($o))$Wf=$b->selectLengthProcess();}$ff+=$o["privileges"];}list($J,$Ic)=$b->selectColumnsProcess($f,$v);$ld=count($Ic)<count($J);$Z=$b->selectSearchProcess($p,$v);$ne=$b->selectOrderProcess($p,$v);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$xg=>$H){$ya=convert_field($p[key($H)]);$J=array($ya?$ya:idf_escape(key($H)));$Z[]=where_check($xg,$p);$G=$m->select($a,$J,$Z,$J);if($G)echo
reset($G->fetch_row());}exit;}$He=$zg=null;foreach($v
as$u){if($u["type"]=="PRIMARY"){$He=array_flip($u["columns"]);$zg=($J?$He:array());foreach($zg
as$x=>$X){if(in_array(idf_escape($x),$J))unset($zg[$x]);}break;}}if($de&&!$He){$He=$zg=array($de=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($de));}if($_POST&&!$n){$Sg=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Va=array();foreach($_POST["check"]as$Sa)$Va[]=where_check($Sa,$p);$Sg[]="((".implode(") OR (",$Va)."))";}$Sg=($Sg?"\nWHERE ".implode(" AND ",$Sg):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Gc=($J?implode(", ",$J):"*").convert_fields($f,$p,$J)."\nFROM ".table($a);$Kc=($Ic&&$ld?"\nGROUP BY ".implode(", ",$Ic):"").($ne?"\nORDER BY ".implode(", ",$ne):"");if(!is_array($_POST["check"])||$He)$E="SELECT $Gc$Sg$Kc";else{$vg=array();foreach($_POST["check"]as$X)$vg[]="(SELECT".limit($Gc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$Kc,1).")";$E=implode(" UNION ALL ",$vg);}$b->dumpData($a,"table",$E);exit;}if(!$b->selectEmailProcess($Z,$Cc)){if($_POST["save"]||$_POST["delete"]){$F=true;$ta=0;$M=array();if(!$_POST["delete"]){foreach($f
as$A=>$X){$X=process_input($p[$A]);if($X!==null&&($_POST["clone"]||$X!==false))$M[idf_escape($A)]=($X!==false?$X:idf_escape($A));}}if($_POST["delete"]||$M){if($_POST["clone"])$E="INTO ".table($a)." (".implode(", ",array_keys($M)).")\nSELECT ".implode(", ",$M)."\nFROM ".table($a);if($_POST["all"]||($He&&is_array($_POST["check"]))||$ld){$F=($_POST["delete"]?$m->delete($a,$Sg):($_POST["clone"]?queries("INSERT $E$Sg"):$m->update($a,$M,$Sg)));$ta=$h->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Og="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$F=($_POST["delete"]?$m->delete($a,$Og,1):($_POST["clone"]?queries("INSERT".limit1($a,$E,$Og)):$m->update($a,$M,$Og,1)));if(!$F)break;$ta+=$h->affected_rows;}}}$Od=lang(84,$ta);if($_POST["clone"]&&$F&&$ta==1){$xd=last_id();if($xd)$Od=lang(83," $xd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Od,$F);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n=lang(85);else{$F=true;$ta=0;foreach($_POST["val"]as$xg=>$H){$M=array();foreach($H
as$x=>$X){$x=bracket_escape($x,1);$M[idf_escape($x)]=(preg_match('~char|text~',$p[$x]["type"])||$X!=""?$b->processInput($p[$x],$X):"NULL");}$F=$m->update($a,$M," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($xg,$p),!$ld&&!$He," ");if(!$F)break;$ta+=$h->affected_rows;}queries_redirect(remove_from_uri(),lang(84,$ta),$F);}}elseif(!is_string($qc=get_file("csv_file",true)))$n=upload_error($qc);elseif(!preg_match('~~u',$qc))$n=lang(86);else{cookie("adminer_import","output=".urlencode($sa["output"])."&format=".urlencode($_POST["separator"]));$F=true;$db=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$qc,$Id);$ta=count($Id[0]);$m->begin();$K=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$I=array();foreach($Id[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$K]*)$K~",$X.$K,$Jd);if(!$x&&!array_diff($Jd[1],$db)){$db=$Jd[1];$ta--;}else{$M=array();foreach($Jd[1]as$s=>$ab)$M[idf_escape($db[$s])]=($ab==""&&$p[$db[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$ab))));$I[]=$M;}}$F=(!$I||$m->insertUpdate($a,$I,$He));if($F)$F=$m->commit();queries_redirect(remove_from_uri("page"),lang(87,$ta),$F);$m->rollback();}}}$Qf=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(47).": $Qf",$n);$M=null;if(isset($ff["insert"])||!support("table")){$ye=array();foreach((array)$_GET["where"]as$X){if(isset($Cc[$X["col"]])&&count($Cc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&(is_array($X["val"])||!preg_match('~[_%]~',$X["val"])))))$ye["set"."[".bracket_escape($X["col"])."]"]=$X["val"];}$M=$ye?"&".http_build_query($ye):"";}$b->selectLinks($R,$M);if(!$f&&support("table"))echo"<p class='error'>".lang(88).($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($J,$f);$b->selectSearchPrint($Z,$f,$v);$b->selectOrderPrint($ne,$f,$v);$b->selectLimitPrint($y);$b->selectLengthPrint($Wf);$b->selectActionPrint($v);echo"</form>\n";$C=$_GET["page"];if($C=="last"){$Ec=$h->result(count_rows($a,$Z,$ld,$Ic));$C=floor(max(0,$Ec-1)/$y);}$lf=$J;$Jc=$Ic;if(!$lf){$lf[]="*";$qb=convert_fields($f,$p,$J);if($qb)$lf[]=substr($qb,2);}foreach($J
as$x=>$X){$o=$p[idf_unescape($X)];if($o&&($ya=convert_field($o)))$lf[$x]="$ya AS $X";}if(!$ld&&$zg){foreach($zg
as$x=>$X){$lf[]=idf_escape($x);if($Jc)$Jc[]=idf_escape($x);}}$F=$m->select($a,$lf,$Z,$Jc,$ne,$y,$C,true);if(!$F)echo"<p class='error'>".error()."\n";else{if($w=="mssql"&&$C)$F->seek($y*$C);$Wb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$I=array();while($H=$F->fetch_assoc()){if($C&&$w=="oracle")unset($H["RNUM"]);$I[]=$H;}if($_GET["page"]!="last"&&$y!=""&&$Ic&&$ld&&$w=="sql")$Ec=$h->result(" SELECT FOUND_ROWS()");if(!$I)echo"<p class='message'>".lang(13)."\n";else{$Ia=$b->backwardKeys($a,$Qf);echo"<div class='scrollable'>","<table id='table' class='nowrap checkable odds'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Ic&&$J?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(89)."</a>");$Vd=array();$Hc=array();reset($J);$Se=1;foreach($I[0]as$x=>$X){if(!isset($zg[$x])){$X=$_GET["columns"][key($J)];$o=$p[$J?($X?$X["col"]:current($J)):$x];$A=($o?$b->fieldName($o,$Se):($X["fun"]?"*":h($x)));if($A!=""){$Se++;$Vd[$x]=$A;$e=idf_escape($x);$Vc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$Eb="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($x))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Vc.($ne[0]==$e||$ne[0]==$x||(!$ne&&$ld&&$Ic[0]==$e)?$Eb:'')).'">';echo
apply_sql_function($X["fun"],$A)."</a>";echo"<span class='column hidden'>","<a href='".h($Vc.$Eb)."' title='".lang(90)."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(42).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$Hc[$x]=$X["fun"];next($J);}}$_d=array();if($_GET["modify"]){foreach($I
as$H){foreach($H
as$x=>$X)$_d[$x]=max($_d[$x],min(40,strlen(utf8_decode($X))));}}echo($Ia?"<th>".lang(91):"")."</thead>\n";if(is_ajax())ob_end_clean();foreach($b->rowDescriptions($I,$Cc)as$Ud=>$H){$wg=unique_array($I[$Ud],$v);if(!$wg){$wg=array();foreach($I[$Ud]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$wg[$x]=$X;}}$xg="";foreach($wg
as$x=>$X){if(($w=="sql"||$w=="pgsql")&&preg_match('~char|text|enum|set~',$p[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($w!='sql'||preg_match("~^utf8~",$p[$x]["collation"])?$x:"CONVERT($x USING ".charset($h).")").")";$X=md5($X);}$xg.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr>".(!$Ic&&$J?"":"<td>".checkbox("check[]",substr($xg,1),in_array(substr($xg,1),(array)$_POST["check"])).($ld||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$xg)."' class='edit'>".lang(92)."</a>"));foreach($H
as$x=>$X){if(isset($Vd[$x])){$o=$p[$x];$X=$m->value($X,$o);if($X!=""&&(!isset($Wb[$x])||$Wb[$x]!=""))$Wb[$x]=(is_mail($X)?$Vd[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$xg;if(!$z&&$X!==null){foreach((array)$Cc[$x]as$Bc){if(count($Cc[$x])==1||end($Bc["source"])==$x){$z="";foreach($Bc["source"]as$s=>$Bf)$z.=where_link($s,$Bc["target"][$s],$I[$Ud][$Bf]);$z=($Bc["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($Bc["db"]),ME):ME).'select='.urlencode($Bc["table"]).$z;if($Bc["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($Bc["ns"]),$z);if(count($Bc["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$wg))$z.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($wg
as$od=>$W)$z.=where_link($s++,$od,$W);}$X=select_value($X,$z,$o,$Wf);$Wc=h("val[$xg][".bracket_escape($x)."]");$Y=$_POST["val"][$xg][bracket_escape($x)];$Sb=!is_array($H[$x])&&is_utf8($X)&&$I[$Ud][$x]==$H[$x]&&!$Hc[$x];$Uf=preg_match('~text|lob~',$o["type"]);echo"<td id='$Wc'";if(($_GET["modify"]&&$Sb)||$Y!==null){$Mc=h($Y!==null?$Y:$H[$x]);echo">".($Uf?"<textarea name='$Wc' cols='30' rows='".(substr_count($H[$x],"\n")+1)."'>$Mc</textarea>":"<input name='$Wc' value='$Mc' size='$_d[$x]'>");}else{$Ed=strpos($X,"<i>…</i>");echo" data-text='".($Ed?2:($Uf?1:0))."'".($Sb?"":" data-warning='".h(lang(93))."'").">$X</td>";}}}if($Ia)echo"<td>";$b->backwardKeysPrint($Ia,$I[$Ud]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($I||$C){$gc=true;if($_GET["page"]!="last"){if($y==""||(count($I)<$y&&($I||!$C)))$Ec=($C?$C*$y:0)+count($I);elseif($w!="sql"||!$ld){$Ec=($ld?false:found_rows($R,$Z));if($Ec<max(1e4,2*($C+1)*$y))$Ec=reset(slow_query(count_rows($a,$Z,$ld,$Ic)));else$gc=false;}}$we=($y!=""&&($Ec===false||$Ec>$y||$C));if($we){echo(($Ec===false?count($I)+1:$Ec-$C*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($C+1)).'" class="loadmore">'.lang(94).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".lang(95)."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($I||$C){if($we){$Kd=($Ec===false?$C+(count($I)>=$y?2:1):floor(($Ec-1)/$y));echo"<fieldset>";if($w!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(96)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(96)."', '".($C+1)."')); return false; };"),pagination(0,$C).($C>5?" …":"");for($s=max(1,$C-4);$s<min($Kd,$C+5);$s++)echo
pagination($s,$C);if($Kd>0){echo($C+5<$Kd?" …":""),($gc&&$Ec!==false?pagination($Kd,$C):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Kd'>".lang(97)."</a>");}}else{echo"<legend>".lang(96)."</legend>",pagination(0,$C).($C>1?" …":""),($C?pagination($C,$C):""),($Kd>$C?pagination($C+1,$C).($Kd>$C+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(98)."</legend>";$Kb=($gc?"":"~ ").$Ec;echo
checkbox("all",1,0,($Ec!==false?($gc?"":"~ ").lang(99,$Ec):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Kb' : checked); selectCount('selected2', this.checked || !checked ? '$Kb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(89),'</legend><div>
<input type="submit" value="',lang(15),'"',($_GET["modify"]?'':' title="'.lang(85).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(100),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(11),'">
<input type="submit" name="clone" value="',lang(101),'">
<input type="submit" name="delete" value="',lang(19),'">',confirm(),'</div></fieldset>
';}$Dc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Dc['sql']);break;}}if($Dc){print_fieldset("export",lang(102)." <span id='selected2'></span>");$te=$b->dumpOutput();echo($te?html_select("output",$te,$sa["output"])." ":""),html_select("format",$Dc,$sa["format"])," <input type='submit' name='export' value='".lang(102)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Wb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(103)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$sa["format"],1);echo" <input type='submit' name='import' value='".lang(103)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$hg'>\n","</form>\n",(!$Ic&&$J?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$h->query("KILL ".number($_POST["kill"]));elseif(list($Q,$Wc,$A)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$y=11;$F=$h->query("SELECT $Wc, $A FROM ".table($Q)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$Wc = $_GET[value] OR ":"")."$A LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $y");for($s=1;($H=$F->fetch_row())&&$s<$y;$s++)echo"<a href='".h(ME."edit=".urlencode($Q)."&where".urlencode("[".bracket_escape(idf_unescape($Wc))."]")."=".urlencode($H[0]))."'>".h($H[1])."</a><br>\n";if($H)echo"...\n";}exit;}else{page_header(lang(62),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(104).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(42)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table class='nowrap checkable odds'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(105),'<td>'.lang(106),"</thead>\n";foreach(table_status()as$Q=>$H){$A=$b->tableName($H);if(isset($H["Engine"])&&$A!=""){echo'<tr><td>'.checkbox("tables[]",$Q,in_array($Q,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($Q)."'>$A</a>";$X=format_number($H["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($Q)."'>".($H["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();