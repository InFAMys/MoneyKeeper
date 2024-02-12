//TAMBAH MODAL
var tambahBtn = document.getElementsByClassName("tambahBtn");
var closeButtons = document.getElementsByClassName("closeT");

function openModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";
}

function closeModal() {
  var modals = document.getElementsByClassName("modal");
  for (var i = 0; i < modals.length; i++) {
    modals[i].style.display = "none";
  }
}

for (var i = 0; i < tambahBtn.length; i++) {
  tambahBtn[i].addEventListener("click", function () {
    var modalId = this.getAttribute("data-modal-id");
    openModal(modalId);
  });
}

for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].onclick = closeModal;
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  if (event.target.classList.contains("modal")) {
    closeModal();
  }
};

//EDIT MODAL
var editBtn = document.getElementsByClassName("editBtn");
var closeButtons = document.getElementsByClassName("closeEd");

function openModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";
}

function closeModal() {
  var modals = document.getElementsByClassName("modal");
  for (var i = 0; i < modals.length; i++) {
    modals[i].style.display = "none";
  }
}

for (var i = 0; i < editBtn.length; i++) {
  editBtn[i].addEventListener("click", function () {
    var modalId = this.getAttribute("data-modal-id");
    openModal(modalId);
  });
}

for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].onclick = closeModal;
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  if (event.target.classList.contains("modal")) {
    closeModal();
  }
};

//DELETE MODAL
var deleteBtn = document.getElementsByClassName("deleteBtn");
var closeButtons = document.getElementsByClassName("closeDel");

function openModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";
}

function closeModal() {
  var modals = document.getElementsByClassName("modal");
  for (var i = 0; i < modals.length; i++) {
    modals[i].style.display = "none";
  }
}

for (var i = 0; i < deleteBtn.length; i++) {
  deleteBtn[i].addEventListener("click", function () {
    var modalId = this.getAttribute("data-modal-id");
    openModal(modalId);
  });
}

for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].onclick = closeModal;
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  if (event.target.classList.contains("modal")) {
    closeModal();
  }
};
