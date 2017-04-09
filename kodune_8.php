<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <title> kodune_8 </title>
      <style>
		  #tekst {
			  <?php if(isset($_POST['backcolor']) && $_POST['backcolor'] != ""){
			  $backcolor = htmlspecialchars($_POST['backcolor']);}

				if (isset($_POST['textcolor']) && $_POST['textcolor'] != ""){
				$textcolor = htmlspecialchars($_POST['textcolor']);}

				if (isset($_POST['borderwidth']) && $_POST['borderwidth'] != ""){
				$borderwidth = htmlspecialchars($_POST['borderwidth']."px");}

				if (isset($_POST['bordertype']) && $_POST['bordertype'] != ""){
				$bordertype = htmlspecialchars($_POST['bordertype']);}

				if (isset($_POST['bordercolor']) && $_POST['bordercolor'] != ""){
				$bordercolor = htmlspecialchars($_POST['bordercolor']);}

				if (isset($_POST['borderradius']) && $_POST['borderradius'] != ""){
				$borderradius = htmlspecialchars($_POST['borderradius']."px");}
			?>;
			background-color: <?php echo $backcolor?>;
			color: <?php echo $textcolor;?>;
			border-width: <?php echo $borderwidth?>;
			border-style: <?php echo $bordertype?>;
			border-color: <?php echo $bordercolor?>;
			border-radius: <?php echo $borderradius?>;
			width: 500px;
			padding: 20px;
			margin: 10px;
		  }
	  </style>
  </head>

  <body>
  <?php $myurl=$_SERVER['PHP_SELF'];?>
  <div id = "tekst">
  <?php
  if (isset($_POST['textinput']) && $_POST['textinput'] != ""){
	echo htmlspecialchars($_POST["textinput"]);
  }?>
  </div>
  <form action="<?php echo $myurl?>" method="post">
  <h1>Your comment: </h1>
  <textarea type="text" name="textinput" placeholder="Enter your text" value=""></textarea><br>

      <h1>Border settings:</h1>
	     <fieldset>
		        <input type="number" name="borderwidth" max="20" min="0" step="0.1" value= "8"/><b> Border radius (0-20px)</b><br>
    		    <select name="bordertype">
                    <option value="none"> none </option>
                    <option value="dotted"> dotted </option>
                    <option value="solid"> solid </option>
                    <option selected value="double"> double </option>
                    <option value="outset"> outset </option>
    		    </select><br>
		        <input type="color" name="bordercolor" value= "#008000"/><b> Border color<br>
		        <input type="number" name="borderradius" max="100" min="0" step="0.1" value= "24"/><b> Border corner width (0-100px)</b><br>
		    </fieldset>
        <h1>Other settings:</h1>
        <fieldset>
          <input type="color" name="backcolor" value= "#fff"/><b> Background color</b><br>
          <input type="color" name="textcolor" value= "#ADD8E6"/><b> Text color</b><br>
        </fieldset>
		<input type="submit" value="submit"/>
</form>

  </body>
</html>
