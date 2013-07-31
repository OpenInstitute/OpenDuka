
 <div class="jumbotron">
        <h1>OpenDuka API</h1>
        <p class="lead">
        	OpenDuka API as an extension gives developers backend access to information on all Kenyan registered companies. 
        </p>
        
      </div>
      <style>
      .signup{
      	position: relative;
margin: 15px 0;
padding: 39px 19px 14px;
background-color: #fff;
border: 1px solid #ddd;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
      }
      .signup:after{
      	content: "Signup for API key";
position: absolute;
top: -1px;
left: -1px;
padding: 3px 7px;
font-size: 12px;
font-weight: bold;
background-color: #f5f5f5;
border: 1px solid #ddd;
color: #9da0a4;
-webkit-border-radius: 4px 0 4px 0;
-moz-border-radius: 4px 0 4px 0;
border-radius: 4px 0 4px 0;
      }
      </style>
<div class="row-fluid">
   <div class="signup span12">
<form class="form-horizontal" method="post" action="api/request_key">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Email" name="email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputName">Full Names</label>
    <div class="controls">
      <input type="text" id="inputName" placeholder="Name" name="name">
    </div>
  </div>
<div class="control-group">
    <label class="control-label" for="inputOrganisation">Organisation</label>
    <div class="controls">
      <input type="text" id="inputOrganisation" placeholder="Organisation" name="organization">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputURL">Your application URL</label>
    <div class="controls">
      <input type="text" id="inputURL" placeholder="URL" name="url">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="inputDesc">Description of your application</label>
    <div class="controls">
      <textarea type="text" id="inputDesc" placeholder="Desc" name="desc"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Get Key</button>
    </div>
  </div>
</form>
</div>


</div>