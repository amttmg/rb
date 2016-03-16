<!-- modal for edit priorities  -->
<div class="modal fade" tabindex="-1" role="dialog" id="editPriorityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit priorities</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                        <label id="modal_option_title"></label>
                        <div id="modal_options">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
<?php $count=1; foreach ($priorities as $i=>$priority): ?>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	    <div class="form-group">
	        <h4><?php echo($count) ?>)<?php echo($priority['priority']) ?></h4>
	        <ul class="list-unstyled" id="options">
	            <?php foreach ($priority['option'] as $option): ?>
	            	<li><?php echo($option) ?></li>
	            <?php endforeach ?>
                <li>
				<a class="btn_priority_edit" href="#" data-priorityid="<?php echo ($priority['priority_id'].','.$priority['multichoice']) ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
	        </ul>
	    </div>
	</div>	
	<?php $count++; ?>
<?php endforeach ?>

<script type="text/javascript">
	//it opens the modal for edit priorities
	$('.btn_priority_edit').click(function () {
		//$('#editPriorityModal').modal('show');
		$('#modal_options').empty();
		var priority_data=$(this).data('priorityid')
		var temp=priority_data.split(',');
		var multichoice=temp[1];
		var priority_id=temp[0];
		$.ajax({
			url: '<?php echo(site_url("priority/get_options")) ?>'+'/'+priority_id,
			type: 'POST',
			dataType: 'json',
			success:function(data){
				console.log(data);
				$.each(data, function(index, val) {
					$('#modal_options').append('<div class="checkbox"><label><input type="checkbox" value="">'+val.option_title+'</label></div>');
					 console.log(val.option_title);
				});
				$('#editPriorityModal').modal('show')
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	})

</script>
								