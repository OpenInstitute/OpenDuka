
<div id="api" class="row" style="padding-top: 90px">
  <div class="jumbotron col-lg-12 col-md-12">
    <h1>OpenDuka API</h1>
    <p class="lead">
      OpenDuka API as an extension that gives developers backend access to information
      on Kenyan entities.
    </p>
  </div>
  <div class="row container">
    <div class="signup col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
        <div class="ribbon col-md-3 col-lg-3">
          <h3 class="flag">Sign up for an API key</h3>
        </div>

      <form class="form-horizontal" method="post" action="api/request_key">
        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputEmail">Email</label>
          <div class="controls">
            <input type="text" id="inputEmail" placeholder="Email" name="email">
          </div>
        </div>

        <br />

        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputName">Full Names</label>
          <div class="controls">
            <input type="text" id="inputName" placeholder="Name" name="name">
          </div>
        </div>

        <br />

        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputOrganisation">Organisation</label>
          <div class="controls">
            <input type="text" id="inputOrganisation" placeholder="Organisation" name="organization">
          </div>
        </div>

        <br />

        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputURL">Your application URL</label>
          <div class="controls">
            <input type="url" id="inputURL" placeholder="URL" name="url">
          </div>
        </div>

        <br />

        <div class="control-group">
          <label label-default="label-default" class="control-label label-default" for="inputDesc">Description of your application</label>
          <div class="controls">
            <textarea type="text" id="inputDesc" placeholder="Desc" name="desc" rows="4"></textarea>
          </div>
        </div>
        <br>

        <br />

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-default">Get Key</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
