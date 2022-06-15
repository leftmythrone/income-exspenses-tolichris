
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/Circle.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/layouts/main.css">

    {{-- Partials --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">
    <link rel="stylesheet" href="/css/partials/tables.css">


    {{-- Incomes --}}
    <link rel="stylesheet" href="/css/pages/incomes/incomes.css">
    
    {{-- Outcomes --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">

    {{-- Debts --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">
    

    <link rel="stylesheet" href="boxicons.min.css">

    {{-- JAVA SCRIPT JS --}}
    <link rel="javascript" href="/js/partials/sidebar.js">

    <title>Tolichris | {{ $title }}</title>

  </head>
  <body>
    
      
    <div>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                  <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
          
                          <form class="mx-1 mx-md-4" method="post" action="/emergency/404">
                            
                            @csrf
                            
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example1c" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" required/>
                                <label class="form-label" for="form3Example1c">Your Name</label>
        
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                  </div>
                                @enderror
        
                              </div>
                            </div>
    
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input type="text" id="form3Example1c" name="username" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" required/>
                                <label class="form-label" for="form3Example1c">Username</label>
        
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                  </div>
                                @enderror
        
                              </div>
                            </div>

                                <input type="hidden" id="form3Example1c" name="user_slug" value="                    
                                {{-- RANDOM CREATE SLUG --}}
                                @php
            
                                $catuid = uniqid('gfg', true);
                                echo $catuid;
                                
                                @endphp" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" required/>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input type="password" id="form3Example4c" name="password" class="form-control @error('password')is-invalid @enderror"  required/>
                                <label class="form-label" for="form3Example4c">Password</label>
        
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                  </div>
                                @enderror
        
                              </div>
                            </div>
          
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>
          
                          </form>
          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>

  </body>
</html>


