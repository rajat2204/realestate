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
					<h1>Properties of <?php echo$projectName;?></h1>
				</div>
			</div>
		</div>
	</header>
	<!-- container -->
	<section class="container">
<div class="mrg-top"><?php echo$this->Html->link('<span class="fa fa-arrow-left"></span> Back','#',array('class'=>'btn btn-info','escape'=>false,'onclick'=>'history.back(-1);'));?></div>
        
<?php echo $this->Session->flash();?>
	<?php foreach($project as $post):$id=$post['Ourproperty']['project_id'];
	if($post['PropertiesPhoto'])
	{
		$extraPhoto=null;
		foreach($post['PropertiesPhoto'] as $k=>$value):
		if($k==0)
		{
			$photoImg='propertiesphotos_thumb/'.$value['photo'];
			$imgUrl='img/propertiesphotos/'.$value['photo'];
		}
		else
		{
			$extraImg='img/propertiesphotos/'.$value['photo'];
			$extraPhoto.=$this->Html->link(null,"/$extraImg",array('rel'=>$post['Ourproperty']['name'],'class'=>'fancybox','escape'=>false));
		}
		endforeach;
		$projectImage=$this->Html->link($this->Html->image($photoImg,array('alt'=>$post['Ourproperty']['name'])),"/$imgUrl",array('rel'=>$post['Ourproperty']['name'],'class'=>'fancybox','escape'=>false)).$extraPhoto;
	}
	else
	{
		$projectImage=$this->Html->image('nia.png',array('alt'=>$post['Ourproperty']['name']));
	}
	if($post['PropertiesDocument'])
	{
		$extraPhoto=null;
		foreach($post['PropertiesDocument'] as $k=>$value):
		if($k==0)
		{
			$photoImg='img/propertiesdocuments/'.$value['photo'];
		}
		else
		{
			$imgUrl='img/propertiesdocuments/'.$value['photo'];
			$extraPhoto.=$this->Html->link(null,"/$imgUrl",array('rel'=>$post['Ourproperty']['name'].'PropertiesDocument','class'=>'fancybox','escape'=>false));
		}
		endforeach;
		$layoutImage=$this->Html->link('Properties Document',"/$photoImg",array('rel'=>$post['Ourproperty']['name'].'PropertiesDocument','class'=>'fancybox btn btn-primary btn-xs','escape'=>false)).$extraPhoto;
	}
	else
	{
		$layoutImage=$this->Form->button('No Properties Document',array('class'=>'btn  btn-primary btn-xs','title'=>$post['Ourproperty']['name'],'escape'=>false));
	}
	
	
	?>
		
			<div class="col-md-12 mrg">
					
						<div class="col-md-3 col-sm-4">
						<?php echo$projectImage;?>
						<div class="mrg-top"><?php echo$this->Html->link('Show Flats&nbsp;/&nbsp;Plots&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',array('controller'=>'Ourflats','action'=>'index',$id),array('class'=>'inlinefancy btn  btn-success btn-sm','title'=>$post['Ourproperty']['name'],'escape'=>false));?></div>
						</div>	
						<div class="col-md-9 col-sm-8">
								<p><strong> Property Name :</strong>&nbsp;&nbsp;<font class="text-danger"><?php echo$post['Ourproperty']['name'];?></font></p>
								<p><strong> Type :</strong>&nbsp;&nbsp;<font class="text-danger"><?php echo$post['Ourproperty']['type'];?></font>&nbsp;&nbsp;<strong>For</strong>&nbsp;&nbsp;<font class="text-danger"><?php echo$post['Ourproperty']['availiable'];?></font></p>
								<p><strong> Status :</strong>&nbsp;&nbsp;<span class="label label-<?php if($post['Ourproperty']['status']=="Availiable")echo"success";else echo"danger";?>"><?php echo $post['Ourproperty']['status'];?></span></p>
								
								<div class="col-md-12 col-sm-12">
									<div class="col-md-3 col-sm-6 mrg-xs"><?php echo$this->Html->link('Description',"#dinlinefancy$id",array('title'=>$post['Ourproperty']['name'],'class'=>'inlinefancy btn  btn-primary btn-sm','escape'=>false));?></div>
									<div class="col-md-3 col-sm-6 mrg-xs"><?php echo$layoutImage;?></div>
								</div>
								
						</div> 
			</div>
			<div style="display: none;" id="dinlinefancy<?php echo$id;?>"><?php echo$post['Ourproperty']['remarks'];?></div>
			<div style="display: none;" id="ninlinefancy<?php echo$id;?>"><?php echo$post['Ourproperty']['nearest_location'];?></div>
			<div style="display: none;" id="hinlinefancy<?php echo$id;?>"><?php echo$post['Ourproperty']['reach'];?></div>
			<div style="display: none;" id="pinlinefancy<?php echo$id;?>"><?php echo$post['Ourproperty']['purchase'];?></div>
		<?php endforeach;unset($post);?></div>
	</section>