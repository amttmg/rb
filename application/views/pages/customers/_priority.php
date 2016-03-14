
<?php $count=1; foreach ($priorities as $i=>$priority): ?>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	    <div class="form-group">
	        <h4><?php echo($count) ?>)<?php echo($priority['priority']) ?></h4>
	        <ul class="list-unstyled" id="options">
	            <?php foreach ($priority['option'] as $option): ?>
	            	<li><?php echo($option) ?></li>
	            <?php endforeach ?>
                <li><a href="#"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	        </ul>
	    </div>
	</div>	
	<?php $count++; ?>
<?php endforeach ?>
								