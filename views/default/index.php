<?php

?>

<style type="text/css">
	td{
		padding:10px;
	}
</style>
<div class="partner-admin">
<table cellpadding=10 border=1 class="table table-bordered">
	<tr>
		<td><H2>Наименование(Таблица)</H2></td>
		<td><H2>Ссылка</H2></td>
		<td><H2>Описание</H2></td>
	</tr>
	<tr>
		<td><b>Кошельки</b>(<u>Score</u>)</td>
		<td><nobr><a href=<?=Yii::$app->request->hostInfo.'/balance/score'?>>/balance/score</a></nobr></td>
		<td><b>Администратор. </b>Кошельки пользователей.</td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a href=<?=Yii::$app->request->hostInfo.'/balance/score/create'?>>/balance/score/create</a></nobr></td>
		<td><b>Администратор/Пользователь</b><i>(автоматически при регистрации).</i> Создание Кошелька.</td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a href=<?=Yii::$app->request->hostInfo.'/balance/score/balances'?>>/balance/score/balances</a></nobr></td>
		<td><b>Администратор.</b> Создание Кошельков для пользователей, у которых нет кошельков.</td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a style='color:red'>/balance/score/delete</a></nobr></td>
		<td> <b>Администратор.</b>Удаление Кошелька. <u>Необходимые параметры: id<u></td>
	</tr>
	
	
	
	<tr>
		<td><b>Транзакции</b>(<u>Transaction</u>)</td>
		<td><nobr><a href=<?=Yii::$app->request->hostInfo.'/balance/transaction'?>>transaction/score</a></nobr></td>
		<td><b>Администратор. </b>Транзакции пользователей.</td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a href=<?=Yii::$app->request->hostInfo.'/balance/transaction/create'?>>transaction/score/create</a></nobr></td>
		<td><b>Администратор.</b> Создание Транзакции.</td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a style='color:red'>/balance/transaction/delete</a></nobr></td>
		<td> <b>Администратор.</b>Удаление Транзакции. <u>Необходимые параметры: id<u></td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a  style='color:red'>/balance/transaction/partner-index</a></nobr></td>
		<td> <b>Пользователь.</b>Просмотр Транзакций. <u>Необходимые параметры: id<u></td>
	</tr>
	<tr>
		<td></td>
		<td><nobr><a  style='color:red'>/balance/transaction/transaction-invert</a></nobr></td>
		<td> <b>Администратор/Пользователь.</b>Обращение (отмена) транзакции. <u>Необходимые параметры: id<u></td>
	</tr>
	
	
</table>
</div>