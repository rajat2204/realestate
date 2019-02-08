<script type="text/javascript">
    $(document).ready(function(){
$('#selectAllar').click(function() {
$('.chkselectar').prop('checked', this.checked);});
});
</script>
<?php echo $this->Session->flash();
$url=$this->Html->url(array('controller'=>'Users'));?>
<div class="container">
<div class="row">
<?php echo $this->Form->create('User', array('controller' => 'PageRight','action'=>"assignrightsedit/$id",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
    <div class="col-md-12">    
        <div class="panel panel-default mrg">
        <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Assign <span>Form Rights</span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAllar','hiddenField'=>false));?></th>
                                <th>S.No.</th>
                                <th>Module Name</th>
                                <th>Page Name</th>
                            </tr>
                            <?php foreach ($PageRight as $k=>$post): $prId=$post['Page']['id'];$pageId=$post['PageRight']['page_id'];$ugroupId=$post['PageRight']['ugroup_id'];
                            if($prId==$pageId && $id==$ugroupId)
                            $checked="checked";
                            else
                            $checked="";?>
                            <tr>
                                <td><?php echo $this->Form->checkbox(false,array('value' =>$prId,'name'=>'data[PageRight][id][]','id'=>"DeleteCheckbox$prId",'class'=>'chkselectar','checked'=>$checked,'hiddenField'=>false));?></td>
                                <td><?php echo ++$k; ?></td>
                                <td><?php echo $post['Page']['model_name'];?></td>
                                <td><?php echo $post['Page']['page_name'];?></td>                            
                            </tr>
                            <?php endforeach; ?>
                            <?php unset($post); ?>
                            <tr>
                                <td colspan="4"><button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button></td>
                            </tr>
                            </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>