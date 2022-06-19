<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{asset('landingpage/img/logo_g.png')}}" rel="icon">
  </head>
  <body>
    <br>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 align="center">Uh-Oh, Access Denied (403)</h1>
         </div>
        </div>
        <div class="row">
            <div class="col-12">
              <img width="30%" src="{{asset('landingpage/img/denied.jpg')}}" alt="Access Denied" class="rounded mx-auto d-block">
           </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h3 align="center">You Dont Have a Access To This Page!</h3>
           </div>
          </div>
          <br>
          <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <center>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="/" class="btn btn-info me-2" type="button">Landingpage</a>
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
                </center>
              </div>
          </div>
      </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
