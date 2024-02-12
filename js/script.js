//FORMAT TAMPILAN DEBIT
let d = document.querySelectorAll(".fDebit");

for (let i = 0, lend = d.length; i < lend; i++) {
  let num = Number(d[i].innerHTML).toLocaleString("en");
  let ds = num.replace(/\,/g, ".");
  d[i].innerHTML = ds;
  d[i].classList.add("currSign");
}

//FORMAT TAMPILAN KREDIT
let k = document.querySelectorAll(".fKredit");

for (let j = 0, lenk = k.length; j < lenk; j++) {
  let num = Number(k[j].innerHTML).toLocaleString("en");
  let ks = num.replace(/\,/g, ".");
  k[j].innerHTML = ks;
  k[j].classList.add("currSign");
}

//ADD MODAL
var editBtn = document.getElementsByClassName("addBtn");
var closeButtons = document.getElementsByClassName("closeAdd");

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
var noButtons = document.getElementsByClassName("noButtons");

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

for (var i = 0; i < noButtons.length; i++) {
  noButtons[i].onclick = closeModal;
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  if (event.target.classList.contains("modal")) {
    closeModal();
  }
};

//LOGOUT MODAL
var outBtn = document.getElementsByClassName("outBtn");
var closeButtons = document.getElementsByClassName("closeOut");
var noButtons = document.getElementsByClassName("noButtons");

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

for (var i = 0; i < outBtn.length; i++) {
  outBtn[i].addEventListener("click", function () {
    var modalId = this.getAttribute("data-modal-id");
    openModal(modalId);
  });
}

for (var i = 0; i < closeButtons.length; i++) {
  closeButtons[i].onclick = closeModal;
}

for (var i = 0; i < noButtons.length; i++) {
  noButtons[i].onclick = closeModal;
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  if (event.target.classList.contains("modal")) {
    closeModal();
  }
};
