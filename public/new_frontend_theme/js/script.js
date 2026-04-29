document.querySelector('.popup-link').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('popup').style.display = 'block';
  // Optional: Preload the butterfly image
var image = new Image();
image.src = "images/logo.png";
// Optional: Add multiple butterflies
for (var i = 0; i < 5; i++) {
  var butterfly = document.createElement("img");
  butterfly.src = "images/logo.png";
  butterfly.className = "butterfly";
  document.querySelector(".butterfly-container").appendChild(butterfly);
}

});
