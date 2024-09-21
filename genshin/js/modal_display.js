document.addEventListener('DOMContentLoaded', function() {
  var images = document.querySelectorAll('.imageId');
  var modal = document.getElementById('myModal');
  var modalTitle = document.getElementById('modalTitle');
  var embed = document.getElementById('emded');
  var closeBtn = document.querySelector('.close');

  images.forEach(function(image) {
    image.addEventListener('click', function() {
      var title = this.getAttribute('title');
      var location = this.getAttribute('data-location');

      modalTitle.textContent = title;
      embed.src = location;
      modal.style.display = 'block';
    });
  });

  closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  });
});