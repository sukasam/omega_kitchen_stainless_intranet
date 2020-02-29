// JavaScript Document
var pathLocal = "";
function GetXmlHttpObject(){
   var xmlHttp=null;
   try{
 // Firefox, Opera 8.0+, Safari
   xmlHttp=new XMLHttpRequest();
   }catch (e) {
 //Internet Explorer
      try{
         xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e){
         xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
   }
   return xmlHttp;
}

function checkfirstorder(pval,cusadd,cusprovince,custel,cusfax,contactid,datef,datet,cscont,cstel,sloc_name,sevlast,prolist,sr_ctype2,chk){


   //checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2',chk);
   // alert(pval);
   // alert(cusadd);
   // alert(cusprovince);
   // alert(custel);
   // alert(cusfax);
   // alert(contactid);
   // alert(date_quf);
   // alert(datet);
   // alert(cscont);
   // alert(cstel);
   // alert(sloc_name);
   // alert(sevlast);
   // alert(prolist);
   // alert(sr_ctype2);
   // alert(chk);
   

	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcusfirsh&pid='+pval+'&chk='+chk;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
          document.getElementById(cusadd).innerHTML=ds[1];
			 document.getElementById(cusprovince).innerHTML=ds[2];
			 document.getElementById(custel).innerHTML=ds[3];
			 document.getElementById(cusfax).innerHTML=ds[4];
			 document.getElementById(contactid).innerHTML=ds[5];
			 //document.getElementById(datef).innerHTML=ds[6];
			// document.getElementById(datet).innerHTML=ds[7];
			 document.getElementById(cscont).innerHTML=ds[8];
          document.getElementById(cstel).innerHTML=ds[9];
          document.getElementById(sloc_name).innerHTML=ds[10];
			// document.getElementById(sevlast).innerHTML=ds[11];
			// document.getElementById(prolist).innerHTML=ds[12];
			// document.getElementById(sr_ctype2).innerHTML=ds[13];
			 document.getElementById("search_fo").value=ds[14];
			 document.getElementById("search_po").value=ds[15];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_podsn(pval,param1,param2,param3,fid){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getprodetail&pid='+pval+'&fid='+fid;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
            document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];
			document.getElementById(param3).innerHTML=ds[2];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_cus(pval,chk){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcus&pval='+pval+'&chk='+chk;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_cusorprod(pval,chk){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=get_cusorprod&pval='+pval+'&chk='+chk;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}


function get_sparpart(pval,resdata){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getsparpart&pval='+pval+'&resdata='+resdata;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function showspare(sval,param1,param2,param3,param4,idList,param5){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getspare&sval='+sval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
			//console.log(JSON.stringify(ds));
			if(ds[4] <= 0){
				 alert(ds[1]+' : อะไหล่สินค้าตัวนี้ไม่เพียงพอสำหรับการเบิกอะไหล่');
				 document.getElementById('lists'+idList).value='';
				 document.getElementById(param1).value='';
				 document.getElementById(param2).value='';
				 document.getElementById(param3).value='';
				 document.getElementById(param4).value='';
				 document.getElementById(param5).value='';
				 document.getElementById('opens'+idList).value='';
			}else{
				document.getElementById(param1).value=ds[1];
				document.getElementById(param2).value=ds[2];
				document.getElementById(param3).value=ds[3];
				document.getElementById(param4).value=ds[4];
				document.getElementById(param5).value=ds[5];
			}
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}