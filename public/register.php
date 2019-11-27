<?php include '../private/shared/header.php' ?>
<div class="container mt-5 mb-5">
<form>
    <h3>Register as Member</h3><hr><br>

  <div class="form-row mt-2 mb-3">
    <div class="col">
    <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" placeholder="First name">
    </div>
    <div class="col">
    <label for="inputEmail4">Last Name</label>
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>
  <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <!-- <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div> -->
  <div class="form-row">
    <!-- <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div> -->
    <div class="form-group col-md-4">
      <label for="inputState">Gender</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>Women</option>
        <option>Men</option>
        <option>Other</option>
        <option>Prefer not to say</option>
      </select>
      <small class="form-text text-muted">For women's and men's competitions</small>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Date of Birth</label>
      <input type="text" class="form-control" id="inputZip">
      <small class="form-text text-muted">In the format DD/MM/YY</small>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Keep me logged in
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
</div>
