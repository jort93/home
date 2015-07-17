var vmethod = "";
function getViewer()
{
 var username = _getcbviewer();
 vmethod = "_getcbviewer";
 if (username == null)
 {
  username = _getcookie("id.chatango.com");

  if (username == "None") {
   username = null;
  }
  vmethod = "_getcookie";
 }
 if (username != null && username.indexOf("@") != -1)
 {
  username = null;
 }
 return username;
}


function _getcbviewer()
{
 var userRegex = new RegExp("javascript:startChat\\('.*?','(.*?)'", "i");
 var el = document.getElementById("chatbutton_div")
 if (el == null) {
  return null;
 } else {
  html = el.innerHTML;
 }
 var username = userRegex.exec(html);
 if (username != null)
 {
  username = username[1];
 }
 return username;
}

function _getcookie(c_name)
{
 var i,x,y,ARRcookies=document.cookie.split(";");
 for (i=0;i<ARRcookies.length;i++)
 {
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
  {
   return unescape(y);
  }
 }
}

 if (un == null || un == undefined)
 {
  un = "_anon";
 }
 
 var un = getViewer()

document.getElementById("user").innerHTML = "yo " + un +  " just click on the buttons";
