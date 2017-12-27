<!DOCTYPE html>
<html>
<head>
	<title>Create a Form Simple</title>
</head>
<style>
	body{box-sizing: border-box;word-wrap: break-word;}
	*{box-sizing: border-box;word-break: break-all;}
	.col-container {width: 50%;float:left;}
	.priview{padding:0px;border:1px dotted black;width:100%;float:left;min-height:200px;}
	.heading{background:teal;color:white;font-size:18px;padding:10px;}
	#priviewhtml,#priviewphp,#priviewcss,#priviewjs{padding:20px;overflow-y:scroll;min-height:200px;width:100%;}
	select,input,button{width:180px;}
	input,option,button{padding:10px;}
</style>
<body>
	<table>
		<tr><td>Enter no of form :</td><td><input type="text" id="nameoffields"></td>
		<td>Enter no of fields : </td><td><input type="number" id="nooffields" min="1"></td>
		<tr><td colspan="2"><button onclick="createform()">Priview form</button></td></tr>
	</table>
	<div class="col-container" id="show1">
	  <div class="priview">
	    <div class="heading">
				HTML Priview Options (For Developer)
		</div>
		<div id="generateforms">
		</div>
	  </div>
	  <div class="priview"  id="show2" style="display:none;">
	    <div class="heading">
				HTML Priview (For viewers)
		</div>
		<div id="generateformsprivew">
		</div>
	  </div>
	</div>
	<div class="col-container" id="show3" style="display:none;">
	  <div class="priview">
	    <div class="heading">
				HTML CODE
		</div>
		<div id="priviewhtml">
		</div>
	  </div>
	  <div class="priview">
	    <div class="heading">
				CSS CODE
		</div>
		<div id="priviewcss">
			<pre>
				select,input,button{width:180px;}
				input,option,button{padding:10px;}
			</pre>
		</div>
	  </div>
	  <div class="priview">
	    <div class="heading">
				PHP CODE (insert.php)
		</div>
		<div id="priviewphp">
			<pre>
			$servername = "localhost";
			$username = "root";
			$password = "hubadmin@ece";
			$tablename=$_POST['tablename'];
			$databasename=$_POST['databasename'];
			$fields="";
			$fieldsvalue="";
			$ip='127.0.0.1';
			try {
			    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $noofcolums=$_POST['field'];
			    for($i=1;$i<=$noofcolums;$i++){
			    	$fieldsvalue.$i=$_POST['field'.$i];
			    	$fields=$fields.$field.$i.',';
			    	$fieldsvalue=$fieldsvalue."'".$fieldsvalue.$i."',";

			    }
			    $fields=$fields.",'ip'";
			    $fieldsvalue=$fieldsvalue.",'".$ip."'";
		    	$sql = "INSERT INTO $tablename ($fields) VALUE($fieldsvalue)";
			    $conn->exec($sql);
			    }
			catch(PDOException $e)
			    {
			    echo "Connection failed: " . $e->getMessage();
			    }
			</pre>
		</div>
	  </div>
	  <div class="priview">
	    <div class="heading">
				JAVASCRIPT CODE
		</div>
		<div id="priviewjs">
			<pre>
				function insertjs(no,tablename,databasename)
				  {
				  	for(var i=1;i<=no;i++)
				    {
				    	var field+i   =   document.forms[tablename]['field'+i].value;
					}
					   var data='field='+no;
				    for(var j=1;j==no;j++)
				    {
				    	data =data+'&field'+j+'='+field+j;
				    }
				    insert_to_php(data,tablename,databasename);
				  } 
				function insert_to_php(data,tablename,databasename)
				  { 
				      var params = data+'&tablename='+tablename+'&databasename='+databasename;
				      var httpc = new XMLHttpRequest(); // simplified for clarity
				      var url = 'insert.php';
				      httpc.open('POST', url, false); // sending as POST
				      httpc.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
				      httpc.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				      httpc.setRequestHeader('Content-Length', params.length); 
				      httpc.onreadystatechange = function() 
				        { 
				          if(httpc.readyState == 4 && httpc.status == 200) 
				            { 
				              alert(httpc.responseText);
				            }
				        }
				  httpc.send(params);
				  }
			</pre>
		</div>
	  </div>
	</div>
</div> 
<script type="text/javascript">

	function createform()
	{
		var no = document.getElementById('nooffields').value;
		var name = document.getElementById('nameoffields').value;
		document.getElementById('generateforms').innerHTML=no;
		var inner ="form Name : '"+name+"',Form fields : '"+no+"' <br><table> ";
		for(var i=1;i<= no; i++)
		{
			inner =inner+"<tr><td>field"+i+"Name:</td><td><input type='text' name='field"+i+"' id='field"+i+"'></td><td>field"+i+"type:</td><td><select name='field"+i+"type' id='field"+i+"type'><option value='text'>Text</option><option value='number'>Number</option><option value='email'>email</option><option value='hidden'>hidden</option></select></td></tr>";
		}
		inner=inner+"</table>";
		document.getElementById('generateforms').innerHTML=inner+"<button onclick='gen()''>generate</button>";
		//gen();
	}
	function gen(){
		var no = document.getElementById('nooffields').value;
		var name = document.getElementById('nameoffields').value;
		var inner2="<form id='"+name+"' name='"+name+"' action='' method='post'><table>";
		for(var k=1;k<= no; k++)
		{
			var fieldname=document.getElementById("field"+k).value;
			fieldname= fieldname.replace(/\s/g,'');
			var fieldnameoriginal=document.getElementById("field"+k).value;
			var fieldtype=document.getElementById("field"+k+"type").value;

			inner2=inner2+"<tr><td>"+fieldnameoriginal+"</td> <td><input type='"+fieldtype+"' name='"+fieldname+"' id='"+fieldname+"'></td></tr>";
		}
		inner2=inner2+"<tr><td colspan='2'><button type='submit' onsubmit='insertjs("+no+","+fieldname+","+fieldname+")'>Submit</button><button type='reset'>Reset</button></td></tr></table></form>";
		//gen();
		document.getElementById('show2').style.display="block";
		document.getElementById('generateformsprivew').innerHTML=inner2;
		document.getElementById('priviewhtml').innerHTML="<code><pre><xmp>"+inner2+"</xmp></pre></code>";
		document.getElementById('show3').style.display="block";
}
</script>
</body>
</html>