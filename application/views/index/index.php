<!--
<div id="page">
    <div id="content">
        <h2>Admin Panel</h2>
        <p>
          This is the administration interface for the traffic control android application.
          In here you can view, discard and verify all the violations users submit using
          the android applicaton.
        </p>
        <p>
          Please authenticate yourself with the below login form before you
          continue.
        </p>

        <h4>Login</h4>
        <form action="<?php echo base_url();?>/index.php/auth/login" method="POST">
            <label>Username: </label>
            <br>
            <input type="text" name="username"/>
            <br>

            <label>Password: </label>
            <br>
            <input type="text" name="password"/>
            <br>
            <br>

            <button type="submit">Login</button>
        </form>
    </div>
</div>
-->
<div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Log in</div>
			<div class="panel-body">
				<form role="form" method="POST" action="<?php echo base_url();?>index.php/auth/login">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="">
						</div>
						<div class="checkbox">
							<label>
								<input name="remember" type="checkbox" value="Remember Me">Remember Me
							</label>
						</div>
                        <button class="btn btn-primary" type="submit" name="button">Login</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->
