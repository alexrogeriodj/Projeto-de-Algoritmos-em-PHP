var ajax;var dadosUsuario;function requisicaoHTTP(tipo,url,assinc){if(window.XMLHttpRequest){ajax=new XMLHttpRequest();}else if(window.ActiveXObject){ajax=new ActiveXObject("\u004ds\170m\u006c2.XM\114HT\124P");if(!ajax){ajax=new ActiveXObject("Mi\143\162\u006f\u0073\157\u0066\u0074.XM\u004cH\124T\u0050");}}if(ajax)iniciaRequisicao(tipo,url,assinc);else alert("Seu\u0020\156\141ve\u0067\u0061dor n�o\u0020\u0070ossui\u0020\163up\157rte \u0061 \u0065ss\141\u0020apl\u0069ca\u00e7�o\041");}function iniciaRequisicao(tipo,url,bool){ajax.onreadystatechange=trataResposta;ajax.open(tipo,url,bool);ajax.setRequestHeader("\103\u006f\156t\u0065n\u0074\055\124\u0079pe","ap\u0070\u006ci\u0063at\u0069\u006f\156\u002f\u0078\u002dw\167\u0077\u002d\146\157\u0072m-u\u0072le\u006e\u0063\u006f\u0064e\u0064;\040cha\u0072se\u0074\075UTF\u002d8");ajax.send(dadosUsuario);}function enviaDados(url){criaQueryString();requisicaoHTTP("\120OST",url,true);}function criaQueryString(){dadosUsuario="";var frm=document.forms[0];var numElementos=frm.elements.length;for(var i=0;i<numElementos;i++){if(i<numElementos-1){dadosUsuario+=frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";}else{dadosUsuario+=frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);}}}function trataResposta(){if(ajax.readyState==4){if(ajax.status==200){trataDados();}else{alert("\120r\u006f\u0062\u006c\u0065\u006da\u0020n\u0061 \u0063omuni\143a\u00e7\u00e3\u006f co\u006d \u006f\u0020o\u0062jet\u006f\u0020\u0058M\u004c\u0048\u0074tpR\u0065qu\145\163\u0074.");}}}