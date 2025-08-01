@extends('layouts.app')

@section('title', 'API Documentation')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">API Documentation</h3>
                    <p class="text-muted">Test and explore our REST API endpoints</p>
                </div>
                <div class="card-body">
                    <!-- Authentication Section -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">Authentication</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Login</h5>
                                        <span class="badge bg-success">POST</span>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Endpoint:</strong> <code>/api/login</code></p>
                                        <p><strong>Description:</strong> Authenticate user and get access token</p>
                                        
                                        <form id="loginForm" class="mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="test@example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" value="password">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Test Login</button>
                                        </form>
                                        
                                        <div id="loginResponse" class="d-none">
                                            <h6>Response:</h6>
                                            <pre id="loginResponseText" class="bg-light p-3 rounded"></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Register</h5>
                                        <span class="badge bg-success">POST</span>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Endpoint:</strong> <code>/api/register</code></p>
                                        <p><strong>Description:</strong> Create a new user account</p>
                                        
                                        <form id="registerForm" class="mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="John">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="l_name" value="Doe">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="newuser@example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" value="password123">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" name="password_confirmation" value="password123">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Test Register</button>
                                        </form>
                                        
                                        <div id="registerResponse" class="d-none">
                                            <h6>Response:</h6>
                                            <pre id="registerResponseText" class="bg-light p-3 rounded"></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Endpoints Section -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">Data Endpoints</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Get Products</h5>
                                        <span class="badge bg-info">GET</span>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Endpoint:</strong> <code>/api/products</code></p>
                                        <p><strong>Description:</strong> Get all products with pagination</p>
                                        
                                        <button id="testProducts" class="btn btn-info">Test Get Products</button>
                                        
                                        <div id="productsResponse" class="d-none mt-3">
                                            <h6>Response:</h6>
                                            <pre id="productsResponseText" class="bg-light p-3 rounded"></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Get Categories</h5>
                                        <span class="badge bg-info">GET</span>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Endpoint:</strong> <code>/api/categories</code></p>
                                        <p><strong>Description:</strong> Get all product categories</p>
                                        
                                        <button id="testCategories" class="btn btn-info">Test Get Categories</button>
                                        
                                        <div id="categoriesResponse" class="d-none mt-3">
                                            <h6>Response:</h6>
                                            <pre id="categoriesResponseText" class="bg-light p-3 rounded"></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- API Token Section -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">API Token</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Bearer Token (for authenticated requests)</label>
                                    <input type="text" id="apiToken" class="form-control" placeholder="Paste your token here after login">
                                </div>
                                <small class="text-muted">Copy the token from login/register response and paste it here for testing authenticated endpoints.</small>
                            </div>
                        </div>
                    </div>

                                         <!-- Advanced API Tester -->
                     <div class="mb-5">
                         <h4 class="border-bottom pb-2">Advanced API Tester</h4>
                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title">Test Any API Endpoint</h5>
                                 <p class="text-muted">Test any API endpoint with custom parameters</p>
                             </div>
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="mb-3">
                                             <label class="form-label">Endpoint URL:</label>
                                             <input type="text" id="customEndpoint" class="form-control" placeholder="/api/endpoint" value="/api/products">
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="mb-3">
                                             <label class="form-label">HTTP Method:</label>
                                             <select id="customMethod" class="form-select">
                                                 <option value="GET">GET</option>
                                                 <option value="POST">POST</option>
                                                 <option value="PUT">PUT</option>
                                                 <option value="PATCH">PATCH</option>
                                                 <option value="DELETE">DELETE</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 
                                 <div class="mb-3">
                                     <label class="form-label">Request Body (JSON):</label>
                                     <textarea id="customBody" class="form-control" rows="4" placeholder='{"key": "value"}'></textarea>
                                     <small class="text-muted">Enter valid JSON for POST/PUT/PATCH requests</small>
                                 </div>
                                 
                                 <button id="testCustomApi" class="btn btn-primary mb-3">Test API</button>
                                 
                                 <div id="customResponse" class="d-none">
                                     <h6>Response:</h6>
                                     <pre id="customResponseText" class="bg-light p-3 rounded"></pre>
                                 </div>
                             </div>
                         </div>
                     </div>

                    <!-- Usage Examples -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">Usage Examples</h4>
                        <div class="card">
                            <div class="card-body">
                                <h6>cURL Examples:</h6>
                                <div class="mb-3">
                                    <strong>Login:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X POST {{ url('/api/login') }} \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Get Products:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET {{ url('/api/products') }} \
  -H "Accept: application/json"</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Get Categories:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET {{ url('/api/categories') }} \
  -H "Accept: application/json"</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Login Form
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loginResponse').classList.remove('d-none');
            document.getElementById('loginResponseText').textContent = JSON.stringify(data, null, 2);
            
            if (data.token) {
                document.getElementById('apiToken').value = data.token;
            }
        })
        .catch(error => {
            document.getElementById('loginResponse').classList.remove('d-none');
            document.getElementById('loginResponseText').textContent = 'Error: ' + error.message;
        });
    });

    // Register Form
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('registerResponse').classList.remove('d-none');
            document.getElementById('registerResponseText').textContent = JSON.stringify(data, null, 2);
            
            if (data.token) {
                document.getElementById('apiToken').value = data.token;
            }
        })
        .catch(error => {
            document.getElementById('registerResponse').classList.remove('d-none');
            document.getElementById('registerResponseText').textContent = 'Error: ' + error.message;
        });
    });

    // Test Products
    document.getElementById('testProducts').addEventListener('click', function() {
        fetch('/api/products', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('productsResponse').classList.remove('d-none');
            document.getElementById('productsResponseText').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            document.getElementById('productsResponse').classList.remove('d-none');
            document.getElementById('productsResponseText').textContent = 'Error: ' + error.message;
        });
    });

    // Test Categories
    document.getElementById('testCategories').addEventListener('click', function() {
        fetch('/api/categories', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('categoriesResponse').classList.remove('d-none');
            document.getElementById('categoriesResponseText').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            document.getElementById('categoriesResponse').classList.remove('d-none');
            document.getElementById('categoriesResponseText').textContent = 'Error: ' + error.message;
        });
    });

    // Custom API Tester
    document.getElementById('testCustomApi').addEventListener('click', function() {
        const endpoint = document.getElementById('customEndpoint').value;
        const method = document.getElementById('customMethod').value;
        const body = document.getElementById('customBody').value;
        
        const headers = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        const requestOptions = {
            method: method,
            headers: headers
        };

        if (['POST', 'PUT', 'PATCH'].includes(method) && body.trim()) {
            try {
                requestOptions.body = body;
            } catch (e) {
                alert('Invalid JSON in request body');
                return;
            }
        }

        fetch(endpoint, requestOptions)
        .then(response => response.json())
        .then(data => {
            document.getElementById('customResponse').classList.remove('d-none');
            document.getElementById('customResponseText').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            document.getElementById('customResponse').classList.remove('d-none');
            document.getElementById('customResponseText').textContent = 'Error: ' + error.message;
        });
    });
});
</script>
@endsection 