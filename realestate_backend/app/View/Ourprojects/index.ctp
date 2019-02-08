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
				<div class="col-sm-12">
					<h1>Projects</h1>
				</div>
			</div>
		</div>
	</header>
	<!-- container -->
	<section class="container">
	<?php foreach($project as $post):$id=$post['Ourproject']['id'];
	if($post['ProjectsPhoto'])
	{
		$extraPhoto=null;
		foreach($post['ProjectsPhoto'] as $k=>$value):
		if($k==0)
		{
			$photoImg='projectsphotos_thumb/'.$value['photo'];
			$imgUrl='img/projectsphotos/'.$value['photo'];
		}
		else
		{
			$extraImg='img/projectsphotos/'.$value['photo'];
			$extraPhoto.=$this->Html->link(null,"/$extraImg",array('rel'=>$post['Ourproject']['name'],'class'=>'fancybox','escape'=>false));
		}
		endforeach;
		$projectImage=$this->Html->link($this->Html->image($photoImg,array('alt'=>$post['Ourproject']['name'])),"/$imgUrl",array('rel'=>$post['Ourproject']['name'],'class'=>'fancybox','escape'=>false)).$extraPhoto;
	}
	else
	{
		$projectImage=$this->Html->image('nia.png',array('alt'=>$post['Ourproject']['name']));
	}
	if($post['ProjectsLayoutplan'])
	{
		$extraPhoto=null;
		foreach($post['ProjectsLayoutplan'] as $k=>$value):
		if($k==0)
		{
			$photoImg='img/projectslayoutplans/'.$value['photo'];
		}
		else
		{
			$imgUrl='img/projectslayoutplans/'.$value['photo'];
			$extraPhoto.=$this->Html->link(null,"/$imgUrl",array('rel'=>$post['Ourproject']['name'].'ProjectsLayoutplan','class'=>'fancybox','escape'=>false));
		}
		endforeach;
		$layoutImage=$this->Html->link('Layout Plan',"/$photoImg",array('rel'=>$post['Ourproject']['name'].'ProjectsLayoutplan','class'=>'fancybox inlinefancy btn-primary btn-sm','escape'=>false)).$extraPhoto;
	}
	else
	{
		$layoutImage=$this->Form->button('No Layout Plan',array('class'=>'inlinefancy btn-primary btn-sm','title'=>$post['Ourproject']['name'],'escape'=>false));
	}
	if($post['ProjectsLocationmap'])
	{
		$extraPhoto=null;
		foreach($post['ProjectsLocationmap'] as $k=>$value):
		if($k==0)
		{
			$photoImg='img/projectslocationmaps/'.$value['photo'];
		}
		else
		{
			$imgUrl='img/projectslocationmaps/'.$value['photo'];
			$extraPhoto.=$this->Html->link(null,"/$imgUrl",array('rel'=>$post['Ourproject']['name'].'ProjectsLocationmap','class'=>'fancybox','escape'=>false));
		}
		endforeach;
		$locationmapImage=$this->Html->link('Location Map',"/$photoImg",array('rel'=>$post['Ourproject']['name'].'ProjectsLocationmap','class'=>'fancybox inlinefancy btn-primary btn-sm','escape'=>false)).$extraPhoto;
	}
	else
	{
		$locationmapImage=$this->Form->button('No Location Map',array('class'=>'inlinefancy btn-primary btn-sm','title'=>$post['Ourproject']['name'],'escape'=>false));
	}
	
	?>
		<div class="row">
			<div class="col-md-12 mrg">
					
						<div class="col-md-3 col-sm-4">
						<?php echo$projectImage;?>
						<div class="mrg-top"><?php echo$this->Html->link('Show Properties',array('controller'=>'Ourproperties','action'=>'index',$id),array('class'=>'inlinefancy btn-sm btn-success col-md-9 col-sm-9 ','title'=>$post['Ourproject']['name'],'escape'=>false));?></div>
						</div>	
						<div class="col-md-9 col-sm-8">
								<p><strong> Project Name :</strong>&nbsp;&nbsp;<span class="text-danger"><?php echo$post['Ourproject']['name'];?></span></p>
								<p><strong> State :</strong>&nbsp;&nbsp;<span class="text-danger"><?php echo$post['Ourproject']['state'];?></span></p>
								<p><strong> City :</strong>&nbsp;&nbsp;<span class="text-danger"><?php echo$post['Ourproject']['city'];?></span></p>
								<p><strong> Address :</strong>&nbsp;&nbsp;<span class="text-danger"><?php echo$post['Ourproject']['address'];?></span></p>
								<p><strong> Nearest Location :</strong>&nbsp;&nbsp;<span class="text-danger"><?php echo$post['Ourproject']['nearest_location'];?></span></p>
								
								<div class="col-md-12 col-sm-12">
									<div class="col-md-3 col-sm-4 mrg-xs"><?php echo$this->Html->link('Description',"#dinlinefancy$id",array('title'=>$post['Ourproject']['name'],'class'=>'inlinefancy btn-primary btn-sm','escape'=>false));?></div>
									<div class="col-md-3 col-sm-4 mrg-xs"><?php echo$this->Html->link('How To Reach',"#hinlinefancy$id",array('title'=>$post['Ourproject']['name'],'class'=>'inlinefancy btn-primary btn-sm','escape'=>false));?></div>
									<div class="col-md-3 col-sm-4 mrg-xs"><?php echo$this->Html->link('Why purchase',"#pinlinefancy$id",array('title'=>$post['Ourproject']['name'],'class'=>'inlinefancy btn-primary btn-sm','escape'=>false));?></div>									
								</div>
								<div class="col-md-12 col-sm-12 mrg">
									<div class="col-md-3 col-sm-4 mrg-xs"><?php echo$layoutImage;?></div>
									<div class="col-md-3 col-sm-4 mrg-xs"><?php echo$locationmapImage;?></div>
								</div>
						</div> 
			</div>
			<div style="display: none;" id="dinlinefancy<?php echo$id;?>"><?php echo$post['Ourproject']['description'];?></div>
			<div style="display: none;" id="ninlinefancy<?php echo$id;?>"><?php echo$post['Ourproject']['nearest_location'];?></div>
			<div style="display: none;" id="hinlinefancy<?php echo$id;?>"><?php echo$post['Ourproject']['reach'];?></div>
			<div style="display: none;" id="pinlinefancy<?php echo$id;?>"><?php echo$post['Ourproject']['purchase'];?></div>
		</div><?php endforeach;unset($post);?>
	</section>