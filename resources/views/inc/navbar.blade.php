<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">{{config("app.name")}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-item nav-link active" href="{{ url('/')}}">Home</a></li>
            </ul>
        
            <ul class="navbar-nav ml-auto">
                <li><createlogger></createlogger></li>
            </ul>
      </div>
    </nav>

<br>