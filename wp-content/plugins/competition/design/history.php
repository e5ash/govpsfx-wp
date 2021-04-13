<table class="article__table winners__table-2">
    <thead>
        <tr class="article__table-nav">
            <th class="article__table-nav-item">
                <div class="flex">
                    <p class="article__table-nav-item-text">Ник</p>
                </div>
            </th>
            <th class="article__table-nav-item">
                <div class="flex">
                    <p class="article__table-nav-item-text">Прогноз</p>
                </div>
            </th>
            <th class="article__table-nav-item">
                <div class="flex">
                    <p class="article__table-nav-item-text">Дата прогноза:</p>
                </div>
            </th>
        </tr>
    </thead>      
    <?php foreach($participants as $participant) { ?>    
    <tr class="article__table-body-modul">
        <th class="article__table-body-item">
            <p class="article__table-body-item-text"><?= $participant->nick ?></p>
        </th>
        <th class="article__table-body-item">
            <p class="article__table-body-item-text"><?= number_format($participant->forecast, 5, '.', '') ?></p>
        </th> 
        <th class="article__table-body-item">
            <p class="article__table-body-item-text"><?= date("Y-m-d H:i", strtotime($participant->date)) ?></p>
        </th>
    </tr>    
    <?php } ?>
</table>