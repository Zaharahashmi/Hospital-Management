<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="leave.css">
	<script type="text/javascript" src="leave.js"></script>
</head>
<body>
	<h1>Admin Panel</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Reason</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Connect to database
				$con = mysqli_connect("localhost", "root", " ", "leave");
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}

				// Retrieve leave requests
				$result = mysqli_query($con, "SELECT * FROM leave_requests");
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['reason'] . "</td>";
					echo "<td>" . $row['start_date'] . "</td>";
					echo "<td>" . $row['end_date'] . "</td>";
					echo "<td>" . $row['status'] . "</td>";
					echo "<td><button onclick='approveRequest(" . $row['id'] . ")'>Approve</button> <button onclick='rejectRequest(" . $row['id'] . ")'>Reject</button></td>";
					echo "</tr>";
				}

				// Close database connection
				mysqli_close($con);
			?>
		</tbody>
	</table>
</body>
</html>
