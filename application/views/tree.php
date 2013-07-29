

<h1>Entity Visualization</h1>
<?php 
if (isset($list))
{	
	echo $list;
} 
else
{
?>
	<div id="search">
		<p><?php echo $error;?></p>
		<?php // echo language(); ?>
		<form name="oi" action="<?php echo base_url() . index_page();?>/trees/entitylist" method="post"> 
		<input type="text" name="search_name" value="" />
		<input type="submit" name="submit" value="SEARCH" />
		</form>
	</div>
<?php
}

if (!empty($nodes)){	
 //echo $tree;

?>
<div id="titlenode"><?php echo $node_title; ?></div>
<div id="container_vis">
	<div id="center-container">
	    	 <canvas id="cy" width="740" height="560"></canvas>
	</div>
	<div id="right-container">
		<div id="inner-details"></div>
	</div>
	
</div>

<script>


     var data = {
     		nodes: <?php echo $nodes; ?>,
     		edges: <?php echo $edges; ?>
     		}
    
  // Initialise arbor
    var sys = arbor.ParticleSystem()
    sys.parameters({stiffness:900, repulsion:2000, gravity:false, dt:0.015})
    sys.renderer = Renderer("#cy");
    sys.graft(data);
    /*
    var nav = Nav("#nav")
    $(sys.renderer).bind('navigate', nav.navigate)
    $(nav).bind('mode', sys.renderer.switchMode)
    nav.init()*/
	function NodeStory(nodeid) {
		// abort any pending request
	//alert(nodeid);
	    /*clear result div*/
	   $("#inner-details").html('');
	    // setup some local variables

	    $.ajax({
	      url: "<?php echo base_url();?>index.php/trees/node_data",
	      type: "POST",
	      async: false, 
	      data: {node: nodeid},
	      success:function(d){
	      //	alert(d);
		//  $("#entity_edit").html(data);
		  $("#inner-details").html(d);
	      },
	      error:function(){
		  alert("failure");
		  $("#result").html('there is error while submit');
	      }
	    });
		
	}
</script>

<?php } ?>

