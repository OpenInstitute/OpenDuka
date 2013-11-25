
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
		<div class="stats col-md-4 col-lg-4">
			<h3>In Our Database</h3>
			<div class="figures row" style="margin-top:20px">
				<div class="people col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/people.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/22">People</a></h4>
					<h5><?php echo $persons; ?></h5>
				</div>
				<div class="organisations col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/organisations.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/21">Organisations</a></h4>
					<h5><?php echo $organisations; ?></h5>
				</div>
			</div>
			<br />
			<div class="figures row">
				<div class="tenders col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/tenders.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $TendersID; ?>">Tenders</a></h4>
					<h5><?php echo $Tenders; ?></h5>
				</div>
				<div class="grants col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/grants.png">
					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $ContractsID; ?>">Contracts</a></h4>
					<h5><?php echo $Contracts; ?></h5>
				</div>
			</div>
			<br />
			<div class="figures row">
				<div class="cases hidden-xs hidden-sm col-md-6 col-lg-6">
 					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/cases.png">
 					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $CasesID; ?>">Cases</a></h4>
 					<h5><?php echo $Cases; ?></h5>
 				</div>
 				<div class="land hidden-xs hidden-sm col-md-6 col-lg-6">
 					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/land.png">
 					<h4><a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $LandID; ?>">Land</a></h4>
 					<h5><?php echo $Land; ?></h5>
 				</div>
			</div>
		</div><!-- .stats -->

		<!-- Latest -->
		<div class="latest col-md-4 col-lg-4">
			<h3>Latest Entries</h3>
			<div class="topfive">
				<ol>
					
					<?php echo $latest_list;?>
				
				</ol>
			</div>
		</div><!-- .latest -->

		<!-- Popular -->
		<div class="popular col-md-4 col-lg-4">
			<h3>Popular Entries</h3>
			<div class="topfive">
				<ol>
					<?php echo $popular_list;?>
				</ol>
			</div>
		</div><!-- .popular -->
	</div> <!-- #datapop -->

	<div id="disclaimer" class="row">
		<!-- Disclaimer -->
		<div class="col-md-12 col-lg-12">
			<p>
				Our database contains information on people, companies and organisations, as well as their linkages at specified periods of time.
				While we make every attempt to make this information as accurate as possible, we take no responsibility for its authenticity.
				The current information is derived from the Kenya Gazette, Handsards and procurement websites. 
				We will be incorporating more information from different sources soon. 
			</p>
		</div>
	</div><!-- .disclaimer -->

	<!-- Partners -->
	<div id="partners" class="row">
		<h2>Launched in partnership with</h2>
		<div id="partner-logos">
			<a href="http://www.africatti.org/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/atti-logo.jpg">
			</a>
			<a href="http://www.kenyalaw.org/kl/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/klr-logo.png" style="margin-top:20px">
			</a>
		</div>
	</div><!-- #partners -->

	<div id="twitter-feed" class="row">
		<h2><a href="http://twitter.com/OpenDuka"><i class="fa fa-twitter"></i></a></h2>
		<a href="http://twitter.com/OpenDuka">Follow @OpenDuka</a>
		<br />
		<section>
			<div id="feed"></div>
		</section>
	</div>
	<script type="text/javascript" src="assets/js/twitterFetcher_v10_min.js"></script>
	<script>
		twitterFetcher.fetch('402150804695416832', '', 3, true, false, true, '', true, handleTweets);
			function handleTweets(tweets){
				var x = tweets.length;
				var n = 0;
				var element = document.getElementById('feed');
				var html = '<ul class="divided col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">';
				while(n < x) {
					html += '<li><article class="tweet">' + tweets[n] + '</article></li>';
					n++;
				}
				html += '</ul>';
					element.innerHTML = html;
	      	}
	</script>

<?php 
}

if (isset($list))
{	
?>

<!-- Results -->
<div id="search-results">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<h2>Search results</h2>
		</div>
		<!-- Search -->
		<div class="query col-md-6 col-lg-6" style="padding-top: 24px;">
		  <form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
			<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
			<input type="submit" name="submit" value="Go" class="btn btn-warning" />
		  </form>
		</div> <!-- #search -->
	</div>
	<div class="row">
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
	</div>
	
	<div class="row" id="fruits">
		<div class="matokeo col-md-12 col-lg-12" >
	            <?php echo $list ?>
		</div>
		<div class="mfuatilio col-md-12 col-lg-12 text-center" id="pagination">
		  <ul>
		    <li><a href='<?php echo base_url() . index_page() ."/homes/".$func."/".$term ."/".$sortment; ?>/'>.</a></li>
		    <li class="next-posts"><a href='<?php echo base_url() . index_page() ."/homes/".$func."/".$term ."/".$sortment; ?>/'>.</a></li>
		   </ul>
		</div>
	 </div>
</div>
<?php
}

if (!empty($nodes)){	
//echo $tree;
?>

<!-- Visualisation & Timeline --> 

	<div id="visualisation">
		<div class="row" style="margin: 0">
			<div class="col-md-6 col-lg-6">
				<h2>Search results for "<B><?php echo $node_title; ?></B>"</h2>
				<h6>Click on a node for details</h6>
			</div>
			<!-- Search -->
			<div class="query col-md-6 col-lg-6" style="margin-top:0.8em;">
				<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
					<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
					<input type="submit" name="submit" value="Go" class="btn btn-warning" />
				</form>
			</div> <!-- #search -->
		</div>

		<!-- Visualisation -->
		<div id="container_vis" class="row" style="margin: 0">
			<div id="center-container" class="col-md-8 col-md-offset-0 col-lg-8 col-lg-offset-0">
				<canvas id="cy"></canvas>
			</div>
			<div id="right-container" class="col-md-offset-0 col-lg-offset-0 hide">
				<div class="inner-header"></div>
				<hr />
				<div class="inner-details col-md-11 col-lg-12"></div>
			</div>
		</div>
	</div> <!-- #visualisation end -->
		<!-- Timeline -->

		<!-- <div id="mytimeline"></div> -->



<script type="text/javascript">


     var data = {
     		nodes: <?php echo $nodes; ?>,
     		edges: <?php echo $edges; ?>
     		
     		}
  // Initialise arbor
    var sys = arbor.ParticleSystem()
    sys.parameters({stiffness:900, repulsion:2000, gravity:true, dt:0.015})
    sys.renderer = Renderer("#cy",[<?php echo $hidden_nodes; ?>])
    sys.graft(data)
    /*, '<?php echo base_url() ;?>assets/img/'
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
		  $(".inner-header").html('<h3><a href="'+ l +'">'+ pn +'</a> <span style="font-size: 0.45em" class="tiptext">[?]<span class="description">Click heading to get further relationship</span></span></h3>');
		  $('#center-container').removeClass("col-md-offset-2 col-lg-offset-2").addClass("col-md-offset-0 col-lg-offset-0");
		  $('#right-container').removeClass("hide col-md-offset-0 col-lg-offset-0").addClass("col-md-4 col-lg-4");
		
		  
		$(".tiptext").mouseover(function() {
		    $(this).children(".description").show();
		}).mouseout(function() {
		    $(this).children(".description").hide();
		});
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

