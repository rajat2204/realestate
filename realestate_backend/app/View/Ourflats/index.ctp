<script type="text/javascript">
$(document).ready(function(){
$(".inlinefancy").fancybox({
	'titlePosition'	: 'inside',
	'transitionIn'	: 'none',
	'transitionOut'	: 'none'
});
});
</script>
	<header id="head" class="secondary">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Flats/Plots of <?php echo$propertyName;?></h1>
				</div>
			</div>
		</div>
	</header>
	<div class="panel">
	<p><?php echo$this->Html->link('<span class="fa fa-arrow-left"></span> Back','#',array('class'=>'btn btn-info','escape'=>false,'onclick'=>'history.back(-1);'));?></p>
        <div class="panel-body">
                <div class="row"><?php echo $this->Session->flash();?>
		<?php foreach ($project as $post):
		$id=$post['Ourflat']['id'];?>
		<div class="col-md-4 col-sm-6">
		<div class="panel panel-default panel-flats">
		<div class="panel-heading"><strong><?php echo $post['Ourflat']['type'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$post['Ourflat']['name'];?></strong></div>
		<div class="panel-body mrg">
                <div class="col-sm-6 col-xs-6">
			Area: <span class="text-primary"><?php echo $post['Ourflat']['area'];?></span><span class="text-danger">&nbsp;&nbsp;<?php echo $post['Unit']['name'];?></span>
                </div>
                <div class="col-sm-6 col-xs-6">
                   <?php if($post['Ourflat']['type']=='Flat'){echo 'Floor No: ';}else{echo 'Plot No: ';}?><span class="text-primary"><?php echo $post['Ourflat']['floor_no'];?></p>
                </div>
		<?php if($post['Ourflat']['type']=='Flat'){ ?>
		<div class="col-sm-12">
		<small>Bedroom:&nbsp;</small><span class="text-danger"><?php echo $post['Ourflat']['bedroom'];?></span>&nbsp;<small>Bathroom:</small>&nbsp;</small><span class="text-danger"><?php echo $post['Ourflat']['bathroom'];?></span>
		<small>Studyroom:&nbsp;</small><span class="text-danger"><?php echo $post['Ourflat']['studyroom'];?></span>&nbsp;<small>Furnished:</small>&nbsp;<span class="text-danger"><?php echo $post['Ourflat']['furnished'];?></span>
		</div>
		<?php }?>
		<div class="col-sm-12 mrg">
                  Status: <span class="label label-<?php if($post['Ourflat']['status']=="Availiable")echo"success";else echo"danger";?>"><?php echo $post['Ourflat']['status'];?></span>
                </div>
                <!--<div class="col-sm-12">
                   <h4>Price: <span class="text-danger"><?php echo $currency.$post['Ourflat']['price']; ?>&nbsp;<?php echo $post['Unit']['name']; ?></span></h4>
                </div>-->
		<label for="group_name" class="col-sm-12 control-label">
		<?php if($post['Ourflat']['remarks']){?>
		<?php echo$this->Html->link('Description',"#dinlinefancy$id",array('title'=>$post['Ourflat']['name'],'class'=>'inlinefancy btn  btn-info btn-xs','escape'=>false));?>
		<?php }else{
			echo'<br>'.$this->Form->button('No Description',array('title'=>$post['Ourflat']['name'],'class'=>'btn  btn-info btn-xs','escape'=>false));
		}?>
		</label>
		</div>
		</div>  
		</div>
		<div style="display: none;" id="dinlinefancy<?php echo$id;?>"><?php echo$post['Ourflat']['remarks'];?></div>
		<?php endforeach;?>
		<?php unset($post);?>
     </div>
   </div>
</div>