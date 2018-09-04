<h1>Nova compra</h1>
<br><br>
<form name="new_sale" action="" method="post">
	<select name="id_produto">
		<? foreach ($list_produtos as $value) { ?>
			<option value="<?=$value['id']?>"><?=ucfirst($value['nome'])?></option>
		<? } ?>
	</select>
	<input type="text" name="data_compra" class="date" placeholder="Data da compra">

	<button class="botoes">Enviar</button>
</form>