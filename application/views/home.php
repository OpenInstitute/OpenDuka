
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
		<div class="tagline-description col-md-12 col-lg-12">
			<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
				<h4>Providing citizens, journalists, and civic activists with a practical and easy-to-use tool to understand the ownership 
				structure of the world they live in, demonstrating the practical applications of open information for normal citizens</h4>
			</div>
		</div>
	</div>
	 
	<!-- #cityscape -->

	<!-- Search -->
	<div id="search" class="row">
		<div class="container">
			<h2>Search</h2>
			<p><?php echo $error;?></p>
			<?php // echo language(); ?>
			<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
				<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
				<br />
				<input type="submit" name="submit" value="Go" class="btn btn-warning" />
			</form>
		</div>
	</div> <!-- #search -->

	<!-- Stats and Latest -->
	<div id="datapop" class="row">

		<!-- Stats -->
		<div class="stats col-md-4 col-lg-4">
			<h3>In Our Database</h3>
			<div class="figures row" style="margin-top:20px">
				<div class="people col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/22">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/people.png">
						<h4>People</h4>
						<h5><?php echo $persons; ?></h5>
					</a>
				</div>
				<div class="organisations col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a href="<?php echo base_url() . index_page();?>/homes/entityTypelist/21">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/organisations.png">
						<h4>Organisations</h4>
						<h5><?php echo $organisations; ?></h5>
					</a>
				</div>
			</div>
			<br />
			<div class="figures row">
				<div class="tenders col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $TendersID; ?>">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/tenders.png">
						<h4>Tenders</h4>
						<h5><?php echo $Tenders; ?></h5>
					</a>
				</div>
				<div class="grants col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $ContractsID; ?>">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/grants.png">
						<h4>Contracts</h4>
						<h5><?php echo $Contracts; ?></h5>
					</a>
				</div>
			</div>
			<br />
			<div class="figures row">
				<div class="cases hidden-xs hidden-sm col-md-6 col-lg-6">
					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $CasesID; ?>">
	 					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/cases.png">
	 					<h4>Cases</h4>
	 					<h5><?php echo $Cases; ?></h5>
 					</a>
 				</div>
 				<div class="land hidden-xs hidden-sm col-md-6 col-lg-6">
 					<a href="<?php echo base_url() . index_page();?>/homes/entityDoclist/<?php echo $LandID; ?>">
	 					<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/land.png">
	 					<h4>Land</h4>
	 					<h5><?php echo $Land; ?></h5>
	 				</a>
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
		<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
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
		
		<div id="dev-logos">
		<h2>Developed by</h2>
			<a href="http://www.openinstitute.com/" target="blank" class="col-lg-12 col-md-12 col-sm-12">
				<img class="img-responsive" style="max-height:100px !important" src="<?php echo base_url(); ?>assets/img/oi-grey-lg.png">
			</a>
		</div>
		<div id="partner-logos">
		<h2>Launched in partnership with</h2>
			<a href="http://www.africatti.org/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-3 col-md-offset-3">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/atti-logo.jpg">
			</a>
			<a href="http://www.kenyalaw.org/kl/" target="blank" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<img class="img-responsive" src="<?php echo base_url(); ?>assets/img/klr-logo.png" style="margin-top:20px">
			</a>
		</div>
	</div><!-- #partners -->

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
		<div class="col-md-12 col-lg-12" >
	            <?php echo $list; ?>
		</div>
		<div class="col-md-12 col-lg-12 text-center">
		    <?php echo $pages; ?>
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
		<div class="row">
			<div class="col-md-8 col-lg-8 pull-left">
				<h2>Search results for "<strong><?php echo $node_title; ?></strong>"</h2>
				<h6>Click on a node for details</h6>
			</div>
			<!-- Search -->
			<div class="query col-md-4 col-lg-4" style="margin-top:0.8em;">
				<form name="oi" action="<?php echo base_url() . index_page();?>/homes/entitylist" method="post"> 
					<input type="text" name="search_name" value="" placeholder="Search by name, company or organisation" />
					<input type="submit" name="submit" value="Go" class="btn btn-warning" />
				</form>
			</div> <!-- #search -->
		</div>

		<!-- Visualisation -->
		<div id="container_vis" class="row">
			<div id="center-container" class="col-md-12 col-lg-12">
				<canvas id="cy"></canvas>
			</div>

			<a name="data_content"></a>
			<div id="embed-code" class="col-md-5 col-lg-5">
				<!-- Button trigger modal -->
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#embed">Embed visualisation</button>

				<!-- Modal -->
				<div class="modal" id="embed" tabindex="-1" role="dialog" aria-labelledby="embedLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="embedLabel">Embed Visualisation</h4>
				      </div>
				      <div class="modal-body">
				        <p><strong>Cut and paste the following code</strong></p>
						<br />
						<p class="embed">&lt;iframe width="100%" height="100%" src="<?php echo base_url() . index_page();?>/trees/index/<?php echo $nodeid; ?>"&gt;&lt;/iframe&gt;</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				      </div>
				    </div>
				  </div>
				</div>
			</div>

			<div id="right-container-top" class="col-md-offset-0 col-lg-offset-0 hide">
				<a href="#" id="contentdata">
				<img class="switch" id="switch" src="<?php echo base_url(); ?>assets/img/on.png">
				</a>
			</div>	
		</div>
		<div id="right-container" class="hide panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
				<div class="col-md-12 col-lg-12" id="inner_details"></div>
			</div>
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

		
		$("#contentdata").click(function(){	
		
		var src1 = "<?php echo base_url(); ?>assets/img/off.png";
		var src2 = "<?php echo base_url(); ?>assets/img/on.png";
	
		var src = $('#contentdata img').attr('src');

		if(src == src1) {
			$('#contentdata img').attr('src',src2);
			}
		else {
			$('#contentdata img').attr('src',src1);
			}
			$('#right-container').toggle( "slide" );
		});

		$(".embed").click(function(){
		
			$('#embedform').toggle( "slide" );
		});
		
		function NodeStory(nodeid) {
		// abort any pending request
		//alert(nodeid);
	
	
		/*clear result div*/
		$(".inner-details").html('');
		// setuyakuap some local variables


		$.ajax( {
			url: "<?php echo base_url();?>index.php/homes/node_data",
			type: "POST",
			data: {node: nodeid},
			// async: false,
			dataType: "json",
			// contentType: "application/json",
			success:function(d) {
				//alert(d);
				d = JSON.parse(d);
				//  $("#entity_edit").html(data);
				// alert(d.data[1].header[0].Link);

				var target = $('[name=data_content]');
				$('html,body').animate({scrollTop: target.offset().top}, 1000);
				
				l = d.data[1].header[0].Link;
				pn = d.data[1].header[0].Name;
		
				extradata = d.data[0].posts[0].ExtraData;
				extradata = rhtmlspecialchars( extradata );
				//alert(extradata);
				$("#inner_details").html( extradata );
				//$("#inner_details").append( extradata );
				$(".panel-heading").html('<a href="'+ l +'#node">'+ pn +'</a>');
				$('#right-container').removeClass("hide"); 
				$('#right-container-top').removeClass("hide").addClass("col-md-4 col-lg-4");
				  
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
		


</script>

<?php } ?>

