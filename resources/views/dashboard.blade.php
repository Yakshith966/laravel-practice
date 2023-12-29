<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      $isAuthenticated = Auth::guard('job')->check();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if (Auth::guard('job')->check())
    <a href="{{ route('logout') }}">Logout</a>  
    @else
    <div style="margin-left: 80%">
    <button class="btn btn-primary"><a style="color: white;text-decoration: none;" href="{{ route('login') }}">Login</a> </button>
    <button class="btn btn-primary"><a  style="color: white;text-decoration: none;" href="{{ route('register') }}">Register  </a> </button>
</div>
    @endif
   

    @foreach ($jobs as $job)
        <h1>{{$job->title}}</h1>
        <h4>{{$job->desc}}</h4>
        <h4>{{$job->req}}</h4>
      @if (Auth::guard('job')->check())
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal{{$job->id}}" >
        Apply
    </button>
    @else
    <a type="button" class="btn btn-primary" href="/login">
        Apply
    </a>
      @endif
       
        <br><br>

        <!-- Modal -->
       
        <div class="modal fade" id="applyModal{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">Apply for {{$job->title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your application form goes here -->
                        <form action="{{ route('submit-application') }}" method="post">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <h1>{{session('loginId')}}</h1>
                            <input type="hidden" name="candidate_id" value="{{ optional($loggedInUser)->id }}">
                        
                            <label for="resume">Upload Resume:</label>
                            <input type="text" name="resume" id="resume" required>
                            <br>
                            <label for="exp">Exp:</label>
                            <input type="text" name="exp" id="exp" required>
                            <br>
                            <label for="notice">Notice period:</label>
                            <input type="text" name="notice" id="notice" required>
                            <br>
                            <label for="status">Status:</label>
                            <select name="status" id="status" required>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Bootstrap JS (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
