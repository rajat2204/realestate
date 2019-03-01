<?php
echo $this->Html->css('tooltipster');
echo $this->Html->script('jquery.tooltipster.min');
?>
<script type="text/javascript">
$(document).ready(function(){
$('#projectId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#propertyId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>
<header id="head" class="secondary">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"><h1>Flats/Plots Availiability</h1></div>
        </div>
    </div>
</header>
<!-- container -->
<section class="container">
    <div class="row">
        <?php echo $this->Form->create();?>
        <div class="col-md-12 col-sm-12 mrg">
            <div class="col-md-3 col-sm-4">
                <?php $url=$this->Html->url(array('controller'=>'Availabilities','action'=>'showproperties'));
                echo$this->Form->select('project_id',$project,array('id'=>'projectId','empty'=>'Please Select Project','class'=>'form-control','required'=>'required','rel'=>$url));?>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php echo$this->Form->select('property_id',$propertyName,array('empty'=>'Please Select Properties','class'=>'form-control','id'=>'propertyId','required'=>'required'));?>
            </div>
            <div class="col-md-2 col-sm-4">
                <?php echo$this->Form->input('name',array('id'=>'flatName','label'=>false,'placeholder'=>'Flat/Plot No.','class'=>'form-control'));?>
            </div>
            <div class="col-md-2 col-sm-2">
                <button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
            </div>
            <div class="col-md-2 col-sm-2">
                <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('controller'=>'Availabilities','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
            </div>
        </div>
        <?php echo$this->Form->end(null);?>
    </div>
    <?php foreach($flats as $post):$id=$post['PropertiesFlat']['id'];?>
    <div class="col-md-1 col-sm-2 col-xs-4">
        <div class="<?php if($post['PropertiesFlat']['status']=="Availiable")echo 'vacant';else echo'allot';?>">
            <div class="abox" id="my-tooltip<?php echo$post['PropertiesFlat']['id'];?>"><?php echo$post['PropertiesFlat']['name'];?></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
        $("#my-tooltip<?php echo$id;?>").tooltipster({theme: 'tooltipster-punk',position: 'bottom',contentAsHTML:true,
                content: $('<table class="table table-bordered"><tr><td><?php echo$post['PropertiesFlat']['type'];?> Name</td><td><?php echo$post['PropertiesFlat']['name'];?></td></tr><tr><td>Area</td><td><?php echo$post['PropertiesFlat']['area'];?></td></tr><tr><td><?php echo$post['PropertiesFlat']['type'];?> No</td><td><?php echo$post['PropertiesFlat']['floor_no'];?></td></tr><tr><td>Status</td><td><?php echo$post['PropertiesFlat']['status'];?></td></tr><tr><td>PLC</td><td><?php echo$post['PropertiesFlat']['remarks'];?></td></tr><table>')
            });
        });
    </script>
    <?php endforeach;unset($post);?>
</section>