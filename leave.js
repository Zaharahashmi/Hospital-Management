function approveRequest(id) {
	if (confirm("Are you sure you want to approve this leave request?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				location.reload();
			}
		};
		xhr.open("POST", "leave.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send("id=" + id);
	}
}

function rejectRequest(id) {
	if (confirm("Are you sure you want to reject this leave request?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				location.reload();
			}
		}
    }
}
