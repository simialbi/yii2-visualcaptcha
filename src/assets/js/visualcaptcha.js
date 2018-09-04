/*! visualCaptcha - v0.0.8 - 2016-01-23
* http://visualcaptcha.net
* Copyright (c) 2016 emotionLoop; Licensed MIT */

/**
 * @license almond 0.2.9 Copyright (c) 2011-2014, The Dojo Foundation All Rights Reserved.
 * Available via the MIT or new BSD license.
 * see: http://github.com/jrburke/almond for details
 */

(function(e,t){typeof define=="function"&&define.amd?define([],t):e.visualCaptcha=t()})(this,function(){var e,t,n;return function(r){function v(e,t){return h.call(e,t)}function m(e,t){var n,r,i,s,o,u,a,f,c,h,p,v=t&&t.split("/"),m=l.map,g=m&&m["*"]||{};if(e&&e.charAt(0)===".")if(t){v=v.slice(0,v.length-1),e=e.split("/"),o=e.length-1,l.nodeIdCompat&&d.test(e[o])&&(e[o]=e[o].replace(d,"")),e=v.concat(e);for(c=0;c<e.length;c+=1){p=e[c];if(p===".")e.splice(c,1),c-=1;else if(p===".."){if(c===1&&(e[2]===".."||e[0]===".."))break;c>0&&(e.splice(c-1,2),c-=2)}}e=e.join("/")}else e.indexOf("./")===0&&(e=e.substring(2));if((v||g)&&m){n=e.split("/");for(c=n.length;c>0;c-=1){r=n.slice(0,c).join("/");if(v)for(h=v.length;h>0;h-=1){i=m[v.slice(0,h).join("/")];if(i){i=i[r];if(i){s=i,u=c;break}}}if(s)break;!a&&g&&g[r]&&(a=g[r],f=c)}!s&&a&&(s=a,u=f),s&&(n.splice(0,u,s),e=n.join("/"))}return e}function g(e,t){return function(){return s.apply(r,p.call(arguments,0).concat([e,t]))}}function y(e){return function(t){return m(t,e)}}function b(e){return function(t){a[e]=t}}function w(e){if(v(f,e)){var t=f[e];delete f[e],c[e]=!0,i.apply(r,t)}if(!v(a,e)&&!v(c,e))throw new Error("No "+e);return a[e]}function E(e){var t,n=e?e.indexOf("!"):-1;return n>-1&&(t=e.substring(0,n),e=e.substring(n+1,e.length)),[t,e]}function S(e){return function(){return l&&l.config&&l.config[e]||{}}}var i,s,o,u,a={},f={},l={},c={},h=Object.prototype.hasOwnProperty,p=[].slice,d=/\.js$/;o=function(e,t){var n,r=E(e),i=r[0];return e=r[1],i&&(i=m(i,t),n=w(i)),i?n&&n.normalize?e=n.normalize(e,y(t)):e=m(e,t):(e=m(e,t),r=E(e),i=r[0],e=r[1],i&&(n=w(i))),{f:i?i+"!"+e:e,n:e,pr:i,p:n}},u={require:function(e){return g(e)},exports:function(e){var t=a[e];return typeof t!="undefined"?t:a[e]={}},module:function(e){return{id:e,uri:"",exports:a[e],config:S(e)}}},i=function(e,t,n,i){var s,l,h,p,d,m=[],y=typeof n,E;i=i||e;if(y==="undefined"||y==="function"){t=!t.length&&n.length?["require","exports","module"]:t;for(d=0;d<t.length;d+=1){p=o(t[d],i),l=p.f;if(l==="require")m[d]=u.require(e);else if(l==="exports")m[d]=u.exports(e),E=!0;else if(l==="module")s=m[d]=u.module(e);else if(v(a,l)||v(f,l)||v(c,l))m[d]=w(l);else{if(!p.p)throw new Error(e+" missing "+l);p.p.load(p.n,g(i,!0),b(l),{}),m[d]=a[l]}}h=n?n.apply(a[e],m):undefined;if(e)if(s&&s.exports!==r&&s.exports!==a[e])a[e]=s.exports;else if(h!==r||!E)a[e]=h}else e&&(a[e]=n)},e=t=s=function(e,t,n,a,f){if(typeof e=="string")return u[e]?u[e](t):w(o(e,t).f);if(!e.splice){l=e,l.deps&&s(l.deps,l.callback);if(!t)return;t.splice?(e=t,t=n,n=null):e=r}return t=t||function(){},typeof n=="function"&&(n=a,a=f),a?i(r,e,t,n):setTimeout(function(){i(r,e,t,n)},4),s},s.config=function(e){return s(e)},e._defined=a,n=function(e,t,n){t.splice||(n=t,t=[]),!v(a,e)&&!v(f,e)&&(f[e]=[e,t,n])},n.amd={jQuery:!0}}(),n("almond",function(){}),n("visualcaptcha/core",[],function(){"use strict";var e,t,n,r,i,s,o,u;return e=function(e,t,n){return n=n||[],e.namespace&&e.namespace.length>0&&n.push(e.namespaceFieldName+"="+e.namespace),n.push(e.randomParam+"="+e.randomNonce),t+"?"+n.join("&")},t=function(e){var t=this,r;e.applyRandomNonce(),e.isLoading=!0,r=n(e),e._loading(t),e.callbacks.loading&&e.callbacks.loading(t),e.request(r,function(n){n.audioFieldName&&(e.audioFieldName=n.audioFieldName),n.imageFieldName&&(e.imageFieldName=n.imageFieldName),n.imageName&&(e.imageName=n.imageName),n.values&&(e.imageValues=n.values),e.isLoading=!1,e.hasLoaded=!0,e._loaded(t),e.callbacks.loaded&&e.callbacks.loaded(t)})},n=function(t){var n=t.url+t.routes.start+"/"+t.numberOfImages;return e(t,n)},r=function(t,n){var r="",i=[];return n<0||n>=t.numberOfImages?r:(this.isRetina()&&i.push("retina=1"),r=t.url+t.routes.image+"/"+n,e(t,r,i))},i=function(t,n){var r=t.url+t.routes.audio;return n&&(r+="/ogg"),e(t,r)},s=function(e,t){return t>=0&&t<e.numberOfImages?e.imageValues[t]:""},o=function(){return window.devicePixelRatio!==undefined&&window.devicePixelRatio>1},u=function(){var e,t=!1;try{e=document.createElement("audio"),e.canPlayType&&(t=!0)}catch(n){}return t},function(e){var n,a,f,l,c,h,p,d,v,m,g,y,b;return a=function(){return t.call(this,e)},f=function(){return e.isLoading},l=function(){return e.hasLoaded},c=function(){return e.imageValues.length},h=function(){return e.imageName},p=function(t){return s.call(this,e,t)},d=function(t){return r.call(this,e,t)},v=function(t){return i.call(this,e,t)},m=function(){return e.imageFieldName},g=function(){return e.audioFieldName},y=function(){return e.namespace},b=function(){return e.namespaceFieldName},n={refresh:a,isLoading:f,hasLoaded:l,numberOfImages:c,imageName:h,imageValue:p,imageUrl:d,audioUrl:v,imageFieldName:m,audioFieldName:g,namespace:y,namespaceFieldName:b,isRetina:o,supportsAudio:u},e.autoRefresh&&n.refresh(),n}}),n("visualcaptcha/xhr-request",[],function(){"use strict";var e=window.XMLHttpRequest;return function(t,n){var r=new e;r.open("GET",t,!0),r.onreadystatechange=function(){var e;if(r.readyState!==4||r.status!==200)return;e=JSON.parse(r.responseText),n(e)},r.send()}}),n("visualcaptcha/config",["visualcaptcha/xhr-request"],function(e){"use strict";return function(t){var n=window.location.href.split("/");n[n.length-1]="";var r={request:e,url:n.join("/").slice(0,-1),namespace:"",namespaceFieldName:"namespace",routes:{start:"/start",image:"/image",audio:"/audio"},isLoading:!1,hasLoaded:!1,autoRefresh:!0,numberOfImages:6,randomNonce:"",randomParam:"r",audioFieldName:"",imageFieldName:"",imageName:"",imageValues:[],callbacks:{},_loading:function(){},_loaded:function(){}};return r.applyRandomNonce=function(){return r.randomNonce=Math.random().toString(36).substring(2)},t.request&&(r.request=t.request),t.url&&(r.url=t.url),t.namespace&&(r.namespace=t.namespace),t.namespaceFieldName&&(r.namespaceFieldName=t.namespaceFieldName),typeof t.autoRefresh!="undefined"&&(r.autoRefresh=t.autoRefresh),t.numberOfImages&&(r.numberOfImages=t.numberOfImages),t.routes&&(t.routes.start&&(r.routes.start=t.routes.start),t.routes.image&&(r.routes.image=t.routes.image),t.routes.audio&&(r.routes.audio=t.routes.audio)),t.randomParam&&(r.randomParam=t.randomParam),t.callbacks&&(t.callbacks.loading&&(r.callbacks.loading=t.callbacks.loading),t.callbacks.loaded&&(r.callbacks.loaded=t.callbacks.loaded)),t._loading&&(r._loading=t._loading),t._loaded&&(r._loaded=t._loaded),r}}),n("visualcaptcha",["require","visualcaptcha/core","visualcaptcha/config"],function(e){"use strict";var t=e("visualcaptcha/core"),n=e("visualcaptcha/config");return function(e){return e=e||{},t(n(e))}}),t("visualcaptcha")});