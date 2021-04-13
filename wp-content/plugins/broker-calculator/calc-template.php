<?php 
	$calc_id = get_query_var( 'calc_id');
	$variants = get_field('variants',$calc_id);
	$сurrency_pairs = get_field('сurrency_pairs',$calc_id);
	$instruments = get_field('instruments',$calc_id);
	$accounts = get_field('accounts',$calc_id);
	$output = array();
	foreach ($instruments as $key => $value) {
		$output[$key+1] = array();
	}
	foreach ($variants as $key => $value){
		$output[$value['instrument']['value']][] = array(
			'label' => $сurrency_pairs[$value['сurrency_pair']['value']-1]['name'],
			'account_id' => $value['account']['value'],
			'value' => $value['value'],
			'desc' => $accounts[$value['account']['value']-1]['desc'],
			'name' => $accounts[$value['account']['value']-1]['name'],
			'reward_period' => $accounts[$value['account']['value']-1]['reward_period']
		);
	}
?>

<div class="rebate__calc calc">
	<div class="calc__title h4"><?php esc_html_e('Расчёт рибейта', 'govpsfx') ?></div>
	<form class="calc__wrap row rebate__form">
		<div class="calc__left">
			<a class="calc__link" href="<?= the_field('banner_link', get_the_ID());?>" target="_blank"><img src="<?= the_field('banner_ad', get_the_ID()); ?>" alt=""></a>
			<div class="calc__controls row">
				<div class="calc__col">
					<div class="calc__item">
						<div class="calc__subtitle"><?php esc_html_e('Чем торгуете', 'govpsfx') ?></div>
						<div class="calc__inner" id="instrument_type">
							<div class="calc__radios">
								<?php foreach ($instruments as $key => $value):?>
								<div class="calc__radio check radio --md --b-white">
									<input type="radio" name="instrument"  value="<?php echo $key+1?>" <?php echo $key == 0 ? 'checked="checked"' : '';?>>
									<div class="radio__wrap">
										<div class="radio__icon"></div>
										<div class="radio__title"><?php echo $value['name']?></div>
									</div>
								</div>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
				<div class="calc__col">
					<div class="calc__item">
						<div class="calc__subtitle"><?php esc_html_e('Инструмент', 'govpsfx') ?></div>
						<div class="calc__inner">
							<div class="calc__select --md --b-yellow --line">
								<select name="сurrency_pair" id="сurrency_pair" placeholder="Выберите тему"></select>
							</div>
						</div>
					</div>
					<div class="calc__item">
						<div class="calc__subtitle"><?php esc_html_e('Количество лот в день', 'govpsfx') ?></div>
						<div class="calc__inner">
							<div class="calc__incdec incdec">
								<div class="incdec__btn btn --plus">+</div><input class="incdec__input" type="tel" name="count_lots" id="count_lots" value="1"><div class="incdec__btn btn --minus">-</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="calc__right">
			<div class="calc__values row">
				<div class="calc__value">
					<div class="calc__value-title"><?php esc_html_e('В день', 'govpsfx') ?></div>
					<div class="calc__value-area">$<output class="amount rebate__block-1-text-2" id="rebate_value_day"></output></div>
				</div>
				<div class="calc__value">
					<div class="calc__value-title"><?php esc_html_e('В неделю', 'govpsfx') ?></div>
					<div class="calc__value-area">$<output class="amount rebate__block-1-text-2" id="rebate_value_week"></output></div>
				</div>
				<div class="calc__value">
					<div class="calc__value-title"><?php esc_html_e('В месяц', 'govpsfx') ?></div>
					<div class="calc__value-area">$<output class="amount rebate__block-1-text-2" id="rebate_value_month"></output></div>
				</div>
				<div class="calc__value">
					<div class="calc__value-title"><?php esc_html_e('В год', 'govpsfx') ?></div>
					<div class="calc__value-area">$<output class="amount rebate__block-1-text-2" id="rebate_value_year"></output></div>
				</div>
			</div>
		</div>
	</form>
	<div class="calc__table t1">
		<table class="article__table rebate__table dataTable no-footer" id="broker-account-table" role="grid">
			<thead>
				<tr class="article__table-nav" role="row">
					<th class="article__table-nav-item sorting_disabled" rowspan="1" colspan="1" aria-label="Типы счетов" style="width: 106px;">
						<div class="flex">
							<div class="article__table-nav-item-text"><?php esc_html_e('Типы счетов', 'govpsfx') ?></div>
						</div>
					</th>
					<th class="article__table-nav-item sorting_disabled" rowspan="1" colspan="1" aria-label="Тип рибейта" style="width: 101px;">
						<div class="flex">
							<div class="article__table-nav-item-text"><?php esc_html_e('Тип рибейта', 'govpsfx') ?></div>
						</div>
					</th>
					<th class="article__table-nav-item sorting_asc" tabindex="0" aria-controls="broker-account-table" rowspan="1" colspan="1" aria-label="       Рибейт (USD): activate to sort column descending" style="width: 119px;" aria-sort="ascending">
						<div class="t-icon t-sorting">
							<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.61883 5.57102H9.86881C9.93656 5.57102 9.99218 5.5493 10.0356 5.50572C10.0792 5.46219 10.101 5.40662 10.101 5.33886V3.94603C10.101 3.87826 10.0792 3.82269 10.0356 3.77917C9.99218 3.73569 9.93656 3.71387 9.86881 3.71387H6.61883C6.55109 3.71387 6.49552 3.73559 6.45197 3.77917C6.40852 3.82269 6.38672 3.87826 6.38672 3.94603V5.33886C6.38672 5.40662 6.40844 5.46219 6.45197 5.50572C6.49552 5.54922 6.55109 5.57102 6.61883 5.57102Z" fill="white"></path>
								<path d="M6.61883 1.85713H8.47591C8.54365 1.85713 8.5993 1.8354 8.64267 1.79188C8.68632 1.74833 8.70779 1.69276 8.70779 1.62502V0.232138C8.70779 0.164473 8.6863 0.108827 8.64267 0.0652761C8.5993 0.0218264 8.54365 0 8.47591 0H6.61883C6.55109 0 6.49552 0.0217248 6.45197 0.0652507C6.40855 0.108827 6.38672 0.164473 6.38672 0.232112V1.62499C6.38672 1.69273 6.40844 1.7483 6.45197 1.79185C6.49555 1.8353 6.55109 1.85713 6.61883 1.85713Z" fill="white"></path>
								<path d="M4.99395 10.2142H3.6011V0.232138C3.6011 0.164473 3.5794 0.108751 3.53585 0.0652761C3.49229 0.0218264 3.43672 0 3.36896 0H1.97608C1.90842 0 1.85269 0.0217248 1.80922 0.0652507C1.76579 0.108827 1.74397 0.164473 1.74397 0.232112V10.2142H0.35109C0.244778 10.2142 0.17221 10.2625 0.133486 10.3593C0.0947371 10.4513 0.111761 10.5358 0.184228 10.6132L2.50563 12.9347C2.55884 12.9781 2.61441 12.9998 2.67249 12.9998C2.73536 12.9998 2.79103 12.9781 2.83936 12.9347L5.15352 10.6205C5.20195 10.5626 5.22609 10.5044 5.22609 10.4466C5.22609 10.3786 5.20426 10.3232 5.16084 10.2793C5.11731 10.236 5.06174 10.2142 4.99395 10.2142Z" fill="white"></path>
								<path d="M12.8214 11.208C12.7778 11.1643 12.7223 11.1426 12.6545 11.1426H6.61883C6.55109 11.1426 6.49552 11.1643 6.45197 11.208C6.40855 11.2514 6.38672 11.3071 6.38672 11.3747V12.7675C6.38672 12.8355 6.40844 12.8909 6.45197 12.9345C6.49555 12.978 6.55109 12.9997 6.61883 12.9997H12.6545C12.7222 12.9997 12.7778 12.978 12.8213 12.9345C12.8648 12.8908 12.8865 12.8355 12.8865 12.7675V11.3747C12.8866 11.3071 12.8648 11.2514 12.8214 11.208Z" fill="white"></path>
								<path d="M6.61883 9.28564H11.2617C11.3294 9.28564 11.385 9.26391 11.4287 9.22044C11.4721 9.17696 11.4938 9.12132 11.4938 9.05368V7.66067C11.4938 7.59303 11.4721 7.53736 11.4287 7.49391C11.385 7.45044 11.3294 7.42871 11.2617 7.42871H6.61883C6.55109 7.42871 6.49552 7.45044 6.45197 7.49391C6.40852 7.53739 6.38672 7.59303 6.38672 7.66067V9.05368C6.38672 9.12132 6.40844 9.17699 6.45197 9.22044C6.49552 9.26391 6.55109 9.28564 6.61883 9.28564Z" fill="white"></path>
							</svg>
							<span><?php esc_html_e('Рибейт (USD)', 'govpsfx') ?></span>
						</div>
					</th>
					<th class="article__table-nav-item sorting" tabindex="0" aria-controls="broker-account-table" rowspan="1" colspan="1" aria-label="Период начислений: activate to sort column ascending" style="width: 162px;">
						<div class="flex">
							<div class="article__table-nav-item-text"><?php esc_html_e('Период начислений', 'govpsfx') ?></div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="broker-account-table-body"></tbody>
		</table>
	</div>
	<div class="calc__actions b-actions">
		<?php $broker_link_group_1 = get_field('broker_link_group_1', $calc_id);?>
		<?php $broker_link_group_2 = get_field('broker_link_group_2', $calc_id);?>
		<div class="b-actions__list row">
			<?php if ($broker_link_group_1): ?>
			<a class="b-actions__item btn --lg --b-yellow --radius" <?= $broker_link_group_1['target_blank'] ? 'target="_blank' : ''?> " href="<?= $broker_link_group_1['url'];?>"><?= $broker_link_group_1['text']; ?> →</a>
			<?php endif ?>
			<?php if ($broker_link_group_2): ?>
			<div class="b-actions__item link --md --white">
				<a <?= $broker_link_group_2['target_blank'] ? 'target="_blank' : ''?> " href="<?= $broker_link_group_2['url']; ?>"><?//= $broker_link_group_2['icon']; ?> <?= $broker_link_group_2['text']; ?> → </a>
			</div>
			<?php endif ?>
		</div>
	</div>
</div>
<script>instruments = <?php echo json_encode($output);?> </script>