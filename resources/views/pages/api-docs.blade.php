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

                     <!-- Vendor Endpoints Section -->
                     <div class="mb-5">
                         <h4 class="border-bottom pb-2">Vendor Endpoints</h4>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="card">
                                     <div class="card-header">
                                         <h5>Get Vendors</h5>
                                         <span class="badge bg-info">GET</span>
                                     </div>
                                     <div class="card-body">
                                         <p><strong>Endpoint:</strong> <code>/api/vendors</code></p>
                                         <p><strong>Description:</strong> Get all vendors/shops with filtering options</p>
                                         <p><strong>Query Parameters:</strong></p>
                                         <ul class="small">
                                             <li><code>category</code> - Filter by category slug</li>
                                             <li><code>post_city</code> - Filter by location</li>
                                             <li><code>state</code> - Filter by state</li>
                                             <li><code>type=liked</code> - Get liked vendors (requires auth)</li>
                                             <li><code>per_page</code> - Items per page (default: 12)</li>
                                         </ul>
                                         
                                         <button id="testVendors" class="btn btn-info">Test Get Vendors</button>
                                         
                                         <div id="vendorsResponse" class="d-none mt-3">
                                             <h6>Response:</h6>
                                             <pre id="vendorsResponseText" class="bg-light p-3 rounded"></pre>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             
                             <div class="col-md-6">
                                 <div class="card">
                                     <div class="card-header">
                                         <h5>Get Vendor Details</h5>
                                         <span class="badge bg-info">GET</span>
                                     </div>
                                     <div class="card-body">
                                         <p><strong>Endpoint:</strong> <code>/api/vendors/{slug}</code></p>
                                         <p><strong>Description:</strong> Get specific vendor details with products</p>
                                         
                                         <div class="mb-3">
                                             <label class="form-label">Vendor Slug:</label>
                                             <input type="text" id="vendorSlug" class="form-control" placeholder="vendor-slug" value="test-vendor">
                                         </div>
                                         
                                         <button id="testVendorDetails" class="btn btn-info">Test Get Vendor Details</button>
                                         
                                         <div id="vendorDetailsResponse" class="d-none mt-3">
                                             <h6>Response:</h6>
                                             <pre id="vendorDetailsResponseText" class="bg-light p-3 rounded"></pre>
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

                    <!-- API Documentation -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-2">API Documentation</h4>
                        
                        <!-- Authentication Documentation -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Authentication</h5>
                            </div>
                            <div class="card-body">
                                <p>Our API uses Laravel Sanctum for authentication. After login/register, you'll receive a Bearer token that should be included in subsequent requests.</p>
                                
                                <h6>Headers for Authenticated Requests:</h6>
                                <pre class="bg-light p-2 rounded"><code>Authorization: Bearer YOUR_TOKEN_HERE
Accept: application/json
Content-Type: application/json</code></pre>
                                
                                <h6>Response Format:</h6>
                                <pre class="bg-light p-2 rounded"><code>{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com",
    "role_id": 2
  },
  "token": "1|abc123...",
  "role_id": 2
}</code></pre>
                            </div>
                        </div>

                        <!-- Endpoints Documentation -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Available Endpoints</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Method</th>
                                                <th>Endpoint</th>
                                                <th>Description</th>
                                                <th>Auth Required</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge bg-success">POST</span></td>
                                                <td><code>/api/login</code></td>
                                                <td>User authentication</td>
                                                <td>No</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-success">POST</span></td>
                                                <td><code>/api/register</code></td>
                                                <td>User registration</td>
                                                <td>No</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-info">GET</span></td>
                                                <td><code>/api/products</code></td>
                                                <td>Get all products</td>
                                                <td>No</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-info">GET</span></td>
                                                <td><code>/api/categories</code></td>
                                                <td>Get all categories</td>
                                                <td>No</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-info">GET</span></td>
                                                <td><code>/api/vendors</code></td>
                                                <td>Get all vendors</td>
                                                <td>No</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-info">GET</span></td>
                                                <td><code>/api/vendors/{slug}</code></td>
                                                <td>Get vendor details</td>
                                                <td>No</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Query Parameters Documentation -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Query Parameters</h5>
                            </div>
                            <div class="card-body">
                                <h6>Vendors Endpoint Parameters:</h6>
                                <ul>
                                    <li><code>category</code> - Filter vendors by category slug</li>
                                    <li><code>post_city</code> - Filter by location (post code or city)</li>
                                    <li><code>state</code> - Filter by state</li>
                                    <li><code>type=liked</code> - Get liked vendors (requires authentication)</li>
                                    <li><code>per_page</code> - Number of items per page (default: 12)</li>
                                </ul>

                                <h6>Products Endpoint Parameters:</h6>
                                <ul>
                                    <li><code>page</code> - Page number for pagination</li>
                                    <li><code>per_page</code> - Items per page</li>
                                </ul>

                                <h6>Example with Parameters:</h6>
                                <pre class="bg-light p-2 rounded"><code>GET /api/vendors?category=electronics&post_city=london&per_page=20</code></pre>
                            </div>
                        </div>

                        <!-- Response Formats -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Response Formats</h5>
                            </div>
                            <div class="card-body">
                                <h6>Product Response:</h6>
                                <pre class="bg-light p-2 rounded"><code>{
  "data": [
    {
      "id": 1,
      "name": "Product Name",
      "slug": "product-slug",
      "image": "path/to/image.jpg",
      "images": ["image1.jpg", "image2.jpg"],
      "price": "99.99",
      "sale_price": "79.99",
      "shop": {
        "id": 1,
        "name": "Shop Name"
      },
      "categories": [...],
      "description": "Product description",
      "short_description": "Short description",
      "views": 150
    }
  ],
  "links": {...},
  "meta": {...}
}</code></pre>

                                <h6>Vendor Response:</h6>
                                <pre class="bg-light p-2 rounded"><code>{
  "data": [
    {
      "id": 1,
      "name": "Vendor Name",
      "slug": "vendor-slug",
      "description": "Vendor description",
      "logo": "path/to/logo.jpg",
      "banner": "path/to/banner.jpg",
      "address": "Vendor address",
      "city": "City",
      "state": "State",
      "post_code": "12345",
      "phone": "+1234567890",
      "email": "vendor@example.com",
      "status": 1,
      "rating": 4.5,
      "total_products": 25,
      "products": [...],
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}</code></pre>
                            </div>
                        </div>

                        <!-- Error Handling -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Error Handling</h5>
                            </div>
                            <div class="card-body">
                                <p>All API endpoints return appropriate HTTP status codes and error messages.</p>
                                
                                <h6>Common Status Codes:</h6>
                                <ul>
                                    <li><code>200</code> - Success</li>
                                    <li><code>201</code> - Created (for registration)</li>
                                    <li><code>400</code> - Bad Request (validation errors)</li>
                                    <li><code>401</code> - Unauthorized</li>
                                    <li><code>404</code> - Not Found</li>
                                    <li><code>422</code> - Validation Error</li>
                                    <li><code>500</code> - Server Error</li>
                                </ul>

                                <h6>Error Response Format:</h6>
                                <pre class="bg-light p-2 rounded"><code>{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}</code></pre>
                            </div>
                        </div>

                        <!-- Rate Limiting -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Rate Limiting</h5>
                            </div>
                            <div class="card-body">
                                <p>API requests are rate-limited to ensure fair usage:</p>
                                <ul>
                                    <li><strong>Guest users:</strong> 60 requests per minute</li>
                                    <li><strong>Authenticated users:</strong> 120 requests per minute</li>
                                    <li><strong>Authentication endpoints:</strong> 5 requests per minute</li>
                                </ul>
                                
                                <p>Rate limit headers are included in responses:</p>
                                <pre class="bg-light p-2 rounded"><code>X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1640995200</code></pre>
                            </div>
                        </div>

                        <!-- Usage Examples -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Usage Examples</h5>
                            </div>
                            <div class="card-body">
                                <h6>cURL Examples:</h6>
                                <div class="mb-3">
                                    <strong>Login:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X POST {{ url('/api/login') }} \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Register:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X POST {{ url('/api/register') }} \
  -H "Content-Type: application/json" \
  -d '{"name":"John","l_name":"Doe","email":"newuser@example.com","password":"password123","password_confirmation":"password123"}'</code></pre>
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
                                <div class="mb-3">
                                    <strong>Get Vendors:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET {{ url('/api/vendors') }} \
  -H "Accept: application/json"</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Get Vendors with Filters:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET "{{ url('/api/vendors') }}?category=electronics&post_city=london&per_page=20" \
  -H "Accept: application/json"</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Get Vendor Details:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET {{ url('/api/vendors/vendor-slug') }} \
  -H "Accept: application/json"</code></pre>
                                </div>
                                <div class="mb-3">
                                    <strong>Authenticated Request:</strong>
                                    <pre class="bg-light p-2 rounded"><code>curl -X GET {{ url('/api/vendors') }} \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"</code></pre>
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

    // Test Vendors
    document.getElementById('testVendors').addEventListener('click', function() {
        fetch('/api/vendors', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('vendorsResponse').classList.remove('d-none');
            document.getElementById('vendorsResponseText').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            document.getElementById('vendorsResponse').classList.remove('d-none');
            document.getElementById('vendorsResponseText').textContent = 'Error: ' + error.message;
        });
    });

    // Test Vendor Details
    document.getElementById('testVendorDetails').addEventListener('click', function() {
        const slug = document.getElementById('vendorSlug').value;
        fetch(`/api/vendors/${slug}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('vendorDetailsResponse').classList.remove('d-none');
            document.getElementById('vendorDetailsResponseText').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            document.getElementById('vendorDetailsResponse').classList.remove('d-none');
            document.getElementById('vendorDetailsResponseText').textContent = 'Error: ' + error.message;
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