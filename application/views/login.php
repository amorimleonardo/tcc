<form action="" name="formLogin" method="post" class="formLogin">
	<input type="text" name="email" placeholder="Usuario">
	<input type="password" name="password" placeholder="Senha">

	<button class="botoes">Entrar <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></button>
	<a href="<?=base_url()?>index.php/registrar_usuario" class="no_account">Não tem uma conta?</a>
</form>