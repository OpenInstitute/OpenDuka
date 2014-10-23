

<!-- Visualisation & Timeline --> 

	<div id="visualisation">


		<!-- Visualisation -->
		<div id="container_vis" class="row">
			<div id="center-container" class="col-md-12 col-lg-12">
				<canvas id="cy"></canvas>
			</div>

			
		</div>
		<div id="right-container" class="hide panel panel-default">
				<div class="panel-heading"></div>
				<div class="panel-body"></div>
				<div class="col-md-12 col-lg-12" id="inner_details"></div>
		</div>
	</div> <!-- #visualisation end -->
		


	<script type="text/javascript">

	var data = {
		nodes: <?php echo $nodes; ?>,
		edges: <?php echo $edges; ?>
	}

  		// Initialise arbor
	    var sys = arbor.ParticleSystem()
	    sys.parameters({stiffness:900, repulsion:4000, gravity:true, dt:0.015})
	    sys.renderer = Renderer("#cy","<?php echo $hidden_nodes; ?>","<?php echo base_url();?>assets/img/")
	    sys.graft(data)

	
		
		
		function rhtmlspecialchars(str) {
			if (typeof(str) == "string") {
				str = str.replace(/&gt;/ig, ">");
				str = str.replace(/&lt;/ig, "<");
				str = str.replace(/&#039;/g, "'");
				str = str.replace(/&quot;/ig, '"');
				str = str.replace(/&amp;/ig, '&'); /* must do &amp; last */
			}
				return str;
		}
		


</script>
