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

var un = getViewer();

document.getElementById("user").innerHTML = un;