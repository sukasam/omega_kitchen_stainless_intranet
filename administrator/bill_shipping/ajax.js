// JavaScript Document
var pathLocal = "";
function GetXmlHttpObject() {
  var xmlHttp = null;
  try {
    // Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  } catch (e) {
    //Internet Explorer
    try {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return xmlHttp;
}

function checkfirstorder(pval) {
  var xmlHttp;
  xmlHttp = GetXmlHttpObject(); //Check Support Brownser
  URL = pathLocal + "ajax_return.php?action=getcusfirsh&pid=" + pval;
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var ds = xmlHttp.responseText.split("|");

      document.getElementById("cusadd").value = ds[1];
      document.getElementById("cusprovince").innerHTML = ds[2];
      document.getElementById("custel").value = ds[3];
      document.getElementById("cusfax").value = ds[4];
      document.getElementById("cscont").value = ds[5];
      document.getElementById("cstel").value = ds[6];
      document.getElementById("sloc_name").value = ds[7];
      document.getElementById("sloc_add").value = ds[8];
      document.getElementById("loc_tel").value = ds[9];
      document.getElementById("loc_fax").value = ds[10];
      document.getElementById("loc_cname").value = ds[11];
      document.getElementById("loc_ctel").value = ds[12];
      document.getElementById("sr_ctype2").innerHTML = ds[13];
      document.getElementById("sr_ctype").innerHTML = ds[14];
      document.getElementById("srid").value = ds[15];
      document.getElementById("exp").innerHTML = ds[16];
    } else {
      //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
    }
  };
  xmlHttp.open("GET", URL, true);
  xmlHttp.send(null);
}

function get_podsn(pval, param1, param2, param3, fid) {
  var xmlHttp;
  xmlHttp = GetXmlHttpObject(); //Check Support Brownser
  URL =
    pathLocal +
    "ajax_return.php?action=getprodetail&pid=" +
    pval +
    "&fid=" +
    fid;
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var ds = xmlHttp.responseText.split("|");
      document.getElementById(param1).innerHTML = ds[0];
      document.getElementById(param2).innerHTML = ds[1];
      document.getElementById(param3).innerHTML = ds[2];
    } else {
      //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
    }
  };
  xmlHttp.open("GET", URL, true);
  xmlHttp.send(null);
}

function get_cus(pval) {
  /*alert(pval);*/
  var xmlHttp;
  xmlHttp = GetXmlHttpObject(); //Check Support Brownser
  URL = pathLocal + "ajax_return.php?action=getcus&pval=" + pval;
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      document.getElementById("rscus").innerHTML = xmlHttp.responseText;
    } else {
      //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
    }
  };
  xmlHttp.open("GET", URL, true);
  xmlHttp.send(null);
}

function get_sparpart(pval, resdata) {
  /*alert(pval);*/
  var xmlHttp;
  xmlHttp = GetXmlHttpObject(); //Check Support Brownser
  URL =
    pathLocal +
    "ajax_return.php?action=getsparpart&pval=" +
    pval +
    "&resdata=" +
    resdata;
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      document.getElementById("rscus").innerHTML = xmlHttp.responseText;
    } else {
      //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
    }
  };
  xmlHttp.open("GET", URL, true);
  xmlHttp.send(null);
}

function showspare(sval, idList) {
  var xmlHttp;
  xmlHttp = GetXmlHttpObject(); //Check Support Brownser
  URL = pathLocal + "ajax_return.php?action=getspare&sval=" + sval;
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var ds = xmlHttp.responseText.split("|");

      if (ds[2] <= 0) {
        if (ds[1] != "") {
          alert(ds[1] + " : สินค้าตัวนี้ไม่เพียงพอสำหรับการเบิก");
        }

        document.getElementById("codes" + idList).value = "";
        document.getElementById("locations" + idList).value = "";
        document.getElementById("sns" + idList).value = "";
        document.getElementById("amounts" + idList).value = "";
        document.getElementById("opens" + idList).value = "";
        document.getElementById("ships" + idList).value = "";
      } else {
        document.getElementById("codes" + idList).value = ds[1];
        document.getElementById("amounts" + idList).value = ds[2];
        document.getElementById("locations" + idList).value = ds[3];
        document.getElementById("sns" + idList).value = "";
        document.getElementById("opens" + idList).value = "";
        document.getElementById("ships" + idList).value = "";
      }
    } else {
      //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
    }
  };
  xmlHttp.open("GET", URL, true);
  xmlHttp.send(null);
}
