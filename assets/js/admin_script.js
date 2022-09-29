// detail mapel mentor
function selectMentor1(id_mapels) {
	var id_mapel = $('#id_mapel'+id_mapels).val();
	var csrfName = $('#csrf').attr('name');
	var csrfHash = $('#csrf').val();
	$('#detail-mentor'+id_mapels).text('');
	$(document).ready(function() {
		$.ajax({
			url: base_url,
			method: 'post',
			data: {
				[csrfName]: csrfHash,
				mapel: id_mapel
			},
			dataType: 'json',
			success: function(rsp) {
				var len = rsp.data.length;
				if (len > 0) {
					rsp.data.map((gr) => {
						$('#detail-mentor'+id_mapels).append(`
						<option value="${gr.id}">${gr.nama}</option>
						`);
					});
				} else {
					$('#detail-mentor'+id_mapels).append('<option selected value="0">Pilih Mentor</option>');
				}
				$('#csrf').val(rsp.valC);
				$('#csrf'+id_mapels).val(rsp.valC);
			},
			error: function(error) {
				console.log(error);
			}
		});
	})
}
function selectMentor() {
	var id_mapel = $('#id_mapel').val();
	var csrfName = $('#csrf').attr('name');
	var csrfHash = $('#csrf').val();
	$('#detail-mentor').text('');
	$(document).ready(function() {
		$.ajax({
			url: base_url,
			method: 'post',
			data: {
				[csrfName]: csrfHash,
				mapel: id_mapel
			},
			dataType: 'json',
			success: function(rsp) {
				var len = rsp.data.length;
				if (len > 0) {
					rsp.data.map((gr) => {
						$('#detail-mentor').append(`
						<option value="${gr.id}">${gr.nama}</option>
						`);
					});
				} else {
					$('#detail-mentor').append('<option selected value="0">Pilih Mentor</option>');
				}
				$('#csrf').val(rsp.valC);
				$('#csrf').val(rsp.valC);
			},
			error: function(error) {
				console.log(error);
			}
		});
	})
}
// hapus kelas
function hapusKelas(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Kelas <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// hapus jadwal
function hapusJadwal(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Jadwal <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// hapus marketing
function hapusMarketing(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Marketing <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// hapus mapel
function hapusMapel(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Mata Pelajaran <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// hapus lokasi internasional
function hapusLokInt(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Lokasi <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// hapus santri
function hapusSantri(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin menghapus Santri <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}

// logout
function logout(url) {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
		  confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		  cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
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
}
// hapus guru
function hapusMentor(nama, url) {
	const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-mapel text-white px-4 mx-1',
		cancelButton: 'btn btn-danger btn-batal px-4 mx-1'
	},
		buttonsStyling: false
	});

	swalWithBootstrapButtons.fire({
		title: 'Anda Yakin?',
		html: "Ingin Menghapus Data Mentor <b>" + nama + "</b>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Ya',
  		cancelButtonText: 'Batal',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}
// set datatable
$(document).ready(function () {
    $('#mapel').DataTable();
});
// // mark pada saat search data
// function search(nips, namas, departs, searched) {
// 	let nip = document.getElementById(nips).innerHTML;
// 	let nama = document.getElementById(namas).innerHTML;
// 	let depart = document.getElementById(departs).innerHTML;

// 	let re = new RegExp(searched, "g"); // search for all instances

// 	let newNip = nip.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);
// 	let newNama = nama.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);
// 	let newDepart = depart.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);

// 	document.getElementById(nips).innerHTML = newNip;
// 	document.getElementById(namas).innerHTML = newNama;
// 	document.getElementById(departs).innerHTML = newDepart;
// }
// // format number pada input text
// document.querySelectorAll("#gapok").forEach(
// 	(inp) =>
// 		new Cleave(inp, {
// 			numeral: true,
// 			numeralDecimalMark: "thousand",
// 			delimiter: ".",
// 		})
// );

document.addEventListener("DOMContentLoaded", function (event) {
	const showNavbar = (toggleId, navId, bodyId, headerId) => {
		const toggle = document.getElementById(toggleId),
			nav = document.getElementById(navId),
			bodypd = document.getElementById(bodyId),
			headerpd = document.getElementById(headerId);

		// Validate that all variables exist
		if (toggle && nav && bodypd && headerpd) {
			toggle.addEventListener("click", () => {
				// show navbar
				nav.classList.toggle("shows");
				// change icon
				toggle.classList.toggle("bx-x");
				// add padding to body
				bodypd.classList.toggle("body-pd");
				// add padding to header
				headerpd.classList.toggle("body-pd");
			});
		}
	};

	showNavbar("header-toggle", "nav-bar", "body-pd", "header");

	/*===== LINK ACTIVE =====*/
	// const linkColor = document.querySelectorAll(".nav_link");

	// function colorLink() {
	// 	if (linkColor) {
	// 		linkColor.forEach((l) => l.classList.remove("active"));
	// 		this.classList.add("active");
	// 	}
	// }
	// linkColor.forEach((l) => l.addEventListener("click", colorLink));

	// Your code to run since DOM is loaded and ready
});
