/**Database scripting, based on html5rocks (http://www.html5rocks.com/en/tutorials/webdatabase/todo/)**/

var html5rocks = {};
html5rocks.webdb = {};
html5rocks.webdb.db = null;

var listCams = new Array();
listCams['Site0Camera10']="The Quays from Liberty Hall";
listCams['Site0Camera100']="N11-Fosters";
listCams['Site0Camera101']="N11-Mont Merrion";
listCams['Site0Camera102']="N11-Kilmacud Rd";
listCams['Site0Camera103']="N11-Trees Road";
listCams['Site0Camera104']="N11-Newtownpark Avenue";
listCams['Site0Camera105']="N11-Kill Lane";
listCams['Site0Camera106']="N11-Clonkeen";
listCams['Site0Camera107']="N11-Johnstown";
listCams['Site0Camera108']="N11-Wyattville";
listCams['Site0Camera109']="M1-Balbriggan";
listCams['Site0Camera110']="M1-Airport";
listCams['Site0Camera111']="M1-Drynam";
listCams['Site0Camera112']="M1-Malahide Estuary";
listCams['Site0Camera113']="M1-Lissenhall";
listCams['Site0Camera122']="North Wall Quay";
listCams['Site0Camera127']="Guild Street-Mayor Street";
listCams['Site0Camera131']="Constitution Hill";
listCams['Site0Camera135']="Dublin Port Tunnel Toll Plaza";
listCams['Site0Camera136']="Samuel Beckett Bridge";
listCams['Site0Camera137']="Sir John Rogersons Quay";
listCams['Site0Camera139']="Guild Street-Seville Place";
listCams['Site0Camera15']="John's Road-SCR";
listCams['Site0Camera163']="John's Road West";
listCams['Site0Camera21']="Dame Street from Civic Offices";
listCams['Site0Camera22']="North Quays from Civic Offices";
listCams['Site0Camera23']="Pearse Street";
listCams['Site0Camera24']="North Strand Road";
listCams['Site0Camera27']="Drumcondra Road";
listCams['Site0Camera31']="Harolds Cross Bridge";
listCams['Site0Camera32']="Cabra Road";
listCams['Site0Camera6']="O'Connell Bridge";
listCams['Site0Camera66']="Longmile Road";
listCams['Site0Camera71']="M50-Blanchardstown Roundabout";
listCams['Site0Camera73']="M50-Ballinteer";
listCams['Site0Camera74']="M50-Edmondstown";
listCams['Site0Camera75']="M50-Firhouse";
listCams['Site0Camera77']="M50-Tallaght";
listCams['Site0Camera78']="M50-Ballymount";
listCams['Site0Camera79']="M50-Red Cow";
listCams['Site0Camera80']="M50-Red Cow Slip";
listCams['Site0Camera81']="M50-Greenhills Park";
listCams['Site0Camera82']="M50-Lucan";
listCams['Site0Camera85']="Naas road-Newlands cross";
listCams['Site0Camera87']="M50-South of Finglas Roundabout";
listCams['Site0Camera91']="N32-Malahide Road";
listCams['Site0Camera94']="M1-M50";
listCams['Site0Camera95']="M1-Port Tunnel Works";
listCams['Site0Camera96']="M50-Ballymun";
listCams['BelgardAirton']="Belgard Airton";
listCams['belgardcook']="Belgard Cookstown";
listCams['belgardmayberry']="Belgard Mayberry";
listCams['BelgardSqE']="Belgard Square East";
listCams['Castleroad']="Castle Road/ORR";
listCams['FonthillRon']="Fonthill/Ronanstown";
listCams['Greenhillsairton']="Greenhills Airton";
listCams['Greenhillsmayberry']="Greenhills Mayberry";
listCams['Greenhillstallaght']="Greenhills Tallaght";
listCams['Greenhillstymon']="Greenhills Tymon";
listCams['Jobstown']="Jobstown";
listCams['Lucanwood']="Lucan Road at Woodvale";
listCams['N7citywest']="N7/City West Junction";
listCams['N7Longmile']="N7 Longmile";
listCams['N4newcastle']="N4 Newcastle";
listCams['Rathcoole']="N7/Rathcoole";
listCams['N81belgard']="N81/Belgard Road";
listCams['N81Citywest']="N81/Citwest";
listCams['N81oldbawn']="N81 Oldbawn";
listCams['N81white']="N81 Whitestown";
listCams['Bawneouge']="Nangor Road/Bawneouge Jtn";
listCams['Deansrath']="Nangor Road/Deansrath Jtn";
listCams['killen']="Nangor Road/Killeen";
listCams['Parkwest']="Nangor/Park West Junction";
listCams['m50redcow']="M50–Red Cow";
listCams['ORRFetter']="ORR Fettercairn";
listCams['ORRFox']="ORR at Foxhunter";
listCams['ORRGrange']="ORR Grange Castle";
listCams['ORRnangor']="ORR Nangor";

html5rocks.webdb.open = function() {
  var dbSize = 1024 * 1024; // 1MB
  html5rocks.webdb.db = openDatabase("PREFCAM", "1.0", "list of cams", dbSize);
}

html5rocks.webdb.createTable = function() {
  var db = html5rocks.webdb.db;
  db.transaction(function(tx) {
    tx.executeSql("CREATE TABLE IF NOT EXISTS Cams(id INTEGER PRIMARY KEY, filename TEXT, position INTEGER, added_on DATETIME)", []);
  });
}

html5rocks.webdb.addFilename = function(filename, position) {
  var db = html5rocks.webdb.db;
  db.transaction(function(tx){
    var addedOn = new Date();
    tx.executeSql("INSERT INTO Cams(filename, position, added_on) VALUES (?,?,?)", 
        [filename, position, addedOn],
        html5rocks.webdb.onSuccess,
        html5rocks.webdb.onError);
   });
}

html5rocks.webdb.onError = function(tx, e) {
  alert("There has been an error: " + e.message);
}

html5rocks.webdb.onSuccess = function(tx, r) {
  // re-render the data.
  html5rocks.webdb.getAllfilenames(loadItems);
}

html5rocks.webdb.getAllfilenames = function(renderFunc) {
  var db = html5rocks.webdb.db;
  db.transaction(function(tx) {
    tx.executeSql("SELECT * FROM Cams ORDER BY position ", [], renderFunc, 
        html5rocks.webdb.onError);
  });
}

html5rocks.webdb.deletefilename = function(id) {
  var db = html5rocks.webdb.db;
  db.transaction(function(tx){
    tx.executeSql("DELETE FROM Cams WHERE id=?", [id],      
        html5rocks.webdb.onSuccess, 
        html5rocks.webdb.onError);
    });
}

function loadItems(tx, rs) {
  var rowOutput = "";
  var todoItems = document.getElementById("allfilenames");
  for (var i=0; i < rs.rows.length; i++) {
    rowOutput += renderTodo(rs.rows.item(i));
  } 
  todoItems.innerHTML = rowOutput;
}

function renderTodo(row) {
	var Loc = getName(row.filename);
	return "<li>" + row.filename + " - " + Loc  +" [<a href='javascript:void(0);'  onclick='html5rocks.webdb.deletefilename(" + row.id +");'>Delete</a>]</li>";
}

function displayItems(tx, rs) {
  var imagesOutput = "";
  var todoItems = document.getElementById("allimages");
  for (var i=0; i < rs.rows.length; i++) {
    imagesOutput += renderImage(rs.rows.item(i));
  } 
  todoItems.innerHTML = imagesOutput;
}

function renderImage(row){
	var Loc = getName(row.filename);	
	var url = 'src="http://trafficcam-fetcher.savina.net/serve_single_pic/';
	return '<img alt="'+ Loc + '!" id="imgCamera0" class="webcam0" ' + url + row.filename + '/0"><img alt="'+ Loc + '!" id="imgCamera1" class="webcam1" ' + url + row.filename + '/1"><img alt="'+ Loc + '!" id="imgCamera2" class="webcam2" ' + url + row.filename + '/2"><img alt="'+ Loc + '!" id="imgCamera3" class="webcam3" ' + url + row.filename + '/3"><img alt="'+ Loc + '!" id="imgCamera4" class="webcam4" ' + url + row.filename + '/4">';
}

function initCamera() {
  html5rocks.webdb.open();
  html5rocks.webdb.createTable();
  html5rocks.webdb.getAllfilenames(loadItems);
}

function initIndex() {
  html5rocks.webdb.open();
  html5rocks.webdb.createTable();
  html5rocks.webdb.getAllfilenames(displayItems);
}

function addFilename() {
  var filename = document.getElementById("filename");
  var postion = document.getElementById("position");
  html5rocks.webdb.addFilename(filename.value, postion.value);
  todo.value = "";
}  

function getName(filename) {
	var Location = listCams[filename];
	return Location;
}