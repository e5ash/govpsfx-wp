<div class="datatable1 participants" >
<table class="simple-little-table">
<thead>
    <tr>
        <th>ник</th>
        <th>прогноз</th>
	<th>дата</th>
    </tr>     
</thead>        
    <?php foreach($participants as $participant) { ?>    
    <tr>
        <td><?= $participant->nick ?></td>
        <td><?= number_format($participant->forecast, 3, '.', '') ?></td> 
	<td><?=   date("Y-m-d H:i", strtotime($participant->date))?></td>
    </tr>       
    <?php } ?>   
</table>    
</div>


