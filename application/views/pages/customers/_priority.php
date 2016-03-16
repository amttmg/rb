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
                        <label id="modal_priority_title"></label>
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
				<a class="btn_priority_edit" href="#" data-priorityid="<?php echo ($priority['priority_id'].','.$priority['multichoice'].','.$priority['priority']) ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
		$('#modal_priority_title').empty();
		var priority_data=$(this).data('priorityid')
		var temp=priority_data.split(',');
		var priority_id=temp[0];
		var multichoice=temp[1];
		var priority_title=temp[2];
		var customer_priority_info='';
		$.ajax({
			url: '<?php echo(site_url("priority/get_options")) ?>'+'/'+priority_id,
			type: 'POST',
			dataType: 'json',
			success:function(data){
				$('#modal_priority_title').append(priority_title);
				if(multichoice=='1')
				{
					$.each(data, function(index, val) {
						$('#modal_options').append('<div class="checkbox"><label><input type="checkbox" name="'+val.priority_id+'[]" value="'+val.option_id+'" id="'+val.option_id+'">'+val.option_title+'</label></div>');
					});
				}
				else
				{
					$.each(data, function(index, val) {
						$('#modal_options').append('<div class="radio"><label><input type="radio" name="'+val.priority_id+'" id="optionsRadios1" value="'+val.option_id+'" checked="">'+val.option_title+'</label></div>');
					});
				}
				
				$('#editPriorityModal').modal('show')
			}
		})
		.fail(function() {
			console.log("error");
		});

		$.ajax({
			url: '<?php echo(site_url("priority/option_info")) ?>'+'/'+$('#customer_id').val(),
			type: 'POST',
			dataType: 'json',
			success:function(data){
				$.each(data, function(index, val) {
					 $('#'+val.option_id).attr('checked',true);
				});
			}
		})
		.fail(function() {
			console.log("error");
		});
	})

</script>
								