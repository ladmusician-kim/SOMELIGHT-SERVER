<html>
<head>
<title>A BASIC HTML FORM</title>

<script src="lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	function test () {
		alert($("#message").val()); 
		var message = $("#message").val();
		$.post('http://54.64.157.215/SomeLight/controller.php?message=' + message, { }, 
				function (data) {
					alert('success'); 
		});
	}
</script>

</head>
<body>
	<INPUT TYPE="TEXT" id="message" VALUE="test"> 
	<INPUT TYPE="Submit" Name="Submit1" onClick="test()" VALUE="test">
</body>
</html>

<?php
?>