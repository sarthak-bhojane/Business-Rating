<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Business Listing</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Raty -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raty/3.0.0/jquery.raty.js"></script>

</head>
<body class="container mt-5">

<h2>Business Listing</h2>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#businessModal">
    Add Business
</button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
            <th>Average Rating</th>
        </tr>
    </thead>
    <tbody id="businessTable">
        <?php
        $result = $conn->query("SELECT * FROM businesses");
        while($row = $result->fetch_assoc()):
        ?>
        <tr id="row_<?php echo $row['id']; ?>">
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $row['id']; ?>">Delete</button>
            </td>
            <td>
                <div class="rating" data-id="<?php echo $row['id']; ?>"></div>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- ================= BUSINESS MODAL ================= -->

<div class="modal fade" id="businessModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="businessForm">
          <input type="hidden" id="business_id">

          <div class="mb-3">
            <label>Name</label>
            <input type="text" id="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Address</label>
            <input type="text" id="address" class="form-control">
          </div>

          <div class="mb-3">
            <label>Phone</label>
            <input type="text" id="phone" class="form-control">
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" id="email" class="form-control">
          </div>

          <button type="button" id="saveBusiness" class="btn btn-success">
            Save
          </button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- ================= RATING MODAL ================= -->

<div class="modal fade" id="ratingModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Submit Rating</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="ratingForm">
          <input type="hidden" id="rating_business_id">
          <input type="hidden" id="rating_score">

          <div class="mb-3">
            <label>Name</label>
            <input type="text" id="rating_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" id="rating_email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Phone</label>
            <input type="text" id="rating_phone" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Rating</label>
            <p id="rating_display"></p>
          </div>

          <button type="button" id="submitRating" class="btn btn-success">
            Submit Rating
          </button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="assets/js/main.js"></script>

</body>
</html>