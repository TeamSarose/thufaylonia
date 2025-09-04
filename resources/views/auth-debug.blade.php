<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Debugging</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Authentication Debugging Tools</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Test User Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('auth.debug.test') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Test Authentication</button>
                        </form>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h4>Reset User Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('auth.debug.fix') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Authentication Test Results</h4>
                    </div>
                    <div class="card-body">
                        @if(isset($results))
                            <h5>Test Results for {{ $tested_user->email }}</h5>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th>Test</th>
                                    <th>Result</th>
                                </tr>
                                <tr>
                                    <td>Auth::attempt</td>
                                    <td>
                                        @if($results['auth_attempt'])
                                            <span class="text-success">Success</span>
                                        @else
                                            <span class="text-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hash::check</td>
                                    <td>
                                        @if($results['hash_check'])
                                            <span class="text-success">Success</span>
                                        @else
                                            <span class="text-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>password_verify</td>
                                    <td>
                                        @if($results['password_verify'])
                                            <span class="text-success">Success</span>
                                        @else
                                            <span class="text-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Direct comparison</td>
                                    <td>
                                        @if($results['direct_compare'])
                                            <span class="text-success">Success</span> (Warning: Password may not be hashed)
                                        @else
                                            <span class="text-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            
                            <h5 class="mt-4">Password Details</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Detail</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>Password Length</td>
                                    <td>{{ $results['password_length'] }}</td>
                                </tr>
                                <tr>
                                    <td>Hash Algorithm</td>
                                    <td>{{ $results['password_algorithm'] ?: 'Unknown/Not hashed' }}</td>
                                </tr>
                                <tr>
                                    <td>DB vs Model Match</td>
                                    <td>
                                        @if(isset($results['model_vs_db_match']))
                                            {{ $results['model_vs_db_match'] ? 'Yes' : 'No' }}
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="alert {{ $results['can_fix_auth'] ? 'alert-success' : 'alert-danger' }} mt-4">
                                @if($results['can_fix_auth'])
                                    This authentication issue can be fixed. Use the reset form to update the password.
                                @else
                                    The provided password doesn't match any authentication method. You may need to reset the password.
                                @endif
                            </div>
                        @else
                            <div class="alert alert-info">
                                No test has been performed yet. Use the form to test user authentication.
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Registered Users</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
