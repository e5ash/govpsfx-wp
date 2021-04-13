<div class="datatable1 competition-forex-participants" >
    <div class="find-wrap">
        <input class="find" type="search" data-url="<?= get_permalink() . '?find='?>" placeholder="Поиск" value="<?=empty($account) ? '': $account ?>">
    </div>
<table class="simple-little-table competition-forex-table">
<thead>
    <tr>
        <th>Место</th>
        <th>Ник участника</th>  
        <th>Номер счета</th>
        <th>Баланс</th>
        <th>Средства</th>
        <th>Просадка</th>
        <th>Открытые позиции</th>
        <th>Закрытые позиции</th>
        <th>График</th>
        <th>Дата регистрации</th>
        
    </tr>     
</thead>        
    <?php foreach($participants as $participant) { ?>    
    <tr id="<?='participant' . $participant->account?>" class="account-row">
        <td><?= $participant->num ?></td>
        <td><?= $participant->nick ?></td> 
        <td><?= $participant->account ?></td> 
        <td><?= $participant->balance ?></td>
        <td><?= $participant->equity ?></td>
        <td><?= $participant->drawdoun ?></td>
        <td><?= $participant->op_pos ?></td>
        <td><?= $participant->cl_pos ?></td>
        <td class="graph"></td>
	<td><?= date("Y-m-d H:i", strtotime($participant->date_registration)) ?></td>
    </tr>       
    <?php } ?>   
</table>    
</div>
<?=$pageNavigationMenu?>

