<div id="Header">
	<div id="Header_Title_Container"><p id="Header_Title">Welcome to SPF</p></div>
	<div id="Header_Account">
		<?php
		if($GLOBALS['AuthStatus']){
			echo '<p id="Header_Account_Name">Simon Wetting Logged in</p>
			<button id="Header_Account_Button"type="submit">Logout</button>';
		}
		else{
			echo '<button id="Header_Account_Button"type="submit">Login</button>';
		}
		?>
	</div>
</div>