var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');

const asterisk = document.getElementById("asterisk");
const message = document.getElementById("message");


window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}


asterisk.addEventListener("mouseover", function () {
    message.style.display = "block";
});

asterisk.addEventListener("mouseout", function () {
    message.style.display = "none";
});
