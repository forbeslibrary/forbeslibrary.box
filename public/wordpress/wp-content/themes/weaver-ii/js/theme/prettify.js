/*
 Copyright (C) 2006 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
var a=true,q=null,A=false;window.PR_SHOULD_USE_CONTINUATION=a;window.PR_TAB_WIDTH=8;window.PR_normalizedHtml=window.PR=window.prettyPrintOne=window.prettyPrint=void 0;window._pr_isIE6=function(){var B=navigator&&navigator.userAgent&&navigator.userAgent.match(/\bMSIE ([678])\./);B=B?+B[1]:A;window._pr_isIE6=function(){return B};return B};
(function(){function B(d){return d.replace(J,"&amp;").replace(K,"&lt;").replace(L,"&gt;")}function G(d,g,l){switch(d.nodeType){case 1:var o=d.tagName.toLowerCase();g.push("<",o);var p=d.attributes,t=p.length;if(t){if(l){for(var r=[],j=t;--j>=0;)r[j]=p[j];r.sort(function(s,i){return s.name<i.name?-1:s.name===i.name?0:1});p=r}for(j=0;j<t;++j){r=p[j];r.specified&&g.push(" ",r.name.toLowerCase(),'="',r.value.replace(J,"&amp;").replace(K,"&lt;").replace(L,"&gt;").replace(R,"&quot;"),'"')}}g.push(">");
for(p=d.firstChild;p;p=p.nextSibling)G(p,g,l);if(d.firstChild||!/^(?:br|link|img)$/.test(o))g.push("</",o,">");break;case 3:case 4:g.push(B(d.nodeValue))}}function M(d){function g(c){if(c.charAt(0)!=="\\")return c.charCodeAt(0);switch(c.charAt(1)){case "b":return 8;case "t":return 9;case "n":return 10;case "v":return 11;case "f":return 12;case "r":return 13;case "u":case "x":return parseInt(c.substring(2),16)||c.charCodeAt(1);case "0":case "1":case "2":case "3":case "4":case "5":case "6":case "7":return parseInt(c.substring(1),
8);default:return c.charCodeAt(1)}}function l(c){if(c<32)return(c<16?"\\x0":"\\x")+c.toString(16);c=String.fromCharCode(c);if(c==="\\"||c==="-"||c==="["||c==="]")c="\\"+c;return c}function o(c){var f=c.substring(1,c.length-1).match(RegExp("\\\\u[0-9A-Fa-f]{4}|\\\\x[0-9A-Fa-f]{2}|\\\\[0-3][0-7]{0,2}|\\\\[0-7]{1,2}|\\\\[\\s\\S]|-|[^-\\\\]","g"));c=[];for(var b=[],m=f[0]==="^",e=m?1:0,k=f.length;e<k;++e){var h=f[e];switch(h){case "\\B":case "\\b":case "\\D":case "\\d":case "\\S":case "\\s":case "\\W":case "\\w":c.push(h);
continue}h=g(h);var u;if(e+2<k&&"-"===f[e+1]){u=g(f[e+2]);e+=2}else u=h;b.push([h,u]);if(!(u<65||h>122)){u<65||h>90||b.push([Math.max(65,h)|32,Math.min(u,90)|32]);u<97||h>122||b.push([Math.max(97,h)&-33,Math.min(u,122)&-33])}}b.sort(function(x,z){return x[0]-z[0]||z[1]-x[1]});f=[];h=[NaN,NaN];for(e=0;e<b.length;++e){k=b[e];if(k[0]<=h[1]+1)h[1]=Math.max(h[1],k[1]);else f.push(h=k)}b=["["];m&&b.push("^");b.push.apply(b,c);for(e=0;e<f.length;++e){k=f[e];b.push(l(k[0]));if(k[1]>k[0]){k[1]+1>k[0]&&b.push("-");
b.push(l(k[1]))}}b.push("]");return b.join("")}function p(c){for(var f=c.source.match(RegExp("(?:\\[(?:[^\\x5C\\x5D]|\\\\[\\s\\S])*\\]|\\\\u[A-Fa-f0-9]{4}|\\\\x[A-Fa-f0-9]{2}|\\\\[0-9]+|\\\\[^ux0-9]|\\(\\?[:!=]|[\\(\\)\\^]|[^\\x5B\\x5C\\(\\)\\^]+)","g")),b=f.length,m=[],e=0,k=0;e<b;++e){var h=f[e];if(h==="(")++k;else if("\\"===h.charAt(0))if((h=+h.substring(1))&&h<=k)m[h]=-1}for(e=1;e<m.length;++e)if(-1===m[e])m[e]=++t;for(k=e=0;e<b;++e){h=f[e];if(h==="("){++k;if(m[k]===undefined)f[e]="(?:"}else if("\\"===
h.charAt(0))if((h=+h.substring(1))&&h<=k)f[e]="\\"+m[k]}for(k=e=0;e<b;++e)if("^"===f[e]&&"^"!==f[e+1])f[e]="";if(c.ignoreCase&&r)for(e=0;e<b;++e){h=f[e];c=h.charAt(0);if(h.length>=2&&c==="[")f[e]=o(h);else if(c!=="\\")f[e]=h.replace(/[a-zA-Z]/g,function(u){u=u.charCodeAt(0);return"["+String.fromCharCode(u&-33,u|32)+"]"})}return f.join("")}for(var t=0,r=A,j=A,s=0,i=d.length;s<i;++s){var v=d[s];if(v.ignoreCase)j=a;else if(/[a-z]/i.test(v.source.replace(/\\u[0-9a-f]{4}|\\x[0-9a-f]{2}|\\[^ux]/gi,""))){r=
a;j=A;break}}var n=[];s=0;for(i=d.length;s<i;++s){v=d[s];if(v.global||v.multiline)throw Error(""+v);n.push("(?:"+p(v)+")")}return RegExp(n.join("|"),j?"gi":"g")}function S(d){var g=0;return function(l){for(var o=q,p=0,t=0,r=l.length;t<r;++t){var j=l.charAt(t);switch(j){case "\t":o||(o=[]);o.push(l.substring(p,t));p=d-g%d;for(g+=p;p>=0;p-=16)o.push("                ".substring(0,p));p=t+1;break;case "\n":g=0;break;default:++g}}if(!o)return l;o.push(l.substring(p));return o.join("")}}function H(d,g,
l,o){if(g){d={source:g,basePos:d};l(d);o.push.apply(o,d.decorations)}}function C(d,g){var l={},o;(function(){for(var r=d.concat(g),j=[],s={},i=0,v=r.length;i<v;++i){var n=r[i],c=n[3];if(c)for(var f=c.length;--f>=0;)l[c.charAt(f)]=n;n=n[1];c=""+n;if(!s.hasOwnProperty(c)){j.push(n);s[c]=q}}j.push(/[\0-\uffff]/);o=M(j)})();var p=g.length,t=function(r){var j=r.source,s=r.basePos,i=[s,"pln"],v=0;j=j.match(o)||[];for(var n={},c=0,f=j.length;c<f;++c){var b=j[c],m=n[b],e=void 0,k;if(typeof m==="string")k=
A;else{var h=l[b.charAt(0)];if(h){e=b.match(h[1]);m=h[0]}else{for(k=0;k<p;++k){h=g[k];if(e=b.match(h[1])){m=h[0];break}}e||(m="pln")}if((k=m.length>=5&&"lang-"===m.substring(0,5))&&!(e&&typeof e[1]==="string")){k=A;m="src"}k||(n[b]=m)}h=v;v+=b.length;if(k){k=e[1];var u=b.indexOf(k),x=u+k.length;if(e[2]){x=b.length-e[2].length;u=x-k.length}m=m.substring(5);H(s+h,b.substring(0,u),t,i);H(s+h+u,k,N(m,k),i);H(s+h+x,b.substring(x),t,i)}else i.push(s+h,m)}r.decorations=i};return t}function y(d){var g=[],
l=[];if(d.tripleQuotedStrings)g.push(["str",/^(?:\'\'\'(?:[^\'\\]|\\[\s\S]|\'{1,2}(?=[^\']))*(?:\'\'\'|$)|\"\"\"(?:[^\"\\]|\\[\s\S]|\"{1,2}(?=[^\"]))*(?:\"\"\"|$)|\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$))/,q,"'\""]);else d.multiLineStrings?g.push(["str",/^(?:\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$)|\`(?:[^\\\`]|\\[\s\S])*(?:\`|$))/,q,"'\"`"]):g.push(["str",/^(?:\'(?:[^\\\'\r\n]|\\.)*(?:\'|$)|\"(?:[^\\\"\r\n]|\\.)*(?:\"|$))/,q,"\"'"]);d.verbatimStrings&&
l.push(["str",/^@\"(?:[^\"]|\"\")*(?:\"|$)/,q]);var o=d.hashComments;if(o)if(d.cStyleComments){o>1?g.push(["com",/^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/,q,"#"]):g.push(["com",/^#(?:(?:define|elif|else|endif|error|ifdef|include|ifndef|line|pragma|undef|warning)\b|[^\r\n]*)/,q,"#"]);l.push(["str",/^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h|[a-z]\w*)>/,q])}else g.push(["com",/^#[^\r\n]*/,q,"#"]);if(d.cStyleComments){l.push(["com",/^\/\/[^\r\n]*/,q]);l.push(["com",/^\/\*[\s\S]*?(?:\*\/|$)/,
q])}d.regexLiterals&&l.push(["lang-regex",RegExp("^"+T+"(/(?=[^/*])(?:[^/\\x5B\\x5C]|\\x5C[\\s\\S]|\\x5B(?:[^\\x5C\\x5D]|\\x5C[\\s\\S])*(?:\\x5D|$))+/)")]);d=d.keywords.replace(/^\s+|\s+$/g,"");d.length&&l.push(["kwd",RegExp("^(?:"+d.replace(/\s+/g,"|")+")\\b"),q]);g.push(["pln",/^\s+/,q," \r\n\t\u00a0"]);l.push(["lit",/^@[a-z_$][a-z_$@0-9]*/i,q],["typ",/^@?[A-Z]+[a-z][A-Za-z_$@0-9]*/,q],["pln",/^[a-z_$][a-z_$@0-9]*/i,q],["lit",/^(?:0x[a-f0-9]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+\-]?\d+)?)[a-z]*/i,
q,"0123456789"],["pun",/^.[^\s\w\.$@\'\"\`\/\#]*/,q]);return C(g,l)}function U(d){function g(D){if(D>s){if(i&&i!==v){j.push("</span>");i=q}if(!i&&v){i=v;j.push('<span class="',i,'">')}var O=B(f(l.substring(s,D))).replace(h?m:b,"$1&#160;");h=k.test(O);j.push(O.replace(e,x));s=D}}var l=d.source,o=d.extractedTags,p=d.decorations,t=d.numberLines,r=d.sourceNode,j=[],s=0,i=q,v=q,n=0,c=0,f=S(window.PR_TAB_WIDTH),b=/([\r\n ]) /g,m=/(^| ) /gm,e=/\r\n?|\n/g,k=/[ \r\n]$/,h=a,u=window._pr_isIE6();r=u?r&&r.tagName===
"PRE"?u===6?"&#160;\r\n":u===7?"&#160;<br />\r":u===8?"&#160;<br />":"&#160;\r":"&#160;<br />":"<br />";var x;if(t){var z=[];for(u=0;u<10;++u)z[u]=r+'</li><li class="L'+u+'">';var E=typeof t==="number"?t-1:0;j.push('<ol class="linenums"><li class="L',E%10,'"');E&&j.push(' value="',E+1,'"');j.push(">");x=function(){var D=z[++E%10];return i?"</span>"+D+'<span class="'+i+'">':D}}else x=r;for(;;)if(r=n<o.length?c<p.length?o[n]<=p[c]:a:A){g(o[n]);if(i){j.push("</span>");i=q}j.push(o[n+1]);n+=2}else if(c<
p.length){g(p[c]);v=p[c+1];c+=2}else break;g(l.length);i&&j.push("</span>");t&&j.push("</li></ol>");d.prettyPrintedHtml=j.join("")}function w(d,g){for(var l=g.length;--l>=0;){var o=g[l];if(F.hasOwnProperty(o))"console"in window&&console.warn("cannot override language handler %s",o);else F[o]=d}}function N(d,g){d&&F.hasOwnProperty(d)||(d=/^\s*</.test(g)?"default-markup":"default-code");return F[d]}function P(d){var g=d.sourceCodeHtml,l=d.langExtension;d.prettyPrintedHtml=g;try{var o,p=g.match(V);g=
[];var t=0,r=[];if(p)for(var j=0,s=p.length;j<s;++j){var i=p[j];if(i.length>1&&i.charAt(0)==="<"){if(!W.test(i))if(X.test(i)){g.push(i.substring(9,i.length-3));t+=i.length-12}else if(Y.test(i)){g.push("\n");++t}else if(i.indexOf("nocode")>=0&&i.replace(/\s(\w+)\s*=\s*(?:\"([^\"]*)\"|'([^\']*)'|(\S+))/g,' $1="$2$3$4"').match(/[cC][lL][aA][sS][sS]=\"[^\"]*\bnocode\b/)){var v=i.match(Q)[2],n=1,c;c=j+1;a:for(;c<s;++c){var f=p[c].match(Q);if(f&&f[2]===v)if(f[1]==="/"){if(--n===0)break a}else++n}if(c<s){r.push(t,
p.slice(j,c+1).join(""));j=c}else r.push(t,i)}else r.push(t,i)}else{var b;n=i;var m=n.indexOf("&");if(m<0)b=n;else{for(--m;(m=n.indexOf("&#",m+1))>=0;){var e=n.indexOf(";",m);if(e>=0){var k=n.substring(m+3,e),h=10;if(k&&k.charAt(0)==="x"){k=k.substring(1);h=16}var u=parseInt(k,h);isNaN(u)||(n=n.substring(0,m)+String.fromCharCode(u)+n.substring(e+1))}}b=n.replace(Z,"<").replace($,">").replace(aa,"'").replace(ba,'"').replace(ca," ").replace(da,"&")}g.push(b);t+=b.length}}o={source:g.join(""),tags:r};
var x=o.source;d.source=x;d.basePos=0;d.extractedTags=o.tags;N(l,x)(d);U(d)}catch(z){if("console"in window)console.log(z&&z.stack?z.stack:z)}}function ea(d,g,l){d={sourceCodeHtml:d,langExtension:g,numberLines:l};P(d);return d.prettyPrintedHtml}function fa(d){function g(){for(var v=window.PR_SHOULD_USE_CONTINUATION?j.now()+250:Infinity;s<o.length&&j.now()<v;s++){var n=o[s];if(n.className&&n.className.indexOf("prettyprint")>=0){var c=n.className.match(/\blang-(\w+)\b/);if(c)c=c[1];for(var f=A,b=n.parentNode;b;b=
b.parentNode)if((b.tagName==="pre"||b.tagName==="code"||b.tagName==="xmp")&&b.className&&b.className.indexOf("prettyprint")>=0){f=a;break}if(!f){b=n;if(q===I){f=document.createElement("PRE");f.appendChild(document.createTextNode('<!DOCTYPE foo PUBLIC "foo bar">\n<foo />'));I=!/</.test(f.innerHTML)}if(I){f=b.innerHTML;if("XMP"===b.tagName)f=B(f);else{if("PRE"===b.tagName)b=a;else if(ga.test(f)){var m="";if(b.currentStyle)m=b.currentStyle.whiteSpace;else if(window.getComputedStyle)m=window.getComputedStyle(b,
q).whiteSpace;b=!m||m==="pre"}else b=a;b||(f=f.replace(/(<br\s*\/?>)[\r\n]+/g,"$1").replace(/(?:[\r\n]+[ \t]*)+/g," "))}}else{f=[];for(b=b.firstChild;b;b=b.nextSibling)G(b,f);f=f.join("")}f=f.replace(/(?:\r\n?|\n)$/,"");b=n.className.match(/\blinenums\b(?::(\d+))?/);i={sourceCodeHtml:f,langExtension:c,sourceNode:n,numberLines:b?b[1]&&b[1].length?+b[1]:a:A};P(i);if(n=i.prettyPrintedHtml){c=i.sourceNode;if("XMP"===c.tagName){f=document.createElement("PRE");for(b=0;b<c.attributes.length;++b){m=c.attributes[b];
if(m.specified){var e=m.name.toLowerCase();if(e==="class")f.className=m.value;else f.setAttribute(m.name,m.value)}}f.innerHTML=n;c.parentNode.replaceChild(f,c)}else c.innerHTML=n}}}}if(s<o.length)setTimeout(g,250);else d&&d()}for(var l=[document.getElementsByTagName("pre"),document.getElementsByTagName("code"),document.getElementsByTagName("xmp")],o=[],p=0;p<l.length;++p)for(var t=0,r=l[p].length;t<r;++t)o.push(l[p][t]);l=q;var j=Date;j.now||(j={now:function(){return(new Date).getTime()}});var s=
0,i;g()}var T=function(){for(var d=["!","!=","!==","#","%","%=","&","&&","&&=","&=","(","*","*=","+=",",","-=","->","/","/=",":","::",";","<","<<","<<=","<=","=","==","===",">",">=",">>",">>=",">>>",">>>=","?","@","[","^","^=","^^","^^=","{","|","|=","||","||=","~","break","case","continue","delete","do","else","finally","instanceof","return","throw","try","typeof"],g="(?:^^|[+-]",l=0;l<d.length;++l)g+="|"+d[l].replace(/([^=<>:&a-z])/g,"\\$1");g+=")\\s*";return g}(),J=/&/g,K=/</g,L=/>/g,R=/\"/g,Z=
/&lt;/g,$=/&gt;/g,aa=/&apos;/g,ba=/&quot;/g,da=/&amp;/g,ca=/&nbsp;/g,ga=/[\r\n]/g,I=q,V=RegExp("[^<]+|<\!--[\\s\\S]*?--\>|<!\\[CDATA\\[[\\s\\S]*?\\]\\]>|</?[a-zA-Z](?:[^>\"']|'[^']*'|\"[^\"]*\")*>|<","g"),W=/^<\!--/,X=/^<!\[CDATA\[/,Y=/^<br\b/i,Q=/^<(\/?)([a-zA-Z][a-zA-Z0-9]*)/,ha=y({keywords:"break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof alignof align_union asm axiom bool concept concept_map const_cast constexpr decltype dynamic_cast explicit export friend inline late_check mutable namespace nullptr reinterpret_cast static_assert static_cast template typeid typename using virtual wchar_t where break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof abstract boolean byte extends final finally implements import instanceof null native package strictfp super synchronized throws transient as base by checked decimal delegate descending dynamic event fixed foreach from group implicit in interface internal into is lock object out override orderby params partial readonly ref sbyte sealed stackalloc string select uint ulong unchecked unsafe ushort var break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof debugger eval export function get null set undefined var with Infinity NaN caller delete die do dump elsif eval exit foreach for goto if import last local my next no our print package redo require sub undef unless until use wantarray while BEGIN END break continue do else for if return while and as assert class def del elif except exec finally from global import in is lambda nonlocal not or pass print raise try with yield False True None break continue do else for if return while alias and begin case class def defined elsif end ensure false in module next nil not or redo rescue retry self super then true undef unless until when yield BEGIN END break continue do else for if return while case done elif esac eval fi function in local set then until ",
hashComments:a,cStyleComments:a,multiLineStrings:a,regexLiterals:a}),F={};w(ha,["default-code"]);w(C([],[["pln",/^[^<?]+/],["dec",/^<!\w[^>]*(?:>|$)/],["com",/^<\!--[\s\S]*?(?:-\->|$)/],["lang-",/^<\?([\s\S]+?)(?:\?>|$)/],["lang-",/^<%([\s\S]+?)(?:%>|$)/],["pun",/^(?:<[%?]|[%?]>)/],["lang-",/^<xmp\b[^>]*>([\s\S]+?)<\/xmp\b[^>]*>/i],["lang-js",/^<script\b[^>]*>([\s\S]*?)(<\/script\b[^>]*>)/i],["lang-css",/^<style\b[^>]*>([\s\S]*?)(<\/style\b[^>]*>)/i],["lang-in.tag",/^(<\/?[a-z][^<>]*>)/i]]),["default-markup",
"htm","html","mxml","xhtml","xml","xsl"]);w(C([["pln",/^[\s]+/,q," \t\r\n"],["atv",/^(?:\"[^\"]*\"?|\'[^\']*\'?)/,q,"\"'"]],[["tag",/^^<\/?[a-z](?:[\w.:-]*\w)?|\/?>$/i],["atn",/^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],["lang-uq.val",/^=\s*([^>\'\"\s]*(?:[^>\'\"\s\/]|\/(?=\s)))/],["pun",/^[=<>\/]+/],["lang-js",/^on\w+\s*=\s*\"([^\"]+)\"/i],["lang-js",/^on\w+\s*=\s*\'([^\']+)\'/i],["lang-js",/^on\w+\s*=\s*([^\"\'>\s]+)/i],["lang-css",/^style\s*=\s*\"([^\"]+)\"/i],["lang-css",/^style\s*=\s*\'([^\']+)\'/i],
["lang-css",/^style\s*=\s*([^\"\'>\s]+)/i]]),["in.tag"]);w(C([],[["atv",/^[\s\S]+/]]),["uq.val"]);w(y({keywords:"break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof alignof align_union asm axiom bool concept concept_map const_cast constexpr decltype dynamic_cast explicit export friend inline late_check mutable namespace nullptr reinterpret_cast static_assert static_cast template typeid typename using virtual wchar_t where ",
hashComments:a,cStyleComments:a}),["c","cc","cpp","cxx","cyc","m"]);w(y({keywords:"null true false"}),["json"]);w(y({keywords:"break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof abstract boolean byte extends final finally implements import instanceof null native package strictfp super synchronized throws transient as base by checked decimal delegate descending dynamic event fixed foreach from group implicit in interface internal into is lock object out override orderby params partial readonly ref sbyte sealed stackalloc string select uint ulong unchecked unsafe ushort var ",
hashComments:a,cStyleComments:a,verbatimStrings:a}),["cs"]);w(y({keywords:"break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof abstract boolean byte extends final finally implements import instanceof null native package strictfp super synchronized throws transient ",
cStyleComments:a}),["java"]);w(y({keywords:"break continue do else for if return while case done elif esac eval fi function in local set then until ",hashComments:a,multiLineStrings:a}),["bsh","csh","sh"]);w(y({keywords:"break continue do else for if return while and as assert class def del elif except exec finally from global import in is lambda nonlocal not or pass print raise try with yield False True None ",hashComments:a,multiLineStrings:a,tripleQuotedStrings:a}),["cv","py"]);w(y({keywords:"caller delete die do dump elsif eval exit foreach for goto if import last local my next no our print package redo require sub undef unless until use wantarray while BEGIN END ",
hashComments:a,multiLineStrings:a,regexLiterals:a}),["perl","pl","pm"]);w(y({keywords:"break continue do else for if return while alias and begin case class def defined elsif end ensure false in module next nil not or redo rescue retry self super then true undef unless until when yield BEGIN END ",hashComments:a,multiLineStrings:a,regexLiterals:a}),["rb"]);w(y({keywords:"break continue do else for if return while auto case char const default double enum extern float goto int long register short signed sizeof static struct switch typedef union unsigned void volatile catch class delete false import new operator private protected public this throw true try typeof debugger eval export function get null set undefined var with Infinity NaN ",
cStyleComments:a,regexLiterals:a}),["js"]);w(y({keywords:"all and by catch class else extends false finally for if in is isnt loop new no not null of off on or return super then true try unless until when while yes ",hashComments:3,cStyleComments:a,multilineStrings:a,tripleQuotedStrings:a,regexLiterals:a}),["coffee"]);w(C([],[["str",/^[\s\S]+/]]),["regex"]);window.PR_normalizedHtml=G;window.prettyPrintOne=ea;window.prettyPrint=fa;window.PR={combinePrefixPatterns:M,createSimpleLexer:C,registerLangHandler:w,
sourceDecorator:y,PR_ATTRIB_NAME:"atn",PR_ATTRIB_VALUE:"atv",PR_COMMENT:"com",PR_DECLARATION:"dec",PR_KEYWORD:"kwd",PR_LITERAL:"lit",PR_NOCODE:"nocode",PR_PLAIN:"pln",PR_PUNCTUATION:"pun",PR_SOURCE:"src",PR_STRING:"str",PR_TAG:"tag",PR_TYPE:"typ"}})();/*
 Copyright (C) 2009 Onno Hommes.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_COMMENT,/^#[^\r\n]*/,q,"#"],[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_STRING,/^\"(?:[^\"\\]|\\[\s\S])*(?:\"|$)/,q,'"']],[[PR.PR_KEYWORD,/^(?:ADS|AD|AUG|BZF|BZMF|CAE|CAF|CA|CCS|COM|CS|DAS|DCA|DCOM|DCS|DDOUBL|DIM|DOUBLE|DTCB|DTCF|DV|DXCH|EDRUPT|EXTEND|INCR|INDEX|NDX|INHINT|LXCH|MASK|MSK|MP|MSU|NOOP|OVSK|QXCH|RAND|READ|RELINT|RESUME|RETURN|ROR|RXOR|SQUARE|SU|TCR|TCAA|OVSK|TCF|TC|TS|WAND|WOR|WRITE|XCH|XLQ|XXALQ|ZL|ZQ|ADD|ADZ|SUB|SUZ|MPY|MPR|MPZ|DVP|COM|ABS|CLA|CLZ|LDQ|STO|STQ|ALS|LLS|LRS|TRA|TSQ|TMI|TOV|AXT|TIX|DLY|INP|OUT)\s/,
q],[PR.PR_TYPE,/^(?:-?GENADR|=MINUS|2BCADR|VN|BOF|MM|-?2CADR|-?[1-6]DNADR|ADRES|BBCON|[SE]?BANK\=?|BLOCK|BNKSUM|E?CADR|COUNT\*?|2?DEC\*?|-?DNCHAN|-?DNPTR|EQUALS|ERASE|MEMORY|2?OCT|REMADR|SETLOC|SUBRO|ORG|BSS|BES|SYN|EQU|DEFINE|END)\s/,q],[PR.PR_LITERAL,/^\'(?:-*(?:\w|\\[\x21-\x7e])(?:[\w-]*|\\[\x21-\x7e])[=!?]?)?/],[PR.PR_PLAIN,/^-*(?:[!-z_]|\\[\x21-\x7e])(?:[\w-]*|\\[\x21-\x7e])[=!?]?/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \xA0()\"\\\';]+/]]),["apollo","agc","aea"]);/*
 Copyright (C) 2009 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[ \t\r\n\f]+/,q," \t\r\n\u000c"]],[[PR.PR_STRING,/^\"(?:[^\n\r\f\\\"]|\\(?:\r\n?|\n|\f)|\\[\s\S])*\"/,q],[PR.PR_STRING,/^\'(?:[^\n\r\f\\\']|\\(?:\r\n?|\n|\f)|\\[\s\S])*\'/,q],["lang-css-str",/^url\(([^\)\"\']*)\)/i],[PR.PR_KEYWORD,/^(?:url|rgb|\!important|@import|@page|@media|@charset|inherit)(?=[^\-\w]|$)/i,q],["lang-css-kw",/^(-?(?:[_a-z]|(?:\\[0-9a-f]+ ?))(?:[_a-z0-9\-]|\\(?:\\[0-9a-f]+ ?))*)\s*:/i],[PR.PR_COMMENT,/^\/\*[^*]*\*+(?:[^\/*][^*]*\*+)*\//],
[PR.PR_COMMENT,/^(?:<\!--|--\>)/],[PR.PR_LITERAL,/^(?:\d+|\d*\.\d+)(?:%|[a-z]+)?/i],[PR.PR_LITERAL,/^#(?:[0-9a-f]{3}){1,2}/i],[PR.PR_PLAIN,/^-?(?:[_a-z]|(?:\\[\da-f]+ ?))(?:[_a-z\d\-]|\\(?:\\[\da-f]+ ?))*/i],[PR.PR_PUNCTUATION,/^[^\s\w\'\"]+/]]),["css"]);PR.registerLangHandler(PR.createSimpleLexer([],[[PR.PR_KEYWORD,/^-?(?:[_a-z]|(?:\\[\da-f]+ ?))(?:[_a-z\d\-]|\\(?:\\[\da-f]+ ?))*/i]]),["css-kw"]);PR.registerLangHandler(PR.createSimpleLexer([],[[PR.PR_STRING,/^[^\)\"\']+/]]),["css-str"]);/*
 Copyright (C) 2010 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_PLAIN,/^(?:\"(?:[^\"\\]|\\[\s\S])*(?:\"|$)|\'(?:[^\'\\]|\\[\s\S])+(?:\'|$))/,q,"\"'"]],[[PR.PR_COMMENT,/^(?:\/\/[^\r\n]*|\/\*[\s\S]*?\*\/)/],[PR.PR_PLAIN,/^(?:[^\/\"\']|\/(?![\/\*]))+/i]]),["go"]);/*
 Copyright (C) 2009 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\x0B\x0C\r ]+/,q,"\t\n\u000b\u000c\r "],[PR.PR_STRING,/^\"(?:[^\"\\\n\x0C\r]|\\[\s\S])*(?:\"|$)/,q,'"'],[PR.PR_STRING,/^\'(?:[^\'\\\n\x0C\r]|\\[^&])\'?/,q,"'"],[PR.PR_LITERAL,/^(?:0o[0-7]+|0x[\da-f]+|\d+(?:\.\d+)?(?:e[+\-]?\d+)?)/i,q,"0123456789"]],[[PR.PR_COMMENT,/^(?:(?:--+(?:[^\r\n\x0C]*)?)|(?:\{-(?:[^-]|-+[^-\}])*-\}))/],[PR.PR_KEYWORD,/^(?:case|class|data|default|deriving|do|else|if|import|in|infix|infixl|infixr|instance|let|module|newtype|of|then|type|where|_)(?=[^a-zA-Z0-9\']|$)/,
q],[PR.PR_PLAIN,/^(?:[A-Z][\w\']*\.)*[a-zA-Z][\w\']*/],[PR.PR_PUNCTUATION,/^[^\t\n\x0B\x0C\r a-zA-Z0-9\'\"]+/]]),["hs"]);/*
 Copyright (C) 2008 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([["opn",/^\(+/,q,"("],["clo",/^\)+/,q,")"],[PR.PR_COMMENT,/^;[^\r\n]*/,q,";"],[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_STRING,/^\"(?:[^\"\\]|\\[\s\S])*(?:\"|$)/,q,'"']],[[PR.PR_KEYWORD,/^(?:block|c[ad]+r|catch|con[ds]|def(?:ine|un)|do|eq|eql|equal|equalp|eval-when|flet|format|go|if|labels|lambda|let|load-time-value|locally|macrolet|multiple-value-call|nil|progn|progv|quote|require|return-from|setq|symbol-macrolet|t|tagbody|the|throw|unwind)\b/,
q],[PR.PR_LITERAL,/^[+\-]?(?:[0#]x[0-9a-f]+|\d+\/\d+|(?:\.\d+|\d+(?:\.\d*)?)(?:[ed][+\-]?\d+)?)/i],[PR.PR_LITERAL,/^\'(?:-*(?:\w|\\[\x21-\x7e])(?:[\w-]*|\\[\x21-\x7e])[=!?]?)?/],[PR.PR_PLAIN,/^-*(?:[a-z_]|\\[\x21-\x7e])(?:[\w-]*|\\[\x21-\x7e])[=!?]?/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \xA0()\"\\\';]+/]]),["cl","el","lisp","scm"]);/*
 Copyright (C) 2008 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_STRING,/^(?:\"(?:[^\"\\]|\\[\s\S])*(?:\"|$)|\'(?:[^\'\\]|\\[\s\S])*(?:\'|$))/,q,"\"'"]],[[PR.PR_COMMENT,/^--(?:\[(=*)\[[\s\S]*?(?:\]\1\]|$)|[^\r\n]*)/],[PR.PR_STRING,/^\[(=*)\[[\s\S]*?(?:\]\1\]|$)/],[PR.PR_KEYWORD,/^(?:and|break|do|else|elseif|end|false|for|function|if|in|local|nil|not|or|repeat|return|then|true|until|while)\b/,q],[PR.PR_LITERAL,/^[+-]?(?:0x[\da-f]+|(?:(?:\.\d+|\d+(?:\.\d*)?)(?:e[+\-]?\d+)?))/i],
[PR.PR_PLAIN,/^[a-z_]\w*/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \xA0][^\w\t\n\r \xA0\"\'\-\+=]*/]]),["lua"]);/*
 Copyright (C) 2008 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_COMMENT,/^#(?:if[\t\n\r \xA0]+(?:[a-z_$][\w\']*|``[^\r\n\t`]*(?:``|$))|else|endif|light)/i,q,"#"],[PR.PR_STRING,/^(?:\"(?:[^\"\\]|\\[\s\S])*(?:\"|$)|\'(?:[^\'\\]|\\[\s\S])(?:\'|$))/,q,"\"'"]],[[PR.PR_COMMENT,/^(?:\/\/[^\r\n]*|\(\*[\s\S]*?\*\))/],[PR.PR_KEYWORD,/^(?:abstract|and|as|assert|begin|class|default|delegate|do|done|downcast|downto|elif|else|end|exception|extern|false|finally|for|fun|function|if|in|inherit|inline|interface|internal|lazy|let|match|member|module|mutable|namespace|new|null|of|open|or|override|private|public|rec|return|static|struct|then|to|true|try|type|upcast|use|val|void|when|while|with|yield|asr|land|lor|lsl|lsr|lxor|mod|sig|atomic|break|checked|component|const|constraint|constructor|continue|eager|event|external|fixed|functor|global|include|method|mixin|object|parallel|process|protected|pure|sealed|trait|virtual|volatile)\b/],
[PR.PR_LITERAL,/^[+\-]?(?:0x[\da-f]+|(?:(?:\.\d+|\d+(?:\.\d*)?)(?:e[+\-]?\d+)?))/i],[PR.PR_PLAIN,/^(?:[a-z_][\w']*[!?#]?|``[^\r\n\t`]*(?:``|$))/i],[PR.PR_PUNCTUATION,/^[^\t\n\r \xA0\"\'\w]+/]]),["fs","ml"]);/*
 Copyright (C) 2006 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.sourceDecorator({keywords:"bool bytes default double enum extend extensions false fixed32 fixed64 float group import int32 int64 max message option optional package repeated required returns rpc service sfixed32 sfixed64 sint32 sint64 string syntax to true uint32 uint64",cStyleComments:a}),["proto"]);/*
 Copyright (C) 2010 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_STRING,/^(?:"(?:(?:""(?:""?(?!")|[^\\"]|\\.)*"{0,3})|(?:[^"\r\n\\]|\\.)*"?))/,q,'"'],[PR.PR_LITERAL,/^`(?:[^\r\n\\`]|\\.)*`?/,q,"`"],[PR.PR_PUNCTUATION,/^[!#%&()*+,\-:;<=>?@\[\\\]^{|}~]+/,q,"!#%&()*+,-:;<=>?@[\\]^{|}~"]],[[PR.PR_STRING,/^'(?:[^\r\n\\']|\\(?:'|[^\r\n']+))'/],[PR.PR_LITERAL,/^'[a-zA-Z_$][\w$]*(?!['$\w])/],[PR.PR_KEYWORD,/^(?:abstract|case|catch|class|def|do|else|extends|final|finally|for|forSome|if|implicit|import|lazy|match|new|object|override|package|private|protected|requires|return|sealed|super|throw|trait|try|type|val|var|while|with|yield)\b/],
[PR.PR_LITERAL,/^(?:true|false|null|this)\b/],[PR.PR_LITERAL,/^(?:(?:0(?:[0-7]+|X[0-9A-F]+))L?|(?:(?:0|[1-9][0-9]*)(?:(?:\.[0-9]+)?(?:E[+\-]?[0-9]+)?F?|L?))|\\.[0-9]+(?:E[+\-]?[0-9]+)?F?)/i],[PR.PR_TYPE,/^[$_]*[A-Z][_$A-Z0-9]*[a-z][\w$]*/],[PR.PR_PLAIN,/^[$a-zA-Z_][\w$]*/],[PR.PR_COMMENT,/^\/(?:\/.*|\*(?:\/|\**[^*/])*(?:\*+\/?)?)/],[PR.PR_PUNCTUATION,/^(?:\.+|\/)/]]),["scala"]);/*
 Copyright (C) 2008 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"],[PR.PR_STRING,/^(?:"(?:[^\"\\]|\\.)*"|'(?:[^\'\\]|\\.)*')/,q,"\"'"]],[[PR.PR_COMMENT,/^(?:--[^\r\n]*|\/\*[\s\S]*?(?:\*\/|$))/],[PR.PR_KEYWORD,/^(?:ADD|ALL|ALTER|AND|ANY|AS|ASC|AUTHORIZATION|BACKUP|BEGIN|BETWEEN|BREAK|BROWSE|BULK|BY|CASCADE|CASE|CHECK|CHECKPOINT|CLOSE|CLUSTERED|COALESCE|COLLATE|COLUMN|COMMIT|COMPUTE|CONSTRAINT|CONTAINS|CONTAINSTABLE|CONTINUE|CONVERT|CREATE|CROSS|CURRENT|CURRENT_DATE|CURRENT_TIME|CURRENT_TIMESTAMP|CURRENT_USER|CURSOR|DATABASE|DBCC|DEALLOCATE|DECLARE|DEFAULT|DELETE|DENY|DESC|DISK|DISTINCT|DISTRIBUTED|DOUBLE|DROP|DUMMY|DUMP|ELSE|END|ERRLVL|ESCAPE|EXCEPT|EXEC|EXECUTE|EXISTS|EXIT|FETCH|FILE|FILLFACTOR|FOR|FOREIGN|FREETEXT|FREETEXTTABLE|FROM|FULL|FUNCTION|GOTO|GRANT|GROUP|HAVING|HOLDLOCK|IDENTITY|IDENTITYCOL|IDENTITY_INSERT|IF|IN|INDEX|INNER|INSERT|INTERSECT|INTO|IS|JOIN|KEY|KILL|LEFT|LIKE|LINENO|LOAD|NATIONAL|NOCHECK|NONCLUSTERED|NOT|NULL|NULLIF|OF|OFF|OFFSETS|ON|OPEN|OPENDATASOURCE|OPENQUERY|OPENROWSET|OPENXML|OPTION|OR|ORDER|OUTER|OVER|PERCENT|PLAN|PRECISION|PRIMARY|PRINT|PROC|PROCEDURE|PUBLIC|RAISERROR|READ|READTEXT|RECONFIGURE|REFERENCES|REPLICATION|RESTORE|RESTRICT|RETURN|REVOKE|RIGHT|ROLLBACK|ROWCOUNT|ROWGUIDCOL|RULE|SAVE|SCHEMA|SELECT|SESSION_USER|SET|SETUSER|SHUTDOWN|SOME|STATISTICS|SYSTEM_USER|TABLE|TEXTSIZE|THEN|TO|TOP|TRAN|TRANSACTION|TRIGGER|TRUNCATE|TSEQUAL|UNION|UNIQUE|UPDATE|UPDATETEXT|USE|USER|VALUES|VARYING|VIEW|WAITFOR|WHEN|WHERE|WHILE|WITH|WRITETEXT)(?=[^\w-]|$)/i,
q],[PR.PR_LITERAL,/^[+-]?(?:0x[\da-f]+|(?:(?:\.\d+|\d+(?:\.\d*)?)(?:e[+\-]?\d+)?))/i],[PR.PR_PLAIN,/^[a-z_][\w-]*/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \xA0\"\'][^\w\t\n\r \xA0+\-\"\']*/]]),["sql"]);/*
 Copyright (C) 2009 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0\u2028\u2029]+/,q,"\t\n\r \u00a0\u2028\u2029"],[PR.PR_STRING,/^(?:[\"\u201C\u201D](?:[^\"\u201C\u201D]|[\"\u201C\u201D]{2})(?:[\"\u201C\u201D]c|$)|[\"\u201C\u201D](?:[^\"\u201C\u201D]|[\"\u201C\u201D]{2})*(?:[\"\u201C\u201D]|$))/i,q,'"\u201c\u201d'],[PR.PR_COMMENT,/^[\'\u2018\u2019][^\r\n\u2028\u2029]*/,q,"'\u2018\u2019"]],[[PR.PR_KEYWORD,/^(?:AddHandler|AddressOf|Alias|And|AndAlso|Ansi|As|Assembly|Auto|Boolean|ByRef|Byte|ByVal|Call|Case|Catch|CBool|CByte|CChar|CDate|CDbl|CDec|Char|CInt|Class|CLng|CObj|Const|CShort|CSng|CStr|CType|Date|Decimal|Declare|Default|Delegate|Dim|DirectCast|Do|Double|Each|Else|ElseIf|End|EndIf|Enum|Erase|Error|Event|Exit|Finally|For|Friend|Function|Get|GetType|GoSub|GoTo|Handles|If|Implements|Imports|In|Inherits|Integer|Interface|Is|Let|Lib|Like|Long|Loop|Me|Mod|Module|MustInherit|MustOverride|MyBase|MyClass|Namespace|New|Next|Not|NotInheritable|NotOverridable|Object|On|Option|Optional|Or|OrElse|Overloads|Overridable|Overrides|ParamArray|Preserve|Private|Property|Protected|Public|RaiseEvent|ReadOnly|ReDim|RemoveHandler|Resume|Return|Select|Set|Shadows|Shared|Short|Single|Static|Step|Stop|String|Structure|Sub|SyncLock|Then|Throw|To|Try|TypeOf|Unicode|Until|Variant|Wend|When|While|With|WithEvents|WriteOnly|Xor|EndIf|GoSub|Let|Variant|Wend)\b/i,
q],[PR.PR_COMMENT,/^REM[^\r\n\u2028\u2029]*/i],[PR.PR_LITERAL,/^(?:True\b|False\b|Nothing\b|\d+(?:E[+\-]?\d+[FRD]?|[FRDSIL])?|(?:&H[0-9A-F]+|&O[0-7]+)[SIL]?|\d*\.\d+(?:E[+\-]?\d+)?[FRD]?|#\s+(?:\d+[\-\/]\d+[\-\/]\d+(?:\s+\d+:\d+(?::\d+)?(\s*(?:AM|PM))?)?|\d+:\d+(?::\d+)?(\s*(?:AM|PM))?)\s+#)/i],[PR.PR_PLAIN,/^(?:(?:[a-z]|_\w)\w*|\[(?:[a-z]|_\w)\w*\])/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \"\'\[\]\xA0\u2018\u2019\u201C\u201D\u2028\u2029]+/],[PR.PR_PUNCTUATION,/^(?:\[|\])/]]),["vb","vbs"]);PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t\n\r \xA0]+/,q,"\t\n\r \u00a0"]],[[PR.PR_STRING,/^(?:[BOX]?"(?:[^\"]|"")*"|'.')/i],[PR.PR_COMMENT,/^--[^\r\n]*/],[PR.PR_KEYWORD,/^(?:abs|access|after|alias|all|and|architecture|array|assert|attribute|begin|block|body|buffer|bus|case|component|configuration|constant|disconnect|downto|else|elsif|end|entity|exit|file|for|function|generate|generic|group|guarded|if|impure|in|inertial|inout|is|label|library|linkage|literal|loop|map|mod|nand|new|next|nor|not|null|of|on|open|or|others|out|package|port|postponed|procedure|process|pure|range|record|register|reject|rem|report|return|rol|ror|select|severity|shared|signal|sla|sll|sra|srl|subtype|then|to|transport|type|unaffected|units|until|use|variable|wait|when|while|with|xnor|xor)(?=[^\w-]|$)/i,
q],[PR.PR_TYPE,/^(?:bit|bit_vector|character|boolean|integer|real|time|string|severity_level|positive|natural|signed|unsigned|line|text|std_u?logic(?:_vector)?)(?=[^\w-]|$)/i,q],[PR.PR_TYPE,/^\'(?:ACTIVE|ASCENDING|BASE|DELAYED|DRIVING|DRIVING_VALUE|EVENT|HIGH|IMAGE|INSTANCE_NAME|LAST_ACTIVE|LAST_EVENT|LAST_VALUE|LEFT|LEFTOF|LENGTH|LOW|PATH_NAME|POS|PRED|QUIET|RANGE|REVERSE_RANGE|RIGHT|RIGHTOF|SIMPLE_NAME|STABLE|SUCC|TRANSACTION|VAL|VALUE)(?=[^\w-]|$)/i,q],[PR.PR_LITERAL,/^\d+(?:_\d+)*(?:#[\w\\.]+#(?:[+\-]?\d+(?:_\d+)*)?|(?:\.\d+(?:_\d+)*)?(?:E[+\-]?\d+(?:_\d+)*)?)/i],
[PR.PR_PLAIN,/^(?:[a-z]\w*|\\[^\\]*\\)/i],[PR.PR_PUNCTUATION,/^[^\w\t\n\r \xA0\"\'][^\w\t\n\r \xA0\-\"\']*/]]),["vhdl","vhd"]);/*
 Copyright (C) 2009 Google Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PLAIN,/^[\t \xA0a-gi-z0-9]+/,q,"\t \u00a0abcdefgijklmnopqrstuvwxyz0123456789"],[PR.PR_PUNCTUATION,/^[=*~\^\[\]]+/,q,"=*~^[]"]],[["lang-wiki.meta",/(?:^^|\r\n?|\n)(#[a-z]+)\b/],[PR.PR_LITERAL,/^(?:[A-Z][a-z][a-z0-9]+[A-Z][a-z][a-zA-Z0-9]+)\b/],["lang-",/^\{\{\{([\s\S]+?)\}\}\}/],["lang-",/^`([^\r\n`]+)`/],[PR.PR_STRING,/^https?:\/\/[^\/?#\s]*(?:\/[^?#\s]*)?(?:\?[^#\s]*)?(?:#\S*)?/i],[PR.PR_PLAIN,/^(?:\r\n|[\s\S])[^#=*~^A-Zh\{`\[\r\n]*/]]),["wiki"]);
PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_KEYWORD,/^#[a-z]+/i,q,"#"]],[]),["wiki.meta"]);PR.registerLangHandler(PR.createSimpleLexer([[PR.PR_PUNCTUATION,/^[:|>?]+/,q,":|>?"],[PR.PR_DECLARATION,/^%(?:YAML|TAG)[^#\r\n]+/,q,"%"],[PR.PR_TYPE,/^[&]\S+/,q,"&"],[PR.PR_TYPE,/^!\S*/,q,"!"],[PR.PR_STRING,/^"(?:[^\\"]|\\.)*(?:"|$)/,q,'"'],[PR.PR_STRING,/^'(?:[^']|'')*(?:'|$)/,q,"'"],[PR.PR_COMMENT,/^#[^\r\n]*/,q,"#"],[PR.PR_PLAIN,/^\s+/,q," \t\r\n"]],[[PR.PR_DECLARATION,/^(?:---|\.\.\.)(?:[\r\n]|$)/],[PR.PR_PUNCTUATION,/^-/],[PR.PR_KEYWORD,/^\w+:[ \r\n]/],[PR.PR_PLAIN,/^\w+/]]),["yaml","yml"]);