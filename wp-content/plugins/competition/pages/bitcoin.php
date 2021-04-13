<div class="datatable1 participants" >
<table class="simple-little-table">
<thead>
    <tr>
        <th>Ник участника</th>    
        <th>Прогноз</th>
	<th>Дата прогноза</th>
    </tr>     
</thead>        
    <?php foreach($participants as $participant) { ?>    
    <tr>
        <td><?= $participant->nick ?></td>      
        <td><?= number_format($participant->forecast, 2, '.', '') ?></td>
	<td><?= date("Y-m-d H:i", strtotime($participant->date)) ?></td>
    </tr>       
    <?php } ?>   
</table>    
</div>
<?=$pageNavigationMenu?>



