<?php
if(!isset($list) && empty($nodes))
{
?>
<!-- Home page -->
	<!-- Banner -->
	<div id="cityscape" class="span12">
		<div class="tagline span11">
			<h2>The freely accessible database of information on all Kenyan registered companies</h2>
			<div class="description span11">
				<h4>Providing citizens, journalists, and civic activists with a practical and easy-to-use tool to understand the ownership
				structure of the world they live in, demonstrating the practical applications of open information for normal citizens.</h4>
			</div>
		</div>
	</div> <!-- #cityscape -->

	<!-- Search -->
	<div id="search" class="section span12">
		<h2>Search</h2>
		<p><?php echo $error;?></p>
		<?php // echo language(); ?>
		<form name="oi" action="<?php echo base_url() . index_page();?>/trees/entitylist" method="post"> 
			<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
			<br />
			<input type="submit" name="submit" value="Go" class="btn btn-warning" />
		</form>
	</div> <!-- #search -->

	<!-- Stats and Latest -->
	<div id="datapop" class="section span12">

		<!-- Stats -->
		<div class="stats span6">
			<h3>In Our Database</h3>
			<div class="figures row">
				<div class="people span2">
					<img src="<?php echo base_url(); ?>assets/img/people.png">
					<h4>People</h4>
					<h5><?php echo $persons;?></h5>
				</div>
				<div class="cases span2">
					<img src="<?php echo base_url(); ?>assets/img/cases.png">
					<h4>Cases</h4>
					<h5>42</h5>
				</div>
				<div class="organisations span2">
					<img src="<?php echo base_url(); ?>assets/img/organisations.png">
					<h4>Organisations</h4>
					<h5><?php echo $organisations;?></h5>
				</div>
			</div>
		</div><!-- .stats -->

		<!-- Latest -->
		<div class="popular span5">
			<h3>Latest Entitites</h3>
			<div class="topfive">
				<ol>
					
					<?php echo $latest_list;?>
				
				</ol>
			</div>
		</div><!-- .popular -->

		<!-- Disclaimer -->
		<div class="disclaimer section span10 offset1">
			<p>
				Our database contains information on people, companies and organisations, as well as their linkages at specified periods of time.
				While we make every attempt to make this information as accurate as possible, we take no responsibility for its authenticity.
				The current information is derived from the Kenya Gazette and Handsards. We will be incorporating more information from different sources soon. 
			</p>
		</div><!-- .disclaimer -->
	</div> <!-- #datapop -->

	<!-- Partners -->
	<div id="partners" class="section span12">
		<h2>Launched in partnership with</h2>
		<div id="partner-logos" class="span12"></div>
	</div><!-- #partners -->

<?php 
}

if (isset($list))
{	
?>

<!-- Results -->
	<div id="search-results" class="section">
		<h2>Search results</h2>
	</div>

<?php 
	echo "<ul class='results'>".$list."</ul>"; }

if (!empty($nodes)){	
 	//echo $tree;

?>

<!-- Visualisation & Timeline --> 

	<div id="visualisation" class="section">
		<h2>Search results for "<?php echo $node_title; ?>"</h2>

		<!-- Filter -->
		<div id="vis_checkbox">

			<?php echo form_open("tree/filter", array('id' => 'signup')); ?>
				<input type="hidden" value="" name="EntityIDS" />
				<input type="checkbox" name='Merge[]' value='".$content[$i]['ID']."'>People
				<input type="checkbox" name='Merge[]' value='".$content[$i]['ID']."'>Companies
				<input type="checkbox" name='Merge[]' value='".$content[$i]['ID']."'>Organisations
				<input type="checkbox" name='Merge[]' value='".$content[$i]['ID']."'>Cases
				<input type="checkbox" name='Merge[]' value='".$content[$i]['ID']."'>Grants
			<?php echo form_close(); ?>
		</div>

		<!-- Visualisation -->
		<div id="container_vis" class="row">
			<div id="center-container" class="span8">
				<canvas id="cy" width="740" height="560"></canvas>
			</div>
			<div id="right-container" class="span3">
				<div id="inner-details">
					<h4><i class="icon-info-sign icon-large"></i>&nbsp;&nbsp;&nbsp;Click on a node to get more information about it</h4>
				</div>
			</div>
		</div>

		<!-- Timeline -->

		<div id="mytimeline"></div>

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
   
</script>

<?php } ?>

