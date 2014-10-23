<div class="container">
	<div class="row documentation">
		<div class="bs-docs-sidebar col-md-3 col-lg-3">
			<ul class="nav nav-list bs-docs-sidenav affix">
				<li class="active"><a href="#keys"><i class="fa fa-chevron-right"></i> API Key</a></li>
				<li><a href="#searchbyname"><i class="fa fa-chevron-right"></i> Search By Name</a></li>
				<li><a href="#retrievebyid"><i class="fa fa-chevron-right"></i> Retrieve Entity By ID</a></li>
			</ul>
		</div>
		<div class="col-md-9 col-lg-9">
			<section id="keys">
				<div class="page-header">
					<h1>API Key</h1>
					<p>
					To be able to use OpenDuka's API you need an API key. You can sign up for a key <a href="&lt;?php echo base_url();?&gt;index.php/api">here</a>.<br>
					Please note that you can only have one API key per app - where an app is defined as the root URL of your application that uses this API. <br>
					</p>
				</div>
			</section>
			<section id="searchbyname">
				<div class="page-header">
					<h1>Search Entity by Name</h1>
				</div>
				<pre><?php echo base_url(). index_page() ?>/api/search?key={YOUR - API - KEY}&term={YOUR SEARCH TERM}</pre>
				The above query returns a list of results like so:
				<br> A search for <b>moi</b> outputs:
				<pre>[{"ID":"120","Name":"Betty Chepkemoi Koech (ms.)"},{"ID":"183","Name":"Beatrice Moige Gisemba"},{"ID":"329","Name":"Moi Teaching And Referral Hospital Board"},{"ID":"380","Name":"Cllr. Julia Lochingamoi"},{"ID":"1571","Name":"Richardmoitalel Ole Kenta"},{"ID":"1771","Name":"Nicholas Ole Moipei"},{"ID":"2146","Name":"Moi Teaching And Referral Hospital"},{"ID":"2163","Name":"Moi Teaching And Referal Hospital Board"},{"ID":"3405","Name":"MOI UNIVERSITY"},{"ID":"3442","Name":"MOI TEACHING REFFERAL HOSPITAL"},{"ID":"3443","Name":"OPG MOI TEACHING REFFERAL HOSPITAL"}]
				</pre>
			</section>	
			<section id="retrievebyid">
				<div class="page-header">
					<h1>Retrieve by ID</h1>
				</div>
				You can retrieve information on a particular entry by passing an id of an entity as a parameter as follows:
				<pre><?php echo base_url(). index_page()?>/api/entity?key={YOUR - API - KEY}&id={ID OF ENTITY};</pre>
				The above query returns a list of results like so:
				<pre>[{"data":[{"dataset_type":[{"Gazette": [{"dataset":[{"Name":"National Council for Law Reporting","Name2":"Christine Agimba","Gazette_Number":"2013_GAZ8654","EffectiveDate":"10\/02\/13 : 10\/02\/16","Action":"0","Appointer":"Githu Muigai - Attorney General","Name_E_":"40","Name2_E_":"41"},{"Name":"Christine Agimba","Name2":"National Council for Law Reporting","Gazette_Number":"2013_GAZ8654","EffectiveDate":"10\/02\/13 : 10\/02\/16","Action":"appointed","Appointer":"","Name_E_":"41","Name2_E_":"40"}]}]}]}]}]</pre>
			</section>
			<div class="row"></div>
		</div>
	</div>
</div>
