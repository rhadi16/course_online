$("#logout").on("click", function () {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-primary px-4 mx-1',
		cancelButton: 'btn btn-outline-warning px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: "Anda Yakin?",
		html: "Ingin <b>Logout</b>?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
});

// set datatable
$(document).ready(function () {
    $('#list-santri').DataTable();
});

var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
menu_btn.addEventListener("click", () => {
	sidebar.classList.toggle("active-nav");
	container.classList.toggle("active-cont");
});
