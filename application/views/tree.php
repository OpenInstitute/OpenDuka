<?php
if(!isset($list) && empty($nodes))
{
?>
<div id="tagline"></div>
<h1>SEARCH</h1>
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

if (isset($list))
{	
?>
<h1>SEARCH RESULTS</h1>
<?php
	echo $list;
} 

if (!empty($nodes)){	
 //echo $tree;

?>
<h1><?php echo $node_title; ?></h1>
<div id="vis_checkbox">Filter

<?php echo form_open("tree/filter", array('id' => '')); ?>
	<input type="hidden" value="" name="EntityIDS"/>
	<?php echo $filter_form; ?>
<?php echo form_close(); ?>

</div>
<div id="container_vis">
	<div id="center-container">
	    	 <canvas id="cy" width="740" height="560"></canvas>
	</div>
	<div id="right-container">
		<div id="inner-details"></div>
	</div>
	
</div>

<div id="mytimeline"></div>

<script>

     var data = {
     		nodes: <?php echo $nodes; ?>,
     		edges: <?php echo $edges; ?>,

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
		//TimeLine(nodeid);
	}
	

var events = [<?php echo $events; ?>];
var sections = [<?php echo $sections; ?>];

       var timeline1 = new Chronoline(document.getElementById("mytimeline"), events, {
		visibleSpan: DAY_IN_MILLISECONDS * 366,
		animated: true,
		tooltips: true,
		defaultStartDate: new Date(2012, 3, 5),
		sections: sections,
		sectionLabelAttrs: {'fill': '#997e3d', 'font-weight': 'bold'},
		labelInterval: isHalfMonth,
		hashInterval: isHalfMonth,
		scrollLeft: prevQuarter,
		scrollRight: nextQuarter,
		floatingSubLabels: false,
		});

	$('#to-today').click(function(){timeline1.goToToday();});
   
   
   $(".FilterForm").click(function() {
	   
	   var f = this;
	   var val = $(this).attr('value');
		//alert(val);
	    // FILL DEFAULTS
	//    alert(data.attr('nodes').length);
	    var n = 'nodes';
	    for(var attrname in data){
	    
	    alert(attrname);
	    	if(n==attrname){
	    	
	    		for(var attr in n){
	    		alert(attr);
	    		}
	    	//f[attrname] = data[attrname];
	    	}
	    //	
	    	
	    }
    	
   });
</script>

<?php } ?>

