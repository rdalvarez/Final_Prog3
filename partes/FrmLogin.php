<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="login">
				<form onsubmit="Ingreso();return false;">
					<legend> 						
						<h1> 
							<strong>LOGIN </strong>
							<input type="button" name="button" value="administrador" class="btn btn-primary btn-xs animated fadeInDown" onclick="administrador()">
							<input type="button" name="button" value="comprador" class="btn btn-info btn-xs animated fadeInDown" onclick="comprador()">
							<input type="button" name="button" value="vendedor" class="btn btn-default btn-xs animated fadeInDown" onclick="vendedor()">
						</h1>
					</legend>

					<script type="text/javascript">
						function comprador(){
							$("#usuario").val("comp@comp.com");
							$("#contraseña").val("123");
						}
						function administrador(){
							$("#usuario").val("admin@admin.com");
							$("#contraseña").val("321");
						}
						function vendedor(){
							$("#usuario").val("vend@vend.com");
							$("#contraseña").val("321");
						}
					</script>

					<div class="form-group ">
						<label for="usuario">Ingrese su E-mail</label>
						<input type="email" name="usuario" value="" id="usuario" placeholder="E-mail" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="contraseña">Ingrese su Contraseña</label>
						<input type="password" name="contraseña" value="" id="contraseña" placeholder="Contraseña" class="form-control" maxlength="4" required>
					</div>
					<div class="form-group text-center">
						<input type="submit" name="submit" id="submit" class="btn btn-success btn-lg" value="Ingresar">
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>