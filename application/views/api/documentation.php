<div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav affix">
          <li class="active"><a href="#keys"><i class="icon-chevron-right"></i> API Key</a></li>
          <li><a href="#searchbyname"><i class="icon-chevron-right"></i> Search By Name</a></li>
          <li><a href="#retrievebyid"><i class="icon-chevron-right"></i> Retrieve Entity By ID</a></li>
          
        </ul>
      </div>
      <div class="span9">
        <section id="keys">
          <div class="page-header">
            <h1>API Key</h1>
            To be able to use OpenDuka's API you need an API key. You can sign up for a key <a href="<?php echo base_url();?>index.php/api">here</a>.<br />
            Please note that you can only have one API key per app - where an app is defined as the root URL of your application that uses this API. <br />
            
          </div>
		</section>
		<section id="searchbyname">
			 <div class="page-header">
            <h1>Search Entity by Name</h1>
          </div>
			<pre><?php echo base_url().'index.php/api/search?key={YOUR - API - KEY}&term={YOUR SEARCH TERM}';?>
			</pre>
			The above query returns a list of results like so:
			<br /> A search for moi outputs:
			<pre>[{"ID":"120","Name":"Betty Chepkemoi Koech (ms.): Resident Magistrate At Mombasa ","EntityTypeID":"22","EntityContext":"","DocID":"||682","EntityMap":"||119","EntityOrganisation":"","EffectiveDate":"1\/01\/2012 : ","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"7","EntryDate":"0000-00-00 00:00:00"},{"ID":"183","Name":"Beatrice Moige Gisemba","EntityTypeID":"22","EntityContext":"","DocID":"||688","EntityMap":"||169","EntityOrganisation":"","EffectiveDate":"09\/02\/2010 : 2013","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"2","EntryDate":"0000-00-00 00:00:00"},{"ID":"329","Name":"Moi Teaching And Referral Hospital Board","EntityTypeID":"21","EntityContext":"","DocID":"||730","EntityMap":"||330||331||332||333||334||335","EntityOrganisation":"","EffectiveDate":"1\/12\/2011 : 1\/12\/2016","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"0","Appointer":"P. A. Nyong\u2019o: Minister For Medical Services.","UserID":"7","EntryDate":"0000-00-00 00:00:00"},{"ID":"380","Name":"Cllr. Julia Lochingamoi","EntityTypeID":"22","EntityContext":"","DocID":"||733","EntityMap":"||378","EntityOrganisation":"","EffectiveDate":"6\/12\/2011 : 6\/12\/2014","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"7","EntryDate":"0000-00-00 00:00:00"},{"ID":"1571","Name":"Richardmoitalel Ole Kenta","EntityTypeID":"22","EntityContext":"","DocID":"||961","EntityMap":"||1570","EntityOrganisation":"","EffectiveDate":"13 MARCH 2009 : 13 MARCH 2012","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"13","EntryDate":"2013-07-16 05:03:30"},{"ID":"1771","Name":"Nicholas Ole Moipei","EntityTypeID":"22","EntityContext":"","DocID":"||1000","EntityMap":"||1768","EntityOrganisation":"","EffectiveDate":"1MARCH 2009 : ","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"13","EntryDate":"2013-07-17 05:16:07"},{"ID":"2146","Name":"Moi Teaching And Referral Hospital","EntityTypeID":"21","EntityContext":"","DocID":"||1076","EntityMap":"||2147||2148||2149","EntityOrganisation":"","EffectiveDate":"5\/05\/2011 : 5\/05\/2016","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"0","Appointer":"P. A. Nyong\u2019o: Minister For Medical Services","UserID":"7","EntryDate":"2013-07-18 04:51:36"},{"ID":"2163","Name":"Moi Teaching And Referal Hospital Board","EntityTypeID":"22","EntityContext":"","DocID":"||1080","EntityMap":"||2164||2165","EntityOrganisation":"","EffectiveDate":"23 APRIL 2009 : ","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"0","Appointer":"P. A. Ngongo'o; Minister For Medical Services","UserID":"13","EntryDate":"2013-07-18 06:10:36"}]
			</pre>
		</section>	
		<section id="retrievebyid">
			<div class="page-header">
            <h1>Retrieve by ID</h1>
          </div>
          You can retrieve information on a particular entry by passing an id of an entity as a parameter as 
			follows:
			<pre><?php echo base_url().'index.php/api/entity?key={YOUR - API - KEY}&id={ID OF ENTITY}';?>
			</pre>
			The above query returns a list of results like so:
			<pre>
				
[{"ID":"120","Name":"Betty Chepkemoi Koech (ms.): Resident Magistrate At Mombasa ","EntityTypeID":"22","EntityContext":"","DocID":"||682","EntityMap":"||119","EntityOrganisation":"","EffectiveDate":"1\/01\/2012 : ","GazetteDate":"","GazetteAppointer":"","GazetteOffice":"","UniqueInfo":"","Verb":"appointed","Appointer":"","UserID":"7","EntryDate":"0000-00-00 00:00:00"}]
			</pre>
		</section>
      </div>
	</div>