
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Calling page methods with jQuery</title>
  <style type="text/css">
    #Result01, #Result02, #Result03, #Result04 { cursor: pointer; }
    #Result05, #Result06, #Result07, #Result08, #Result09, #Result10 { cursor: pointer; }
    #Result11, #Result12, #Result14 { cursor: pointer; }
    #Result15, #Result16, #Result17, #Result18 { cursor: pointer; }
    #Result19, #Result20, #Result21, #Result212 { cursor: pointer; }
    #Result22, #Result23 { cursor: pointer; }
  </style>
  <script type="text/javascript">
      var id = 1;
      var jsonStr = "";
      var jsonMethod = "";
  </script>
</head>
<body>
    <!--<img id="imageid1" src="http://my.llfiles.com/00195219/redrage-11U.jpg" alt="" width="100" height="100"/>
    <img id="imageid2" src="http://my.llfiles.com/00173569/image0092_1.jpg" alt="" width="100" height="100"/>-->
    <table style="width: 100%"><!-- border="0">-->
        <tr>
            <td><h3>Login & Registration</h3></td>
            <td><h3>Settings</h3></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                      <td id="Result01">LoginCheck</td>
                      <td> | </td>
                      <td id="Result02">Registration</td>
                      <td> | </td>
                      <td id="Result03">LoginCheckWithVerificationCode</td>
                      <td> | </td>
                      <td id="Result04">ResendVerificationCode</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                      <td id="Result05">GetUserDetails</td>
                      <td> | </td>
                      <td id="Result06">UpdateEmailNotification</td>
                      <td> | </td>
                      <td id="Result07">UpdatePassword</td>
                      <td> | </td>
                      <td id="Result08">UpdateProfile</td>
                      <td> | </td>
                      <td id="Result09">ForgotPassword</td>
                      <td> | </td>
                      <td id="Result10">GetCountry</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 50%"><h3>List</h3></td>
            <td><h3>Search List</h3></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                      <td id="Result11">NewsList</td>
                      <td> | </td>
                      <td id="Result12">ScheduleList</td>
                      <td> | </td>
                      <td id="Result14">PhotoList</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                      <td id="Result15">GetStates</td>
                      <td> | </td>
                      <td id="Result16">SportsList</td>
                      <td> | </td>
                      <td id="Result17">StatesSportsList</td>
                      <td> | </td>
                      <td id="Result18">SearchList</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><h3>Favourites</h3></td>
            <td><h3>Favourite Teams</h3></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                      <td id="Result19">FavouriteList</td>
                      <td> | </td>
                      <td id="Result20">AddToFavourite</td>
                      <td> | </td>
                      <td id="Result21">DeleteFavourite</td>
                      <td> | </td>
                      <td id="Result212">DeleteFavourites</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                      <td id="Result22">GetAllFavouriteTeamsForSite</td>
                      <td> | </td>
                      <td id="Result23">AddFavouriteTeams</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr/>
    <table style="width: 100%"><!-- border="0">-->
        <tr>
            <td>
                <h3>JSon string passed : </h3>
                <div id="divPassed" style="color:red"></div>
            </td>
        </tr>
        <tr>
            <td>
                <h3>JSon string result : </h3>
                <div id="divResult"></div>
            </td>
        </tr>
    </table>
  <script type="text/javascript" src="<?php echo base_url()?>assets/dashboard/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="Scripts/callajax.js"></script>
  <div title="Login & Registration">
      <!-- Login & Registration -->
      <script type="text/javascript">
          $('#Result04').click(function () {
              $("#divResult").text("loading...");
              var email = window.prompt("Enter your email id");
              jsonStr = "{'email':'" + email + "'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result03').click(function () {
              $("#divResult").text("loading...");
              var email = window.prompt("Enter your email id");
              var verifycode = window.prompt("Enter your verification code");
              jsonStr = "{'email':'" + email + "', 'pwd':'123456', 'verifycode':'" + verifycode + "', 'ip':'192.168.1.139', 'leagueId':'0'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result02').click(function () {
              $("#divResult").text("loading...");
              var email = window.prompt("Enter your email id");
              var pwd = 'Abcdef'; // window.prompt("Enter your password");
              var firstname = 'Samuel'; // window.prompt("Enter your firstname");
              var lastname = "D'souza"; // window.prompt("Enter your lastname");
              var zip = '08835'; // window.prompt("Enter your zip");
              jsonStr
              = '{email:"' + email + '", pwd:"' + pwd + '",'
              + ' firstname:"' + firstname + '", lastname:"' + lastname + '", '
              + ' zip:"' + zip + '", ip:"192.168.1.139"}';
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result01').click(function () {
              $("#divResult").text("loading...");
              var email = window.prompt("Enter your email id");
              var pwd = window.prompt("Enter your password");
              jsonStr = "{'email':'" + email + "', 'pwd':'" + pwd + "', 'ip':'192.168.1.139', 'leagueId':'0'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
  </div>
  <div title="Settings">
      <!-- Settings -->
      <script type="text/javascript">
          $('#Result05').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{id:'525302'}";
              jsonStr = "{id:'534204'}";
             jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result06').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{id:'525302',reminder:'48'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result07').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{id:'525302',pwd:'123456'}";
              //jsonStr = "{id:'525302',pwd:'654321'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result08').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = '{id:"525302",firstname:"deepak",lastname:"d\'cruz",zip:"08550",bdate:"1983-06-16",email:"deepak@newagesmb.com",country:"USA"}';
              //jsonStr = "{id:'525302',firstname:'Jack',lastname:'Daniels',zip:'85645',bdate:'',email:'deepak2@newagesmb.com',country:'India'}";
              jsonStr = '{id:"525302",firstname:"deepak",lastname:"d\'cruz",zip:"08550",email:"deepak@newagesmb.com"}';
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result09').click(function () {
              $("#divResult").text("loading...");
              var email = window.prompt("Enter your email id");
              jsonStr = "{'email':'" + email + "'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result10').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
</div>
  <div title="List">
      <!-- List -->
      <script type="text/javascript">
      </script>
      <script type="text/javascript">
          $('#Result14').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = "{id:'169013', page:'3', leagueids:''}";
              jsonStr = "{id:'534157', page:'1', leagueids:''}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result12').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = "{id:'533294', teamid:'4235039,3799973', page:'2', leagueids:''}";
              //              jsonStr = "{id:'534157', page:'1', leagueids:''}";
              jsonStr = "{id:'263593', page:'1', leagueids:''}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result11').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = "{id:'169013', page:'3', leagueids:''}";
              //jsonStr = "{'id': '534151','leagueids': '843,31','page': '1'}";
              jsonStr = '{"function":"registration_info", "parameters": {}}';
             jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
  </div>
  <div title="Search">
      <!-- Search -->
      <script type="text/javascript">
          $('#Result15').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{}";
             jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
          $('#Result16').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{}";
            jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result17').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{}";
              alert(';;');
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " --=> " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result18').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = "{'searchtext':'Senior','zip':'32701','miles':'25','state':'FL','sportid':'1','page':'1'}";
              //jsonStr = "{'searchtext':'','zip':'08550','miles':'25','state':'','sportid':'1','page':'1','id':'525302'}";
              //jsonStr = "{'searchtext':'','zip':'','miles':'0','state':'FL','sportid':'1','page':'1','id':'525302'}";
              jsonStr = "{'searchtext': '','zip': '','miles': '0','state': 'NJ','sportid': '1','page': '1','id': '534157'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
  </div>
  <div title="Favourite">
      <!-- Favourite -->
      <script type="text/javascript">
          $('#Result19').click(function () {
              $("#divResult").text("loading...");
              //jsonStr = "{id:'525302', page:'1'}";
              jsonStr = "{id:'534160', page:'1'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result20').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{'id':'525302','leagueid':'278674','url':'plainsburgshootingclub'}";
             jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result21').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{'id':'525302','leagueid':'278674'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result212').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{'id':'534157','leagueids':'843,80592'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
  </div>
  <div title="Favourite Teams">
    <!-- Favourite Teams -->
      <script type="text/javascript">
          $('#Result22').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{'id':'525302','leagueid':'94754'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
          $('#Result23').click(function () {
              $("#divResult").text("loading...");
              jsonStr = "{'id':'525302','leagueid':'94754','teamids':'1069909,1069908,1069907,1069906,1069905'}";
              jsonMethod = "<?php echo base_url()?>client";
              $("#divPassed").text(jsonMethod + " => " + jsonStr);
              callWebMethod(jsonMethod, jsonStr, "#divResult");
          });
      </script>
      <script type="text/javascript">
	  function callWebMethod(jsonMethod, jsonStr, divResult) {

			$.ajax({
				type: "POST",
				url: jsonMethod,
				data: jsonStr,
				success: function (msg) {
				 alert(msg)
					$(divResult).text(msg);
				},
				error: function (msg) {
				alert($.parseJSON(msg))
					$(divResult).text(msg);
				}
			});
	}
      </script>
  </div>
</body>
</html>
