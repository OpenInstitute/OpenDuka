
<?php
if(!isset($list) && empty($nodes))
{
?>

<!-- Home page -->
	<!-- Banner -->
	<div id="cityscape" class="row">
		<div class="tagline col-md-12 col-lg-12">
			<h2>The freely accessible database of information on Kenyan entities</h2>
		</div>
		<div class="description col-md-12 col-lg-12">
			<h4>Providing citizens, journalists, and civic activists with a practical and easy-to-use tool to understand the ownership structure of the world they live in, demonstrating the practical applications of open information for normal citizens.</h4>
		</div>
	</div>
	 
	<!-- #cityscape -->

	<!-- Search -->
	<div id="search" class="row">
		<h2>Search</h2>
		<p><?php echo $error;?></p>
		<?php // echo language(); ?>
		<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
			<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
			<br />
			<input type="submit" name="submit" value="Go" class="btn btn-warning" />
		</form>
	</div> <!-- #search -->

	<!-- Stats and Latest -->
	<div id="datapop" class="row">

		<!-- Stats -->
		<div class="stats col-md-6 col-lg-6">
			<h3>In Our Database</h3>
			<div class="figures row">
				<div class="people col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/people.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/22">People</a></h4>
					<h5><?php echo $persons;?></h5>
				</div>
				<div class="tenders col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/tenders.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $TendersID; ?>">Tenders</a></h4>
					<h5><?php echo $Tenders;?></h5>
				</div>
				<div class="organisations col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/organisations.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/21">Organisations</a></h4>
<!-- 					<a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/22"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/people.png"></a>
					<h4>People</h4>
					<h5><?php echo $persons;?></h5>
				</div>
				<div class="tenders col-md-2 col-lg-4">
					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $TendersID; ?>"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/tenders.png"></a>
					<h4>Tenders</h4>
					<h5><?php echo $Tenders;?></h5>
				</div>
				<div class="organisations col-md-2 col-lg-4">
					<a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/21"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/organisations.png"></a>
					<h4>Organisations</h4> -->
					<h5><?php echo $organisations;?></h5>
				</div>
			</div>
			<br />
			<div class="figures row">
				<div class="cases col-md-4 col-lg-4 hidden-xs hidden-sm">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/cases.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $CasesID; ?>">Cases</a></h4>
					<h5><?php echo $Cases;?></h5>
				</div>
				<div class="grants col-md-4 col-lg-4 hidden-xs hidden-sm">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/grants.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $ContractsID; ?>">Contracts</a></h4>
					<h5><?php echo $Contracts;?></h5>
				</div>
				<div class="land col-md-4 col-lg-4 hidden-xs hidden-sm">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/land.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $LandID; ?>">Land</a></h4>

<!-- 					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $ContractsID; ?>"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/grants.png"></a>
					<h4>Contracts</h4>
					<h5><?php echo $Contracts;?></h5>
				</div>
				<div class="land col-md-2 col-lg-4">
					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $LandID; ?>"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/land.png"></a>
					<h4>Land</h4> -->
					<h5><?php echo $Land;?></h5>
				</div>
			</div>
		</div><!-- .stats -->

		<!-- Latest -->
		<div class="popular col-md-5 col-lg-6">
			<h3>Latest Entries</h3>
			<div class="topfive">
				<ol>
					
					<?php echo $latest_list;?>
				
				</ol>
			</div>
		</div><!-- .popular -->

		<!-- Disclaimer -->
		<div class="disclaimer col-md-9 col-lg-12">
			<p>
				Our database contains information on people, companies and organisations, as well as their linkages at specified periods of time.
				While we make every attempt to make this information as accurate as possible, we take no responsibility for its authenticity.
				The current information is derived from the Kenya Gazette and Handsards. We will be incorporating more information from different sources soon. 
			</p>
		</div><!-- .disclaimer -->
	</div> <!-- #datapop -->

	<!-- Partners -->
	<div id="partners" class="row">
		<h2>Launched in partnership with</h2>
		<div id="partner-logos">
			<a href="http://www.africatti.org/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/atti-logo.jpg">
			</a>
			<a href="http://www.kenyalaw.org/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/klr-logo.jpg" style="margin-top:20px">
			</a>
		</div>
	</div><!-- #partners -->

<?php 
}

if (isset($list))
{	
?>

<!-- Results -->
	<div id="search-results" class="col-md-6 col-lg-6">
		<h2>Search results</h2>
	</div>
	<!-- Search -->
	<div class="query pull-right" style="padding-top: 80px; padding-right: 10px;">
		<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
			<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
			<input type="submit" name="submit" value="Go" class="btn btn-warning" />
		</form>
	</div> <!-- #search -->
<div id="sortment">
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/A"; ?>'>A</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/B"; ?>'>B</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/C"; ?>'>C</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/D"; ?>'>D</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/E"; ?>'>E</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/F"; ?>'>F</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/G"; ?>'>G</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/H"; ?>'>H</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/I"; ?>'>I</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/J"; ?>'>J</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/K"; ?>'>K</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/L"; ?>'>L</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/M"; ?>'>M</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/N"; ?>'>N</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/O"; ?>'>O</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/P"; ?>'>P</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/Q"; ?>'>Q</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/R"; ?>'>R</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/S"; ?>'>S</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/T"; ?>'>T</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/U"; ?>'>U</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/V"; ?>'>V</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/W"; ?>'>W</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/X"; ?>'>X</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/Y"; ?>'>Y</a>
		<a href='<?php echo base_url() . index_page() ."/homes/". $func."/".$term . "/Z"; ?>'>Z</a>
	</div>
<?php 
	echo "
	<div id='content'>
		<!-- <div class='results col-md-11 col-lg-12' id>
			$list
		</div>
		<div class='navigation col-md-12 col-lg-12 text-center'>
		    <div class='previous-posts'><a href='". base_url() . index_page() ."/homes/entitylist/".$term."/'>1</div>
		    <div class='next-posts'><a href='". base_url() . index_page() ."/homes/entitylist/".$term."/'>2</a></div>
	      </div> -->
		<div class='results col-md-11 col-lg-12' >
			$list
		</div>
		<div class='navigation col-md-12 col-lg-12 text-center' id='pagination'>
		    <div class='previous-posts'><a href='". base_url() . index_page() ."/homes/".$func."/".$term ."/".$sortment ."/'>1</a></div>
		    <div class='next-posts'><a href='". base_url() . index_page() ."/homes/".$func."/".$term ."/".$sortment ."/'>2</a></div>
	        </div>
	 </div>";
	}

if (!empty($nodes)){	
 	//echo $tree;
?>

<!-- Visualisation & Timeline --> 

	<div id="visualisation">
		<div class="row" style="margin: 0">
			<div class="pull-left col-md-7 col-lg-7">
				<h2>Search results for "<?php echo $node_title; ?>"</h2>
				<h6>Click on a node for details</h6>
			</div>
			<!-- Search -->
			<div class="query pull-right">
				<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
					<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
					<input type="submit" name="submit" value="Go" class="btn btn-warning" />
				</form>
			</div> <!-- #search -->
		</div>

		<!-- Visualisation -->
		<div id="container_vis" class="row" style="margin: 0">
			<div id="center-container" class="col-md-8 col-md-offset-2 col-lg-offset-2 col-lg-8">
				<canvas id="cy" width="740" height="560"></canvas>
			</div>
			<div id="right-container" class="col-md-offset-0 col-lg-offset-0 hide">
				<div class="inner-header"></div>
				<hr />
				<div class="inner-details col-md-11 col-lg-12"></div>
			</div>
		</div>
</div>
		<!-- Timeline -->

		<!-- <div id="mytimeline"></div> -->

  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/renderer.js"></script>
<script type="text/javascript">

     var data = {
     		nodes: <?php echo $nodes; ?>,
     		edges: <?php echo $edges; ?>
     		}
    
  // Initialise arbor
    var sys = arbor.ParticleSystem()
    sys.parameters({stiffness:900, repulsion:2000, gravity:false, dt:0.015})
    sys.renderer = Renderer("#cy", '<?php echo base_url() ;?>assets/img/');
    sys.graft(data);
    /*
    var nav = Nav("#nav")
    $(sys.renderer).bind('navigate', nav.navigate)
    $(nav).bind('mode', sys.renderer.switchMode)
    nav.init()*/
	function NodeStory(nodeid) {
		// abort any pending request
	//alert(nodeid);
	
	$( "#cy" ).attr({width: "600" , height: "600" });
	    /*clear result div*/
	   $(".inner-details").html('');
	    // setup some local variables
	    

	    $.ajax({
	      url: "<?php echo base_url();?>index.php/homes/node_data",
	      type: "POST",
	      data: {node: nodeid},
	     // async: false,
	      dataType: "json",
	     // contentType: "application/json",
	      success:function(d){
	      	//alert(d);
	      	d = JSON.parse(d);
		//  $("#entity_edit").html(data);
		//alert(d.data[1].header[0].Link);
		$('.inner-details').html("<ul/>");
		l = d.data[1].header[0].Link;
		pn = d.data[1].header[0].Name;
		
		extradata = d.data[0].posts[0].ExtraData;
		extradata = rhtmlspecialchars(extradata);
		// if (ed==1){
		// 	$(".inner-details ul").append('<li>'+ extradata +'</li>');
		// }
		// //m = d.data[2].arraymap[0]._201.Verb;
		// am = d.data[2].arraymap[0];
		
	
		// $.each(d.data[0].posts, function(i,post){
		// 	id = '_'+post.ID;
		// 	//alert(id);
		// 	//alert(am._201.Verb);
		// 	e = post.EntMap;
		// 	v = post.Verb;
		// 	dc = post.EffectiveDate;
		// 	p = post.EntPos;
			
			
			
		// 	if (v == '0'){
		// 	v='';
		// 		m = am[id][0]['Verb'];
		// 		dr = am[id][0]['Dated'];
		// 		//alert(m);
		// 		$.each(am, function(j,mv){
		// 	 	v += 'was '+ m + ' on '+ dr+ 'to: <br>';
		// 	 	});
			 	
		//   $(".inner-details ul").append('<li><span class="st-verb">'+ v +'</span> <span class="st-name">'+ post.Name +'</span></li>');			 	
		// 	 } else {
			 
		//   $(".inner-details ul").append('<li><span class="st-verb">'+ v +'</span> <span class="st-name">'+ post.Name +'</span><span class="st-verb"> '+ p +'</span></p><p><span class="st-date">Effected Date - '+ dc +'</span></li>');		
		//   	}

		  $(".inner-details ul").append('<li>'+ extradata +'</li>');
		  $(".inner-header").html('<h3><a href="'+ l +'">'+ pn +'</a> <span style="font-size: 0.45em"><a href="#" title="Click name to see more connections">[?]</a></span></h3>');
		  $('#center-container').removeClass("col-md-offset-2 col-lg-offset-2").addClass("col-md-offset-0 col-lg-offset-0");
		  $('#right-container').removeClass("hide col-md-offset-0 col-lg-offset-0").addClass("col-md-4 col-lg-4");
		  

	     },
	     error: function(xhr, status, error) {
			 alert(xhr.error);
	     }
	    });

	}
	
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
	/*

var events = [<?php // echo $events; ?>];
var sections = [<?php // echo $sections; ?>];

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
   */
</script>

<?php } ?>

