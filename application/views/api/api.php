<div class="row">
  <div class="jumbotron">
    <h1>OpenDuka API</h1>
    <p class="lead">
      OpenDuka API as an extension gives developers backend access to information
      on Kenyan entities.
    </p>
  </div>
  <div class="row">
    <div class="signup col-md-12 col-lg-12">
      <form class="form-horizontal" method="post" action="api/request_key">
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputEmail">Email</label>
          <div class="controls">
            <input type="text" id="inputEmail" placeholder="Email" name="email">
          </div>
        </div>
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputName">Full Names</label>
          <div class="controls">
            <input type="text" id="inputName" placeholder="Name" name="name">
          </div>
        </div>
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputOrganisation">Organisation</label>
          <div class="controls">
            <input type="text" id="inputOrganisation" placeholder="Organisation" name="organization">
          </div>
        </div>
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputURL">Your application URL</label>
          <div class="controls">
            <input type="url" id="inputURL" placeholder="URL" name="url">
          </div>
        </div>
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputDesc">Description of your application</label>
          <div class="controls">
            <textarea type="text" id="inputDesc" placeholder="Desc" name="desc" rows="4"></textarea>
          </div>
        </div>
        <br>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-default">Get Key</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>