<h1>Histórico</h1>
<br><br>
<?
if(isset($list)){
	foreach ($list as $key => $value) {
		echo $value->nome.' - '.$value->preco_custo.'<br>';
	}
} ?>