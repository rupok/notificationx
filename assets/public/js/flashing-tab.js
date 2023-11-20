(()=>{"use strict";function e(e){if(!window.crypto&&window.crypto.randomUUID)return crypto.randomUUID();for(var t=Date.now()+Math.random();e&&e[t];)t=Date.now()+Math.random();return t}var t,n,i,o;const a=(n=function(e){var t,n="("+function(){for(var e=["ms","moz","webkit","o"],t=0;t<e.length&&!self.requestAnimationFrame;++t)self.requestAnimationFrame=self[e[t]+"RequestAnimationFrame"],self.cancelAnimationFrame=self[e[t]+"CancelAnimationFrame"]||self[e[t]+"CancelRequestAnimationFrame"];var n={},i={};self.addEventListener("message",(function(e){var t=e.data,o=t.id;if("RPC"===t.type&&null!==o)if("setInterval"==t.method){var a=t.params[0];n[a]=self.setInterval((function(){self.postMessage({type:"interval",id:a})}),t.params[1]),self.postMessage({type:"RPC",id:o,result:a})}else if("clearInterval"==t.method)self.clearInterval(n[t.params[0]]),delete n[t.params[0]];else if("setTimeout"==t.method){var r=t.params[0];i[r]=self.setTimeout((function(){self.postMessage({type:"timeout",id:r}),delete i[r]}),t.params[1]),self.postMessage({type:"RPC",id:o,result:r})}else"clearTimeout"==t.method&&(self.clearTimeout(i[t.params[0]]),delete i[t.params[0]])}))}.toString()+")()",i=window.URL||window.webkitURL;try{t=new Blob([n],{type:"application/javascript"})}catch(e){window.BlobBuilder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder,(t=new BlobBuilder).append(n),t=t.getBlob()}return new Worker(i.createObjectURL(t))}(),i={},t=0,o=function(e,i){var o=++t;return new Promise((function(t){n.addEventListener("message",(function e(i){var a=i.data;a&&"RPC"===a.type&&a.id===o&&(t(a.result),n.removeEventListener("message",e))})),n.postMessage({type:"RPC",method:e,id:o,params:i})}))},n.addEventListener("message",(function(e){var t=e.data;t&&("interval"===t.type||"timeout"===t.type)&&i[t.id]&&i[t.id]()})),{set:function(t,n){var a=e(i);return i[a]=t,o("setInterval",[a,n]),a},clear:function(e){return delete i[e],o("clearInterval",[e])},setTimeout:function(t,n){var a=e(i);return i[a]=t,o("setTimeout",[a,n]),a},clearTimeout:function(e){return delete i[e],o("clearTimeout",[e])}});var r,l,s,c,u=[],d=["icon","mask-icon","apple-touch-icon"];function m(){for(var e=document.querySelectorAll('link[rel*="icon"]'),t=0;t<e.length;t++)e[t].remove()}const f={init:function e(t){if("complete"===document.readyState){c=Object.assign({size:16},t);for(var n=document.querySelectorAll('link[rel*="icon"]'),i=0;i<n.length;i++){var o=n[i].cloneNode(!0);u.push(o)}l||(l=document.createElement("canvas")),l.width=l.height=c.size,(r=l.getContext("2d")).lineCap="round",s=!0}else setTimeout(e.bind(this,t),100)},animatePng:function(e){return new Promise((function(t,n){if(s)if(m(),e){r.clearRect(0,0,c.size,c.size);var i=new Image;i.onload=function(){r.drawImage(i,0,0,c.size,c.size);var e=r.canvas.toDataURL();d.forEach((function(t){var n=document.createElement("link");n.setAttribute("rel",t),n.setAttribute("color","#000000"),n.setAttribute("href",e),document.head.appendChild(n)})),t(e)},i.onerror=function(){n(new Error("Image loading failed"))},i.src=e}else n(new Error("No png provided"));else n(new Error("Function not initialized"))}))},restore:function(){if(d.forEach((function(e){var t=document.querySelector('link[rel="'.concat(e,'"]'));t&&t.parentNode&&t.parentNode.removeChild(t)})),u.length)for(var e=0;e<u.length;e++)document.head.appendChild(u[e])},removeIcon:m,interval:a,version:"0.4.4"};var v,_,h,p,w,g,b,y,I,T,C=window.nx_flashing_tab||{},B=1e3*(parseInt(C.ft_delay_before)||0),E=1e3*(parseInt(C.ft_delay_between)||1),R=1e3*(parseFloat(C.ft_display_for)||0)*60,k={message:"",icon:""},A={message:"",icon:""},z=C.nx_id,P=C.__rest_api_url;switch(C.themes){case"flashing_tab_theme-1":case"flashing_tab_theme-2":k.icon=null===(v=C.ft_theme_one_icons)||void 0===v?void 0:v["icon-one"],A.icon=null===(_=C.ft_theme_one_icons)||void 0===_?void 0:_["icon-two"],k.message=C.ft_theme_one_message;break;case"flashing_tab_theme-3":k=null!==(h=C.ft_theme_three_line_one)&&void 0!==h?h:k,A=null!==(p=C.ft_theme_three_line_two)&&void 0!==p?p:A;break;case"flashing_tab_theme-4":k=null!==(w=C.ft_theme_three_line_one)&&void 0!==w?w:k,A=(null===(g=C.ft_theme_four_line_two)||void 0===g?void 0:g["is-show-empty"])?null!==(T=null===(I=C.ft_theme_four_line_two)||void 0===I?void 0:I.alternative)&&void 0!==T?T:A:null!==(y=null===(b=C.ft_theme_four_line_two)||void 0===b?void 0:b.default)&&void 0!==y?y:A}f.init({size:32});var L=0,F=null,M=null,S=null,U=window.document.title,q=function(e){e&&e!==document.title&&(document.title=e)},j=function(e){return f.animatePng(e)},D=C.ft_enable_original_icon_title||!1,N=function(){var e=D?3:2;0===L?j(k.icon).finally((function(){q(k.message)})):1===L?j(A.icon).finally((function(){q(A.message)})):2===L&&(f.restore(),q(U)),L=(L+1)%e},x=function(e){document.title=U,e?f.removeIcon():f.restore(),F&&(a.clear(F),F=null),M&&(a.clearTimeout(M),M=null),S&&(a.clearTimeout(S),S=null)};function O(e,t){var n={nx_id:e,type:t};fetch(P,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(n)}).then((function(e){return e.json()})).then((function(e){})).catch((function(e){}))}window.addEventListener("visibilitychange",(function(e){"visible"!==document.visibilityState?(x(!0),M=a.setTimeout((function(){N(),F=a.set(N,E),M=null,O(z,"views")}),B),R&&(S=a.setTimeout((function(){x()}),R))):(null==M&&O(z,"clicks"),x())}))})();